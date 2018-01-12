<?php
namespace Moa\Actions\PageData;

use Moa\Image;
use Moa\Gallery;
use Moa\Service\ThumbnailProvider;
use Moa\Tag;

class ImagePage
{
	protected $image_db_provider;
	protected $gallery_db_provider;
	protected $tag_db_provider;
	protected $thumbnail_provider;
	
	/**
	 * ImagePage constructor.
	 *
	 * @param Image\DataProvider $image_db_provider
	 * @param Gallery\DataProvider $gallery_db_provider
	 * @param Tag\DataProvider $tag_db_provider
	 * @param ThumbnailProvider $thumbnail_provider
	 */
	function __construct(Image\DataProvider $image_db_provider,
	                     Gallery\DataProvider $gallery_db_provider,
	                     Tag\DataProvider $tag_db_provider,
	                     ThumbnailProvider $thumbnail_provider)
	{
		$this->gallery_db_provider = $gallery_db_provider;
		$this->image_db_provider = $image_db_provider;
		$this->tag_db_provider = $tag_db_provider;
		$this->thumbnail_provider = $thumbnail_provider;
	}
	
	/**
	 * @param $image_id
	 *
	 * @return array
	 */
	public function GetImagePageData($gallery_id, $image_id)
	{
		$image = new Image\Model($this->image_db_provider, $this->tag_db_provider);
		$image->Load($image_id);
		
		$parents = $this->GetParents($gallery_id);
		
		$args = [];
		$view = new Image\View($args, $this->thumbnail_provider);
		$image_data = $view->ShowImage($image, $gallery_id, $this->tag_db_provider->GetAllTags(), $this->tag_db_provider->GetTagsForImage($image_id));
		
		return [
			'image' => $image_data,
			'breadcrumbs' => $view->getBreadcrumb($image, $parents),
			'page_title' => 'Image "' . $image->GetProperty('filename') . '"'
		];
	}
	
	protected function GetParents($gallery_id)
	{
		$parents = array();
		
		while ($gallery_id != 0)
		{
			$parent_gallery = $this->gallery_db_provider->GetParentGallery($gallery_id);
			array_unshift($parents, $parent_gallery);
			$gallery_id = $parent_gallery->GetProperty('parent_id');
		}
		
		return $parents;
	}
}