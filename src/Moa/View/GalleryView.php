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

	public function ShowGallery(Gallery $gallery)
	{
		$this->args['gallery_id'] = $gallery->GetProperty('IDGallery');
		$this->args['gallery_name'] = $gallery->GetProperty('name', true);
		$this->args['gallery_description'] = $gallery->GetProperty('description', true);

		$this->args['gallery_name_edit'] = $gallery->GetProperty('name');
		$this->args['gallery_description_edit'] = $gallery->GetProperty('description');

		$this->args['gallery_edit_error'] = $gallery->GetValidationMessage();
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