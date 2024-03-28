<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

namespace Dirch\ContaoMasonry\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Dirch\ContaoMasonry\ContaoMasonryBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoMasonryBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
