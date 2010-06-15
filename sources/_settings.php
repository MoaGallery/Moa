<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  if (file_exists("index.php"))
  {
    $CFG["MOA_PATH"] = "./";
  } else
  {
    if (file_exists("../index.php"))
    {
      $CFG["MOA_PATH"] = "../";
    }
  }

  $CFG["MOA_PATH"] = str_replace( "\\", "/", dirname(realpath($CFG["MOA_PATH"]."index.php")))."/";

  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/mod_upgrade_funcs.php");

  // Only used if the code for 1.2.1 or above is present, but they haven't done an upgrade yet.
  // Prevents a broken system due to config vars not being found.
  function MigrateDBConfig()
  {
    global $CFG;
    global $db_user;
    global $db_pass;
    global $db_name;
    global $db_host;
    global $tab_prefix;

    $CFG["db_user"] = $db_user;
    $CFG["db_pass"] = $db_pass;
    $CFG["db_name"] = $db_name;
    $CFG["db_host"] = $db_host;
    $CFG["tab_prefix"] = $tab_prefix;
  }

  
  // Only used if the code for 1.2.1 or above is present, but they haven't done an upgrade yet.
  // Prevents a broken system due to config vars not being found.
  function MigrateMainConfig()
  {
    global $CFG;
    global $DEBUG_MODE;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $THUMB_WIDTH;
    global $TEMPLATE;
    global $EMPTY_DESC_POPUP_TEXT;
    global $TITLE_DESC_LENGTH;
    global $STR_DELIMITER;
    global $CONFIG_DISPLAY_MAX_WIDTH;
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $MOA_PATH;
    global $COOKIE_PATH;
    global $COOKIE_NAME;
    global $MOA_MAJOR_VERSION;
    global $MOA_MINOR_VERSION;
    global $MOA_REVISION;
    global $MOA_PATCH;
    global $BULKUPLOAD_PATH;

    $CFG["DEBUG_MODE"] = $DEBUG_MODE;
    $CFG["DISPLAY_PLAIN_SUBGALLERIES"] = $DISPLAY_PLAIN_SUBGALLERIES;
    $CFG["SHOW_EMPTY_DESC_POPUPS"] = $SHOW_EMPTY_DESC_POPUPS;
    $CFG["THUMB_WIDTH"] = $THUMB_WIDTH;
    $CFG["TEMPLATE"] = $TEMPLATE;
    $CFG["EMPTY_DESC_POPUP_TEXT"] = $EMPTY_DESC_POPUP_TEXT;
    $CFG["TITLE_DESC_LENGTH"] = $TITLE_DESC_LENGTH;
    $CFG["STR_DELIMITER"] = $STR_DELIMITER;
    $CFG["CONFIG_DISPLAY_MAX_WIDTH"] = $CONFIG_DISPLAY_MAX_WIDTH;
    $CFG["IMAGE_PATH"] = $IMAGE_PATH;
    $CFG["THUMB_PATH"] = $THUMB_PATH;
    $CFG["COOKIE_PATH"] = $COOKIE_PATH;
    $CFG["COOKIE_NAME"] = $COOKIE_NAME;
    $CFG["MOA_MAJOR_VERSION"] = $MOA_MAJOR_VERSION;
    $CFG["MOA_MINOR_VERSION"] = $MOA_MINOR_VERSION;
    $CFG["MOA_REVISION"] = $MOA_REVISION;
    $CFG["MOA_PATCH"] = $MOA_PATCH;
    $CFG["BULKUPLOAD_PATH"] = $BULKUPLOAD_PATH;
  }

  
  function LoadSettings()
  {
    global $db;
    global $CFG;
    global $db_user;
    global $db_pass;
    global $db_name;
    global $db_host;
    global $tab_prefix;
    global $DEBUG_MODE;
    global $DISPLAY_PLAIN_SUBGALLERIES;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $THUMB_WIDTH;
    global $TEMPLATE;
    global $EMPTY_DESC_POPUP_TEXT;
    global $TITLE_DESC_LENGTH;
    global $STR_DELIMITER;
    global $CONFIG_DISPLAY_MAX_WIDTH;
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $MOA_PATH;
    global $COOKIE_PATH;
    global $COOKIE_NAME;
    global $BULKUPLOAD_PATH;
    global $errorString;

    // Set some default settings
    $CFG["DEBUG_MODE"] = false;
    $CFG["DISPLAY_PLAIN_SUBGALLERIES"] = true;
    $CFG["SHOW_EMPTY_DESC_POPUPS"] = false;
    $CFG["THUMB_WIDTH"] = 150;
    $CFG["TEMPLATE"] = "Aperture";
    $CFG["EMPTY_DESC_POPUP_TEXT"] = "No description";
    $CFG["TITLE_DESC_LENGTH"] = 30;
    $CFG["STR_DELIMITER"] = ",";
    $CFG["CONFIG_DISPLAY_MAX_WIDTH"] = 640;

    // Load database settings from a file
    include_once($CFG["MOA_PATH"]."private/db_config.php");
    // Load any vars in the config file, used to pre-populate versions below 1.2.1
    include($CFG["MOA_PATH"]."config.php");

    // Allow for the upgrade to 1.2.1 or above;
    if (isset($db_host))
    {
      MigrateDBConfig();
      
      // Keep our generated MOA_PATH in case the saved one is broken
      $mp = $CFG["MOA_PATH"];
      MigrateMainConfig();
      $CFG["MOA_PATH"] = $mp;
      if (0 < strlen($IMAGE_PATH))
      {
        $CFG['IMAGE_PATH'] .= '/';
        $CFG['THUMB_PATH'] .= '/';
        $CFG['BULKUPLOAD_PATH'] = 'incoming/';
      }
    }

    // Initialise any database stuff
    include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");

    // Check settings are OK
    include_once($CFG["MOA_PATH"]."sources/_integrity_funcs.php");
    
    $errorString = '';
    $result = CheckDB();
    if (false === $result)
    {
      echo 'Fatal Error with database config (edit <moapath>/private/db_config.php and/or the database to change settings) - <br/><br/>';
      echo nl2br($errorString);
      die();
    }
    
    $db = DBConnect();

    $query = "SHOW TABLES LIKE '".$CFG["tab_prefix"]."settings';";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    if (0 < mysql_num_rows($result))
    {
      // Load settings from the database
    	$query = "SELECT * FROM ".$CFG["tab_prefix"]."settings;";
    	$result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    	while ($setting = mysql_fetch_array($result))
    	{
        switch ($setting["Type"])
        {
          case "INTEGER" :
          {
            $CFG[$setting["Name"]] = intval($setting["Value"]);
            break;
          }
          case "BOOLEAN" :
          {
            if (0 == strcmp($setting["Value"], "TRUE"))
            {
              $CFG[$setting["Name"]] = true;
            } else
            {
              $CFG[$setting["Name"]] = false;
            }
            break;
          }
          default :
          {
            $CFG[$setting["Name"]] = $setting["Value"];
            break;
          }
        }
    	}
    }

    // Load any other settings or overrides from the config file (Reloads DB vars in case any make it into the DB somehow).
    include($CFG["MOA_PATH"]."config.php");
    include($CFG["MOA_PATH"]."private/db_config.php");

    $errorString = '';
    $result = CheckPaths();
    if (false === $result)
    {
      echo 'Fatal Error with Moa path settings (edit database to fix) - <br/><br/>';
      echo nl2br($errorString);
      die();
    }
    
    // Allow for the upgrade to 1.2.1 or above;
    if (isset($db_host))
    {
      MigrateMainConfig();
    }

    $CFG["MOA_VERSION"] = $CFG["MOA_MAJOR_VERSION"].".".
                          $CFG["MOA_MINOR_VERSION"].".".
                          $CFG["MOA_REVISION"].
                          $CFG["MOA_PATCH"];
  }
?>
