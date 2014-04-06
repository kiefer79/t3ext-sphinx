<?php
namespace Causal\Sphinx\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013-2014 Xavier Perseguers <xavier@causal.ch>
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

use TYPO3\CMS\Core\Utility\PathUtility;
use Causal\Sphinx\Utility\MiscUtility;

/**
 * Creates a project tree browser using jquery-treetable.
 *
 * @category    ViewHelpers
 * @package     tx_sphinx
 * @author      Xavier Perseguers <xavier@causal.ch>
 * @copyright   Causal Sàrl
 * @license     http://www.gnu.org/copyleft/gpl.html
 */
class ProjectTreeViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Creates a tree of directories and files for a project.
	 *
	 * @param string $projectPath The base directory of the project
	 * @param string $reveal File or folder to be initially revealed
	 * @return string
	 */
	public function render($projectPath, $reveal = '') {
		if (!empty($reveal)) {
			$reveal = md5($reveal);
		}

		$excludePatterns = array(
			'#(^\\.|/\\.).+#',
		);
		$projectStructure = MiscUtility::getProjectStructure($projectPath);
		switch ($projectStructure) {
			case MiscUtility::PROJECT_STRUCTURE_SINGLE:
				$excludePatterns[] = '#^_build/?.*#';
				break;
			case MiscUtility::PROJECT_STRUCTURE_TYPO3:
				$excludePatterns[] = '#^_make/build/?.*#';
				break;
		}

		$pluginId = 'tx-sphinx-projecttree';

		$out = array();
		$out[] = <<<HTML
<table id="$pluginId">
	<caption>
	  <a href="#" onclick="jQuery('#$pluginId').treetable('expandAll'); return false;">Expand all</a>
	  <a href="#" onclick="jQuery('#$pluginId').treetable('collapseAll'); return false;">Collapse all</a>
	</caption>
	<tbody>
HTML;

		$root = '<tr data-tt-id="' . md5('/') . '" data-path="/">';
		$root .= '<td><span class="folder hasmenu">/</span></td>';
		$root .= '</tr>';
		$out[] = $root;

		/** @var \RecursiveDirectoryIterator $iterator */
		$iterator = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator($projectPath,
				\RecursiveDirectoryIterator::SKIP_DOTS),
			\RecursiveIteratorIterator::SELF_FIRST
		);
		foreach ($iterator as $item) {
			$path = $iterator->getSubPathName();
			$unifiedPath = str_replace('\\', '/', $path);
			$skip = FALSE;
			foreach ($excludePatterns as $excludePattern) {
				if (preg_match($excludePattern, $unifiedPath)) {
					$skip = TRUE;
					break;
				}
			}
			if ($skip) {
				continue;
			}
			$identifier = md5($path);
			$trTag = '<tr data-tt-id="' . $identifier . '"';
			$trTag .= ' data-path="' . htmlspecialchars($unifiedPath . ($item->isDir() ? '/' : '')) . '"';
			if (PathUtility::basename($path) === $path) {
				// 1st level
				$parentId = md5('/');
			} else {
				$parentId = md5(PathUtility::dirname($path));
			}
			$out[] = $trTag . ' data-tt-parent-id="' . $parentId . '">';

			/** @var \splFileInfo $item */
			if ($item->isDir()) {
				$out[] = '<td><span class="folder hasmenu">' . htmlspecialchars(PathUtility::basename($path)) . '</span></td>';
			} else {
				if (($pos = strrpos($path, '.')) !== FALSE) {
					$extension = strtolower(substr($path, $pos + 1));
				} else {
					$extension = '';
				}
				switch ($extension) {
					case 'gif':
					case 'jpg':
					case 'jpeg':
					case 'png':
						$class = 'image hasmenu';
					break;
					default:
						$class = 'file hasmenu';
					break;
				}
				$out[] = '<td><span class="' . $class . '">' . htmlspecialchars(PathUtility::basename($path)) . '</span></td>';
			}

			$out[] = '</tr>';
		}

		$out[] = <<<HTML
	</tbody>
