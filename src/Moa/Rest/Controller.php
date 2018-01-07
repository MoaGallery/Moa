<?php

namespace Moa\Rest;


use Moa\Actions\GalleryPut;
use Moa\Actions\PageData;
use Moa\Gallery;
use Moa\Tag;
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
	
	public function GalleryPut(Request $request, Application $app, $id)
	{
		$data = json_decode($request->getContent());
		
		/** @var GalleryPut $gallery_put */
		$gallery_put = $app['moa.action.gallery_put'];
		$gallery = $gallery_put->SaveGallery($id, $data);
		
		/** @var Gallery\DataProvider $gallery_db_provider */
		$gallery_db_provider = $app['moa.gallery_db_provider'];
		
		/** @var Tag\DataProvider $tag_db_provider */
		$tag_db_provider = $app['moa.tag_db_provider'];
		
		$gallery_list = $gallery_list = $gallery_db_provider->GetAllGalleries();
		
		$view = new Gallery\View($args);
		$gallery_data = $view->ShowGallery($gallery, $gallery_list, $tag_db_provider->GetAllTags(), $tag_db_provider->GetTagsForGallery($id));
		
		/** @var PageData\GalleryPage $page_data */
		$page_data = $app['moa.action.page_data.gallery_page'];
		
		return new JsonResponse($page_data->GetGalleryPageData($id));
	}
}