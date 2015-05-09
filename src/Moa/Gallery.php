<?php

namespace Moa;


use Moa\Provider\GalleryDataProvider;

class Gallery
{
	/** @var GalleryDataProvider $gdp */
	protected $gdp;
	protected $persistent_info;
	protected $info;
	protected $validation_message = '';

	public function __construct(GalleryDataProvider $gdp)
	{
		$this->gdp = $gdp;
		$this->info['IDGallery'] = 0;
	}

	public function Load($id)
	{
		$this->SetInfo($this->gdp->LoadGalleryInfo($id));
	}

	public function Save()
	{
		$this->gdp->SaveGallery($this);
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

		if ($this->info['name'] == '')
		{
			$messages[] = 'Name must not be blank';
			$status = false;
		}

		$this->validation_message = implode('<br>', $messages);

		return $status;
	}

	public function GetValidationMessage()
	{
		return $this->validation_message;
	}
}