<?php
  if (file_exists("mod_gallery.php"))
  {
    include_once("../config.php");
    include_once("mod_gallery.php");
    include_once("mod_image_view.php");
  } else
  {
  	include_once("config.php");
    include_once("sources/mod_gallery.php");
    include_once("sources/mod_image_view.php");
  }

  function ViewGalleryBlock($p_id)
  {
  	echo "<div id='galleryblock'>\n";
  	echo "  <div id='galleryblockfeedback'>"; ViewDeleteFeedback(); echo"</div>\n";
  	echo "  <div id='galleryblockheader' class='area box_header' style='padding:5px; border-bottom:0px;'>Gallery</div>\n";
  	echo "  <div id='galleryblockbody' class='pale_area' style='padding:5px; border-top:0px;'>\n";
  	if (0 != strcmp($p_id, "0000000000"))
  	{
  	  echo "    <div id='galleryblockadmin'>"; ViewGalleryActions($p_id); echo "</div>";
  	}
  	echo "    <div id='galleryblocktitles'>\n";
  	echo "      <div id='galleryblockname' class='gallery_name'>".html_display_safe(_galleryGetValue($p_id, "Name"))."</div>\n";
  	echo "      <div id='galleryblockdesc' class='gallery_desc'>".html_display_safe(_galleryGetValue($p_id, "Description"))."</div>\n";
    echo "    </div>\n";
  	echo "    <table id='galleryblockimages'><tr><td id='galleryblockimagethumbs'>"; ViewImageThumbs($p_id); echo "</td></tr></table>\n";
  	echo "    <table id='galleryblocksubgalleries'><tr><td id='galleryblockgallerythumbs'>"; ViewSubGalleryThumbs($p_id); echo "</td></tr></table>\n";
  	echo "  </div>\n";
  	echo "</div>\n";
  }

  function ViewSubGalleryThumbs($p_id)
  {
  	$subgalleries = _galleryGetSubGalleries($p_id);

  	foreach ($subgalleries as $gallery)
  	{
  		ViewGalleryThumbnail($gallery->m_id, $gallery->m_name, $gallery->m_description);
  	}
  }

  function ViewGalleryThumbnail($p_id, $p_name, $p_desc)
  {
  	global $THUMB_WIDTH;
  	global $THUMB_PATH;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $EMPTY_DESC_POPUP_TEXT;
    global $SHOW_EMPTY_DESC_POPUPS;

    $image_count = _galleryGetImageCount($p_id);
    $subgallery_count = _galleryGetSubGalleryCount($p_id);

    if (mb_strlen($p_desc) <= 0) {
      if ($SHOW_EMPTY_DESC_POPUPS == false)
      {
        $popup = "";
      } else
      {
        $popup = "onmouseover='return overlib(\"".popup_display_safe($EMPTY_DESC_POPUP_TEXT)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      }
    } else
    {
      $popup = "onmouseover='return overlib(\"".popup_display_safe($p_desc)."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
    }

    if (0 == _galleryGetImageCount($p_id)) {
    	 $thumb_src  = "sources/_image_scaler.php?image_name=../media/empty.png&amp;display_width=".str_display_safe($THUMB_WIDTH);
    }
    else
    {
    	$thumb_src = str_display_safe($THUMB_PATH)."/thumb_"._galleryGetThumbNail($p_id).".jpg";
    }

    echo "<div class='gallery-shadow' style='float:left;'>\n";
    echo "  <div class='gallery-shadow2' onclick='nd(); window.location=\"index.php?action=gallery_view&amp;gallery_id=".$p_id."\"' ".$popup.">\n";
    echo "    <div class='gallery-shadow3' style='padding: 10px;'>\n";
    echo "      <table border='0' cellpadding='0' cellspacing='0'>\n";
    echo "        <tr>\n";
    echo "          <td style='width: ".str_display_safe($THUMB_WIDTH)."px; height: ".(ceil($THUMB_WIDTH*0.75))."px;'>\n";
    echo "            <img style='display: block; margin-left: auto; margin-right: auto;' src='".$thumb_src."' alt='Gallery thumbnail' title=''/>\n";
    echo "          </td>\n";
    echo "        </tr>\n";
    echo "      </table>\n";
    echo "      <p class='normal_text'>".html_display_safe($p_name)."<br/>\n\n";
    if ($DISPLAY_PLAIN_SUBGALLERIES)
    {
      if ($subgallery_count > 0)
      {
        echo $subgallery_count." Sub Galleries<br/>\n";
      } else
      {
        echo $image_count." Images\n";
      }
    } else
    {
      echo $image_count." Images<br/>\n";
      if ($subgallery_count > 0)
      {
        echo $subgallery_count." Sub Galleries<br/>\n";
      } else
      {
        echo "<br/>\n";
      }
    }
    echo "      </p>\n";
    echo "    </div>\n";
    echo "  </div>\n";
    echo "</div>\n";
  }

  function ViewImageThumbs($p_id)
  {
    global $DISPLAY_PLAIN_SUBGALLERIES;

  	$sub_gallery_count = _galleryGetSubGalleryCount($p_id);

  	if (!((0 < $sub_gallery_count) && (true == $DISPLAY_PLAIN_SUBGALLERIES))) {
  	  $images = _galleryGetImages($p_id);

      foreach ($images as $image)
      {
        ViewImageThumbnail($image->m_id, $image->m_description, $p_id);
      }
    }
  }

  function ViewGalleryForm($p_parent_id, $p_add = false)
  {
  	global $tab_prefix;

    $br = "";
    if (!$p_add)
    {
      $br = "<br\>";
    }

  	echo "\"<form id='galleryform'>\" +\n";

  	// Name
  	echo "  \"<div class='form_label_text' style='height: 10px; width: 100px; float: left;'>Name:</div>\" +\n";
  	echo "  \"<span><input class='form_text' type='text' id='galleryformname' style='width:382px;'/></span><br/>\" +\n";

    // Description
    echo "  \"<div><div id='galleryformexpandblock' style='float: left'><div class='form_label_text' style='width: 100px;'>Description:</div>\" + \n";
    echo "  \"<a class='admin_link' id='galleryformexpandlink' style='width:100px;'>[Expand]</a></div>\" + \n";
    echo "  \"<textarea class='form_text' name='galleryformdesc' id='galleryformdesc' rows='4' cols='50'></textarea></div>\" +\n";

  	// Tags
  	echo "  \"<div class='form_label_text' style='height: 10px; width: 100px; float: left;'>Tags:</div>\" +\n";
  	echo "  \"<span><input class='form_text' type='text' id='galleryformtags' \" +\n";
  	echo "  \"             style='width:358px; position: relative; top: -1px;'\" +\n";
  	echo "  \"             onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/></span>\" +\n";
  	echo "  \"&nbsp;<span id='formtaglistfeedback'></span><br/>\" +\n";

  	// Parent combobox
  	echo "  \"<div class='form_label_text' style='height: 10px; width: 100px; float: left;'>Parent gallery:</div>\" +\n";
  	echo "  \"<span><select name='parent_id' id='galleryformparent_id' style='width:386px;'>";
    $query = "SELECT * FROM ".$tab_prefix."gallery;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    echo "<option value='0000000000'>No Parent</option>";
    while ($gallery = mysql_fetch_array($result))
    {
      echo "<option value='".html_display_safe($gallery["IDGallery"])."'";
      if (strcmp($p_parent_id, $gallery["IDGallery"]) == 0)
      {
        echo "selected='selected'";
      }
      echo ">".html_display_safe($gallery["Name"])."</option>";
    }
    echo "  </select></span><br/>\" +\n";

  	// Buttons
    echo "  \"<div class='form_label_text' style='height: 10px; width: 100px; float: left;'>&nbsp</div>\" +\n";
    echo "  \"<input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>\" +\n";
    echo "  \"<input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/><br/>\" +\n";
  	echo "  \"</form>\"";
  }

  function ViewGalleryActions($p_id)
  {
    // Only proceed if a user is logged in
    if (UserIsLoggedIn())
    {
      echo "<a class='admin_link' onclick='gallery.Edit();'>[Edit]</a> \n";
      echo "<a class='admin_link' onclick='gallery.Delete();'>[Delete]</a> \n";
      echo "<a class='admin_link' href='index.php?action=image_add&parent_id=".$p_id."'>[Add Image]</a> \n";
      echo "<a class='admin_link' href='index.php?action=gallery_add&parent_id=".$p_id."'>[Add Sub-Gallery]</a><br/><br/>\n";
    }
  }
?>