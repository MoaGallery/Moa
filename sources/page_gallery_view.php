<?php
  include_once($MOA_PATH."sources/mod_gallery_funcs.php");

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
    echo _GalleryExists($gallery_id);
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
	  include_once($MOA_PATH."sources/mod_tag_view.php");

    // Only include Javascript if a user is logged in
    if (UserIsLoggedIn())
	  {
	    echo "<script type='text/javascript' src='sources/common.js'></script>\n";
	  	echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
	    echo "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
	  	echo "<script type='text/javascript'>\n";
	    echo "  all_tags = '"; ViewAllTagList(); echo "';\n";
	    echo "  cur_tags = '"; ViewGalleryCurrentTagList($gallery_id); echo "';\n";
	    echo "</script>\n";
	    echo "<script type='text/javascript' src='sources/mod_gallery.js'></script>\n";
	    echo "<script type='text/javascript'>\n";

	    echo "  gallery_id = '".$gallery_id."';\n";

	    echo "  var editblock=";
	    echo LoadTemplateRootForJavaScript("component_gallery_form_edit.php");
	    echo ";\n";

	    echo "  var feedback_box = ";
        echo moa_feedback_js();
        echo ";\n";

        echo "  var template_path = 'templates/".$template_name."/';\n";

	    echo "  var gallery = new Gallery('".js_var_display_safe($STR_DELIMITER)."');\n";
	    echo "  gallery.PreLoad('".$gallery_id."', '".js_var_display_safe(_galleryGetValue($gallery_id, "Name"))."', '".js_var_display_safe(_galleryGetValue($gallery_id, "Description"))."', '".$parent_id."', '".$from."');\n";
	    echo "  gallery.PageTitle();\n";
	    echo "</script>\n";
	  }

	  echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";

	  echo "<div id = 'pagegalleryview'>\n";
	  echo LoadTemplateRoot("page_gallery_view.php");
	  echo "</div>\n";
  ?>

		<script type="text/javascript">
		  if ('<?php echo $gallery_id ?>' == '0000000000')
		  {
		    document.location = 'index.php';
		  }
       </script>
<?php
    echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }
?>
