<?php

namespace Moa\Actions;

use Moa\Gallery;
use Moa\Tag;

class GalleryPut
{
	protected $gallery_provider;
	protected $tag_provider;
	protected $gallery_find_thumb;
	
	function __construct(Gallery\DataProvider $gallery_provider, Tag\DataProvider $tag_provider, GalleryFindThumb $gallery_find_thumb)
	{
		$this->gallery_provider = $gallery_provider;
		$this->tag_provider = $tag_provider;
		$this->gallery_find_thumb = $gallery_find_thumb;
	}
	
	function SaveGallery($gallery_id, $data): int
	{
		$gallery = new Gallery\Model($this->gallery_provider, $this->tag_provider);
		
		$gallery->SetProperty('id', $gallery_id);
		$gallery->SetProperty('name', $data->name);
		$gallery->SetProperty('description', $data->description);
		$gallery->SetProperty('use_tags', $data->useTags ? 1 : 0);
		$gallery->SetProperty('combined_view', $data->showImages ? 1 : 0);
		$gallery->SetProperty('parent_id', $data->parent);
		
		$gallery_id = $this->gallery_provider->SaveGallery($gallery);
		
		$tags = [];
		foreach ($data->tags as $tag)
		{
			$tags[] = $tag;
		}
		
		$this->tag_provider->SaveTagsForGallery($tags, $gallery_id);
		
		if ($this->gallery_provider->IsGalleryThumbAuto($gallery_id))
		{
			$image_id = $this->gallery_find_thumb->GalleryFindThumb($gallery);
			$this->gallery_provider->SetGalleryThumbId($gallery_id, $image_id);
		}
		
		
		return $gallery_id;
	}
}