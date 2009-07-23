<?php
  include_once($MOA_PATH."sources/mod_image_funcs.php");
  include_once($MOA_PATH."sources/_integrity_funcs.php");

  function TagParseAdminLinks($p_tag_options)
  {
    if (UserIsLoggedIn())
    {
      $links = LoadTemplate("component_admin_links.php");

      $links = ParseVar($links, "AdminUserLink", "index.php?action=admin_users");
      $links = ParseVar($links, "AdminTagLink", "index.php?action=admin_tag");
      $links = ParseVar($links, "AdminOrphanLink", "index.php?action=admin_orphans");
      $links = ParseVar($links, "AdminIntegrityLink", "index.php?action=admin_maintain");

      return $links;
    }

   return " ";
  }

  function TagParseAdminUserAddLink($p_tag_options)
  {
    return "onclick='user_list.Add()'";
  }

  function TagParseAdminTagAddLink($p_tag_options)
  {
    return "onclick='tag_list.ShowAdd()'";
  }

  function TagParseAdminTagAddBlock($p_tag_options)
  {
    return LoadTemplate("component_admin_tag_block.php");
  }

  function TagParseAdminTagSubmitLink($p_tag_options)
  {
    return "onclick='tag_list.SubmitAdd(document.getElementById(\"tag_add_input\").value);'";
  }

  function TagParseAdminTagCancelLink($p_tag_options)
  {
    return "onclick='tag_list.CancelAdd();'";
  }

  function TagParseAdminOrphanNonTagged($p_tag_options)
  {
    global $THUMB_WIDTH;
    global $THUMB_PATH;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $EMPTY_DESC_POPUP_TEXT;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $MOA_PATH;

    $links = LoadTemplate("component_image_thumbnail.php");
    $thumbs = "";

    $images = GetNonTaggedOrphans();

    foreach ($images as $image)
    {
      if (mb_strlen($image->m_description) <= 0) {
        if ($SHOW_EMPTY_DESC_POPUPS == false)
        {
          $popup = "";
        } else
        {
          $popup = "onmouseover='return overlib(\"".popup_display_safe($EMPTY_DESC_POPUP_TEXT)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }
      } else
      {
        $popup = "onmouseover='return overlib(\"".popup_display_safe($image->m_description)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      }
      $width = _ImageGetValue($image->m_id, "Width");
      $height = _ImageGetValue($image->m_id, "Height");

      $thumb = $links;

      if (is_file($THUMB_PATH."/thumb_".$image->m_id.".jpg"))
      {
        $thumb = ParseVar($thumb, "ImageThumb", str_display_safe($THUMB_PATH)."/thumb_".$image->m_id.".jpg");
      }
      else
      {
        $thumb = ParseVar($thumb, "ImageThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$THUMB_WIDTH);
      }

      $thumb = ParseVar($thumb, "ImageThumbID", $image->m_id);
      $thumb = ParseVar($thumb, "ImageThumbWidth", str_display_safe($THUMB_WIDTH));
      $thumb = ParseVar($thumb, "ImageThumbHeight", (ceil($THUMB_WIDTH*0.75)));
      $thumb = ParseVar($thumb, "ImagePopup", $popup);
      $thumb = ParseVar($thumb, "GalleryID", "0000000000");
      $thumb = ParseVar($thumb, "Referer", "&amp;referer=orphan");
      $thumbs .= $thumb;
    }

    if (0 == strlen($thumbs))
    {
      $thumbs = " ";

      if (isset($p_tag_options["success"]))
      {
        $thumbs = $p_tag_options["success"];
      }
    }
    return $thumbs;
  }

  function TagParseAdminOrphanNoGallery($p_tag_options)
  {
    global $THUMB_WIDTH;
    global $THUMB_PATH;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $EMPTY_DESC_POPUP_TEXT;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $MOA_PATH;

    $links = LoadTemplate("component_image_thumbnail.php");
    $thumbs = "";

    $images = GetNoGalleryOrphans();

    foreach ($images as $image)
    {
      if (mb_strlen($image->m_description) <= 0) {
        if ($SHOW_EMPTY_DESC_POPUPS == false)
        {
          $popup = "";
        } else
        {
          $popup = "onmouseover='return overlib(\"".popup_display_safe($EMPTY_DESC_POPUP_TEXT)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }
      } else
      {
        $popup = "onmouseover='return overlib(\"".popup_display_safe($image->m_description)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      }
      $width = _ImageGetValue($image->m_id, "Width");
      $height = _ImageGetValue($image->m_id, "Height");

      $thumb = $links;

      if (is_file($MOA_PATH.$THUMB_PATH."/thumb_".$image->m_id.".jpg"))
      {
        $thumb = ParseVar($thumb, "ImageThumb", str_display_safe($THUMB_PATH)."/thumb_".$image->m_id.".jpg");
      }
      else
      {
        $thumb = ParseVar($thumb, "ImageThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$THUMB_WIDTH);
      }

      $thumb = ParseVar($thumb, "ImageThumbID", $image->m_id);
      $thumb = ParseVar($thumb, "ImageThumbWidth", str_display_safe($THUMB_WIDTH));
      $thumb = ParseVar($thumb, "ImageThumbHeight", (ceil($THUMB_WIDTH*0.75)));
      $thumb = ParseVar($thumb, "ImagePopup", $popup);
      $thumb = ParseVar($thumb, "GalleryID", "0000000000");
      $thumb = ParseVar($thumb, "Referer", "&amp;referer=orphan");
      $thumbs .= $thumb;
    }

    if (0 == strlen($thumbs))
    {
      $thumbs = " ";

      if (isset($p_tag_options["success"]))
      {
        $thumbs = $p_tag_options["success"];
      }
    }
    return $thumbs;
  }

  function TagParseAdminNoFileMaintain($p_tag_options)
  {
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $tab_prefix;
    global $MOA_PATH;

    $output = "";
    $found = false;

    $query = "SELECT * FROM ".$tab_prefix."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while (($image = mysql_fetch_array($result)) && (!$found))
    {
      if ((file_exists($MOA_PATH.$IMAGE_PATH."/".$image["IDImage"].".jpg") == false) ||
         (file_exists($MOA_PATH.$THUMB_PATH."/thumb_".$image["IDImage"].".jpg") == false))
      {
        $found = true;
      }
    }

    if (!$found)
    {
      if (isset($p_tag_options["success"]))
      {
        $output = $p_tag_options["success"];
      }
    } else
    {
      $output = LoadTemplate("component_admin_no_file_maintain_header.php");
    }

    if (strlen($output) == 0)
    {
      $output = " ";
    }

    return $output;
  }

  function TagParseAdminNoFileMaintainList($p_tag_options)
  {
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $TITLE_DESC_LENGTH;
    global $tab_prefix;
    global $MOA_PATH;

    $result_line = LoadTemplate("component_admin_no_file_maintain.php");
    $fixed_line  = LoadTemplate("component_admin_no_file_maintain_fixed.php");
    $output      = "";

    // Options defaults
    if (!isset($p_tag_options["foundtext"]))
    {
      $p_tag_options["foundtext"] = "";
    }
    if (!isset($p_tag_options["notfoundtext"]))
    {
      $p_tag_options["notfoundtext"] = "Missing";
    }

    $query = "SELECT * FROM ".$tab_prefix."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while ($image = mysql_fetch_array($result))
    {
      $image_exists = file_exists($MOA_PATH.$IMAGE_PATH."/".$image["IDImage"].".jpg");
      $thumb_exists = file_exists($MOA_PATH.$THUMB_PATH."/thumb_".$image["IDImage"].".jpg");

      if ((!$image_exists) || (!$thumb_exists))
      {
        $line = $result_line;
        if ((!$thumb_exists) && ($image_exists))
        {
          $line = $fixed_line;
          // Create Thumbnail from existing full image
          thumbnail($image["IDImage"].".jpg", NULL, true);
        }

        $main_status = $p_tag_options["notfoundtext"];
        if ($image_exists)
        {
          $main_status = $p_tag_options["foundtext"];
        }

        $thumb_status = $p_tag_options["notfoundtext"];
        if ($thumb_exists)
        {
          $thumb_status = $p_tag_options["foundtext"];
        }

        $desc = $image["Description"];
        if (strlen($desc) > $TITLE_DESC_LENGTH)
        {
          $desc = substr( $desc, 0, $TITLE_DESC_LENGTH - 3)."...";
        }

        $line = ParseVar( $line, "ImageMainStatus"  , $main_status);
        $line = ParseVar( $line, "ImageThumbStatus" , $thumb_status);
        $line = ParseVar( $line, "ImageDescription" , html_display_safe($desc));
        $line = ParseVar( $line, "ImageID"          , $image["IDImage"]);
        $line = ParseVar( $line, "ImageFileName"    , html_display_safe($image["Filename"]));

        $output .= $line;
      }
    }

    if (strlen($output) == 0)
    {
      $output = " ";
    }
    return $output;
  }
?>