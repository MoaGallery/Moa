<?php

namespace Moa\Gallery;

class View
{
	public function ShowGalleryList($galleries)
	{
		$output = [];
		foreach ($galleries as $id => $data)
		{
			$output[] = array
			(
				'name' => $data['name'],
				'id' => (int)$id,
				'thumbId' => $data['thumb_id']
			);
		};
		return $output;
	}

	public function ShowGallery(Model $gallery, $parent_gallery, $gallery_tags)
	{
		$gallery_args = array();
		$gallery_args['id'] = $gallery->GetProperty('id');
		$gallery_args['name'] = $gallery->GetProperty('name', true);
		$gallery_args['description'] = $gallery->GetProperty('description', true);
		$gallery_args['combinedView'] = $gallery->GetProperty('combined_view') == 1;
		$gallery_args['useTags'] = $gallery->GetProperty('use_tags') == 1;
		$gallery_args['parentId'] = $gallery->GetProperty('parent_id');

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
		
		$gallery_args['parentGallery'] = $parents;

		$tags = [];
		foreach ($gallery_tags as $tag_id => $tag_name)
		{
			$tags[] = [
				'id' => $tag_id,
				'name' => $tag_name
			];
		}
		
		// Tags
		$gallery_args['tagList'] = $tags;

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
