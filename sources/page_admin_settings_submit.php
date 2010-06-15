<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function UpdateDBVar($p_requestname, $p_fieldname, $p_type = "text")
  {
    global $CFG;
    global $SETTINGS_FEEDBACK;

    if ((!isset($_REQUEST["setting_".$p_requestname])) || (0 == strlen($_REQUEST["setting_".$p_requestname])))
    {
      if ((0 != strcmp($p_fieldname, "EMPTY_DESC_POPUP_TEXT")) &&
          (0 != strcmp($p_fieldname, "SHOW_EMPTY_DESC_POPUPS")) &&
          (0 != strcmp($p_fieldname, "DISPLAY_PLAIN_SUBGALLERIES")))
      {
        $SETTINGS_FEEDBACK .= "<br/>".$p_fieldname." is not set.\n";
        return;
      }
    }

    if (0 == strcmp($p_fieldname, "SHOW_EMPTY_DESC_POPUPS"))
    {
      if (!isset($_REQUEST["setting_".$p_requestname]))
      {
        $query = "UPDATE ".$CFG["tab_prefix"]."settings SET Value = 'FALSE' WHERE Name = 'SHOW_EMPTY_DESC_POPUPS';";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

        $CFG["$p_fieldname"] = false;
        return;
      }
    }

    if (0 == strcmp($p_fieldname, "DISPLAY_PLAIN_SUBGALLERIES"))
    {
      if (!isset($_REQUEST["setting_".$p_requestname]))
      {
        $query = "UPDATE ".$CFG["tab_prefix"]."settings SET Value = 'FALSE' WHERE Name = 'DISPLAY_PLAIN_SUBGALLERIES';";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

        $CFG["$p_fieldname"] = false;
        return;
      }
    }

    switch ($p_type)
    {
      case "boolean" :
      {
        $var = false;
        $varstr = "FALSE";
        if (isset($_REQUEST["setting_".$p_requestname]))
        {
          $var = true;
          $varstr = "TRUE";
        }
        if ($var != $CFG["$p_fieldname"])
        {
          $query = "UPDATE ".$CFG["tab_prefix"]."settings SET Value = '".mysql_real_escape_string($varstr)."' WHERE Name = '".$p_fieldname."';";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

          $CFG["$p_fieldname"] = $var;
        }
        break;
      }
      case "integer" :
      {
        if (isset($_REQUEST["setting_".$p_requestname]))
        {
          $var = $_REQUEST["setting_".$p_requestname];
          if ($var != $CFG["$p_fieldname"])
          {
            $query = "UPDATE ".$CFG["tab_prefix"]."settings SET Value = '".mysql_real_escape_string($var)."' WHERE Name = '".$p_fieldname."';";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

            $CFG["$p_fieldname"] = $var;
          }
        }
        break;
      }
      default :
      {
        $var = "";
        if (isset($_REQUEST["setting_".$p_requestname]))
        {
          $var = $_REQUEST["setting_".$p_requestname];
        }
        if (0 != strcmp($var, $CFG["$p_fieldname"]))
        {
          $query = "UPDATE ".$CFG["tab_prefix"]."settings SET Value = '".mysql_real_escape_string($var)."' WHERE Name = '".$p_fieldname."';";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

          $CFG["$p_fieldname"] = $var;
        }
        break;
      }
    }
  }

  
  $g_write_db_config = false;

  function UpdateDBConfig($p_requestname, $p_varname)
  {
    global $CFG;
    global $SETTINGS_FEEDBACK;
    global $g_write_db_config;

    if ((!isset($_REQUEST["setting_".$p_requestname])) || (0 == strlen($_REQUEST["setting_".$p_requestname])))
    {
      if ((0 != strcmp($p_varname, "db_pass")) &&
          (0 != strcmp($p_varname, "tab_prefix")))
      {
        $SETTINGS_FEEDBACK .= "<br/>".$p_varname." is not set.\n";
        return;
      }
    }

    if (isset($_REQUEST["setting_".$p_requestname]))
    {
      if (0 != strcmp($CFG[$p_varname], $_REQUEST["setting_".$p_requestname]))
      {
        $CFG[$p_varname] = $_REQUEST["setting_".$p_requestname];
        $g_write_db_config = true;
      }
    }
  }

  
  function WriteDBConfig()
  {
    global $CFG;
    global $g_write_db_config;

    // Save new config
    if ($g_write_db_config)
    {
      // Remove old backup and make a copy of the current config
      @unlink($CFG["MOA_PATH"]."private/db_config.php.bak");
      rename($CFG["MOA_PATH"]."private/db_config.php", $CFG["MOA_PATH"]."private/db_config.php.bak");

      $file = fopen($CFG["MOA_PATH"]."private/db_config.php","wt");
      fwrite($file, "<?php\n");
      fwrite($file, "  \$CFG[\"db_host\"] = \"".$CFG["db_host"]."\";\n");
      fwrite($file, "  \$CFG[\"db_name\"] = \"".$CFG["db_name"]."\";\n");
      fwrite($file, "  \$CFG[\"db_user\"] = \"".$CFG["db_user"]."\";\n");
      fwrite($file, "  \$CFG[\"db_pass\"] = \"".$CFG["db_pass"]."\";\n");
      fwrite($file, "  \$CFG[\"tab_prefix\"] = \"".$CFG["tab_prefix"]."\";\n");
      fwrite($file, "?>\n");
      fclose($file);
    }
  }

  
  
  
  $valid = true;
  
  global $SETTINGS_FEEDBACK;
  
  // Check paths are valid or don't allow an update
  $errorString = '';
  if ((isset($_REQUEST['setting_ImagePath'])) &&
      (!CheckPathIsValid($_REQUEST['setting_ImagePath'], 'IMAGE_PATH')))
  {
    $SETTINGS_FEEDBACK .= $errorString;
    $valid = false;
  }
  
  $errorString = '';
  if ((isset($_REQUEST['setting_ThumbPath'])) &&
      (!CheckPathIsValid($_REQUEST['setting_ThumbPath'], 'THUMB_PATH')))
  {
    $SETTINGS_FEEDBACK .= $errorString;
    $valid = false;
  }
  
  $errorString = '';
  if ((isset($_REQUEST['setting_IncomingPath'])) &&
      (!CheckPathIsValid($_REQUEST['setting_IncomingPath'], 'BULKUPLOAD_PATH')))
  {
    $SETTINGS_FEEDBACK .= $errorString;
    $valid = false;
  }
  
  // Check database settings are valid or don't allow an update
  $dbHost = '';
  $dbName = '';
  $dbUser = '';
  $dbPass = '';
  $tabPrefix = '';
  
  if (isset($_REQUEST['setting_DBHost']))
  {
    $dbHost = $_REQUEST['setting_DBHost'];
  }
  if (isset($_REQUEST['setting_DBName']))
  {
    $dbName = $_REQUEST['setting_DBName'];
  }
  if (isset($_REQUEST['setting_DBUser']))
  {
    $dbUser = $_REQUEST['setting_DBUser'];
  }
  if (isset($_REQUEST['setting_DBPass']))
  {
    $dbPass = $_REQUEST['setting_DBPass'];
  }
  if (isset($_REQUEST['setting_TabPrefix']))
  {
    $tabPrefix = $_REQUEST['setting_TabPrefix'];
  }
  
  $errorString = '';
  $dbValid = true;
  $result = CheckDBSettings($dbHost, $dbUser, $dbPass, $dbName);
  if (!$result)
  {
    $SETTINGS_FEEDBACK .= $errorString;
    $valid = false;
    $dbValid = false;
  }
  
  if ($dbValid)
  {
    $result = CheckDBTable('image', $tabPrefix);
    if (!$result)
    {
      $SETTINGS_FEEDBACK .= 'Database table prefix invalid';
      $valid = false;
    }
  }
  
  $db = DBConnect();
  
  if (true === $valid)
  {
    if (null != $Userinfo->m_id)
    {
      UpdateDBVar("ShowEmptyDescPopups", "SHOW_EMPTY_DESC_POPUPS", "boolean");
      UpdateDBVar("DisplayPlainSubgalleries", "DISPLAY_PLAIN_SUBGALLERIES", "boolean");
      UpdateDBVar("Template", "TEMPLATE", "text");
      UpdateDBVar("EmptyDescPopupText", "EMPTY_DESC_POPUP_TEXT", "text");
      UpdateDBVar("StrDelimiter", "STR_DELIMITER", "text");
      UpdateDBVar("ConfigDisplayMaxWidth", "CONFIG_DISPLAY_MAX_WIDTH", "integer");
      UpdateDBVar("ThumbWidth", "THUMB_WIDTH", "integer");
      UpdateDBVar("TitleDescLength", "TITLE_DESC_LENGTH", "integer");
  
      if ($Userinfo->m_admin)
      {
        UpdateDBVar("ThumbPath", "THUMB_PATH", "text");
        UpdateDBVar("ImagePath", "IMAGE_PATH", "text");
        UpdateDBVar("CookieName", "COOKIE_NAME", "text");
        UpdateDBVar("CookiePath", "COOKIE_PATH", "text");
        UpdateDBVar("IncomingPath", "BULKUPLOAD_PATH", "text");
        UpdateDBVar("MoaPath", "MOA_PATH", "text");
  
        UpdateDBConfig("DBHost", "db_host");
        UpdateDBConfig("DBName", "db_name");
        UpdateDBConfig("DBUser", "db_user");
        UpdateDBConfig("DBPass", "db_pass");
        UpdateDBConfig("TabPrefix", "tab_prefix");
        WriteDBConfig();
      }
    }
  }
?>
