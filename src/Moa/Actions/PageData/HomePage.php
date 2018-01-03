<?php
namespace Moa\Actions\PageData;

use Moa\Gallery;

class HomePage
{
	protected $gallery_db_provider;
	
	/**
	 * HomePage constructor.
	 *
	 * @param Gallery\DataProvider $gallery_db_provider
	 */
	function __construct(Gallery\DataProvider $gallery_db_provider)
	{
		$this->gallery_db_provider = $gallery_db_provider;
	}
	
	/**
	 * @return array
	 */
	public function GetHomePageData()
	{
		$galleries = $this->gallery_db_provider->GetGalleries(0);
		
		$args = array();
		$view = new Gallery\View($args);
		$view->ShowGalleryList($galleries);
		
		return [
			'galleries' => $args['subgalleries'],
			'breadcrumbs' => [],
			'page_title' => 'Gallery'
		];
	}
}