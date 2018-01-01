<?php

namespace Moa;

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
		
		$app['moa.image_db_provider'] = function($app)
		{
			return new Image\DataProvider($app['db'], $app['moa.tag_db_provider']);
		};
		
		$app['moa.thumbnail_db_provider'] = function($app)
		{
			return new Service\ThumbnailProvider($app['db']);
		};

		$loader = new Twig_Loader_Filesystem('templates/default');
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
		
		$app['twig'] = $twig;
	}
}