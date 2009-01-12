<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../private/db_config.php");
  session_start();
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  
  $query = "SELECT * FROM ".$tab_prefix."tag";
  $result = mysql_query($query);
  
  $tagcount = 0;

  while ($taglist = mysql_fetch_array($result))
  {
    if (isset($_SESSION["tag-".$taglist["IDTag"]]))
    {
      if (true == $_SESSION["tag-".$taglist["IDTag"]]);
      {
        $tagcount++;
      }
    }
  }
  
  if (0 < $tagcount)
  {
    echo "OK";
  } else
  {
    echo "No tags";
  }
?>