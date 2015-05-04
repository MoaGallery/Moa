<?php

namespace Moa;


use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class Db
{
	/** @var \Doctrine\DBAL\Connection $conn */
	protected $conn;

	public function __construct()
	{
		$config = new Configuration();

		$connectionParams = array(
			'dbname' => 'moa',
			'user' => 'moa',
			'password' => 'moa',
			'host' => 'localhost',
			'driver' => 'pdo_mysql',
		);
		$this->conn = DriverManager::getConnection($connectionParams, $config);
	}

	public function Connection()
	{
		return $this->conn;
	}
}