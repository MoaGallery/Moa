<?php
  /* -----------------------------------------------*/
  /*  Image scaler 1.0 (PHP)                        */
  /*  Copyright (c)2008 Richard Talbutt \ Dan Brown */
  /*                                                */
  /*  Loads and scales down a image to the given    */
  /*  dimensions returning a JPG object that may be */
  /*  used for display via an IMG tag.              */
  /*                                                */
  /*  URL Params: image_name                        */
  /*                                                */
  /* -----------------------------------------------*/

  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once("_settings.php");
  LoadSettings();

  include_once("common.php");

  if (isset($_REQUEST["display_width"])) {
    $display_max_width = $_REQUEST["display_width"];
  }
  else
  {
    $display_max_width = $CFG["CONFIG_DISPLAY_MAX_WIDTH"];
  }

  $width = 0;
  $height = 0;
  $w = 0;
  $h = 0;

  if (isset($_REQUEST["image_name"]) == false)
  {
    // Image Name is not set
    header("Location: ../media/img_scale_error.png");
  } else
  {
  	if (!CheckImageMemory("../".$CFG["IMAGE_PATH"].$_REQUEST["image_name"]))
  	{
      // Not enough memory to process this image
  		header("Location: ../media/img_scale_error.png");
  		exit();
  	}
    if (mb_strpos($_REQUEST["image_name"], "/") != false) {
      $src_img = @imagecreatefrompng($_REQUEST["image_name"]);
    }
    else
    {
      $src_img = @imagecreatefromjpeg("../".$CFG["IMAGE_PATH"].$_REQUEST["image_name"]);

      if (!$src_img)
      {
        $src_img = @imagecreatefrompng("../".$CFG["IMAGE_PATH"].$_REQUEST["image_name"]);
      }

      if (!$src_img)
      {
        $src_img = @imagecreatefromgif("../".$CFG["IMAGE_PATH"].$_REQUEST["image_name"]);
      }
    }

    if (!$src_img )
    {
      header("Location: ../media/img_scale_error.png");
    }
    else {
      header("Content-type: image/jpg");

      $width = imagesx($src_img);
      $height = imagesy($src_img);

      if (($width > $display_max_width) or ($height > ($display_max_width*0.75)))
      {
        $w = $width / $display_max_width;
        $h = $height / ($display_max_width * 0.75);
        if ($w > $h)
        {
          $width = $display_max_width;
          $height = $height / $w;
        } else
        {
          $width = $width / $h;
          $height = $display_max_width * 0.75;
        }
      }

      $dst_img = imagecreatetruecolor($width,floor($height));
      imageAntiAlias($dst_img, true);
      imagecopyresampled($dst_img,$src_img,0,0,0,0,$width,$height,imagesx($src_img),imagesy($src_img));

      imagejpeg($dst_img);
      imagedestroy($src_img);
    }
  }
?>
