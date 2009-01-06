<?php
  if ((isset($_REQUEST["image_delete"])) &&
      (strcmp($_REQUEST["image_delete"], "true") == 0) &&
      (isset($_REQUEST["image_delete_id"])) &&
      ($Userinfo->ID != NULL)
      )
  {
    $query = "DELETE FROM ".$tab_prefix."imagetaglink WHERE IDImage = ".mysql_real_escape_string($_REQUEST["image_delete_id"]);
    $result = mysql_query( $query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    $query = "DELETE FROM ".$tab_prefix."image WHERE IDImage = ".mysql_real_escape_string($_REQUEST["image_delete_id"]);
    $result = mysql_query( $query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    
    if (file_exists( "./".$IMAGE_PATH."/".$_REQUEST["image_delete_id"].".jpg")) {
      unlink( "./".$IMAGE_PATH."/".$_REQUEST["image_delete_id"].".jpg");
    }
    
    if (file_exists( "./".$THUMB_PATH."/thumb_".$_REQUEST["image_delete_id"].".jpg")) {
      unlink( "./".$THUMB_PATH."/thumb_".$_REQUEST["image_delete_id"].".jpg");
    }
  }
?>
