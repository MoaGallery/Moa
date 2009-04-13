<?php
  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }

  if (!$INSTALLING)
  {
    include_once($MOA_PATH."sources/_db_funcs.php");
    include_once($MOA_PATH."config.php");
  }

  if (!isset($DEBUG_MODE))
  {
  	$DEBUG_MODE = false;
  }

  if (!$DEBUG_MODE)
  {
    if ((is_file("install.php")) && (is_file("config.php")) && (false == isset($FRESH_INSTALL)) && (!$INSTALLING))
    {
      moa_warning("Please delete or rename install.php");
    }
  }

  echo LoadTemplate("component_header.php");

  // Check gallery exists and set to home if it doesn't
  if (0 != strcmp("0000000000", $current_gallery))
  {
    $query = "SELECT Name FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($current_gallery)."')";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    if (0 == mysql_num_rows($result))
    {
      $current_gallery = "0000000000";
    }
  }
?>
