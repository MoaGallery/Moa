<?php  
  $proceed = true;
  
  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	$proceed = false;
  	moa_error("Not logged in");
  }

  // If we are logged in
  if ($proceed)
  {
  	include_once("sources/mod_user_view.php");
  	include_once("sources/_admin_page_links.php");

    echo "<script type='text/javascript' src='sources/common.js'></script>\n";
    echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
    echo "<script type='text/javascript' src='sources/mod_userlist.js'></script>\n";
    ViewUserBlock();
    echo "<script type='text/javascript'>\n";
    echo "  userform = "; ViewUserForm(); echo ";\n";
    echo "  all_users = '"; ViewAllUserList(); echo "';\n";
    echo "  tag_delimiter = '".$STR_DELIMITER."';\n";
    echo "  user_list = new UserList(tag_delimiter);\n";
    echo "  user_list.PreLoad(all_users);\n";
    echo "  document.getElementById('user_lines').innerHTML=user_list.ViewAll();\n";
    echo "</script>\n";
  }

  $page_title = "User admin";
?>
