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
  public $id;
  public $parent_id;
  public $name;
  public $description;
  public $useTags;
  public $tags;
}

class Gallery
{
  private $DBValues;                 // The version of data held in the database

  public $id;
  public $parent_id;
  public $name;
  public $description;
  public $useTags;
  public $tags;
	 
  public function __construct($p_gallery_id = NULL)
  {
		global $CFG;
			
		// Set defaults
		$this->id = (int)$p_gallery_id;
		$this->parent_id = 0;
		$this->name = '';
		$this->description = '';
		$this->useTags = false;
		$this->tags = '';
			  
		$this->DBValues = new GalleryRecord();
		$this->DBValues->id = $this->id;
		$this->DBValues->parent_id = $this->parent_id;
		$this->DBValues->name = $this->name;
		$this->DBValues->description = $this->description;
		$this->DBValues->useTags = $this->useTags;
		$this->DBValues->tags = $this->tags;

		// Attempt to load it if an ID has been supplied
		if (NULL !== $p_gallery_id)
		{
			$query = "SELECT * FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".mysql_real_escape_string($this->id)."'";
			$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
			if (false !== $result)
			{
				$row = mysql_fetch_array($result);

				$this->name        = $row['Name'];
				$this->description = $row['Description'];
				$this->parent_id   = (integer)$row['IDParent'];
				$this->useTags     = (0 == $row['UseTags']) ? true : false;
				$this->tags        = Tag::GetTagStringForGallery($this->id);
				 
				$this->DBValues->parent_id = $this->parent_id;
				$this->DBValues->name = $this->name;
				$this->DBValues->description = $this->description;
				$this->DBValues->useTags = $this->useTags;
				$this->DBValues->tags = $this->tags;
			} else
			{
			  return NULL;
			}
		}
	}

	public function Commit()
	{
		$changed = false;
		// Check if anything actually needs comitting
		if ((0 != strcmp($this->name, $this->DBValues->name)) ||
		    (0 != strcmp($this->description, $this->DBValues->description)) ||
		    (0 != strcmp($this->tags, $this->DBValues->tags)) ||
		    ($this->parent_id != $this->DBValues->parent_id) ||
		    ($this->useTags != $this->DBValues->useTags) )
		{
			$changed = true;
		}

		// Save it if needed
		if ($changed)
		{
			global $CFG;

			$tagged_val = ($this->useTags) ? 0 : 1;

			// New gallery?
			if (0 === $this->DBValues->id)
			{
			  $query = "INSERT INTO `".$CFG["tab_prefix"]."gallery` (Name, Description, IDParent, UseTags) VALUES (_utf8'".mysql_real_escape_string($this->name)."', _utf8'".mysql_real_escape_string($this->description)."', '".mysql_real_escape_string($this->parent_id)."', '".$tagged_val."')";
			  $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
			  if (false === $result)
			  {
				  return false;
				}

				$this->id = (integer)mysql_insert_id();
			} else // Update an existing gallery
			{
				$query = "UPDATE `".$CFG["tab_prefix"]."gallery` SET Name = _utf8'".mysql_real_escape_string($this->name)."', ".
				                                                    "Description = _utf8'".mysql_real_escape_string($this->description)."', ".
				                                                    "IDParent = '".mysql_real_escape_string($this->parent_id)."', ".
				                                                    "UseTags = '".$tagged_val."' ".
				                                                    "WHERE IDGallery = '".mysql_real_escape_string($this->id)."'";
				$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
				if (false === $result)
				{
					return false;
				}

				$query = "DELETE FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDGallery='".mysql_real_escape_string($this->id)."'";
				$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
				if (false === $result) {
					return false;
				}
			}

			Tag::LinkTagsToGallery($this->id, $this->tags);

			// Add indices to images in this gallery if it is tagged
			if (0 == $tagged_val)
			{
				$query = "DELETE FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDGallery = '".mysql_real_escape_string($this->id)."'";
				$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
				if (false === $result) {
					return false;
				}

				Gallery::AddTaggedImages($this->id);
			}

			// Update local copies
  		$this->DBValues->id = $this->id;
  		$this->DBValues->parent_id = $this->parent_id;
  		$this->DBValues->name = $this->name;
  		$this->DBValues->description = $this->description;
  		$this->DBValues->useTags = $this->useTags;
  		$this->DBValues->tags = $this->tags;  
			
			return true;
		}
	}
	 
	/*
	 * Gallery utility functions
	 */
	 
	static function GetSubGalleries($p_gallery_id)
	{
		global $errorString;
		global $CFG;

		$query = "SELECT IDGallery FROM `".$CFG["tab_prefix"]."gallery` WHERE IDParent = '".mysql_real_escape_string($p_gallery_id)."'";
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result)
		{
			return false;
		}

		$sub_galleries = array();

		while ($row = mysql_fetch_array($result))
		{
			$gallery = new Gallery($row["IDGallery"]);
			$sub_galleries[] = $gallery;
		}

