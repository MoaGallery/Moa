<?php

use Moa\Service\ThumbnailProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once(__DIR__ . '/../src/backend/vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

$bootstrap = new \Moa\Bootstrap($app);
$bootstrap->AddServices();
$bootstrap->AddRouting();

/** @var ThumbnailProvider $thumb_provider */
$thumb_provider = $app['moa.thumbnail_db_provider'];

$app->finish(function (Request $request, Response $response, \Silex\Application $app)
{
	global $thumb_provider;
	
	// TODO: Daemonise this bit
	$thumb_provider->DoRegen(200);
});

$app->run();