<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  // Detects if the files and config/db match or not.
  // Returns true if a new version of the files seem to have been uploaded.
  function _MoaDetectOldVersion()
  {
    global $CFG;
    if ($CFG["DEBUG_MODE"])
    {
      return false;
    }

    $new_ver = _UpgradeGetNewVersionID();
    $cur_ver = _UpgradeGetCurrentVersionID();

    //echo $cur_ver." -> ".$new_ver;

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
    global $CFG;
    global $no_moa_path;
    global $THUMB_WIDTH;

    $version = _UpgradeGetNewVersionID();

    $query = "SELECT Name FROM ".$CFG["tab_prefix"]."settings;";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

    if (false === $result)
    {
      $version = 10200;
      
      $query = "SELECT * FROM ".$CFG["tab_prefix"]."v_gallery_images;";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

      if (false === $result)
      {
        $version = 10199;

        $query = "SELECT * FROM ".$CFG["tab_prefix"]."options;";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

        if (false === $result)
        {
          $version = 10100;

          if (0 == strlen($CFG["STR_DELIMITER"]))
          {
            $version = 10000;
          }
        }
      }
    }

    return $version;
  }

  // Returns the id of the current Moa source files
  function _UpgradeGetNewVersionID()
  {
  	global $CFG;

  	return (($CFG["MOA_MAJOR_VERSION"]*10000)+($CFG["MOA_MINOR_VERSION"]*100)+$CFG["MOA_REVISION"]);
  }

  // Adds a new config variable to config.php
  function _AddFileConfigVar($p_name, $p_value, $p_test = true)
  {
    global $ErrorString;

    include ("../config.php");

    $fp = @fopen("../config.php", "r+");

    if (!$fp)
    {
      $ErrorString = "Could not open config.php for writing.";
      return false;
    }

    if ($p_test)
    {
      fclose($fp);
      return true;
    }

    // Rewrite config.php with the new var
    if (!$p_test)
    {
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
    }
    fclose($fp);

    return true;
  }

  function _AddDBConfigVar($p_name, $p_value, $p_test = true)
  {
    global $CFG;
    global $db;
    global $ErrorString;

    if ($db === false)
    {
      $ErrorString = "Database connection not present";
      return false;
    }

    if ($p_test) {
      if (0 == strlen($p_name)) {
        $ErrorString = "Setting name must not be blank";
      	return false;
      }

    	return true;
    }
    else {
	    if (isset($CFG[$p_name])) {
	      $query = "UPDATE `".$CFG["tab_prefix"]."settings` SET Value = '".$p_value."' WHERE Name = '".$p_name."';";
	    }
	    else
	    {
	     $query = "INSERT INTO `".$CFG["tab_prefix"]."settings` (Value, Name) VALUES ('".$p_value."', '".$p_name."');";
	    }

	    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	    if (false === $result)
	    {
	      $ErrorString = "Could not set value for setting '".$p_name."'";
	      return false;
	    }
      return true;
    }
  }

  function _UpgradeDelFile($p_filename, $p_test = true)
  {
    global $CFG;
    global $ErrorString;

    // Return true if the file doesn't exist anyway
    if (!file_exists($CFG["MOA_PATH"].$p_filename))
    {
      return true;
    }
    if ($p_test)
    {
      if (!is_writeable($CFG["MOA_PATH"].$p_filename))
      {
        $ErrorString = $p_filename." exists but cannot be deleted (check permissions)";
        return false;
      }
      $dir = dirname($CFG["MOA_PATH"].$p_filename);
      if (!is_writeable($dir))
      {
        $ErrorString = "cannot delete from directory '".$dir."' (check permissions)";
        return false;
      }


      return true;
    }

    // Delete it
    if (!$p_test)
    {
      return unlink($CFG["MOA_PATH"].$p_filename);
    }
  }

  function _ModifyDB($p_filename, $p_test = true)
  {
    global $CFG;
    global $ErrorString;

    if ($p_test)
    {
      if (file_exists($CFG["MOA_PATH"]."SQL/upgrade/".$p_filename))
      {
        if (isset($CFG["tab_prefix"]))
        {
          return true;
        } else
        {
          $ErrorString = "Table prefix in private/db_config.php is not set.";
          return false;
        }
      } else
      {
        $ErrorString = "SQL file does not exist.";
        return false;
      }
    } else
    {
      $result = RunSQLFile($CFG["MOA_PATH"]."SQL/upgrade/".$p_filename);
      if (!$result)
      {
        $ErrorString = "Error running SQL.";
        return false;
      }

      return $result;
    }

    return false;
  }

  function _UpgradeConfigFile($p_test = true)
  {
    global $db;
    global $CFG;
    global $MOA_MAJOR_VERSION;
    global $MOA_MINOR_VERSION;
    global $MOA_REVISION;
    global $MOA_PATCH;
    global $db_host;
    global $db_name;
    global $db_user;
    global $db_pass;
    global $tab_prefix;
    global $INSTALLING;
    global $ErrorString;

    if (!file_exists($CFG["MOA_PATH"]."config.php"))
    {
      $ErrorString = "config.php does not exist.";
      return false;
    }

    $fp = @fopen($CFG["MOA_PATH"]."config.php", "a");
    if (false === $fp)
    {
      $ErrorString = "Could not open config.php for writing.";
      return false;
    }
    fclose($fp);

    $fp = @fopen($CFG["MOA_PATH"]."private/db_config.php", "a");
    if (false === $fp)
    {
      $ErrorString = "Could not open private/db_config.php for writing.";
      return false;
    }
    fclose($fp);

    include_once($CFG["MOA_PATH"]."config.php");

  	/* If old config format is in use migrate it */
  	if (isset($THUMB_WIDTH))
    {
  	  MigrateMainConfig();
  	}

    $debug_flag = false;
    $debug_mode = "false";

    if (true === $p_test)
    {
      if (false === $db)
      {
        $ErrorString = "Could not connect to database";
        return false;
      }
    } else
    {
    	foreach ($CFG as $cfg_name => $cfg_value) {
        /* Filter out fields that shouldn't go in the database */
      	if ((0 == strcmp($cfg_name, "DEBUG_MODE")) ||
            (0 == strcmp($cfg_name, "db_host")) ||
            (0 == strcmp($cfg_name, "db_name")) ||
            (0 == strcmp($cfg_name, "db_user")) ||
            (0 == strcmp($cfg_name, "db_pass")) ||
            (0 == strcmp($cfg_name, "tab_prefix")) ||
            (0 == strcmp($cfg_name, "MOA_VERSION")))
        {
      		if ($CFG["DEBUG_MODE"] == true)
          {
      			$debug_mode = "true";
            $debug_flag = true;
      		}
      	}
      	else
      	{
      		/* Type is a string by default */
          $cfg_type = "STRING";
      		$value_string = "'".$cfg_type."'";

      	  /* Determine type */
      	  if (is_integer($cfg_value))
          {
      		  $value_string = $cfg_value;
      		  $cfg_type = "INTEGER";
      	  }
      	  else
      	  {
      	  	if (is_bool($cfg_value))
            {
              $value_string = 'FALSE';
      	  		if ($cfg_type == true)
              {
      	  		  $value_string = 'TRUE';
              }
              $cfg_type = "BOOLEAN";
            } else
            {
              $value_string = "'".$cfg_value."'";
            }
      	  }

          if ((0 == strcmp($cfg_name, "MOA_PATH")) ||
              (0 == strcmp($cfg_name, "COOKIE_PATH")) ||
              (0 == strcmp($cfg_name, "IMAGE_PATH")) ||
              (0 == strcmp($cfg_name, "THUMB_PATH")))
          {
            $end = substr($value_string, -2, 1);
            if (0 != strcmp($end, "/"))
            {
              $value_string = substr($value_string, 0, (strlen($value_string)-1));
              $value_string .= "/'";
            }
          }

      		$query = "INSERT INTO `".$CFG["tab_prefix"]."settings` (Name, Value, Type)".
      	           "VALUES ('".$cfg_name."', ".$value_string.", '".$cfg_type."')";

      		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

          if (false === $result)
          {
            return false;
          }
      	}
      }

      /* Write out config file */
      $file = fopen($CFG["MOA_PATH"]."config.php", "wt");
      fwrite($file, "<?php\n");
      if ($debug_flag == true) {
        fwrite($file, "  \$CFG['DEBUG_MODE'] = '".$debug_mode."';\n");
      }
      fwrite($file, "?>\n");
      fclose($file);

      /* Write out db_config file */
      if (!$INSTALLING) {
  	    $file = fopen($CFG["MOA_PATH"]."private/db_config.php", "wt");
  	    fwrite($file, "<?php\n");
  	    fwrite($file, '  $CFG["db_host"] = "'.$db_host."\";\n");
  	    fwrite($file, '  $CFG["db_name"] = "'.$db_name."\";\n");
  	    fwrite($file, '  $CFG["db_user"] = "'.$db_user."\";\n");
  	    fwrite($file, '  $CFG["db_pass"] = "'.$db_pass."\";\n");
  	    fwrite($file, '  $CFG["tab_prefix"] = "'.$tab_prefix."\";\n");
  	    fwrite($file, "?>\n");
  	    fclose($file);
      }
    }

    return true;
  }

  function _upgrade_10201_MoveConfigtoDB($p_test = true)
  {
    $result = _UpgradeConfigFile($p_test);

    return $result;
  }

  function _upgrade_10201_AddImageFormats($p_test = true)
  {
    global $CFG;

    if (false === $p_test)
    {
      $query = "UPDATE `".$CFG["tab_prefix"]."image` SET Format='jpg';";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result)
      {
        $ErrorString = "Could not set image formats in the database";
        return false;
      }
    }

    return true;
  }

  function _upgrade_complete($p_test = true)
  {
  	global $CFG;
  	global $MOA_MAJOR_VERSION;
    global $MOA_MINOR_VERSION;
    global $MOA_REVISION;
    global $MOA_PATCH;
    global $ErrorString;

    if ($p_test)
    {
      if (!is_writeable($CFG["MOA_PATH"].$CFG["IMAGE_PATH"]))
      {
        $ErrorString = "Images directory does not have write permissions.";
        return false;
      }
      if (!is_writeable($CFG["MOA_PATH"].$CFG["THUMB_PATH"]))
      {
        $ErrorString = "Thumbnail directory does not have write permissions.";
        return false;
      }
    } else
    {
      $result = _AddDBConfigVar( "MOA_MAJOR_VERSION", $MOA_MAJOR_VERSION, $p_test);
      if ($result == false)
      {
        return false;
      }
      $result = _AddDBConfigVar( "MOA_MINOR_VERSION", $MOA_MINOR_VERSION, $p_test);
      if ($result == false)
      {
        return false;
      }
      $result = _AddDBConfigVar( "MOA_REVISION", $MOA_REVISION, $p_test);
      if ($result == false)
      {
        return false;
      }
      $result = _AddDBConfigVar( "MOA_PATCH", $MOA_PATCH, $p_test);
      if ($result == false)
      {
        return false;
      }
    }
    return true;
  }
?>
