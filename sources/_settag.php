<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("_db_funcs.php");
  session_start();
  
  if (isset($_REQUEST["reset"]))
  {
    $db = DBConnect();
    
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