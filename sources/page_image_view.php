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

	  include_once("sources/mod_image_view.php");
	  include_once("sources/mod_tag_view.php");

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
		  echo "  var editblock="; ViewImageForm(false); echo ";\n";
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

	  ViewImageBlock($image_id);
  }
?>