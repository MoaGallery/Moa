<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");
  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  $bodycontent .= "    <a onclick='history.go(-1)'><img src='".$CFG["IMAGE_PATH"].$_REQUEST["image_id"];
  $Image = new Image();
  $Image->loadId($_REQUEST["image_id"]);
  $ext = $Image->format;
  $bodycontent .= ".".$ext."' onmouseover='this.style.cursor=\"hand\"' alt='Full size image' /></a>";
  $bodytitle = "Image";
  $desc = $Image->description;
  if (strlen($desc) > 0)
  {
  	if (strlen($desc) > $CFG["TITLE_DESC_LENGTH"])
  	{
  		$bodytitle .= " '" . html_display_safe(mb_substr($desc, 0, $CFG["TITLE_DESC_LENGTH"]-3)) . "...' - ".$CFG['SITE_NAME'];
  	} else
  	{
  		$bodytitle .=  " '" . html_display_safe($desc) . "' - ".$CFG['SITE_NAME'];
  	}
  }
  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
?>
