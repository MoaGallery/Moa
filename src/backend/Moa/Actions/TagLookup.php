<?php

namespace Moa\Actions;

use Moa\Tag;

class TagLookup
{
	protected $data_provider;
	
	public function __construct(Tag\DataProvider $data_provider)
	{
		$this->data_provider = $data_provider;
	}
	
	public function DoLookup(string $term, string $type, int $page): array
	{
		$results = $this->data_provider->SearchTags($term, ($page * 10), 10);
		$total = $this->data_provider->SearchTagCount($term);
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