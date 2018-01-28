<?php

namespace Moa\Rest;


use Moa\Actions\GalleryLookup;
use Moa\Actions\GalleryPut;
use Moa\Actions\ImagePut;
use Moa\Actions\PageData;
use Moa\Actions\TagLookup;
use Moa\Gallery;
use Moa\Image;
use Moa\Service\IncomingFileService;
use Moa\Service\ThumbnailProvider;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
	function CheckThumbnailStatus(Request $request,
	                              ThumbnailProvider $thumb_provider)
	{
		$image_ids = $request->get('images');
		$image_ids = explode(',', $image_ids);
		
		$queued = [];
		foreach ($image_ids as $image_id)
		{
			if ($thumb_provider->IsThumbnailQueued($image_id))
				$queued[] = $image_id;
		}
		
		return new JsonResponse($queued);
	}
	
	function PageDataGallery($id, PageData\GalleryPage $page_data)
	{
		return new JsonResponse($page_data->GetGalleryPageData($id));
	}
	
	public function PageDataHome(PageData\HomePage $page_data)
	{
		return new JsonResponse($page_data->GetHomePageData());
	}
	
	function PageDataImage(int $gallery_id,
	                       int $image_id,
	                       PageData\ImagePage $page_data)
	{
		return new JsonResponse($page_data->GetImagePageData($gallery_id, $image_id));
	}
	
	public function GalleryPut(int $id,
	                           Request $request,
	                           GalleryPut $gallery_put,
	                           PageData\GalleryPage $page_data)
	{
		$data = json_decode($request->getContent());
		
		$gallery_id = $gallery_put->SaveGallery($id, $data);
		
		$data = [];
		if ($id > 0)
			$data = $page_data->GetGalleryPageData($id);
		
		$data['success'] = true;
		$data['message'] = ($id === 0 ? $gallery_id : '');
		
		return new JsonResponse($data);
	}
	
	public function GalleryDelete(int $id,
	                              Gallery\DataProvider $provider)
	{
		$provider->DeleteGallery($id);
		
		$data['success'] = true;
		$data['message'] = '';
		
		return new JsonResponse($data);
	}
	
	public function ImagePut(int $id,
	                         Request $request,
	                         ImagePut $image_put,
	                         PageData\ImagePage $image_page,
	                         PageData\GalleryPage $gallery_page)
	{
		$input_data = json_decode($request->getContent());
		
		$ids = [];
		
		if ($id > 0)
			$ids[] = $image_put->SaveImage($id, $input_data);
		else
			$ids = $image_put->SaveImages($input_data);

		$data = [];
		if (count($ids) === 1)
			$data = $image_page->GetImagePageData($input_data->gallery_id, $ids[0]);
		else
			$data = $gallery_page->GetGalleryPageData($input_data->gallery_id);
		
		$data['success'] = true;
		$data['message'] = $ids[0];
		
		return new JsonResponse($data);
	}
	
	public function ImageDelete($id,
	                            Image\DataProvider $provider)
	{
		$provider->DeleteImage($id);
		$data['success'] = true;
		$data['message'] = '';
		
		return new JsonResponse($data);
	}
	
	public function FileUpload(Request $request,
	                           IncomingFileService $incoming)
	{
		$hashes = [];
		foreach ($request->files as $files)
		{
			foreach ($files as $file)
			{
				/** @var UploadedFile $file */
				$filename = $file->getClientOriginalName();
				$hashes[] = [
					'filename' => $filename,
					'hash' => $incoming->AddFile($file->getFilename(), $filename, $file->getPath())
				];
			}
		}
		
		return new JsonResponse($hashes);
	}
	
	public function TagLookup(Request $request,
	                          TagLookup $action)
	{
		$term = $request->get('q', '');
		$type = $request->get('_type', 'query');
		$page = $request->get('page', 1);
	
		$results = $action->DoLookup($term, $type, $page - 1);
		
		return new JsonResponse($results);
	}
	
	public function GalleryLookup(Request $request,
	                              GalleryLookup $action)
	{
		$term = $request->get('q', '');
		$type = $request->get('_type', 'query');
		$page = $request->get('page', 1);
		
		$results = $action->DoLookup($term, $type, $page - 1);
		
		return new JsonResponse($results);
	}
}