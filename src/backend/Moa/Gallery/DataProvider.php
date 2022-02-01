<?php

namespace Moa\Gallery;

use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Service\Db;
use Moa\Tag;
use Moa\Image;

class DataProvider
{
	const DB_NAME = Db::DB_PREFIX . 'gallery';
	const DB_THUMB_NAME = Db::DB_PREFIX . 'gallerythumb';
	const DB_TAG_LINK_NAME = Db::DB_PREFIX . 'gallerytaglink';
	
	/** @var Db Db */
	protected $db;

	/** @var Tag\DataProvider $tdp */
	protected $tdp;

	public function __construct(Db $db, Tag\DataProvider $tdp)
	{
		$this->db = $db;
		$this->tdp = $tdp;
	}

	public function LoadGalleryInfo($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from(self::DB_NAME)
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

		$qb->select('id', 'name', 'gt.image_id AS thumb_id')
			->from(self::DB_NAME, 'g')
			->leftJoin('g', self::DB_THUMB_NAME, 'gt', 'g.id = gt.gallery_id')
			->where('parent_id = ?')
			->orderBy('id', 'ASC');
		$qb->setParameter(0, $parent_id);
		$result = $qb->execute();

		$galleries = array();
		while ($arr = $result->fetch())
		{
			$galleries[$arr['id']] =
			[
				'name' => $arr['name'],
				'thumb_id' => $arr['thumb_id']
			];
		}

		return $galleries;
	}

	public function GetAllGalleries(): array
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('id', 'name', 'parent_id', 'gt.image_id AS thumb_id')
			->from(self::DB_NAME, 'g')
			->leftJoin('g', self::DB_THUMB_NAME, 'gt', 'g.id = gt.gallery_id');
		$result = $qb->execute();

		$galleries = array();
		while ($arr = $result->fetch())
		{
			$galleries[] = [
				'id' => (int)$arr['id'],
				'parentId' => (int)$arr['parent_id'],
				'name' => $arr['name'],
				'thumbId' => (int)$arr['thumb_id']
			];
		}

		return $galleries;
	}

	public function GetParentGallery($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from(self::DB_NAME)
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
		
		$id = $info['id'];

		if ($info['id'] == 0)
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->insert(self::DB_NAME)
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
			$id = $this->db->Connection()->lastInsertId();
			$gallery->SetProperty('id', $id);
		} else
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->update(self::DB_NAME)
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
		
		return $id;
	}
	
	public function DeleteGallery($id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->delete(self::DB_TAG_LINK_NAME)
			->where('gallery_id = ?')
			->setParameter(0, $id);
		$qb->execute();
		
		$qb = new QueryBuilder($this->db->Connection());
		$qb->delete(self::DB_NAME)
			->where('id = ?')
			->setParameter(0, $id);
		$qb->execute();
	}
	
	public function SearchGalleries(string $term, int $start, int $limit): array
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
		
		if (($term !== '') &&
			(strpos('homepage', $term) !== false))
		{
			array_unshift($tags, [
				'id' => 0,
				'text' => 'Homepage'
			]);
		}
		
		return $tags;
	}
	
	public function SearchGalleryCount(string $term): int
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
	
	public function GetGalleryThumbId($gallery_id): int
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('image_id')
			->from(self::DB_THUMB_NAME)
			->where("gallery_id = ?")
			->setParameter(0, $gallery_id);
		$result = $qb->execute();
		
		$arr = $result->fetch();
		
		if ($result->rowCount() === 0)
			return -1;
		
		return (int)$arr['image_id'];
	}
	
	public function SetGalleryThumbId(int $gallery_id, int $image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		if ($this->GetGalleryThumbId($gallery_id) === -1)
		{
			$qb->insert(self::DB_THUMB_NAME)
				->values(
					[
						'gallery_id' => '?',
						'image_id' => '?',
						'auto' => '1'
					])
				->setParameter(0, $gallery_id)
				->setParameter(1, $image_id);
		} else
		{
			$qb->update(self::DB_THUMB_NAME)
				->set('image_id', $image_id)
				->where("gallery_id = ?")
				->setParameter(0, $gallery_id);
		}
		
		$result = $qb->execute();
	}
	
	public function IsGalleryThumbAuto($gallery_id): int
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('auto')
			->from(self::DB_THUMB_NAME)
			->where("gallery_id = ?")
			->setParameter(0, $gallery_id);
		$result = $qb->execute();
		
		$arr = $result->fetch();
		
		if ($result->rowCount() === 0)
			return true;
		
		return (bool)$arr['auto'];
	}
	
	public function LoadGalleriesByImage($image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$where = $qb->expr()->andX();
		$where->add('image_id = ?');
		$where->add('itl.tag_id = gtl.tag_id');
		
		$qb->select('gallery_id')
			->from(Image\DataProvider::DB_TAG_LINK_NAME, 'itl')
			->from(self::DB_TAG_LINK_NAME, 'gtl')
			->where($where)
			->groupBy('gallery_id')
			->having('COUNT(gtl.tag_id) = (SELECT COUNT(tag_id) FROM ' . self::DB_TAG_LINK_NAME . ' WHERE gallery_id = gtl.gallery_id)')
			->setParameter(0, $image_id)
			->orderBy('gtl.gallery_id', 'ASC');
		$result = $qb->execute();
		
		/*
		SELECT gallery_id
		       FROM moa_gallerytaglink gtl, moa_imagetaglink itl
		       WHERE image_id = 307
		             AND itl.tag_id = gtl.tag_id
		GROUP BY gallery_id
		HAVING COUNT(gtl.tag_id) = (SELECT COUNT(tag_id)
		       FROM moa_gallerytaglink
		       WHERE gallery_id = gtl.gallery_id)
		 */
		
		$gallery_ids = array();
		while ($arr = $result->fetch())
		{
			$gallery_ids[] = (int)$arr['gallery_id'];
		}
		
		$galleries = array();
		
		if (count($gallery_ids) > 0)
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->select('*')
				->from(self::DB_NAME)
				->where($qb->expr()->in('id', $gallery_ids));
			$result = $qb->execute();
			
			while ($arr = $result->fetch())
			{
				$gallery = new Model($this, $this->tdp);
				$gallery->SetInfo($arr);
				$galleries[] = $gallery;
			}
		}
		
		return $galleries;
	}
}
