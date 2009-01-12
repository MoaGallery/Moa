<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Admin</title>";
     ?>
  </head>
  <body>  
     <?php
       include_once "sources/_header.php";
       include_once "sources/id.php";
       
       if ($Userinfo->ID == NULL) {
       	 moa_warning("You must have admin rights to use this page.");
       }  else
       {
         include ("sources/_admin_page_links.php");
       }
     
       include_once "sources/_footer.php";
     ?>
  </body>
</html>
