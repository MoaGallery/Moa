<?php

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

  // Adds a new config variable to config.php or (from 1.2 onwards) the database
  function _AddFileConfigVar($p_name, $p_value)
  {
  	global $ErrorString;

  	include ("../config.php");

  	$fp = fopen("../config.php", "r+");

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

  // Returns the id of the current Moa config files
  // (id is 5 digit based on version number - 1.1.0 = 10100)
  function _UpgradeGetCurrentVersionID()
  {
  	global $STR_DELIMITER;

    if (strlen($STR_DELIMITER) == 0)
    {
      $ver = 10000;
    } else
    {
      $ver = 10100;
    }
    return $ver;
  }

  // Returns the id of the current Moa source files
  function _UpgradeGetNewVersionID()
  {
  	global $MOA_MAJOR_VERSION;
  	global $MOA_MINOR_VERSION;
  	global $MOA_REVISION;

  	return (($MOA_MAJOR_VERSION*10000)+($MOA_MINOR_VERSION*100)+$MOA_REVISION);
  }

  function _UpgradeDelFile($filename)
  {
    return @unlink("../".$filename);
  }
?>