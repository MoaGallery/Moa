<?php    
    session_start();
    
    echo "<html style='margin: 0px'>\n";
    echo "<head>\n";
    echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
    echo "</head>\n";
    echo "<body style='margin: 0px' scroll='no' class='pale_area_nb'>";
    
    include_once("../private/db_config.php");
    include_once("../config.php");
    
    if (isset($_REQUEST["name"]))
    {
      $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
      mysql_select_db($db_name, $db) or die("Error" . mysql_error());

      $new_comment = mysql_real_escape_string(strip_tags($_REQUEST["comment"]));
      $query = "INSERT INTO ".$tab_prefix."gallery (Name, Description, IDParent) VALUES ('".mysql_real_escape_string(strip_tags($_REQUEST["name"]))."', '".$new_comment."', '".mysql_real_escape_string($_REQUEST["parent_id"])."');";
      $result = mysql_query($query) or die(mysql_error());
      $newid = mysql_insert_id($db);
      
      foreach ($_SESSION as $key => $value)
      {
        if (strcmp("tag-", $key))
        {
          $tagid = substr($key, -10);
          $query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES (".$newid.", ".$tagid.");";
          $result = mysql_query($query) or die(mysql_error());
        }
      }     
    }
?>

  <form name="gallery_add" method="post" action="box_add_gallery.php?PHPSESSID=<?php echo session_id() ?>"  enctype="multipart/form-data">    
    <table border="0" cellspacing="0" cellpadding="0" class='normal_text'>
      <tr>
        <td class='form_label_text' style='width: 100px' valign='top'>Name:</td>
        <td valign='top'><input class='form_text' type='text' name="name"></td>        
      </tr>
      <tr>
        <td  class='form_label_text' style='width: 100px' valign='top'>Comment:</td>
        <td><textarea class='form_text' name="comment" cols="32" rows="3"></textarea></td>
      </tr>
      <tr>
        <td class='form_label_text' style='width: 100px' valign='top'>Parent Gallery:</td>
        <td><select name="parent_id">
          <?php
            $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
            mysql_select_db($db_name, $db) or die("Error" . mysql_error());
        
            $query = "SELECT * FROM ".$tab_prefix."gallery;";
            $result = mysql_query($query) or die(mysql_error());
            echo "<option value='0000000000'>No Parent</option>";
            while ($gallery = mysql_fetch_array($result))
            {
              echo "<option value='".$gallery["IDGallery"]."'";
              if (isset($_REQUEST["parent_id"]))
              {
                $parent_id = sprintf("%010s", $_REQUEST["parent_id"]);
                if (strcmp($parent_id, $gallery["IDGallery"]) == 0)
                {
                  echo "selected='selected'";
                }
              }
              echo ">".$gallery["Name"]."</option>\n";
            }
          ?>
        </select></td>
      </tr>
      <tr>      
      <td colspan="2"><br/><input type='submit' value='Add Gallery'></input>
      <?php
        if (isset($_REQUEST["name"]))
        {
        	echo "<span class='form_text' id='status'>&nbsp;&nbsp;&nbsp;&nbsp;Submitted new gallery: '".strip_tags($_REQUEST["name"])."'</span>";    
        } else
        {
        	echo "<span class='form_text' id='status'></span>";    
        }
      ?>
      </td>
      </tr>
    </table>
  </form>
</body>
</html>