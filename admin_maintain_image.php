<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>New image file</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");

      if ($Userinfo->ID == NULL)
      {
      	echo "You are not logged in. Bog off!";
        die();
      }
      
      if (isset($_REQUEST["image_id"])) {
      	$image_id = $_REQUEST["image_id"];
      }
      else
      {
      	echo "No image ID supplied";
        die();
      }
  
      include_once ("sources/_admin_page_links.php");
      include_once ("sources/_thumbnail_func.php");
      
      echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>Upload missing image file</td></tr><tr><td class='pale_area_nb'>\n";
      
      $query = "SELECT * FROM ".$tab_prefix."image WHERE IDImage = ".$image_id;
      $result = mysql_query($query) or die(mysql_error());    
      
      $image_info = mysql_fetch_array( $result);  
      
      if (file_exists($IMAGE_PATH."/".$image_id.".jpg") == true)
      {
      	echo "That image is not missing its file\n<br><br>";
      } else
      {
	      if (isset($_REQUEST["MAX_FILE_SIZE"])) {
	            $src_img = imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);
	                    
	            $new_filename = sprintf("%010s.jpg",$image_id);
	            
	            move_uploaded_file( $_FILES["filename"]["tmp_name"]  // source file
	                                , $IMAGE_PATH."/".$new_filename);     // dest file
	                                
	            thumbnail( $new_filename, "jpeg", true);
	            
	            echo "Image uploaded\n<br><br>";
	      }
	      else
	      {
	        if ($image_info == false) {
	        	echo "Invalid image id supplied";
	          die();  	
	        }
	  ?>  
	  <form name="image_add" method="post" action="admin_maintain_image.php?image_id=<?php echo $image_id ?>"  enctype="multipart/form-data">
	    <div id="debug"></div>
	    <table cellpadding="5" border=0>
	    	<tr>        
	        <td rowspan="4" valign="center" width="10"></td>
	      </tr>
	    	<tr>
	    	   <td>Original Filename:</td>
	    	   <td><?php echo nl2br(htmlspecialchars($image_info["Filename"]));?></td>
	      </tr>      
	    	<tr>
	    	   <td>Description:</td>
	    	   <td><?php echo nl2br(htmlspecialchars($image_info["Description"]));?></td>
	      </tr>            
	      <tr>
	        <td>File:</td>
	        <td>
	          <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
	          <input type="file" id="file_dlg" onchange="javascript:file_change();"size="30" name="filename" accept="image/jpg" onkeyup="document.getElementById('status').innerHTML='<BR>'"></input><br>
	        </td>
	      </tr>
	      <tr>
	      <td cellspan="2"><input type='submit' value='Add Image'></input></td>
	      </tr>
	    </table>
	  </form>  
	<?php
	  }
	}
  echo "<a class='nav_link' href='admin_maintain.php'>&lt;-- Back to Image Integrity</a>";
  echo "</td></tr></table>\n";
  
  include_once ("sources/_footer.php");
?>

  </body>
</html>