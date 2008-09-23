<?php
    session_start();
        
    echo "<head>\n";
    echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
    echo "</head>\n";
    echo "<body style='margin: 0px' scroll='no' class='pale_area_nb'>";
    
    include_once("../private/db_config.php");
    include_once("../config.php");
    include_once("_thumbnail_func.php");
    
    if (isset($_REQUEST["MAX_FILE_SIZE"]))
    {
      // Check if an image has been supplied
      if ($_FILES['filename']['error'] != UPLOAD_ERR_OK) 
      {      	
      	 // Image failed to upload find out why and explain
      	 if ($_FILES['filename']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['filename']['error'] == UPLOAD_ERR_FORM_SIZE) 
      	 {
      	    echo "Failed to upload $filename to web server...  File to big<br>";
      	 }
      	 elseif ($_FILES['filename']['error'] == UPLOAD_ERR_PARTIAL) 
      	 {
      	    echo "Failed to upload $filename to web server...  Partial Load<br>";
      	 }
      	 elseif	($_FILES['filename']['error'] == UPLOAD_ERR_NO_FILES) 
      	 {
      	    echo "Failed to upload $filename to web server...  No file supplied<br>";
      	 }
      } else
      {
        $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
        mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  
        $new_comment = mysql_real_escape_string(strip_tags($_REQUEST["comment"]));
        $query = "INSERT INTO ".$tab_prefix."image (Filename, Width, Height, Description) VALUES ('".$_FILES["filename"]["name"]."', 0, 0, '".mysql_real_escape_string(strip_tags($new_comment))."');";
        $result = mysql_query($query) or die(mysql_error());
        $newid = mysql_insert_id($db);
        
        $src_img = imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);
        $origw=imagesx($src_img); 
        $origh=imagesy($src_img); 
        $query = "UPDATE ".$tab_prefix."image SET Width=".$origw.", Height=".$origh." WHERE IDImage=".$newid.";";
        $result = mysql_query($query) or die(mysql_error());
        
        $new_filename = sprintf("%010s.jpg",$newid);
        
        move_uploaded_file( $_FILES["filename"]["tmp_name"]  // source file
                            , "../".$IMAGE_PATH."/".$new_filename);     // dest file
                            
        thumbnail( $new_filename, "jpeg", false);
        
        foreach ($_SESSION as $key => $value)
        {
          if (strcmp("tag-", $key))
          {
            $tagid = substr($key, -10);
            $query = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) VALUES (".$newid.", ".$tagid.");";
            $result = mysql_query($query) or die(mysql_error());
          }
        }
        
        echo "<span class='form_text' id='status'>Submitted</span>";
      }
    } else
    {
      echo "<span style='float: left;' id='status'> </span>\n";
    }
?> 
  <form name="image_add" class="no_cr" method="post" action="box_add_image.php?PHPSESSID=<?php echo session_id() ?>" enctype="multipart/form-data">
    <div id="debug"></div>
    <table cellpadding="0" border=0>
      <tr>      	      	
        <td valign='top' class='form_label_text'>Comment:</td>
        <td><textarea class='form_text' name="comment" cols="35" rows="3"></textarea></td>
        <td rowspan="3" valign="center" width="10"></td>
      </tr>
      <tr>
        <td valign='top' class='form_label_text'>File:</td>
        <td>
          <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
          <input class='form_text' type="file" id="file_dlg" onchange="javascript:file_change();"size="30" name="filename" accept="image/jpg" onkeyup="document.getElementById('status').innerHTML='<BR>'"></input><br>
        </td>
      </tr>
      <tr>
      <td cellspan="2"><input type='submit' value='Add Image'></input></td>
      </tr>
    </table>
  </form>
</body>  