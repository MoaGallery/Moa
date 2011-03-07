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
    var $m_id;
    var $m_name;
  }

  class Tag
  {
    function exists($p_id)
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

    function lookup($p_name)
    {
      global $errorString;
      global $CFG;

      $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name = '".mysql_real_escape_string($p_name)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

      if ((false === $result) || (0 == mysql_num_rows($result))) {
        return false;
      }
      $row = mysql_fetch_array($result);
      return $row["IDTag"];
    }

    function changeValue($p_id, $p_field, $p_value)
    {
      global $errorString;
      global $CFG;

      $query = "UPDATE `".$CFG["tab_prefix"]."tag` SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDTag = '".$p_id."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
      return true;
    }

    function getValue($p_id, $p_field )
    {
      global $errorString;
      global $CFG;

      $query = "SELECT ".mysql_real_escape_string($p_field)." FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $row = mysql_fetch_array($result);
      return $row[$p_field];
    }

    function getAllValues($p_id)
    {
      global $errorString;
      global $CFG;

      $query = "SELECT * FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      $row = mysql_fetch_array($result);

      $tag = new TagRecord;
      $tag->m_id          = $p_id;
      $tag->m_name        = $row["Name"];

      return $tag;
    }

    function getTags()
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
        $tag->m_id   = $row["IDTag"];
        $tag->m_name = $row["Name"];

        $tags[] = $tag;
      }

      return $tags;
    }

    function getTagStringForGallery($p_gallery_id)
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

    function delete($p_id)
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
    	
    	  AddTaggedImagesToGallery($row['IDGallery']);
    	}

      return true;
    }

    function add($p_name)
    {
      global $errorString;
      global $CFG;

      $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($p_name)."')";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }

      return sprintf("%010s",mysql_insert_id());
    }

    function linkTagsToImage($p_image_id, $p_tags)
    {
      global $CFG;

      $currentTags = $this->getTags();
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
            if ((0 == strcmp(strtolower($tagExisting->m_name), strtolower($tag))) &&
                (!$tagFound))
            {
              // Tag already exists, just create the link
              
              // Create the link if we haven't in this string already
              if (!array_key_exists($tag, $added))
              {
                $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".$p_image_id."', '".$tagExisting->m_id."')";
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
            $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name='".mysql_real_escape_string($tag)."'";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            $row = mysql_fetch_array($result);
            $tagID = $row["IDTag"];
            // Make the link
            $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".$p_image_id."', '".$tagID."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            // Add the tag to the internal list to avoid duplicates in the string being added
            $addedTag = new TagRecord;
            $addedTag->m_id   = $tagID;
            $addedTag->m_name = $tag;
    
            $currentTags[] = $addedTag;
          }
          // Mark this tag as added for this string.
          $added[$tag] = true;
        }
      }
    }

    function linkTagsToGallery($p_gallery_id, $p_tags)
    {
      global $CFG;

      $currentTags = $this->getTags();
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
            if ((0 == strcmp(strtolower($tagExisting->m_name), strtolower($tag))) &&
                (!$tagFound))
            {
              // Tag already exists
              
              // Create the link if we haven't in this string already
              if (!array_key_exists($tag, $added))
              {
                $query = "INSERT INTO `".$CFG["tab_prefix"]."gallerytaglink` (IDGallery, IDTag) VALUES ('".$p_gallery_id."', '".$tagExisting->m_id."')";
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
            $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name='".mysql_real_escape_string($tag)."'";
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
            $addedTag->m_id   = $tagID;
            $addedTag->m_name = $tag;
    
            $currentTags[] = $addedTag;
          }
          // Mark this tag as added for this string.
          $added[$tag] = true;
        }
      }
    }
  }
?>
