<?php

use Symfony\Component\HttpFoundation\Response;

require_once(__DIR__ . '/vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

\Moa\Bootstrap::Run($app);

$app->get('/', 'Moa\Gallery\Controller::ShowList');
$app->get('/gallery/{id}', 'Moa\Gallery\Controller::ShowGallery')->assert('id', '\d+');
$app->post('/gallery/{id}', 'Moa\Gallery\Controller::ShowGallery')->assert('id', '\d+');

$app->get('/image/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('image_id', '\d+');
$app->post('/image/{image_id}', 'Moa\Image\Controller::ShowImage')->assert('image_id', '\d+');

$app->run();