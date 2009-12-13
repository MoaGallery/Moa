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

  /*
   Holds information for a single image
  */
  class Image{
  	var $m_id;
  	var $m_description;
  	var $m_height;
  	var $m_width;
  };

  /*
   Checks on database that a image exists for the given id.
  */
  function _ImageExists($p_id) {
    global $ErrorString;
    global $CFG;

  	$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
  	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

  	if ((false === $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    return true;
  };

  /*
   Changes the value of field named by $field to $value for image identified by $id.
  */
  function _ImageChangeValue($p_id, $p_field, $p_value) {
  	global $ErrorString;
  	global $CFG;

  	$query = "UPDATE `".$CFG["tab_prefix"]."image` SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDImage = '".$p_id."'";
  	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  	if (false === $result) {
  	  return false;
  	}
  	return true;
  };

  /*
    Changes the value of all fields for image identified by $id.
  */
  function _ImageEdit($p_id, $p_desc, $p_tags) {
    global $ErrorString;
    global $CFG;

    $query = "UPDATE `".$CFG["tab_prefix"]."image` SET Description = _utf8'".mysql_real_escape_string($p_desc)."' WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage='".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $alltags = _TagGetTags();
    $taglist = explode($CFG["STR_DELIMITER"], $p_tags);

    foreach ($taglist as $newtag)
    {
      $newtag = trim($newtag);
      if (0 != strlen($newtag))
      {
        $found = false;
        foreach ($alltags as $oldtag)
        {
          if (0 == strcmp(strtolower($oldtag->m_name), strtolower($newtag)))
          {
            // Tag already exists, just create the link
            $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".mysql_real_escape_string($p_id)."', '".$oldtag->m_id."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            $found = true;
          }
        }
        if (!$found)
        {
          // Add as a new tag
          $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($newtag)."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
          // Get the new ID
          $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name='".mysql_real_escape_string($newtag)."'";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
          $row = mysql_fetch_array($result);
          $newid = $row["IDTag"];
          // Make the link
          $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".mysql_real_escape_string($p_id)."', '".$newid."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
        }
      }
    }

    return true;
  };

  /*
    Add a new image.
  */
  function _ImageAdd($p_desc, $p_tags) {
    global $ErrorString;
    global $CFG;

    if (!CheckImageMemory($_FILES["filename"]["tmp_name"]))
    {
      return false;
    }

    // Try loading it as a jpeg
    $src_img = @imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);
    $src_fmt = "jpg";

    // Didn't load, try it as PNG
    if (!$src_img)
    {
      $src_img = @imagecreatefrompng($_FILES["filename"]["tmp_name"]);
      $src_fmt = "png";
    }

    // Didn't load, try it as GIF
    if (!$src_img)
    {
      $src_img = @imagecreatefromgif($_FILES["filename"]["tmp_name"]);
      $src_fmt = "gif";
    }

    // Didn't load, fail
    if (!$src_img)
    {
      return false;
    }

    $new_desc = mysql_real_escape_string($p_desc);
    $new_filename = mysql_real_escape_string($_FILES["filename"]["name"]);
    $origw=imagesx($src_img);
    $origh=imagesy($src_img);
    imagedestroy($src_img);

    $query = "INSERT INTO `".$CFG["tab_prefix"]."image` (Filename, Width, Height, Description, Format) VALUES(_utf8'".$new_filename."', '".$origw."', '".$origh."', _utf8'".$new_desc."', _utf8'".$src_fmt."');";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }
    $id = mysql_insert_id();

    $alltags = _TagGetTags();
    $taglist = explode($CFG["STR_DELIMITER"], $p_tags);

    foreach ($taglist as $newtag)
    {
      $newtag = trim($newtag);
      if (0 != strlen($newtag))
      {
        $found = false;
        foreach ($alltags as $oldtag)
        {
          if (0 == strcmp(strtolower($oldtag->m_name), strtolower($newtag)))
          {
            // Tag already exists, just create the link
            $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".$id."', '".$oldtag->m_id."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false === $result) {
              return false;
            }
            $found = true;
          }
        }
        if (!$found)
        {
          // Add as a new tag
          $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($newtag)."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
          // Get the new ID
          $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name='".mysql_real_escape_string($newtag)."'";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
          $row = mysql_fetch_array($result);
          $newid = $row["IDTag"];
          // Make the link
          $query = "INSERT INTO `".$CFG["tab_prefix"]."imagetaglink` (IDImage, IDTag) VALUES ('".$id."', '".$newid."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false === $result) {
            return false;
          }
        }
      }
    }

    $new_filename = sprintf("%010s",$id);

    move_uploaded_file( $_FILES["filename"]["tmp_name"]       // source file
                      , "../".$CFG["IMAGE_PATH"].$new_filename.".".$src_fmt); // dest file

    thumbnail( $new_filename, $src_fmt, false);

    return $_FILES["filename"]["name"];
  };

  /*
    Returns the value of field named by $field for image specified by $id.
  */
  function _ImageGetValue($p_id, $p_field ) {
    global $ErrorString;
    global $CFG;

    $query = "SELECT ".TypeSafeMysqlRealEscapeString($p_field)." FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);
    return $row[$p_field];
  };

  /*
    Returns the values of all image fields for image specified by $id.
  */
  function _ImageGetAllValues($p_id) {
    global $ErrorString;
    global $CFG;

    $query = "SELECT * FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);

    $image = new Image;
    $image->m_id          = $p_id;
    $image->m_description = $row["Description"];
    $image->m_height      = $row["Height"];
    $image->m_width       = $row["Width"];

    return $image;
  };

  /*
    Deletes the image indentified by $id.
  */
  function _ImageDelete($p_id) {
    global $ErrorString;
    global $CFG;

    $ext = _ImageGetValue($p_id, "Format");

    $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $query = "DELETE FROM `".$CFG["tab_prefix"]."image` WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    if (file_exists( $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$p_id.".".$ext)) {
      unlink( $CFG["MOA_PATH"].$CFG["IMAGE_PATH"].$p_id.".".$ext);
    }

    if (file_exists( $CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$p_id.".jpg")) {
      unlink( $CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$p_id.".jpg");
    }

    return true;
  };

  /*
    Returns list of tags for image identified by $id
  */
  function _ImageGetTagList($p_id) {
    global $CFG;

    $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
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
?>