<?php

namespace Moa;


use Moa\Provider\GalleryDataProvider;
use Moa\Provider\TagDataProvider;

class Gallery
{
	/** @var GalleryDataProvider $gdp */
	protected $gdp;
	/** @var TagDataProvider $gdp */
	protected $tdp;
	protected $persistent_info;
	protected $info;

	protected $tags = array();

	protected $validation_message = '';

	public function __construct(GalleryDataProvider $gdp, TagDataProvider $tdp)
	{
		$this->gdp = $gdp;
		$this->tdp = $tdp;
		$this->info['IDGallery'] = 0;
	}

	public function Load($id)
	{
		$this->SetInfo($this->gdp->LoadGalleryInfo($id));
	}

	public function Save()
	{
		$this->gdp->SaveGallery($this);

		$this->tdp->SaveTagsForGallery($this->tags, $this->info['IDGallery']);

		$this->SetClean();
	}

	public function SetClean()
	{
		$this->persistent_info = $this->info;
	}

	public function SetInfo($info)
	{
		$this->info = $info;
		$this->SetClean();
	}

	public function GetInfo()
	{
		return $this->info;
	}

	public function GetProperty($name, $persistent_copy = false)
	{
		$source = $persistent_copy ? $this->persistent_info : $this->info;

		if (array_key_exists($name, $source))
			return $source[$name];

		return null;
	}

	public function SetProperty($name, $value)
	{
		$this->info[$name] = $value;
	}

	public function Validate($gallery_list)
	{
		$status = true;
		$messages = array();

		if ($this->info['name'] == '')
		{
			$messages[] = 'Name must not be blank';
			$status = false;
		}

		if (!array_key_exists($this->info['parent_id'], $gallery_list))
		{
			$messages[] = 'Invalid parent gallery';
			$status = false;
		}

		if ($this->info['parent_id'] == $this->info['IDGallery'])
		{
			$messages[] = 'Invalid parent gallery';
			$status = false;
		}

		$this->validation_message = implode('<br>', $messages);

		return $status;
	}

	public function GetValidationMessage()
	{
		return $this->validation_message;
	}

	public function SetTags($tag_list)
	{
		$this->tags = $tag_list;
	}
}