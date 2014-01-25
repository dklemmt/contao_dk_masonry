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
 * Class ContentMasonryStart 
 *
 * Front end content element "masonry_start" (wrapper start).
 *
 * @copyright  Dirk Klemmt 2013-2014
 * @author     Dirk Klemmt
 * @package    masonry
 */
class ContentMasonryStart extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_masonry';


	/**
	 * Template
	 * @var string
	 */
	protected $strTemplateJs = 'js_masonry';


	/**
	 * @return string
	 */
	public function generate()
	{
		// replace default (HTML) template with chosen one
		if ($this->dk_msryHtmlTpl)
		{
			$this->strTemplate = $this->dk_msryHtmlTpl;
		}

		// replace default (JS) template with chosen one
		if ($this->dk_msryJsTpl)
		{
			$this->strTemplateJs = $this->dk_msryJsTpl;
		}

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		if (TL_MODE == 'FE')
		{
			// --- create FE template for masonry element
			$this->Template = new \FrontendTemplate($this->strTemplate);
			$this->Template->setData($this->arrData);

			// --- create FE template for javascript caller
			$objTemplateJs = new \FrontendTemplate($this->dk_msryJsTpl);
			$objTemplateJs->id = $this->id;

			$masonry = new Masonry();
			$masonry->createTemplateData($this->Template, $objTemplateJs);
		}
		else
		{
			$this->strTemplate = 'be_wildcard';
			$this->Template = new \BackendTemplate($this->strTemplate);
			$this->Template->title = $this->headline;
		}
	}
}
