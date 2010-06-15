<?php
  header('Cache-Control: no-cache');

  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once("_settings.php");
  LoadSettings();

	include_once($CFG["MOA_PATH"]."sources/common.php");
	include_once($CFG["MOA_PATH"]."sources/id.php");

	include_once($CFG["MOA_PATH"]."sources/mod_upgrade_funcs.php");

	// Adds a new config variable to config.php or (from 1.2.1 onwards) the database
	function UpgradeAddConfigVar()
  {
    global $errorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the test status
    $testflag = true;
    $test = GetParam("test");
    if (false !== $test)
    {
      if (0 == strcmp("false", $test))
      {
        $testflag = false;
      }
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      RaiseFatalError("No config var name supplied.");
      return false;
    }

    // Get the value
    $newvalue = GetParam("value");
    if (false === $newvalue)
    {
      RaiseFatalError("No config var value supplied.");
      return false;
    }

    if (!_AddFileConfigVar($newname, $newvalue, $testflag))
    {
    	RaiseFatalError("Could not add new var.");
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

    // Get the test status
    $testflag = true;
    $test = GetParam("test");
    if (false !== $test)
    {
      if (0 == strcmp("false", $test))
      {
        $testflag = false;
      }
    }

    // Get the filename
    $filename = GetParam('filename');
    if (false === $filename)
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

    if (!_UpgradeDelFile($filename, $testflag))
    {
      RaiseFatalError("");
    	return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function ModifyDB()
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the test status
    $testflag = true;
    $test = GetParam("test");
    if (false !== $test)
    {
      if (0 == strcmp("false", $test))
      {
        $testflag = false;
      }
    }

    // Get the filename
    $filename = GetParam('filename');
    if (false === $filename)
    {
      RaiseFatalError("No filename supplied.");
      return false;
    }

    // Check they aren't trying to run external files.
    // Dissallowing a slash should ensure this
    if ((mb_strpos($filename, "\\")) || (mb_strpos($filename, "/")))
    {
      RaiseFatalError("Only files inside the Moa SQL/upgrade/ directory can be run as part of the upgrade.");
      return false;
    }

    $result = _ModifyDB($filename, $testflag);
    if (false === $result)
    {
      RaiseFatalError("Error running SQL.");
      return false;
    }

    OutputPrefix("OK");
    echo $result;
    return true;
  }

  function RunFunc()
  {
    global $errorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the test status
    $testflag = true;
    $test = GetParam("test");
    if (false !== $test)
    {
      if (0 == strcmp("false", $test))
      {
        $testflag = false;
      }
    }

    // Get the function to run
    $funcname = GetParam("func");
    if (false === $funcname)
    {
      RaiseFatalError("No function name supplied.");
      return false;
    }

    $result = "";
    switch ($funcname)
    {
      case "upgrade_10201_MoveConfigtoDB" :
      {
        $result = _upgrade_10201_MoveConfigtoDB($testflag);
        break;
      }
      case "upgrade_10201_AddImageFormats" :
      {
        $result = _upgrade_10201_AddImageFormats($testflag);
        break;
      }
      case "upgrade_complete" :
      {
        $result = _upgrade_complete($testflag);
        break;
      }
      default :
      {
        RaiseFatalError("Unknown function.");
        break;
      }
    }

    if (false === $result)
    {
      RaiseFatalError($errorString);
      return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function UpgradeAjaxMain()
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
      case "modify_db" :
      {
        ModifyDB();
        break;
      }
      case "run_func" :
      {
        RunFunc();
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
  if (false === isset($preCache))
  {
    UpgradeAjaxMain();
  }
?>