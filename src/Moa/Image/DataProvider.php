<?php

namespace Moa\Image;

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

	public function LoadImageInfo($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('moa_image')
			->where('id = ?')
			->setParameter(0, $id);
		$result = $qb->execute();

		if ($result->rowCount() == 0)
			return null;

		$info = $result->fetch();

		return $info;
	}
	
	public function LoadImagesByGalleryTags($gallery_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$where = $qb->expr()->andX();
		$where->add('gallery_id = ?');
		$where->add('itl.tag_id = gtl.tag_id');
		
		$qb->select('itl.image_id')
			->from('moa_imagetaglink', 'itl')
			->from('moa_gallerytaglink', 'gtl')
			->where($where)
			->groupBy('itl.image_id')
			->having('COUNT(itl.tag_id) = (SELECT COUNT(tag_id) FROM moa_gallerytaglink WHERE gallery_id = ?)')
			->setParameter(0, $gallery_id)
			->setParameter(1, $gallery_id);
		$result = $qb->execute();
		
		/*
		SELECT itl.image_id
		       FROM moa_gallerytaglink gtl, moa_imagetaglink itl
		       WHERE gallery_id = 79
		             AND itl.tag_id = gtl.tag_id
		GROUP BY itl.image_id
		HAVING COUNT(itl.tag_id) = (SELECT COUNT(tag_id)
		       FROM moa_gallerytaglink
		       WHERE gallery_id = 79)
		 */
		
		$image_ids = array();
		while ($arr = $result->fetch())
		{
			$image_ids[] = (int)$arr['image_id'];
		}
		
		$images = array();
		
		if (count($image_ids) > 0)
		{
			$qb = new QueryBuilder($this->db->Connection());
			$qb->select('*')
				->from('moa_image')
				->where($qb->expr()->in('id', $image_ids));
			$result = $qb->execute();
			
			while ($arr = $result->fetch())
			{
				$image = new Model($this, $this->tdp);
				$image->SetInfo($arr);
				$images[] = $image;
			}
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
}