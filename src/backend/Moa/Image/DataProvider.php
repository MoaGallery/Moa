<?php

namespace Moa\Image;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Service\Db;
use Moa\Tag;
use Moa\Gallery;

class DataProvider
{
	const DB_NAME = Db::DB_PREFIX . 'image';
	const DB_TAG_LINK_NAME = Db::DB_PREFIX . 'imagetaglink';
	
	/** @var Db Db */
	protected $db;

	/** @var Tag\DataProvider $tdp */
	protected $tdp;

	public function __construct(Db $db, Tag\DataProvider $tdp)
	{
		$this->db = $db;
		$this->tdp = $tdp;
	}

	public function LoadImageInfo($id)
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
	
	public function LoadImagesByGallery($gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$where = $qb->expr()->andX();
		$where->add('gtl.gallery_id = ?');
		$where->add('itl.tag_id = gtl.tag_id');
		$where->add('io.gallery_id = ?');
		$where->add('io.image_id = itl.image_id');
		$where->add('i.id = itl.image_id');
		
		$qb->select('i.*')
			->from(self::DB_NAME, 'i')
			->from(self::DB_TAG_LINK_NAME, 'itl')
			->from(Gallery\DataProvider::DB_TAG_LINK_NAME, 'gtl')
			->from(Gallery\DataProvider::DB_IMAGE_ORDER_NAME, 'io')
			->where($where)
			->groupBy('itl.image_id, io.sequence')
			->having('COUNT(itl.tag_id) = (SELECT COUNT(tag_id) FROM ' . Gallery\DataProvider::DB_TAG_LINK_NAME . ' WHERE gallery_id = ?)')
			->setParameter(0, $gallery_id)
			->setParameter(1, $gallery_id)
			->setParameter(2, $gallery_id)
			->orderBy('io.sequence', 'ASC');
		$result = $qb->execute();
		
		$image_data = [];
		$image_ids = [];
		while ($arr = $result->fetch())
		{
			$image_data[] = $arr;
			$image_ids[] = (int)$arr['id'];
		}
		
		// Look up matching images without an order
		$qb = new QueryBuilder($this->db->Connection());
		
		$where = $qb->expr()->andX();
		$where->add('gtl.gallery_id = ?');
		$where->add('itl.tag_id = gtl.tag_id');
		$where->add('i.id = itl.image_id');
		$where->add('i.id NOT IN (?)');
		
		$qb->select('i.*')
			->from(self::DB_NAME, 'i')
			->from(self::DB_TAG_LINK_NAME, 'itl')
			->from(Gallery\DataProvider::DB_TAG_LINK_NAME, 'gtl')
			->where($where)
			->groupBy('itl.image_id, i.id')
			->having('COUNT(itl.tag_id) = (SELECT COUNT(tag_id) FROM ' . Gallery\DataProvider::DB_TAG_LINK_NAME . ' WHERE gallery_id = ?)')
			->setParameter(0, $gallery_id)
			->setParameter(1, $image_ids, Connection::PARAM_INT_ARRAY)
			->setParameter(2, $gallery_id)
			->orderBy('i.id', 'ASC');
		$result = $this->db->Connection()->executeQuery($qb->getSQL(), [$gallery_id, $image_ids, $gallery_id], [null, Connection::PARAM_INT_ARRAY]);
		if ($result->rowCount() > 0)
		{
			// Rewrite the order of existing images
			$order = 0;
			$this->db->Connection()->beginTransaction();
			foreach ($image_ids as $order_id => $image_id)
			{
				$update_qb = new QueryBuilder($this->db->Connection());
				$update_qb->update(Gallery\DataProvider::DB_IMAGE_ORDER_NAME, 'o')
					->set('o.sequence', $order++)
					->where('o.gallery_id = ?', 'o.image_id = ?');
				$update_qb->setParameter(0, $gallery_id);
				$update_qb->setParameter(1, $image_id);
				$update_qb->execute();
			}
			$this->db->Connection()->commit();
			
			// Add a new entry for new images
			while ($arr = $result->fetch())
			{
				$image_data[] = $arr;
				$insert_qb = new QueryBuilder($this->db->Connection());
				$insert_qb->insert(Gallery\DataProvider::DB_IMAGE_ORDER_NAME)
					->values([
						'gallery_id' => $gallery_id,
						'image_id' => (int)$arr['id'],
						'sequence' => $order++
					]);
				$insert_qb->execute();
			}
		}
		
		$images = array();
		foreach ($image_data as $image_arr)
		{
			$image = new Model($this, $this->tdp);
			$image->SetInfo($image_arr);
			$images[] = $image;
		}
		
		return $images;
	}

