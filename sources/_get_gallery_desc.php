<?php
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  
  $name_changed = false;

  if (isset($_REQUEST["gallery_id"]) == false)
  {
    die("Error: No Gallery ID supplied");
  }
  
  $gallery_id = $_REQUEST["gallery_id"];
  
  include_once("../private/db_config.php");
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  include_once("../config.php");
  include_once("id.php");
  
  $query = "SELECT Description FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or die(mysql_error());
  $gallery = mysql_fetch_array($result);
  
  if ($TITLE_DESC_LENGTH > 0)
  {
    if (strlen($gallery["Description"]) <= $TITLE_DESC_LENGTH)
    {
      echo $gallery["Description"];
    } else
    {
      echo " [" . substr($gallery["Description"], 0, $TITLE_DESC_LENGTH-3) . "...]";
    }
  }
?>