<?php

use Symfony\Component\HttpFoundation\Response;

require_once(__DIR__ . '/vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

\Moa\Bootstrap::run($app);

$app->get('/', 'Moa\Controller\GalleryController::ShowList');
$app->get('/gallery/{id}', 'Moa\Controller\GalleryController::ShowGallery')->assert('id', '\d+');

$app->run();