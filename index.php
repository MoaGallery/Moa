<?php

use Moa\Service\ThumbnailProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once(__DIR__ . '/vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

\Moa\Bootstrap::Run($app);

$js_routes = [
	'/',
	['/gallery/{id}', '\d+']
];

foreach ($js_routes as $route)
{
	if (!is_array($route))
	{
		$app->get($route, 'Moa\Gallery\Controller::ShowList');
	} else
	{
		$url = array_shift($route);
		$temp = $app->get($url, 'Moa\Gallery\Controller::ShowList');
		
		$matches = [];
		preg_match_all('/{(\w+)}/', $url, $matches, PREG_SET_ORDER, 0);

		foreach ($route as $index => $regex)
		{
			$temp = $temp->assert($matches[$index][1], $regex);
		}
	}
}

$app->get('/gallery2/{id}', 'Moa\Gallery\Controller::ShowGallery')->assert('id', '\d+');
$app->post('/gallery2/{id}', 'Moa\Gallery\Controller::ShowGallery')->assert('id', '\d+');
$app->get('/image/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('image_id', '\d+');
$app->post('/image/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('image_id', '\d+');

$app->get('/api/thumbnail_status', 'Moa\Rest\Controller::CheckThumbnailStatus');

/** @var ThumbnailProvider $thumb_provider */
$thumb_provider = $app['moa.thumbnail_db_provider'];

$app->finish(function (Request $request, Response $response)
{
	global $thumb_provider;
	
	$thumb_provider->DoRegen(200);
});

$app->run();