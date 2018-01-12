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
	
	function PageDataImage(Request $request, Application $app, $gallery_id, $image_id)
	{
		/** @var PageData\ImagePage $page_data */
		$page_data = $app['moa.action.page_data.image_page'];
		
		return new JsonResponse($page_data->GetImagePageData($gallery_id, $image_id));
	}
	
	public function GalleryPut(Request $request, Application $app, $id)
	{
		$data = json_decode($request->getContent());
		
		/** @var GalleryPut $gallery_put */
		$gallery_put = $app['moa.action.gallery_put'];
		$gallery_id = $gallery_put->SaveGallery($id, $data);
		
		/** @var PageData\GalleryPage $page_data */
		$page_data = $app['moa.action.page_data.gallery_page'];
		
		$data = [];
		if ($id > 0)
			$data = $page_data->GetGalleryPageData($id);
		
		$data['success'] = true;
		$data['message'] = ($id === '0' ? $gallery_id : '');
		
		return new JsonResponse($data);
	}
	
	public function GalleryDelete(Request $request, Application $app, $id)
	{
		/** @var Gallery\DataProvider $provider */
		$provider = $app['moa.gallery_db_provider'];
		
		$provider->DeleteGallery($id);
		
		$data['success'] = true;
		$data['message'] = '';
		
		return new JsonResponse($data);
	}
}