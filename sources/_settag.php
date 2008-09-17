<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../private/db_config.php");
  session_start();
  
  if (isset($_REQUEST["reset"]))
  {
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());
    
    $query = "SELECT * FROM ".$tab_prefix."tag";
    $result = mysql_query($query);

    while ($taglist = mysql_fetch_array($result))
    {
      unset ($_SESSION["tag-".$taglist["IDTag"]]);
    }
  }
    
  if ($_REQUEST["ticked"] == "true")
  {
    $_SESSION["tag-".$_REQUEST["tagid"]] = true;
  } else
  {
    unset ($_SESSION["tag-".$_REQUEST["tagid"]]);
  }
?>