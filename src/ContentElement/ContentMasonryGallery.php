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
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\File;
use Contao\FilesModel;
use Contao\FrontendTemplate;
use Contao\Model\Collection;
use Contao\StringUtil;
use Contao\System;
use Dirch\ContaoMasonry\Masonry;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ContentMasonryGallery.
 *
 * Front end content element "masonry_gallery".
 *
 * @copyright  Dirk Klemmt 2013-2016
 */
class ContentMasonryGallery extends ContentElement
{
    /**
     * Files object.
     *
     * @var Collection
     */
    protected $objFiles;

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
    protected $strTemplateJs = 'masonry_js';

    /**
     * Template.
     *
     * @var string
     */
    protected $strTemplateGallery = 'masonry_gallery';

    /**
     * Return if there are no files.
     *
     * @return string
     */
    public function generate()
    {
        $this->multiSRC = StringUtil::deserialize($this->dk_msryMultiSRC, true);

        // Return if there are no files
        if (!$this->multiSRC) {
            return '';
        }

        // Get the file entries from the database
        $this->objFiles = FilesModel::findMultipleByUuids($this->multiSRC);

        if (null === $this->objFiles) {
            return '';
        }

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
        $images = [];
        $objFiles = $this->objFiles;
        $container = System::getContainer();
        /** @var Studio $studio */
        $studio = $container->get('contao.image.studio');
        $projectDir = $container->getParameter('kernel.project_dir');

        // Get all images
        while ($objFiles->next()) {
            // Continue if the files has been processed or does not exist
            /** @var FilesModel $objFiles */
            if (isset($images[$objFiles->path]) || !file_exists($projectDir.'/'.$objFiles->path)) {
                continue;
            }

            // Single files
            if ('file' === $objFiles->type) {
                $objFile = new File($objFiles->path, true);

                if (!$objFile->isImage) {
                    continue;
                }

                // Add the image
                $images[$objFiles->path] = [
                    'id' => $objFiles->id,
                    'uuid' => $objFiles->uuid,
                    'name' => $objFile->basename,
                    'singleSRC' => $objFiles->path,
                    'filesModel' => $objFiles->current(),
                    'mtime' => $objFile->mtime,
                ];
            } else {
                // Folders
                $objSubfiles = FilesModel::findByPid($objFiles->uuid);

                if (null === $objSubfiles) {
                    continue;
                }

                while ($objSubfiles->next()) {
                    // Skip subfolders
                    if ('folder' === $objSubfiles->type || !file_exists($projectDir.'/'.$objSubfiles->path)) {
                        continue;
                    }

                    $objFile = new File($objSubfiles->path, true);

                    if (!$objFile->isImage) {
                        continue;
                    }

                    // Add the image
                    $images[$objSubfiles->path] = [
                        'id' => $objSubfiles->id,
                        'uuid' => $objSubfiles->uuid,
                        'name' => $objFile->basename,
                        'singleSRC' => $objSubfiles->path,
                        'filesModel' => $objSubfiles->current(),
                        'mtime' => $objFile->mtime,
                    ];
                }
            }
        }

        // Sort array
        switch ($this->dk_msrySortBy) {
            case 'name_asc':
                usort($images, static fn (array $a, array $b): int => strnatcasecmp($a['name'], $b['name']));
                break;

            case 'name_desc':
                usort($images, static fn (array $a, array $b): int => strnatcasecmp($b['name'], $a['name']));
                break;

            case 'date_asc':
                usort($images, static fn (array $a, array $b): int => $a['mtime'] - $b['mtime']);
                break;

            case 'date_desc':
                usort($images, static fn (array $a, array $b): int => $b['mtime'] - $a['mtime']);
                break;

            case 'random':
                shuffle($images);
                break;
        }

        $images = array_values($images);

        // Limit the total number of items
        if ($this->dk_msryNumberOfItems > 0) {
            $images = \array_slice($images, 0, $this->dk_msryNumberOfItems);
        }

        $strLightboxId = 'lightbox[lb'.$this->id.']';
        $body = [];

        // create images
        for ($i = 0; $i < \count($images); ++$i) {
            $figure = $studio->createFigureBuilder()
                ->from($images[$i]['singleSRC'])
                ->setSize($this->dk_msryImageSize)
                ->enableLightbox((bool) $this->dk_msryFullsize)
                ->setLightboxGroupIdentifier($strLightboxId)
                ->buildIfResourceExists()
            ;

            if (!$figure) {
                continue;
            }

            $body[$i] = (object) $figure->getLegacyTemplateData();
        }

        $objTemplate = new FrontendTemplate($this->strTemplateGallery);
        $objTemplate->setData($this->arrData);

        $objTemplate->body = $body;

        /** @var ScopeMatcher $scopeMatcher */
        $scopeMatcher = $container->get('contao.routing.scope_matcher');
        /** @var Request|null $request */
        $request = $container->get('request_stack')->getCurrentRequest();

        if ($request && $scopeMatcher->isFrontendRequest($request)) {
            $this->Template->images = $objTemplate->parse();

            // --- create FE template for javascript caller
            $objTemplateJs = new FrontendTemplate($this->strTemplateJs);

            // (unique) Element id will be used for unique HTML id element
            $objTemplateJs->id = $this->id;

            Masonry::createTemplateData($this->Template, $objTemplateJs);
        } else {
            $this->strTemplate = 'be_masonry';
            $this->Template = new BackendTemplate($this->strTemplate);
            $this->Template->images = $objTemplate->parse();

            // for BE styling include masonry CSS file
            if ($request && $scopeMatcher->isBackendRequest($request)) {
                $GLOBALS['TL_CSS'][] = 'bundles/contaomasonry/css/masonry.css';
            }
        }
    }
}
