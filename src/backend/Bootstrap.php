<?php

namespace Moa;

use Moa\Actions\GalleryLookup;
use Moa\Actions\GalleryPut;
use Moa\Actions\ImagePut;
use Moa\Actions\PageData;
use Moa\Actions\TagLookup;
use Silex\Application;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Bootstrap
{
	protected $app;
	
	public function __construct(Application &$app)
	{
		$this->app = &$app;
	}
	
	public function AddServices()
	{
		$db = new Db();
		$this->app['db'] = $db;

		$this->app['moa.tag_db_provider'] = function($app)
		{
			return new Tag\DataProvider($app['db']);
		};

		$this->app['moa.gallery_db_provider'] = function($app)
		{
			return new Gallery\DataProvider($app['db'], $app['moa.tag_db_provider']);
		};
		
		$this->app['moa.image_db_provider'] = function($app)
		{
			return new Image\DataProvider($app['db'], $app['moa.tag_db_provider']);
		};
		
		// Services
		
		$this->app['moa.thumbnail_db_provider'] = function($app)
		{
			return new Service\ThumbnailProvider($app['db']);
		};
		
		$this->app['moa.incoming_file_provider'] = function($app)
		{
			return new Service\IncomingFileDataProvider($app['db']);
		};
		
		$this->app['moa.incoming_file_service'] = function($app)
		{
			return new Service\IncomingFileService($app['moa.incoming_file_provider']);
		};
		
		// Pages
		
		$this->app['moa.action.page_data.home_page'] = function($app) {
			return new PageData\HomePage($app['moa.gallery_db_provider']);
		};
		
		$this->app['moa.action.page_data.gallery_page'] = function($app) {
			return new PageData\GalleryPage($app['moa.gallery_db_provider'],
											$app['moa.image_db_provider'],
											$app['moa.tag_db_provider'],
											$app['moa.thumbnail_db_provider']);
		};
		
		$this->app['moa.action.page_data.image_page'] = function($app) {
			return new PageData\ImagePage($app['moa.image_db_provider'],
											$app['moa.gallery_db_provider'],
											$app['moa.tag_db_provider'],
											$app['moa.thumbnail_db_provider']);
		};
		
		// Actions
		
		$this->app['moa.action.gallery_put'] = function($app) {
			return new GalleryPut($app['moa.gallery_db_provider'], $app['moa.tag_db_provider']);
		};
		
		$this->app['moa.action.image_put'] = function($app) {
			return new ImagePut($app['moa.image_db_provider'], $app['moa.tag_db_provider'], $app['moa.incoming_file_service']);
		};
		
		$this->app['moa.action.tag_lookup'] = function($app) {
			return new TagLookup($app['moa.tag_db_provider']);
		};
		
		$this->app['moa.action.gallery_lookup'] = function($app) {
			return new GalleryLookup($app['moa.gallery_db_provider']);
		};

		// Templater
		
		$loader = new Twig_Loader_Filesystem('../src/backend/templates/default');
		$twig = new Twig_Environment($loader, array(
			//'cache' => 'template_cache',
		));
		
		$lexer = new \Twig_Lexer($twig, array(
			'tag_comment'   => array('{#', '#}'),
			'tag_block'     => array('{%', '%}'),
			'tag_variable'  => array('{[', ']}'),
			'interpolation' => array('#{', '}'),
		));
		$twig->setLexer($lexer);
		
		$this->app['twig'] = $twig;
	}
	
	public function AddRouting()
	{
		$this->app->get('/', 'Moa\Gallery\Controller::ShowList')->assert('id', '\d+');
		$this->app->get('/gallery/{id}', 'Moa\Gallery\Controller::ShowGallery')->assert('id', '\d+');
		$this->app->get('/gallery2/{id}', 'Moa\Gallery\Controller::ShowGallery2')->assert('id', '\d+');
		$this->app->post('/gallery2/{id}', 'Moa\Gallery\Controller::ShowGallery2')->assert('id', '\d+');
		$this->app->get('/image/{filename}', 'Moa\Image\Controller::GetImageFile')->assert('filename', '\d+\.\w+');
		$this->app->get('/image/thumb/{filename}', 'Moa\Image\Controller::GetThumbFile')->assert('filename', '\d+\.\w+');
		$this->app->get('/image/{gallery_id}/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('gallery_id', '\d+')->assert('image_id', '\d+');
		$this->app->post('/image/{gallery_id}/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('gallery_id', '\d+')->assert('image_id', '\d+');
		$this->app->get('/image/uploaded/{hash}', 'Moa\Image\Controller::ShowUploadedImage')->assert('hash', '\w+');
		
		$this->app->get('/api/thumbnail_status', 'Moa\Rest\Controller::CheckThumbnailStatus');
		$this->app->get('/api/page_data/home_page', 'Moa\Rest\Controller::PageDataHome');
		$this->app->get('/api/page_data/gallery_page/{id}', 'Moa\Rest\Controller::PageDataGallery')->assert('id', '\d+');
		$this->app->get('/api/page_data/image_page/{gallery_id}/{image_id}', 'Moa\Rest\Controller::PageDataImage')->assert('gallery_id', '\d+')->assert('image_id', '\d+');
		$this->app->match('/api/gallery/{id}', 'Moa\Rest\Controller::GalleryPut')->assert('id', '\d+')->method('PUT|POST');
		$this->app->delete('/api/gallery/{id}', 'Moa\Rest\Controller::GalleryDelete')->assert('id', '\d+');
		$this->app->match('/api/image/{id}', 'Moa\Rest\Controller::ImagePut')->assert('id', '\d+')->method('PUT|POST');
		$this->app->delete('/api/image/{id}', 'Moa\Rest\Controller::ImageDelete')->assert('id', '\d+');
		
		$this->app->get('/api/tag_lookup', 'Moa\Rest\Controller::TagLookup');
		$this->app->get('/api/gallery_lookup', 'Moa\Rest\Controller::GalleryLookup');
		
		$this->app->post('/api/upload', 'Moa\Rest\Controller::FileUpload');
	}
}