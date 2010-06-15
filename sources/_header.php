<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }
  
  $headercontent = '';
  
  if (false === isset($INSTALLING)) {
    $INSTALLING = false;
  }

  if (!$INSTALLING)
  {
    include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");
  } else
  {
  	include_once($CFG["MOA_PATH"]."sources/mod_upgrade_funcs.php");
  }

  if (!isset($CFG["DEBUG_MODE"]))
  {
  	$CFG["DEBUG_MODE"] = false;
  }

  if ((!$CFG["DEBUG_MODE"]) &&
      (UserIsLoggedIn()))
  {
    if ((is_file($CFG["MOA_PATH"]."install.php")) && (is_file($CFG["MOA_PATH"]."config.php")) && (false == isset($FRESH_INSTALL)) && (!$INSTALLING))
    {
      include_once($CFG["MOA_PATH"]."sources/common.php");
    	$headercontent = moa_warning_ret("Please delete or rename install.php");
    }
  }

  // See if we need an upgrade warning
  if ((!$INSTALLING) && (_MoaDetectOldVersion()))
  {
  	// If logged in
  	if (UserIsLoggedIn())
  	{
  	  $headercontent = moa_warning_ret("Upgraded files have been installed. Please click <a href='index.php?action=upgrade'><i>here</i></a> to complete the upgrade.", false);
  	} else
  	{
  		$headercontent = moa_warning_ret("Upgrade in progress, things may not work as expected until it has completed.", false);
  	}
  }
  
  $headercontent .= LoadTemplateRoot("component_header.php");

  // Check gallery exists and set to home if it doesn't
  if (!$INSTALLING)
  {
    if (0 != strcmp("0000000000", $current_gallery))
    {
      $query = "SELECT Name FROM `".$CFG["tab_prefix"]."gallery` WHERE (IDGallery = '".mysql_real_escape_string($current_gallery)."')";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      if (0 == mysql_num_rows($result))
      {
        $current_gallery = "0000000000";
      }
    }
  }
?>
