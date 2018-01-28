<?php

namespace Moa\Service;

class IncomingFileService
{
	/** @var IncomingFileDataProvider $data_provider */
	protected $data_provider;
	
	public function __construct(IncomingFileDataProvider $data_provider)
	{
		$this->data_provider = $data_provider;
	}
	
	public function AddFile($temp_filename, $filename, $path)
	{
		$matches = [];
		preg_match('/.(\w+)$/', $filename, $matches);
		$extension = $matches[1];
		
		$new_id = $this->data_provider->AddFile($filename, time(), $extension);
		
		$hash = sha1($new_id . '_' . $filename);
		
		$this->data_provider->AddHash($new_id, $hash);
		
		move_uploaded_file($path . '/' . $temp_filename, '../data/incoming/' . $new_id);
		
		return $hash;
	}
	
	public function GetFileBody($hash)
	{
		$file = $this->data_provider->GetFileId($hash);
		return '../data/incoming/' . $file;
	}
	
	public function GetFileInfo($hash)
	{
		return $this->data_provider->GetFileInfo($hash);
	}
}