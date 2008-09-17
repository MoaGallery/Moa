<?php
  if ((isset($_REQUEST["gallery_delete"])) &&
      (strcmp($_REQUEST["gallery_delete"], "true") == 0) &&
      (isset($_REQUEST["gallery_delete_id"])) &&
      (strcmp($_REQUEST["gallery_delete_id"], "0000000000") != 0) &&
      ($Userinfo->ID != NULL)
      )
  {
    
    $query = "SELECT IDParent FROM ".$tab_prefix."gallery WHERE (IDGallery = ".mysql_real_escape_string($_REQUEST["gallery_delete_id"]).")";
    $result = mysql_query( $query) or die(mysql_error());
    $galleries = mysql_fetch_array($result);
    if ($galleries)
    {
      $parent_id = $galleries["IDParent"];
      
      $query = "UPDATE ".$tab_prefix."gallery SET IDParent = '".mysql_real_escape_string($parent_id)."' WHERE (IDParent = ".mysql_real_escape_string($_REQUEST["gallery_delete_id"]).")";
      $result = mysql_query( $query) or die(mysql_error());
      
      $query = "DELETE FROM ".$tab_prefix."gallerytaglink WHERE (IDGallery = ".mysql_real_escape_string($_REQUEST["gallery_delete_id"].")");
      $result = mysql_query( $query) or die(mysql_error());

      $query = "DELETE FROM ".$tab_prefix."gallery WHERE (IDGallery = ".mysql_real_escape_string($_REQUEST["gallery_delete_id"].")");
      $result = mysql_query( $query) or die(mysql_error());
    }
  }
?>
