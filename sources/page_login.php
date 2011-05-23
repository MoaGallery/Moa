<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once ($CFG["MOA_PATH"]."sources/id.php");

  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  $bodycontent .= LoadTemplateRoot("page_login.php");

  $bodycontent .= "<script type=\"text/javascript\" src=\"sources/jquery/jquery.js\"></script>\n";
  $bodycontent .= "<script type=\"text/javascript\" src=\"sources/common.js\"></script>\n";
  $bodycontent .= "<script type=\"text/javascript\" src=\"sources/mod_login.js\"></script>\n";
  $bodycontent .= "<script type=\"text/javascript\" src=\"sources/formcheck.js\"></script>\n";
  $bodycontent .= "<script type=\"text/javascript\">\n";
  $bodycontent .= "  addEvent(document.getElementById('loginname'), \"keypress\", function (e) {checkKey(e, \"loginsubmit\", null);});\n";
  $bodycontent .= "  addEvent(document.getElementById('loginpass'), \"keypress\", function (e) {checkKey(e, \"loginsubmit\", null);});\n";
  $bodycontent .= "  addEvent(document.getElementById('loginduration'), \"keypress\", function (e) {checkKey(e, \"loginsubmit\", null);});\n";
  $bodycontent .= "  document.getElementById(\"loginname\").focus();\n";
  $bodycontent .= "  var login = new Login();\n";
  $bodycontent .= "  FormCheckSetup('login', false);\n";
  $bodycontent .= "</script>\n";

  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

  $bodytitle = "Login - ".html_display_safe($CFG['SITE_NAME']);
?>
