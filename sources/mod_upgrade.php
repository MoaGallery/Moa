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

    $returnInfo = DefaultAjaxResult( 'UpgradeAddConfigVar');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
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
      $returnInfo['Result'] = 'No config var name supplied.';
      return $returnInfo;
    }

    // Get the value
    $newvalue = GetParam("value");
    if (false === $newvalue)
    {
      $returnInfo['Result'] = 'No config var value supplied.';
      return $returnInfo;
    }

    if (10201 > _UpgradeGetCurrentVersionID())
    {
      if (!is_numeric($newvalue))
      {
        $newvalue = "'".$newvalue."'";
      }
      if (!_AddFileConfigVar('$'.$newname, $newvalue, $testflag))
      {
        $returnInfo['Result'] = 'Could not add new var.';
        return $returnInfo;
      }
    } else
    {
      if (!_AddDBConfigVar($newname, $newvalue, $testflag))
      {
        $returnInfo['Result'] = 'Could not add new var.';
        return $returnInfo;
      }
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  // Delete an outdated file
  function UpgradeDelFile()
  {
    $returnInfo = DefaultAjaxResult( 'UpgradeDelFile');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
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
      $returnInfo['Result'] = 'No filename supplied.';
      return $returnInfo;
    }

    // Check they aren't trying to leave the Moa installation
    if (mb_strpos($filename, ".."))
    {
      $returnInfo['Result'] = 'Only Moa files can be deleted.';
      return $returnInfo;
    }

    if (!_UpgradeDelFile($filename, $testflag))
    {
      $returnInfo['Result'] = 'Could not delete file.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  function ModifyDB()
  {
    $returnInfo = DefaultAjaxResult( 'UpgradeModifyDB');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
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
      $returnInfo['Result'] = 'No filename supplied.';
      return $returnInfo;
    }

    // Check they aren't trying to run external files.
    // Dissallowing a slash should ensure this
    if ((mb_strpos($filename, "\\")) || (mb_strpos($filename, "/")))
    {
      $returnInfo['Result'] = 'Only files inside the Moa SQL/upgrade/ directory can be run as part of the upgrade.';
      return $returnInfo;
    }

    $result = _ModifyDB($filename, $testflag);
    if (false === $result)
    {
      $returnInfo['Result'] = 'Error running SQL.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  function RunFunc()
  {
    global $errorString;

    $returnInfo = DefaultAjaxResult( 'UpgradeRunFunc');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
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
      $returnInfo['Result'] = 'No function name supplied.';
      return $returnInfo;
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
      case "upgrade_10201_UpgradeConfigFile" :
      {
        $result = _upgrade_10201_UpgradeConfigFile($testflag);
        break;
      }
      case "upgrade_10204_AddGalleryIndices" :
      {
        $result = _upgrade_10204_AddGalleryIndices($testflag);
        break;
      }
      case "upgrade_complete" :
      {
        $result = _upgrade_complete($testflag);
        break;
      }
      default :
      {
        $returnInfo['Result'] = 'Unknown function.';
        return $returnInfo;
      }
    }

    if (false === $result)
    {
      $returnInfo['Result'] = $errorString;
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  function UpgradeAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      $returnInfo = DefaultAjaxResult( 'ActionCheck');
      $returnInfo['Result'] = 'No action supplied.';
      echo json_encode($returnInfo);
      return;
    }

    DBConnect();

    switch ($action)
    {
      case "add_var" :
      {
        echo json_encode(UpgradeAddConfigVar());
        break;
      }
      case "delete_file" :
      {
        echo json_encode(UpgradeDelFile());
        break;
      }
      case "modify_db" :
      {
        echo json_encode(ModifyDB());
        break;
      }
      case "run_func" :
      {
        echo json_encode(RunFunc());
        break;
      }
      default :
      {
        $returnInfo = DefaultAjaxResult( 'ActionCheck');
        $returnInfo['Result'] = 'Unknown action.';
        echo json_encode($returnInfo);
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