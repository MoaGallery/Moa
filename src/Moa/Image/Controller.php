<?php

namespace Moa\Image;

use Moa\Image;
use Moa\Tag;
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Controller
{
	/** @var Tag\DataProvider $tdp */
	protected $tdp;
	/** @var Image\DataProvider $tdp */
	protected $idp;

    function ShowImage(Request $request, Application $app, $image_id)
    {
	    /** @var Image\DataProvider $idp */
	    $this->idp = $app['moa.image_db_provider'];

	    /** @var Tag\DataProvider $gdp */
	    $this->tdp = $app['moa.tag_db_provider'];

	    $image = $this->idp->LoadImage($image_id);
	    
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
					$tag_id = $this->tdp->AddTag($tag_id);

				$tag_list[] = $tag_id;
			}

			$image->SetTags($tag_list);

			if ($image->Validate())
				$image->Save();
			
			return new RedirectResponse($request->getUri());
		}

	    $args = array();
		$view = new View($args);
	    $view->ShowImage($image, $this->tdp->GetAllTags(), $this->tdp->GetTagsForImage($image_id));
	    
	    $preload = array();
	    $preload['breadcrumb'] = $view->getBreadcrumb($image);
	    $args['preload_data'] = json_encode($preload);

	    $args['page_title'] = 'Image "' . $image->GetProperty('filename') . '"';
	    $output = $app['twig']->render('image.html', $args);
        return new Response($output);
    }
}