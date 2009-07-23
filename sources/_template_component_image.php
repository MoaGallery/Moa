<?php

  function TagParseImageDescription($p_tag_options)
  {
    global $image_id;

    $desc = _ImageGetValue($image_id, "Description");
    if (0 == strlen($desc))
    {
      $desc = " ";
    }
    return html_display_safe($desc);
  }

  function TagParseImageFileName($p_tag_options)
  {
    global $image_id;

    $filename = _ImageGetValue($image_id, "Filename");
    if (0 == strlen($filename))
    {
      $filename = " ";
    }
    return html_display_safe($filename);
  }

  function TagParseImageThumbName($p_tag_options)
  {
    global $image_id;
    global $THUMB_PATH;

    $filename = $THUMB_PATH."/thumb_".$image_id.".jpg";
    return html_display_safe($filename);
  }

  function TagParseImageSize($p_tag_options)
  {
    global $image_id;
    global $DEBUG_MODE;

    $width = _ImageGetValue($image_id, "Width");
    $height = _ImageGetValue($image_id, "Height");
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
        if ($DEBUG_MODE)
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
    global $DEBUG_MODE;

    $str = "";
    $link = "index.php?action=image_view_full&amp;image_id=".$image_id;

    return $link;
  }

  function TagParseImageAdminLinks($p_tag_options)
  {
    if (UserIsLoggedIn())
    {
      $links = LoadTemplate("component_image_admin_links.php");
      $links = ParseVar($links, "ImageEditLink", "onclick='image.Edit();'");
      $links = ParseVar($links, "ImageDeleteLink", "onclick='image.Delete();'");
      return $links;
    }
    return " ";
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

    $result = _GalleryGetNextImage($parent_id, $image_id);

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

    $result = _GalleryGetPreviousImage($parent_id, $image_id);

    if ((is_bool($result)) && (!$result))
    {
      return "Error";
    }

    return $result;
  }

  function TagParseImagePreviewWidth($p_tag_options)
  {
    global $CONFIG_DISPLAY_MAX_WIDTH;
    global $image_id;

    if (!isset($image_id))
    {
      return 0;
    }

    $width = _ImageGetValue($image_id, "Width");
    $height = _ImageGetValue($image_id, "Height");

    $max_height = $CONFIG_DISPLAY_MAX_WIDTH / 1.33333333;
    $aspectratio = $width / $height;

    $result = 0;
    if ($aspectratio >= 1.33333333)
    {
      $result = $CONFIG_DISPLAY_MAX_WIDTH;
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
    global $CONFIG_DISPLAY_MAX_WIDTH;
    global $image_id;

    $width = _ImageGetValue($image_id, "Width");
    $height = _ImageGetValue($image_id, "Height");

    $max_height = $CONFIG_DISPLAY_MAX_WIDTH / 1.33333333;
    $aspectratio = $width / $height;

    $result = 0;
    if ($aspectratio >= 1.33333333)
    {
      $aspectratio = $width / $CONFIG_DISPLAY_MAX_WIDTH;
      if (1 < $aspectratio)
      {
        $result = $height / $aspectratio;
      }
      {
        $result = $height;
      }
    } else
    {
      $result = $CONFIG_DISPLAY_MAX_WIDTH / 1.33333333;
    }

    if (isset($p_tag_options["add"]))
    {
      $result += $p_tag_options["add"];
    }

    return floor($result);
  }

?>