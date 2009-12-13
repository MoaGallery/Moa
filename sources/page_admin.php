<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once $CFG["MOA_PATH"]."sources/id.php";

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	global $g_message_type;
  	global $g_message_text;

  	include_once("page_login.php");
  }  else
  {
  	$bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    $bodycontent .= LoadTemplateRoot("page_admin.php");
    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
    $bodytitle .= "Admin - Moa";
  }
?>
