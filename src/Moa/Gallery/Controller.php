<?php

namespace Moa\Gallery;

use Moa\Actions\PageData;
use Moa\Image;
use Moa\Tag;
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
	/** @var Tag\DataProvider $gdp */
	protected $gdp;
	/** @var Tag\DataProvider $tdp */
	protected $tdp;
	/** @var Image\DataProvider $tdp */
	protected $idp;
	
	function ShowGallery(Request $request, Application $app, $id)
	{
		/** @var PageData\GalleryPage $page_data */
		$page_data = $app['moa.action.page_data.gallery_page'];
		
		$args['preload'] = $page_data->GetGalleryPageData($id);
		
		$output = $app['twig']->render('home.html', $args);
		return new Response($output);
	}
	
	public function ShowList(Request $request, Application $app)
	{
		/** @var PageData\HomePage $page_data */
		$page_data = $app['moa.action.page_data.home_page'];
		$args['preload'] = $page_data->GetHomePageData();
		
		$output = $app['twig']->render('home.html', $args);
		return new Response($output);
	}

	protected function GetParents(Model $gallery)
	{
		$parents = array();
		$parent_id = $gallery->GetProperty('parent_id');

		while ($parent_id != 0)
		{
			$parent_gallery = $this->gdp->GetParentGallery($parent_id);
			array_unshift($parents, $parent_gallery);
			$parent_id = $parent_gallery->GetProperty('parent_id');
		}

		return $parents;
	}
}