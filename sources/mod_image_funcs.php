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

  class ImageRecord
  {
  	public $id;
    public $description;
    public $tags;
  }
  
  class Image
  {
    public $id = 0;
    public $description = '';
    public $tags ='';
    public $height = 0;
    public $width = 0;
    public $originalFilename = '';
    public $format = '';
    public $localFilename = '';

    private $DBValues;                 // The version of data held in the database

    public function __construct($p_image_id = NULL)
    {
      global $CFG;

      $this->id               = (int)$p_image_id;
      $this->description      = '';
      $this->tags             = '';
      $this->height           = 0;
      $this->width            = 0;
      $this->format           = '';
      $this->originalFilename = '';
      $this->localFilename    = '';

      $this->DBValues->id               = $this->id;
      $this->DBValues->description      = $this->description;
      $this->DBValues->tags             = $this->tags;
      $this->DBValues->height           = $this->height;
      $this->DBValues->width            = $this->width;
      $this->DBValues->format           = $this->format;
      $this->DBValues->originalFilename = $this->originalFilename;
      $this->DBValues->localFilename    = $this->localFilename;
      
      
      if (NULL !== $p_image_id)
      {
        $query = "SELECT * FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_image_id)."'";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result) {
          return false;
        }
  
        $row = mysql_fetch_array($result);
  
        $this->id               = (int)$p_image_id;
        $this->description      = $row["Description"];
        $this->tags             = Tag::GetTagStringForImage($this->id);
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
        $this->localFilename    = $CFG['MOA_PATH'].$CFG['IMAGE_PATH'].$p_image_id.$this->format;
  
        $this->DBValues->id               = $this->id;
        $this->DBValues->description      = $this->description;
        $this->DBValues->tags             = $this->tags;
        $this->DBValues->height           = $this->height;
        $this->DBValues->width            = $this->width;
        $this->DBValues->format           = $this->format;
        $this->DBValues->originalFilename = $this->originalFilename;
        $this->DBValues->localFilename    = $this->localFilename;
      }
      
      return true;
    }

    public function CommitEdit()
    {
      global $CFG;

      // Check if anything has changed
      if ( (0 != strcmp($this->description, $this->DBValues->description)) ||
           (0 != strcmp($this->tags, $this->DBValues->tags)) ||
           (0 != strcmp($this->format, $this->DBValues->format)) ||
           ($this->width != $this->DBValues->width) ||
           ($this->height != $this->DBValues->height) )
      {
        $query = "UPDATE `".$CFG["tab_prefix"]."image` SET Description = _utf8'".mysql_real_escape_string($this->description)."', Format = _utf8'".mysql_real_escape_string($this->format)."', Width = '".$this->width."', Height = '".$this->height."' WHERE IDImage = '".mysql_real_escape_string($this->id)."'";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result)
        {
          return false;
        }
  
        // Get current tagged galleries this image is in
        $old = Gallery::GetFromImageTags($this->id);
        
        // Sort out tags
        $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage='".mysql_real_escape_string($this->id)."'";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result)
        {
          return false;
        }
  
        // Update tags
        Tag::LinkTagsToImage($this->id, $this->tags);
        if (false === $result)
        {
          return false;
        }
  
        // Get new tagged galleries this image is in
        $new = Gallery::GetFromImageTags($this->id);

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
            Gallery::AddImageToIndex($newGallery, $this->id);
          }
        }
        
        $this->DBValues->id               = $this->id;
        $this->DBValues->description      = $this->description;
        $this->DBValues->tags             = $this->tags;
        $this->DBValues->height           = $this->height;
        $this->DBValues->width            = $this->width;
        $this->DBValues->format           = $this->format;
        $this->DBValues->originalFilename = $this->originalFilename;
        $this->DBValues->localFilename    = $this->localFilename;
      }
      
      return true;
    }

    public function AddSubmitted($p_gallery_id)
    {
      global $errorString;
      global $CFG;

      $this->GetImageInfoFromFile();

      $this->id = $this->AddImagetoDatabase();
      if (false === $this->id)
      {
      	return false;
      }

      $this->addTagsToDatabase();

      $this->AddIndices($p_gallery_id);
      
      // Move the file
      $imageIdString = str_pad($this->id, 10, '0', STR_PAD_LEFT);
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
    
    public function AddBulkUpload($p_gallery_id)
    {
      global $errorString;
      global $CFG;

      $result = $this->getImageInfoFromFile();
      if (false == $result)
      {
      	return false;
      }

      $localFilename = $this->localFilename;

      $this->id = $this->addImagetoDatabase();
      if (false === $this->id)
      {
      	return false;
      }

      $this->AddTagsToDatabase();
      
      $this->AddIndices($p_gallery_id);

      $imageIdString = str_pad($this->id, 10, '0', STR_PAD_LEFT);
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
    
    private function GetImageInfoFromFile()
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
    
    private function AddTagsToDatabase()
    {
      $result = Tag::LinkTagsToImage($this->id, $this->tags);
      if (false === $result) {
        return false;
      }
      return true;
    }
    
    private function AddIndices($p_gallery_id)
    {
      // If this is an indexed gallery add the image
      if (false === Gallery::IsTagged($p_gallery_id))
      {
        Gallery::AddImageToIndex($p_gallery_id, $this->id);
      }

      // Check all galleries for tag matches if there are any
      if (0 != strlen($this->tags))
      {
        Gallery::AddImageToTaggedIndex($this->id);
      } 
    }
    
    private function AddImagetoDatabase()
    {
      global $CFG;

      $query =  "INSERT INTO `".$CFG["tab_prefix"]."image` ";
      $query .= "(Filename, Width, Height, Description, Format) ";
      $query .= "VALUES(_utf8'".mysql_real_escape_string($this->originalFilename)."', ";
      $query .=        "'".$this->width."', ";
      $query .=        "'".$this->height."', ";
      $query .=        "_utf8'".mysql_real_escape_string($this->description)."', ";
      $query .=        "_utf8'".$this->format."');";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      
      $imageID = mysql_insert_id();
      
      return $imageID;
    }
    
    /*
     * Image utility functions
     */
    
    static function Delete($p_image_id)
    {
      global $errorString;
      global $CFG;

      $image = new Image($p_image_id);
      
      $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $query = "DELETE FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      
      $query = "DELETE FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      Image::DeleteImageFile($p_image_id, $image->format);
      Image::DeleteThumbFile($p_image_id);

      return true;
    }

    static function GetContainingGalleries($p_image_id)
    {
      global $CFG;
      
      $list = array();
      
      $query = "SELECT Name, IDGallery FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery IN "
              ."(SELECT IDGallery FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."');";
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
  
    static function Exists($p_image_id)
    {
      global $CFG;
  
      $query = "SELECT 1 FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  
      if ((false === $result) || (0 == mysql_num_rows($result))) {
        return false;
      }
      return true;
    }
    
    static function ProcessNextImageFromIncoming($p_desc, $p_tags, $p_filename, $p_gallery_id)
    {
      global $CFG;
  
      $image = new Image();
      $image->description = $p_desc;
      $image->originalFilename = $p_filename;
      $image->localFilename = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'].$p_filename;
      $image->tags = $p_tags;
  
      return $image->AddBulkUpload($p_gallery_id);
    }
  
    static function ProcessNextImageFromTemp($p_desc, $p_tags, $p_filename, $p_gallery_id)
    {
      GLOBAL $errorString;
      GLOBAL $CFG;
  
      $tmpPath = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'].'moaTmp';
  
      $fullName = $tmpPath.'/'.$p_filename;
      if ((!is_dir($fullName)) &&
          (is_image($fullName)))
      {
        $image = new Image();
        $image->description = $p_desc;
        $image->originalFilename = $p_filename;
        $image->localFilename = $fullName;
        $image->tags = $p_tags;
      }
      else
      {
        $errorString = $p_filename.' is not an image';
        return false;
      }
  
      $result = $image->AddBulkUpload($p_gallery_id);
  
      if (IsDirectoryEmpty($tmpPath))
      {
        @rmdir($tmpPath);
      }
  
      return $result;
    }
    
    static function ProcessFileFromForm($p_desc, $p_tags, $p_gallery_id)
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
        $image = new Image();
        $image->description = $p_desc;
        $image->originalFilename = $origFilename;
        $image->localFilename = $localFilename;
        $image->tags = $p_tags;
    
        $result = $image->AddSubmitted($p_gallery_id);
        
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
             $result = Image::ProcessNextImageFromTemp($p_desc, $p_tags, $images[0], $p_gallery_id);
          }
        } else
        {
          $errorString .= 'File is not an image or an archive.';
          return false;
        }
      }
  
      /* Send back a list of images */
      return $images;
    }
  
    static function DeleteImageFile($p_image_id, $p_ext)
    {
      global $CFG;
      $filename = $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$p_image_id.".".$p_ext;
      DeleteFile($filename);
    }
  
    static function DeleteThumbFile($p_image_id)
    {
      global $CFG;
      $filename = $CFG["MOA_PATH"].$CFG["THUMB_PATH"].$p_image_id.".jpg";
      DeleteFile($filename);
    }
    
  }

?>