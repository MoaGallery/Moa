<?php
  if (is_file("config.php") == false)
  {
    include("install.php");
    die();
  }
  include_once ("config.php");
  if (isset($FRESH_INSTALL) == false)
  {
    include_once ("sources/_login.php");
  }
  
  include_once("sources/id.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       if (isset($FRESH_INSTALL))
       {
         include("install.php");
         die();
       }
       echo "<title>Gallery - Home</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
      include_once ("sources/_gallery_delete.php");

      if ($Userinfo->ID != NULL)
      {
        echo "<a href='add_gallery.php?parent_id=0000000000' class='admin_link'>[Add Gallery]</a><br/><br/> \n";
      }
      
      $gallery_id = '0000000000';
      $header = "Galleries";
      $pre_cache = true;
      $pre_gallery_id = $gallery_id;
      $pre_index=true;
      include ("sources/_thumb_list.php");
      include ("sources/_footer.php");
    ?>
  </body>
</html>