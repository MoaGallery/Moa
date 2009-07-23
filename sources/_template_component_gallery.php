<?php
  include_once($MOA_PATH."sources/mod_gallery_funcs.php");

  function TagParseGalleryDescription($p_tag_options)
  {
    global $gallery_id;

    $desc = _GalleryGetValue($gallery_id, "Description");
    if (0 == strlen($desc))
    {
      $desc = " ";
    }
    return html_display_safe($desc);
  }

  function TagParseGalleryName($p_tag_options)
  {
    global $gallery_id;

    $name = _GalleryGetValue($gallery_id, "Name");
    if (0 == strlen($name))
    {
      $name = " ";
    }
    return html_display_safe($name);
  }

  function TagParseGalleryAdminLinks($p_tag_options)
  {
    global $gallery_id;

    if (UserIsLoggedIn())
    {
      if (!isset($p_tag_options["location"]))
      {
        if (0 == strcmp($gallery_id, "0000000000"))
        {
          $p_tag_options["location"] = "home";
        } else
        {
          $p_tag_options["location"] = "gallery";
        }
      }

      if (0 == strcmp($p_tag_options["location"], "gallery"))
      {
        $links = LoadTemplate("component_gallery_admin_links.php");
        $links = ParseVar($links, "GalleryEditLink", "onclick='gallery.Edit();'");
        $links = ParseVar($links, "GalleryDeleteLink", "onclick='gallery.Delete();'");
        $links = ParseVar($links, "ImageAddLink", "href='index.php?action=image_add&parent_id=".$gallery_id."'");
        $links = ParseVar($links, "GalleryAddLink", "href='index.php?action=gallery_add&parent_id=".$gallery_id."'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "home"))
      {
        $links = LoadTemplate("component_gallery_home_admin_links.php");
        $links = ParseVar($links, "ImageAddLink", "href='index.php?action=image_add&parent_id=".$gallery_id."'");
        $links = ParseVar($links, "GalleryAddLink", "href='index.php?action=gallery_add&parent_id=".$gallery_id."'");
        return $links;
      }
      return "";
    }
    return " ";
  }

  function TagParseGalleryImageThumbnails($p_tag_options)
  {
    global $gallery_id;
    global $THUMB_WIDTH;
    global $THUMB_PATH;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $EMPTY_DESC_POPUP_TEXT;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $MOA_PATH;

    if (($DISPLAY_PLAIN_SUBGALLERIES) && (0 != _galleryGetSubGalleryCount($gallery_id)))
    {
      return " ";
    }

    $links = LoadTemplate("component_image_thumbnail.php");
    $thumbs = "";

    $images = _galleryGetImages($gallery_id);

    foreach ($images as $image)
    {
      $thumb = "";

      if (mb_strlen($image->m_description) <= 0) {
        if ($SHOW_EMPTY_DESC_POPUPS == false)
        {
          $popup = "";
        } else
        {
          $popup = "onmouseover='overlib(\"".popup_display_safe($EMPTY_DESC_POPUP_TEXT)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }
      } else
      {
        $popup = "onmouseover='overlib(\"".popup_display_safe($image->m_description)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
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
      $thumb = ParseVar($thumb, "GalleryID", $gallery_id);
      $thumb = ParseVar($thumb, "Referer", "");
      $thumbs .= $thumb;
    }

    if (0 == strlen($thumbs))
    {
      $thumbs = " ";
    }
    return $thumbs;
  }

  function TagParseGallerySubgalleryThumbBlock($p_tag_options)
  {
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $gallery_id;

    $subs = _galleryGetSubGalleryCount($gallery_id);
    $images = _galleryGetImageCount($gallery_id);
    if ((0 == $subs) || (($DISPLAY_PLAIN_SUBGALLERIES) && (0 != $images)) || ((0 != $subs) && (0 == $images) && (!$DISPLAY_PLAIN_SUBGALLERIES)))
    {
      return " ";
    }

    return LoadTemplate("component_gallery_subgallery_thumb_block.php");
  }

  function TagParseGallerySubGalleryThumbnails($p_tag_options)
  {
    global $gallery_id;
    global $THUMB_WIDTH;
    global $THUMB_PATH;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $EMPTY_DESC_POPUP_TEXT;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $MOA_PATH;
    global $TITLE_DESC_LENGTH;

    // Check if the hidden flag is set
    if (isset($p_tag_options["hide"]))
    {
      // Sub-galleries should be hidden and we have some
      if (($DISPLAY_PLAIN_SUBGALLERIES) && (0 != _galleryGetSubGalleryCount($gallery_id)))
      {
        if (0 == strcmp($p_tag_options["hide"], "noimage"))
        {
          return " ";
        }
      } else
      {
        if (0 == strcmp($p_tag_options["hide"], "image"))
        {
          if (0 != _galleryGetImageCount($gallery_id))
          {
            return " ";
          }
        } elseif (0 == strcmp($p_tag_options["hide"], "noimage"))
        {
          if (0 == _galleryGetImageCount($gallery_id))
          {
            return " ";
          }
        }
      }
    }

    $links = LoadTemplate("component_subgallery_thumbnail.php");
    $thumbs = "";

    $galleries = _galleryGetSubGalleries($gallery_id);
    foreach ($galleries as $gallery)
    {
      // Create an Overlib popup description
      if (mb_strlen($gallery->m_description) <= 0) {
        if ($SHOW_EMPTY_DESC_POPUPS == false)
        {
          $popup = "";
        } else
        {
          $popup = "onmouseover='return overlib(\"".popup_display_safe($EMPTY_DESC_POPUP_TEXT)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }
      } else
      {
        $popup = "onmouseover='return overlib(\"".popup_display_safe($gallery->m_description)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      }

      // Choose captions of the thumbnail
      $subgallery_count = _galleryGetSubGalleryCount($gallery->m_id);
      $image_count = _galleryGetImageCount($gallery->m_id);
      $cap = "";
      if ($DISPLAY_PLAIN_SUBGALLERIES)
      {
        if ($subgallery_count > 0)
        {
          $cap =  $subgallery_count." Subgalleries<br/>";

        } else
        {
          $cap =  $image_count." Images";
        }
      } else
      {
        if ($subgallery_count > 0)
        {
          $cap =  $subgallery_count." Subgalleries<br/>";
          $cap .=  $image_count." Images";
        } else
        {
          $cap =  $image_count." Images<br/><br/>";
        }
      }

      // Set up child vars
      $child_count = 0;
      $child_name = "";
      if ($subgallery_count == 0)
      {
        $child_count = $image_count;
        $child_name = "image";
        if (1 != $image_count)
        {
          $child_name .= "s";
        }
      } else
      {
        $child_count = $subgallery_count;
        $child_name = "subgaller";
        if (1 != $subgallery_count)
        {
          $child_name .= "ies";
        } else
        {
          $child_name .= "y";
        }
      }

      $image_id = _galleryGetThumbNail($gallery->m_id);
      $width = _ImageGetValue($image_id, "Width");
      $height = _ImageGetValue($image_id, "Height");

      $thumb = ParseVar($links, "GalleryThumbID", $gallery->m_id);
      $thumb = ParseVar($thumb, "GalleryThumbWidth", str_display_safe($THUMB_WIDTH));
      $thumb = ParseVar($thumb, "GalleryThumbHeight", str_display_safe(ceil($THUMB_WIDTH*0.75)));

      if (is_bool($image_id))
      {
        $thumb = ParseVar($thumb, "GalleryThumb", "sources/_image_scaler.php?image_name=../media/empty.png&amp;display_width=".$THUMB_WIDTH);
      }
      elseif (is_file($MOA_PATH.$THUMB_PATH."/thumb_".$image_id.".jpg"))
      {
        $thumb = ParseVar($thumb, "GalleryThumb", str_display_safe($THUMB_PATH)."/thumb_".$image_id.".jpg");
      }
      else
      {
        $thumb = ParseVar($thumb, "GalleryThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$THUMB_WIDTH);
      }

      $short_desc = $gallery->m_description;
      if (60 < strlen($gallery->m_description))
      {
        $short_desc = substr($gallery->m_description, 0, 60);
        $split = split("\n", $short_desc);
        $short_desc = $split[0]."...";
      }

      $thumb = ParseVar($thumb, "GalleryThumbPopup", $popup);
      $thumb = ParseVar($thumb, "GalleryThumbCaption", $cap);
      $thumb = ParseVar($thumb, "GalleryThumbSubGalleryCount", $subgallery_count);
      $thumb = ParseVar($thumb, "GalleryThumbImageCount", $image_count);
      $thumb = ParseVar($thumb, "GalleryThumbChildCount", $child_count);
      $thumb = ParseVar($thumb, "GalleryThumbChildTypeName", $child_name);
      $thumb = ParseVar($thumb, "GalleryThumbDesc", $short_desc);
      $thumb = ParseVar($thumb, "GalleryID", $gallery_id);
      $thumb = ParseVar($thumb, "GalleryThumbTitle", str_display_safe($gallery->m_name));
      $thumb = ParseVar($thumb, "GalleryThumbTitleShort", str_display_safe(substr($gallery->m_name, 0, $TITLE_DESC_LENGTH)."..."));
      $thumbs .= $thumb;
    }

    if (0 == strlen($thumbs))
    {
      $thumbs = " ";
    }
    return $thumbs;
  }

  function TagParseGalleryDeleteFeedback($p_tag_options)
  {
    $str = ViewDeleteFeedback();

    if (0 == strlen($str))
    {
      return " ";
    }

    return $str;
  }

  function TagParseGalleryParentComboList($p_tag_options)
  {
    global $tab_prefix;
    global $gallery_id;
    global $parent_id;

    $options = "";
    $option = "";

    if (0 == strcmp("0000000000", $gallery_id))
    {
      $pid = $parent_id;
    } else
    {
      $pid = _galleryGetValue($gallery_id, "IDParent");
    }

    $query = "SELECT * FROM ".$tab_prefix."gallery;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    while ($gallery = mysql_fetch_array($result))
    {
      $option = "  <option value='".html_display_safe($gallery["IDGallery"])."'";
      if (0 == strcmp($pid, $gallery["IDGallery"]))
      {
        $option .= "selected='selected'";
      }
      $option .= ">".html_display_safe($gallery["Name"])."</option>\n";
      $options .= $option;
    }

    if (0 == strlen($options))
    {
      return " ";
    }

    return $options;
  }

  function TagParseThumbWidth($p_tag_options)
  {
    global $THUMB_WIDTH;

    $result = 0;
    if (isset($p_tag_options["add"]))
    {
      $result = $p_tag_options["add"];
    }

    $str = str_display_safe($THUMB_WIDTH + $result);
    return $str;
  }

  function TagParseThumbHeight($p_tag_options)
  {
    global $THUMB_WIDTH;

    $result = 0;
    if (isset($p_tag_options["add"]))
    {
      $result = $p_tag_options["add"];
    }

    $str = str_display_safe((($THUMB_WIDTH*0.75))+ $result);
    return $str;
  }
?>