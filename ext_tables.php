<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	$sphinxConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['sphinx']);
	if (!isset($sphinxConfiguration['load_console_module']) || (bool)$sphinxConfiguration['load_console_module']) {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModulePath('file_txsphinxM1', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Controller/mod1');
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule('file', 'txsphinxM1', '', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Controller/mod1/');
	}

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Causal.' . $_EXTKEY,
		'help',
		'documentation',
		'top',
		array(
			'Documentation' => 'index,dashboard,render,convert,createExtensionProject',
			'InteractiveViewer' => 'render,missingRestdoc,outdatedRestdoc',
			'RestEditor' => 'edit,open,save,autocomplete,accordionReferences,updateIntersphinx',
		),
		array(
			'access' => 'user,group',
			'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.png',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod_documentation.xlf',
		)
	);
}
