<?php

namespace Moa\Service;

use Doctrine\DBAL\Query\QueryBuilder;

class IncomingFileDataProvider
{
	const DB_NAME = Db::DB_PREFIX . 'incoming';
	
	protected $db;
	
	public function __construct(Db $db)
	{
		$this->db = $db;
	}
	
	public function AddFile(string $filename, int $timestamp, string $extension) : int
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->insert(self::DB_NAME)
			->values(
			[
				'filename' => '?',
				'timestamp' => '?',
				'extension' => '?',
			])
			->setParameter(0, $filename)
			->setParameter(1, $timestamp)
			->setParameter(2, $extension);
		$qb->execute();
		
		return $this->db->Connection()->lastInsertId();
	}
	
	public function AddHash(int $file_id, string $hash)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->update(self::DB_NAME)
			->set('hash', '?')
			->setParameter(0, $hash)
			->where('id = ?')
			->setParameter(1, $file_id);
		$qb->execute();
	}
	
	public function GetFileId($hash)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('id')
			->from(self::DB_NAME)
			->where('hash = ?')
			->setParameter(0, $hash);
		$result = $qb->execute();
		
		if ($result->rowCount() == 0)
			return null;
		
		$info = $result->fetch();
		
		return $info['id'];
	}
	
	public function GetFileInfo($hash)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('id, filename, extension')
			->from(self::DB_NAME)
			->where('hash = ?')
			->setParameter(0, $hash);
		$result = $qb->execute();
		
		if ($result->rowCount() == 0)
			return null;
		
		$info = $result->fetch();
		
		return $info;
	}
}