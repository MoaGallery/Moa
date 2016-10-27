<?php

namespace Moa\Provider;


use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;
use Moa\Gallery;

class GalleryDataProvider
{
	/** @var Db Db */
	protected $db;

	/** @var TagDataProvider $tdp */
	protected $tdp;

	public function __construct($db, TagDataProvider $tdp)
	{
		$this->db = $db;
		$this->tdp = $tdp;
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

		$gallery = new Gallery($this, $this->tdp);
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

	public function GetAllGalleries()
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
		$gallery = new Gallery($this, $this->tdp);
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
				->setValue('parent_id', '?')
				->setValue('combined_view', '?')
				->setValue('use_tags', '?')

				->setParameter(0, $info['name'])
				->setParameter(1, $info['description'])
				->setParameter(2, $info['parent_id'])
				->setParameter(3, $info['combined_view'])
				->setParameter(4, $info['use_tags']);
			$qb->execute();
			$gallery->SetProperty('IDGallery', $this->db->Connection()->lastInsertId());
		} else
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->update('moa_gallery')
				->set('name', '?')
				->set('description', '?')
				->set('parent_id', '?')
				->set('combined_view', '?')
				->set('use_tags', '?')
				->where('IDGallery = ?')

				->setParameter(0, $info['name'])
				->setParameter(1, $info['description'])
				->setParameter(2, $info['parent_id'])
				->setParameter(3, $info['combined_view'])
				->setParameter(4, $info['use_tags'])
				->setParameter(5, $info['IDGallery']);
			$qb->execute();
		}

		$gallery->SetClean();
	}
}