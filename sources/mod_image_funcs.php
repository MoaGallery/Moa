<?php
  /* mod_image_funcs.php
   This is a collection of functions that interect with the database and a image.
  */
  include_once($MOA_PATH."sources/_error_funcs.php");
  include_once($MOA_PATH."sources/_db_funcs.php");
  include_once($MOA_PATH."sources/mod_tag_funcs.php");

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
    global $tab_prefix;

  	$query = "SELECT 1 FROM ".$tab_prefix."image WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
  	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

  	if ((false == $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    return true;
  };

  /*
   Changes the value of field named by $field to $value for image identified by $id.
  */
  function _ImageChangeValue($p_id, $p_field, $p_value) {
  	global $ErrorString;
  	global $tab_prefix;

  	$query = "UPDATE ".$tab_prefix."image SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDImage = '".$p_id."'";
  	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  	if (false == $result) {
  	  return false;
  	}
  	return true;
  };

  /*
    Changes the value of all fields for image identified by $id.
  */
  function _ImageEdit($p_id, $p_desc, $p_tags) {
    global $ErrorString;
    global $tab_prefix;
    global $STR_DELIMITER;

    $query = "UPDATE ".$tab_prefix."image SET Description = _utf8'".mysql_real_escape_string($p_desc)."' WHERE IDImage = ".mysql_real_escape_string($p_id);
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $query = "DELETE FROM ".$tab_prefix."imagetaglink WHERE IDImage='".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $alltags = _TagGetTags();
    $taglist = explode($STR_DELIMITER, $p_tags);

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
            $query = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) VALUES ('".mysql_real_escape_string($p_id)."', '".$oldtag->m_id."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false == $result) {
              return false;
            }
            $found = true;
          }
        }
        if (!$found)
        {
          // Add as a new tag
          $query = "INSERT INTO ".$tab_prefix."tag (Name) VALUES (_utf8'".mysql_real_escape_string($newtag)."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false == $result) {
            return false;
          }
          // Get the new ID
          $query = "SELECT IDTag FROM ".$tab_prefix."tag WHERE Name='".mysql_real_escape_string($newtag)."'";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false == $result) {
            return false;
          }
          $row = mysql_fetch_array($result);
          $newid = $row["IDTag"];
          // Make the link
          $query = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) VALUES ('".mysql_real_escape_string($p_id)."', '".$newid."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false == $result) {
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
    global $tab_prefix;
    global $STR_DELIMITER;
    global $IMAGE_PATH;

    if (!CheckImageMemory($_FILES["filename"]["tmp_name"]))
    {
      return false;
    }

    //var_dump($result);
    $src_img = @imagecreatefromjpeg($_FILES["filename"]["tmp_name"]);

    $new_desc = mysql_real_escape_string($p_desc);
    $new_filename = mysql_real_escape_string($_FILES["filename"]["name"]);
    $origw=imagesx($src_img);
    $origh=imagesy($src_img);
    imagedestroy($src_img);

    $query = "INSERT INTO ".$tab_prefix."image (Filename, Width, Height, Description) VALUES(_utf8'".$new_filename."', '".$origw."', '".$origh."', _utf8'".$new_desc."');";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }
    $id = mysql_insert_id();

    $alltags = _TagGetTags();
    $taglist = explode($STR_DELIMITER, $p_tags);

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
            $query = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) VALUES ('".$id."', '".$oldtag->m_id."')";
            $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
            if (false == $result) {
              return false;
            }
            $found = true;
          }
        }
        if (!$found)
        {
          // Add as a new tag
          $query = "INSERT INTO ".$tab_prefix."tag (Name) VALUES (_utf8'".mysql_real_escape_string($newtag)."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false == $result) {
            return false;
          }
          // Get the new ID
          $query = "SELECT IDTag FROM ".$tab_prefix."tag WHERE Name='".mysql_real_escape_string($newtag)."'";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false == $result) {
            return false;
          }
          $row = mysql_fetch_array($result);
          $newid = $row["IDTag"];
          // Make the link
          $query = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) VALUES ('".$id."', '".$newid."')";
          $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
          if (false == $result) {
            return false;
          }
        }
      }
    }

    $new_filename = sprintf("%010s.jpg",$id);

    move_uploaded_file( $_FILES["filename"]["tmp_name"]       // source file
                      , "../".$IMAGE_PATH."/".$new_filename); // dest file

    thumbnail( $new_filename, "jpeg", false);

    return $_FILES["filename"]["name"];
  };

  /*
    Returns the value of field named by $field for image specified by $id.
  */
  function _ImageGetValue($p_id, $p_field ) {
    global $ErrorString;
    global $tab_prefix;

    $query = "SELECT ".TypeSafeMysqlRealEscapeString($p_field)." FROM ".$tab_prefix."image WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
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
    global $tab_prefix;

    $query = "SELECT * FROM ".$tab_prefix."image WHERE IDImage = '".TypeSafeMysqlRealEscapeString($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
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
    global $tab_prefix;
    global $IMAGE_PATH;
    global $THUMB_PATH;
    global $MOA_PATH;

    $query = "DELETE FROM ".$tab_prefix."imagetaglink WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $query = "DELETE FROM ".$tab_prefix."image WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    if (file_exists( $MOA_PATH.$IMAGE_PATH."/".$p_id.".jpg")) {
      unlink( $MOA_PATH.$IMAGE_PATH."/".$p_id.".jpg");
    }

    if (file_exists( $MOA_PATH.$THUMB_PATH."/thumb_".$p_id.".jpg")) {
      unlink( $MOA_PATH.$THUMB_PATH."/thumb_".$p_id.".jpg");
    }

    return true;
  };

  /*
    Returns list of tags for image identified by $id
  */
  function _ImageGetTagList($p_id) {
    global $tab_prefix;

    $query = "SELECT IDTag FROM ".$tab_prefix."imagetaglink WHERE IDImage = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $tags = array();

    while (false != ($row = mysql_fetch_array($result))) {
      $tags[] = $row["IDTag"];
    }

    return $tags;
  }
?>