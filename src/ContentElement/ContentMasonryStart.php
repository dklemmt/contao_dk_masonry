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
use Contao\FrontendTemplate;
use Contao\System;
use Dirch\ContaoMasonry\Masonry;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContentMasonryStart.
 *
 * Front end content element "masonry_start" (wrapper start).
 *
 * @copyright  Dirk Klemmt 2013-2016
 */
class ContentMasonryStart extends ContentElement
{
    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplate = 'ce_masonry';

    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplateJs = 'js_masonry';

    /**
     * @return string
     */
    public function generate()
    {
        // replace default (HTML) template with chosen one
        if ($this->dk_msryHtmlTpl) {
            $this->strTemplate = $this->dk_msryHtmlTpl;
        }

        // replace default (JS) template with chosen one
        if ($this->dk_msryJsTpl) {
            $this->strTemplateJs = $this->dk_msryJsTpl;
        }

        return parent::generate();
    }

    /**
     * Generate the content element.
     */
    protected function compile(): void
    {
        /** @var ScopeMatcher $scopeMatcher */
        $scopeMatcher = System::getContainer()->get('contao.routing.scope_matcher');
        /** @var Request|null $request */
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && $scopeMatcher->isFrontendRequest($request)) {
            // --- create FE template for masonry element
            $this->Template = new FrontendTemplate($this->strTemplate);
            $this->Template->setData($this->arrData);

            // --- create FE template for javascript caller
            $objTemplateJs = new FrontendTemplate($this->dk_msryJsTpl);
            $objTemplateJs->id = $this->id;

            Masonry::createTemplateData($this->Template, $objTemplateJs);
        } else {
            $this->strTemplate = 'be_wildcard';
            $this->Template = new BackendTemplate($this->strTemplate);
            $this->Template->title = $this->headline;
        }
    }
}
