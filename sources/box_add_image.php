<?php
    session_start();
?>
  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" style="border:none;">  
  <head>
    <link rel='stylesheet' href='../style/style.css' type='text/css' />
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title></title>
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
                document.getElementById('feedback').innerHTML='Uploading, please wait...';
                document.getElementById('gallery_form').submit();
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
    include_once("_thumbnail_func.php");
    include_once("_error_funcs.php");
    include_once("common.php");
    include_once("_db_funcs.php");
    $db = DBConnect();
    
    $added_ok = false;
    $error = "";
    
    if (isset($_REQUEST["MAX_FILE_SIZE"]))
    {            
      // Check if an image has been supplied
      if ($_FILES['filename']['error'] != UPLOAD_ERR_OK) 
      {      	
      	 // Image failed to upload find out why and explain      	 
      	 if ($_FILES['filename']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['filename']['error'] == UPLOAD_ERR_FORM_SIZE) 
      	 {
      	    $error = "Failed to upload file to web server...  File to big<br/>";
      	 }
      	 elseif ($_FILES['filename']['error'] == UPLOAD_ERR_PARTIAL) 
      	 {
      	    $error = "Failed to upload file to web server...  Partial Load<br/>";
      	 }
      	 elseif	($_FILES['filename']['error'] == UPLOAD_ERR_NO_FILE) 
      	 {
      	    $error = "Failed to upload file to web server...  No file supplied<br/>";
      	 }
      } else
      { 
        $src_img = imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);
        
        if (false == $src_img) {
        	$error = "Failed to read image... File not a valid JPG<br/>";
        }
        else {        
	
	        $new_comment = mysql_real_escape_string($_REQUEST["comment"]);
	        $new_filename = mysql_real_escape_string($_FILES["filename"]["name"]);
	        
	        $query = "INSERT INTO ".$tab_prefix."image (Filename, Width, Height, Description) VALUES (_utf8'".$new_filename."', 0, 0, _utf8'".$new_comment."');";
	        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	        $newid = mysql_insert_id($db);
               	        	
	        $origw=imagesx($src_img); 
	        $origh=imagesy($src_img); 
	        imagedestroy($src_img);
	        $query = "UPDATE ".$tab_prefix."image SET Width=".$origw.", Height=".$origh." WHERE IDImage=".$newid.";";
	        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	        
	        $new_filename = sprintf("%010s.jpg",$newid);
	        
	        move_uploaded_file( $_FILES["filename"]["tmp_name"]       // source file
	                          , "../".$IMAGE_PATH."/".$new_filename); // dest file
	                            
	        thumbnail( $new_filename, "jpeg", false);
	        
	        foreach ($_SESSION as $key => $value)
	        {
	          if (strcmp("tag-", $key))
	          {
	            $tagid = mb_substr($key, -10);
	            $query = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) SELECT '".$newid."', IDTag FROM ".$tab_prefix."tag WHERE IDTag = '".$tagid."'";
	            $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	          }
	        }
	        $added_ok = true;
	      }
      }
    }
?> 
  <form id="gallery_form" class="no_cr" method="post" action="box_add_image.php?PHPSESSID=<?php echo session_id() ?>" enctype="multipart/form-data">
    <div id="debug"></div>
    <table cellpadding="0" border="0">
      <tr>      	      	
        <td valign='top' class='form_label_text'>Comment:</td>
        <td><textarea class='form_text' name="comment" cols="35" rows="3" id="commentbox"></textarea></td>
        <td rowspan="3" valign="middle" style="width:10px;"></td>
      </tr>
      <tr>
        <td valign='top' class='form_label_text'>File:</td>
        <td>
          <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
          <input class='form_text' type="file" id="file_dlg" size="30" name="filename" accept="image/jpg" onkeyup="document.getElementById('feedback').innerHTML='&lt;br /&gt;'"></input><br />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type='button' value='Add Image' onclick="ajaxCheckTags();" />
          <br/><br/>
          <div id="feedback" class="form_label_text">
            <?php
              if (true == $added_ok)
              {
             	  moa_feedback("Image added", true);   
              }
              if (mb_strlen($error) > 0) 
              {
              	echo $error;
              }
            ?>
          </div>
        </td>
      </tr>
    </table>
  </form>
  <script type="text/javascript">
    document.getElementById("commentbox").focus();
  </script>
</body>  
</html>
