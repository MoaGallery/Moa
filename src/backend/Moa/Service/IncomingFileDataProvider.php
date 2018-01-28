<?php

namespace Moa\Service;

use Doctrine\DBAL\Query\QueryBuilder;

class IncomingFileDataProvider
{
	protected $db;
	
	public function __construct(Db $db)
	{
		$this->db = $db;
	}
	
	public function AddFile(string $filename, int $timestamp, string $extension) : int
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->insert('moa_incoming')
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
		$qb->update('moa_incoming')
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
			->from('moa_incoming')
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
			->from('moa_incoming')
			->where('hash = ?')
			->setParameter(0, $hash);
		$result = $qb->execute();
		
		if ($result->rowCount() == 0)
			return null;
		
		$info = $result->fetch();
		
		return $info;
	}
}