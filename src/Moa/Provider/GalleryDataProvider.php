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

	public function LoadGalleryInfo($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('moa_gallery')
			->where('IDGallery = ?')
			->setParameter(0, $id);
		$result = $qb->execute();

		if ($result->rowCount() == 0)
			return null;

		$info = $result->fetch();

		return $info;
	}

	public function LoadGallery($id)
	{
		$info = $this->LoadGalleryInfo($id);

		$gallery = new Gallery($this);
		$gallery->SetInfo($info);

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
		$gallery = new Gallery($this);
		$gallery->SetInfo($arr);

		return $gallery;
	}

	public function SaveGallery(Gallery $gallery)
	{
		$info = $gallery->GetInfo();

		if ($info['IDGallery'] == 0)
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->insert('moa_gallery')
				->setValue('name', '?')
				->setValue('description', '?')

				->setParameter(0, $info['name'])
				->setParameter(1, $info['description']);
			$qb->execute();
			$gallery->SetProperty('IDGallery', $this->db->Connection()->lastInsertId());
		} else
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->update('moa_gallery')
				->set('name', '?')
				->set('description', '?')
				->where('IDGallery = ?')

				->setParameter(0, $info['name'])
				->setParameter(1, $info['description'])
				->setParameter(2, $info['IDGallery']);
			$qb->execute();
		}

		$gallery->SetClean();
	}
}