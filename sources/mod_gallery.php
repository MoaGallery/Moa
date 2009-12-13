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

  $gallery_first = false;
  if (!isset($image_first))
  {
    $gallery_first = true;
  }

  include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/_template_parser.php");

  function GalleryCheckExists()
  {
    // Get the ID
    $gallery_id = GetParam("gallery_id");
    if (false === $gallery_id)
    {
      RaiseFatalError("No gallery id supplied.");
      return false;
    }

    // Check that it is a real gallery
    if (false === _galleryExists($gallery_id))
    {
      RaiseFatalError($gallery_id." Gallery does not exist.");
      return false;
    }

    return $gallery_id;
  }

  function GalleryChangeValue($p_id, $p_field, $p_varname)
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
    if (false === _galleryChangeValue($p_id, $p_field, $newvalue))
    {
      RaiseFatalError("Could not set new ".$p_varname, false);
      return false;
    }

    return true;
  }

  function GalleryGetValue($p_id, $p_field, $p_short = false)
  {
  	if ('0000000000' == $p_id)
  	{
  		return;
  	}
  	$value = _galleryGetValue($p_id, $p_field);

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

  function GalleryDelete($p_id)
  {
    global $ErrorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Try to delete the gallery
    if (false === _galleryDelete($p_id))
    {
      RaiseFatalError("Could not delete gallery.".$ErrorString, false);
      return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function GalleryImageThumbs($p_id)
  {
  	global $CFG;
    global $gallery_id;
    global $template_name;
    global $ErrorString;

    // Set global vars if needed
    if (!isset($pre_cache))
    {
      $gallery_id = $p_id;

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

    echo LoadTemplateRoot("page_gallery_view.php");

    return true;
  }

  function GalleryEdit($p_id)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      RaiseFatalError("No name supplied.");
      return false;
    }

    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }

    // Get the ParentID
    $newpid = GetParam("parent_id");
    if (false === $newpid)
    {
      RaiseFatalError("No parent ID supplied.");
      return false;
    }

    // Get the tags
    $newtags = GetParam("tags");
    if (false === $newtags)
    {
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to change the value
    if (false === _galleryEdit($p_id, $newname, $newdesc, $newpid, $newtags))
    {
      RaiseFatalError("Could not change gallery.", false);
      return false;
    }

    return true;
  }

  function GalleryAdd()
  {
    global $Userinfo;
    global $CFG;
    //print_r($CFG);
    //print_r($Userinfo);
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      RaiseFatalError("No name supplied.");
      return false;
    }

    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }

    // Get the ParentID
    $newpid = GetParam("parent_id");
    if (false === $newpid)
    {
      RaiseFatalError("No parent ID supplied.");
      return false;
    }

    // Get the tags
    $newtags = GetParam("tags");
    if (false === $newtags)
    {
      RaiseFatalError("No tags supplied.");
      return false;
    }

    // Try to change the value
    if (false === _galleryAdd($newname, $newdesc, $newpid, $newtags))
    {
      RaiseFatalError("Could not add gallery.", false);
      return false;
    }

    return true;
  }

  function GalleryAjaxMain()
  {
	  // Get the action
	  $action = GetParam("action");
	  if (false === $action)
	  {
	    RaiseFatalError("No action supplied.");
	  }

	  switch ($action)
	  {
	    case "changename" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
	    	{
		      if (GalleryChangeValue($gallery_id, "Name", "name"))
		      {
		      	echo "OK";
		      }
	    	}
			  break;
			}
	    case "changedesc" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
		      if (GalleryChangeValue($gallery_id, "Description", "desc"))
		      {
		      	echo "OK";
		      }
        }
	      break;
	    }
	    case "edit" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
		      if (GalleryEdit($gallery_id))
		      {
		      	echo "OK";
		      }
        }
	      break;
	    }
	    case "add" :
      {
        if (GalleryAdd())
        {
          echo "OK";
        }
        break;
      }
	    case "changeparent" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
		      GalleryChangeValue($gallery_id, "IDParent", "parent_id");
        }
	      break;
	    }
	    case "getname" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
	        GalleryGetValue($gallery_id,"Name");
        }
	      break;
	    }
	    case "getdesc" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
	        GalleryGetValue($gallery_id,"Description");
        }
	      break;
	    }
	    case "getparent" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
	        GalleryGetValue($gallery_id,"IDParent");
        }
	      break;
	    }
	    case "delete" :
	    {
	    	$gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
        {
	        GalleryDelete($gallery_id);
        }
        break;
	    }
	    case "image_thumbs" :
      {
        $gallery_id = GalleryCheckExists();
        if (false !== $gallery_id)
        {
          GalleryImageThumbs($gallery_id);
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

  if ((false === isset($pre_cache)) && ($gallery_first))
  {
    GalleryAjaxMain();
  }
?>