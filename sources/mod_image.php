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
    // Get the ID
    $image_id = GetParam("image_id");
    if (false === $image_id)
    {
      RaiseFatalError("No image id supplied.");
      return false;
    }

    // Check that it is a real image
    if (false === ImageExists($image_id))
    {
      RaiseFatalError($image_id." Image does not exist.");
      return false;
    }

    return $image_id;
  }

  function ImageChangeValue($p_id, $p_field, $p_varname)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the value
    $newvalue = GetParam($p_varname);
    if (false === $newvalue)
    {
      RaiseFatalError("No ".$p_varname." supplied.");
      return false;
    }

    // Try to change the value
    if (false === ImageSetValue($p_id, $p_field, $newvalue))
    {
      RaiseFatalError("Could not set new ".$p_varname, false);
      return false;
    }

    return true;
  }

  function ImageGetValue($p_id, $p_field, $p_short = false)
  {
    $value = GetImageValueFromDatabase($p_id, $p_field);

    if (false === $value)
    {
      RaiseFatalError("Could not get value for field '".$p_field."'", false);
      return false;
    }

    OutputPrefix("OK");
    if (($p_short) && (20 < mb_strlen($value)))
    {
      echo mb_substr($value, 0, 17)."...";
    } else
    {
      echo $value;
    }
    return true;
  }

  function ImageDelete($p_id)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Try to delete the image
    $Image = new Image();
    $Image->loadId($p_id);
    if (false === $Image->delete())
    {
      RaiseFatalError("Could not delete image.", false);
      return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function ImageEdit($p_id)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
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
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to change the value
    $Image = new Image();
    $Image->loadId($p_id);
    if (false === $Image->edit($newdesc, $newtags))
    {
      RaiseFatalError("Could not change image.", false);
      return false;
    }

    return true;
  }

  function ImageAdd()
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    if (false === isset($_FILES['filename']))
    {
    	RaiseFatalError("Failed to upload file to web server...  File too big<br/>");
    	return false;
    }

    if ($_FILES['filename']['error'] != UPLOAD_ERR_OK)
    {
      // Image failed to upload find out why and explain
      switch ($_FILES['filename']['error'])
      {
      	case UPLOAD_ERR_PARTIAL: {
      		RaiseFatalError("Failed to upload file to web server...  Partial load<br/>");
      		break;
      	}
        case UPLOAD_ERR_NO_FILE: {
          RaiseFatalError("Failed to upload file to web server...  No file supplied<br/>");
          break;
        }
        case UPLOAD_ERR_INI_SIZE: {
          RaiseFatalError("Failed to upload file to web server...  File too big<br/>");
          break;
        }
        case UPLOAD_ERR_CANT_WRITE: {
          RaiseFatalError("Failed to upload file to web server...  Can't write to disk<br/>");
          break;
        }
        case UPLOAD_ERR_FORM_SIZE: {
          RaiseFatalError("Failed to upload file to web server...  File too big<br/>");
          break;
        }
        case UPLOAD_ERR_NO_TMP_DIR: {
          RaiseFatalError("Failed to upload file to web server...  No temp directory<br/>");
          break;
        }
        case UPLOAD_ERR_EXTENSION: {
          RaiseFatalError("Failed to upload file to web server...  Stopped by PHP extension<br/>");
          break;
        }
        default: {
        	 RaiseFatalError("Failed to upload file to web server...  Unknown reason<br/>");
        	 break;
        }
      }

      return false;
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
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to add it
    $result = AddImageFromForm($newdesc, $newtags, $gallery_id);
    if (false === $result)
    {
      RaiseFatalError("Could not add file.", false);
      return false;
    }

    echo "OK\n".$result;

    return true;
  }

  function ImageAddStep()
  {
    // Get the description
    $newdesc = GetParam("imageformdesc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }

    // Get the filename
    $filename = GetParam("filename");

    if (false === $filename) {
      RaiseFatalError("Filename must be given.");
      return false;
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
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to add it
    $result = AddImageFromBulkTemp($newdesc, $newtags, $filename, $gallery_id);
    if (false === $result)
    {
      RaiseFatalError("Could not add file.", false);
      return false;
    }

    echo "OK\nAdded - ".$result;

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
    
    OutputPrefix("OK");

    echo TagParseImageTagList(null);

    return true;
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
    
    OutputPrefix("OK");

    echo TagParseImageGalleryList(null);

    return true;
  }
  
  function ImageAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      RaiseFatalError("No action supplied.");
    }

    switch ($action)
    {
      case "changedesc" :
      {
      	header('Cache-Control: no-cache'); // Do not cache this response
      	
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          if (ImageChangeValue($image_id, "Description", "desc"))
          {
            echo "OK";
          }
        }
        break;
      }
      case "add" :
      {
        header('Cache-Control: no-cache'); // plain text file
        //header('Content-Type: text/html; Cache-Control: no-cache'); // plain text file
        
        /* Silly hack to keep IE happy with pre formatted text takening from an IFRAME */
        echo "<pre>"; 
        ImageAdd();
        echo "</pre>";
        break;
      }
      case "addstep" :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
        ImageAddStep();
        break;
      }
      case "edit" :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          if (ImageEdit($image_id))
          {
            echo "OK";
          }
        }
        break;
      }
      case "getdesc" :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          GetImageValueFromDatabase($image_id,"Description");
        }
        break;
      }
      case "delete" :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
      	  ImageDelete($image_id);
        }
      	break;
      }
      case "getinfotags" :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          ImageInfoTags($image_id);
        }
        break;
      }
      case "getinfogalleries" :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
      	$image_id = ImageCheckExists();
        if (false !== $image_id)
        {
          ImageInfoGalleries($image_id);
        }
        break;
      }
      default :
      {
        header('Cache-Control: no-cache'); // Do not cache this response
        
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  
  if ((false === isset($preCache)) && ($image_first))
  {
    ImageAjaxMain();
  }
  else {
    header('Cache-Control: no-cache'); // Do not cache this response
  }
?>
