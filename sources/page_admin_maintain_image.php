<?php
  $proceed = true;

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
    global $g_message_type;
  	global $g_message_text;
  	
  	$proceed = false;
  	
  	$g_message_text = "Not logged in";
  	$g_message_type = "Warning";
  	echo LoadTemplateRoot("page_message.php");
  }

  // check if an image ID is supplied
  if ($proceed)
  {
    if (isset($_REQUEST["image_id"])) {
      $image_id = mysql_real_escape_string($_REQUEST["image_id"]);
	}
	else
	{
	  global $g_message_type;
	  global $g_message_text;
	  	
	  $proceed = false;
	  	
	  $g_message_text = "No image ID supplied.";
	  $g_message_type = "Warning";
	  echo LoadTemplateRoot("page_message.php");
	}
  }

  if ($proceed)
  {
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
	                            , $MOA_PATH.$IMAGE_PATH."/".$new_filename); // dest file

	          $src_img = @imagecreatefromjpeg($MOA_PATH.$IMAGE_PATH."/".$new_filename);
	          $width = imagesx($src_img);
	          $height = imagesy($src_img);
	          imagedestroy($src_img);

	          _ImageChangeValue($image_id, "Width", $width);
	          _ImageChangeValue($image_id, "Height", $height);

	          thumbnail( $new_filename, "jpeg", true);

              global $g_message_type;
			  global $g_message_text;
			  	
			  $proceed = false;
			  	
			  $g_message_text = "Image uploaded";
			  $g_message_type = "Success";
			  echo LoadTemplateRoot("page_message.php");
	        }
	      }
	    }
	    else
	    {
	      if ($image_info == false)
	      {
	        moa_warning("Invalid image id supplied.");
	        $show_form = false;
	      }
	    }

	    if ($show_form)
	    {
	    	echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  	    echo LoadTemplateRoot("page_admin_maintain_image.php");
  	    echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
	    }
	  }
	}

	$page_title = "Image integrity admin";
?>
