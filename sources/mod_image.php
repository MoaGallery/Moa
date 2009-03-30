<?php
$image_first = false;
if (!isset($gallery_first))
{
  $image_first = true;
}
  include_once("_error_funcs.php");
  include_once("_db_funcs.php");
  include_once("mod_image_funcs.php");
  include_once("id.php");
  include_once("common.php");

  function ImageCheckExists()
  {
    // Get the ID
    $image_id = GetParam("image_id");
    if (false == $image_id)
    {
      RaiseFatalError("No image id supplied.");
      return false;
    }

    // Check that it is a real image
    if (false == _imageExists($image_id))
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
    if (false == $newvalue)
    {
      RaiseFatalError("No ".$p_varname." supplied.");
      return false;
    }

    // Try to change the value
    if (false == _ImageChangeValue($p_id, $p_field, $newvalue))
    {
      RaiseFatalError("Could not set new ".$p_varname, false);
      return false;
    }

    return true;
  }

  function ImageGetValue($p_id, $p_field, $p_short = false)
  {
    $value = _ImageGetValue($p_id, $p_field);

    if (false == $value)
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
    if (false == _ImageDelete($p_id))
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
    if (false == $newdesc)
    {
      $newdesc = "";
    }

    // Get the tags
    $newtags = GetParam("tags");
    if (false == $newtags)
    {
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to change the value
    if (false == _ImageEdit($p_id, $newdesc, $newtags))
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

    if (false == isset($_FILES['filename']))
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
    if (false == $newdesc)
    {
      $newdesc = "";
    }

    // Get the tags
    $newtags = GetParam("imageformtags");
    if (false == $newtags)
    {
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to change the value
    $result = _ImageAdd($newdesc, $newtags);
    if (false == $result)
    {
      RaiseFatalError("Could not add image.", false);
      return false;
    }

    echo "OK\n".$result;

    return true;
  }

  function ImageAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false == $action)
    {
      RaiseFatalError("No action supplied.");
    }

    DBConnect();

    switch ($action)
    {
      case "changedesc" :
      {
      	$image_id = ImageCheckExists();
        if (false != $image_id)
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
        ImageAdd();
        break;
      }
      case "edit" :
      {
      	$image_id = ImageCheckExists();
        if (false != $image_id)
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
      	$image_id = ImageCheckExists();
        if (false != $image_id)
        {
          ImageGetValue($image_id,"Description");
        }
        break;
      }
      case "delete" :
      {
      	$image_id = ImageCheckExists();
        if (false != $image_id)
        {
      	  ImageDelete($image_id);
        }
      	break;
      }
      default :
      {
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  if ((false == isset($pre_cache)) && ($image_first))
  {
    ImageAjaxMain();
  }
?>
