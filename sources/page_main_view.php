<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_main_funcs.php");

  // Only proceed if a user is logged in
  $gallery_id = '0000000000';
  $header = "Galleries";
  $preCache = true;
  $pre_gallery_id = $gallery_id;
  $pre_index=true;

  include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

  // Only include Javascript if a user is logged in
  if (UserIsLoggedIn())
  {
    $bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/_request.js'></script>\n";
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    $bodycontent .= "  title_max_length = ".$CFG["TITLE_DESC_LENGTH"].";\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "</script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_main.js'></script>\n";
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    $bodycontent .= "  var editblock=";
    $bodycontent .= LoadTemplateRootForJavaScript("component_main_form_edit.php");
    $bodycontent .= ";\n";

    $bodycontent .= "  var feedback_box = ";
    $bodycontent .= moa_feedback_js();
    $bodycontent .= ";\n";

    $bodycontent .= "  var template_path = 'templates/".$template_name."/';\n";

    $bodycontent .= "  var main = new Main('".js_var_display_safe($CFG["STR_DELIMITER"])."');\n";
    $bodycontent .= "  main.PreLoad('".js_var_display_safe(_MainGetDescription())."');\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "</script>\n";
  }

  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  $bodycontent .= LoadTemplateRoot("page_main_view.php");
  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

  $bodytitle =  "Main gallery - ".html_display_safe($CFG['SITE_NAME']);
?>
