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
$app->get('/image/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('image_id', '\d+');
$app->post('/image/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('image_id', '\d+');

$app->get('/api/thumbnail_status', 'Moa\Rest\Controller::CheckThumbnailStatus');
$app->get('/api/page_data/home_page', 'Moa\Rest\Controller::PageDataHome');
$app->get('/api/page_data/gallery_page/{id}', 'Moa\Rest\Controller::PageDataGallery')->assert('id', '\d+');
$app->put('/api/gallery/{id}', 'Moa\Rest\Controller::GalleryPut')->assert('id', '\d+');

/** @var ThumbnailProvider $thumb_provider */
$thumb_provider = $app['moa.thumbnail_db_provider'];

$app->finish(function (Request $request, Response $response)
{
	global $thumb_provider;
	
	$thumb_provider->DoRegen(200);
});

$app->run();