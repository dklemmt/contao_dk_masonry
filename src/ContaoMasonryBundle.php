<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

namespace Dirch\ContaoMasonry;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoMasonryBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
