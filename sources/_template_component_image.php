<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  $nextOrphanID = null;
  $previousOrphanID = null;
  
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");

  function TagParseImageSubmitLink($p_tag_options)
  {
    return "onclick='image.SubmitEdit();'";
  }
    
  function TagParseImageCancelLink($p_tag_options)
  {
    return "onclick='image.CancelEdit();'";
  }
  
  function TagParseImageDescription($p_tag_options)
  {
    global $image_id;

    $Image = new Image($image_id);
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

    $Image = new Image($image_id);
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

    $Image = new Image($image_id);
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

    $Image = new Image($image_id);
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
     $id = str_pad($image_id, 10, '0', STR_PAD_LEFT);
    }

    return $id;
  }

  function TagParseParentID($p_tag_options)
  {
    global $parent_id;

    $id = "0";
    if (isset($parent_id))
    {
     $id = (int)$parent_id;
    }
    return $id;
  }

  function TagParseImageNextID($p_tag_options)
  {
    global $image_id;
    global $parent_id;
    global $from;
    global $nextOrphanID;
    global $previousOrphanID;

    $result = $image_id;
    
    if (0 != strcmp($from, 'orphan'))
    {
      $result = Gallery::GetNextImage($parent_id, $image_id);
  
      if ((is_bool($result)) && (!$result))
      {
        return "Error";
      }
    } else
    {
      if (null === $nextOrphanID)
      {
        $orphans = GetNoGalleryOrphans();
        $index = -1;
        $numOrphans = count($orphans);
        
        // Find the index of the current image
        for($i = 0; $i < $numOrphans; $i++)
        {
          if ($orphans[$i]->id == $image_id)
          {
            $index = $i;
          }
        }

        // If we got a result
        if ($index > -1)
        {
          $nextIndex = $index + 1;
          $previousIndex = $index - 1;
          
          // Loop around if needed
          if ($nextIndex >= $numOrphans)
          {
            $nextIndex = 0;
          }
          
          if ($previousIndex < 0)
          {
            $previousIndex = $numOrphans - 1;
          }
          
          $nextOrphanID = $orphans[$nextIndex]->id;
          $previousOrphanID = $orphans[$previousIndex]->id;
          
          $result = $nextOrphanID;
        } else
        {
          // We didn't find a match
          $nextOrphanID = $image_id;
          $previousOrphanID = $image_id;
        }
      } else
      {
        $result = $nextOrphanID;
      }
    }
    
    return $result;
  }

  function TagParseImageReferer($p_tag_options)
  {
    global $from;
    
    $result = ' ';
    
    if (0 == strcmp($from, 'orphan'))
    {
      $result = '&referer=orphan';
    }
    
    return $result;
  }
  
  function TagParseImagePreviousID($p_tag_options)
  {
    global $image_id;
    global $parent_id;
    global $from;
    global $nextOrphanID;
    global $previousOrphanID;

    $result = $image_id;
    
    if (0 != strcmp($from, 'orphan'))
    {
      $result = Gallery::GetPreviousImage($parent_id, $image_id);
  
      if ((is_bool($result)) && (!$result))
      {
        return "Error";
      }
    } else
    {
      if (null === $nextOrphanID)
      {
        $orphans = GetNoGalleryOrphans();
        $index = -1;
        $numOrphans = count($orphans);
        
        // Find the index of the current image
        for($i = 0; $i < $numOrphans; $i++)
        {
          if ($orphans[$i]->id == $image_id)
          {
            $index = $i;
          }
        }

      // If we got a result
        if ($index > -1)
        {
          $nextIndex = $index + 1;
          $previousIndex = $index - 1;
          
          // Loop around if needed
          if ($nextIndex >= $numOrphans)
          {
            $nextIndex = 0;
          }
          
          if ($previousIndex < 0)
          {
            $previousIndex = $numOrphans - 1;
          }
          
          $nextOrphanID = $orphans[$nextIndex]->id;
          $previousOrphanID = $orphans[$previousIndex]->id;
          
          $result = $previousOrphanID;
        } else
        {
          // We didn't find a match
          $nextOrphanID = $image_id;
          $previousOrphanID = $image_id;
        }
      } else
      {
        $result = $previousOrphanID;
      }
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

    $Image = new Image($image_id);
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

    $Image = new Image($image_id);
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
  
  function TagParseImageTagList($p_tag_options)
  {
    global $CFG;
    global $image_id;
    
    $tagTemplate = LoadTemplate("component_image_tag.php");

    $firstTag = true;
    
    $tags = Tag::getTagListForImage($image_id);
    
    $tagList = "";
    
    foreach($tags as $tag)
    {
      $part = $tagTemplate;
      if (!$firstTag)
      {
        $tagList .= $CFG['STR_DELIMITER'].' ';
      } else
      {
        $firstTag = false;
      }

      $part = ParseVar($part, 'TagName', html_display_safe($tag));
      
      $tagList .= $part;
    }

    if (0 == strlen($tagList))
    {
      $tagList = " ";
    }
    
    return $tagList;
  }
  
  function TagParseImageGalleryList($p_tag_options)
  {
    global $CFG;
    global $image_id;
    
    $galleryTemplate = LoadTemplate("component_image_gallery.php");

    $firstGallery = true;
    
    $galleries = Image::GetContainingGalleries($image_id);
    
    $galleryList = "";
    
    foreach($galleries as $galleryName=>$galleryId)
    {
      $part = $galleryTemplate;
      if (!$firstGallery)
      {
        $galleryList .= $CFG['STR_DELIMITER'].' ';
      } else
      {
        $firstGallery = false;
      }

      $part = ParseVar($part, 'GalleryName', html_display_safe($galleryName));
      $part = ParseVar($part, 'GalleryID', $galleryId);
      
      $galleryList .= $part;
    }

    if (0 == strlen($galleryList))
    {
      $galleryList = " ";
    }
    
    return $galleryList;
  }

?>