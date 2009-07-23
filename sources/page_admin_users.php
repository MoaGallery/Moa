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
  	include_once($MOA_PATH."sources/mod_user_view.php");

    echo "<script type='text/javascript' src='sources/common.js'></script>\n";
    echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
    echo "<script type='text/javascript' src='sources/mod_userlist.js'></script>\n";
    //ViewUserBlock();

    echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    echo LoadTemplateRoot("page_admin_users.php");
    echo "<script type='text/javascript'>\n";

    echo "  userform = ";
    echo LoadTemplateRootForJavaScript("component_admin_user_form.php");
    echo ";\n";

    echo "  all_users = '"; ViewAllUserList(); echo "';\n";

    echo "  user_container_template = ";
    echo LoadTemplateRootForJavaScript("component_admin_user_container.php");
    echo ";\n";

    echo "  user_row_template = ";
    echo LoadTemplateRootForJavaScript("component_admin_user_line.php");
    echo ";\n";

    echo "  var feedback_box = ";
    echo moa_feedback_js();
    echo ";\n";

    echo "  tag_delimiter = '".$STR_DELIMITER."';\n";
    echo "  user_list = new UserList(tag_delimiter, user_container_template, user_row_template);\n";
    echo "  user_list.PreLoad(all_users);\n";
    echo "  document.getElementById('user_lines').innerHTML=user_list.ViewAll();\n";
    echo "</script>\n";

    echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }

  $page_title = "User admin";
?>
