<?php
  if (file_exists("mod_image.php"))
  {
    include_once("../config.php");
    include_once("mod_image_funcs.php");
    include_once("mod_image.php");
  } else
  {
    include_once("config.php");
    include_once("sources/mod_image_funcs.php");
    include_once("sources/mod_image.php");
  }

  function ViewImageBlock($p_id)
  {
  	if (_ImageExists($p_id))
  	{
  	  echo "<div id='imageblock'>\n";
  	  echo "  <div id='imageblockfeedback'></div>\n";
  	  echo "  <table><tr>\n";
  	  echo "    <td>\n";
  	  echo "      <div id='imageblockpreview'>"; ViewImagePreview($p_id); echo "</div>\n";
  	  echo "    </td><td style='vertical-align: top;'>";
      echo "      <div id='imageblockinfopanel' style='min-width: 300px; max-width: 100%;'>\n";
  	  echo "        <div id='imageblockheader' class='area box_header' style='padding:5px; border-bottom:0px;'>Image</div>\n";
  	  echo "        <div id='imageblockbody' class='pale_area' style='padding:5px; border-top:0px;'>\n";
  	  echo "          <div id='imageblockadmin'>"; ViewImageActions($p_id); echo "</div>\n";
  	  echo "          <div id='imageblockinfo'>"; ViewImageInfo($p_id); echo "</div>\n";
  	  echo "        </div>\n";
  	  echo "      </div>\n";
  	  echo "    </td></tr>\n";
  	  echo "  </table>\n";
  	  echo "</div>\n";
  	}
  	else
  	{
  	  moa_warning("Image does not exist.");
  	}
  }

  function ViewImagePreview($p_id)
  {
  	global $CONFIG_DISPLAY_MAX_WIDTH;
  	global $IMAGE_PATH;

  	$image = _ImageGetAllValues($p_id);

    echo "<div class='picture-shadow' onclick='window.location=\"index.php?action=image_view_full&amp;image_id=".$p_id."\"'>\n";
    echo "  <div class='picture-shadow2'>\n";

    // Check image file exists
    $r = @fopen(str_display_safe($IMAGE_PATH)."/".$p_id.".jpg", "rt");
    if ($r)
    {
      fclose($r);

      // If it's too big scale it
      if (($image->m_width > $CONFIG_DISPLAY_MAX_WIDTH) or ($image->m_height > ($CONFIG_DISPLAY_MAX_WIDTH*0.75)))
      {
        echo "    <img class='picture-shadow3' style='display:block;' src='sources/_image_scaler.php?image_name=".$p_id.".jpg' alt='image preview'/>";
      } else   // Small enough to fit on unaltered
      {
        echo "    <img style='display:block;' src='".str_display_safe($IMAGE_PATH)."/".$p_id.".jpg' alt='Image preview' />";
      }
    } else  // image file is missing
    {
  		echo "    <img style='display:block;' src='media/img_scale_error.png' alt='Error' />";
    }

    echo "  </div>\n";
    echo "</div>\n";
  }

  function ViewImageThumbnail($p_id, $p_desc, $p_gallery_id)
  {
  	global $THUMB_WIDTH;
  	global $THUMB_PATH;
    global $EMPTY_DESC_POPUP_TEXT;
    global $SHOW_EMPTY_DESC_POPUPS;

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

    // Check image file exists
    if (is_file("id.php"))
    {
      $r = is_file(str_display_safe("../".$THUMB_PATH)."/thumb_".$p_id.".jpg");
    } else
    {
      $r = is_file(str_display_safe($THUMB_PATH)."/thumb_".$p_id.".jpg");
    }
    if ($r)
    {
      $thumb_src = str_display_safe($THUMB_PATH)."/thumb_".$p_id.".jpg";
    } else
    {
      $thumb_src = "media/img_scale_error.png";
    }

    echo "<div class='gallery-shadow' style='float:left;' ".$popup." onclick='nd(); window.location=\"index.php?action=image_view&amp;image_id=".$p_id."&amp;parent_id=".$p_gallery_id."\"'>\n";
    echo "  <div class='gallery-shadow2'>\n";
    echo "    <div class='gallery-shadow3' style=\"vertical-align:middle; width:".($THUMB_WIDTH+20)."px; height: ".(ceil($THUMB_WIDTH*0.75)+20)."px;\">";
    echo "      <div style='margin:10px; background-image: url(\"".$thumb_src."\"); background-repeat: no-repeat; background-position: center; width: ".str_display_safe($THUMB_WIDTH)."px; height: ".ceil($THUMB_WIDTH*0.75)."px'>";
    echo "      </div>\n";
    echo "    </div>\n";
    echo "  </div>\n";
    echo "</div>\n";
  }

  function ViewImageForm($p_add = false)
  {
  	$br = "";
  	$float = "";
  	if (!$p_add)
  	{
  		$br = "<br\>";
  	} else
  	{
  		$float=" float: left;";
  	}

  	echo "\"<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>\" +\n";

  	if ($p_add)
  	{
  	  // File
  	  echo "  \"<div class='form_label_text' style='height: 10px; width: 100px; float: left;'>File:</div>".$br."\" +\n";
  	  echo "  \"<input class='form_text' type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input><br />\" +\n";
  	  echo "  \"<input type='hidden' name='imageform' value='true' />\" +\n";
  	}

  	// Description
  	if ($p_add)
  	{
  	  echo "  \"<div><div id='imageformexpandblock' style='float: left'><div class='form_label_text' style='width: 100px;'>Description:</div>\" + \n";
  	  echo "  \"<a class='admin_link' id='imageformexpandlink' style='width:100px;'>[Expand]</a></div>".$br."\" + \n";
  	  echo "  \"<textarea class='form_text' name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea></div>\" +\n";
  	} else
  	{
    	echo "  \"<div class='form_label_text' style='width: 100px;'>Description:</div>\" + \n";
      echo "  \"<a class='admin_link' id='imageformexpandlink'>[Expand]</a>".$br."\" + \n";
      echo "  \"<textarea class='form_text' name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>\" +\n";
  	}

  	// Tags
  	echo "  \"<div class='form_label_text' style='width: 100px;".$float."'>Tags:</div>\" +\n";
  	echo "  \"<span><input class='form_text' type='text' name='imageformtags' id='imageformtags' style='width:267px;' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/></span>\" +\n";
  	echo "  \"&nbsp;<span id='formtaglistfeedback'></span>\" +\n";

  	// Buttons
    echo "  \"<div class='form_label_text' style='height: 10px; width: 100px;'>&nbsp;</div>\" +\n";
    echo "  \"<input type='button' value='Submit' id='imageformsubmit' onclick='image.SubmitEdit();'/>\" +\n";
    echo "  \"<input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/><br/>\" +\n";
  	echo "  \"</form>\"";

  	if ($p_add)
    {
    	echo " +\n";
    	echo "  \"<div id='imageformupload'>&nbsp;</div>\"";
    }
  }

  function ViewImageActions($p_id)
  {
    // Only proceed if a user is logged in
    if (UserIsLoggedIn())
    {
      echo "<a class='admin_link' onclick='image.Edit();'>[Edit]</a> \n";
      echo "<a class='admin_link' onclick='image.Delete();'>[Delete]</a> \n";
      echo "<br/><img src='media/trans-pixel.png' width='300' height='1'><br/>";
    }
  }

  function ViewImageInfo($p_id)
  {
    global $CONFIG_DISPLAY_MAX_WIDTH;

    $image = _ImageGetAllValues($p_id);

  	// Display description
    echo "<div id='imageblockdesc' class='image_desc'>".html_display_safe($image->m_description)."</div><br/><div class='image_desc'>\n";

    // Display info
    echo "Size: ".html_display_safe($image->m_width)."x".html_display_safe($image->m_height)."<br/>\n";

  	// Display full size image link
    if (($image->m_width > $CONFIG_DISPLAY_MAX_WIDTH) or ($image->m_height > ($CONFIG_DISPLAY_MAX_WIDTH*0.75)))
    {
    	echo "View full size: <a href='index.php?action=image_view_full&amp;image_id=".$p_id."'>link</a></div>\n";
    }
  }
?>