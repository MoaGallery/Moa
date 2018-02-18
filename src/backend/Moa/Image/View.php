<?php

namespace Moa\Image;

use Moa\Service\ThumbnailProvider;
use Moa\Gallery;

class View
{
	protected $args;
	protected $thumb_service;

	public function __construct(&$args, ThumbnailProvider $thumb_service)
	{
		$this->args = &$args;
		$this->thumb_service = $thumb_service;
	}

	public function GetImageListData($images)
	{
		$data = [];

		foreach ($images as $id => $image)
		{
			/** @var Model $image */
			$image_id = $image->GetProperty('id');
			
			$is_generating = !$this->thumb_service->DoesThumbnailExist($image_id);
			if ($is_generating)
				$this->thumb_service->QueueThumbnail($image_id);
			
			$data[] = array
			(
				'filename' => $image->GetProperty('filename'),
				'id' => (int)$image_id,
				'width' => (int)$image->GetProperty('width'),
				'height' => (int)$image->GetProperty('height'),
				'isGenerating' => $is_generating
			);
		};
		
		return $data;
	}

	public function ShowImage(Model $image, $gallery_id, $image_tags)
	{
		$image_args = [];
		$image_args['id'] = $image->GetProperty('id');
		$image_args['filename'] = $image->GetProperty('filename', true);
		$image_args['description'] = $image->GetProperty('description', true);
		$image_args['width'] = $image->GetProperty('width');
		$image_args['height'] = $image->GetProperty('height');
		$image_args['format'] = $image->GetProperty('format');
		$image_args['gallery_id'] = $gallery_id;

		// Tags
		$tag_list = [];
		foreach ($image_tags as $id => $name)
		{
			$tag_list[] = [
				'id' => $id,
				'name' => $name
			];
		}
		$image_args['tag_list'] = $tag_list;

		$image_args['description_edit'] = $image->GetProperty('description');
		$image_args['edit_error'] = $image->GetValidationMessage();
		
		$image_args['image_src'] = '/image/standard/' . $image->GetProperty('id') . '.' . $image->GetProperty('format');
		
		$this->args['image'] = $image_args;
		
		return $image_args;
	}

	public function getBreadcrumb(Model $image, $parent_galleries)
	{
		$output = [];

		/** @var Model $p_gallery */
		foreach ($parent_galleries as $p_gallery)
		{
			$output[] = array
			(
				'type' => 'gallery',
				'name' => $p_gallery->GetProperty('name'),
				'id' => $p_gallery->GetProperty('id')
			);
		}
		
		$output[] =
		[
			'type' => 'image',
			'name' => $image->GetProperty('filename'),
			'id' => $image->GetProperty('id')
		];

		return $output;
	}
}