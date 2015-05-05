<?php

namespace Moa\Controller;

use Moa\Gallery;
use Moa\Provider\GalleryDataProvider;
use Moa\View\GalleryView;
use Silex\Application;
use Silex\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleryController
{
	/** @var GalleryDataProvider $gdp */
	protected $gdp;

    function ShowGallery(Request $request, Application $app, $id)
    {
	    /** @var GalleryDataProvider $gdp */
	    $this->gdp = $app['moa.gallery_db_provider'];

	    $gallery = $this->gdp->LoadGallery($id);
	    $parents = $this->GetParents($gallery);
	    $sub_galleries = $this->gdp->GetGalleries($id);

	    $args = array();
		$view = new GalleryView($args);
	    $view->ShowGallery($gallery);
	    $view->ShowGalleryList($sub_galleries);
	    $view->ShowBreadcrumb($parents);

	    $args['page_title'] = 'Gallery "' . $gallery->GetProperty('name') . '"';
	    $output = $app['twig']->render('gallery.html', $args);
        return new Response($output);
    }

	public function ShowList(Request $request, Application $app)
	{
		$galleries = $app['moa.gallery_db_provider']->GetGalleries(0);

		$args = array();
		$view = new GalleryView($args);
		$view->ShowGalleryList($galleries);

		$args['page_title'] = 'Gallery';
		$output = $app['twig']->render('home.html', $args);
		return new Response($output);
	}

	protected function GetParents(Gallery $gallery)
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