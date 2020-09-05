<?php

namespace Moa\Actions;

use Moa\Image;
use Moa\Gallery;
use Moa\Service\IncomingFileService;
use Moa\Tag;

class ImageMove
{
	protected $image_provider;
	
	function __construct(Image\DataProvider $image_provider)
	{
		$this->image_provider = $image_provider;
	}
	
	function ImageMove(int $gallery_id, int $image_id, string $position, int $target_id)
	{
		if ($position === 'before')
			$this->image_provider->MoveToBefore($image_id, $gallery_id, $target_id);
		elseif ($position === 'after')
			$this->image_provider->MoveToAfter($image_id, $gallery_id, $target_id);
	}
}
