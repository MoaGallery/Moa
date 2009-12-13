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

  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  function TagCheckExists()
  {
    // Get the action
    $tag_id = GetParam("tag_id");
    if (false === $tag_id)
    {
      RaiseFatalError("No tag id supplied.");
      return false;
    }

    // Check that it is a real tag
    if (false === _TagExists($tag_id))
    {
      RaiseFatalError($tag_id." Tag does not exist.");
    }

    return $tag_id;
  }

  function TagChangeValue($p_id, $p_field, $p_varname)
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

    if ('Name' == $p_field)
    {
      // Check if tag name already exists
      $luid = _TagLookUp($newvalue);
      if (false !== $luid)
      {
        RaiseFatalError("This tag already exists.");
        return false;
      }
    }

    // Try to change the value
    if (false === _TagChangeValue($p_id, $p_field, $newvalue))
    {
      RaiseFatalError("Could not set new ".$p_varname.".", false);
      return false;
    }

    OutputPrefix("OK");
    echo $p_id;

    return true;
  }

  function TagGetValue($p_id, $p_field, $p_short = false)
  {
    $value = _TagGetValue($p_id, $p_field);

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

  function TagDelete($p_id)
  {
    global $ErrorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Try to delete the tag
    if (false === _TagDelete($p_id))
    {
      RaiseFatalError("Could not delete tag.".$ErrorString, false);
      return false;
    }

    OutputPrefix("OK");
    echo $p_id;
    return true;
  }

  function TagAdd()
  {
    global $ErrorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
    	return false;
    }

    // Get the value
    $newname = GetParam('name');
    if (false === $newname)
    {
      RaiseFatalError("No name supplied.");
      return false;
    }

    // Check if tag already exists
    $id = _TagLookUp($newname);
    if (false !== $id)
    {
      RaiseFatalError("This tag already exists.");
      return false;
    }

    // Try to add the tag
    $id = _TagAdd($newname);
    if (false === $id)
    {
      RaiseFatalError("Cound not add tag.");
      return false;
    }

    OutputPrefix("OK");
    echo $id;
    return true;
  }

  function TagAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      RaiseFatalError("No action supplied.");
    }

    DBConnect();

    switch ($action)
    {
    	case "add" :
    	{
    		TagAdd();
    		break;
    	}
      case "delete" :
      {
      	$tag_id =  TagCheckExists();
      	TagDelete($tag_id);
        break;
      }
      case "edit" :
      {
        $tag_id =  TagCheckExists();
        TagChangeValue($tag_id, "Name", "name");
        break;
      }
      case "getdesc" :
      {
        $tag_id =  TagCheckExists();
      	TagGetValue($tag_id, "Description");
        break;
      }
      default :
      {
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  // Only call this if this file is stand-alone. not if it is included from index.php
  if (false === isset($pre_cache))
  {
    TagAjaxMain();
  }
?>