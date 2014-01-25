<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2014 Leo Feyer
 * 
 * @package   masonry
 * @author    Dirk Klemmt
 * @license   MIT
 * @copyright Dirk Klemmt 2013-2014
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Dirch',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Dirch\masonry\Masonry'					=> 'system/modules/dk_masonry/classes/Masonry.php',

	// Elements
	'Dirch\masonry\ContentMasonryGallery'	=> 'system/modules/dk_masonry/elements/ContentMasonryGallery.php',
	'Dirch\masonry\ContentMasonryStart'		=> 'system/modules/dk_masonry/elements/ContentMasonryStart.php',
	'Dirch\masonry\ContentMasonryStop'		=> 'system/modules/dk_masonry/elements/ContentMasonryStop.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_masonry'		=> 'system/modules/dk_masonry/templates/backend',
	'ce_masonry'		=> 'system/modules/dk_masonry/templates/elements',
	'masonry_gallery'	=> 'system/modules/dk_masonry/templates/gallery',
	'js_masonry'		=> 'system/modules/dk_masonry/templates/jquery'
));
