<?php

namespace Moa\Actions;

use Moa\Gallery;
use Moa\Tag;

class GalleryPut
{
	protected $gallery_provider;
	protected $tag_provider;
	
	function __construct(Gallery\DataProvider $gallery_provider, Tag\DataProvider $tag_provider)
	{
		$this->gallery_provider = $gallery_provider;
		$this->tag_provider = $tag_provider;
	}
	
	function SaveGallery($id, $data): int
	{
		$gallery = new Gallery\Model($this->gallery_provider, $this->tag_provider);
		
		$gallery->SetProperty('id', $id);
		$gallery->SetProperty('name', $data->name);
		$gallery->SetProperty('description', $data->description);
		$gallery->SetProperty('use_tags', $data->useTags ? 1 : 0);
		$gallery->SetProperty('combined_view', $data->showImages ? 1 : 0);
		$gallery->SetProperty('parent_id', $data->parent);
		
		$id = $this->gallery_provider->SaveGallery($gallery);
		
		$tags = [];
		foreach ($data->tags as $tag)
		{
			$tags[] = $tag;
		}
		
		$this->tag_provider->SaveTagsForGallery($tags, $id);
		
		return $id;
	}
}