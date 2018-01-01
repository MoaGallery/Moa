<?php

namespace Moa\Gallery;

use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;
use Moa\Tag;

class DataProvider
{
	/** @var Db Db */
	protected $db;

	/** @var Tag\DataProvider $tdp */
	protected $tdp;

	public function __construct($db, Tag\DataProvider $tdp)
	{
		$this->db = $db;
		$this->tdp = $tdp;
	}

	public function LoadGalleryInfo($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('moa_gallery')
			->where('id = ?')
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

		$gallery = new Model($this, $this->tdp);
		$gallery->SetInfo($info);

		return $gallery;
	}

	public function GetGalleries($parent_id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('id', 'name')
			->from('moa_gallery')
			->where('parent_id = ?');
		$qb->setParameter(0, $parent_id);
		$result = $qb->execute();

		$galleries = array();
		while ($arr = $result->fetch())
		{
			$galleries[$arr['id']] = $arr['name'];
		}

		return $galleries;
	}

	public function GetAllGalleries()
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('id', 'name')
			->from('moa_gallery');
		$result = $qb->execute();

		$galleries = array();
		while ($arr = $result->fetch())
		{
			$galleries[$arr['id']] = $arr['name'];
		}

		return $galleries;
	}

	public function GetParentGallery($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('moa_gallery')
			->where('id = ?');
		$qb->setParameter(0, $id);
		$result = $qb->execute();

		if ($result->rowCount() == 0)
			return null;

		$arr = $result->fetch();
		$gallery = new Model($this, $this->tdp);
		$gallery->SetInfo($arr);

		return $gallery;
	}

	public function SaveGallery(Model $gallery)
	{
		$info = $gallery->GetInfo();

		if ($info['id'] == 0)
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
			$gallery->SetProperty('id', $this->db->Connection()->lastInsertId());
		} else
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->update('moa_gallery')
				->set('name', '?')
				->set('description', '?')
				->set('parent_id', '?')
				->set('combined_view', '?')
				->set('use_tags', '?')
				->where('id = ?')

				->setParameter(0, $info['name'])
				->setParameter(1, $info['description'])
				->setParameter(2, $info['parent_id'])
				->setParameter(3, $info['combined_view'])
				->setParameter(4, $info['use_tags'])
				->setParameter(5, $info['id']);
			$qb->execute();
		}

		$gallery->SetClean();
	}
}