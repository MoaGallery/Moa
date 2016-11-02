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
			->where('IDImage = ?')
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
		$where->add('IDGallery = ?');
		$where->add('itl.IDTag = gtl.IDTag');
		
		$qb->select('itl.IDImage')
			->from('moa_imagetaglink', 'itl')
			->from('moa_gallerytaglink', 'gtl')
			->where($where)
			->groupBy('itl.IDImage')
			->having('COUNT(itl.IDTag) = (SELECT COUNT(IDTag) FROM moa_gallerytaglink WHERE IDGallery = ?)')
			->setParameter(0, $gallery_id)
			->setParameter(1, $gallery_id);
		$result = $qb->execute();
		
		/*
		SELECT itl.IDImage
		       FROM moa_gallerytaglink gtl, moa_imagetaglink itl
		       WHERE IDGallery = 79
		             AND itl.IDTag = gtl.IDTag
		GROUP BY itl.IDImage
		HAVING COUNT(itl.IDTag) = (SELECT COUNT(IDTag)
		       FROM moa_gallerytaglink
		       WHERE IDGallery = 79)
		 */
		
		$image_ids = array();
		while ($arr = $result->fetch())
		{
			$image_ids[] = (int)$arr['IDImage'];
		}
		
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('*')
			->from('moa_image')
			->where($qb->expr()->in('IDImage', $image_ids));
		$result = $qb->execute();
		
		$images = array();
		while ($arr = $result->fetch())
		{
			$image = new Model($this, $this->tdp);
			$image->SetInfo($arr);
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
}