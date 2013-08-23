<?php
namespace Causal\Sphinx\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Xavier Perseguers <xavier@causal.ch>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Module 'Sphinx Documentation' for the 'sphinx' extension.
 *
 * @category    Backend Module
 * @package     TYPO3
 * @subpackage  tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class DocumentationController extends AbstractActionController {

	/**
	 * Extension repository
	 *
	 * @var \Causal\Sphinx\Domain\Repository\ExtensionRepository
	 * @inject
	 */
	protected $extensionRepository;

	/**
	 * Main action.
	 *
	 * @return void
	 */
	protected function indexAction() {
		// Nothing to do
	}

	/**
	 * Kickstart action.
	 *
	 * @return void
	 */
	protected function kickstartAction() {
		$extensionsWithoutDocumentation = $this->extensionRepository->findByHasNoDocumentation('G,L');
		$extensionWithOpenOfficeDocumentation = $this->extensionRepository->findByHasOpenOffice('G,L');

		$this->view->assign('extensionsEmpty', $extensionsWithoutDocumentation);
		$this->view->assign('extensionsOpenOffice', $extensionWithOpenOfficeDocumentation);
	}

	/**
	 * Menu action.
	 *
	 * @return void
	 */
	protected function menuAction() {
		$extensions = $this->extensionRepository->findByHasSphinxDocumentation();
		$references = array();
		foreach ($extensions as $extension) {
			$typeLabel = $this->translate('extensionType_' . $extension->getInstallType());
			$references[$typeLabel]['EXT:' . $extension->getExtensionKey()] = sprintf('%s (%s)', $extension->getTitle(), $extension->getExtensionKey());
		}

		$this->signalSlotDispatcher->dispatch(
			__CLASS__,
			'afterInitializeReferences',
			array(
				'references' => &$references,
			)
		);

		$this->view->assign('references', $references);

		$layouts = array(
			'html' => $this->translate('documentationLayout_static'),
			'json' => $this->translate('documentationLayout_interactive'),
		);

		switch ($this->settings['pdf_builder']) {
			case 'pdflatex':
				$renderPdf = \TYPO3\CMS\Core\Utility\CommandUtility::getCommand('pdflatex') !== '';
				break;
			case 'rst2pdf':
			default:
				$renderPdf = TRUE;
				break;
		}
		if ($renderPdf) {
			$layouts['pdf'] = $this->translate('documentationLayout_pdf');
		}
		$this->view->assign('layouts', $layouts);

		$currentReference = $this->getBackendUser()->getModuleData('help_documentation/DocumentationController/reference');
		$currentLayout = $this->getBackendUser()->getModuleData('help_documentation/DocumentationController/layout');
		$this->view->assign('currentReference', $currentReference);
		$this->view->assign('currentLayout', $currentLayout);
	}

	/**
	 * Render action.
	 *
	 * @param string $reference Reference of a documentation
	 * @param string $layout Layout to use
	 * @param boolean $force TRUE if rendering should be forced, otherwise FALSE to use cache if available
	 * @return void
	 * @throws \RuntimeException
	 */
	protected function renderAction($reference = '', $layout = 'html', $force = FALSE) {
		// Store preferences
		$this->getBackendUser()->pushModuleData('help_documentation/DocumentationController/reference', $reference);
		$this->getBackendUser()->pushModuleData('help_documentation/DocumentationController/layout', $layout);

		if ($reference === '') {
			$this->redirect('kickstart');
		}

		list($type, $identifier) = explode(':', $reference, 2);
		switch ($type) {
			case 'EXT':
				list($extensionKey, $locale) = explode('.', $identifier, 2);
				$documentationUrl = \Causal\Sphinx\Utility\GeneralUtility::generateDocumentation($extensionKey, $layout, $force, $locale);
				break;
			case 'USER':
				$documentationUrl = NULL;
				$this->signalSlotDispatcher->dispatch(
					__CLASS__,
					'renderUserDocumentation',
					array(
						'identifier' => $identifier,
						'layout' => $layout,
						'force' => $force,
						'documentationUrl' => &$documentationUrl,
					)
				);
				if ($documentationUrl === NULL) {
					throw new \RuntimeException('No slot found to render documentation with identifier "' . $identifier . '"', 1371208253);
				}
				break;
			default:
				throw new \RuntimeException('Unknown reference "' . $reference . '"', 1371162948);
		}

		if ($layout === 'json' && substr($documentationUrl, -6) === '.fjson') {
			if (substr($documentationUrl, 0, 3) === '../') {
				$documentationFilename = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(substr($documentationUrl, 3));
			} elseif ($documentationUrl{0} === '/') {
				$documentationFilename = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(substr($documentationUrl, 1));
			} else {
				$documentationFilename = '';
			}
			$this->forward('render', 'InteractiveViewer', NULL, array('reference' => $reference, 'documentationFilename' => $documentationFilename));
		}
		$this->view->assign('documentationUrl', $documentationUrl);
	}

	/**
	 * Converts an OpenOffice manual into a Sphinx project.
	 *
	 * @param string $extensionKey The TYPO3 extension key
	 * @return void
	 */
	protected function convertAction($extensionKey) {
		$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extensionKey);
		$sxwFilename = $extensionPath . 'doc/manual.sxw';
		$documentationDirectory = $extensionPath . 'Documentation';

		if (is_file($sxwFilename)) {
			try {
				\Causal\Sphinx\Utility\OpenOfficeConverter::convert($sxwFilename, $documentationDirectory);

				// Open converted documentation
				$this->getBackendUser()->pushModuleData('help_documentation/DocumentationController/reference', 'EXT:' . $extensionKey);
			} catch (\RuntimeException $exception) {
				$this->controllerContext->getFlashMessageQueue()->enqueue(
					\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
						'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
						$exception->getMessage(),
						'',
						\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
						TRUE
					)
				);
			}
		}

		$this->redirect('index');
	}

	/**
	 * Creates a Sphinx documentation project for a given extension.
	 *
	 * @param string $extensionKey The TYPO3 extension key
	 * @return void
	 */
	protected function createExtensionProjectAction($extensionKey) {
		$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extensionKey);
		$documentationDirectory = $extensionPath . 'Documentation';

		try {
			\TYPO3\CMS\Core\Utility\GeneralUtility::mkdir_deep($documentationDirectory . DIRECTORY_SEPARATOR);

			$metadata = \Causal\Sphinx\Utility\GeneralUtility::getExtensionMetaData($extensionKey);
			\Causal\Sphinx\Utility\SphinxQuickstart::createProject(
				$documentationDirectory,
				$metadata['title'],
				$metadata['author'],
				FALSE,
				'TYPO3DocProject',
				$metadata['version'],
				$metadata['release']
			);

			// Open freshly created documentation
			$this->getBackendUser()->pushModuleData('help_documentation/DocumentationController/reference', 'EXT:' . $extensionKey);
		} catch (\RuntimeException $exception) {
			$this->controllerContext->getFlashMessageQueue()->enqueue(
				\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
					'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
					$exception->getMessage(),
					'',
					\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR,
					TRUE
				)
			);
		}

		$this->redirect('index');
	}

}

?>