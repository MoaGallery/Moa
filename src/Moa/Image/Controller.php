<?php

namespace Moa\Image;

use Moa\Actions\PageData;
use Moa\Image;
use Moa\Gallery;
use Moa\Tag;
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
	
	function ShowImage2(Request $request, Application $app, $gallery_id, $image_id)
	{
		/** @var Image\DataProvider $idp */
		$idp = $app['moa.image_db_provider'];
		
		/** @var Tag\DataProvider $gdp */
		$tdp = $app['moa.tag_db_provider'];
		
		$image = $idp->LoadImage($image_id);
		
		if ($request->getMethod() == 'POST')
		{
			$image->SetProperty('description', $request->request->get('inputImageDescription', ''));
			
			// Process tags
			$tags = $request->request->get('inputImageTags', array());
			$tag_list = array();
			foreach ($tags as $tag_id)
			{
				if (strpos($tag_id, 'tag-id-') === 0)
					$tag_id = substr($tag_id, 7);
				
				if (!is_numeric($tag_id))
					$tag_id = $tdp->AddTag($tag_id);
				
				$tag_list[] = $tag_id;
			}
			
			$image->SetTags($tag_list);
			
			if ($image->Validate())
				$image->Save();
			
			return new RedirectResponse($request->getUri());
		}
		
		$args = array();
		$view = new View($args, $app['moa.thumbnail_db_provider']);
		$view->ShowImage($image, $gallery_id, $tdp->GetAllTags(), $tdp->GetTagsForImage($image_id));
		
		/** @var Gallery\DataProvider $gallery_data_provider */
		$gallery_data_provider = $app['moa.gallery_db_provider'];
		$parents = $this->GetParents($gallery_id, $gallery_data_provider);
		
		$preload = array();
		$preload['breadcrumb'] = $view->getBreadcrumb($image, $parents);
		$args['preload_data'] = json_encode($preload);
		
		$args['page_title'] = 'Image "' . $image->GetProperty('filename') . '"';
		$output = $app['twig']->render('image.html', $args);
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
}