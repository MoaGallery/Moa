<?php

namespace Moa\Gallery;

class View
{
	public function ShowGalleryList($galleries)
	{
		$data = [];
		foreach ($galleries as $id => $name)
		{
			$data[] = array
			(
				'name' => $name,
				'id' => (int)$id
			);
		};
		
		return $data;
	}

	public function ShowGallery(Model $gallery, $parent_gallery, $gallery_tags)
	{
		$gallery_args = array();
		$gallery_args['id'] = $gallery->GetProperty('id');
		$gallery_args['name'] = $gallery->GetProperty('name', true);
		$gallery_args['description'] = $gallery->GetProperty('description', true);
		$gallery_args['combined_view'] = $gallery->GetProperty('combined_view');
		$gallery_args['use_tags'] = $gallery->GetProperty('use_tags');
		$gallery_args['parent_id'] = $gallery->GetProperty('parent_id');

		// Parent gallery list
		$parents = [
			'id' => 0,
			'name' => 'Homepage'
		];
		if ($parent_gallery instanceof Model)
		{
			$parents = [
				'id' => $parent_gallery->GetProperty('id'),
				'name' => $parent_gallery->GetProperty('name')
			];
		}
		
		$gallery_args['parent_gallery'] = $parents;

		$tags = [];
		foreach ($gallery_tags as $tag_id => $tag_name)
		{
			$tags[] = [
				'id' => $tag_id,
				'name' => $tag_name
			];
		}
		
		// Tags
		$gallery_args['tag_list'] = $tags;

		return $gallery_args;
	}

	public function getBreadcrumb(Model $gallery, $parent_galleries)
	{
		$output = array();
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
		$output[] = array
		(
			'type' => 'gallery',
			'name' => $gallery->GetProperty('name'),
			'id' => $gallery->GetProperty('id')
		);

		return $output;
	}
}