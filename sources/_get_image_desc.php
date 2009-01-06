<?php
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  
  $name_changed = false;

  if (isset($_REQUEST["image_id"]) == false)
  {
    moa_warning("No Image ID supplied.");
    die();
  }
  
  $image_id = $_REQUEST["image_id"];
  
  include_once("../private/db_config.php");
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  include_once("../config.php");
  include_once("id.php");
  
  $query = "SELECT Description FROM ".$tab_prefix."image WHERE (IDImage = '".mysql_real_escape_string($image_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $image = mysql_fetch_array($result);
  
  if ($TITLE_DESC_LENGTH > 0)
  {
    if (strlen($image["Description"]) <= $TITLE_DESC_LENGTH)
    {
      echo $image["Description"];
    } else
    {
      echo " - " . substr($image["Description"], 0, $TITLE_DESC_LENGTH-3) . "...";
    }
  }
?>