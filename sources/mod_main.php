<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once("_settings.php");
  LoadSettings();

  include_once($CFG["MOA_PATH"]."sources/mod_main_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  function MainGetDescription( $p_short = false)
  {
    $value = _MainGetDescription();

    if (false === $value)
    {
      RaiseFatalError("Could not get value for description.", false);
      return false;
    }

    OutputPrefix("OK");
    if (($p_short) && ($CFG["TITLE_DESC_LENGTH"] < mb_strlen($value)))
    {
      echo mb_substr($value, 0, ($CFG["TITLE_DESC_LENGTH"] - 3))."...";
    } else
    {
      echo $value;
    }
    return true;
  }

  function MainEdit()
  {
    // Only proceed if a Main is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      RaiseFatalError("No description supplied.");
      return false;
    }

    // Try to edit the Main Gallery
    if (false === _MainEdit($newdesc))
    {
      RaiseFatalError("Could not edit front page message.", false);
      return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function MainAjaxMain()
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
      case "edit" :
      {
        MainEdit();
        break;
      }
      case "getdesc" :
      {
        MainGetDescription();
        break;
      }
      default :
      {
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  // Only call this if we are running stand-alone (not included from index.php)
  if (false === isset($pre_cache))
  {
    MainAjaxMain();
  }
?>