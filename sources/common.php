<?php
// Guard against false config variables being passed via the URL
// if the register_globals php setting is turned on
if (isset($_REQUEST["CFG"]))
{
	echo "Hacking attempt.";
	die();
}

$MOA_MAJOR_VERSION = 1;
$MOA_MINOR_VERSION = 2;
$MOA_REVISION = 3;
$MOA_PATCH = "";
$MOA_VERSION = $MOA_MAJOR_VERSION.".".$MOA_MINOR_VERSION.".".$MOA_REVISION.$MOA_PATCH;

// Function for retrieving date\time at page load
function get_time_at_page_load() {
	date_default_timezone_set("GMT");
	$systemTime = getdate();

	$dayWithSuffix = array( 1  => '1st' , 2  => '2nd',   3 => '3rd',   4 => '4th',
                          5  => '5th' , 6  => '6th',   7 => '7th',   8 => '8th',
                          9  => '9th' , 10 => '10th', 11 => '11th', 12 => '12th',
                          13 => '13th', 14 => '14th', 15 => '15th', 16 => '16th',
                       	  17 => '17th', 18 => '18th', 19 => '19th', 20 => '20th',
                      	  21 => '21st', 22 => '22nd', 23 => '23rd', 24 => '24th',
                          25 => '25th', 26 => '26th', 27 => '27th', 28 => '28th',
                          29 => '29th', 30 => '30th', 31 => '31st'	);

	$minutes = sprintf("%02s",$systemTime['minutes']);
	return $systemTime['month']." ".$dayWithSuffix[$systemTime['mday']].", ".$systemTime['year'].", ".$systemTime['hours'].":".$minutes;
}

function html_display_safe( $p_text) {
	$result = htmlspecialchars($p_text, ENT_QUOTES, "UTF-8");
	$result = nl2br($result);
	return $result;
}

function str_display_safe( $p_text) {
	$result = htmlspecialchars($p_text, ENT_QUOTES, "UTF-8");
	$result = str_replace("\x0A","<br />",$result);
	$result =  str_replace("\x0D","",$result);
	return $result;
}

function js_var_display_safe( $p_text) {
	$result = str_replace('\\',"\\\\",$p_text);
	$result = str_replace("\x0A","\\n",$result);
	$result = str_replace("\x0D","",$result);
	$result = str_replace("'","\\'",$result);
	$result = str_replace('"','\\"',$result);
	$result = str_replace('/','\/',$result);
	return $result;
}

function edit_display_safe( $p_text) {
	$result = htmlspecialchars($p_text, ENT_QUOTES, "UTF-8");
	return $result;
}

function popup_display_safe($p_text)
{
	$result = str_display_safe(addslashes($p_text));
	$result = str_replace("<","&lt;",$result);
	$result = str_replace(">","&gt;",$result);

	return $result;
}

function StripHTMLTags($p_text)
{
	$bannedHTMLTagList = Array( "html",
	                            "head",
	                            "body",
	                            "iframe",
	                            "object",
	                            "script",
	                            "meta",
	                            "img");

	$currentPos = 0;
	$maxPos     = strlen($p_text);
	$buffer     = "";

	while ($currentPos < $maxPos) {
		$start = strpos($p_text, "<", $currentPos);
		$end = strpos($p_text, ">", $currentPos);

		if (($end === false) || ($start === false)) {
			$buffer .= substr( $p_text, $currentPos, ($maxPos - $currentPos));
			$currentPos = $maxPos;
		}
		else
		{
			$buffer .= substr( $p_text, $currentPos, ($start - $currentPos));

			$tag = substr( $p_text, ($start + 1), ($end - $start - 1));
			$tag = trim($tag);
			$tag = strtolower($tag);

			$tagWithoutSlashes = $tag;
			if (0 == strcmp( substr($tag, 0, 1), "/")) {
				$tagWithoutSlashes = substr( $tag, 1, (strlen($tag) - 1));
			}

			$nameArray = explode(" ", $tagWithoutSlashes, 1);
			$name = $nameArray[0];

			$found = false;

			for ($i=0; $i < count($bannedHTMLTagList); $i++) {
				if (0 == strcmp( $bannedHTMLTagList[$i], $name)) {
					$found = true;
				}
			}

			if ($found == true) {
				$buffer .= "&lt;";
				$buffer .= $tag;
				$buffer .= "&gt;";
			}
			else
			{
				$buffer .= "<";
				$buffer .= $tag;
				$buffer .= ">";
			}
			$currentPos = $end + 1;
		}
	}
	return $buffer;
}

