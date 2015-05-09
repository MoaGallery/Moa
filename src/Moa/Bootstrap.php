<?php

namespace Moa;

use Moa\Provider\GalleryDataProvider;
use Moa\Provider\TagDataProvider;
use Silex\Application;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Bootstrap
{
	public static function Run(Application &$app)
	{
		$db = new \Moa\Db();
		$app['db'] = $db;

		$app['moa.tag_db_provider'] = function($app)
		{
			return new TagDataProvider($app['db']);
		};

		$app['moa.gallery_db_provider'] = function($app)
		{
			return new GalleryDataProvider($app['db'], $app['moa.tag_db_provider']);
		};

		$loader = new Twig_Loader_Filesystem('templates/default');
		$twig = new Twig_Environment($loader, array(
			//'cache' => 'template_cache',
		));
		$app['twig'] = $twig;
	}
}