<?php

namespace Moa\Actions;

use Moa\Image;
use Moa\Tag;

class ImagePut
{
	protected $image_provider;
	protected $tag_provider;
	
	function __construct(Image\DataProvider $image_provider, Tag\DataProvider $tag_provider)
	{
		$this->image_provider = $image_provider;
		$this->tag_provider = $tag_provider;
	}
	
	function SaveImage($image_id, $data)
	{
		$image = new Image\Model($this->image_provider, $this->tag_provider);
		$image->Load($image_id);
		
		$image->SetProperty('description', $data->description);
		
		$this->image_provider->SaveImage($image);
		
		$tags = [];
		foreach ($data->tags as $tag)
		{
			preg_match('/tag-id-(\d+)/', $tag, $matches);
			$tags[] = (int)$matches[1];
		}
		
		$this->tag_provider->SaveTagsForImage($tags, $image_id);
		
		return $image_id;
	}
}