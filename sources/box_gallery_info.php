<?php
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../config.php");
    include_once("common.php");
    include_once("_db_funcs.php");
  }
  
  if (isset($_REQUEST["gallery_id"]) == true)
  {
    $gallery_id = $_REQUEST["gallery_id"];
  } else
  { if (isset($pre_gallery_id) == true)
    {
      $gallery_id = pre_gallery_id;
    } else
    {
      moa_warning("No gallery ID supplied.", true);
      die();
    }
  } 
  $db = DBConnect();

  include_once ("id.php");
    
  $gallery_id = sprintf("%010s", $_REQUEST["gallery_id"]);
  
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDGallery=".mysql_real_escape_string($gallery_id).");";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $gal_info = mysql_fetch_array($result);
  
  if ($Userinfo->ID != NULL) {    
    echo "<a class='admin_link' onclick='ajaxShowTitles(\"".$gallery_id."\", \"NULL\", \"NULL\", \"true\")'>[Edit]</a> \n";
    echo "<a class='admin_link' onclick='gallery_delete(\"".$gallery_id."\", \"".$gal_info["IDParent"]."\");'>[Delete]</a> \n";
    echo "<a class='admin_link' href='add_image.php?parent_id=".$gallery_id."'>[Add Image]</a> \n";
    echo "<a class='admin_link' href='add_gallery.php?parent_id=".$gallery_id."'>[Add Sub-Gallery]</a><br/><br/>\n";
  }  
    
  echo "<table cellpadding='0' cellspacing='0'><tr><td><div id='galleryeditinfo'>";
  if (isset($pre_cache_from_sources) == false)
  {
    $pre_cache_from_sources = false;
  }
  
  if ($pre_cache_from_sources == true)
  {
    include_once("box_gallery_titles.php");
  } else
  {
    include_once("sources/box_gallery_titles.php");
  }

  echo "</div></td></tr></table>\n";

  if ($gal_info == false)
  {
    moa_warning("Invalid gallery.");
    die();
  }
?>
