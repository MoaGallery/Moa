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

  $displayMaxWidth = $CFG["CONFIG_DISPLAY_MAX_WIDTH"];
  if (isset($_REQUEST["display_width"]))
  {
    $displayMaxWidth = $_REQUEST["display_width"];
  }
  
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
      $imageHandle = @imagecreatefrompng($_REQUEST["image_name"]);
    }
    else
    {
      $filename = "../".$CFG["IMAGE_PATH"].$_REQUEST["image_name"];
      
      $imageHandle = openImage($filename);
      if (false === $imageHandle)
      {
        return false;
      }
    }

    if (!$imageHandle )
    {
      //header("Location: ../media/img_scale_error.png");
    }
    else {
      header("Content-type: image/jpg");

      $imageWidth = imagesx($imageHandle);
      $imageHeight = imagesy($imageHandle);

      $resizedWidth = $imageWidth;
      $resizedHeight = $imageHeight;
      $aspectRatio = $imageWidth / $imageHeight;

      if (!(($imageWidth <= $displayMaxWidth) && ($imageHeight <= ($displayMaxWidth * 0.75))))
      {
        if ($aspectRatio > 1.3333333)
        {
          $resizedWidth = $displayMaxWidth;
          $divisor = $imageWidth / $resizedWidth;
          $resizedHeight = $imageHeight / $divisor;
        } else
        {
          $resizedHeight = $displayMaxWidth * 0.75;
          $divisor = $imageHeight / $resizedHeight;
          $resizedWidth = $imageWidth / $divisor;
        }
      }

      $resizedImageHandle = imagecreatetruecolor($resizedWidth,floor($resizedHeight));
      imageAntiAlias($resizedImageHandle, true);
      imagecopyresampled($resizedImageHandle,$imageHandle,
                         0,0,0,0,
                         $resizedWidth,$resizedHeight,
                         $imageWidth, $imageHeight);

      imagejpeg($resizedImageHandle);
      imagedestroy($imageHandle);
    }
  }
?>
