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
  	LoadTemplateRoot("page_message.php");
  }

  // If we are logged in
  if ($proceed)
  {
  	include_once($CFG["MOA_PATH"]."sources/mod_user_view.php");

    $bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/_request.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_userlist.js'></script>\n";
    //ViewUserBlock();

    $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    $bodycontent .= LoadTemplateRoot("page_admin_users.php");
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    $bodycontent .= "  userform = ";
    $bodycontent .= LoadTemplateRootForJavaScript("component_admin_user_form.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  all_users = '"; ViewAllUserList();
    $bodycontent .= "';\n";

    $bodycontent .= "  user_container_template = ";
    $bodycontent .= LoadTemplateRootForJavaScript("component_admin_user_container.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  user_row_template = ";
    $bodycontent .= LoadTemplateRootForJavaScript("component_admin_user_line.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  var feedback_box = ";
    $bodycontent .= moa_feedback_js();
    $bodycontent .= ";\n";

    $bodycontent .= "  tag_delimiter = '".$CFG["STR_DELIMITER"]."';\n";
    $bodycontent .= "  user_list = new UserList(tag_delimiter, user_container_template, user_row_template);\n";
    $bodycontent .= "  user_list.PreLoad(all_users);\n";
    $bodycontent .= "  document.getElementById('user_lines').innerHTML=user_list.ViewAll();\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "</script>\n";

    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }

  $bodytitle .= "Users - Moa";
?>
