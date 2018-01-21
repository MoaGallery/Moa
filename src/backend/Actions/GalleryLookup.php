<?php

namespace Moa\Actions;

use Moa\Gallery;

class GalleryLookup
{
	protected $data_provider;
	
	public function __construct(Gallery\DataProvider $data_provider)
	{
		$this->data_provider = $data_provider;
	}
	
	public function DoLookup(string $term, string $type, int $page): array
	{
		$results = $this->data_provider->SearchGalleries($term, ($page * 10), 10);
		$total = $this->data_provider->SearchGalleryCount($term);
		$more = false;
		if ($total > (($page + 1) * 10))
			$more = true;
		
		return [
			'results' => $results,
			'pagination' => [
				'more' => $more
			]
		];
	}
}