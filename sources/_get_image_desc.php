<?php
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  
  $name_changed = false;

  if (isset($_REQUEST["image_id"]) == false)
  {
    die("Error: No Image ID supplied");
  }
  
  $image_id = $_REQUEST["image_id"];
  
  include_once("../private/db_config.php");
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  include_once("../config.php");
  include_once("id.php");
  
  $query = "SELECT Description FROM ".$tab_prefix."image WHERE (IDImage = '".mysql_real_escape_string($image_id)."')";
  $result = mysql_query($query) or die(mysql_error());
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