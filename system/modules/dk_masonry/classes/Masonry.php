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
 * Namespace
 */
namespace Dirch\masonry;


/**
 * Class Masonry
 *
 * @copyright  Dirk Klemmt 2013-2014
 * @author     Dirk Klemmt
 * @package    masonry
 */
class Masonry extends \Frontend 
{

	public function createTemplateData(\Template $objTemplateHtml, \Template $objTemplateJs)
	{
		$objMasonry = \ContentModel::findByPk($objTemplateHtml->id);
		if ($objMasonry === null)
		{
			return;
		}

		$objTemplateJs->type = $objMasonry->type;

		switch ($objMasonry->dk_msryColumnWidthSelect)
		{
			case 'fixed':
				// Masonry option 'columnWidth': default value is width of the first element
				$columnWidth = unserialize($objMasonry->dk_msryColumnWidth);
				if (isset($columnWidth['value']) && $columnWidth['value'] != '')
				{
					switch ($columnWidth['unit'])
					{
						case 'px':
							$objTemplateJs->columnWidth = 'columnWidth: ' . $columnWidth['value'];
							break;
					}
				}
				break;

			case 'class':
				if (isset($objMasonry->dk_msryColumnWidthClass) && $objMasonry->dk_msryColumnWidthClass != '')
				{
					$objTemplateJs->columnWidthClass = $objMasonry->dk_msryColumnWidthClass;
					$objTemplateJs->columnWidth = 'columnWidth: \'.' . $objMasonry->dk_msryColumnWidthClass . '\'';
				}
				break;
		}

		switch ($objMasonry->dk_msryGutterSelect)
		{
			case 'fixed':
				// Masonry option 'gutter': default value is '0'
				$gutter = unserialize($objMasonry->dk_msryGutter);
				if (isset($gutter['value']) && $gutter['value'] != '')
				{
					switch ($gutter['unit'])
					{
						case 'px':
							$objTemplateJs->gutter = 'gutter: ' . $gutter['value'];
							break;
					}
				}
				break;

			case 'class':
				if (isset($objMasonry->dk_msryGutterClass) && $objMasonry->dk_msryGutterClass != '')
				{
					$objTemplateJs->gutterClass = $objMasonry->dk_msryGutterClass;
					$objTemplateJs->gutter = 'gutter: \'.' . $objMasonry->dk_msryGutterClass . '\'';
				}
				break;
		}

		// Masonry option 'isOriginLeft': default value is 'true'
		if ($objMasonry->dk_msryIsOriginLeft != 'left')
		{
			$objTemplateJs->isOriginLeft = 'isOriginLeft: false';
		}

		// Masonry option 'isOriginTop': default value is 'true'
		if ($objMasonry->dk_msryIsOriginTop != 'top')
		{
			$objTemplateJs->isOriginTop = 'isOriginTop: false';
		}

		// Masonry option 'isFitWidth': default value is 'false'
		if ($objMasonry->dk_msryIsFitWidth)
		{
			$objTemplateJs->isFitWidth = 'isFitWidth: true';
		}

		// Masonry option 'isResizeBound': default value is 'true'
		if (!$objMasonry->dk_msryIsResizeBound)
		{
			$objTemplateJs->isResizeBound = 'isResizeBound: false';
		}

		// Masonry option 'transitionDuratio': default value is '400'
		if ($objMasonry->dk_msryTransitionDuration != '400')
		{
			$objTemplateJs->transitionDuration = 'transitionDuration: "' . $objMasonry->dk_msryTransitionDuration . 'ms"';
		}

		// ... global css file
		$GLOBALS['TL_CSS'][] = 'system/modules/dk_masonry/assets/css/masonry.css||static';

		// ... theme css file
		if (isset($objTemplateHtml->dk_msryThemeSelect) && $objTemplateHtml->dk_msryThemeSelect != '')
		{
			if ($objTemplateHtml->dk_msryThemeSelect == 'external')
			{
				$objFile = \FilesModel::findByPk($objTemplateHtml->dk_msryThemeSRC);  
				if ($objFile !== null && is_file(TL_ROOT . '/' . $objFile->path))
				{
					$GLOBALS['TL_CSS'][] = $objFile->path . '||static';
				}
			}
			else
			{
				$GLOBALS['TL_CSS'][] = 'system/modules/dk_masonry/assets/themes/' . $objTemplateHtml->dk_msryThemeSelect . '/css/' . $objTemplateHtml->dk_msryThemeSelect . '.css||static';
			}
		}

		// ... the masonry javascript itselfs
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/dk_masonry/assets/js/masonry.pkgd.min.js|static';

		// ... element dependent javascript caller
		$GLOBALS['TL_JQUERY'][] = $objTemplateJs->parse();					

		// helper stuff:

		// ... images loaded javascript trigger mode
		$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/dk_masonry/assets/js/imagesloaded.pkgd.min.js|static';
	}
}
