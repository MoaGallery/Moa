<?php

namespace Moa\View;


use Moa\Gallery;

class GalleryView
{
	/** @var \Twig_Environment $twig */
	protected $twig;

	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}

	public function ShowGalleryList($galleries)
	{
		$args = array();
		$args['galleries'] = array();

		foreach ($galleries as $id => $name)
		{
			$args['galleries'][] = array
			(
				'name' => $name,
				'id' => $id
			);
		};

		$output = $this->twig->render('gallerylist.html', $args);

		return $output;
	}

	public function ShowGallery(Gallery $gallery)
	{
		$args = array();

		$args['name'] = $gallery->GetProperty('name');
		$args['description'] = $gallery->GetProperty('description');

		$output = $this->twig->render('gallery.html', $args);

		return $output;
	}
}