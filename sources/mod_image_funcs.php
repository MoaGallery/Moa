<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  /* mod_image_funcs.php
   This is a collection of functions that interect with the database and a image.
  */
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");

  class Image
  {
    public $id = 0;
    public $description = '';
    public $height = 0;
    public $width = 0;
    public $originalFilename = '';
    public $format = '';
    public $localFilename = '';

    private $isLive = false;

    public function loadId ($p_id)
    {
      global $errorString;
      global $CFG;

      $query = "SELECT * FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $row = mysql_fetch_array($result);

      $this->id               = $p_id;
      $this->description      = $row["Description"];
      $this->height           = $row["Height"];
      $this->width            = $row["Width"];
      if (isset($row["Format"]))
      {
        $this->format           = $row["Format"];
      } else
      {
        $this->format = 'jpg';
      }
      $this->originalFilename = $row["Filename"];
      $this->localFilename    = $CFG['MOA_PATH'].$CFG['IMAGE_PATH'].$p_id.$this->format;
      $this->isLive = true;

      return true;
    }

    /*
      Changes the value of all fields for image identified by $id.
    */
    public function edit($p_desc, $p_tags)
    {
      global $errorString;
      global $CFG;

      $query = "UPDATE `".$CFG["tab_prefix"]."image` SET Description = _utf8'".mysql_real_escape_string($p_desc)."' WHERE IDImage = '".mysql_real_escape_string($this->id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      // Get current tagged galleries this image is in
      $old = GetImageGalleriesFromTags($this->id);
      
      // Sort out tags
      $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage='".mysql_real_escape_string($this->id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      
      // Update tags
      $Tag = new Tag();
      $result = $Tag->linkTagsToImage($this->id, $p_tags);
      if (false === $result) {
        return false;
      }

      // Get new tagged galleries this image is in
      $new = GetImageGalleriesFromTags($this->id);
      
      // Check for links to delete
      foreach($old as $oldGallery)
      {
        if (!isset($new[$oldGallery]))
        {
          // Not in this gallery any more, delete it!
          $query = "DELETE FROM `".$CFG["tab_prefix"]."galleryindex` 
                    WHERE IDImage='".mysql_real_escape_string($this->id)."' 
                    AND IDGallery='".mysql_real_escape_string($oldGallery)."'";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
        }
      }
      
      // Check for links to add
      foreach($new as $newGallery)
      {
        if (!isset($old[$newGallery]))
        {
          // Not in this gallery originally, add it!
          AddImageToGalleryIndex($newGallery, $this->id);
        }
      }
      
      return true;
    }

    public function AddIndices($p_gallery_id, $p_tag_length)
    {
      // If this is an indexed gallery add the image
      if (false == DoesGalleryUseTags($p_gallery_id))
      {
        AddImageToGalleryIndex($p_gallery_id, $this->id);
      }

      // Check all galleries for tag matches if there are any
      if (0 != $p_tag_length)
      {
        AddImageToTaggedGalleries($this->id);
      } 
    }
    
    /*
      Add a submitted image.
    */
    public function addSubmitted($p_tagList, $p_gallery_id)
    {
      global $errorString;
      global $CFG;

      $this->getImageInfoFromFile();

      $this->id = $this->addImagetoDatabase();
      if (false === $this->id)
      {
      	return false;
      }

      $this->addTagsToDatabase($p_tagList);

      $this->AddIndices($p_gallery_id, strlen($p_tagList));
      
      // Move the file
      $imageIdString = sprintf("%010s",$this->id);
      $imageDestinationFilename = $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$imageIdString.".".$this->format;

      $result = @move_uploaded_file( $this->localFilename, $imageDestinationFilename);

      $this->localFilename = $imageDestinationFilename;

      if (!$result)
      {
      	return false;
      }

      createImageThumbnail( $imageIdString, $this->format);

      return $this->originalFilename;
    }

    /*
      Add an image from the bulk upload folder.
    */
    public function addBulkUpload($p_tagList, $p_gallery_id)
    {
      global $errorString;
      global $CFG;

      $result = $this->getImageInfoFromFile();
      if (false == $result)
      {
      	return false;
      }

      $localFilename = $this->localFilename;

      $this->id = $this->addImagetoDatabase($p_gallery_id);
      if (false === $this->id)
      {
      	return false;
      }

      $this->addTagsToDatabase($p_tagList);
      
      $this->AddIndices($p_gallery_id, strlen($p_tagList));

      $imageIdString = sprintf("%010s",$this->id);
      $imageDestinationFilename = $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$imageIdString.".".$this->format;
      $result = rename( $localFilename, $imageDestinationFilename);

      $this->localFilename = $imageDestinationFilename;

      if (!$result)
      {
      	return false;
      }

      createImageThumbnail( $imageIdString, $this->format);

      return $this->originalFilename;
    }

    /*
      Deletes the image indentified by $id.
    */
    public function delete()
    {
      global $errorString;
      global $CFG;

      $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($this->id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $query = "DELETE FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDImage = '".mysql_real_escape_string($this->id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      
      $query = "DELETE FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".mysql_real_escape_string($this->id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      DeleteImageFile($this->id, $this->format);
      DeleteThumbFile($this->id);

      $this->isLive = false;

      return true;
    }

    public function getTagObjectArray()
    {
      global $CFG;

      $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($this->id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $tags = array();

      while (false !== ($row = mysql_fetch_array($result))) {
        $tags[] = $row["IDTag"];
      }

      return $tags;
    }

    public function getContainingGalleries()
    {
      global $CFG;
      
      if (!$this->isLive)
      {
        return false;
      }
      
      $list = array();
      
      $query = "SELECT Name, IDGallery FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery IN "
              ."(SELECT IDGallery FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDImage = '".mysql_real_escape_string($this->id)."');";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      } 
      
      while ($row = mysql_fetch_array($result))
      {
      	$list[$row['Name']] = $row['IDGallery'];
      }
      
      return $list;
    }
    
    private function getImageInfoFromFile()
    {
    	$imageHandle = openImage($this->localFilename);
      if (false === $imageHandle)
      {
      	return false;
      }

      $this->width = imagesx($imageHandle);
      $this->height = imagesy($imageHandle);
      $this->format = detectImageFormat($this->localFilename);

      imagedestroy($imageHandle);

      return true;
    }

    private function addTagsToDatabase($p_tagList)
    {
      $Tag = new Tag();
      $result = $Tag->linkTagsToImage($this->id, $p_tagList);
      if (false === $result) {
        return false;
      }
      return true;
    }

    private function addImagetoDatabase()
    {
      global $CFG;

      $query =  "INSERT INTO `".$CFG["tab_prefix"]."image` ";
      $query .= "(Filename, Width, Height, Description, Format) ";
      $query .= "VALUES(_utf8'".$this->originalFilename."', ";
      $query .=        "'".$this->width."', ";
      $query .=        "'".$this->height."', ";
      $query .=        "_utf8'".$this->description."', ";
      $query .=        "_utf8'".$this->format."');";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      
      $imageID = mysql_insert_id();
      
      return $imageID;
    }
  }

  /*
     Checks on database that a image exists for the given id.
  */
  function ImageExists($p_id)
  {
    global $CFG;

    $query = "SELECT 1 FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

    if ((false === $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    return true;
  }

  function AddImageFromSubmit($p_desc, $p_tags, $p_local_filename, $p_orig_filename, $p_gallery_id)
  {
    global $CFG;

    $Image = new Image;
    $Image->description = $p_desc;
    $Image->originalFilename = $p_orig_filename;
    $Image->localFilename = $p_local_filename;

    return $Image->addSubmitted($p_tags, $p_gallery_id);
  }

  function AddImageFromIncoming($p_desc, $p_tags, $p_filename, $p_gallery_id)
  {
    global $CFG;

    $Image = new Image;
    $Image->description = $p_desc;
    $Image->originalFilename = $p_filename;
    $Image->localFilename = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'].$p_filename;

    return $Image->addBulkUpload($p_tags, $p_gallery_id);
  }

  function AddImageFromForm($p_desc, $p_tags, $p_gallery_id)
  {
    GLOBAL $errorString;
    GLOBAL $CFG;

  	$localFilename = $_FILES["filename"]["tmp_name"];
  	$origFilename = $_FILES["filename"]["name"];
  	$images = array();
  	$isArchive = false;

  	$tmpPath = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'].'moaTmp';

  	$permissionsError = false;
  	$permissions = CheckFolderPerms($CFG['BULKUPLOAD_PATH']);

  	if ($permissions === false) {
  	  $errorString .= 'Path "'.$CFG['BULKUPLOAD_PATH'].'" does not exist.'."\n";
  	  return false;
  	}

  	if (!$permissions->readable)
    {
      $errorString .= 'Path "'.$CFG['BULKUPLOAD_PATH'].'" is not readable.'."\n";
      $permissionsError = true;
    }
    if (!$permissions->writeable)
    {
      $errorString .= 'Path "'.$CFG['BULKUPLOAD_PATH'].'" is not writeable.'."\n";
      $permissionsError = true;
    }
    if ($permissionsError)
    {
      return false;
    }

  	if (!file_exists($tmpPath)) {
     	@mkdir($tmpPath, 0777);
  	}

  	if (is_image($localFilename))
    {
      $result = AddImageFromSubmit($p_desc, $p_tags, $localFilename, $origFilename, $p_gallery_id);
      $images[] = $origFilename;
    } else
    {
      if (is_zip($localFilename))
      {
      	$isArchive = true;
        $zipFile = new ZipArchive();
        $zipHandle = $zipFile->open( $localFilename);
        if (true === $zipHandle) {
          $zipFile->extractTo($tmpPath);
          $zipFile->close();

          _FlattenDirectoryStructure($tmpPath.'/', $tmpPath.'/');

          $dirHandle = @opendir($tmpPath.'/');
          $imageCount = 0;

          while (false !== ($fileName = @readdir($dirHandle)))
          {
            $fullName = $tmpPath.'/'.$fileName;
            if ((!is_dir($fullName)) &&
                (is_image($fullName)))
            {
            	$imageCount++;
            }

          	$fullName = $tmpPath.'/'.$fileName;
          	if ((!is_dir($fullName)) &&
                (is_image($fullName)))
            {
	            $images[] = $fileName;
            }
          }
          
          sort($images);
        } else
        {
          $errorString .= 'A problem occured when trying to uncompress archive.';
          return false;
        }

        if ($imageCount > 0) {
           $result = AddImageFromBulkTemp($p_desc, $p_tags, $images[0], $p_gallery_id);
        }
      } else
      {
        $errorString .= 'File is not an image or an archive.';
        return false;
      }
    }

    /* Send back encoded list */
    return json_encode($images);
  }

  function AddImageFromBulkTemp($p_desc, $p_tags, $p_filename, $p_gallery_id)
  {
    GLOBAL $errorString;
    GLOBAL $CFG;

    $tmpPath = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'].'moaTmp';

    $fullName = $tmpPath.'/'.$p_filename;
    if ((!is_dir($fullName)) &&
        (is_image($fullName)))
    {
      $image = new Image;
      $image->description = mysql_real_escape_string($p_desc);
      $image->originalFilename = mysql_real_escape_string($p_filename);
      $image->localFilename = mysql_real_escape_string($fullName);
    }
    else
    {
      $errorString = $p_filename.' is not an image';
      return false;
    }

    $result = $image->addBulkUpload($p_tags, $p_gallery_id);

    if (IsDirectoryEmpty($tmpPath))
    {
      @rmdir($tmpPath);
    }

    return $result;
  }

  /*
     Changes the value of field named by $field to $value for image identified by $id.
  */
  function ImageSetValue($p_id, $p_field, $p_value)
  {
    global $CFG;

    $query = "UPDATE `".$CFG["tab_prefix"]."image` SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDImage = '".$p_id."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }
    return true;
  }

  /*
     Returns the value of field named by $field for image specified by $id.
  */
  function GetImageValueFromDatabase($p_id, $p_field )
  {
    global $errorString;
    global $CFG;

    $query = "SELECT ".TypeSafeMysqlRealEscapeString($p_field)." FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);
    return $row[$p_field];
  }

  function DeleteImageFile($p_id, $p_ext)
  {
    global $CFG;
    $filename = $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$p_id.".".$p_ext;
    DeleteFile($filename);
  }

  function DeleteThumbFile($p_id)
  {
    global $CFG;
    $filename = $CFG["MOA_PATH"].$CFG["THUMB_PATH"].$p_id.".jpg";
    DeleteFile($filename);
  }

?>