<?php

namespace Moa\Actions;

use Moa\Image;
use Moa\Gallery;

class GalleryFindThumb
{
	protected $image_provider;
	protected $gallery_provider;
	
	protected $checked_galleries = [];
	
	public function __construct(Image\DataProvider $image_provider, Gallery\DataProvider $gallery_provider)
	{
		$this->image_provider = $image_provider;
		$this->gallery_provider = $gallery_provider;
	}
	
	public function GalleryFindThumb(Gallery\Model $gallery): int
	{
		$this->checked_galleries = [];
		return $this->FindThumb($gallery);
	}
	
	protected function FindThumb(Gallery\Model $gallery): int
	{
		$gallery_id = $gallery->GetProperty('id');
		if (in_array($gallery_id, $this->checked_galleries))
			return 0;
		
		$image_id = 0;
		
		if ($gallery->GetProperty('combined_view') == 1)
		{
			$this->checked_galleries[] = $gallery_id;
			$image_id = $this->image_provider->GetFirstImageIdImageByGalleryTags($gallery_id);
		}
		
		if ($image_id === 0)
		{
			$galleries = $this->gallery_provider->GetGalleries($gallery_id);

			foreach ($galleries as $id => $obj)
			{
				$gal = $this->gallery_provider->LoadGallery($id);
				if ($image_id === 0)
					$image_id = $this->FindThumb($gal);
			}
		}
		
		return $image_id;
	}
}