<?php

namespace Moa\Actions;

use Moa\Image;
use Moa\Service\IncomingFileService;
use Moa\Tag;

class ImagePut
{
	protected $image_provider;
	protected $tag_provider;
	protected $file_service;
	
	function __construct(Image\DataProvider $image_provider, Tag\DataProvider $tag_provider, IncomingFileService $file_service)
	{
		$this->image_provider = $image_provider;
		$this->tag_provider = $tag_provider;
		$this->file_service = $file_service;
	}
	
	function SaveImage($image_id, $data)
	{
		$image = new Image\Model($this->image_provider, $this->tag_provider);
		
		$new_file = null;
		
		if ($image_id > 0)
		{
			$image->Load($image_id);
		} else
		{
			foreach ($data->fileHashes as $hash)
			{
				$incoming_file = $this->file_service->GetFileInfo($hash);
				
				$image->SetProperty('filename', $incoming_file['filename']);
				$image->SetProperty('format', $incoming_file['extension']);
				
				$temp_file = 'data/incoming/' . $incoming_file['id'];
				
				$info = getimagesize($temp_file);
				$image->SetProperty('width', $info[0]);
				$image->SetProperty('height', $info[1]);
				
				$new_file = [
					'file' => $temp_file,
					'extension' => $incoming_file['extension']
				];
			}
		}
		
		$image->SetProperty('description', $data->description);
		
		$this->image_provider->SaveImage($image);
		$image_id = $image->GetProperty('id');
		
		if (is_array($new_file))
		{
			rename($new_file['file'], 'data/images/' . $image_id . '.' . $new_file['extension']);
		}
		
		$tags = [];
		foreach ($data->tags as $tag)
		{
			$tags[] = $tag;
		}
		
		$this->tag_provider->SaveTagsForImage($tags, $image_id);
		
		return $image_id;
	}
}