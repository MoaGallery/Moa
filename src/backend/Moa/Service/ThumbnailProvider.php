<?php

namespace Moa\Service;

use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Actions\ImageResize;

class ThumbnailProvider
{
	const DB_NAME = Db::DB_PREFIX . 'thumb_regen';
	
	protected $db;
	protected $resize_action;
	
	public function __construct(Db $db, ImageResize $resize_action)
	{
		$this->db = $db;
		$this->resize_action = $resize_action;
	}
	
	public function DoesThumbnailExist($image_id)
	{
		return file_exists('../data/images/thumbs/' . $image_id . '.jpg');
	}
	
	public function QueueThumbnail($image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('count(1) count')
			->from(self::DB_NAME)
			->where('image_id = ?')
			->setParameter(0, $image_id);
		$result = $qb->execute();
		
		$arr = $result->fetch();
		if ($arr['count'] === '0')
		{
			$qb->insert(self::DB_NAME)
				->values(
				[
					'image_id' => '?'
				])
				->setParameter(0, $image_id);
			$qb->execute();
		}
	}
	
	public function IsThumbnailQueued($image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('count(1) count')
			->from(self::DB_NAME)
			->where('image_id = ?')
			->setParameter(0, $image_id);
		$result = $qb->execute();
		
		$arr = $result->fetch();
		return ((int)$arr['count'] > 0);
	}
	
	public function DoRegen($run_milliseconds)
	{
		$run_seconds = $run_milliseconds / 1000;
		
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('image_id')
			->from(self::DB_NAME);
			//->orderBy('id', 'desc');
		$result = $qb->execute();
		
		$start = microtime(true);
		while ($result !== null)
		{
			$arr = $result->fetch();
			$image_id = (int)$arr['image_id'];
	
			$generated = $this->GenerateThumbnail($image_id);
			
			if ((!$generated) ||
				($this->DoesThumbnailExist($image_id)))
			{
				$qb2 = new QueryBuilder($this->db->Connection());
				$qb2->delete(self::DB_NAME)
					->where('image_id = ?')
					->setParameter(0, $image_id);
				$qb2->execute();
			}
			
			$now = microtime(true);
			if ($now > ($start + $run_seconds))
				return;
		}
	}
	
	protected function GenerateThumbnail($image_id)
	{
		$ext = '.jpg';
		$input = '../data/images/' . $image_id;
		if (!file_exists($input . $ext))
			$ext = '.png';
		if (!file_exists($input . $ext))
			return false;
		
		$output = '../data/images/thumbs/' . $image_id . '.jpg';
		$output_wide = '../data/images/thumbs/' . $image_id . '-w.jpg';
		
		$this->resize_action->Resize($input . $ext, $output, ImageResize::THUMB_WIDTH, ImageResize::THUMB_HEIGHT, ImageResize::RESIZE_FIT);
		return $this->resize_action->Resize($input . $ext, $output_wide, ImageResize::THUMB_WIDTH_WIDE, ImageResize::THUMB_HEIGHT_WIDE, ImageResize::RESIZE_FIT);
	}
}