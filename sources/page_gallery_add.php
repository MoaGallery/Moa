<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  if (is_file("_settings.php"))
  {
    include_once("_settings.php");
  } else
  {
    if (is_file("sources/_settings.php"))
    {
      include_once("sources/_settings.php");
    }
  }
  LoadSettings();

  include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

  // If no parent, make it come off the root node
  $parent_id = GetParam("parent_id");
  if (false === $parent_id)
  {
    $parent_id = "0000000000";
  }

  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  $bodycontent .= LoadTemplateRoot("page_gallery_add.php");
  
  $bodycontent .= "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
  $bodycontent .= "<script type='text/javascript' src='sources/formcheck.js'></script>\n";
  $bodycontent .= "<script type='text/javascript' src='sources/mod_ui.js'></script>\n";
  $bodycontent .= "<script type='text/javascript'>\n";
  $bodycontent .= "  all_tags = '"; ViewAllTagList();
  $bodycontent .= "';\n";
  $bodycontent .= "  cur_tags = '';\n";
  $bodycontent .= "  title_max_length = ".$CFG["TITLE_DESC_LENGTH"].";\n";
  $bodycontent .= "</script>\n";
  $bodycontent .= "<script type='text/javascript' src='sources/mod_gallery.js'></script>\n";
  $bodycontent .= "<script type='text/javascript'>\n";
  $bodycontent .= "  //<![CDATA[\n";

  //$bodycontent .= "  var editform = ";
  //$bodycontent .= LoadTemplateRootForJavaScript("component_gallery_form_add.php");
  //$bodycontent .= ";\n";

  $bodycontent .= "  var feedback_box = ";
  $bodycontent .= moa_feedback_js();
  $bodycontent .= ";\n";
  $bodycontent .= "  var template_path = 'templates/".$template_name."/';\n";

  $bodycontent .= "  //]]>\n";
  $bodycontent .= "</script>\n";

  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

  $bodycontent .= "<script type='text/javascript'>\n";
  $bodycontent .= "  var gallery = new Gallery('".$CFG["STR_DELIMITER"]."');\n";
  $bodycontent .= "  gallery.PreLoad('', '', '', '".$parent_id."');\n";
  $bodycontent .= "  FormCheckSetup('gallery_add', false);\n";
  $bodycontent .= "</script>\n";
  
  $bodytitle .= "Add gallery - ".html_display_safe($CFG['SITE_NAME']);
?>