function strip_magic_quotes($p_text)
{
	$result = str_replace('\"', '"', $p_text);
	$result = str_replace("\'", "'", $result);
	$result = str_replace("\\\\", "\\", $result);
	$result = str_replace("\\\x00", "\x00", $result);

	return $result;
}

function magic_url_decode($p_text)
{
	return strip_magic_quotes($p_text);
}

function OutputPrefix($p_message)
{
	global $preCache;

	if (false == isset($preCache))
	{
		echo $p_message."\n";
	}
}

function RaiseError($p_message,$p_ierror=true)
{
	global $errorString;

	if (0 == strcmp($errorString, ""))
	{
		if ($p_ierror)
		{
			OutputPrefix("IERROR");
		} else
		{
			OutputPrefix("ERROR");
		}
		echo $p_message;
	} else
	{
		OutputPrefix("ERROR");
		echo $errorString;
	}
}

function RaiseFatalError($p_message,$p_ierror=true) {
	RaiseError($p_message,$p_ierror);
	die();
}

function GetParam($p_name)
{
	$var = false;
	if (isset($_REQUEST[$p_name]))
	{
	  $var = "";
		if ( 0 != strlen($_REQUEST[$p_name]))
		{
			$var = magic_url_decode($_REQUEST[$p_name]);
		}
	}
	return $var;
}

function GetFormParam($p_name)
{
	$var = false;
	if (isset($_REQUEST[$p_name]))
	{
	  $var = "";
		if ( 0 != strlen($_REQUEST[$p_name]))
		{
			$var = $_REQUEST[$p_name];
		}
	}
	return $var;
}

function openImage($filename)
{
  global $errorString;

  if ((!is_file($filename)) || (is_dir($filename))) {
    $errorString = 'File does not exist';
    return false;
  }

  if (!CheckImageMemory($filename))
  {
    $errorString = 'Not enough memory to process the image';
    return false;
  }

  $opened = false;

  if (is_jpeg($filename))
  {
    $imageHandle = imagecreatefromjpeg($filename);
    $opened = true;
  }

  if ((!$opened) && (is_png($filename)))
  {
    $imageHandle = imagecreatefrompng($filename);
    $opened = true;
  }

  if ((!$opened) && (is_gif($filename)))
  {
    $imageHandle = imagecreatefromgif($filename);
    $opened = true;
  }

  if (!$opened)
  {
    return false;
  }

  return $imageHandle;
}

function detectImageFormat($filename)
{
  $opened = false;

  $imageFormat = 'tits';

  if (is_jpeg($filename))
  {
    $imageFormat = 'jpg';
    $opened = true;
  }

  if ((!$opened) && (is_png($filename)))
  {
    $imageFormat = 'png';
    $opened = true;
  }

  if ((!$opened) && (is_gif($filename)))
  {
    $imageFormat = 'gif';
    $opened = true;
  }

  if (!$opened)
  {
    $imageFormat = 'unknown';
  }

  return $imageFormat;
}

