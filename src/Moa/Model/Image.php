<?php

namespace Moa\Model;


use Moa\Provider\ImageDataProvider;
use Moa\Provider\TagDataProvider;

class Image
{
	/** @var ImageDataProvider $idp */
	protected $idp;
	/** @var TagDataProvider $gdp */
	protected $tdp;
	protected $persistent_info;
	protected $info;

	protected $tags = array();

	protected $validation_message = '';

	public function __construct(ImageDataProvider $idp, TagDataProvider $tdp)
	{
		$this->idp = $idp;
		$this->tdp = $tdp;
		$this->info['IDImage'] = 0;
	}

	public function Load($id)
	{
		$this->SetInfo($this->idp->LoadImageInfo($id));
	}

	public function Save()
	{
		//$this->idp->SaveImage($this);
		//$this->idp->SaveTagsForImage($this->tags, $this->info['IDImage']);
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

	public function Validate()
	{
		$status = true;
		$messages = array();

//		$this->validation_message = implode('<br>', $messages);

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