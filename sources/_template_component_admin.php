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
  
  function TagParseAdminUserFormSubmitLink($p_tag_options)
  {
    return "onclick='user_list.FormSubmit()'";
  }
  
  function TagParseAdminUserformCancelLink($p_tag_options)
  {
    return "onclick='user_list.FormCancel()'";
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
    return "onclick='tag_list.SubmitAdd($(\"#tag_add_input\").val());'";
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
          $popup = "onmouseover='return showOverlib(\"".popup_display_safe($CFG["EMPTY_DESC_POPUP_TEXT"])."\");' onmouseout='return hideOverlib();'";
        }
      } else
      {
        $popup = "onmouseover='return showOverlib(\"".popup_display_safe($image->m_description)."\");' onmouseout='return hideOverlib();'";
      }
      $Image = new Image($image->id);
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

      if (is_file($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".str_pad($image->id, 10, '0', STR_PAD_LEFT).".jpg"))
      {
        $thumb = ParseVar($thumb, "ImageThumb", str_display_safe($CFG["THUMB_PATH"])."thumb_".str_pad($image->id, 10, '0', STR_PAD_LEFT).".jpg");
      }
      else
      {
        $thumb = ParseVar($thumb, "ImageThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$CFG["THUMB_WIDTH"]);
      }

      $thumb = ParseVar($thumb, "ImageThumbID", $image->id);
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
      if ((file_exists($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].str_pad($image["IDImage"], 10, '0', STR_PAD_LEFT).".".$image["Format"]) == false) ||
         (file_exists($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".str_pad($image["IDImage"], 10, '0', STR_PAD_LEFT).".".$image["Format"]) == false))
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
      $Image = new Image($image["IDImage"]);
      $ext = $Image->format;
      $longId = str_pad($Image->id, 10, '0', STR_PAD_LEFT);
      $image_exists = file_exists($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$longId.".".$ext);
      $thumb_exists = file_exists($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$longId.".jpg");

      if ((!$image_exists) || (!$thumb_exists))
      {
        $line = $result_line;
        if ((!$thumb_exists) && ($image_exists))
        {
          $line = $fixed_line;
          // Create Thumbnail from existing full image
          createImageThumbnail($longId, $ext, true);
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
  
  function TagParseAdminTemplateList($p_tag_options)
  {
    global $CFG;

    $template_line = LoadTemplate("component_template.php");
    $output      = "";

    $dir = opendir($CFG['MOA_PATH'].'templates/');
    while (false !== ($file = readdir($dir)))
    {
      if (is_dir($CFG['MOA_PATH'].'templates/'.$file))
      {
        if ('.' != substr($file, 0, 1))
        {
          // Set defaults
          $tName = $file;
          $tScreenshot = 'screenshot.png';
          $tAuthor = 'Unknown author';
          $tDescription = 'No description';
          $tMoaVersion = 'Unknown compatibility with Moa';
          $tVersion = 'Unknown template version';
          
          $xml = @simplexml_load_file($CFG['MOA_PATH'].'templates/'.$file.'/metadata/template.xml');

          if (false !== $xml)
          {
            $tpl = $xml->children();

            if (isset($tpl->name))
            {
              $tName = $tpl->name;
            }
            
            if (isset($tpl->author))
            {
              $tAuthor = $tpl->author;
            }
            
            if (isset($tpl->screenshot))
            {
              $tScreenshot = $tpl->screenshot;
            }
            
            if (isset($tpl->moaversion))
            {
              $tMoaVersion = $tpl->moaversion;
            }
            
            if (isset($tpl->version))
            {
              $tVersion = $tpl->version;
            }
            
            if (isset($tpl->description))
            {
              $tDescription = $tpl->description;
            }
          }
          
          $line = $template_line;
          $line = ParseVar( $line, "TemplateName" , $tName);
          $line = ParseVar( $line, "TemplateFolder" , $file);
          $line = ParseVar( $line, "TemplateAuthor" , $tAuthor);
          $line = ParseVar( $line, "TemplateScreenshot" , 'templates/'.$file.'/metadata/'.$tScreenshot);
          $line = ParseVar( $line, "TemplateMoaVersion" , $tMoaVersion);
          $line = ParseVar( $line, "TemplateVersion" , $tVersion);
          $line = ParseVar( $line, "TemplateDescription" , $tDescription);
          
          $output .= $line;
        }
      }
    }

    if (strlen($output) == 0)
    {
      $output = " ";
    }
    return $output;
  }

  function TagParseAdminLinks($p_tag_options)
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
        $links = ParseVar($links, "ImageAddLink", "href='index.php?action=image_add&amp;parent_id=".$gallery_id."'");
        $links = ParseVar($links, "GalleryAddLink", "href='index.php?action=gallery_add&amp;parent_id=".$gallery_id."'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "home"))
      {
        $links = LoadTemplate("component_gallery_home_admin_links.php");
        $links = ParseVar($links, "HomeEditLink", "onclick='main.Edit();'");
        $links = ParseVar($links, "ImageAddLink", "href='index.php?action=image_add&amp;parent_id=".$gallery_id."'");
        $links = ParseVar($links, "GalleryAddLink", "href='index.php?action=gallery_add&amp;parent_id=".$gallery_id."'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "image"))
      {
        $links = LoadTemplate("component_image_admin_links.php");
        $links = ParseVar($links, "ImageEditLink", "onclick='image.Edit();'");
        $links = ParseVar($links, "ImageDeleteLink", "onclick='image.Delete();'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "admin"))
      {
        $links = LoadTemplate("component_admin_links.php");
        $links = ParseVar($links, "AdminUserLink", "index.php?action=admin_users");
        $links = ParseVar($links, "AdminTagLink", "index.php?action=admin_tag");
        $links = ParseVar($links, "AdminTemplateLink", "index.php?action=admin_template");
        $links = ParseVar($links, "AdminSettingsLink", "index.php?action=admin_settings");
        $links = ParseVar($links, "AdminOrphanLink", "index.php?action=admin_orphans");
        $links = ParseVar($links, "AdminIntegrityLink", "index.php?action=admin_maintain");
        $links = ParseVar($links, "AdminFTPLink", "index.php?action=admin_ftp");
        return $links;
      }
      return "";
    }
    return " ";
  }
  
?>