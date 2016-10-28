<?php

namespace Moa\Provider;


use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;
use Moa\Image;

class ImageDataProvider
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

	public function LoadImage($id)
	{
		$info = $this->LoadImageInfo($id);

		$gallery = new Image($this, $this->tdp);
		$gallery->SetInfo($info);

		return $gallery;
	}
}