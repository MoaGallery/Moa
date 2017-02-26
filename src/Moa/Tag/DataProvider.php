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

		$qb->select('id', 'name')
			->from('moa_tag')
			->orderBy('name');
		$result = $qb->execute();

		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[$arr['id']] = $arr['name'];
		}

		return $tags;
	}

	public function GetTagsForGallery($gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('t.id', 'tl.gallery_id')
			->from('moa_tag', 't')
			->join('t', 'moa_gallerytaglink', 'tl', 't.id = tl.tag_id')
			->where('tl.gallery_id = ?')
			->setParameter(0, $gallery_id);
		$result = $qb->execute();

		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[] = $arr['id'];
		}

		return $tags;
	}
	
	public function GetTagsForImage($image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('t.id', 'tl.image_id')
			->from('moa_tag', 't')
			->join('t', 'moa_imagetaglink', 'tl', 't.id = tl.tag_id')
			->where('tl.image_id = ?')
			->setParameter(0, $image_id);
		$result = $qb->execute();
		
		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[] = $arr['id'];
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
			->where('gallery_id = ?')
			->setParameter(0, $gallery_id);
		$qb->execute();

		foreach ($tags as $tag)
		{
			$qb->insert('moa_gallerytaglink')
				->setValue('gallery_id', '?')
				->setValue('tag_id', '?')
				->setParameter(0, $gallery_id)
				->setParameter(1, $tag);
			$qb->execute();
		}
	}
	
	public function SaveTagsForImage($tags, $image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->delete('moa_imagetaglink')
			->where('image_id = ?')
			->setParameter(0, $image_id);
		$qb->execute();
		
		foreach ($tags as $tag)
		{
			$qb->insert('moa_imagetaglink')
				->setValue('image_id', '?')
				->setValue('tag_id', '?')
				->setParameter(0, $image_id)
				->setParameter(1, $tag);
			$qb->execute();
		}
	}
}