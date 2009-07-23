<?php

  // Get the image id
  $no_image_id = false;
  if (isset($_REQUEST["image_id"]) == false)
  {
    $no_image_id = true;
  } else
  {
    $image_id = $_REQUEST["image_id"];
    $pre_cache = true;
    $pre_image_id = $image_id;
  }

  // Flag a break if there is no image to show
  $proceed = true;
  if (true == $no_image_id)
  {
    moa_warning("No image ID supplied.");
    $proceed = false;
  }

  if ($proceed)
  {
  	// Find where the user came from (gallery or admin pages)
	  $from = $_REQUEST["parent_id"];
	  if (true == isset($_REQUEST["referer"]))
	  {
	    if (0 == strcmp("orphan", $_REQUEST["referer"]))
	    {
	      $from = "orphan";
	    }
	  }

	  include_once($MOA_PATH."sources/mod_tag_view.php");

    // Only include Javascript if a user is logged in
    if (UserIsLoggedIn())
		{
		  echo "<script type='text/javascript' src='sources/common.js'></script>\n";
		  echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
		  echo "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
		  echo "<script type='text/javascript'>\n";
		  echo "  all_tags = '"; ViewAllTagList(); echo "';\n";
		  echo "  cur_tags = '"; ViewImageCurrentTagList($image_id); echo "';\n";
		  echo "</script>\n";
		  echo "<script type='text/javascript' src='sources/mod_image.js'></script>\n";
		  echo "<script type='text/javascript'>\n";

		  echo "  image_id= '".$image_id."';\n";

		  echo "  var editblock=";
		  echo js_var_display_safe(LoadTemplateRootForJavaScript("component_image_form_edit.php"));
		  echo ";\n";

		  echo "  var feedback_box = ";
      echo moa_feedback_js();
      echo ";\n";

      echo "  var template_path = 'templates/".$template_name."/';\n";
		  echo "  var image = new Image('".js_var_display_safe($STR_DELIMITER)."');\n";
		  echo "  image.PreLoad('".$image_id."', '".js_var_display_safe(_ImageGetValue($image_id, "Description"))."', "._ImageGetValue($image_id, "Width").", "._ImageGetValue($image_id, "Height").", '".$from."');\n";
		  echo "  image.PageTitle();";
		  echo "</script>\n";
		}
?>
		<script type="text/javascript">
		  image_id = '<?php echo $image_id ?>';
		</script>
<?php
	  $pre_cache = true;
	  $pre_image_id = $image_id;
	  $pre_parent_id = $_REQUEST["parent_id"];

	  echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";

	  echo LoadTemplateRoot("page_image_view.php");

	  echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }
?>