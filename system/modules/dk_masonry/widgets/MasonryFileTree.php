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
 * Class MasonryFileTree
 *
 * @copyright  Dirk Klemmt 2013
 * @author     Dirk Klemmt
 * @package    masonry
 */
class MasonryFileTree extends \FileTree
{

	/**
	 * Load the database object
	 * @param array
	 */
	public function __construct($arrAttributes=null)
	{
		parent::__construct($arrAttributes);

		// masonry gallery is a gallerie as well
		$this->blnIsGallery = ($this->activeRecord->type == ('masonry_gallery'));
	}


	/**
	 * Generate the widget and return it as string
	 *
	 * @return string
	 */
	public function generate()
	{
		return parent::generate();
	}
}
