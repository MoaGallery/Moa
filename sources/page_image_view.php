<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  // Get the image id
  $no_image_id = false;
  if (isset($_REQUEST["image_id"]) == false)
  {
    $no_image_id = true;
  } else
  {
    $image_id = $_REQUEST["image_id"];
    $preCache = true;
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

	  include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

	  $Image = new Image();
    $Image->loadId($image_id);

    // Only include Javascript if a user is logged in
    if (UserIsLoggedIn())
		{
		  $bodycontent .= "<script type='text/javascript' src='sources/jquery/jquery.js'></script>\n";
			$bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
		  $bodycontent .= "<script type='text/javascript' src='sources/_request.js'></script>\n";
		  $bodycontent .= "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
		  $bodycontent .= "<script type='text/javascript' src='sources/formcheck.js'></script>\n";
		  $bodycontent .= "<script type='text/javascript'>\n";
      $bodycontent .= "  //<![CDATA[\n";
		  $bodycontent .= "  all_tags = '"; ViewAllTagList();
      $bodycontent .= "';\n";
		  $bodycontent .= "  cur_tags = '"; ViewImageCurrentTagList($image_id);
      $bodycontent .= "';\n";
      $bodycontent .= "  title_max_length = ".$CFG["TITLE_DESC_LENGTH"].";\n";
      $bodycontent .= " //]]>\n";
		  $bodycontent .= "</script>\n";
		  $bodycontent .= "<script type='text/javascript' src='sources/mod_image.js'></script>\n";
		  $bodycontent .= "<script type='text/javascript'>\n";
      $bodycontent .= "  //<![CDATA[\n";
		  $bodycontent .= "  image_id= '".$image_id."';\n";

		  $bodycontent .= "  var editblock=";
		  $bodycontent .= LoadTemplateRootForJavaScript("component_image_form_edit.php");
		  $bodycontent .= ";\n";

		  $bodycontent .= "  var feedback_box = ";
      $bodycontent .= moa_feedback_js();
      $bodycontent .= ";\n";

      $bodycontent .= "  var template_path = 'templates/".$template_name."/';\n";
		  $bodycontent .= "  var image = new Image('".js_var_display_safe($CFG["STR_DELIMITER"])."');\n";
		  $bodycontent .= "  image.PreLoad('".$image_id."', '".js_var_display_safe($Image->description)."', ".$Image->width.", ".$Image->height.", '".$from."');\n";
		  $bodycontent .= "  FormCheckSetup('image_view', false);\n";
      $bodycontent .= " //]]>\n";
		  $bodycontent .= "</script>\n";
		}
		$bodycontent .= "<script type=\"text/javascript\">\n";
    $bodycontent .= "  //<![CDATA[\n";
		$bodycontent .= "  image_id = '".$image_id."';\n";
    $bodycontent .= " //]]>\n";
		$bodycontent .= "</script>\n";

	  $preCache = true;
	  $pre_image_id = $image_id;
	  $pre_parent_id = $_REQUEST["parent_id"];

	  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";

	  $bodycontent .= LoadTemplateRoot("page_image_view.php");

	  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

    $imgShortname = $Image->description;
    if ($CFG["TITLE_DESC_LENGTH"] < strlen($imgShortname))
    {
      $imgShortname = substr($imgShortname, 0, ($CFG["TITLE_DESC_LENGTH"]-3))."...";
    }
    $bodytitle .= "Image '".$imgShortname."' - Moa";
  }
?>