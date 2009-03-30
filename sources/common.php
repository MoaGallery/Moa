<?php
  $MOA_MAJOR_VERSION = 1;
  $MOA_MINOR_VERSION = 1;
  $MOA_REVISION = 0;
  $MOA_VERSION = $MOA_MAJOR_VERSION.".".$MOA_MINOR_VERSION.".".$MOA_REVISION;

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
  	$p_text = str_replace("<","&lt;",$p_text);
    $p_text = str_replace(">","&gt;",$p_text);
  	$p_text = str_display_safe(addslashes($p_text));

    return $p_text;
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

  function thumbnail( $p_image_name, $p_image_type, $p_in_sources)
    {
      global $IMAGE_PATH;
      global $THUMB_PATH;
      global $THUMB_WIDTH;
      if ($p_in_sources)
      {
        $PREFIX = "";
      } else
      {
        $PREFIX = "../";
      }

      $src_img = imagecreatefromjpeg($PREFIX.$IMAGE_PATH."/".str_display_safe($p_image_name));

      $origw=imagesx($src_img);
      $origh=imagesy($src_img);

      $diff=$origw/$origh;
      if ($diff > 1.3333333)
      {
        $new_w = $THUMB_WIDTH;
        $divisor = $origw / $new_w;
        $new_h = $origh / $divisor;
      } else
      {
        $new_h = $THUMB_WIDTH*0.75;
        $divisor = $origh / $new_h;
        $new_w = $origw / $divisor;
      }

      $dst_img = imagecreatetruecolor($new_w,floor($new_h));
      imageAntiAlias($dst_img, true);
      imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));

      imagejpeg($dst_img, $PREFIX.$THUMB_PATH."/"."thumb_".str_display_safe($p_image_name));
      imagedestroy($src_img);

      return true;
    }

  function ViewDeleteFeedback()
  {
    if (isset($_REQUEST["deleted"]))
    {
      if (0 == strcmp($_REQUEST["deleted"], "image"))
      {
        moa_success("Image deleted successfully.");
      }
      if (0 == strcmp($_REQUEST["deleted"], "gallery"))
      {
        moa_success("Gallery deleted successfully.");
      }
    }
  }

?>
