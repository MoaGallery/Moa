<?php
  function DisplayResults($p_result)
  {
    global $THUMB_WIDTH;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $EMPTY_DESC_POPUP_TEXT;

    if ( mysql_num_rows($p_result) == 0) {
      echo "<p class='gallery_desc'>&nbsp;&nbsp;All OK</p>";
    }
    else {
      while ($orphan = mysql_fetch_array($p_result))
      {
        $orphan_image_id = $orphan["IDImage"];

        $image_desc = popup_display_safe($orphan["Description"]);

        if (mb_strlen($image_desc) <= 0) {
        	if ($SHOW_EMPTY_DESC_POPUPS == false)
        	{
            $popup = '';
        	} else
        	{
            $popup = "onmouseover='return overlib(\"".$EMPTY_DESC_POPUP_TEXT."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        	}
        } else
        {
          $popup = "onmouseover='return overlib(\"".$image_desc."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }

        echo "<div style='float:left;' id='image_thumb_".$orphan_image_id."'>\n";
        echo "  <div class='gallery-shadow' ".$popup." onclick='window.location=\"index.php?action=image_view&amp;image_id=".$orphan_image_id."&amp;parent_id=0000000000&amp;referer=orphan\"'>\n";
        echo "    <div class='gallery-shadow2'>\n";
        echo "      <div class='gallery-shadow3' style='width:".($THUMB_WIDTH+20)."px; height: ".(ceil($THUMB_WIDTH*0.75)+20)."px;'>\n";
        echo "        <div style='margin:10px;'>\n";
        echo "          <img style='display: block; margin-left: auto; margin-right: auto;' src='images/thumbs/thumb_".$orphan_image_id.".jpg' alt='Thumbnail'/>\n";
        echo "        </div>\n";
        echo "      </div>\n";
        echo "     </div>\n";
        echo "  </div>\n";
        echo "</div>\n";
      }
    }
  }

  function ShowNonTaggedOrphans()
  {
    global $tab_prefix;

    echo "<p class='gallery_desc'>Images with no tags</p>\n";

    $query = "SELECT * FROM ".$tab_prefix."v_orphan_no_tags;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    DisplayResults($result);
    echo "<p class='new_line'/><br/>\n";
  }

  function ShowNoGalleryOrphans()
  {
  	global $tab_prefix;

    echo "<p class='gallery_desc'>Images with tags that are in no gallery</p>\n";

    $query = "SELECT * FROM ".$tab_prefix."v_orphan_no_gallery;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    DisplayResults($result);
    echo "<p class='new_line'/><br/>\n";
  }

  function ShowNoFileMaintain()
  {
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $tab_prefix;

    $header = false;

    echo "<p class='gallery_desc'>Images that have no image/thumbnail files associated</p>\n";

    $query = "SELECT * FROM ".$tab_prefix."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while ($image = mysql_fetch_array($result))
    {
      if ((file_exists($IMAGE_PATH."/".$image["IDImage"].".jpg") == false) &
         (file_exists($THUMB_PATH."/thumb_".$image["IDImage"].".jpg") == false))
      {
        if (!$header)
        {
          echo "<table><tr><td style='width:50px;'></td><td style='width:150px;'><b>Image ID</b></td><td style='width:250px;'><b>Original filename</b></td><td><b>Description</b></td></tr>\n";
          $header = true;
        }
        echo "<tr><td><a class='admin_link' href='index.php?action=admin_maintain_image&image_id=".$image["IDImage"]."'>[Fix]</a></td><td>".$image["IDImage"]."</td><td>".html_display_safe($image["Filename"])."</td><td>".html_display_safe($image["Description"])."</td></tr>\n";
      }
    }

    if (!$header)
    {
      echo "<div class='form_text'>&nbsp;&nbsp;All OK</div><br/>\n";
    } else
    {
      echo "</table><br/>\n";
    }
  }

  function ShowNoImageFileMaintain()
  {
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $tab_prefix;

    $header = false;

    echo "<p class='gallery_desc'>Images that have no main image file associated</p>\n";

    $query = "SELECT * FROM ".$tab_prefix."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while ($image = mysql_fetch_array($result))
    {
      if ((file_exists($IMAGE_PATH."/".$image["IDImage"].".jpg") == false) &
         (file_exists($THUMB_PATH."/thumb_".$image["IDImage"].".jpg") == true))
      {
        if (!$header)
        {
          echo "<table><tr><td style='width:50px;'><td style='width:150px;'><b>Image ID</b></td><td style='width:250px;'><b>Original filename</b></td><td><b>Description</b></td></tr>\n";
          $header = true;
        }
        echo "<tr><td><a class='admin_link' href='index.php?action=admin_maintain_image&image_id=".$image["IDImage"]."'>[Fix]</a></td><td>".$image["IDImage"]."</td><td>".html_display_safe($image["Filename"])."</td><td>".html_display_safe($image["Description"])."</td></tr>\n";
      }
    }

    if (!$header)
    {
      echo "<div class='form_text'>&nbsp;&nbsp;All OK</div><br/>\n";
    } else
    {
      echo "</table><br/>\n";
    }
  }

  function ShowNoThumbFileMaintain()
  {
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $tab_prefix;

    $header = false;

    echo "<p class='gallery_desc'>Images that have no thumbnail files associated</p>\n";

    $query = "SELECT * FROM ".$tab_prefix."image;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    while ($image = mysql_fetch_array($result))
    {
      if ((file_exists($IMAGE_PATH."/".$image["IDImage"].".jpg") == true) &
         (file_exists($THUMB_PATH."/thumb_".$image["IDImage"].".jpg") == false))
      {
        if (!$header)
        {
          echo "<table><tr><td style='width:100px;'><b>Status</b><td style='width:150px;'><b>Image ID</b></td><td style='width:250px;'><b>Original filename</b></td><td><b>Description</b></td></tr>\n";
          $header = true;
        }
        thumbnail($image["IDImage"].".jpg", "jpeg", true);
        echo "<tr><td>Fixed</td><td>".$image["IDImage"]."</td><td>".html_display_safe($image["Filename"])."</td><td>".html_display_safe($image["Description"])."</td></tr>\n";
      }
    }

    if (!$header)
    {
      echo "<div class='form_text'>&nbsp;&nbsp;All OK</div><br/>\n";
    } else
    {
      echo "</table><br/>\n";
    }
  }
?>