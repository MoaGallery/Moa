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
    $link = "index.php?action=image_view_full&image_id=".$image_id;

    switch ($p_tag_options["format"])
    {
      case "text" :
      {
        $str = "View full size: <a href='".$link."'>link</a>";
        break;
      }
      case "image" :
      {
        $str = "<div onclick='document.location = \"".$link."\"'></div>";
        break;
      }
      default:
      {
        if ($DEBUG_MODE)
        {
          $str = "TEMPLATE WARNING: Unknown Link in ImageFullLink tag - '".html_display_safe($p_tag_options["format"])."'.";
        }
        break;
      }
    }

    return $str;
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
?>