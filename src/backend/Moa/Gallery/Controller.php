<?php

namespace Moa\Gallery;

use Moa\Actions\PageData;
use Moa\Service\TemplateService;
use Symfony\Component\HttpFoundation\Response;

class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
	function ShowGallery(int $id, PageData\GalleryPage $page_data, TemplateService $templater)
	{
		$args = [
			'preload' => $page_data->GetGalleryPageData($id)
		];

		$output = $templater->twig->render('home.html', $args);
		return new Response($output);
	}
	
	public function ShowList(PageData\HomePage $page_data, TemplateService $templater)
	{
		$args = [
			'preload' => $page_data->GetHomePageData()
		];
		
		$output = $templater->twig->render('home.html', $args);
		return new Response($output);
	}
}