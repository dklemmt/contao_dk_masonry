<?php 

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package   masonry
 * @author    Dirk Klemmt
 * @license   MIT
 * @copyright Dirk Klemmt 2013
 */


/**
 * Namespace
 */
namespace Dirch\masonry;


/**
 * Class ContentMasonryStop 
 *
 * Front end content element "masonry_stop" (wrapper stop).
 * @copyright  Dirk Klemmt 2013
 * @author     Dirk Klemmt
 * @package    masonry
 */
class ContentMasonryStop extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_masonry';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		if (TL_MODE == 'FE')
		{
			// --- create FE template for carouFredSel element
			$this->Template = new \FrontendTemplate($this->strTemplate);
			$this->Template->setData($this->arrData);
			$this->Template->id = $objStartElement->id;
		}
		else
		{
			$this->strTemplate = 'be_wildcard';
			$this->Template = new \BackendTemplate($this->strTemplate);
			if (version_compare(VERSION, '3.1', '<'))
			{ 
				$this->Template->wildcard = '### MASONRY WRAPPER STOP ###';
			} 
		}
	}
}
