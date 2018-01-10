<?php
namespace Moa\Actions\PageData;

use Moa\Image;
use Moa\Service\ThumbnailProvider;
use Moa\Tag;

class ImagePage
{
	protected $image_db_provider;
	protected $tag_db_provider;
	protected $thumbnail_provider;
	
	/**
	 * ImagePage constructor.
	 *
	 * @param Image\DataProvider $image_db_provider
	 * @param Tag\DataProvider $tag_db_provider
	 * @param ThumbnailProvider $thumbnail_provider
	 */
	function __construct(Image\DataProvider $image_db_provider,
	                     Tag\DataProvider $tag_db_provider,
	                     ThumbnailProvider $thumbnail_provider)
	{
		$this->image_db_provider = $image_db_provider;
		$this->tag_db_provider = $tag_db_provider;
		$this->thumbnail_provider = $thumbnail_provider;
	}
	
	/**
	 * @param $id
	 *
	 * @return array
	 */
	public function GetImagePageData($id)
	{
		$image = new Image\Model($this->image_db_provider, $this->tag_db_provider);
		$image->Load($id);
		
		$args = [];
		$view = new Image\View($args, $this->thumbnail_provider);
		$image_data = $view->ShowImage($image, $this->tag_db_provider->GetAllTags(), $this->tag_db_provider->GetTagsForImage($id));
		
		return [
			'image' => $image_data,
			'breadcrumbs' => $view->getBreadcrumb($image),
			'page_title' => 'Image "' . $image->GetProperty('filename') . '"'
		];
	}
}