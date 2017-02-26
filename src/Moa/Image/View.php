<?php

namespace Moa\Image;

class View
{
	protected $args;

	public function __construct(&$args)
	{
		$this->args = &$args;
	}

	public function ShowImageList($images)
	{
		$this->args['images'] = array();

		foreach ($images as $id => $image)
		{
			/** @var Model $image */
			$this->args['images'][] = array
			(
				'filename' => $image->GetProperty('filename'),
				'id' => $image->GetProperty('id')
			);
		};			
	}

	public function ShowImage(Model $image, $tags, $gallery_tags)
	{
		$image_args = array();
		$image_args['id'] = $image->GetProperty('id');
		$image_args['filename'] = $image->GetProperty('filename', true);
		$image_args['description'] = $image->GetProperty('description', true);
		$image_args['width'] = $image->GetProperty('width');
		$image_args['height'] = $image->GetProperty('height');
		$image_args['format'] = $image->GetProperty('format');

		// Tags
		$tag_list = array();
		foreach ($tags as $id => $name)
		{
			$entry = array('id' => 'tag-id-' . $id, 'name' => $name);

			if (in_array($id, $gallery_tags))
				$entry['selected'] = true;

			$tag_list[] = $entry;
		}
		$image_args['tag_list'] = $tag_list;

		$image_args['description_edit'] = $image->GetProperty('description');
		$image_args['edit_error'] = $image->GetValidationMessage();
		
		$image_args['image_src'] = '/data/images/' . $image->GetProperty('id') . '.' . $image->GetProperty('format');
		
		$this->args['image'] = $image_args;
	}

	public function getBreadcrumb(Model $image)
	{
		/** @var Model $p_gallery */
		$output =
		[[
			'type' => 'image',
			'name' => $image->GetProperty('filename'),
			'id' => $image->GetProperty('id')
		]];

		return $output;
	}
}