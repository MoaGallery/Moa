<?php
  $proceed = true;

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
    $proceed = false;
    moa_warning("You must be logged in to use this page.");
  }

  include ("sources/_admin_page_links.php");

  // check if an image ID is supplied
  if (isset($_REQUEST["image_id"])) {
    $image_id = mysql_real_escape_string($_REQUEST["image_id"]);
  }
  else
  {
    $proceed = false;
    moa_warning("No image ID supplied.");
  }

  if ($proceed)
  {
	  include_once ("sources/_admin_page_links.php");

	  echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'>";
	  echo "<tr>";
	  echo "<td class='box_header'>Upload missing image file</td>";
	  echo "</tr><tr>";
	  echo "<td class='pale_area_nb'>\n";

	  // Get the image info
	  $query = "SELECT * FROM ".$tab_prefix."image WHERE IDImage = '".$image_id."'";
	  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

	  $image_info = mysql_fetch_array( $result);

	  if (file_exists($IMAGE_PATH."/".$image_id.".jpg") == true)
	  {
	    moa_warning("That image is not missing its file\n");
	  } else
	  {
	    $show_form = true;
	    if (isset($_REQUEST["FORM_SUBMITTED"])) {
	      // Check if an image has been supplied
	      if ($_FILES['filename']['error'] != UPLOAD_ERR_OK)
	      {
	        echo $_FILES['filename']['error'];
	         // Image failed to upload find out why and explain
	         if ($_FILES['filename']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['filename']['error'] == UPLOAD_ERR_FORM_SIZE)
	         {
	            moa_error("Failed to upload file to web server...  File to big.", false);
	         }
	         elseif ($_FILES['filename']['error'] == UPLOAD_ERR_PARTIAL)
	         {
	            moa_error("Failed to upload file to web server...  Partial Load.", false);
	         }
	         elseif ($_FILES['filename']['error'] == UPLOAD_ERR_NO_FILE)
	         {
	            moa_error("Failed to upload file to web server...  No file supplied.", false);
	         }
	         $show_form = true;
	      } else
	      {
	        $show_form = false;
	        $src_img = @imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);

	        if (false == $src_img)
	        {
	          moa_error("Failed to read image... File not a valid JPG<br/>", false);
	          $show_form = true;
	        } else
	        {
	          $new_filename = sprintf("%010s.jpg",$image_id);

	          move_uploaded_file( $_FILES["filename"]["tmp_name"] // source file
	                            , $IMAGE_PATH."/".$new_filename); // dest file

	          $src_img = @imagecreatefromjpeg($IMAGE_PATH."/".$new_filename);
	          $width = imagesx($src_img);
	          $height = imagesy($src_img);
	          imagedestroy($src_img);

	          _ImageChangeValue($image_id, "Width", $width);
	          _ImageChangeValue($image_id, "Height", $height);

	          thumbnail( $new_filename, "jpeg", true);

	          moa_success("Image uploaded.");
	        }
	      }
	    }
	    else
	    {
	      if ($image_info == false)
	      {
	        moa_warning("Invalid image id supplied.");
	        $show_form = false;
	        //include_once ("sources/_footer.php");
	        //echo "</body>\n</html>\n";
	        //die();
	      }
	    }

	    if ($show_form)
	    {
  	    ?>
  	    <form id="image_add" method="post" action="index.php?action=admin_maintain_image&image_id=<?php echo $image_id ?>"  enctype="multipart/form-data">
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
  	            <input type="hidden" name="FORM_SUBMITTED" value="true" />
  	            <input type="file" id="file_dlg" size="30" name="filename"  class="form_label_text"accept="image/jpg"></input><br/>
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
	}

	$page_title = "Image integrity admin";
?>
