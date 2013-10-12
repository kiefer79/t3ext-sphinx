<?php
namespace Causal\Sphinx\Hook;

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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Hook implementation for EXT:restdoc.
 *
 * @category    Hooks
 * @package     TYPO3
 * @subpackage  tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class Restdoc {

	public function processExternalUrl(array $params) {
		if (preg_match('#^http://docs.typo3.org/typo3cms/extensions/([^/]+)/([0-9.]+/)?(_pdf/)?(.*)$#', $params['matches'][2], $matches)) {
			$extensionKey = $matches[1];
			$version = rtrim($matches[2], '/');
			$isPdf = !empty($matches[3]);
			$document = $matches[4];

			//$params['matches'][0] = $params['matches'][1] . '//typo3/mod.php';
		}
	}

}
