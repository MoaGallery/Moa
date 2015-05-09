<?php

namespace Moa\View;


use Moa\Gallery;

class GalleryView
{
	protected $args;

	public function __construct(&$args)
	{
		$this->args = &$args;
	}

	public function ShowGalleryList($galleries)
	{
		$this->args['galleries'] = array();

		foreach ($galleries as $id => $name)
		{
			$this->args['subgalleries'][] = array
			(
				'name' => $name,
				'id' => $id
			);
		};
	}

	public function ShowGallery(Gallery $gallery, $gallery_list, $tags, $gallery_tags)
	{
		$gallery_args = array();
		$gallery_args['id'] = $gallery->GetProperty('IDGallery');
		$gallery_args['name'] = $gallery->GetProperty('name', true);
		$gallery_args['description'] = $gallery->GetProperty('description', true);
		$gallery_args['combined_view'] = $gallery->GetProperty('combined_view');
		$gallery_args['use_tags'] = $gallery->GetProperty('use_tags');

		// Parent gallery list
		$parents = array();
		foreach ($gallery_list as $id => $name)
		{
			if ($id != $gallery->GetProperty('IDGallery'))
				$entry = array('id' => $id, 'name' => $name);

			if ($gallery->GetProperty('parent_id') == $id)
				$entry['selected'] = true;

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

	public function ShowBreadcrumb($parent_galleries)
	{
		$output = array();
		/** @var Gallery $gallery */
		foreach ($parent_galleries as $gallery)
		{
			$output[] = array
			(
				'name' => $gallery->GetProperty('name'),
				'id' => $gallery->GetProperty('IDGallery')
			);
		}

		$this->args['breadcrumb'] = $output;
	}
}