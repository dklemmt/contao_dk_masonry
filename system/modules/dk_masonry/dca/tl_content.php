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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dk_msryColumnWidthSelect';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dk_msryGutterSelect';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dk_msryThemeSelect';

$GLOBALS['TL_DCA']['tl_content']['palettes']['masonry_gallery'] = '{type_legend},type,headline;{source_legend},dk_msryMultiSRC,dk_msrySortBy;{masonry_image_legend},dk_msryImageSize,dk_msryFullsize,dk_msryNumberOfItems;{masonry_layout_legend},dk_msryIsFitWidth,dk_msryColumnWidthSelect,dk_msryGutterSelect,dk_msryIsOriginLeft,dk_msryIsOriginTop;{masonry_themes_legend},dk_msryIsResizeBound,dk_msryTransitionDuration,dk_msryThemeSelect;{masonry_template_legend},dk_msryHtmlTpl,dk_msryJsTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['masonry_start'] = '{type_legend},type,headline;{masonry_layout_legend},dk_msryIsFitWidth,dk_msryColumnWidthSelect,dk_msryGutterSelect,dk_msryIsOriginLeft,dk_msryIsOriginTop;{masonry_themes_legend},dk_msryIsResizeBound,dk_msryTransitionDuration,dk_msryThemeSelect;{masonry_template_legend},dk_msryHtmlTpl,dk_msryJsTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryColumnWidthSelect_fixed'] = 'dk_msryColumnWidth';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryColumnWidthSelect_class'] = 'dk_msryColumnWidthClass';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryGutterSelect_fixed']	 = 'dk_msryGutter';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryGutterSelect_class']	 = 'dk_msryGutterClass';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryThemeSelect_external'] = 'dk_msryThemeSRC';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryMultiSRC'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryMultiSRC'],
	'exclude'			=> true,
	'inputType'			=> 'fileTree',
	'eval'				=> array('multiple' => true, 'fieldType' => 'checkbox', 'orderField' => 'orderSRC', 'files' => true, 'isGallery' => true, 'mandatory' => true),
	'sql'				=> "blob NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msrySortBy'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msrySortBy'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options'			=> array('custom', 'name_asc', 'name_desc', 'date_asc', 'date_desc', 'random'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content'],
	'eval'				=> array('tl_class' => 'w50'),
	'sql'				=> "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryImageSize'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryImageSize'],
	'exclude'			=> true,
	'inputType'			=> 'imageSize',
	'options'			=> $GLOBALS['TL_CROP'],
	'reference'			=> &$GLOBALS['TL_LANG']['MSC'],
	'eval'				=> array('rgxp' => 'digit', 'nospace' => true, 'helpwizard' => true, 'tl_class' => 'w50'),
	'sql'				=> "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryFullsize'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryFullsize'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'eval'				=> array('tl_class' => 'w50 m12'),
	'sql'				=> "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryNumberOfItems'] = array
(
  	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryNumberOfItems'],
	'exclude'			=> true,
  	'inputType'			=> 'text',
  	'eval'				=> array('maxlength' => 4, 'rgxp' => 'digit'),
	'sql'				=> "smallint(5) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsFitWidth'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsFitWidth'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
//	'eval'				=> array('submitOnChange' => true, 'tl_class' => 'w50'),
	'sql'				=> "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryColumnWidthSelect'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options'			=> array('fixed', 'class'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect'],
	'eval'				=> array('helpwizard' => true, 'submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'clr w50'),
	'sql'				=> "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryColumnWidth'] = array
(
  	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidth'],
	'exclude'			=> true,
	'inputType'			=> 'inputUnit',
	'options'			=> array('px'),
	'eval'				=> array('maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
	'sql'				=> "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryColumnWidthClass'] = array
(
  	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthClass'],
	'exclude'			=> true,
  	'inputType'			=> 'text',
  	'eval'				=> array('maxlength' => 64, 'rgxp' => 'extnd'),
	'sql'				=> "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGutterSelect'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options'			=> array('fixed', 'class'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect'],
	'eval'				=> array('helpwizard' => true, 'submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'clr w50'),
	'sql'				=> "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGutter'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutter'],
	'exclude'			=> true,
	'inputType'			=> 'inputUnit',
	'options'			=> array('px'),
	'eval'				=> array('maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'),
	'sql'				=> "varchar(64) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGutterClass'] = array
(
  	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterClass'],
	'exclude'			=> true,
  	'inputType'			=> 'text',
  	'eval'				=> array('maxlength' => 64, 'rgxp' => 'extnd', 'tl_class' => 'w50'),
	'sql'				=> "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsOriginLeft'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'default'			=> 'left',
	'options'			=> array('left', 'right'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft'],
	'eval'				=> array('tl_class' => 'clr w50'),
	'sql'				=> "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsOriginTop'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'default'			=> 'top',
	'options'			=> array('top', 'bottom'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop'],
	'eval'				=> array('tl_class' => 'w50'),
	'sql'				=> "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsResizeBound'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsResizeBound'],
	'exclude'			=> true,
	'inputType'			=> 'checkbox',
	'eval'				=> array('tl_class' => 'w50 m12'),
	'sql'				=> "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryTransitionDuration'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryTransitionDuration'],
	'exclude'			=> true,
	'inputType'			=> 'text',
	'eval'				=> array('maxlength' => 10, 'rgxp' => 'digit', 'tl_class' => 'w50'),
	'sql'				=> "int(10) NOT NULL default '400'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryThemeSelect'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'default'			=> 'default',
	'default'			=> 'standard',
	'options'			=> array('standard', 'external'),
	'reference'			=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect'],
	'eval'				=> array('submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'),
	'sql'				=> "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryThemeSRC'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSRC'],
	'exclude'			=> true,
	'inputType'			=> 'fileTree',
	'eval'				=> array('fieldType' => 'radio', 'extensions' => 'css', 'filesOnly' => true, 'tl_class' => 'w50'),
	'sql'				=> "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryHtmlTpl'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryHtmlTpl'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options_callback'	=> function() { return Backend::getTemplateGroup('ce_masonry'); },
	'eval'				=> array('maxlength' => 255, 'tl_class' => 'w50 clr'),
	'sql'				=> "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryJsTpl'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryJsTpl'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options_callback'	=> function() { return Backend::getTemplateGroup('js_masonry'); },
	'eval'				=> array('maxlength' => 255, 'tl_class' => 'w50'),
	'sql'				=> "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGalleryTpl'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_content']['dk_msryGalleryTpl'],
	'exclude'			=> true,
	'inputType'			=> 'select',
	'options_callback'	=> function() { return Backend::getTemplateGroup('masonry_gallery'); },
	'eval'				=> array('maxlength' => 255, 'tl_class' => 'w50'),
	'sql'				=> "varchar(255) NOT NULL default ''"
);
