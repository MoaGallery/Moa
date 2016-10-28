<?php

namespace Moa;

use Moa\Db;
use Moa\Gallery;
use Moa\Tag;
use Silex\Application;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Bootstrap
{
	public static function Run(Application &$app)
	{
		$db = new Db();
		$app['db'] = $db;

		$app['moa.tag_db_provider'] = function($app)
		{
			return new Tag\DataProvider($app['db']);
		};

		$app['moa.gallery_db_provider'] = function($app)
		{
			return new Gallery\DataProvider($app['db'], $app['moa.tag_db_provider']);
		};

		$loader = new Twig_Loader_Filesystem('templates/default');
		$twig = new Twig_Environment($loader, array(
			//'cache' => 'template_cache',
		));
		$app['twig'] = $twig;
	}
}