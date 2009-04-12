<?php
  include_once("../config.php");

  $no_moa_path = false;

  // If MOA_PATH is not set in config.php then set it here
  // to the likely value to all processing to continue.
  //
  // Needed for when 1.2 are first copied over a existing install.
  if (!isset($MOA_PATH))
  {
    $file_path = str_replace( "\\", "/", dirname(realpath(__FILE__)));
    $$MOA_PATH = str_replace( getenv("DOCUMENT_ROOT"), "", $file_path) . "/";

    $no_moa_path = true;
  }

  include_once($MOA_PATH."_db_funcs.php");
	include_once($MOA_PATH."common.php");
	include_once($MOA_PATH."id.php");

	include_once($MOA_PATH."mod_upgrade_funcs.php");

	// Adds a new config variable to config.php or (from 1.2 onwards) the database
	function UpgradeAddConfigVar()
  {
    global $ErrorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the name
    $newname = GetParam('name');
    if (false == $newname)
    {
      RaiseFatalError("No config var name supplied.");
      return false;
    }

    // Get the value
    $newvalue = GetParam('value');
    if (false == $newvalue)
    {
      RaiseFatalError("No config var value supplied.");
      return false;
    }

    // Get the destination
    $dest = GetParam('dest');
    if (false == $dest)
    {
      RaiseFatalError("No destination supplied.");
      return false;
    }

    if (0 == strcmp($dest, "file"))
    {
      if (!_AddFileConfigVar($newname, $newvalue))
      {
      	RaiseFatalError("Could not add new var.");
      	return false;
      }
    } else
    {
      RaiseFatalError("Can only save config vars to a file in this release.");
      return false;
    }

    OutputPrefix("OK");
    return true;
  }

  // Delete an outdated file
  function UpgradeDelFile()
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the filename
    $filename = GetParam('filename');
    if (false == $filename)
    {
      RaiseFatalError("No filename supplied.");
      return false;
    }

    // Check they aren't trying to leave the Moa installation
    if (mb_strpos($filename, ".."))
    {
    	RaiseFatalError("Only Moa files can be deleted.");
      return false;
    }

    if (!_UpgradeDelFile($filename))
    {
    	return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function UpgradeAjaxMain()
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
      case "add_var" :
      {
        UpgradeAddConfigVar();
        break;
      }
      case "delete_file" :
      {
        UpgradeDelFile();
        break;
      }
      default :
      {
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  // Only do this if we are running stand-alone (not included from index.php)
  if (false == isset($pre_cache))
  {
    UpgradeAjaxMain();
  }
?>