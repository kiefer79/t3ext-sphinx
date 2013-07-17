<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "sphinx".
 *
 * Auto generated 05-07-2013 10:33
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Sphinx Python Documentation Generator and Viewer',
	'description' => 'One-click install Sphinx generator for your TYPO3 website. This extension builds ReStructuredText documentation
	(format of official TYPO3 manuals), renders other extension manuals and provides an integrated editor for your own extension manuals.',
	'category' => 'service',
	'author' => 'Xavier Perseguers',
	'author_company' => 'Causal Sàrl',
	'author_email' => 'xavier@causal.ch',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.1.0',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.3-5.4.99',
			'typo3' => '6.0.0-6.1.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
			'restdoc' => '1.3.0-0.0.0',
		),
	),
	'_md5_values_when_last_written' => 'a:178:{s:9:"ChangeLog";s:4:"b518";s:20:"class.ext_update.php";s:4:"d3b2";s:21:"ext_conf_template.txt";s:4:"9a00";s:12:"ext_icon.gif";s:4:"406f";s:17:"ext_localconf.php";s:4:"26d6";s:14:"ext_tables.php";s:4:"1b30";s:46:"Classes/Controller/DocumentationController.php";s:4:"2614";s:50:"Classes/Controller/InteractiveViewerController.php";s:4:"c7a3";s:43:"Classes/Controller/RestEditorController.php";s:4:"09cf";s:32:"Classes/Controller/mod1/conf.php";s:4:"3255";s:33:"Classes/Controller/mod1/index.php";s:4:"e32e";s:38:"Classes/Domain/Model/Documentation.php";s:4:"3a82";s:28:"Classes/EM/Configuration.php";s:4:"7e25";s:33:"Classes/Utility/Configuration.php";s:4:"2a64";s:34:"Classes/Utility/GeneralUtility.php";s:4:"9252";s:25:"Classes/Utility/Setup.php";s:4:"1428";s:33:"Classes/Utility/SphinxBuilder.php";s:4:"d641";s:36:"Classes/Utility/SphinxQuickstart.php";s:4:"ac73";s:38:"Classes/ViewHelpers/FormViewHelper.php";s:4:"1030";s:45:"Classes/ViewHelpers/Form/SelectViewHelper.php";s:4:"aab8";s:26:"Documentation/Includes.txt";s:4:"d9b7";s:23:"Documentation/Index.rst";s:4:"c49a";s:26:"Documentation/Settings.yml";s:4:"58f6";s:38:"Documentation/Administration/Index.rst";s:4:"0e9f";s:59:"Documentation/Administration/InstallingExtension/Images.txt";s:4:"6103";s:58:"Documentation/Administration/InstallingExtension/Index.rst";s:4:"ceb5";s:66:"Documentation/Administration/RenderingPdf/CustomizingRendering.rst";s:4:"c70c";s:52:"Documentation/Administration/RenderingPdf/Images.txt";s:4:"ce0b";s:51:"Documentation/Administration/RenderingPdf/Index.rst";s:4:"2b75";s:66:"Documentation/Administration/RenderingPdf/InstallingLaTeXLinux.rst";s:4:"99ad";s:68:"Documentation/Administration/RenderingPdf/InstallingLaTeXWindows.rst";s:4:"7cd6";s:63:"Documentation/Administration/RenderingPdf/IntroductionLaTeX.rst";s:4:"18c2";s:60:"Documentation/Administration/RenderingPdf/LaTeXVsRst2pdf.rst";s:4:"67c5";s:61:"Documentation/Administration/UsingSphinxCommandLine/Index.rst";s:4:"c2b9";s:52:"Documentation/Administration/WindowsSetup/Images.txt";s:4:"098b";s:51:"Documentation/Administration/WindowsSetup/Index.rst";s:4:"9024";s:33:"Documentation/ChangeLog/Index.rst";s:4:"ac8b";s:35:"Documentation/Development/Index.rst";s:4:"f842";s:48:"Documentation/Development/SignalSlots/Images.txt";s:4:"f68c";s:72:"Documentation/Development/SignalSlots/RegisteringCustomDocumentation.rst";s:4:"21a4";s:41:"Documentation/Images/build_button_pdf.png";s:4:"c7a0";s:38:"Documentation/Images/build_buttons.png";s:4:"7549";s:33:"Documentation/Images/checkbox.png";s:4:"f398";s:45:"Documentation/Images/custom_documentation.png";s:4:"02b1";s:37:"Documentation/Images/edit_chapter.png";s:4:"3647";s:37:"Documentation/Images/em_configure.png";s:4:"5713";s:34:"Documentation/Images/em_update.png";s:4:"d682";s:50:"Documentation/Images/environment_check_windows.png";s:4:"b787";s:46:"Documentation/Images/environment_variables.png";s:4:"df2d";s:38:"Documentation/Images/import_sphinx.png";s:4:"0db8";s:35:"Documentation/Images/LaTeX_logo.png";s:4:"aa3b";s:41:"Documentation/Images/libarchive_setup.png";s:4:"4697";s:40:"Documentation/Images/miktex_onthefly.png";s:4:"1e3c";s:37:"Documentation/Images/miktex_setup.png";s:4:"a7ee";s:38:"Documentation/Images/mod1_overview.png";s:4:"53bc";s:36:"Documentation/Images/msvcr100dll.png";s:4:"046b";s:34:"Documentation/Images/pdf_latex.png";s:4:"8020";s:36:"Documentation/Images/pdf_rst2pdf.png";s:4:"9f26";s:43:"Documentation/Images/project_properties.png";s:4:"c352";s:39:"Documentation/Images/project_wizard.png";s:4:"ff70";s:48:"Documentation/Images/project_wizard_overview.png";s:4:"cec4";s:37:"Documentation/Images/python_setup.png";s:4:"d207";s:35:"Documentation/Images/render_pdf.png";s:4:"720c";s:37:"Documentation/Images/save_compile.png";s:4:"efe1";s:37:"Documentation/Images/section_help.png";s:4:"c54d";s:35:"Documentation/Images/share_font.png";s:4:"18cf";s:39:"Documentation/Images/sphinx_version.png";s:4:"84ac";s:41:"Documentation/Images/system_variables.png";s:4:"8c9f";s:36:"Documentation/Images/unzip_setup.png";s:4:"2208";s:38:"Documentation/Images/update_script.png";s:4:"d46c";s:31:"Documentation/Images/viewer.png";s:4:"efe1";s:48:"Documentation/Images/viewer_choose_extension.png";s:4:"6272";s:36:"Documentation/Introduction/Index.rst";s:4:"3796";s:49:"Documentation/Introduction/Screenshots/Images.txt";s:4:"d618";s:48:"Documentation/Introduction/Screenshots/Index.rst";s:4:"fcab";s:49:"Documentation/Introduction/WhatDoesItDo/Index.rst";s:4:"ef29";s:37:"Documentation/KnownProblems/Index.rst";s:4:"33b4";s:32:"Documentation/ToDoList/Index.rst";s:4:"d8b6";s:34:"Documentation/UserManual/Index.rst";s:4:"b92e";s:70:"Documentation/UserManual/BuildingSphinxDocumentationProject/Images.txt";s:4:"4fb4";s:69:"Documentation/UserManual/BuildingSphinxDocumentationProject/Index.rst";s:4:"9cfd";s:70:"Documentation/UserManual/CreatingSphinxDocumentationProject/Images.txt";s:4:"5902";s:69:"Documentation/UserManual/CreatingSphinxDocumentationProject/Index.rst";s:4:"ba2b";s:47:"Documentation/UserManual/Requirements/Index.rst";s:4:"1464";s:61:"Documentation/UserManual/SphinxDocumentationEditor/Images.txt";s:4:"2c2f";s:60:"Documentation/UserManual/SphinxDocumentationEditor/Index.rst";s:4:"9ff6";s:61:"Documentation/UserManual/SphinxDocumentationViewer/Images.txt";s:4:"7e00";s:60:"Documentation/UserManual/SphinxDocumentationViewer/Index.rst";s:4:"45df";s:45:"Documentation/UserManual/SphinxRest/Index.rst";s:4:"1ca7";s:40:"Resources/Private/Language/locallang.xlf";s:4:"7972";s:45:"Resources/Private/Language/locallang_mod1.xlf";s:4:"5fb9";s:58:"Resources/Private/Language/locallang_mod_documentation.xlf";s:4:"677d";s:43:"Resources/Private/Layouts/ModuleSphinx.html";s:4:"6a71";s:50:"Resources/Private/Templates/Console/BuildForm.html";s:4:"bd3d";s:54:"Resources/Private/Templates/Console/KickstartForm.html";s:4:"ee9b";s:52:"Resources/Private/Templates/Documentation/Blank.html";s:4:"817b";s:52:"Resources/Private/Templates/Documentation/Index.html";s:4:"4d4e";s:51:"Resources/Private/Templates/Documentation/Menu.html";s:4:"251c";s:53:"Resources/Private/Templates/Documentation/Render.html";s:4:"a17f";s:65:"Resources/Private/Templates/InteractiveViewer/MissingRestdoc.html";s:4:"d97d";s:66:"Resources/Private/Templates/InteractiveViewer/OutdatedRestdoc.html";s:4:"3c34";s:57:"Resources/Private/Templates/InteractiveViewer/Render.html";s:4:"b215";s:62:"Resources/Private/Templates/Projects/BlankProject/conf.py.tmpl";s:4:"39ee";s:63:"Resources/Private/Templates/Projects/BlankProject/Makefile.tmpl";s:4:"b56c";s:73:"Resources/Private/Templates/Projects/BlankProject/MasterDocument.rst.tmpl";s:4:"3e59";s:75:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/Settings.yml.tmpl";s:4:"228a";s:76:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/conf.py.tmpl";s:4:"3c61";s:77:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/make-html.bat";s:4:"6d1c";s:77:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/make.bat.tmpl";s:4:"22dc";s:77:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/Makefile.tmpl";s:4:"869f";s:90:"Resources/Private/Templates/Projects/TYPO3DocEmptyProject/_make/_not_versioned/_.gitignore";s:4:"829c";s:65:"Resources/Private/Templates/Projects/TYPO3DocProject/Includes.txt";s:4:"6d5f";s:76:"Resources/Private/Templates/Projects/TYPO3DocProject/MasterDocument.rst.tmpl";s:4:"ace7";s:70:"Resources/Private/Templates/Projects/TYPO3DocProject/Settings.yml.tmpl";s:4:"0a99";s:82:"Resources/Private/Templates/Projects/TYPO3DocProject/AdministratorManual/Index.rst";s:4:"1cd2";s:83:"Resources/Private/Templates/Projects/TYPO3DocProject/Images/IntroductionPackage.png";s:4:"bd5d";s:100:"Resources/Private/Templates/Projects/TYPO3DocProject/Images/AdministratorManual/ExtensionManager.png";s:4:"47a4";s:86:"Resources/Private/Templates/Projects/TYPO3DocProject/Images/UserManual/BackendView.png";s:4:"7f27";s:75:"Resources/Private/Templates/Projects/TYPO3DocProject/Introduction/Index.rst";s:4:"b17b";s:73:"Resources/Private/Templates/Projects/TYPO3DocProject/UserManual/Index.rst";s:4:"891f";s:71:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/conf.py.tmpl";s:4:"5867";s:72:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/make-html.bat";s:4:"6d1c";s:72:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/make.bat.tmpl";s:4:"22dc";s:72:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/Makefile.tmpl";s:4:"b56c";s:85:"Resources/Private/Templates/Projects/TYPO3DocProject/_make/_not_versioned/_.gitignore";s:4:"829c";s:48:"Resources/Private/Templates/RestEditor/Edit.html";s:4:"3157";s:32:"Resources/Public/Css/Backend.css";s:4:"4157";s:38:"Resources/Public/Css/Documentation.css";s:4:"178c";s:33:"Resources/Public/Css/pygments.css";s:4:"3fe3";s:32:"Resources/Public/Images/book.png";s:4:"8007";s:39:"Resources/Public/Images/check_links.png";s:4:"6f39";s:47:"Resources/Public/Images/file_extension_html.png";s:4:"6d8e";s:47:"Resources/Public/Images/file_extension_json.png";s:4:"d131";s:46:"Resources/Public/Images/file_extension_pdf.png";s:4:"95b5";s:46:"Resources/Public/Images/file_extension_tex.png";s:4:"fa1b";s:37:"Resources/Public/Images/no-sphinx.png";s:4:"df3f";s:34:"Resources/Public/Images/sphinx.png";s:4:"3a49";s:35:"Resources/Public/Images/warning.png";s:4:"a59a";s:55:"Resources/Public/docs.typo3.org/css/t3_org_doc_main.css";s:4:"8023";s:61:"Resources/Public/docs.typo3.org/css/t3_org_doc_main_alt_1.css";s:4:"b76e";s:59:"Resources/Public/docs.typo3.org/css/t3_to_be_integrated.css";s:4:"db4f";s:58:"Resources/Public/docs.typo3.org/i/arrow-r-888888-17x17.png";s:4:"712e";s:52:"Resources/Public/docs.typo3.org/js/docstypo3org-1.js";s:4:"ce22";s:52:"Resources/Public/docs.typo3.org/js/docstypo3org-2.js";s:4:"eba9";s:53:"Resources/Public/docs.typo3.org/t3extras/css/grid.css";s:4:"2c21";s:51:"Resources/Public/docs.typo3.org/t3extras/css/ie.css";s:4:"3811";s:52:"Resources/Public/docs.typo3.org/t3extras/css/ie7.css";s:4:"c4b3";s:52:"Resources/Public/docs.typo3.org/t3extras/css/ie8.css";s:4:"67aa";s:53:"Resources/Public/docs.typo3.org/t3extras/css/main.css";s:4:"462b";s:54:"Resources/Public/docs.typo3.org/t3extras/css/reset.css";s:4:"9088";s:54:"Resources/Public/docs.typo3.org/t3extras/css/share.css";s:4:"ba11";s:69:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.eot";s:4:"8c37";s:69:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.svg";s:4:"d80b";s:69:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.ttf";s:4:"2199";s:70:"Resources/Public/docs.typo3.org/t3extras/fonts/share-bold-webfont.woff";s:4:"ab6f";s:71:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.eot";s:4:"d209";s:71:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.svg";s:4:"b6a5";s:71:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.ttf";s:4:"298c";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-italic-webfont.woff";s:4:"3f06";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.eot";s:4:"a366";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.svg";s:4:"4e5d";s:72:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.ttf";s:4:"3a9a";s:73:"Resources/Public/docs.typo3.org/t3extras/fonts/share-regular-webfont.woff";s:4:"b60d";s:55:"Resources/Public/docs.typo3.org/t3extras/fonts/share.js";s:4:"4950";s:57:"Resources/Public/docs.typo3.org/t3extras/i/blockquote.png";s:4:"66c6";s:55:"Resources/Public/docs.typo3.org/t3extras/i/i-arrows.png";s:4:"cacf";s:56:"Resources/Public/docs.typo3.org/t3extras/i/nav-aside.png";s:4:"2431";s:54:"Resources/Public/docs.typo3.org/t3extras/i/nav-sub.png";s:4:"c9d8";s:50:"Resources/Public/docs.typo3.org/t3extras/i/pre.png";s:4:"b6a6";s:56:"Resources/Public/docs.typo3.org/t3extras/i/s-buttons.png";s:4:"e2ee";s:58:"Resources/Public/docs.typo3.org/t3extras/i/shadow-page.jpg";s:4:"4957";s:58:"Resources/Public/docs.typo3.org/t3extras/i/shadow-site.png";s:4:"7390";s:57:"Resources/Public/docs.typo3.org/t3extras/i/typo3-logo.png";s:4:"f048";s:52:"Resources/Public/docs.typo3.org/t3extras/js/cufon.js";s:4:"7e47";s:55:"Resources/Public/docs.typo3.org/t3extras/js/jcookies.js";s:4:"4667";s:60:"Resources/Public/docs.typo3.org/t3extras/js/jquery.easing.js";s:4:"5d14";s:51:"Resources/Public/docs.typo3.org/t3extras/js/main.js";s:4:"e7d5";s:14:"doc/manual.sxw";s:4:"9616";}',
	'suggests' => array(
	),
);

?>