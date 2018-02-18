<?php

namespace Moa\Image;

use Moa\Actions\ImageResize;
use Moa\Actions\PageData;
use Moa\Service\IncomingFileService;
use Moa\Service\TemplateService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
	function ShowImage(int $gallery_id, int $image_id, PageData\ImagePage $page_data, TemplateService $templater)
	{
		$args['preload'] = $page_data->GetImagePageData($gallery_id, $image_id);
		
		$output = $templater->twig->render('home.html', $args);
		return new Response($output);
	}
	
	function ShowUploadedImage(string $hash, IncomingFileService $service)
	{
		$body = $service->GetFileBody($hash);
		
		return BinaryFileResponse::create($body);
	}
	
	function GetImageFile(int $id, Request $request, DataProvider $provider)
	{
		$image = $provider->LoadImage($id);
		$file = '../data/images/' . $id . '.' . $image->GetProperty('format');
		
		if (!file_exists($file))
			throw new FileNotFoundException($request->getUri());
		
		return BinaryFileResponse::create($file);
	}
	
	function GetThumbFile(string $filename, Request $request)
	{
		preg_match('/(\d+)\.(\w+)/', $filename, $matches);
		
		$file = '../data/images/thumbs/' . $matches[1] . '.' . $matches[2];
		
		if (!file_exists($file))
			return new RedirectResponse('/media/thumberror.png');
			
		return BinaryFileResponse::create($file);
	}
	
	function GetWideThumbFile(string $filename, Request $request)
	{
		preg_match('/(\d+)\-w.(\w+)/', $filename, $matches);
		
		$file = '../data/images/thumbs/' . $matches[1] . '-w.' . $matches[2];
		
		if (!file_exists($file))
			return new RedirectResponse('/media/thumberror.png');
		
		return BinaryFileResponse::create($file);
	}
	
	function GetStandardFile(string $filename, Request $request, ImageResize $action)
	{
		preg_match('/(\d+)\.(\w+)/', $filename, $matches);

		$output = '../data/images/standard/' . $matches[1] . '.' . $matches[2];

		if (!file_exists($output))
		{
			$input = '../data/images/' . $matches[1] . '.' . $matches[2];
			$action->Resize($input, $output, ImageResize::STANDARD_WIDTH, ImageResize::STANDARD_HEIGHT, ImageResize::RESIZE_FIT);
		}
		
		if (!file_exists($output))
			throw new FileNotFoundException($request->getUri());
		
		return BinaryFileResponse::create($output);
	}
}