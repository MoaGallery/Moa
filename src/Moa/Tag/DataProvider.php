<?php

namespace Moa\Tag;


use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;
use Moa\Gallery;

class DataProvider
{
	/** @var  Db */
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function GetAllTags()
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('IDTag', 'name')
			->from('moa_tag')
			->orderBy('name');
		$result = $qb->execute();

		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[$arr['IDTag']] = $arr['name'];
		}

		return $tags;
	}

	public function GetTagsForGallery($gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('t.IDTag', 'tl.IDGallery')
			->from('moa_tag', 't')
			->join('t', 'moa_gallerytaglink', 'tl', 't.IDTag = tl.IDTag')
			->where('tl.IDGallery = ?')
			->setParameter(0, $gallery_id);
		$result = $qb->execute();

		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[] = $arr['IDTag'];
		}

		return $tags;
	}

	public function AddTag($tag_name)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->insert('moa_tag')
			->setValue('name', '?')
			->setParameter(0, $tag_name);
		$qb->execute();

		return $this->db->Connection()->lastInsertId();
	}

	public function SaveTagsForGallery($tags, $gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->delete('moa_gallerytaglink')
			->where('IDGallery = ?')
			->setParameter(0, $gallery_id);
		$qb->execute();

		foreach ($tags as $tag)
		{
			$qb->insert('moa_gallerytaglink')
				->setValue('IDGallery', '?')
				->setValue('IDTag', '?')
				->setParameter(0, $gallery_id)
				->setParameter(1, $tag);
			$qb->execute();
		}
	}
}