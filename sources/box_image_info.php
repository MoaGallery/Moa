<?php
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    include_once("../config.php");
    
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());
    
    include_once ("id.php");
    
    echo "<body>\n";
    if (isset($_REQUEST["image_id"]) == false)
    {
       mysql_close($db);
       echo "No image specified";
    } else
    {            
      $query = "SELECT * FROM ".$tab_prefix."image WHERE (IDImage='".mysql_real_escape_string($_REQUEST["image_id"])."');";
      $result = mysql_query($query);
      $image = mysql_fetch_array($result);

      if (mysql_num_rows($result) > 0)
      {
        if ($Userinfo->ID != NULL) {
          echo "<a class='admin_link' onclick='ajaxInfoDescription(\"".$_REQUEST["image_id"]."\", \"NULL\", \"true\")'>[Edit]</a> ";
          echo "<a class='admin_link' onclick='image_delete(\"".$_REQUEST["image_id"]."\", \"".$_REQUEST["parent_id"]."\");'>[Delete]</a>\n";
          echo "<br><br>\n";
        }
        echo "<span id='imagedesc'></span><BR><BR>\n";
        echo "<div class='image_desc' style='float: bottom'>\n";
        $width = $image["Width"];
        $height = $image["Height"];
        if (($width > $CONFIG_DISPLAY_MAX_WIDTH) or ($height > $CONFIG_DISPLAY_MAX_WIDTH * 0.75))
        {
          echo "Size:&nbsp;".$width."x".$height."<br/>";          
          echo "View full size: <a href='view_image_full.php?image_id=".$_REQUEST["image_id"]."'>link</a>\n";
        }        
        echo "</body>\n";
        mysql_close($db);
      } else
      {
        mysql_close($db);
        echo "Image does not exist";
      }
    }
?>