		return $sub_galleries;
	}

	static function ImageCount($p_gallery_id)
	{
		global $CFG;

	  if (($CFG["DISPLAY_PLAIN_SUBGALLERIES"]) &&
		    (0 != Gallery::SubGalleryCount($p_gallery_id)))
		{
		  return 0;
		}
		
		$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."galleryindex`
    	          WHERE IDGallery = '".mysql_real_escape_string($p_gallery_id)."'";

		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result)
		{
			return false;
		}

		return mysql_num_rows($result);
	}

	static function SubGalleryCount($p_gallery_id)
	{
		global $CFG;

		$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."gallery` WHERE IDParent = '".mysql_real_escape_string($p_gallery_id)."';";
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result)
		{
			return false;
		}

		return mysql_num_rows($result);
	}

	static function GetThumbNailID($p_gallery_id)
	{
		global $CFG;

	  if (0 < Gallery::SubGalleryCount($p_gallery_id))
		{
			$sub_galleries = Gallery::GetSubGalleries($p_gallery_id);

			foreach ($sub_galleries as $sub_gallery)
			{
				$found = Gallery::GetThumbNailID($sub_gallery->id);
				if (!is_bool($found))
				{
					return $found;
				}
			}
		} else
		{
  		$query = "SELECT IDImage FROM `".$CFG["tab_prefix"]."galleryindex`
      	          WHERE IDGallery = '".mysql_real_escape_string($p_gallery_id)."' ORDER BY Seq LIMIT 1";
  
  		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  		if (false === $result)
  		{
  			return false;
  		}
  
  		$image = mysql_fetch_array($result);
  		 
  		// If this gallery has no images
  		if (false === $image)
  		{
  			return false;
  		}
  		return $image["IDImage"];
		}
		
		return false;
	}

	static function GetImages($p_gallery_id, $p_page = 0)
	{
		global $errorString;
		global $CFG;
		$useTags = false;
		$images = array();

		if (($CFG["DISPLAY_PLAIN_SUBGALLERIES"]) &&
		    (0 != Gallery::SubGalleryCount($p_gallery_id)))
		{
		  return false;
		}
		
		$limits = "";
		if (0 != $p_page)
		{
		  $totalImages = Gallery::ImageCount($p_gallery_id);
			$imagesPerPage = $CFG['IMAGES_PER_PAGE'];
			$lastPage = ceil($totalImages/$imagesPerPage);
			 
			if ($p_page > $lastPage)
			{
			  $p_page = $lastPage;
			}

			$startImage = ($p_page - 1) * $imagesPerPage;
			
			$limits = ' LIMIT '.$startImage.', '.$imagesPerPage;
		}
		 
		$query = "SELECT `IDImage` FROM `".$CFG["tab_prefix"]."galleryindex` WHERE IDGallery = '".mysql_real_escape_string($p_gallery_id)."' ORDER BY Seq".$limits;

		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result)
		{
			return false;
		}

		$images = array();

		while ($row = mysql_fetch_array($result))
		{
			$image = new Image($row["IDImage"]);

			$images[] = $image;
		}
		 
		return $images;
	}

	// Return a query that will get all gallery images meeting a given condition and record order.
	static function BuildContentQuery($p_fields, $p_condition, $p_order_by = "")
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

	static function Exists($p_gallery_id)
	{
		global $errorString;
		global $CFG;

		$query = "SELECT 1 FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".mysql_real_escape_string($p_gallery_id)."'";
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

		if ((false === $result) || (0 == mysql_num_rows($result))) {
			return false;
		}
		return true;
	}

	// Build an HTML options string of all galleries. The specified gallery will be the default selection.
	static function MakeHtmlOptionsList($p_gallery_id = '0')
	{
		global $CFG;

		$optionEntry = '';
		$optionHtml = '';

		$query = 'SELECT * FROM '.$CFG['tab_prefix'].'gallery;';
		$result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
		while ($gallery = mysql_fetch_array($result))
		{
		  $gallery['IDGallery'] = (integer)$gallery['IDGallery'];
		  
			$optionEntry = '  <option value="'.html_display_safe($gallery['IDGallery']).'"';
			if (0 == strcmp($p_gallery_id, $gallery['IDGallery']))
			{
				$optionEntry .= ' selected="selected"';
			}
			$optionEntry .= '>'.html_display_safe($gallery['Name'])."</option>\n";
			$optionHtml .= $optionEntry;
		}
			
		return $optionHtml;
	}

	static function GetNextImage($p_gallery_id, $p_image_id)
	{
		global $CFG;

		// Check if this is an orphan image being shown
		if (0 == strcmp($p_gallery_id, '0000000000'))
		{
			return (int)$p_image_id;
		}
		 
		// Get just the first ID out of the next images in the same gallery
		$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	       'WHERE IDGallery = '.mysql_real_escape_string($p_gallery_id).' AND Seq > (SELECT Seq FROM '.
    	       '`'.$CFG["tab_prefix"].'galleryindex` WHERE '.
    	       'IDImage = '.mysql_real_escape_string($p_image_id).' AND IDGallery = '.mysql_real_escape_string($p_gallery_id).') ORDER BY Seq ASC LIMIT 1';
		 
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result) {
			return false;
		}

		// Check for the end of the gallery
		$found = mysql_num_rows($result);
		if (0 == $found)
		{
			$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	         'WHERE IDGallery = '.mysql_real_escape_string($p_gallery_id).' ORDER BY Seq ASC LIMIT 1';

			$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
			if (false === $result) {
				return false;
			}
		}

		$row = mysql_fetch_array($result);
		return (int)$row["IDImage"];
	}

	static function GetPreviousImage($p_gallery_id, $p_image_id)
	{
		global $CFG;

		// Check if this is an orphan image being shown
		if (0 == strcmp($p_gallery_id, '0000000000'))
		{
			return (int)$p_image_id;
		}
		 
		// Get just the first ID out of the previous images in the same gallery
		$query = 'SELECT IDImage FROM `'.$CFG["tab_prefix"].'galleryindex` '.
    	         'WHERE IDGallery = '.mysql_real_escape_string($p_gallery_id).' AND Seq < (SELECT Seq FROM '.
    	         '`'.$CFG["tab_prefix"].'galleryindex` WHERE '.
    	         'IDImage = '.mysql_real_escape_string($p_image_id).' AND IDGallery = '.mysql_real_escape_string($p_gallery_id).') ORDER BY Seq DESC LIMIT 1';

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
    	         'WHERE IDGallery = '.mysql_real_escape_string($p_gallery_id).' ORDER BY Seq DESC LIMIT 1';

			$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
			if (false === $result) {
				return false;
			}
		}

		$row = mysql_fetch_array($result);
		return (int)$row["IDImage"];
	}
	 
	static function Delete($p_gallery_id)
	{
		global $errorString;
		global $CFG;

		$query_safe_id = mysql_real_escape_string($p_gallery_id);

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

	// Check if this gallery uses tagged mode (indexed if not)
	static function IsTagged($p_gallery_id)
	{
		global $CFG;

		$query = "SELECT UseTags FROM `".$CFG["tab_prefix"]."gallery` WHERE IDGallery = '".TypeSafeMysqlRealEscapeString($p_gallery_id)."'";
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result) {
			return NULL;
		}

		$row = mysql_fetch_array($result);

		if (0 == mysql_num_rows($result))
		{
			return NULL;
		}

		if (0 == $row['UseTags'])
		{
			return true;
		} elseif (1 == $row['UseTags'])
		{
			return false;
		}

		return NULL;
	}

	static function AddImageToIndex($p_gallery_id, $p_image_id)
	{
		global $CFG;

		if ('0000000000' === $p_gallery_id)
		{
		  return false;
		}
		
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

		return true;
	}

	static function AddOrderedImageToIndex($p_gallery_id, $p_image_id, $p_seq)
	{
		global $CFG;

		// Add new image
		$query = "INSERT INTO `".$CFG["tab_prefix"]."galleryindex` (IDGallery, IDImage, Seq) VALUES ('".TypeSafeMysqlRealEscapeString($p_gallery_id)."', '".TypeSafeMysqlRealEscapeString($p_image_id)."', ".$p_seq.")";
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result) {
			return false;
		}
	}

	static function AddImageToTaggedIndex($p_image_id)
	{
		global $CFG;
		global $ErrorString;

		$query = Gallery::BuildContentQuery( "`".$CFG["tab_prefix"]."gallery`.IDGallery",
                                         "`".$CFG["tab_prefix"]."image`.IDImage = '".mysql_real_escape_string($p_image_id)."') AND (`".$CFG["tab_prefix"]."gallery`.UseTags = '0'");
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result)
		{
			return false;
		}

		while ($row = mysql_fetch_array($result))
		{
			Gallery::AddImageToIndex($row['IDGallery'], $p_image_id);
		}
	}

	static function AddTaggedImages($p_gallery_id)
	{
		global $CFG;
		global $ErrorString;

		$query = Gallery::BuildContentQuery( "`".$CFG["tab_prefix"]."image`.IDImage",
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
			Gallery::AddOrderedImageToIndex($p_gallery_id, $row['IDImage'], $seq);
			$seq++;
		}
		 
		$query = "COMMIT;";
		mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	}

	static function GetFromImageTags($p_image_id)
	{
		global $CFG;
		global $ErrorString;

		$query = Gallery::BuildContentQuery( "`".$CFG["tab_prefix"]."gallery`.IDGallery",
                 "`".$CFG["tab_prefix"]."image`.IDImage = '".mysql_real_escape_string($p_image_id)."') AND (`".$CFG["tab_prefix"]."gallery`.UseTags = '0'");
		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false === $result)
		{
			return false;
		}

		$galleries = array();
		 
		while ($row = mysql_fetch_array($result))
		{
			$galleries[$row['IDGallery']] = $row['IDGallery'];
		}
		 
		return $galleries;
	}

}

?>
