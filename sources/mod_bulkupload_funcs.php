<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  /* mod_bulkupload_funcs.php
   This is a collection of functions that allow bulk uploads.
  */

  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");

  class _IncomingFile {
    var $name;
    var $readable;
    var $deleteable;
  }

  class _FilePerms {
    var $path;
    var $readable;
    var $writeable;
  }

  function _BulkUpload_AddFile($fileName, $parentID, $tags, $desc)
  {
    global $errorString;
  	global $CFG;

    $tag = new Tag();
    $tagString = '';

    if (0 != strcmp($parentID, 'blank'))
    {
      $tagString .= $tag->getTagStringForGallery($parentID);

      if (strlen($tags) > 0)
      {
        $tagString .= ', ';
      }
    }

    $tagString .= $tags;

    if (AddImageFromIncoming( $desc, $tagString, $fileName, $parentID))
    {
      return $fileName;
    }
    else
    {
      return false;
    }
  }

  function _BulkUpload_CheckPerms()
  {
  	global $CFG;

    $checkList = array( $CFG['BULKUPLOAD_PATH']
                      , $CFG['IMAGE_PATH']
                      , $CFG['THUMB_PATH']
                      );

  	$folderList = array();

  	foreach ($checkList as $folder)
  	{
      $result = CheckFolderPerms($folder);
      if (false === $result)
      {
      	return false;
      }
      $folderList[] = $result;
  	}
  	return $folderList;
  }

  function _BulkUpload_ScanDir_cmp($a, $b)
  {
    return strcmp($a->name, $b->name);
  }
  
  function _BulkUpload_ScanDir()
  {
    global $CFG;

    $fileList = array();

    $uploadPath = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'];

    $dirHandle = @opendir($uploadPath);

    if (false === $dirHandle) {
      $errorString = 'Could not open directory "'.$uploadPath.'"';
      return false;
    }

    while (false !== ($fileName = @readdir($dirHandle)))
    {
      // Do not count any file/dir starting with a dot (hidden in *nix and special folders such as '..')
      if ('.' != substr($fileName, 0, 1))
      {
        if (false === is_dir($uploadPath.$fileName))
        {
          if (is_image($uploadPath.$fileName))
          {
        	  $file = new _IncomingFile();
            $file->name = $fileName;
            $file->readable = is_readable($uploadPath.$fileName);
            $file->deleteable = is_writeable($uploadPath.$fileName);

            $fileList[] = $file;
          }
        }
      }
    }
    @closedir($dirHandle);
    
    
    usort($fileList, "_BulkUpload_ScanDir_cmp");

    return $fileList;
  }

  function _BulkUpload_JSONFileList()
  {
    $ftpList = _BulkUpload_ScanDir();

    $fileList = array();
    foreach ($ftpList as $file)
    {
      $fileList[] = $file->name;
    }

    return json_encode($fileList);
  }

  function _FlattenDirectoryStructure( $p_path, $p_root_path)
  {
  	global $CFG;

  	$dirHandle = @opendir($p_path);

  	while (false !== ($fileName = @readdir($dirHandle)))
    {
    	if (!((0 == strcmp($fileName, ".")) || (0 == strcmp($fileName, "..")))) {
    	  if (is_dir($p_path.$fileName))
    	  {
    	  	_FlattenDirectoryStructure( $p_path.$fileName.'/', $p_root_path);
    	    rmdir($p_path.$fileName);
    	  }
    	  else
    	  {
    	    if (is_image($p_path.$fileName)) {
    	      if (0 != strcmp($p_root_path, $p_path)) {
    	    	  if (is_file($p_root_path.$fileName))
    	    	  {
    	    	  	unlink($p_root_path.$fileName);
    	    	  }

    	    	  rename($p_path.$fileName, $p_root_path.$fileName);
    	      }
    	    }
    	    else
    	    {
            unlink($p_path.$fileName);
    	    }
    	  }
    	}
    }
    @closedir($dirHandle);
  }
?>
