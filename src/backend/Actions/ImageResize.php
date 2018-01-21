<?php

namespace Moa\Actions;

class ImageResize
{
	const RESIZE_ABSOLUTE = 1;
	const RESIZE_FIT = 2;
	
	const THUMB_WIDTH = 282;
	const THUMB_HEIGHT = 188;
	
	const STANDARD_WIDTH = 800;
	const STANDARD_HEIGHT = 600;
	
	
	public function Resize(string $in_file, string $out_file, int $width, int $height, int $type = self::RESIZE_ABSOLUTE): bool
	{
		try
		{
			$info = @getimagesize($in_file);
		} catch (\Exception $e)
		{
			return false;
		}
		
		$command = '';
		
		if ($type === self::RESIZE_ABSOLUTE)
		{
			$command = 'convert ' . $in_file . ' -thumbnail ' . $width . 'x' . $height . ' ' . $out_file;
		}
		
		if ($type === self::RESIZE_FIT)
		{
			$command = 'convert ' . $in_file . " -thumbnail '" . $width . 'x' . $height . ">' " . $out_file;
		}
		
		$output = [];
		exec($command, $output, $return);
		return ($return === '0');
	}
}