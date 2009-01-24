<?php
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  
  include_once("_db_funcs.php");
  $db = DBConnect();
  
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