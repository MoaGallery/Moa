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
        moa_warning("You must be logged in to use this page.");
        include_once ("sources/_footer.php");
        echo "</body>\n</html>\n";
        die();
      }
      
      include ("sources/_admin_page_links.php");
        
      if (isset($_REQUEST["image_id"])) {
        $image_id = mysql_real_escape_string($_REQUEST["image_id"]);
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
      
      $query = "SELECT * FROM ".$tab_prefix."image WHERE IDImage = '".$image_id."'";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);  
      
      $image_info = mysql_fetch_array( $result);  
      
      if (file_exists($IMAGE_PATH."/".$image_id.".jpg") == true)
      {
        moa_warning("That image is not missing its file\n");
      } else
      {
        if (isset($_REQUEST["FORM_SUBMITTED"])) {
          // Check if an image has been supplied
          if ($_FILES['filename']['error'] != UPLOAD_ERR_OK) 
          {      	
          	 // Image failed to upload find out why and explain      	 
          	 if ($_FILES['filename']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['filename']['error'] == UPLOAD_ERR_FORM_SIZE) 
          	 {
          	    moa_error("Failed to upload file to web server...  File to big.", true);
          	 }
          	 elseif ($_FILES['filename']['error'] == UPLOAD_ERR_PARTIAL) 
          	 {
          	    moa_error("Failed to upload file to web server...  Partial Load.", true);
          	 }
          	 elseif	($_FILES['filename']['error'] == UPLOAD_ERR_NO_FILE) 
          	 {
          	    moa_error("Failed to upload file to web server...  No file supplied.", true);
          	 }
          } else
          { 
	          $src_img = imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);
	                  
	          if (false == $src_img)
	          {
	            moa_error("Failed to read image... File not a valid JPG<br/>", true);
	          } else
	          {
		          $new_filename = sprintf("%010s.jpg",$image_id);
		          
		          move_uploaded_file( $_FILES["filename"]["tmp_name"] // source file
		                            , $IMAGE_PATH."/".$new_filename); // dest file
		                              
		          thumbnail( $new_filename, "jpeg", true);
		          
		          moa_success("Image uploaded.");
		        }
	        }
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
           <td class="form_label_text"><?php echo html_display_safe($image_info["Filename"]);?></td>
        </tr>      
        <tr>
           <td class="form_label_text">Description:</td>
           <td class="form_label_text"><?php echo html_display_safe($image_info["Description"]);?></td>
        </tr>            
        <tr>
          <td class="form_label_text">File:</td>
          <td>
            <input type="hidden" name="FORM_SUBMITTED" value="true">
            <input type="file" id="file_dlg" onchange="javascript:file_change();"size="30" name="filename"  class="form_label_text"accept="image/jpg"></input><br/>
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