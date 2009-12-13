<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");

  // Get gallery id
  $no_gallery_id = false;
  if (!isset($_REQUEST["gallery_id"]))
  {
    $no_gallery_id = true;
  } else
  {
    $gallery_id = $_REQUEST["gallery_id"];
    $parent_id = _galleryGetValue($gallery_id, "IDParent");
    $pre_cache = true;
    $pre_gallery_id = $gallery_id;
  }

  // Complain if no id is supplied
  $proceed = true;
  if ($no_gallery_id)
  {
    moa_warning("No gallery ID supplied.");
    $proceed = false;
  }

  // Complain if invalid id is supplied
  if ((!_GalleryExists($gallery_id)) && ("0000000000" != $gallery_id))
  {
    $bodycontent .= _GalleryExists($gallery_id);
    moa_warning("Invalid gallery ID supplied.");
    $proceed = false;
  }

  if ($proceed)
  {
  	// Work out where to return to, parent gallery or admin pages
    $from = $parent_id;
    if (true == isset($_REQUEST["referer"]))
    {
      if (0 == strcmp("orphan", $_REQUEST["referer"]))
      {
        $from = "orphan";
      }
    }

    $pre_cache = true;
	  include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

    // Only include Javascript if a user is logged in
    if (UserIsLoggedIn())
	  {
	    $bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
	  	$bodycontent .= "<script type='text/javascript' src='sources/_request.js'></script>\n";
	    $bodycontent .= "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
	  	$bodycontent .= "<script type='text/javascript'>\n";
	    $bodycontent .= "  //<![CDATA[\n";
      $bodycontent .= "all_tags = '"; ViewAllTagList();
      $bodycontent .= "';\n";
	    $bodycontent .= "  cur_tags = '"; ViewGalleryCurrentTagList($gallery_id);
      $bodycontent .= "';\n";
      $bodycontent .= "  title_max_length = ".$CFG["TITLE_DESC_LENGTH"].";\n";
      $bodycontent .= " //]]>\n";
	    $bodycontent .= "</script>\n";
	    $bodycontent .= "<script type='text/javascript' src='sources/mod_gallery.js'></script>\n";
	    $bodycontent .= "<script type='text/javascript'>\n";
      $bodycontent .= "  //<![CDATA[\n";
	    $bodycontent .= "  gallery_id = '".$gallery_id."';\n";

	    $bodycontent .= "  var editblock=";
	    $bodycontent .= LoadTemplateRootForJavaScript("component_gallery_form_edit.php");
	    $bodycontent .= ";\n";

	    $bodycontent .= "  var feedback_box = ";
      $bodycontent .= moa_feedback_js();
      $bodycontent .= ";\n";

      $bodycontent .= "  var template_path = 'templates/".$template_name."/';\n";

	    $bodycontent .= "  var gallery = new Gallery('".js_var_display_safe($CFG["STR_DELIMITER"])."');\n";
	    $bodycontent .= "  gallery.PreLoad('".$gallery_id."', '".js_var_display_safe(_galleryGetValue($gallery_id, "Name"))."', '".js_var_display_safe(_galleryGetValue($gallery_id, "Description"))."', '".$parent_id."', '".$from."');\n";
      $bodycontent .= " //]]>\n";
	    $bodycontent .= "</script>\n";
	  }

	  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";

	  $bodycontent .= "<div id = 'pagegalleryview'>\n";
	  $bodycontent .= LoadTemplateRoot("page_gallery_view.php");
	  $bodycontent .= "</div>\n";
		$bodycontent .= "<script type=\"text/javascript\">\n";
		$bodycontent .= "  if ('".$gallery_id."' == '0000000000')\n";
		$bodycontent .= "  {\n";
		$bodycontent .= "    document.location = 'index.php';\n";
		$bodycontent .= "  }\n";
    $bodycontent .= "   </script>\n";
    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

    $gal_shortname = _galleryGetValue($gallery_id, "Name");
    if ($CFG["TITLE_DESC_LENGTH"] < strlen($gal_shortname))
    {
      $gal_shortname = substr($gal_shortname, 0, ($CFG["TITLE_DESC_LENGTH"]-3))."...";
    }

    $bodytitle .= "Gallery '".$gal_shortname."' - Moa";
  }
?>
