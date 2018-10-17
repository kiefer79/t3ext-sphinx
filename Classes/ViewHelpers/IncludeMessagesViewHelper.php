<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Causal\Sphinx\ViewHelpers;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * Includes localized messages.
 *
 * @category    ViewHelpers
 * @package     tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class IncludeMessagesViewHelper extends AbstractViewHelper
{

    use CompileWithRenderStatic;

    /**
     * Required for TYPO3 v8
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('keyPrefix', 'string', 'key prefix', false);
        $this->registerArgument('jsDictionnary', 'string', 'js dictionary', false);
    }

    /**
     * Renders the JS snippet.
     *
     * @param string $keyPrefix
     * @param string $jsDictionnary
     * @return string
     */
//    public function render(string $keyPrefix, string $jsDictionnary)
//    {
//
//        $llFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('sphinx') . 'Resources/Private/Language/locallang.xlf';
//        $labels = $GLOBALS['LANG']->includeLLFile($llFile, false);
//        $keys = array_filter(array_keys($labels['default']), function ($item) use ($keyPrefix) {
//            return substr($item, 0, strlen($keyPrefix)) === $keyPrefix;
//        });
//
//        $messages = array();
//        foreach ($keys as $key) {
//            $messages[$key] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, 'sphinx');
//        }
//
//        $json = json_encode($messages);
//        $out = <<<JS
//$(document).ready(function () {
//    $jsDictionnary = $json;
//});
//JS;
//
//        return $out;
//    }

    /**
     * Render the URI to the resource. The filename is used from child content.
     *
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string The URI to the resource
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $llFile = ExtensionManagementUtility::extPath('sphinx') . 'Resources/Private/Language/locallang.xlf';
        $labels = $GLOBALS['LANG']->includeLLFile($llFile, false);
        $keys = array_filter(array_keys($labels['default']), function ($item) use ($keyPrefix) {
            return substr($item, 0, strlen($keyPrefix)) === $keyPrefix;
        });

        $messages = array();
        foreach ($keys as $key) {
            $messages[$key] = LocalizationUtility::translate($key, 'sphinx');
        }

        $json = json_encode($messages);
        $out = <<<JS
$(document).ready(function () {
    $jsDictionnary = $json;
});
JS;

        return $out;
    }


}
