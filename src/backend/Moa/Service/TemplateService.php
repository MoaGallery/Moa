<?php

namespace Moa\Service;

use Twig_Environment;
use Twig_Loader_Filesystem;

class TemplateService
{
	public $twig;
	
	function __construct()
	{
		$loader = new Twig_Loader_Filesystem('../src/backend/templates/default');
		$this->twig = new Twig_Environment($loader, array(
			//'cache' => 'template_cache',
		));
		
		$lexer = new \Twig_Lexer($this->twig, array(
			'tag_comment'   => array('{#', '#}'),
			'tag_block'     => array('{%', '%}'),
			'tag_variable'  => array('{[', ']}'),
			'interpolation' => array('#{', '}'),
		));
		$this->twig->setLexer($lexer);
	}
}