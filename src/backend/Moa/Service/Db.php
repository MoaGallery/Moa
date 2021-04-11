<?php

namespace Moa\Service;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class Db
{
	const DB_PREFIX = '';
	/** @var \Doctrine\DBAL\Connection $conn */
	protected $conn;

	public function __construct()
	{
		$config = new Configuration();

		$connectionParams = array(
			'dbname' => 'moa2',
			'user' => 'moa2',
			'password' => 'moa2',
			'host' => 'db',
			'driver' => 'pdo_mysql',
		);
		$this->conn = DriverManager::getConnection($connectionParams, $config);
	}

	public function Connection()
	{
		return $this->conn;
	}
}