function createImageThumbnail( $p_imageName, $p_imageType)
{
	global $CFG;

	$filename = $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].str_display_safe($p_imageName.".".$p_imageType);

	$imageHandle = openImage($filename);
	if (false === $imageHandle)
	{
	  return false;
	}

	$src_fmt = detectImageFormat($filename);

	$imageWidth = imagesx($imageHandle);
	$imageHeight = imagesy($imageHandle);
	$aspectRatio = $imageWidth / $imageHeight;
	if ($aspectRatio > 1.3333333)
	{
	  // Image is wider than 4:3 - dimensions determined by width
		$thumbWidth = $CFG["THUMB_WIDTH"];
		$divisor = $imageWidth / $thumbWidth;
		$thumbHeight = $imageHeight / $divisor;
	} else
	{
	  // Image is narrower than 4:3 - dimensions determined by height
		$thumbHeight = $CFG["THUMB_WIDTH"]*0.75;
		$divisor = $imageHeight / $thumbHeight;
		$thumbWidth = $imageWidth / $divisor;
	}
	$thumbHandle = imagecreatetruecolor($thumbWidth, floor($thumbHeight));
	imageAntiAlias($thumbHandle, true);
	imagecopyresampled($thumbHandle, $imageHandle,
	                   0,0,0,0,
	                   $thumbWidth, $thumbHeight,
	                   $imageWidth, $imageHeight);
	imagejpeg($thumbHandle, $CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".str_display_safe($p_imageName.".jpg"));
	imagedestroy($imageHandle);

	return true;
}

function ViewDeleteFeedback()
{
	if (isset($_REQUEST["deleted"]))
	{
		if (0 == strcmp($_REQUEST["deleted"], "image"))
		{
			return moa_success_ret("Image deleted successfully.", false);
		}
		if (0 == strcmp($_REQUEST["deleted"], "gallery"))
		{
			return moa_success_ret("Gallery deleted successfully.", false);
		}
	}
}

function TypeSafeMysqlRealEscapeString( $p_value)
{
	if (is_string($p_value))
	{
		return mysql_real_escape_string( $p_value);
	}
	return $p_value;
}

function CheckImageMemory($p_filename)
{
	global $errorString;

	$result = @getimagesize($p_filename);

	if (false === $result)
	{
		return false;
	}

	if (!isset($result["channels"]))
	{
		return true;
	}
	$picSize = $result[0] * $result[1] * $result["channels"];
	$memLimitStr = ini_get("memory_limit");
	$units = substr($memLimitStr, -1, 1);
	$memLimit = substr($memLimitStr, 0, strlen($memLimitStr)-1);
	$memUsed = memory_get_usage();
	switch ($units)
	{
		case "M":
			{
				$memLimit *= (1024*1024);
				break;
			}
		case 'G':
			{
				$memLimit *= (1024*1024*1024);
				break;
			}
		default :
			{
				$memLimit *= (1024);
				break;
			}
	}

	// 3.5Mb is a guess how much overhead the jpeg decoder uses (accurate for a 10megapixel image)
	if (($memUsed + $picSize + 3500000) > $memLimit)
	{
		$errorString = sprintf("Not enough memory to decode image (%.1f Mb needed, %.1f Mb available)<br/>", ($picSize/(1024*1024)), ($memLimit-$memUsed-3500000) / (1024*1024));
		return false;
	}

	return true;
}

function moalog($p_msg)
{
	global $CFG;
	$fp = fopen($CFG["MOA_PATH"]."debuglog.txt", "a");
	fputs($fp, ($p_msg."\n"));
	fclose($fp);
}

function _getFileSize( $p_filename)
{
  global $errorString;

	if (!is_string($p_filename))
  {
    $errorString = "Not a string";
    return false;
  }

  if (is_dir($p_filename))
  {
    $errorString = "Attempt to open directory as a file";
    return false;
  }

  $stat = @stat($p_filename);
  if (false === $stat)
  {
    $errorString = "Can't open file";
    return false;
  }

  return $stat["size"];

}

function _readFileStart( $p_filename, $p_length)
{
	global $errorString;

  if (!is_string($p_filename))
  {
    $errorString = "Not a string";
    return false;
  }

  if (is_dir($p_filename))
  {
    $errorString = "Attempt to open directory as a file";
    return false;
  }

  $stat = @stat($p_filename);
  if (false === $stat)
  {
    $errorString = "Can't open file";
    return false;
  }

  if ($stat["size"] < $p_length)
  {
    $errorString = "File too small for reading ".$p_length." bytes";
    return false;
  }

  $fp = @fopen($p_filename, 'rb');

  if ($fp === null)
  {
    $errorString = "Can't open file";
    return false;
  }

  $data = @fread($fp, $p_length);

  if ($data === false)
  {
    $errorString = "Can't read from file";
    return false;
  }

  @fclose($fp);

  return $data;
}

