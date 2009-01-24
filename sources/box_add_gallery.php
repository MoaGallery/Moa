<?php    
  session_start();
?>    

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
  <head>
    <link rel='stylesheet' href='../style/style.css' type='text/css'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  </head>
  <body style='margin: 0px;' scroll='no' class='pale_area_nb'>
    <script type="text/javascript" src="_ajax.js.php"> </script>
    <script type="text/javascript">
      function ajaxCheckTags()
      {
        var xmlHttp = GetAjaxObject();
        
        xmlHttp.onreadystatechange=function()
        {
        if(xmlHttp.readyState==4)
          {
            if (xmlHttp.responseText == "OK")
            {
              document.gallery_add.submit();
            } else
            {
              alert("You must have at least 1 tag selected.");
            }
          }
        }    
        
        gottags_flag = false;
        xmlHttp.open("GET","_numtags.php?PHPSESSID=<?php echo session_id(); ?>",true);
        
        xmlHttp.send(null);
      }
      </script>
<?php    
    include_once("../config.php");
    include_once("_error_funcs.php");
    include_once("common.php");
    include_once("_db_funcs.php");
    $db = DBConnect();
    
    $added_ok = false;
    
    if (isset($_REQUEST["name"]))
    {
      $new_comment = mysql_real_escape_string($_REQUEST["comment"]);
      $new_name = mysql_real_escape_string($_REQUEST["name"]);
      $new_parent_id = mysql_real_escape_string($_REQUEST["parent_id"]);
      
      $query = "INSERT INTO ".$tab_prefix."gallery (Name, Description, IDParent) VALUES (_utf8'".$new_name."', _utf8'".$new_comment."', '".$new_parent_id."');";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      $newid = mysql_insert_id($db);
      $newid_str = sprintf("%010s", $newid);            
      
      foreach ($_SESSION as $key => $value)
      {
        if (strcmp("tag-", $key))
        {
          $tagid = mb_substr($key, -10);                                        
          $query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) SELECT '".$newid_str."', IDTag FROM ".$tab_prefix."tag WHERE IDTag = '".$tagid."'";                    
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
            $query = "SELECT * FROM ".$tab_prefix."gallery;";
            $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
            echo "<option value='0000000000'>No Parent</option>";
            while ($gallery = mysql_fetch_array($result))
            {
              echo "<option value='".html_display_safe($gallery["IDGallery"])."'";
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
        <td colspan="2"><br/><input type="button" value='Add Gallery' onclick='ajaxCheckTags();'></input><br/><br/>
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