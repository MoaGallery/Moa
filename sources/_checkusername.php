<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("_db_funcs.php");
  include_once("_error_funcs.php");
  session_start();
  
  if (isset($_REQUEST["name"]))
  {
    $db = DBConnect();
    
    include_once("id.php");
    
    if ((NULL == $Userinfo->ID) || (0 == $Userinfo->UserAdmin))
    {
      moa_warning("You must be logged in to use this page.");
      die();
    }
    
    $name = magic_url_decode($_REQUEST["name"]);
    
    $query = "SELECT count(1) AS 'count' FROM ".$tab_prefix."users WHERE Name = '".mysql_real_escape_string($name)."'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    $count = $row["count"];
    if (0 == $count)
    {
      echo "OK";
    } else
    {
      echo "In use";
    }
  }
?>