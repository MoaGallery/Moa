<?php

namespace Moa\Actions;

use Moa\Image;
use Moa\Gallery;
use Moa\Service\IncomingFileService;
use Moa\Tag;

class ImageMove
{
	protected $image_provider;
	protected $gallery_provider;
	protected $tag_provider;
	protected $file_service;
	
	protected $gallery_find_thumb;
	
	function __construct(Image\DataProvider $image_provider,
	                     Gallery\DataProvider $gallery_provider,
	                     Tag\DataProvider $tag_provider,
	                     IncomingFileService $file_service,
	                     GalleryFindThumb $gallery_find_thumb)
	{
		$this->image_provider = $image_provider;
		$this->gallery_provider = $gallery_provider;
		$this->tag_provider = $tag_provider;
		$this->file_service = $file_service;
		
		$this->gallery_find_thumb = $gallery_find_thumb;
	}
	
	function ImageMove($image_id, $data)
	{
		$image = new Image\Model($this->image_provider, $this->tag_provider);
		$image->Load($image_id);
		$image->SetProperty('description', $data->description);
		$update_galleries = [
			$this->gallery_provider->LoadGalleriesByImage($image_id)
		];
		$this->image_provider->SaveImage($image);
		
		$tags = [];
		foreach ($data->tags as $tag)
		{
			$tags[] = $tag;
		}
		
		$this->tag_provider->SaveTagsForImage($tags, $image_id);
		$update_galleries[] = $this->gallery_provider->LoadGalleriesByImage($image_id);
		
		foreach ($update_galleries as $galleries)
		{
			foreach ($galleries as $gallery)
			{
				/** @var Gallery\Model $gallery */
				if ($gallery->GetProperty('combined_view') === '1')
				{
					$thumb_id = $this->gallery_find_thumb->GalleryFindThumb($gallery);
					$this->gallery_provider->SetGalleryThumbId((int)$gallery->GetProperty('id'), $thumb_id);
				}
			}
		}
		
		return $image_id;
	}
	
	function SaveImages($data)
	{
		$ids = [];
		
		foreach ($data->fileHashes as $hash)
		{
			$image = new Image\Model($this->image_provider, $this->tag_provider);
			$incoming_file = $this->file_service->GetFileInfo($hash);
			
			$image->SetProperty('filename', $incoming_file['filename']);
			$image->SetProperty('format', $incoming_file['extension']);
			$image->SetProperty('description', $data->description);
			
			$temp_file = '../data/incoming/' . $incoming_file['id'];
			
			$info = getimagesize($temp_file);
			$image->SetProperty('width', $info[0]);
			$image->SetProperty('height', $info[1]);
			
			$this->image_provider->SaveImage($image);
			$image_id = $image->GetProperty('id');
			$ids[] = $image_id;
			
			rename($temp_file, '../data/images/' . $image_id . '.' . $incoming_file['extension']);
			
			$tags = [];
			foreach ($data->tags as $tag)
			{
				$tags[] = $tag;
			}
			
			$this->tag_provider->SaveTagsForImage($tags, $image_id);
		}

		return $ids;
	}
}
