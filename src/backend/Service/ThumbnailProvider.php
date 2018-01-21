<?php

namespace Moa\Service;

use Doctrine\DBAL\Query\QueryBuilder;
use Moa\Db;

class ThumbnailProvider
{
	protected $db;
	
	public function __construct(Db $db)
	{
		$this->db = $db;
	}
	
	public function DoesThumbnailExist($image_id)
	{
		return file_exists('../data/images/thumbs/' . $image_id . '.jpg');
	}
	
	public function QueueThumbnail($image_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		$qb->select('count(1) count')
			->from('moa_thumb_regen')
			->where('image_id = ?')
			->setParameter(0, $image_id);
		$result = $qb->execute();
		
		$arr = $result->fetch();
		if ($arr['count'] === '0')
		{
			$qb->insert('moa_thumb_regen')
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
			->from('moa_thumb_regen')
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
			->from('moa_thumb_regen');
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
				$qb2->delete('moa_thumb_regen')
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
		try
		{
			$info = @getimagesize('../data/images/' . $image_id . $ext);
		} catch (\Exception $e)
		{
			return false;
		}
		$image_x = $info[0];
		$image_y = $info[1];
		
		$dim_x = 282;
		$dim_y = 188;
		
		$command = 'convert ' . $input . $ext . ' -resize ' . $dim_x . 'x' . $dim_y . ' ' . $output;
		$output = [];
		exec($command, $output, $return);
		return ($return === '0');
	}
}