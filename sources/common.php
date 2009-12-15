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
  $MOA_REVISION = 1;
  $MOA_PATCH = "a";
  $MOA_VERSION = $MOA_MAJOR_VERSION.".".$MOA_MINOR_VERSION.".".$MOA_REVISION.$MOA_PATCH;

  // Function for retrieving date\time at page load
  function get_time_at_page_load() {
    date_default_timezone_set("GMT");
    $temp = getdate();

    $mday = array( 1  => '1st' , 2  => '2nd',   3 => '3rd',   4 => '4th',
                   5  => '5th' , 6  => '6th',   7 => '7th',   8 => '8th',
                   9  => '9th' , 10 => '10th', 11 => '11th', 12 => '12th',
                   13 => '13th', 14 => '14th', 15 => '15th', 16 => '16th',
                   17 => '17th', 18 => '18th', 19 => '19th', 20 => '20th',
                   21 => '21st', 22 => '22nd', 23 => '23rd', 24 => '24th',
                   25 => '25th', 26 => '26th', 27 => '27th', 28 => '28th',
                   29 => '29th', 30 => '30th', 31 => '31st'
                 );

    $minutes = sprintf("%02s",$temp['minutes']);

    return $temp['month']." ".$mday[$temp['mday']].", ".$temp['year'].", ".$temp['hours'].":".$minutes;
  }

  function html_display_safe( $p_text) {
    $p_text = htmlspecialchars($p_text, ENT_QUOTES, "UTF-8");
    $p_text = nl2br($p_text);
    return $p_text;
  }

  function str_display_safe( $p_text) {
    $p_text = htmlspecialchars($p_text, ENT_QUOTES, "UTF-8");
    $p_text = str_replace("\x0A","<br/>",$p_text);
    $p_text = str_replace("\x0D","",$p_text);
    $p_text = str_replace("'","&apos;",$p_text);
    return str_replace('"',"&quot;",$p_text);
  }

  function js_var_display_safe( $p_text) {
    $p_text = str_replace('\\',"\\\\",$p_text);
    $p_text = str_replace("\x0A","\\n",$p_text);
    $p_text = str_replace("\x0D","",$p_text);
  	$p_text = str_replace("'","\\'",$p_text);
    $p_text = str_replace('"','\\"',$p_text);
    return $p_text;
  }

  function edit_display_safe( $p_text) {
    $p_text = htmlspecialchars($p_text, ENT_QUOTES, "UTF-8");
    return $p_text;
  }

  function popup_display_safe($p_text)
  {
    $p_text = str_display_safe(addslashes($p_text));
    $p_text = str_replace("<","&lt;",$p_text);
    $p_text = str_replace(">","&gt;",$p_text);

    return $p_text;
  }

  function StripHTMLTags($p_text)
	{
	  $BannedHTMLTagList = Array( "html"
	                            , "head"
	                            , "body"
	                            , "iframe"
	                            , "object"
	                            , "script"
	                            , "meta");

	  $CurrentPos = 0;
	  $MaxPos     = strlen($p_text);
	  $Buffer     = "";

	  while ($CurrentPos < $MaxPos) {
	    $Start = strpos($p_text, "<", $CurrentPos);
	    $End = strpos($p_text, ">", $CurrentPos);

	    if (($End === false) || ($Start === false)) {
	      $Buffer .= substr( $p_text, $CurrentPos, ($MaxPos - $CurrentPos));
	      $CurrentPos = $MaxPos;
	    }
	    else
	    {
	      $Buffer .= substr( $p_text, $CurrentPos, ($Start - $CurrentPos));

	      $Tag = substr( $p_text, ($Start + 1), ($End - $Start - 1));
	      $Tag = trim($Tag);
	      $Tag = strtolower($Tag);

	      $TagWithoutSlashes = $Tag;
	      if (0 == strcmp( substr($Tag, 0, 1), "/")) {
	        $TagWithoutSlashes = substr( $Tag, 1, (strlen($Tag) - 1));
	      }

        $NameArray = explode(" ", $TagWithoutSlashes, 1);
	      $Name = $NameArray[0];

	      $Found = false;

	      for ($i=0; $i < count($BannedHTMLTagList); $i++) {
	        if (0 == strcmp( $BannedHTMLTagList[$i], $Name)) {
	          $Found = true;
	        }
	      }

	      if ($Found == true) {
	        $Buffer .= "&lt;";
	        $Buffer .= $Tag;
	        $Buffer .= "&gt;";
	      }
	      else
	      {
	        $Buffer .= "<";
	        $Buffer .= $Tag;
	        $Buffer .= ">";
	      }
	      $CurrentPos = $End + 1;
	    }
	  }
	  return $Buffer;
  }

  function strip_magic_quotes($p_text)
  {
    $p_text = str_replace('\"', '"', $p_text);
    $p_text = str_replace("\'", "'", $p_text);
    $p_text = str_replace("\\\\", "\\", $p_text);
    $p_text = str_replace("\\\x00", "\x00", $p_text);

    return $p_text;
  }

  function magic_url_decode($p_text)
  {
    //return strip_magic_quotes(urldecode($p_text));
  	return strip_magic_quotes($p_text);
  }

  function OutputPrefix($p_message)
  {
    global $pre_cache;

    if (false == isset($pre_cache))
    {
      echo $p_message."\n";
    }
  }

  function RaiseError($p_message,$p_ierror=true)
  {
    global $ErrorString;

    if (0 == strcmp($ErrorString, "")) {
      if ($p_ierror) {
        OutputPrefix("IERROR");
      } else
      {
        OutputPrefix("ERROR");
      }
      echo $p_message;
    }
    else {
      OutputPrefix("ERROR");
      echo $ErrorString;
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
    	if ( 0 == strlen($_REQUEST[$p_name]))
    	{
    		$var = "";
    	} else
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
      if ( 0 == strlen($_REQUEST[$p_name]))
      {
        $var = "";
      } else
      {
        $var = $_REQUEST[$p_name];
      }
    }
    return $var;
  }

  function thumbnail( $p_image_name, $p_image_type, $p_in_root)
    {
      global $CFG;

      $PREFIX = "../";
      if ($p_in_root)
      {
        $PREFIX = "";
      }
      if (!CheckImageMemory($PREFIX.$CFG["IMAGE_PATH"].str_display_safe($p_image_name.".".$p_image_type)))
      {
      	return false;
      }


      switch ($p_image_type)
      {
        case "jpg" :
        {
          $src_img = @imagecreatefromjpeg($PREFIX.$CFG["IMAGE_PATH"].str_display_safe($p_image_name.".".$p_image_type));
          break;
        }
        case "png" :
        {
          $src_img = @imagecreatefrompng($PREFIX.$CFG["IMAGE_PATH"].str_display_safe($p_image_name.".".$p_image_type));
          break;
        }
        case "gif" :
        {
          $src_img = @imagecreatefromgif($PREFIX.$CFG["IMAGE_PATH"].str_display_safe($p_image_name.".".$p_image_type));
          break;
        }
        default :
        {
          return false;
        }
      }

      $origw=imagesx($src_img);
      $origh=imagesy($src_img);

      $diff=$origw/$origh;
      if ($diff > 1.3333333)
      {
        $new_w = $CFG["THUMB_WIDTH"];
        $divisor = $origw / $new_w;
        $new_h = $origh / $divisor;
      } else
      {
        $new_h = $CFG["THUMB_WIDTH"]*0.75;
        $divisor = $origh / $new_h;
        $new_w = $origw / $divisor;
      }

      $dst_img = imagecreatetruecolor($new_w,floor($new_h));
      imageAntiAlias($dst_img, true);
      imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));

      imagejpeg($dst_img, $PREFIX.$CFG["THUMB_PATH"]."thumb_".str_display_safe($p_image_name.".jpg"));
      imagedestroy($src_img);

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
  	global $ErrorString;

    $result = getimagesize($p_filename);
    if (!isset($result["channels"]))
    {
    	return true;
    }
    $picsize = $result[0] * $result[1] * $result["channels"];
    $memlimitstr = ini_get("memory_limit");
    $units = substr($memlimitstr, -1, 1);
    $memlimit = substr($memlimitstr, 0, strlen($memlimitstr)-1);
    $memused = memory_get_usage();
    switch ($units)
    {
      case "M":
      {
        $memlimit *= (1024*1024);
        break;
      }
      case 'G':
      {
        $memlimit *= (1024*1024*1024);
        break;
      }
      default :
      {
        $memlimit *= (1024);
        break;
      }
    }

    // 3.5Mb is a guess how much overhead the jpeg decoder uses (accurate for a 10megapixel image)
    if (($memused + $picsize + 3500000) > $memlimit)
    {
      $ErrorString = sprintf("Not enough memory to decode image (%.1f Mb needed, %.1f Mb available)<br/>", ($picsize/(1024*1024)), ($memlimit-$memused-3500000) / (1024*1024));
      return false;
    }
    return true;
  }
?>
