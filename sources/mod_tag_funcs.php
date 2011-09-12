<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  /* mod_tag_funcs.php
   This is a collection of functions that interect with the database and a tag.
  */
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");

  //  Structure for a single tag
  class TagRecord
  {
    public $id;
    public $name;
  }

  class Tag
  {
    public $id;
    public $name;
    
    private $DBValues;               // The version of data held in the database
    
    function __construct($p_tag_id = NULL)
    {
      global $CFG;
  	  
  	  // Set defaults
  	  $this->id = (int)$p_tag_id;
  	  $this->name = '';
  	  
  	  $this->DBValues = new TagRecord();
  	  $this->DBValues->id = $this->id;
  	  $this->DBValues->name = $this->name;

  	  // Attempt to load it if an ID has been supplied
  	  if (NULL !== $p_tag_id)
  	  {
  	    $query = "SELECT * FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($this->id)."'";
      	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      	if (false !== $result)
      	{
        	$row = mysql_fetch_array($result);
        
        	$this->name        = $row['Name'];
        	
      	  $this->DBValues->name = $this->name;
      	}
  	  }
    }

    public function Commit()
    {
      global $CFG;

      if (NULL == $this->id)
      {
        $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($this->name)."')";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result) {
          return false;
        }
        $ret = str_pad(mysql_insert_id(), 10, '0', STR_PAD_LEFT);
        
      } else 
      {
        $query = "UPDATE `".$CFG["tab_prefix"]."tag` SET Name = _utf8'".mysql_real_escape_string($this->name)."' WHERE IDTag = '".$this->id."'";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result) {
          return false;
        }
        $ret = $this->id;
      }
    
      return $ret;
    }
    
    static function Exists($p_id)
    {
      global $errorString;
      global $CFG;

      $query = "SELECT 1 FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

      if ((false === $result) || (0 == mysql_num_rows($result))) {
        return false;
      }
      return true;
    }

    static function Lookup($p_name)
    {
      global $errorString;
      global $CFG;

      $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name = _utf8'".mysql_real_escape_string($p_name)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

      if ((false === $result) || (0 == mysql_num_rows($result))) {
        return false;
      }
      $row = mysql_fetch_array($result);
      return $row["IDTag"];
    }

    static function GetTags()
    {
      global $errorString;
      global $CFG;

      $query = "SELECT * FROM `".$CFG["tab_prefix"]."tag`;";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $tags = array();

      while ($row = mysql_fetch_array($result)) {
        $tag = new TagRecord;
        $tag->id   = $row["IDTag"];
        $tag->name = $row["Name"];

        $tags[] = $tag;
      }

      return $tags;
    }
    
    static function GetTagListForImage($p_image_id)
    {
      global $errorString;
      global $CFG;

      $query = "SELECT Name FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag IN "
              ."(SELECT IDTag FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."');";

      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $tags = array();

      while ($row = mysql_fetch_array($result))
      {
      	$tags[] = $row["Name"];
      }

      return $tags;
    }

    static function Delete($p_id)
    {
      global $errorString;
      global $CFG;

      $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $query = "DELETE FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $query = "DELETE FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      
      // Update indices
      $query = "SELECT IDGallery FROM `".$CFG['tab_prefix']."gallery` WHERE UseTags = 0";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
  
    	while ($row = mysql_fetch_array($result))
    	{
      	$query = "DELETE FROM `".$CFG['tab_prefix']."galleryindex` WHERE IDGallery = '".$row['IDGallery']."'";
        $result2 = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      	if (false === $result2)
      	{
      		return false;
      	}
    	
    	  Gallery::AddTaggedImages($row['IDGallery']);
    	}

      return true;
    }

    static function LinkTagsToImage($p_image_id, $p_tags)
    {
      global $CFG;

      $currentTags = Tag::GetTags();
      $imageTags = explode($CFG["STR_DELIMITER"], $p_tags);
      $added = Array();

      foreach ($imageTags as $tag)
      {
        $tag = trim($tag);
        if (0 != strlen($tag))
        {
          $tagFound = false;
          foreach ($currentTags as $tagExisting)
          {
            if ((0 == strcmp(strtolower($tagExisting->name), strtolower($tag))) &&
                (!$tagFound))
            {
              // Tag already exists, just create the link
              
              // Create the link if we haven't in this string already
              if (!array_key_exists($tag, $added))
              {
                $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".$p_image_id."', '".$tagExisting->id."')";
                $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
                if (false === $result) {
                  return false;
                }
              }
              $tagFound = true;
            }
          }
          if (!$tagFound)
          {
            // Add as a new tag
            $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($tag)."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            $tagID = mysql_insert_id();

            // Make the link
            $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".$p_image_id."', '".$tagID."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            // Add the tag to the internal list to avoid duplicates in the string being added
            $addedTag = new TagRecord;
            $addedTag->id   = $tagID;
            $addedTag->name = $tag;
    
            $currentTags[] = $addedTag;
          }
          // Mark this tag as added for this string.
          $added[$tag] = true;
        }
      }
    }

    static function LinkTagsToGallery($p_gallery_id, $p_tags)
    {
      global $CFG;

      $currentTags = Tag::GetTags();
      $galleryTags = explode($CFG["STR_DELIMITER"], $p_tags);
      $added = Array();

      foreach ($galleryTags as $tag)
      {
        $tag = trim($tag);
        if (0 != strlen($tag))
        {
          $tagFound = false;
          foreach ($currentTags as $tagExisting)
          {
            if ((0 == strcmp(strtolower($tagExisting->name), strtolower($tag))) &&
                (!$tagFound))
            {
              // Tag already exists
              
              // Create the link if we haven't in this string already
              if (!array_key_exists($tag, $added))
              {
                $query = "INSERT INTO `".$CFG["tab_prefix"]."gallerytaglink` (IDGallery, IDTag) VALUES ('".$p_gallery_id."', '".$tagExisting->id."')";
                $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
                if (false === $result) {
                  return false;
                }
              }
              $tagFound = true;
            }
          }
          if (!$tagFound)
          {
            // Add as a new tag
            $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($tag)."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            // Get the new ID
            $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name=_utf8'".mysql_real_escape_string($tag)."'";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            $row = mysql_fetch_array($result);
            $tagID = $row["IDTag"];
            // Make the link
            $query = "INSERT INTO `".$CFG["tab_prefix"]."gallerytaglink` (IDGallery, IDTag) VALUES ('".$p_gallery_id."', '".$tagID."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            // Add the tag to the internal list to avoid duplicates in the string being added
            $addedTag = new TagRecord;
            $addedTag->id   = $tagID;
            $addedTag->name = $tag;
    
            $currentTags[] = $addedTag;
          }
          // Mark this tag as added for this string.
          $added[$tag] = true;
        }
      }
    }
  
    static function GetTagIDsForGallery($p_gallery_id)
    {
    	global $CFG;
    
    	$query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDGallery = '".mysql_real_escape_string($p_gallery_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	$tags = array();
    
    	while (false !== ($row = mysql_fetch_array($result)))
    	{
    		$tags[] = $row["IDTag"];
    	}
    
    	return $tags;
    }
    
    static function GetTagIDsForImage($p_image_id)
    {
    	global $CFG;
    
    	$query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	$tags = array();
    
    	while (false !== ($row = mysql_fetch_array($result)))
    	{
    		$tags[] = $row["IDTag"];
    	}
    
    	return $tags;
    }
    
    static function GetTagStringForGallery($p_gallery_id)
    {
      global $errorString;
      global $CFG;
  
      $query = "SELECT Name FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag IN "
              ."(SELECT IDTag FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDGallery = '".mysql_real_escape_string($p_gallery_id)."');";
  
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
  
      $tagString = '';
      $firstTag = true;
  
      while ($row = mysql_fetch_array($result)) {
  
      	if ($firstTag)
      	{
        	$firstTag = false;
        } else
        {
          $tagString .= str_display_safe($CFG["STR_DELIMITER"]);
        }
  
      	$tagString .= $row["Name"];
  
      }
  
      return $tagString;
    }
    
    static function GetTagStringForImage($p_image_id)
    {
      global $errorString;
      global $CFG;
  
      $query = "SELECT Name FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag IN "
              ."(SELECT IDTag FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($p_image_id)."');";
  
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
  
      $tagString = '';
      $firstTag = true;
  
      while ($row = mysql_fetch_array($result)) {
  
      	if ($firstTag)
      	{
        	$firstTag = false;
        } else
        {
          $tagString .= str_display_safe($CFG["STR_DELIMITER"]);
        }
  
      	$tagString .= $row["Name"];
  
      }
  
      return $tagString;
    }
  
  }
  
?>
