<?php
  // Only proceed if a user is logged in
  if (UserIsLoggedIn())  
  {
    echo "<a href='index.php?action=gallery_add&parent_id=0000000000' class='admin_link'>[Add Gallery]</a> \n";
    echo "<a href='index.php?action=image_add&parent_id=0000000000' class='admin_link'>[Add Image]</a><br/><br/> \n";
  }

  $gallery_id = '0000000000';
  $header = "Galleries";
  $pre_cache = true;
  $pre_gallery_id = $gallery_id;
  $pre_index=true;
  ViewGalleryBlock($gallery_id);

  $page_title = "Main gallery";
?>
