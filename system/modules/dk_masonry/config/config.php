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
 * Content elements
 */
$GLOBALS['TL_CTE']['masonry_category'] = array(
	'masonry_gallery'	=> 'masonry\ContentMasonryGallery',
	'masonry_start'		=> 'masonry\ContentMasonryStart',
	'masonry_stop'		=> 'masonry\ContentMasonryStop'
);


/**
 * Wrapper elements
 */
$GLOBALS['TL_WRAPPERS']['start'][] = 'masonry_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'masonry_stop';
