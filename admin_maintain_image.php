<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Image maintanence</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");

      if ($Userinfo->ID == NULL)
      {
        moa_warning("You must have admin rights to use this page.");
        include_once ("sources/_footer.php");
        echo "</body>\n</html>\n";
        die();
      }
      
      include ("sources/_admin_page_links.php");
        
      if (isset($_REQUEST["image_id"])) {
      	$image_id = $_REQUEST["image_id"];
      }
      else
      {
        moa_warning("No image ID supplied.");
        include_once ("sources/_footer.php");
        echo "</body>\n</html>\n";
        die();
      }
  
      include_once ("sources/_admin_page_links.php");
      include_once ("sources/_thumbnail_func.php");
      
      echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'>";
      echo "<tr>";
      echo "<td class='box_header'>Upload missing image file</td>";
      echo "</tr><tr>";
      echo "<td class='pale_area_nb'>\n";
      
      $query = "SELECT * FROM ".$tab_prefix."image WHERE IDImage = ".$image_id;
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);  
      
      $image_info = mysql_fetch_array( $result);  
      
      if (file_exists($IMAGE_PATH."/".$image_id.".jpg") == true)
      {
      	moa_warning("That image is not missing its file\n");
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
	        	moa_warning("Invalid image id supplied.");
            include_once ("sources/_footer.php");
            echo "</body>\n</html>\n";
	          die();  	
	        }
	  ?>  
	  <form name="image_add" method="post" action="admin_maintain_image.php?image_id=<?php echo $image_id ?>"  enctype="multipart/form-data">
	    <div id="debug"></div>
	    <table cellpadding="5" border=0>
	    	<tr>
	    	   <td class="form_label_text">Original Filename:</td>
	    	   <td class="form_label_text"><?php echo nl2br(htmlspecialchars($image_info["Filename"]));?></td>
	      </tr>      
	    	<tr>
	    	   <td class="form_label_text">Description:</td>
	    	   <td class="form_label_text"><?php echo nl2br(htmlspecialchars($image_info["Description"]));?></td>
	      </tr>            
	      <tr>
	        <td class="form_label_text">File:</td>
	        <td>
	          <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
	          <input type="file" id="file_dlg" onchange="javascript:file_change();"size="30" name="filename"  class="form_label_text"accept="image/jpg" onkeyup="document.getElementById('status').innerHTML='<BR>'"></input><br>
	        </td>
	      </tr>
	      <tr>
	      <td colspan="2"><input type='submit' value='Add Image'></input></td>
	      </tr>
	    </table>
	  </form>  
	<?php
	  }
	}
  echo "</td></tr></table>\n";
  
  include_once ("sources/_footer.php");
?>

  </body>
</html>