<?php
  // Only proceed if a user is logged in
  $gallery_id = '0000000000';
  $header = "Galleries";
  $pre_cache = true;
  $pre_gallery_id = $gallery_id;
  $pre_index=true;

  echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  echo LoadTemplateRoot("page_main_view.php");
  echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

  $page_title = "Main gallery";
?>
