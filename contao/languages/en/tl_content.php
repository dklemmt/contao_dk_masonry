<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

/*
 * Legends
 */
$GLOBALS['TL_LANG']['tl_content']['masonry_image_legend'] = 'Image settings';
$GLOBALS['TL_LANG']['tl_content']['masonry_layout_legend'] = 'Layout settings';
$GLOBALS['TL_LANG']['tl_content']['masonry_themes_legend'] = 'Behavior and design';
$GLOBALS['TL_LANG']['tl_content']['masonry_template_legend'] = 'Template settings';

/*
 * Fields
 */
$GLOBALS['TL_LANG']['tl_content']['dk_msryMultiSRC'] = &$GLOBALS['TL_LANG']['tl_content']['multiSRC'];
$GLOBALS['TL_LANG']['tl_content']['dk_msrySortBy'] = &$GLOBALS['TL_LANG']['tl_content']['sortBy'];

$GLOBALS['TL_LANG']['tl_content']['dk_msryImageSize'] = &$GLOBALS['TL_LANG']['MSC']['imgSize'];
$GLOBALS['TL_LANG']['tl_content']['dk_msryFullsize'] = &$GLOBALS['TL_LANG']['tl_content']['fullsize'];
$GLOBALS['TL_LANG']['tl_content']['dk_msryNumberOfItems'] = ['Number of items', 'Here you can limit the total number of items. Set to 0 to show all.'];

$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect'][0] = 'Column width definition';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect'][1] = 'Defines how the width of a column is determined. If nothing is defined the width of the first element will be used.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidth'][0] = 'Column width';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidth'][1] = 'Defines the column width in pixels.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthClass'][0] = 'CSS class for column size';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthClass'][1] = 'The column width will be defined in the given CSS class.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect'][0] = 'Horizontal gutter definition';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect'][1] = 'Defines how the horizontal gutter between the columns is defined. The vertical gutter is defined with CSS margins.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutter'][0] = 'Horizontal gutter width';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutter'][1] = 'Horzontal gutter in pixels between two columns.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterClass'][0] = 'CSS class for gutter size';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterClass'][1] = 'The gutter width will be defined in the given CSS class.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft'][0] = 'Horizontal alignment';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft'][1] = 'Defines whether the elements start on the left or right side.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop'][0] = 'Vertical alignment';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop'][1] = 'Defines whether the elements start on the top or bottom.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsFitWidth'][0] = 'Center Masonry';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsFitWidth'][1] = 'If set, the Masontry container will be centered within its parent. This only works with fixed values for the column or element widths.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsResizeBound'][0] = 'Update layout';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsResizeBound'][1] = 'Executes a layout update whenever the browser window is resized.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryTransitionDuration'][0] = 'Transition duration';
$GLOBALS['TL_LANG']['tl_content']['dk_msryTransitionDuration'][1] = 'Defines the duration of the transition during a layout change in milliseconds. Use 0 if you want no transition.';

$GLOBALS['TL_LANG']['tl_content']['dk_msryHtmlTpl'][0] = 'HTML template';
$GLOBALS['TL_LANG']['tl_content']['dk_msryHtmlTpl'][1] = 'You can choose an HTML template here.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryJsTpl'][0] = 'JavaScript template';
$GLOBALS['TL_LANG']['tl_content']['dk_msryJsTpl'][1] = 'You can choose a JavaScript template here.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect'][0] = 'Masonry theme';
$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect'][1] = 'You can choose an optionsl theme for the Masonry here.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSRC'][0] = 'External CSS files';
$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSRC'][1] = 'Choose an external CSS file for the Masonry styling here.';

/*
 * References
 */
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect']['fixed'][0] = 'fixed';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect']['fixed'][1] = 'The width of the column will be fixed in pixels. The element width should additionally be defined via CSS. The elements will not be scaled if the viewport changes.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect']['class'][0] = 'CSS class';
$GLOBALS['TL_LANG']['tl_content']['dk_msryColumnWidthSelect']['class'][1] = 'The column width will be defined in the given CSS class. You can also use relative values here. This setting is recommended for "responsive" layouts since you can defined different sizes via media queries.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect']['fixed'][0] = 'fixed';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect']['fixed'][1] = 'The gutter with will be fixed in pixels.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect']['class'][0] = 'CSS class';
$GLOBALS['TL_LANG']['tl_content']['dk_msryGutterSelect']['class'][1] = 'The horizontal gutter width will be defined in the given CSS class. You can also use relative values here. This setting is recommended for "responsive" layouts since you can defined different sizes via media queries.';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft']['left'][0] = 'left';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginLeft']['right'][0] = 'right';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop']['top'][0] = 'top';
$GLOBALS['TL_LANG']['tl_content']['dk_msryIsOriginTop']['bottom'][0] = 'bottom';
$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect']['standard'][0] = 'light (Standard)';
$GLOBALS['TL_LANG']['tl_content']['dk_msryThemeSelect']['external'][0] = 'use external CSS theme';
