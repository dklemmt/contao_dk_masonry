<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

namespace Dirch\ContaoMasonry;

use Contao\ContentModel;
use Contao\FilesModel;
use Contao\Frontend;
use Contao\System;
use Contao\Template;

/**
 * Class Masonry.
 *
 * @copyright  Dirk Klemmt 2013-2016
 */
class Masonry extends Frontend
{
    public static function createTemplateData(Template $objTemplateHtml, Template $objTemplateJs): void
    {
        $objMasonry = ContentModel::findById($objTemplateHtml->id);
        if (null === $objMasonry) {
            return;
        }

        $objTemplateJs->type = $objMasonry->type;

        switch ($objMasonry->dk_msryColumnWidthSelect) {
            case 'fixed':
                // Masonry option 'columnWidth': default value is width of the first element
                $columnWidth = unserialize($objMasonry->dk_msryColumnWidth);
                if (isset($columnWidth['value']) && '' !== $columnWidth['value']) {
                    switch ($columnWidth['unit']) {
                        case 'px':
                            $objTemplateJs->columnWidth = 'columnWidth: '.$columnWidth['value'];
                            break;
                    }
                }
                break;

            case 'class':
                if (isset($objMasonry->dk_msryColumnWidthClass) && '' !== $objMasonry->dk_msryColumnWidthClass) {
                    $objTemplateJs->columnWidthClass = $objMasonry->dk_msryColumnWidthClass;
                    $objTemplateJs->columnWidth = "columnWidth: '.".$objMasonry->dk_msryColumnWidthClass."'";
                }
                break;
        }

        switch ($objMasonry->dk_msryGutterSelect) {
            case 'fixed':
                // Masonry option 'gutter': default value is '0'
                $gutter = unserialize($objMasonry->dk_msryGutter);
                if (isset($gutter['value']) && '' !== $gutter['value']) {
                    switch ($gutter['unit']) {
                        case 'px':
                            $objTemplateJs->gutter = 'gutter: '.$gutter['value'];
                            break;
                    }
                }
                break;

            case 'class':
                if (isset($objMasonry->dk_msryGutterClass) && '' !== $objMasonry->dk_msryGutterClass) {
                    $objTemplateJs->gutterClass = $objMasonry->dk_msryGutterClass;
                    $objTemplateJs->gutter = "gutter: '.".$objMasonry->dk_msryGutterClass."'";
                }
                break;
        }

        // Masonry option 'isOriginLeft': default value is 'true'
        if ('left' !== $objMasonry->dk_msryIsOriginLeft) {
            $objTemplateJs->isOriginLeft = 'isOriginLeft: false';
        }

        // Masonry option 'isOriginTop': default value is 'true'
        if ('top' !== $objMasonry->dk_msryIsOriginTop) {
            $objTemplateJs->isOriginTop = 'isOriginTop: false';
        }

        // Masonry option 'isFitWidth': default value is 'false'
        if ($objMasonry->dk_msryIsFitWidth) {
            $objTemplateJs->isFitWidth = 'isFitWidth: true';
        }

        // Masonry option 'isResizeBound': default value is 'true'
        if (!$objMasonry->dk_msryIsResizeBound) {
            $objTemplateJs->isResizeBound = 'isResizeBound: false';
        }

        // Masonry option 'transitionDuration': default value is '400'
        if ('400' !== $objMasonry->dk_msryTransitionDuration) {
            $objTemplateJs->transitionDuration = 'transitionDuration: "'.$objMasonry->dk_msryTransitionDuration.'ms"';
        }

        // ... global css file
        $GLOBALS['TL_CSS'][] = 'bundles/contaomasonry/css/masonry.css||static';

        // ... theme css file
        if (isset($objTemplateHtml->dk_msryThemeSelect) && '' !== $objTemplateHtml->dk_msryThemeSelect) {
            if ('external' === $objTemplateHtml->dk_msryThemeSelect) {
                $objFile = FilesModel::findById($objTemplateHtml->dk_msryThemeSRC);
                if (null !== $objFile && is_file(System::getContainer()->getParameter('kernel.project_dir').'/'.$objFile->path)) {
                    $GLOBALS['TL_CSS'][] = $objFile->path.'||static';
                }
            } else {
                $GLOBALS['TL_CSS'][] = 'bundles/contaomasonry/themes/'.$objTemplateHtml->dk_msryThemeSelect.'/css/'.$objTemplateHtml->dk_msryThemeSelect.'.css||static';
            }
        }

        // ... the masonry javascript itself
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaomasonry/js/masonry.pkgd.min.js|static';

        // ... element dependent javascript caller
        $GLOBALS['TL_JQUERY'][] = $objTemplateJs->parse();

        // helper stuff:

        // ... images loaded javascript trigger mode
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaomasonry/js/imagesloaded.pkgd.min.js|static';
    }
}
