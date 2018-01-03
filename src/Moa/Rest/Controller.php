<?php

namespace Moa\Rest;


use Moa\Actions\PageData;
use Moa\Service\ThumbnailProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller
{
	function CheckThumbnailStatus(Request $request, Application $app)
	{
		$image_ids = $request->get('images');
		$image_ids = explode(',', $image_ids);
		
		/** @var ThumbnailProvider $thumb_provider */
		$thumb_provider = $app['moa.thumbnail_db_provider'];
		
		$queued = [];
		foreach ($image_ids as $image_id)
		{
			if ($thumb_provider->IsThumbnailQueued($image_id))
				$queued[] = $image_id;
		}

		return new JsonResponse($queued);
	}
	
	function PageDataGallery(Request $request, Application $app, $id)
	{
		/** @var PageData\GalleryPage $page_data */
		$page_data = $app['moa.action.page_data.gallery_page'];
		
		return new JsonResponse($page_data->GetGalleryPageData($id));
	}
	
	public function PageDataHome(Request $request, Application $app)
	{
		/** @var PageData\HomePage $page_data */
		$page_data = $app['moa.action.page_data.home_page'];
		
		return new JsonResponse($page_data->GetHomePageData());
	}
	
}