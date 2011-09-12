<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  $proceed = true;

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	global $g_message_type;
  	global $g_message_text;

  	$proceed = false;

  	$g_message_text = "Not logged in";
  	$g_message_type = "Warning";
  	echo LoadTemplateRoot("page_message.php");
  }

  // If we are logged in
  if ($proceed)
  {
    include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

    $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    $bodycontent .= LoadTemplateRoot("page_admin_tags.php");

    $bodycontent .= "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_ui.js'></script>\n";
    
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    $bodycontent .= "  all_tags = '"; ViewAllTagList();
    $bodycontent .= "';\n";
    $bodycontent .= "  add_form = ";

    $bodycontent .= LoadTemplateRootForJavascript("component_admin_tag_add_form.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  add_link = ";
    $bodycontent .= LoadTemplateRootForJavaScript("component_admin_tag_block.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  tag_row_template = ";
    $bodycontent .= LoadTemplateRootForJavaScript("component_admin_tag_line.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  var feedback_box = ";
    $bodycontent .= moa_feedback_js();
    $bodycontent .= ";\n";

    $bodycontent .= "  tag_delimiter = '".$CFG["STR_DELIMITER"]."';\n";
    $bodycontent .= "  var tag_list = new TagList( tag_delimiter, tag_row_template);\n";
    $bodycontent .= "  tag_list.PreLoad(all_tags, '', add_form);\n";
    $bodycontent .= "  $('#tag_lines').html(tag_list.ViewAll());\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "</script>\n";

    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }

  $bodytitle .= "Tags - ".html_display_safe($CFG['SITE_NAME']);
?>