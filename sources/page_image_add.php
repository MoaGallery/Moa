<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

  $parent_id = GetParam("parent_id");
  if (false === $parent_id)
  {
    $parent_id = "0000000000";
  }
  $bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
  $bodycontent .= "<script type='text/javascript' src='sources/_request.js'></script>\n";
  $bodycontent .= "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
  $bodycontent .= "<script type='text/javascript'>\n";
  $bodycontent .= "  all_tags = '"; ViewAllTagList();
  $bodycontent .= "';\n";
  $bodycontent .= "  cur_tags = '"; ViewGalleryCurrentTagList($parent_id);
  $bodycontent .= "';\n";
  $bodycontent .= "  title_max_length = ".$CFG["TITLE_DESC_LENGTH"].";\n";
  $bodycontent .= "</script>\n";
  $bodycontent .= "<script type='text/javascript' src='sources/mod_image.js'></script>\n";
  $bodycontent .= "<script type='text/javascript'>\n";
  $bodycontent .= "  //<![CDATA[\n";

  $bodycontent .= "    var editform = ";
  $bodycontent .= LoadTemplateRootForJavaScript("component_image_form_add.php");
  $bodycontent .= ";\n";

  $bodycontent .= "  var feedback_box = ";
  $bodycontent .= moa_feedback_js();
  $bodycontent .= ";\n";
  $bodycontent .= "  //]]>\n";

  $bodycontent .= "  var template_path = 'templates/".$template_name."/';\n";
  $bodycontent .= "    var image = new Image('".$CFG["STR_DELIMITER"]."');\n";
  $bodycontent .= "</script>\n";

  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  $bodycontent .= LoadTemplateRoot("page_image_add.php");

  $bodycontent .= "<script type='text/javascript'>\n";
  $bodycontent .= "  document.getElementById(\"imageaddform\").innerHTML = editform;\n";
  $bodycontent .= "  image.PreLoad('', '', '', '".$parent_id."');\n";
  $bodycontent .= "  image.PopulateForm();\n";
  $bodycontent .= "</script>\n";

  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

  $bodytitle = "Add image - Moa";
?>