<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../private/db_config.php");
  include_once("_error_funcs.php");
  session_start();
  
  if (isset($_REQUEST["name"]))
  {
    $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    
    $name = mysql_real_escape_string(strip_tags($_REQUEST["name"]));
    
    $query = "SELECT count(1) AS 'count' FROM ".$tab_prefix."users WHERE Name = '".$name."'";
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