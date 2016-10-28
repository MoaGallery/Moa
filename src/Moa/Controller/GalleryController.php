<?php

namespace Moa\Controller;

use Moa\Model\Gallery;
use Moa\Provider\GalleryDataProvider;
use Moa\Provider\TagDataProvider;
use Moa\View\GalleryView;
use Silex\Application;
use Silex\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleryController
{
	/** @var GalleryDataProvider $gdp */
	protected $gdp;
	/** @var TagDataProvider $tdp */
	protected $tdp;

    function ShowGallery(Request $request, Application $app, $id)
    {
	    /** @var GalleryDataProvider $gdp */
	    $this->gdp = $app['moa.gallery_db_provider'];

	    /** @var TagDataProvider $gdp */
	    $this->tdp = $app['moa.tag_db_provider'];

	    /** @var Gallery $gallery */
	    $gallery = new Gallery($this->gdp, $this->tdp);
	    $gallery->Load($id);
	    $parents = $this->GetParents($gallery);
	    $sub_galleries = $this->gdp->GetGalleries($id);
		$gallery_list = $this->gdp->GetAllGalleries();

		if ($request->getMethod() == 'POST')
		{
			$gallery->SetProperty('name', $request->request->get('inputGalleryName', ''));
			$gallery->SetProperty('description', $request->request->get('inputGalleryDescription', ''));
			$gallery->SetProperty('parent_id', $request->request->get('inputGalleryParent', 0));
			$gallery->SetProperty('combined_view', $request->request->get('inputGalleryCombinedView', '') == 'on' ? 1 : 0);
			$gallery->SetProperty('use_tags', $request->request->get('inputGalleryUseTags', '') == 'on' ? 1 : 0);

			// Process tags
			$tags = $request->request->get('inputGalleryTags', array());
			$tag_list = array();
			foreach ($tags as $tag_id)
			{
				if (strpos($tag_id, 'tag-id-') === 0)
					$tag_id = substr($tag_id, 7);

				if (!is_numeric($tag_id))
					$tag_id = $this->tdp->AddTag($tag_id);

				$tag_list[] = $tag_id;
			}

			$gallery->SetTags($tag_list);

			if ($gallery->Validate($gallery_list))
				$gallery->Save();
		}

	    $args = array();
		$view = new GalleryView($args);
	    $view->ShowGallery($gallery, $gallery_list, $this->tdp->GetAllTags(), $this->tdp->GetTagsForGallery($id));
	    $view->ShowGalleryList($sub_galleries);
	    $view->ShowBreadcrumb($gallery, $parents);

	    $args['page_title'] = 'Gallery "' . $gallery->GetProperty('name') . '"';
	    $output = $app['twig']->render('gallery.html', $args);
        return new Response($output);
    }

	public function ShowList(Request $request, Application $app)
	{
		$galleries = $app['moa.gallery_db_provider']->GetGalleries(0);

		$args = array();
		$view = new GalleryView($args);
		$view->ShowGalleryList($galleries);

		$args['page_title'] = 'Gallery';
		$output = $app['twig']->render('home.html', $args);
		return new Response($output);
	}

	protected function GetParents(Gallery $gallery)
	{
		$parents = array();
		$parent_id = $gallery->GetProperty('parent_id');

		while ($parent_id != 0)
		{
			$parent_gallery = $this->gdp->GetParentGallery($parent_id);
			array_unshift($parents, $parent_gallery);
			$parent_id = $parent_gallery->GetProperty('parent_id');
		}

		return $parents;
	}
}