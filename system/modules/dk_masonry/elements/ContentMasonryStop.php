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
 * Class ContentMasonryStop 
 *
 * Front end content element "masonry_stop" (wrapper stop).
 *
 * @copyright  Dirk Klemmt 2013-2014
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
			// search for first visible masonry start element with a position before end element
			$objStartElement = \Database::getInstance()
				->prepare("SELECT id, dk_msryHtmlTpl
						   FROM   tl_content
						   WHERE  type = 'masonry_start' AND pid = ? AND sorting < ? AND invisible != '1'
						   ORDER  by sorting DESC")
				->limit(1)
				->execute($this->pid, $this->sorting);

			if ($objStartElement->numRows < 1)
			{
				$this->log('masonry start element is missing!', 'ContentMasonryStop compile()', TL_ERROR);
				return;
			}

			// replace default (HTML) template with the one from masonry start element
			if (isset($objStartElement->dk_msryHtmlTpl) && $objStartElement->dk_msryHtmlTpl != '')
			{
				$this->strTemplate = $objStartElement->dk_msryHtmlTpl;
			}
			
			// --- create FE template for carouFredSel element
			$this->Template = new \FrontendTemplate($this->strTemplate);
			$this->Template->setData($this->arrData);
			$this->Template->id = $objStartElement->id;
		}
		else
		{
			$this->strTemplate = 'be_wildcard';
			$this->Template = new \BackendTemplate($this->strTemplate);
		}
	}
}
