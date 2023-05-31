<?php

namespace Moa\Tag;

use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Service\Db;
use Moa\Gallery;
use Moa\Image;

class DataProvider
{
	const DB_NAME = Db::DB_PREFIX . 'tag';
	
	/** @var  Db */
	protected $db;

	public function __construct(Db $db)
	{
		$this->db = $db;
	}

	public function GetAllTags()
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('id', 'name')
			->from(self::DB_NAME)
			->orderBy('name');
		$result = $qb->execute();

		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[(int)$arr['id']] = $arr['name'];
		}

		return $tags;
	}
	
	public function SearchTags(string $term, int $start, int $limit): array
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('id', 'name')
			->from(self::DB_NAME)
			->orderBy('name')
			->where("name LIKE ?")
			->setParameter(0, '%' . addcslashes($term, '%_') . '%')
			->setFirstResult($start)
			->setMaxResults($limit);
		$result = $qb->execute();
		
		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[] = [
				'id' => (string)$arr['id'],
				'text' => $arr['name']
			];
		}
		
		return $tags;
	}
	
	public function SearchTagCount(string $term): int
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('COUNT(1) AS count')
			->from(self::DB_NAME)
			->orderBy('name')
			->where("name LIKE ?")
			->setParameter(0, '%' . addcslashes($term, '%_') . '%');
		$result = $qb->execute();
		
		$arr = $result->fetch();
		return (int)$arr['count'];
	}

	public function GetTagsForGallery($gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('t.id', 't.name', 'tl.gallery_id')
			->from(self::DB_NAME, 't')
			->join('t', Gallery\DataProvider::DB_TAG_LINK_NAME, 'tl', 't.id = tl.tag_id')
			->where('tl.gallery_id = ?')
			->setParameter(0, $gallery_id);
		$result = $qb->execute();

		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[(int)$arr['id']] = $arr['name'];
		}

		return $tags;
	}
	
	public function GetTagsForImage($image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('t.id', 't.name', 'tl.image_id')
			->from(self::DB_NAME, 't')
			->join('t', Image\DataProvider::DB_TAG_LINK_NAME, 'tl', 't.id = tl.tag_id')
			->where('tl.image_id = ?')
			->setParameter(0, $image_id);
		$result = $qb->execute();
		
		$tags = array();
		while ($arr = $result->fetch())
		{
			$tags[(int)$arr['id']] = $arr['name'];
		}
		
		return $tags;
	}

	public function AddTag($tag_name)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->insert(self::DB_NAME)
			->setValue('name', '?')
			->setParameter(0, $tag_name);
		$qb->execute();

		return $this->db->Connection()->lastInsertId();
	}

	public function SaveTagsForGallery($tags, $gallery_id)
	{
		$tag_ids = [];
		foreach ($tags as $tag)
		{
			if (is_numeric($tag))
			{
				$tag_ids[] = $tag;
			} else
			{
				$tag_ids[] = $this->AddTag($tag);
			}
		}
		
		$qb = new QueryBuilder($this->db->Connection());

		$qb->delete(Gallery\DataProvider::DB_TAG_LINK_NAME)
			->where('gallery_id = ?')
			->setParameter(0, $gallery_id);
		$qb->execute();

		foreach ($tag_ids as $tag)
		{
			$qb->insert(Gallery\DataProvider::DB_TAG_LINK_NAME)
				->setValue('gallery_id', '?')
				->setValue('tag_id', '?')
				->setParameter(0, $gallery_id)
				->setParameter(1, $tag);
			$qb->execute();
		}
	}
	
	public function SaveTagsForImage($tags, $image_id)
	{
		$tag_ids = [];
		foreach ($tags as $tag)
		{
			if (is_numeric($tag))
			{
				$tag_ids[] = $tag;
			} else
			{
				$tag_ids[] = $this->AddTag($tag);
			}
		}
		
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->delete(Image\DataProvider::DB_TAG_LINK_NAME)
			->where('image_id = ?')
			->setParameter(0, $image_id);
		$qb->execute();
		
		foreach ($tag_ids as $tag)
		{
			$qb->insert(Image\DataProvider::DB_TAG_LINK_NAME)
				->setValue('image_id', '?')
				->setValue('tag_id', '?')
				->setParameter(0, $image_id)
				->setParameter(1, $tag);
			$qb->execute();
		}
	}
}
