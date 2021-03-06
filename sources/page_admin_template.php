<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }
  
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
  	include_once($CFG["MOA_PATH"]."sources/common.php");
    
    $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    $bodycontent .= LoadTemplateRoot('page_admin_template.php');
    $bodycontent .= "<script type=\"text/javascript\" src=\"sources/formcheck.js\"></script>\n";
    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
    
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  FormCheckSetup('template', false);\n";
    $bodycontent .= "</script>\n";
  }

  $bodytitle .= "Change template - ".html_display_safe($CFG['SITE_NAME']);
?>
