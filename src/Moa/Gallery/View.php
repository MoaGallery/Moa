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

	public function ShowGallery(Model $gallery, $gallery_list, $tags, $gallery_tags)
	{
		$gallery_args = array();
		$gallery_args['id'] = $gallery->GetProperty('id');
		$gallery_args['name'] = $gallery->GetProperty('name', true);
		$gallery_args['description'] = $gallery->GetProperty('description', true);
		$gallery_args['combined_view'] = $gallery->GetProperty('combined_view');
		$gallery_args['use_tags'] = $gallery->GetProperty('use_tags');
		$gallery_args['parent_id'] = $gallery->GetProperty('parent_id');

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