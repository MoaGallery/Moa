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

	public function ShowImage(Model $gallery, $gallery_list, $tags, $gallery_tags)
	{
		$gallery_args = array();
		$gallery_args['id'] = $gallery->GetProperty('id');
		$gallery_args['name'] = $gallery->GetProperty('name', true);
		$gallery_args['description'] = $gallery->GetProperty('description', true);
		$gallery_args['combined_view'] = $gallery->GetProperty('combined_view');
		$gallery_args['use_tags'] = $gallery->GetProperty('use_tags');

		// Parent gallery list
		$parents = array(array('name' => 'None', 'id' => 0));
		foreach ($gallery_list as $id => $name)
		{
			$entry = null;
			if ($id != $gallery->GetProperty('id'))
				$entry = array('id' => $id, 'name' => $name);

			if ($gallery->GetProperty('parent_id') == $id)
				$entry['selected'] = true;

			if ($entry !== null)
				$parents[] = $entry;
		}
		$gallery_args['gallery_list'] = $parents;

		// Tags
		$tag_list = array();
		foreach ($tags as $id => $name)
		{
			$entry = array('id' => 'tag-id-' . $id, 'name' => $name);

			if (in_array($id, $gallery_tags))
				$entry['selected'] = true;

			$tag_list[] = $entry;
		}
		$gallery_args['tag_list'] = $tag_list;

		$gallery_args['name_edit'] = $gallery->GetProperty('name');
		$gallery_args['description_edit'] = $gallery->GetProperty('description');
		$gallery_args['edit_error'] = $gallery->GetValidationMessage();

		$this->args['gallery'] = $gallery_args;
	}

	public function getBreadcrumb(Model $gallery, $parent_galleries)
	{
		$output = array();
		/** @var Model $p_gallery */
		foreach ($parent_galleries as $p_gallery)
		{
			$output[] = array
			(
				'name' => $p_gallery->GetProperty('name'),
				'id' => $p_gallery->GetProperty('id')
			);
		}
		$output[] = array
		(
			'name' => $gallery->GetProperty('name'),
			'id' => $gallery->GetProperty('id')
		);

		return $output;
	}
}