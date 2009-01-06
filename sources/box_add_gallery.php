<?php    
    session_start();
    
    echo "<html>\n";
    echo "<head>\n";
    echo "<link rel='stylesheet' href='../style/style.css' type='text/css'>\n";
    echo "</head>\n";
    echo "<body style='margin: 0px' scroll='no' class='pale_area_nb'>";
    
    include_once("../private/db_config.php");
    include_once("../config.php");
    include_once("_error_funcs.php");
    
    $added_ok = false;
    
    if (isset($_REQUEST["name"]))
    {
      $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

      $new_comment = mysql_real_escape_string(strip_tags($_REQUEST["comment"]));
      $query = "INSERT INTO ".$tab_prefix."gallery (Name, Description, IDParent) VALUES ('".mysql_real_escape_string(strip_tags($_REQUEST["name"]))."', '".$new_comment."', '".mysql_real_escape_string($_REQUEST["parent_id"])."');";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      $newid = mysql_insert_id($db);
      $newid_str = sprintf("%010s", $newid);
      
      foreach ($_SESSION as $key => $value)
      {
        if (strcmp("tag-", $key))
        {
          $tagid = substr($key, -10);
          $query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES ('".$newid_str."', '".$tagid."');";
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        }
      }
      
      $added_ok = true;
    }
?>

  <form name="gallery_add" method="post" action="box_add_gallery.php?PHPSESSID=<?php echo session_id() ?>"  enctype="multipart/form-data">    
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class='form_label_text' style='width: 120px' valign='top'>Name:</td>
        <td valign='top'><input class='form_text' type='text' name="name" id="namebox"></td>        
      </tr>
      <tr>
        <td class='form_label_text' style='width: 120px' valign='top'>Comment:</td>
        <td valign='top'><textarea class='form_text' name="comment" cols="32" rows="3"></textarea></td>
      </tr>
      <tr>
        <td class='form_label_text' style='width: 120px' valign='top'>Parent Gallery:</td>
        <td><select name="parent_id">
          <?php
            $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
            mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        
            $query = "SELECT * FROM ".$tab_prefix."gallery;";
            $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
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
      <td colspan="2"><br/><input type='submit' value='Add Gallery'></input><br/><br/>
      <?php
        if (true == $added_ok)
        {
        	moa_feedback("Gallery added", true);   
        }
      ?>
      </td>
      </tr>
    </table>
  </form>
  <script type="text/javascript">
    document.getElementById("namebox").focus();
  </script>
</body>
</html>