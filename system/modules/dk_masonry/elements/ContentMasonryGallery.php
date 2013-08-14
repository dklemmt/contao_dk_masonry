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
 * Class ContentMasonryGallery
 *
 * Front end content element "masonry_gallery".
 *
 * @copyright  Dirk Klemmt 2013
 * @author     Dirk Klemmt
 * @package    masonry
 */
class ContentMasonryGallery extends \ContentElement
{

	/**
	 * Files object
	 * @var \FilesModel
	 */
	protected $objFiles;


	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_masonry';


	/**
	 * Template
	 * @var string
	 */
	protected $strTemplateGallery = 'masonry_gallery';


	/**
	 * Return if there are no files
	 *
	 * @return string
	 */
	public function generate()
	{
		$this->multiSRC = deserialize($this->dk_msryMultiSRC);

		// Return if there are no files
		if (!is_array($this->multiSRC) || empty($this->multiSRC))
		{
			return '';
		}

		// Get the file entries from the database
		$this->objFiles = \FilesModel::findMultipleByIds($this->multiSRC);

		if ($this->objFiles === null)
		{
			return '';
		}

		// replace default (HTML) template with chosen one
		if ($this->dk_msryHtmlTpl)
		{
			$this->strTemplate = $this->dk_msryHtmlTpl;
		}

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		global $objPage;

		$images = array();
		$auxDate = array();
		$auxId = array();
		$objFiles = $this->objFiles;

		// Get all images
		while ($objFiles->next())
		{
			// Continue if the files has been processed or does not exist
			if (isset($images[$objFiles->path]) || !file_exists(TL_ROOT . '/' . $objFiles->path))
			{
				continue;
			}

			// Single files
			if ($objFiles->type == 'file')
			{
				$objFile = new \File($objFiles->path, true);

				if (!$objFile->isGdImage)
				{
					continue;
				}

				$arrMeta = $this->getMetaData($objFiles->meta, $objPage->language);

				// Use the file name as title if none is given
				if ($arrMeta['title'] == '')
				{
					$arrMeta['title'] = specialchars(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)));
				}

				// Add the image
				$images[$objFiles->path] = array
				(
					'id'        => $objFiles->id,
					'name'      => $objFile->basename,
					'singleSRC' => $objFiles->path,
					'alt'       => $arrMeta['title'],
					'imageUrl'  => $arrMeta['link'],
					'caption'   => $arrMeta['caption']
				);

				$auxDate[] = $objFile->mtime;
				$auxId[] = $objFiles->id;
			}

			// Folders
			else
			{
				$objSubfiles = \FilesModel::findByPid($objFiles->id);

				if ($objSubfiles === null)
				{
					continue;
				}

				while ($objSubfiles->next())
				{
					// Skip subfolders
					if ($objSubfiles->type == 'folder')
					{
						continue;
					}

					$objFile = new \File($objSubfiles->path, true);

					if (!$objFile->isGdImage)
					{
						continue;
					}

					$arrMeta = $this->getMetaData($objSubfiles->meta, $objPage->language);

					// Use the file name as title if none is given
					if ($arrMeta['title'] == '')
					{
						$arrMeta['title'] = specialchars(str_replace('_', ' ', preg_replace('/^[0-9]+_/', '', $objFile->filename)));
					}

					// Add the image
					$images[$objSubfiles->path] = array
					(
						'id'        => $objSubfiles->id,
						'name'      => $objFile->basename,
						'singleSRC' => $objSubfiles->path,
						'alt'       => $arrMeta['title'],
						'imageUrl'  => $arrMeta['link'],
						'caption'   => $arrMeta['caption']
					);

					$auxDate[] = $objFile->mtime;
					$auxId[] = $objSubfiles->id;
				}
			}
		}

		// Sort array
		switch ($this->dk_msrySortBy)
		{
			default:
			case 'name_asc':
				uksort($images, 'basename_natcasecmp');
				break;

			case 'name_desc':
				uksort($images, 'basename_natcasercmp');
				break;

			case 'date_asc':
				array_multisort($images, SORT_NUMERIC, $auxDate, SORT_ASC);
				break;

			case 'date_desc':
				array_multisort($images, SORT_NUMERIC, $auxDate, SORT_DESC);
				break;

			case 'meta': // Backwards compatibility
			case 'custom':
				if ($this->orderSRC != '')
				{
					// Turn the order string into an array and remove all values
					$arrOrder = explode(',', $this->orderSRC);
					$arrOrder = array_flip(array_map('intval', $arrOrder));
					$arrOrder = array_map(function(){}, $arrOrder);

					// Move the matching elements to their position in $arrOrder
					foreach ($images as $k=>$v)
					{
						if (array_key_exists($v['id'], $arrOrder))
						{
							$arrOrder[$v['id']] = $v;
							unset($images[$k]);
						}
					}

					// Append the left-over images at the end
					if (!empty($images))
					{
						$arrOrder = array_merge($arrOrder, array_values($images));
					}

					// Remove empty (unreplaced) entries
					$images = array_filter($arrOrder);
					unset($arrOrder);
				}
				break;

			case 'random':
				shuffle($images);
				break;
		}

		$images = array_values($images);

		// Limit the total number of items
		if ($this->dk_msryNumberOfItems > 0)
		{
			$images = array_slice($images, 0, $this->dk_msryNumberOfItems);
		}

		$intMaxWidth = (TL_MODE == 'BE') ? 160 : $GLOBALS['TL_CONFIG']['maxImageWidth'];
		$intMaxImageWidth = 0;
		$intMaxImageHeight = 0;
		$strLightboxId = 'lightbox[lb' . $this->id . ']';
		$body = array();

		// create images
		for ($i = 0; $i < count($images); $i++)
		{
			$objCell = new \stdClass();

			// Add size
			$images[$i]['size'] = $this->dk_msryImageSize;
			$images[$i]['fullsize'] = $this->dk_msryFullsize;

			$this->addImageToTemplate($objCell, $images[$i], $intMaxWidth, $strLightboxId);
			$body[$i] = $objCell;
		}

		$objTemplate = new \FrontendTemplate($this->strTemplateGallery);
		$objTemplate->setData($this->arrData);
		$objTemplate->body = $body;

		if (TL_MODE == 'FE')
		{
			$this->Template->images = $objTemplate->parse();
	
			// --- create FE template for javascript caller
			$objTemplateJs = new \FrontendTemplate($this->dk_msryJsTpl);
		
			// (unique) Element id will be used for unique HTML id element
			$objTemplateJs->id = $this->id;

			$objMasonry = new Masonry();
			$objMasonry->createTemplateData($this->id, $this->Template, $objTemplateJs);
		}
		else
		{
			$this->strTemplate = 'be_masonry';
			$this->Template = new \BackendTemplate($this->strTemplate);
			$this->Template->images = $objTemplate->parse();

			// for BE styling include masonry CSS file
			$GLOBALS['TL_CSS'][] = 'system/modules/dk_masonry/assets/css/masonry.css';
		}
	}
}
