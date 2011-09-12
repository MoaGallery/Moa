 <?php
 // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once("_settings.php");
  LoadSettings();

  $image_first = false;
  if (!isset($gallery_first))
  {
    $image_first = true;
  }

  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_image.php");

  function ImageCheckExists()
  {
    $returnInfo = DefaultAjaxResult( 'ImageExists');
    
    // Get the ID
    $image_id = GetParam("image_id");
    if (false === $image_id)
    {
      $returnInfo['Result'] = 'No image id supplied.';
      echo json_encode($returnInfo);
      return false;
    }

    // Check that it is a real image
    if (false === Image::Exists($image_id))
    {
      $returnInfo['Result'] = 'Image does not exist.';
      echo json_encode($returnInfo);
      return false;
    }

    return $image_id;
  }

  function ImageDelete($p_id)
  {
    $returnInfo = DefaultAjaxResult( 'ImageDelete');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Try to delete the image
    if (false === Image::Delete($p_id))
    {
      $returnInfo['Result'] = 'Could not delete image.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }
 
  function ImageEdit($p_id)
  {
    $returnInfo = DefaultAjaxResult( 'ImageEdit');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }

    // Get the tags
    $newtags = GetParam("tags");
    if (false !== $newtags) {
      $newtags = trim($newtags);
    }
    else
    {
      $returnInfo['Result'] = 'No tags supplied.';
      return $returnInfo;
    }

    // Try to change the value
    $Image = new Image($p_id);
    $Image->description = $newdesc;
    $Image->tags = $newtags;
    
    if (false === $Image->CommitEdit())
    {
      $returnInfo['Result'] = 'Could not change image.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function ImageAdd()
  {
    global $errorString;
    
    $returnInfo = DefaultAjaxResult( 'ImageAdd');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    if (false === isset($_FILES['filename']))
    {
      $returnInfo['Result'] = 'Failed to upload file to web server...  File too big.';
      return $returnInfo;
    }

    if ($_FILES['filename']['error'] != UPLOAD_ERR_OK)
    {
      // Image failed to upload find out why and explain
      switch ($_FILES['filename']['error'])
      {
      	case UPLOAD_ERR_PARTIAL: {
      	  $returnInfo['Result'] = 'Failed to upload file to web server...  Partial load.';
      	  break;
      	}
        case UPLOAD_ERR_NO_FILE: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  No file supplied.';
          break;
        }
        case UPLOAD_ERR_INI_SIZE: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  File too big.';
          break;
        }
        case UPLOAD_ERR_CANT_WRITE: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  Unable to write to disk.';
          break;
        }
        case UPLOAD_ERR_FORM_SIZE: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  File too big.';
          break;
        }
        case UPLOAD_ERR_NO_TMP_DIR: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  No temp directory.';
          break;
        }
        case UPLOAD_ERR_EXTENSION: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  Stopped by PHP extension.';
          break;
        }
        default: {
          $returnInfo['Result'] = 'Failed to upload file to web server...  Unknown reason.';
          break;
        }
      }

      return $returnInfo;
    }

    // Get the description
    $newdesc = GetParam("imageformdesc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }
    
    // Get the gallery ID
    $gallery_id = GetParam("imagegalleryid");
    if (false === $gallery_id)
    {
      $gallery_id = "0000000000";
    }

    // Get the tags
    $newtags = GetParam("imageformtags");

    if (false !== $newtags) {
      $newtags = trim($newtags);
    }
    else
    {
      $returnInfo['Result'] = 'No tags supplied.';
      return $returnInfo;
    }
    
    // Try to add it
    $files = Image::ProcessFileFromForm($newdesc, $newtags, $gallery_id);
    if (false === $files)
    {
      $returnInfo['Result'] = 'Could not add file ('.$errorString.').';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    $returnInfo['FileList'] = $files;

    return $returnInfo;
  }

  function ImageAddStep()
  {
    $returnInfo = DefaultAjaxResult( 'ImageAddStep');
    
    // Get the description
    $newdesc = GetParam("imageformdesc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }

    // Get the filename
    $filename = GetParam("filename");

    if (false === $filename) {
      $returnInfo['Result'] = 'Filename must be given.';
      return $returnInfo;
    }

    // Get the gallery ID
    $gallery_id = GetParam("imagegalleryid");
    if (false === $gallery_id)
    {
      $gallery_id = "0000000000";
    }
    
    // Get the tags
    $newtags = GetParam("imageformtags");

    if (false !== $newtags) {
      $newtags = trim($newtags);
    }
    else
    {
      $returnInfo['Result'] = 'No tags supplied.';
      return $returnInfo;
    }

    // Try to add it
    $result = Image::ProcessNextImageFromTemp($newdesc, $newtags, $filename, $gallery_id);
    if (false === $result)
    {
      $returnInfo['Result'] = 'Could not add file.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;

    return true;
  }

  function ImageInfoTags($p_id)
  {
    global $CFG;
    global $image_id;
    global $template_name;

    // Set global vars if needed
    if (!isset($preCache))
    {
      $image_id = $p_id;

	    // Find out which template we should be using. Fall back to MoaDefault if none set
		  $template_name = "MoaDefault";
		  if (isset($CFG["TEMPLATE"]))
		  {
		    if (is_dir("../templates/".$CFG["TEMPLATE"]))
		    {
		      $template_name = $CFG["TEMPLATE"];
		    }
		  }
    }
    
    $returnInfo = DefaultAjaxResult( 'GetTags');
    
    $returnInfo['Tags'] = TagParseImageTagList(null);
    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }
  
  function ImageInfoGalleries($p_id)
  {
    global $CFG;
    global $image_id;
    global $template_name;

    // Set global vars if needed
    if (!isset($preCache))
    {
      $image_id = $p_id;

	    // Find out which template we should be using. Fall back to MoaDefault if none set
		  $template_name = "MoaDefault";
		  if (isset($CFG["TEMPLATE"]))
		  {
		    if (is_dir("../templates/".$CFG["TEMPLATE"]))
		    {
		      $template_name = $CFG["TEMPLATE"];
		    }
		  }
    }
    
    $returnInfo = DefaultAjaxResult( 'GetGalleries');
    
    $returnInfo['Galleries'] = TagParseImageGalleryList(null);
    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }
  
  function ImageAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      var_dump($_REQUEST);
      $returnInfo = DefaultAjaxResult( 'ActionCheck');
	    $returnInfo['Result'] = 'No action supplied.';
	    echo json_encode($returnInfo);
    }

    switch ($action)
    {
      case "add" :
      {
        echo json_encode(ImageAdd());
        break;
      }
      case "addstep" :
      {
        echo json_encode(ImageAddStep());
        break;
      }
      case "edit" :
      {
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          echo json_encode(ImageEdit($image_id));
        }
        break;
      }
      case "delete" :
      {
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
      	  echo json_encode(ImageDelete($image_id));
        }
      	break;
      }
      case "getinfotags" :
      {
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          echo json_encode(ImageInfoTags($image_id));
        }
        break;
      }
      case "getinfogalleries" :
      {
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          echo json_encode(ImageInfoGalleries($image_id));
        }
        break;
      }
      default :
      {
        $returnInfo = DefaultAjaxResult( 'Unknown');
        $returnInfo['Result'] = 'Unknown action.';
        echo  json_encode($returnInfo);
        break;
      }
    }
  }

  
  if ((false === isset($preCache)) && ($image_first))
  {
    ImageAjaxMain();
  }
?>
