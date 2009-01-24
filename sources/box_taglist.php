<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Type: text/html; charset=utf-8");
    include_once("_db_funcs.php");
    $db = DBConnect();
    include_once("_error_funcs.php");
    include_once("common.php");
    session_start();
    
    echo "<head>\n";    
    echo "</head>\n";
    echo "<body>\n";

    // If adding a tag
    if (isset($_REQUEST["tagname"]) == true)
    {
      $tagname = magic_url_decode($_REQUEST["tagname"]);
      
      $query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string($tagname).'");';
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      
      if (0 == mysql_num_rows($result))
      {
        $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES (_utf8"'.mysql_real_escape_string($tagname).'");';
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      }
    }
    
    // Show button to add new tag
    echo "<div id='addtagarea'></div><br/>\n";
    
    // Show all tags
    {
    $query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
    $result = mysql_query($query);

    while ($taglist = mysql_fetch_array($result))
    {
      echo "<div style='clear: both; height=\"24px\";'><input style='float: left; vertical-align: middle;'  class='form_label_text' type='checkbox' onClick='onTick(\"".$taglist["IDTag"]."\");' ";
      if (isset($_SESSION["tag-".$taglist["IDTag"]]))
      {
        echo "checked='true' ";
      }
      echo "id='tag-".$taglist["IDTag"]."'><div class='form_label_text'> ".html_display_safe($taglist["Name"])."</div></input></div>\n";
    }
    echo "<br/>";
    mysql_close($db);
  }
  echo "</body>\n";
?>