function is_jpeg($p_filename)
{
  global $errorString;

  $line = _readFileStart( $p_filename, 11);

  if (false === $line)
  {
  	return false;
  }

	$compare = unpack("C11", $line);

	if (!((0xff == $compare[1])  &&
	      (0xd8 == $compare[2])  &&
	      (0xff == $compare[3])
	     ))
	{
		return false;
	}

	return true;
}

function is_png($p_filename)
{
  global $errorString;

  $line = _readFileStart( $p_filename, 8);
  if (false === $line)
  {
    return false;
  }

  $compare = unpack("C8", $line);

  if (!((0x89 == $compare[1]) &&
        (0x50 == $compare[2]) &&
        (0x4E == $compare[3]) &&
        (0x47 == $compare[4]) &&
        (0x0D == $compare[5]) &&
        (0x0A == $compare[6]) &&
        (0x1A == $compare[7]) &&
        (0x0A == $compare[8])
       ))
  {
   return false;
  }

  return true;
}

function is_gif($p_filename)
{
  global $errorString;

  $line = _readFileStart( $p_filename, 3);
  if (false === $line)
  {
    return false;
  }

  $compare = unpack("C3", $line);

  if (!((0x47 == $compare[1]) &&
        (0x49 == $compare[2]) &&
        (0x46 == $compare[3])
       ))
  {
    return false;
  }

  return true;
}

function is_image($p_filename)
{
  global $errorString;

  if (20 >= _getFileSize($p_filename))
  {
  	return false;
  }

	$valid = is_jpeg($p_filename);

  if ($valid) {
	  return true;
  }

  $valid = is_gif($p_filename);

  if ($valid) {
    return true;
  }

  $valid = is_png($p_filename);

  if ($valid) {
    return true;
  }

  return false;
}

function is_zip($p_filename)
{
  global $errorString;

  if (20 >= _getFileSize($p_filename))
  {
    return false;
  }

  $line = _readFileStart( $p_filename, 2);
  if (false === $line)
  {
    return false;
  }

  $compare = unpack("C2", $line);

  if (!((0x50 == $compare[1]) &&
        (0x4B == $compare[2])
       ))
  {
    return false;
  }

  return true;
}

function DeleteFile($p_filename)
{
  if (file_exists($p_filename))
  {
    @unlink($p_filename);
  }
}

function DelTree($dir)
{
  $files = glob( $dir . '*', GLOB_MARK);
  foreach( $files as $file )
  {
    if (is_dir( $file))
    {
    	DelTree( $file );
    }
    else
    {
      unlink( $file );
    }
  }
  if (is_dir($dir))
  {
  	rmdir( $dir );
  }
}

function CheckFolderPerms($p_path)
{
  global $errorString;
  global $CFG;

  if (0 == strlen($p_path))
  {
    $errorString = 'Path not supplied';
    return false;
  }

  $testPath = $CFG['MOA_PATH'].$p_path;

  if (false === file_exists($testPath))
  {
    $errorString = 'Directory does not exist';
    return false;
  }

  // Check upload path permissions
  $folder = new _FilePerms;
  $folder->path = $p_path;
  $folder->readable = false;
  $folder->writeable = false;

  if (is_readable($testPath))
  {
    $folder->readable = true;
  }

  if (is_writeable($testPath))
  {
    $folder->writeable = true;
  }

  return $folder;
}

function IsDirectoryEmpty($p_path)
{
  $directoryEmpty = false;
  $files = null;

  if (($files = @scandir($p_path) && (count($files) <= 2)))
  {
    $directoryEmpty = true;
  }
  return $directoryEmpty;
}
?>
