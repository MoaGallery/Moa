<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Orphan images</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");

      if ($Userinfo->ID == NULL) {
        moa_warning("You must be logged in to use this page.");
      } else
      {
        include_once ("sources/_admin_page_links.php");
        include_once ("sources/_image_delete.php");
        include_once ("sources/_integrity_funcs.php");
    
        echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>Orphan Images</td></tr><tr><td class='pale_area_nb'>\n";
  
        ShowNonTaggedOrphans();
        echo "<hr>\n";
        ShowNoGalleryOrphans();
          
        echo "</td></tr></table>\n";
      }
      
      include_once ("sources/_footer.php");
    ?>

  </body>
</html>