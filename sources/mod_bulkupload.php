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

    $returnInfo = DefaultAjaxResult( 'ftpGetFileList');

    $returnInfo['FileList'] = _BulkUpload_FileList();
    
    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
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

    $returnInfo = DefaultAjaxResult( 'ftpAddOneFile');
    
    $fileName = GetParam('filename');
    $parentID = GetParam('parentid');
    $tags = GetParam('tags');
    $desc = GetParam('desc');

    if ((false === $fileName) ||
        (false === $parentID) ||
        (false === $tags) ||
        (false === $desc))
    {
      $returnInfo['Result'] = 'The server expected more information than was sent.  This could be a network problem or a bug.';
      return $returnInfo;
    }

    if ((strcmp( $parentID, 'blank') == 0) && (strlen($tags) == 0))
    {
      $returnInfo['Result'] = 'No tags or target gallery specified.';
      return $returnInfo;
    }

    // TODO - BulkUpload class - using errorString
    $result = _BulkUpload_AddFile($fileName, $parentID, $tags, $desc);

    if (!is_string($result))
    {
      if (true !== $result)
      {
        $returnInfo['Result'] = 'Could not add the file. '.$errorString;
        return $returnInfo;
      }
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  function BulkUploadAjaxMain()
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

    switch ($action)
    {
      case "list" :
      {
        echo json_encode(BulkUploadList());
      	break;
      }
      case "step" :
      {
        echo json_encode(BulkUploadStep());
        break;
      }
      default :
      {
        $returnInfo = DefaultAjaxResult( 'Unknown');
	      $returnInfo['Result'] = 'Unknown action.';
	      echo json_encode($returnInfo);
	      return;
      }
    }
  }

  BulkUploadAjaxMain();
?>