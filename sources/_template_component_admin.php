<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_bulkupload_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_integrity_funcs.php");

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

  function TagParseAdminOrphanNoGallery($p_tag_options)
  {
    global $CFG;

    $links = LoadTemplate("component_image_thumbnail.php");
    $thumbs = "";

    $images = GetNoGalleryOrphans();

    foreach ($images as $image)
    {
      if (mb_strlen($image->m_description) <= 0) {
        if ($CFG["SHOW_EMPTY_DESC_POPUPS"] == false)
        {
          $popup = "";
        } else
        {
          $popup = "onmouseover='return overlib(\"".popup_display_safe($CFG["EMPTY_DESC_POPUP_TEXT"])."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }
      } else
      {
        $popup = "onmouseover='return overlib(\"".popup_display_safe($image->m_description)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      }
      $Image = new Image();
      $Image->loadId($image->id);
      $width = $Image->width;
      $height = $Image->height;

      if ((null == $width) || (null == $height))
      {
        $width = 150;
        $height = 112;
      }

      if (($width > $CFG["THUMB_WIDTH"]) or ($height > ($CFG["THUMB_WIDTH"]*0.75)))
      {
        $w = $width / $CFG["THUMB_WIDTH"];
        $h = $height / ($CFG["THUMB_WIDTH"] * 0.75);
        if ($w > $h)
        {
          $width = $CFG["THUMB_WIDTH"];
          $height = $height / $w;
        } else
        {
          $width = $width / $h;
          $height = $CFG["THUMB_WIDTH"] * 0.75;
        }
      }

      $thumb = $links;

      if (is_file($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$image->m_id.".jpg"))
      {
        $thumb = ParseVar($thumb, "ImageThumb", str_display_safe($CFG["THUMB_PATH"])."thumb_".$image->m_id.".jpg");
      }
      else
      {
        $thumb = ParseVar($thumb, "ImageThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$CFG["THUMB_WIDTH"]);
      }

      $thumb = ParseVar($thumb, "ImageThumbID", $image->m_id);
      $thumb = ParseVar($thumb, "ImageThumbWidth", $width);
      $thumb = ParseVar($thumb, "ImageThumbHeight", $height);
      $thumb = ParseVar($thumb, "ImageThumbGlobalWidth", str_display_safe($CFG["THUMB_WIDTH"]));
      $thumb = ParseVar($thumb, "ImageThumbGlobalHeight", str_display_safe(ceil($CFG["THUMB_WIDTH"]*0.75)));
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
    global $CFG;

    $output = "";
    $found = false;

    $query = "SELECT * FROM ".$CFG["tab_prefix"]."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while (($image = mysql_fetch_array($result)) && (!$found))
    {
      if ((file_exists($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$image["IDImage"].".".$image["Format"]) == false) ||
         (file_exists($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$image["IDImage"].".".$image["Format"]) == false))
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
    global $CFG;

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

    $query = "SELECT * FROM ".$CFG["tab_prefix"]."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while ($image = mysql_fetch_array($result))
    {
      $Image = new Image();
      $Image->loadId($image["IDImage"]);
      $ext = $Image->format;
      $image_exists = file_exists($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$Image->id.".".$ext);
      $thumb_exists = file_exists($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$Image->id.".jpg");

      if ((!$image_exists) || (!$thumb_exists))
      {
        $line = $result_line;
        if ((!$thumb_exists) && ($image_exists))
        {
          $line = $fixed_line;
          // Create Thumbnail from existing full image
          createImageThumbnail($Image->id, $ext, true);
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
        if (strlen($desc) > $CFG["TITLE_DESC_LENGTH"])
        {
          $desc = substr( $desc, 0, $CFG["TITLE_DESC_LENGTH"] - 3)."...";
        }

        $line = ParseVar( $line, "ImageMainStatus"  , $main_status);
        $line = ParseVar( $line, "ImageThumbStatus" , $thumb_status);
        $line = ParseVar( $line, "ImageDescription" , html_display_safe($desc));
        $line = ParseVar( $line, "ImageID"          , $Image->id);
        $line = ParseVar( $line, "ImageFileName"    , html_display_safe($Image->originalFilename));

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