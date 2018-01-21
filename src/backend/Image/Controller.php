<?php

namespace Moa\Image;

use Moa\Actions\PageData;
use Moa\Gallery;
use Moa\Service\IncomingFileService;
use Silex\Application;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Tests\BinaryFileResponseTest;

class Controller
{
	function ShowImage(Request $request, Application $app, $gallery_id, $image_id)
	{
		/** @var PageData\ImagePage $page_data */
		$page_data = $app['moa.action.page_data.image_page'];
		
		$args['preload'] = $page_data->GetImagePageData($gallery_id, $image_id);
		
		$output = $app['twig']->render('home.html', $args);
		return new Response($output);
	}
	
	protected function GetParents($gallery_id, Gallery\DataProvider $gallery_data_provider)
	{
		$parents = [];
		
		while ($gallery_id != 0)
		{
			$parent_gallery = $gallery_data_provider->GetParentGallery($gallery_id);
			array_unshift($parents, $parent_gallery);
			$gallery_id = $parent_gallery->GetProperty('parent_id');
		}
		
		return $parents;
	}
	
	function ShowUploadedImage(Request $request, Application $app, string $hash)
	{
		/** @var IncomingFileService $service */
		$service = $app['moa.incoming_file_service'];
		$body = $service->GetFileBody($hash);
		
		return BinaryFileResponse::create($body);
	}
	
	function GetImageFile(Request $request, Application $app, string $filename)
	{
		preg_match('/(\d+)\.(\w+)/', $filename, $matches);
		
		$file = '../data/images/' . $matches[1] . '.' . $matches[2];
		
		if (!file_exists($file))
			$app->abort(404);
		
		return BinaryFileResponse::create($file);
	}
	
	function GetThumbFile(Request $request, Application $app, string $filename)
	{
		preg_match('/(\d+)\.(\w+)/', $filename, $matches);
		
		$file = '../data/images/thumbs/' . $matches[1] . '.' . $matches[2];
		
		if (!file_exists($file))
			$app->abort(404);
			
		return BinaryFileResponse::create($file);
	}
}