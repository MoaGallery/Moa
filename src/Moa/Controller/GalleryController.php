<?php

namespace Moa\Controller;

use Moa\Provider\GalleryDbProvider;
use Moa\View\GalleryView;
use Silex\Application;
use Silex\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleryController
{
	/** @var GalleryDbProvider $gdp */
	protected $gdp;

    function ShowGallery(Request $request, Application $app, $id)
    {
	    /** @var GalleryDbProvider $gdp */
	    $this->gdp = $app['moa.gallery_db_provider'];

	    $gallery = $this->gdp->LoadGallery($id);

		$view = new GalleryView($app['twig']);

        return new Response($view->ShowGallery($gallery));
    }

	public function ShowList(Request $request, Application $app)
	{
		$galleries = $app['moa.gallery_db_provider']->GetGalleries();

		$view = new GalleryView($app['twig']);

		return new Response($view->ShowGalleryList($galleries));
	}
}