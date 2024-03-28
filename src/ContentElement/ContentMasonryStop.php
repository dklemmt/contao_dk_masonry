<?php

declare(strict_types=1);

/*
 * This file is part of the Contao Masonry extension.
 *
 * (c) Dirk Klemmt
 * (c) Fritz Michael Gschwantner
 */

namespace Dirch\ContaoMasonry\ContentElement;

use Contao\BackendTemplate;
use Contao\ContentElement;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\Database;
use Contao\FrontendTemplate;
use Contao\System;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContentMasonryStop.
 *
 * Front end content element "masonry_stop" (wrapper stop).
 *
 * @copyright  Dirk Klemmt 2013-2016
 */
class ContentMasonryStop extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_masonry';

    /**
     * Generate the content element.
     */
    protected function compile(): void
    {
        $container = System::getContainer();
        /** @var ScopeMatcher $scopeMatcher */
        $scopeMatcher = $container->get('contao.routing.scope_matcher');
        /** @var Request|null $request */
        $request = $container->get('request_stack')->getCurrentRequest();

        if ($request && $scopeMatcher->isFrontendRequest($request)) {
            // search for first visible masonry start element with a position before end element
            $objStartElement = Database::getInstance()
                ->prepare("SELECT id, dk_msryHtmlTpl
						   FROM   tl_content
						   WHERE  type = 'masonry_start' AND pid = ? AND sorting < ? AND invisible != '1'
						   ORDER  by sorting DESC")
                ->limit(1)
                ->execute($this->pid, $this->sorting)
            ;

            if ($objStartElement->numRows < 1) {
                /** @var LoggerInterface|null $logger */
                if ($logger = $container->get('monolog.logger.contao.error')) {
                    $logger->error('masonry start element is missing!');
                }

                return;
            }

            // replace default (HTML) template with the one from masonry start element
            if (isset($objStartElement->dk_msryHtmlTpl) && '' !== $objStartElement->dk_msryHtmlTpl) {
                $this->strTemplate = $objStartElement->dk_msryHtmlTpl;
            }

            // --- create FE template for carouFredSel element
            $this->Template = new FrontendTemplate($this->strTemplate);
            $this->Template->setData($this->arrData);
            $this->Template->id = $objStartElement->id;
        } else {
            $this->strTemplate = 'be_wildcard';
            $this->Template = new BackendTemplate($this->strTemplate);
        }
    }
}
