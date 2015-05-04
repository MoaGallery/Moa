<?php

namespace Moa;


class Gallery
{
	protected $info;

	public function SetInfo($info)
	{
		$this->info = $info;
	}

	public function GetInfo()
	{
		return $this->info;
	}

	public function GetProperty($name)
	{
		if (array_key_exists($name, $this->info))
			return $this->info[$name];

		return null;
	}

	public function SetProperty($name, $value)
	{
		$this->info[$name] = $value;
	}
}