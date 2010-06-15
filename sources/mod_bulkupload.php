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

  include_once($CFG["MOA_PATH"]."sources/mod_bulkupload_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  function BulkUploadList()
  {
    global $CFG;
    global $errorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    OutputPrefix("OK");

    echo _BulkUpload_JSONFileList();
  }

  function BulkUploadStep()
  {
    global $CFG;
    global $errorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError('Not logged in.');
      return false;
    }

    $fileName = GetParam('filename');
    $parentID = GetParam('parentid');
    $tags = GetParam('tags');
    $desc = GetParam('desc');

    if ((false === $fileName) ||
        (false === $parentID) ||
        (false === $tags) ||
        (false === $desc))
    {
    	OutputPrefix('ERROR');
    	echo 'The server expected more information than was sent.  This could be a network problem or a bug.';
    	return false;
    }

    if ((strcmp( $parentID, 'blank') == 0) && (strlen($tags) == 0))
    {
      OutputPRefix('ERROR');
      echo 'No tags or target gallery specified';
      return false;
    }


    $result = _BulkUpload_AddFile($fileName, $parentID, $tags, $desc);

    if (is_string($result))
    {
      OutputPrefix("OK");
    	echo "Added - ".$result;
    } else
    {
      if (true !== $result)
      {
        OutputPrefix("ERROR");
      	echo $errorString;
      }
    }

    return true;
  }

  function BulkUploadAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      RaiseFatalError("No action supplied.");
    }

    switch ($action)
    {
    	case "list" :
    	{
    	  BulkUploadList();
    		break;
    	}
      case "step" :
      {
        BulkUploadStep();
        break;
      }
      default :
      {
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  BulkUploadAjaxMain();
?>