	public function LoadImage($id)
	{
		$info = $this->LoadImageInfo($id);

		$gallery = new Model($this, $this->tdp);
		$gallery->SetInfo($info);

		return $gallery;
	}
	public function SaveImage(Model &$image)
	{
		$info = $image->GetInfo();
		
		if ($info['id'] == 0)
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->insert(self::DB_NAME)
				->setValue('filename', '?')
				->setValue('description', '?')
				->setValue('width', '?')
				->setValue('height', '?')
				->setValue('format', '?')
				
				->setParameter(0, $info['filename'])
				->setParameter(1, $info['description'])
				->setParameter(2, $info['width'])
				->setParameter(3, $info['height'])
				->setParameter(4, $info['format']);
			$qb->execute();
			$image->SetProperty('id', $this->db->Connection()->lastInsertId());
		} else
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->update(self::DB_NAME)
				->set('description', '?')
				->where('id = ?')
				
				->setParameter(0, $info['description'])
				->setParameter(1, $info['id']);
			$qb->execute();
		}
		
		$image->SetClean();
	}
	
	public function DeleteImage($id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->delete(self::DB_TAG_LINK_NAME)
			->where('image_id = ?')
			->setParameter(0, $id);
		$qb->execute();
		
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('format')
			->from(self::DB_NAME)
			->where('id = ?')
			->setParameter(0, $id);
		$res = $qb->execute();
		$arr = $res->fetch();
		$format = $arr['format'];
		
		$qb = new QueryBuilder($this->db->Connection());
		$qb->delete(self::DB_NAME)
			->where('id = ?')
			->setParameter(0, $id);
		$qb->execute();
		
		@unlink('../data/images/thumbs/' . $id . '.jpg');
		@unlink('../data/images/' . $id . '.' . $format);
	}
	
	public function GetFirstImageIdImageByGalleryTags(int $gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$where = $qb->expr()->andX();
		$where->add('gallery_id = ?');
		$where->add('itl.tag_id = gtl.tag_id');
		
		$qb->select('itl.image_id')
			->from(self::DB_TAG_LINK_NAME, 'itl')
			->from(Gallery\DataProvider::DB_TAG_LINK_NAME, 'gtl')
			->where($where)
			->groupBy('itl.image_id')
			->having('COUNT(itl.tag_id) = (SELECT COUNT(tag_id) FROM ' . Gallery\DataProvider::DB_TAG_LINK_NAME . ' WHERE gallery_id = ?)')
			->setParameter(0, $gallery_id)
			->setParameter(1, $gallery_id)
			->setMaxResults(1)
			->orderBy('itl.image_id', 'ASC');
		$result = $qb->execute();

		if ($result->rowCount() === 0)
			return 0;
		
		$arr = $result->fetch();
		return (int)$arr['image_id'];
	}
	
	protected function GetPosition(int $gallery_id, $image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('sequence')
			->from(Gallery\DataProvider::DB_IMAGE_ORDER_NAME)
			->where(
				'gallery_id = ?',
				'image_id = ?')
			->setParameter(0, $gallery_id)
			->setParameter(1, $image_id);
		$result = $qb->execute();
		return $result->fetchColumn();
	}
	
	public function MoveToBefore(int $image_id, int $gallery_id, int $target_id)
	{
		$source_position = (int)$this->GetPosition($gallery_id, $image_id);
		$target_position = (int)$this->GetPosition($gallery_id, $target_id) - 1;
		
		if ($source_position === $target_position)
			return;
		
		$extra_shift = 0;
		$qb = new QueryBuilder($this->db->Connection());
		$qb->update(Gallery\DataProvider::DB_IMAGE_ORDER_NAME);
		
		// Shift the subset between them
		if ($source_position < $target_position)
		{
			$qb->set('sequence', 'sequence - 1')
				->where('sequence > ?', 'sequence <= ?')
				->setParameter(0, $source_position)
				->setParameter(1, $target_position);
		} else
		{
			$qb->set('sequence', 'sequence + 1')
				->where('sequence > ?', 'sequence < ?')
				->setParameter(0, $target_position)
				->setParameter(1, $source_position);
			$extra_shift = 1;
		}
		$qb->execute();
		
		// Update the image
		$qb = new QueryBuilder($this->db->Connection());
		$qb->update(Gallery\DataProvider::DB_IMAGE_ORDER_NAME)
			->set('sequence', $target_position + $extra_shift)
			->where('gallery_id = ?', 'image_id = ?')
			->setParameter(0, $gallery_id)
			->setParameter(1, $image_id);
		$qb->execute();
	}
}

