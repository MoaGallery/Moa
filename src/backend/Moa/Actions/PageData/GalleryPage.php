<?php
namespace Moa\Actions\PageData;

use Moa\Gallery;
use Moa\Image;
use Moa\Service\ThumbnailProvider;
use Moa\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GalleryPage
{
	protected $gallery_db_provider;
	protected $image_db_provider;
	protected $tag_db_provider;
	protected $thumbnail_provider;
	
	/**
	 * GalleryPage constructor.
	 *
	 * @param Gallery\DataProvider $gallery_db_provider
	 * @param Image\DataProvider $image_db_provider
	 * @param Tag\DataProvider $tag_db_provider
	 * @param ThumbnailProvider $thumbnail_provider
	 */
	function __construct(Gallery\DataProvider $gallery_db_provider,
	                     Image\DataProvider $image_db_provider,
	                     Tag\DataProvider $tag_db_provider,
	                     ThumbnailProvider $thumbnail_provider)
	{
		$this->gallery_db_provider = $gallery_db_provider;
		$this->image_db_provider = $image_db_provider;
		$this->tag_db_provider = $tag_db_provider;
		$this->thumbnail_provider = $thumbnail_provider;
	}
	
	/**
	 * @param $gallery_id
	 *
	 * @return array
	 */
	public function GetGalleryPageData($gallery_id)
	{
		$gallery = new Gallery\Model($this->gallery_db_provider, $this->tag_db_provider);
		$gallery->Load($gallery_id);
		$parents = $this->GetParents($gallery);
		$sub_galleries = $this->gallery_db_provider->GetGalleries($gallery_id);
		
		$parent_gallery = null;
		if (count($parents) > 0)
			$parent_gallery = $parents[count($parents) - 1];
		
		$view = new Gallery\View();
		$gallery_data = $view->ShowGallery($gallery, $parent_gallery, $this->tag_db_provider->GetTagsForGallery($gallery_id));
		$subgalleries = $view->ShowGalleryList($sub_galleries);
		
		$args = [];
		$image_list = [];
		if (($gallery->GetProperty('combined_view') == 1) ||
			(count($subgalleries) === 0))
		{
			$images = $this->image_db_provider->LoadImagesByGallery($gallery_id);
			$image_view = new Image\View($args, $this->thumbnail_provider);
			$image_list = $image_view->GetImageListData($images);
		}
		
		return [
			'gallery' => $gallery_data,
			'galleries' => $subgalleries,
			'breadcrumbs' => $view->getBreadcrumb($gallery, $parents),
			'page_title' => 'Gallery "' . $gallery->GetProperty('name') . '"',
			'images' => $image_list
		];
	}
	
	protected function GetParents(Gallery\Model $gallery)
	{
		$parents = [];
		$parent_id = $gallery->GetProperty('parent_id');
		
		while ($parent_id != 0)
		{
			$parent_gallery = $this->gallery_db_provider->GetParentGallery($parent_id);
			array_unshift($parents, $parent_gallery);
			$parent_id = $parent_gallery->GetProperty('parent_id');
		}
		
		return $parents;
	}
}