<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  $proceed = true;

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
    global $g_message_type;
  	global $g_message_text;

  	$proceed = false;

  	$g_message_text = "Not logged in";
  	$g_message_type = "Warning";
  	$bodycontent .= LoadTemplateRoot("page_message.php");
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
	  $bodycontent .= LoadTemplateRoot("page_message.php");
	}
  }

  if ($proceed)
  {
	  // Get the image info
	  $query = "SELECT * FROM ".$CFG["tab_prefix"]."image WHERE IDImage = '".$image_id."'";
	  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

	  $image_info = mysql_fetch_array( $result);

	  if (file_exists($CFG["IMAGE_PATH"].$image_id.".".$image_info["Format"]) == true)
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
          $src_type = "jpg";
	        $src_img = @imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);
          if (false === $src_img)
          {
            $src_type = "png";
            $src_img = @imagecreatefrompng($_FILES["filename"]["tmp_name"]);
          }
          if (false === $src_img)
          {
            $src_type = "gif";
            $src_img = @imagecreatefromgif($_FILES["filename"]["tmp_name"]);
          }

	        if (false === $src_img)
	        {
	          moa_error("Failed to read image... File not a supported Moa format or corrupt.<br/>", false);
	          $show_form = true;
	        } else
	        {
            $new_fileid = sprintf("%010s",$image_id);
	          $new_filename = $new_fileid.".".$src_type;

	          move_uploaded_file( $_FILES["filename"]["tmp_name"] // source file
	                            , $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$new_filename); // dest file

            switch ($src_type)
            {
              case "jpg":
              {
                $src_img = @imagecreatefromjpeg($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$new_filename);
                break;
              }
              case "png":
              {
                $src_img = @imagecreatefrompng($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$new_filename);
                break;
              }
              case "gif":
              {
                $src_img = @imagecreatefromgif($CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$new_filename);
                break;
              }
            }

	          $width = imagesx($src_img);
	          $height = imagesy($src_img);
	          imagedestroy($src_img);

	          _ImageChangeValue($image_id, "Width", $width);
	          _ImageChangeValue($image_id, "Height", $height);
            _ImageChangeValue($image_id, "Format", $src_type);

	          thumbnail( $new_fileid, $src_type, true);

            global $g_message_type;
    			  global $g_message_text;

    			  $proceed = false;

    			  $g_message_text = "Image uploaded";
    			  $g_message_type = "Success";
    			  $bodycontent .= LoadTemplateRoot("page_message.php");
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
	    	$bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  	    $bodycontent .= LoadTemplateRoot("page_admin_maintain_image.php");

  	    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

	    }
	  }
	}

	$bodytitle = "Fix image - Moa";
?>
