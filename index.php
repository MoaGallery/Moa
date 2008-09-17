<?php
  include_once ("sources/_login.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>View Gallery - Home</title>";
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
      include ("sources/_thumb_list.php");
      include ("sources/_footer.php");
    ?>
  </body>
</html>