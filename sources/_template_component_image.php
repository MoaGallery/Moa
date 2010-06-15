<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }


  function TagParseImageDescription($p_tag_options)
  {
    global $image_id;

    $Image = new Image();
    $Image->loadId($image_id);
    $desc = $Image->description;
    if (0 == strlen($desc))
    {
      $desc = " ";
    }
    return html_display_safe($desc);
  }

  function TagParseImageFileName($p_tag_options)
  {
    global $image_id;

    $Image = new Image();
    $Image->loadId($image_id);
    $filename = $Image->originalFilename;
    if (0 == strlen($filename))
    {
      $filename = " ";
    }
    return html_display_safe($filename);
  }

  function TagParseImageThumbName($p_tag_options)
  {
    global $image_id;
    global $CFG;

    $filename = $CFG["THUMB_PATH"]."thumb_".$image_id.".jpg";
    return html_display_safe($filename);
  }

  function TagParseImageFormat($p_tag_options)
  {
    global $image_id;

    $Image = new Image();
    $Image->loadId($image_id);
    $format = $Image->format;
    if (0 == strlen($format))
    {
      $format = " ";
    }
    return html_display_safe($format);
  }

  function TagParseImageSize($p_tag_options)
  {
    global $image_id;
    global $CFG;

    $Image = new Image();
    $Image->loadId($image_id);
    $width = $Image->width;
    $height = $Image->height;
    $str = "";

    switch ($p_tag_options["format"])
    {
      case "both" :
      {
        $str = $width."x".$height;
        break;
      }
      case "width" :
      {
        $str = $width;
        break;
      }
      case "height" :
      {
        $str = $height;
        break;
      }
      default:
      {
        if ($CFG["DEBUG_MODE"])
        {
          $str = "TEMPLATE WARNING: Unknown Link in ImageSize tag - '".html_display_safe($p_tag_options["format"])."'.";
        }
        break;
      }
    }

    return $str;
  }

  function TagParseImageFullLink($p_tag_options)
  {
    global $image_id;
    global $CFG;

    $str = "";
    $link = "index.php?action=image_view_full&amp;image_id=".$image_id;

    return $link;
  }

  function TagParseImagePreview($p_tag_options)
  {
    return LoadTemplate("component_image_preview_frame.php");
  }

  function TagParseImageID($p_tag_options)
  {
    global $image_id;

    $id = "0000000000";
    if (isset($image_id))
    {
     $id = $image_id;
    }

    return $id;
  }

  function TagParseParentID($p_tag_options)
  {
    global $parent_id;

    $id = "0000000000";
    if (isset($parent_id))
    {
     $id = $parent_id;
    }

    return $id;
  }

  function TagParseImageNextID($p_tag_options)
  {
    global $image_id;
    global $parent_id;

    $Gallery = new Gallery();
    $result = $Gallery->getNextImage($parent_id, $image_id);

    if ((is_bool($result)) && (!$result))
    {
      return "Error";
    }

    return $result;
  }

  function TagParseImagePreviousID($p_tag_options)
  {
    global $image_id;
    global $parent_id;

    $Gallery = new Gallery();
    $result =$Gallery->getPreviousImage($parent_id, $image_id);

    if ((is_bool($result)) && (!$result))
    {
      return "Error";
    }

    return $result;
  }

  function TagParseImagePreviewWidth($p_tag_options)
  {
    global $CFG;
    global $image_id;

    if (!isset($image_id))
    {
      return 0;
    }

    $Image = new Image();
    $Image->loadId($image_id);
    $width = $Image->width;
    $height = $Image->height;

    $max_height = $CFG["CONFIG_DISPLAY_MAX_WIDTH"] / 1.33333333;
    $aspectratio = $width / $height;

    $result = 0;
    if ($aspectratio >= 1.33333333)
    {
      if ($width < $CFG["CONFIG_DISPLAY_MAX_WIDTH"])
      {
        $result = $width;
      } else
      {
        $result = $CFG["CONFIG_DISPLAY_MAX_WIDTH"];
      }
    } else
    {
      $aspectratio = $height / $max_height;
      if (1 < $aspectratio)
      {
        $result = $width / $aspectratio;
      } else
      {
        $result = $width;
      }
    }

    if (isset($p_tag_options["add"]))
    {
      $result += $p_tag_options["add"];
    }

    return floor($result);
  }

  function TagParseImagePreviewHeight($p_tag_options)
  {
    global $CFG;
    global $image_id;

    $Image = new Image();
    $Image->loadId($image_id);
    $width = $Image->width;
    $height = $Image->height;

    $max_height = $CFG["CONFIG_DISPLAY_MAX_WIDTH"] / 1.33333333;
    $aspectratio = $width / $height;

    $result = 0;
    if ($aspectratio >= 1.33333333)
    {
      $aspectratio = $width / $CFG["CONFIG_DISPLAY_MAX_WIDTH"];
      if (1 < $aspectratio)
      {
        $result = $height / $aspectratio;
      }
      {
        $result = $height;
      }
    } else
    {
      $result = $CFG["CONFIG_DISPLAY_MAX_WIDTH"] / 1.33333333;
    }

    if (isset($p_tag_options["add"]))
    {
      $result += $p_tag_options["add"];
    }

    return floor($result);
  }

?>