<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  // mod_gallery_funcs.php - This is a collection of functions that interect with the database and a gallery.
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");

  // Structure - Holds information for a single gallery
  class GalleryRecord
  {
  	var $m_id;
  	var $m_parent_id;
  	var $m_name;
  	var $m_description;
  	var $m_usetags;
  }
  
  class Gallery
  {
    // Function to return query that will return all gallery images meeting
    // given condition and record order.
    public function buildContentQuery($p_fields, $p_condition, $p_order_by = "")
    {
    	global $CFG;
    
    	$query = "SELECT ".$p_fields."
                    FROM `".$CFG["tab_prefix"]."imagetaglink`   AS ImgTagLinks,
                         `".$CFG["tab_prefix"]."gallerytaglink` AS GalTagLinks,
                         `".$CFG["tab_prefix"]."image`,
                         `".$CFG["tab_prefix"]."gallery`
                   WHERE ImgTagLinks.IDTag     = GalTagLinks.IDTag
                     AND ImgTagLinks.IDImage   = `".$CFG["tab_prefix"]."image`.IDImage
                     AND GalTagLinks.IDGallery = `".$CFG["tab_prefix"]."gallery`.IDGallery
                     AND (".$p_condition.")
                   GROUP BY `".$CFG["tab_prefix"]."gallery`.IDGallery, ImgTagLinks.IDimage, `".$CFG["tab_prefix"]."image`.Description
                  HAVING COUNT(ImgTagLinks.IDTag) = (SELECT COUNT(GalTagLinks2.IDTag)
                                                       FROM `".$CFG["tab_prefix"]."gallerytaglink` AS GalTagLinks2
                                                      WHERE GalTagLinks2.IDGallery = `".$CFG["tab_prefix"]."gallery`.IDGallery)";
    
    	if (0 != strlen($p_order_by)) {
    		$query .= " ORDER BY ".$p_order_by;
    	}
    
    	return $query;
    }
    
    // Checks on database that a gallery exists for the given p_id.
    public function exists($p_id)
    {
    	global $errorString;
    	global $CFG;
    
    	$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    
    	if ((false === $result) || (0 == mysql_num_rows($result))) {
    		return false;
    	}
    	return true;
    }
    
    // Changes the value of field named by $field to $value for gallery identified by $p_id.
    public function changeValue($p_id, $p_field, $p_value)
    {
    	global $errorString;
    	global $CFG;
    
    	$query = "UPDATE `".$CFG["tab_prefix"]."gallery` SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    	return true;
    }
    
    // Changes the value of all fields for gallery identified by $p_id.
    public function edit($p_id, $p_name, $p_desc, $p_pid, $p_tags, $p_tagged)
    {
    	global $errorString;
    	global $CFG;
    
    	$tagged_val = 1;
    	if (0 == strcmp($p_tagged, "true"))
    	{
    	  $tagged_val = 0;
    	}
    	
    	$query = "UPDATE `".$CFG["tab_prefix"]."gallery` SET Name = _utf8'".mysql_real_escape_string($p_name)."', Description = _utf8'".mysql_real_escape_string($p_desc)."', IDParent = '".mysql_real_escape_string($p_pid)."', UseTags = _utf8'".$tagged_val."' WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	$query = "DELETE FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDGallery='".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	$Tag = new Tag();
    	$Tag->linkTagsToGallery($p_id, $p_tags);

      // Add indices to images in this gallery if needed
      if (0 == strcmp($p_tagged, "true"))
      {
        $query = "DELETE FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result) {
          return false;
        }
        AddTaggedImagesToGallery($p_id);
      }
    	
    	return true;
    }
    
    // Adds a new gallery based on passed in fields values.
    public function add($p_name, $p_desc, $p_parentid, $p_tags, $p_tagged)
    {
    	global $errorString;
    	global $CFG;
    
      $tagged_val = 1;
    	if (0 == strcmp($p_tagged, "true"))
    	{
    	  $tagged_val = 0;
    	}
    	
    	$query = "INSERT INTO `".$CFG["tab_prefix"]."gallery` (Name, Description, IDParent, UseTags) VALUES (_utf8'".mysql_real_escape_string($p_name)."', _utf8'".mysql_real_escape_string($p_desc)."', '".mysql_real_escape_string($p_parentid)."', _utf8'".$tagged_val."' );";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    	$newid = mysql_insert_id();
    	$id = sprintf("%010s", $newid);
    
    	// Add gallery-tag links
    	$Tag = new Tag();
    	$Tag->linkTagsToGallery($newid, $p_tags);
    	
    	// Add indices to images in this gallery
      if (0 == strcmp($p_tagged, "true"))
      {
        AddTaggedImagesToGallery($newid);
      }
    	
    	return $newid;
    }
    
    // Returns the value of field named by $field for gallery specified by $p_id.
    public function getValue($p_id, $p_field )
    {
    	global $errorString;
    	global $CFG;
    
    	$query = "SELECT `".mysql_real_escape_string($p_field)."` FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
        echo $errorString;
    		return false;
    	}
    
    	$row = mysql_fetch_array($result);
    	return $row[$p_field];
    }
    
    // Returns the values of all gallery fields for gallery specified by $p_id.
    public function getAllValues($p_id)
    {
    	global $errorString;
    	global $CFG;
    
    	$query = "SELECT * FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	$row = mysql_fetch_array($result);
    
    	$gallery = new GalleryRecord;
    	$gallery->m_id          = $p_id;
    	$gallery->m_name        = $row["Name"];
    	$gallery->m_description = $row["Description"];
    	$gallery->m_parent_id   = $row["IDParent"];
    
    	return $gallery;
    }
    
    // Returns a list of galleries where IDParent is specified by $p_id.
    public function getSubGalleries($p_id)
    {
    	global $errorString;
    	global $CFG;
    
    	$query = "SELECT * FROM `".$CFG["tab_prefix"]."gallery` WHERE IDParent = '".mysql_real_escape_string($p_id)."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	$sub_galleries = array();
    
    	while ($row = mysql_fetch_array($result))
    	{
    		$gallery = new GalleryRecord;
    		$gallery->m_id          = $row["IDGallery"];
    		$gallery->m_name        = $row["Name"];
    		$gallery->m_description = $row["Description"];
    		$gallery->m_parent_id   = $p_id;
    
    		$sub_galleries[] = $gallery;
    	}
    
    	return $sub_galleries;
    }
    
    // Returns a list of images where tag match those of the gallery specified by $p_id
    public function getImages($p_id, $p_page = 0)
    {
    	global $errorString;
    	global $CFG;
    	$useTags = false;
    	$images = array();
    
      $limits = "";    	
    	if (0 != $p_page)
    	{
    	  $number = $CFG['IMAGES_PER_PAGE'];
    	  $start = ($p_page - 1) * $number;
    	  
    	  $limits = ' LIMIT '.$start.', '.$number;
    	}
    	
  	  $query = "SELECT `IDImage` FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDGallery = '".mysql_real_escape_string($p_id)."' ORDER BY Seq".$limits;
    
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	$images = array();
    
    	while ($row = mysql_fetch_array($result))
    	{
    		$image = new Image;
    		$image->loadId($row["IDImage"]);
    
    		$images[] = $image;
    	}
      	
    	return $images;
    }
    
    // Returns the ID of the first image in this gallery.
    public function getThumbNail($p_id)
    {
    	global $CFG;
    
    	//$query = $this->buildContentQuery( "`".$CFG["tab_prefix"]."image`.IDImage"
    	//, "`".$CFG["tab_prefix"]."gallery`.IDGallery = '".mysql_real_escape_string($p_id)."'");
    	$query = "SELECT IDImage FROM `".$CFG["tab_prefix"]."galleryindex` 
    	          WHERE IDGallery = '".mysql_real_escape_string($p_id)."' ORDER BY Seq LIMIT 1";
    
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	$image = mysql_fetch_array($result);
    	if (false === $image)
    	{
    	  $Gallery = new Gallery();
    		if (0 < $Gallery->getSubGalleryCount($p_id))
    		{
    			$sub_galleries = $Gallery->getSubGalleries( $p_id);
    
    			foreach ($sub_galleries as $sub_gallery)
    			{
    				$found = $Gallery->getThumbNail($sub_gallery->m_id);
    				if (!is_bool($found))
    				{
    					return $found;
    				}
    			}
    		}
    
    		return false;
    	}
    	return $image["IDImage"];
    }
    
    // Returns the number of images in this gallery.
    public function getImageCount($p_id)
    {
    	global $CFG;
    
    	$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."galleryindex` 
    	          WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
    
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	return mysql_num_rows($result);
    }
    
    // Returns the number of sub-galleries of this gallery.
    public function getSubGalleryCount($p_id)
    {
    	global $CFG;
    
    	$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."gallery` WHERE IDParent = '".mysql_real_escape_string($p_id)."';";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result)
    	{
    		return false;
    	}
    
    	return mysql_num_rows($result);
    }
    
    // Deletes the gallery indentified by $id.
    public function delete($p_id)
    {
    	global $errorString;
    	global $CFG;
    
    	$query_safe_id = mysql_real_escape_string($p_id);
    
    	$query = "DELETE FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDGallery = '".$query_safe_id."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	$query = "SELECT IDParent FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".$query_safe_id."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	$row = mysql_fetch_array($result);
    
    	$query = "UPDATE `".$CFG["tab_prefix"]."gallery` SET IDParent = '".$row["IDParent"]."' WHERE IDParent = '".$query_safe_id."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	$query = "DELETE FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".$query_safe_id."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    	
      $query = "DELETE FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDGallery = '".$query_safe_id."'";
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	return true;
    }
    
    // Returns list of tags for gallery identified by $id
    public function getTagObjectArray($p_id)
    {
    	global $CFG;
    
    	$query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
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
    
    public function getNextImage($p_gallery_id, $p_image_id)
    {
    	global $CFG;
    
    	// Get just the first ID out of the next images in the same gallery
    	$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	         'WHERE IDGallery = '.$p_gallery_id.' AND Seq > (SELECT Seq FROM '.
    	         '`'.$CFG["tab_prefix"].'galleryindex` WHERE '.
    	         'IDImage = '.$p_image_id.' AND IDGallery = '.$p_gallery_id.') ORDER BY Seq ASC LIMIT 1';
    	
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	// Check for the end of the gallery
    	$found = mysql_num_rows($result);
    	if (0 == $found)
    	{
    		$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	         'WHERE IDGallery = '.$p_gallery_id.' ORDER BY Seq ASC LIMIT 1';
    
    		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    		if (false === $result) {
    			return false;
    		}
    	}
    
    	$row = mysql_fetch_array($result);
    	return $row["IDImage"];
    }
    
    public function getPreviousImage($p_gallery_id, $p_image_id)
    {
    	global $CFG;
    
    	// Get just the first ID out of the previous images in the same gallery
    	$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	         'WHERE IDGallery = '.$p_gallery_id.' AND Seq < (SELECT Seq FROM '.
    	         '`'.$CFG["tab_prefix"].'galleryindex` WHERE '.
    	         'IDImage = '.$p_image_id.' AND IDGallery = '.$p_gallery_id.') ORDER BY Seq DESC LIMIT 1';
    
    	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	if (false === $result) {
    		return false;
    	}
    
    	// Check for the start of the gallery
    	$found = mysql_num_rows($result);
    	if (0 == $found)
    	{
    		// Get just the first ID out of the next images in the same gallery
    		$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	         'WHERE IDGallery = '.$p_gallery_id.' ORDER BY Seq DESC LIMIT 1';
    
    		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    		if (false === $result) {
    			return false;
    		}
    	}
    
    	$row = mysql_fetch_array($result);
    	return $row["IDImage"];
    }
    
    public function makeHtmlOptionsFromGalleryNames($p_id = '0000000000')
		{
			global $CFG;					
			
		  $optionEntry = '';
		  $optionHtml = '';
		   
		  $query = 'SELECT * FROM '.$CFG['tab_prefix'].'gallery;';
		  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
		  while ($gallery = mysql_fetch_array($result))
		  {
		    $optionEntry = '  <option value="'.html_display_safe($gallery['IDGallery']).'"';
		    if (0 == strcmp($p_id, $gallery['IDGallery']))
		    {
		      $optionEntry .= 'selected="selected"';
		    }
		    $optionEntry .= '>'.html_display_safe($gallery['Name'])."</option>\n";
		    $optionHtml .= $optionEntry;
		  }
		  
		  return $optionHtml;
		}
  }
  
  function DoesGalleryUseTags($p_gallery_id)
  {
    global $CFG;

    $query = "SELECT UseTags FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".TypeSafeMysqlRealEscapeString($p_gallery_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);

    if (0 == $row['UseTags'])
    {
      return true;
    }
    
    return false;
  }
  
  function AddImageToGalleryIndex($p_gallery_id, $p_image_id)
  {
    global $CFG;

    // Find highest sequence number for the gallery 
    $query = "SELECT Seq FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDGallery = '".TypeSafeMysqlRealEscapeString($p_gallery_id)."' ORDER BY Seq DESC LIMIT 1";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);
    $high = $row['Seq'];
    $high++;
    
    // Add new image
    $query = "INSERT INTO `".$CFG["tab_prefix"]."galleryindex` (IDGallery, IDImage, Seq) VALUES ('".TypeSafeMysqlRealEscapeString($p_gallery_id)."', '".TypeSafeMysqlRealEscapeString($p_image_id)."', ".$high.")";

    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }
  }
  
  function AddOrderedImageToGalleryIndex($p_gallery_id, $p_image_id, $p_seq)
  {
    global $CFG;

    // Add new image
    $query = "INSERT INTO `".$CFG["tab_prefix"]."galleryindex` (IDGallery, IDImage, Seq) VALUES ('".TypeSafeMysqlRealEscapeString($p_gallery_id)."', '".TypeSafeMysqlRealEscapeString($p_image_id)."', ".$p_seq.")";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }
  }
  
  function AddImageToTaggedGalleries($p_image_id)
  {
    global $CFG;
    global $ErrorString; 
    
    $gal = new Gallery;
    $query = $gal->buildContentQuery( "`".$CFG["tab_prefix"]."gallery`.IDGallery",
               "`".$CFG["tab_prefix"]."image`.IDImage = '".mysql_real_escape_string($p_image_id)."') AND (`".$CFG["tab_prefix"]."gallery`.UseTags = '0'");
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  	if (false === $result)
  	{
  		return false;
  	}

  	while ($row = mysql_fetch_array($result))
  	{
  	  AddImageToGalleryIndex($row['IDGallery'], $p_image_id);
  	}
  }
  
  function AddTaggedImagesToGallery($p_gallery_id)
  {
    global $CFG;
    global $ErrorString; 
    
    $gal = new Gallery;
    $query = $gal->buildContentQuery( "`".$CFG["tab_prefix"]."image`.IDImage",
                                        "`".$CFG["tab_prefix"]."gallery`.IDGallery = '".mysql_real_escape_string($p_gallery_id)."'");
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  	if (false === $result)
  	{
  		return false;
  	}

  	$seq = 0;
  	
  	$query = "START TRANSACTION;";
    mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  	
  	while ($row = mysql_fetch_array($result))
  	{
  	  AddOrderedImageToGalleryIndex($p_gallery_id, $row['IDImage'], $seq);
  	  $seq++;
  	}
  	
  	$query = "COMMIT;";
    mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  }
  
  function GetImageGalleriesFromTags($p_image_id)
  {
    global $CFG;
    global $ErrorString; 
    
    $gal = new Gallery;
    $query = $gal->buildContentQuery( "`".$CFG["tab_prefix"]."gallery`.IDGallery",
               "`".$CFG["tab_prefix"]."image`.IDImage = '".mysql_real_escape_string($p_image_id)."') AND (`".$CFG["tab_prefix"]."gallery`.UseTags = '0'");
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  	if (false === $result)
  	{
  		return false;
  	}

  	$galleries = Array();
  	
  	while ($row = mysql_fetch_array($result))
  	{
  	  $galleries[$row['IDGallery']] = $row['IDGallery'];
  	}
  	
  	return $galleries;
  }
?>
