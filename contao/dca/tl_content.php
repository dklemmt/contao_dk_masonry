<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

use Contao\Backend;
use Contao\System;

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dk_msryColumnWidthSelect';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dk_msryGutterSelect';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'dk_msryThemeSelect';

$GLOBALS['TL_DCA']['tl_content']['palettes']['masonry_gallery'] = '{type_legend},type,headline;{source_legend},dk_msryMultiSRC,dk_msrySortBy,metaIgnore;{masonry_image_legend},dk_msryImageSize,dk_msryFullsize,dk_msryNumberOfItems;{masonry_layout_legend},dk_msryIsFitWidth,dk_msryColumnWidthSelect,dk_msryGutterSelect,dk_msryIsOriginLeft,dk_msryIsOriginTop;{masonry_themes_legend},dk_msryIsResizeBound,dk_msryTransitionDuration,dk_msryThemeSelect;{masonry_template_legend},dk_msryHtmlTpl,dk_msryJsTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['masonry_start'] = '{type_legend},type,headline;{masonry_layout_legend},dk_msryIsFitWidth,dk_msryColumnWidthSelect,dk_msryGutterSelect,dk_msryIsOriginLeft,dk_msryIsOriginTop;{masonry_themes_legend},dk_msryIsResizeBound,dk_msryTransitionDuration,dk_msryThemeSelect;{masonry_template_legend},dk_msryHtmlTpl,dk_msryJsTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryColumnWidthSelect_fixed'] = 'dk_msryColumnWidth';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryColumnWidthSelect_class'] = 'dk_msryColumnWidthClass';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryGutterSelect_fixed'] = 'dk_msryGutter';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryGutterSelect_class'] = 'dk_msryGutterClass';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['dk_msryThemeSelect_external'] = 'dk_msryThemeSRC';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryMultiSRC'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryMultiSRC'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['multiple' => true,
        'fieldType' => 'checkbox',
        'files' => true,
        'isGallery' => true,
        'extensions' => '%contao.image.valid_extensions%',
        'mandatory' => true,
        'isSortable' => true,
    ],
    'sql' => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msrySortBy'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msrySortBy'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => [
        'custom',
        'name_asc',
        'name_desc',
        'date_asc',
        'date_desc',
        'random',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryImageSize'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryImageSize'],
    'exclude' => true,
    'inputType' => 'imageSize',
    'options_callback' => static fn (): array => System::getContainer()->get('contao.image.sizes')->getAllOptions(),
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval' => ['rgxp' => 'natural',
        'includeBlankOption' => true,
        'nospace' => true,
        'helpwizard' => true,
        'tl_class' => 'w50',
    ],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryFullsize'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryFullsize'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryNumberOfItems'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryNumberOfItems'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => [
        'maxlength' => 4,
        'rgxp' => 'digit',
        'tl_class' => 'w50',
    ],
    'sql' => "smallint(5) unsigned NOT NULL default '0'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsFitWidth'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsFitWidth'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryColumnWidthSelect'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['fixed', 'class'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect'],
    'eval' => ['helpwizard' => true, 'submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'clr w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryColumnWidth'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidth'],
    'exclude' => true,
    'inputType' => 'inputUnit',
    'options' => ['px'],
    'eval' => ['maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryColumnWidthClass'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthClass'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['maxlength' => 64, 'rgxp' => 'extnd'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGutterSelect'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect'],
    'exclude' => true,
    'inputType' => 'select',
    'options' => ['fixed', 'class'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect'],
    'eval' => ['helpwizard' => true, 'submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGutter'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutter'],
    'exclude' => true,
    'inputType' => 'inputUnit',
    'options' => ['px'],
    'eval' => ['maxlength' => 4, 'rgxp' => 'digit', 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default '0'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGutterClass'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterClass'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['maxlength' => 64, 'rgxp' => 'extnd', 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsOriginLeft'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft'],
    'exclude' => true,
    'inputType' => 'select',
    'default' => 'left',
    'options' => ['left', 'right'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft'],
    'eval' => ['tl_class' => 'clr w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsOriginTop'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop'],
    'exclude' => true,
    'inputType' => 'select',
    'default' => 'top',
    'options' => ['top', 'bottom'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop'],
    'eval' => ['tl_class' => 'w50'],
    'sql' => "varchar(32) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryIsResizeBound'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryIsResizeBound'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50'],
    'sql' => "char(1) NOT NULL default '1'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryTransitionDuration'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryTransitionDuration'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['maxlength' => 10, 'rgxp' => 'digit', 'tl_class' => 'clr w50'],
    'sql' => "int(10) NOT NULL default '400'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryThemeSelect'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect'],
    'exclude' => true,
    'inputType' => 'select',
    'default' => 'standard',
    'options' => ['standard', 'external'],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect'],
    'eval' => ['submitOnChange' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryThemeSRC'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSRC'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['fieldType' => 'radio', 'extensions' => 'css', 'filesOnly' => true, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryHtmlTpl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryHtmlTpl'],
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => static fn () => Backend::getTemplateGroup('ce_masonry'),
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50 clr'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryJsTpl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryJsTpl'],
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => static fn () => Backend::getTemplateGroup('masonry_js'),
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['dk_msryGalleryTpl'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_content']['dk_msryGalleryTpl'],
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => static fn () => Backend::getTemplateGroup('masonry_gallery'),
    'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql' => "varchar(255) NOT NULL default ''",
];
