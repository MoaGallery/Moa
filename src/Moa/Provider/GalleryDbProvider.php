<?php

namespace Moa\Provider;


use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;
use Moa\Gallery;

class GalleryDbProvider
{
	/** @var  Db */
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function LoadGallery($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('moa_gallery')
			->where('IDGallery = ?')
			->setParameter(0, $id);
		$result = $qb->execute();

		if ($result->rowCount() == 0)
			return null;

		$arr = $result->fetch();
		$gallery = new Gallery();
		$gallery->SetInfo($arr);

		return $gallery;
	}

	public function GetGalleries()
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('IDGallery', 'name')
			->from('moa_gallery');
		$result = $qb->execute();

		$galleries = array();
		while ($arr = $result->fetch())
		{
			$galleries[$arr['IDGallery']] = $arr['name'];
		}

		return $galleries;
	}
}