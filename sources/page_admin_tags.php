<?php
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
    include_once($MOA_PATH."sources/mod_tag_view.php");

    echo "<script type='text/javascript' src='sources/common.js'></script>\n";
    echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
    echo "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";

    echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    echo LoadTemplateRoot("page_admin_tags.php");

    echo "<script type='text/javascript'>\n";
    echo "  all_tags = '"; ViewAllTagList(); echo "';\n";
    echo "  add_form = ";

    echo LoadTemplateRootForJavascript("component_admin_tag_add_form.php");
    echo ";\n";

    echo "  add_link = ";
    echo LoadTemplateRootForJavaScript("component_admin_tag_block.php");
    echo ";\n";

    echo "  tag_row_template = ";
    echo LoadTemplateRootForJavaScript("component_admin_tag_line.php");
    echo ";\n";

    echo "  var feedback_box = ";
    echo moa_feedback_js();
    echo ";\n";

    echo "  tag_delimiter = '".$STR_DELIMITER."';\n";
    echo "  var tag_list = new TagList( tag_delimiter, tag_row_template);\n";
    echo "  tag_list.PreLoad(all_tags, '', add_form);\n";
    echo "  document.getElementById('tag_lines').innerHTML = tag_list.ViewAll();\n";
    echo "</script>\n";

    echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }

  $page_title = "Tag admin";
?>