</table>
HTML;

		$menuRename = $this->translate('editor.message.rename');
		$menuRemove = $this->translate('editor.message.remove');
		$menuCreateFile = $this->translate('editor.message.createFile');
		$menuCreateFolder = $this->translate('editor.message.createFolder');

		$out[] = '<script type="text/javascript">';
		$out[] = <<<JS
$(document).ready(function () {
	$('#$pluginId').treetable({ expandable: true });

	// Highlight selected row
	$("#$pluginId tbody").on("mousedown", "tr", function () {
		$(".selected").not(this).removeClass("selected");
		$(this).toggleClass("selected");
	});

	// Open selected file on double-click
	$("#$pluginId td span[class='file']").on("dblclick", function (e) {
		var file = $(event.target).closest("tr").attr('data-path');
		CausalSphinxEditor.openFile(file);
	});

	// Drag & Drop implementation for files
	$("#$pluginId .file, #$pluginId .image").draggable({
		helper: "clone",
		opacity: .75,
		refreshPositions: true,
		revert: "invalid",
		revertDuration: 300,
		scroll: true
	});

	$("#$pluginId .folder").each(function() {
		$(this).parents("#$pluginId tr").droppable({
			accept: ".file, .image, .folder",
			drop: function (e, ui) {
				var droppedEl = ui.draggable.parents("tr");
				var source = droppedEl.attr('data-path');
				var destination = $(this).attr('data-path');

				// Update server-side project tree
				if (CausalSphinxEditor.moveFile(source, destination)) {
					$("#$pluginId").treetable("move", droppedEl.data("ttId"), $(this).data("ttId"));

					// Update the internal reference
					droppedEl.attr('data-path', destination + '/' + /([^/]+)$/.exec(source)[1]);
				}
			},
			hoverClass: "accept",
			over: function (e, ui) {
				var droppedEl = ui.draggable.parents("tr");
				if(this != droppedEl[0] && !$(this).is(".expanded")) {
					$("#$pluginId").treetable("expandNode", $(this).data("ttId")
);
				}
			}
		});
	});

	$("#$pluginId").contextmenu({
		delegate: ".hasmenu",
		menu: [
			{title: "$menuRename", cmd: "rename", uiIcon: "ui-icon-pencil"},
			{title: "$menuRemove", cmd: "remove", uiIcon: "ui-icon-trash"},
			{title: "$menuCreateFile", cmd: "createFile", uiIcon: "ui-icon-document"},
			{title: "$menuCreateFolder", cmd: "createFolder", uiIcon: "ui-icon-folder-collapsed"},
		],
		beforeOpen: function(event, ui) {
			var menu = ui.menu,
				target = ui.target;

			if (target.closest("tr").attr('data-path') == '/') {
				// root cannot be renamed
				$("#$pluginId").contextmenu("showEntry", "rename", false);
				$("#$pluginId").contextmenu("showEntry", "remove", false);
			} else {
				$("#$pluginId").contextmenu("showEntry", "rename", true);
				$("#$pluginId").contextmenu("showEntry", "remove", true);
			}

			// Only folder may have the create file/folder menus
			$("#$pluginId").contextmenu("showEntry", "createFile", target.hasClass("folder"));
			$("#$pluginId").contextmenu("showEntry", "createFolder", target.hasClass("folder"));
		},
		select: function(event, ui) {
			var path = ui.target.closest("tr").attr('data-path');
			switch (ui.cmd) {
				case 'rename':
					CausalSphinxEditor.renameFileFolder(ui.target.closest("tr"), path);
					break;
				case 'remove':
					CausalSphinxEditor.removeFileFolder(path);
					break;
				case 'createFile':
					CausalSphinxEditor.createFile(path);
					break;
				case 'createFolder':
					CausalSphinxEditor.createFolder(path);
					break;
			}
		}
	});

	try {
		$("#$pluginId").treetable("reveal", '$reveal');
		$("#$pluginId tr[data-tt-id='$reveal']").toggleClass("selected");
	}
	catch(error) {
		console.log(error.message);
	}
});
JS;
		$out[] = '</script>';

		return implode(LF, $out);
	}

	/**
	 * Returns the localized label of a given key.
	 *
	 * @param string $key The label key
	 * @return string Localized label
	 */
	protected function translate($key) {
		return \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($key, 'sphinx');
	}

}
