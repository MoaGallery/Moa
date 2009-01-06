<?php
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    include_once("_error_funcs.php");
    session_start();
    
    echo "<head>\n";
    echo "<link rel='stylesheet' href='../style/style.css' type='text/css'>\n";
    echo "</head>\n";
    echo "<body>\n";
    $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    // If adding a tag
    if (isset($_REQUEST["tagname"]) == true)
    {
      $query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      
      if (0 == mysql_num_rows($result))
      {
        $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES ("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
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
      echo "id='tag-".$taglist["IDTag"]."'><div class='form_label_text'> ".$taglist["Name"]."</div></input></div>\n";
    }
    echo "<br>";
    mysql_close($db);
  }
  echo "</body>\n";
?>
