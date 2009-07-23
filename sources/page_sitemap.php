<?php
  include_once($MOA_PATH."config.php");
  include_once($MOA_PATH."sources/common.php");
  include_once($MOA_PATH."sources/_db_funcs.php");

  echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  echo LoadTemplateRoot("page_sitemap.php");
  echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";


  $page_title = "Sitemap";
?>
