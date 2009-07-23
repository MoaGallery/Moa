<?php
  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	global $g_message_type;
  	global $g_message_text;
  	
  	$proceed = false;
  	
  	$g_message_text = "Not logged in";
  	$g_message_type = "Warning";
  	echo LoadTemplateRoot("page_message.php");
  } else
  {
  	include_once($MOA_PATH."sources/common.php");
    include_once($MOA_PATH."sources/_integrity_funcs.php");

    echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    echo LoadTemplateRoot('page_admin_orphans.php');
    echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }

  $page_title = "Orphan admin";
?>
