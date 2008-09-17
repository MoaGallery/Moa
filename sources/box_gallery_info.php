<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../private/db_config.php");
  include_once("../config.php");
  
  if (isset($_REQUEST["gallery_id"]) == false)
  {
    echo "No gallery ID supplied";
    die();
  } else
  {
    $gallery_id = $_REQUEST["gallery_id"];
  }
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  
  include_once ("id.php");
    
  $gallery_id = sprintf("%010s", $_REQUEST["gallery_id"]);
  
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDGallery=".mysql_real_escape_string($gallery_id).");";
  $result = mysql_query($query) or die(mysql_error());
  $gal_info = mysql_fetch_array($result);
  
  if ($Userinfo->ID != NULL) {    
    echo "<a class='admin_link' onclick='ajaxShowTitles(\"".$gallery_id."\", \"NULL\", \"NULL\", \"true\")'>[Edit]</a> \n";
    echo "<a class='admin_link' onclick='gallery_delete(\"".$gallery_id."\", \"".$gal_info["IDParent"]."\");'>[Delete]</a> \n";
    echo "<a class='admin_link' href='add_image.php?parent_id=".$gallery_id."'>[Add Image]</a> \n";
    echo "<a class='admin_link' href='add_gallery.php?parent_id=".$gallery_id."'>[Add Sub-Gallery]</a><br><br>\n";
  }  
    
  echo "<table cellpadding=0 cellspacing=0><tr><td><span id='galleryeditinfo'></span></td></tr></table>\n";

  if ($gal_info == false)
  {
    die();
  }
?>
