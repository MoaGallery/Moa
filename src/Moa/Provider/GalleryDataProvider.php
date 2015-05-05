<?php

namespace Moa\Provider;


use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;
use Moa\Gallery;

class GalleryDataProvider
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

	public function GetGalleries($parent_id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('IDGallery', 'name')
			->from('moa_gallery')
			->where('parent_id = ?');
		$qb->setParameter(0, $parent_id);
		$result = $qb->execute();

		$galleries = array();
		while ($arr = $result->fetch())
		{
			$galleries[$arr['IDGallery']] = $arr['name'];
		}

		return $galleries;
	}

	public function GetParentGallery($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('moa_gallery')
			->where('IDGallery = ?');
		$qb->setParameter(0, $id);
		$result = $qb->execute();

		if ($result->rowCount() == 0)
			return null;

		$arr = $result->fetch();
		$gallery = new Gallery();
		$gallery->SetInfo($arr);

		return $gallery;
	}
}