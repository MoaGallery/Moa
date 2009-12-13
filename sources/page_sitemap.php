<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."config.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");

  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  $bodycontent .= LoadTemplateRoot("page_sitemap.php");
  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";


  $bodytitle = "Sitemap - Moa";
?>
