<?php
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    session_start();
    
    echo "<head>\n";
    echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
    echo "</head>\n";
    echo "<body>\n";
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());

    // If adding a tag
    if (isset($_REQUEST["tagname"]) == true)
    {
      $query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
      $result = mysql_query($query) or die("ERROR!".mysql_error()."<br>");
      
      if (0 == mysql_num_rows($result))
      {
        $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES ("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
        $result = mysql_query($query) or die("ERROR!".mysql_error()."<br>");
      }
    }
    
    // Show button to add new tag
    //echo "<input type='button' value='Add new tag' onclick='javascript:show_add()'></input><br>";
    echo "<a href='javascript:void(0)' class='admin_link' onclick='javascript:show_add()'>[Add new tag]</a><br><br>";
    
    // Show all tags
    {
    $query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
    $result = mysql_query($query);

    while ($taglist = mysql_fetch_array($result))
    {
      echo "<div style='clear: both'><input style='float: left' class='form_label_text' type='checkbox' onClick='onTick(\"".$taglist["IDTag"]."\");' ";
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
