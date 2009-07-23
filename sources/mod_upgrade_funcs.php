<?php
  include_once($MOA_PATH."sources/_db_funcs.php");

  // Detects if the files and config/db match or not.
  // Returns true if a new version of the files seem to have been uploaded.
  function _MoaDetectOldVersion()
  {
    global $DEBUG_MODE;
    if ($DEBUG_MODE)
    {
      return false;
    }

    $new_ver = _UpgradeGetNewVersionID();
    $cur_ver = _UpgradeGetCurrentVersionID();

    if ($cur_ver < $new_ver)
    {
      return true;
    }
    return false;
  }

  // Returns the id of the current Moa config files
  // (id is 5 digit based on version number - 1.1.0 = 10100)
  function _UpgradeGetCurrentVersionID()
  {
    global $STR_DELIMITER;
    global $TEMPLATE;
    global $no_moa_path;

    // Detect 1.0.0
    if (!isset($STR_DELIMITER))
    {
      return 10000;
    }

    // Detect 1.1.0
    if($no_moa_path)
    {
      return 10100;
    }

    // Detect 1.1.99
    if(!isset($TEMPLATE))
    {
    	return 10199;
    }

    return _UpgradeGetNewVersionID();
  }

  // Returns the id of the current Moa source files
  function _UpgradeGetNewVersionID()
  {
  	global $MOA_MAJOR_VERSION;
  	global $MOA_MINOR_VERSION;
  	global $MOA_REVISION;

  	return (($MOA_MAJOR_VERSION*10000)+($MOA_MINOR_VERSION*100)+$MOA_REVISION);
  }

  // Adds a new config variable to config.php
  function _AddFileConfigVar($p_name, $p_value)
  {
    global $ErrorString;

    include ("../config.php");

    $fp = @fopen("../config.php", "r+");

    if (!$fp)
    {
      $ErrorString = "Could not open config.php for writing.";
      return false;
    }

    while(!feof($fp))
    {
      $line = fgets($fp);
      if (!is_bool(mb_strpos($line, $p_name)))
      {
        $ErrorString = "Config var '".$p_name."' already exists in config.php.";
        return false;
      }
      if (!is_bool(mb_strpos($line, "?>")))
      {
        fseek($fp, -(strlen($line)), SEEK_CUR);
        $result = fwrite($fp, "  ".$p_name." = ".$p_value.";\n?>");
        if (!$result)
        {
          $ErrorString = "Could not write to config.php.";
          return false;
        }
      }
    }
    fclose($fp);
    return true;
  }

  function _UpgradeDelFile($p_filename)
  {
    global $MOA_PATH;

    // Return true if the file doesn't exist anyway
    if (!file_exists($MOA_PATH.$p_filename))
    {
      return true;
    }

    // Delete it
    return unlink($MOA_PATH.$p_filename);
  }

  function _ModifyDB($p_filename)
  {
    global $MOA_PATH;
    global $ErrorString;

    $result = RunSQLFile($MOA_PATH."SQL/upgrade/".$p_filename);
    if (!$result)
    {
      $ErrorString = "Error running SQL.";
      return false;
    }

    return $result;
  }
?>