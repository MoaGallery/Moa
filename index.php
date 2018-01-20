<?php

use Moa\Service\ThumbnailProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once(__DIR__ . '/vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

\Moa\Bootstrap::Run($app);

$app->get('/', 'Moa\Gallery\Controller::ShowList')->assert('id', '\d+');
$app->get('/gallery/{id}', 'Moa\Gallery\Controller::ShowGallery')->assert('id', '\d+');
$app->get('/gallery2/{id}', 'Moa\Gallery\Controller::ShowGallery2')->assert('id', '\d+');
$app->post('/gallery2/{id}', 'Moa\Gallery\Controller::ShowGallery2')->assert('id', '\d+');
$app->get('/image/{gallery_id}/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('gallery_id', '\d+')->assert('image_id', '\d+');
$app->post('/image/{gallery_id}/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('gallery_id', '\d+')->assert('image_id', '\d+');
$app->get('/image/uploaded/{hash}', 'Moa\Image\Controller::ShowUploadedImage')->assert('hash', '\w+');

$app->get('/api/thumbnail_status', 'Moa\Rest\Controller::CheckThumbnailStatus');
$app->get('/api/page_data/home_page', 'Moa\Rest\Controller::PageDataHome');
$app->get('/api/page_data/gallery_page/{id}', 'Moa\Rest\Controller::PageDataGallery')->assert('id', '\d+');
$app->get('/api/page_data/image_page/{gallery_id}/{image_id}', 'Moa\Rest\Controller::PageDataImage')->assert('gallery_id', '\d+')->assert('image_id', '\d+');
$app->match('/api/gallery/{id}', 'Moa\Rest\Controller::GalleryPut')->assert('id', '\d+')->method('PUT|POST');
$app->delete('/api/gallery/{id}', 'Moa\Rest\Controller::GalleryDelete')->assert('id', '\d+');
$app->match('/api/image/{id}', 'Moa\Rest\Controller::ImagePut')->assert('id', '\d+')->method('PUT|POST');
$app->delete('/api/image/{id}', 'Moa\Rest\Controller::ImageDelete')->assert('id', '\d+');

$app->get('/api/tag_lookup', 'Moa\Rest\Controller::TagLookup');
$app->get('/api/gallery_lookup', 'Moa\Rest\Controller::GalleryLookup');

$app->post('/api/upload', 'Moa\Rest\Controller::FileUpload');

/** @var ThumbnailProvider $thumb_provider */
$thumb_provider = $app['moa.thumbnail_db_provider'];

$app->finish(function (Request $request, Response $response, \Silex\Application $app)
{
	global $thumb_provider;
	
	// TODO: Daemonise this bit
	$thumb_provider->DoRegen(200);
});

$app->run();