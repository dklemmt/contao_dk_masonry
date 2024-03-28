<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

use Dirch\ContaoMasonry\ContentElement\ContentMasonryGallery;
use Dirch\ContaoMasonry\ContentElement\ContentMasonryStart;
use Dirch\ContaoMasonry\ContentElement\ContentMasonryStop;

/*
 * Content elements
 */
$GLOBALS['TL_CTE']['masonry_category'] = [
    'masonry_gallery' => ContentMasonryGallery::class,
    'masonry_start' => ContentMasonryStart::class,
    'masonry_stop' => ContentMasonryStop::class,
];

/*
 * Wrapper elements
 */
$GLOBALS['TL_WRAPPERS']['start'][] = 'masonry_start';
$GLOBALS['TL_WRAPPERS']['stop'][] = 'masonry_stop';
