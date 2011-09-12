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

  include_once($CFG["MOA_PATH"]."sources/mod_main_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  function MainEdit()
  {
    // Only proceed if a Main is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;      
    }

    $returnInfo = DefaultAjaxResult( 'MainEdit');
    
    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      $returnInfo['Result'] = 'No description supplied.';
      return $returnInfo;      
    }

    // Try to edit the Main Gallery
    $main = new Main();
    $main->description = $newdesc;
    if (false === $main->Commit())
    {
      $returnInfo['Result'] = "Could not edit front page message.";
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  function MainAjaxMain()
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
      case "edit" :
      {
        echo json_encode(MainEdit());
        break;
      }      
      default :
      {        
        $returnInfo = DefaultAjaxResult( 'ActionCheck');
        $returnInfo['Result'] = 'No action supplied.';
	      echo json_encode($returnInfo);
        break;
      }
    }
  }

  // Only call this if we are running stand-alone (not included from index.php)
  if (false === isset($preCache))
  {
    MainAjaxMain();
  }
?>