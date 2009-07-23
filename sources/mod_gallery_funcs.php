<?php
// mod_gallery_funcs.php - This is a collection of functions that interect with the database and a gallery.
include_once($MOA_PATH."sources/_error_funcs.php");
include_once($MOA_PATH."sources/_db_funcs.php");
include_once($MOA_PATH."sources/mod_image_funcs.php");
include_once($MOA_PATH."sources/mod_tag_funcs.php");

// Structure - Holds information for a single gallery
class Gallery{
	var $m_id;
	var $m_parent_id;
	var $m_name;
	var $m_description;
};

// Function to return query that will return all gallery images meeting
// given condition and record order.
function _buildGalleryContentQuery($p_fields, $p_condition, $p_order_by = "") {
	global $tab_prefix;
	 
	$query = "SELECT ".$p_fields."
                FROM ".$tab_prefix."imagetaglink   AS ImgTagLinks, 
                     ".$tab_prefix."gallerytaglink AS GalTagLinks,
                     ".$tab_prefix."image,
                     ".$tab_prefix."gallery
               WHERE ImgTagLinks.IDTag     = GalTagLinks.IDTag
                 AND ImgTagLinks.IDImage   = ".$tab_prefix."image.IDImage
                 AND GalTagLinks.IDGallery = ".$tab_prefix."gallery.IDGallery
                 AND (".$p_condition.")
               GROUP BY ".$tab_prefix."gallery.IDGallery, ImgTagLinks.IDimage, ".$tab_prefix."image.Description
              HAVING COUNT(ImgTagLinks.IDTag) = (SELECT COUNT(GalTagLinks2.IDTag)
                                                   FROM ".$tab_prefix."gallerytaglink AS GalTagLinks2
                                                  WHERE GalTagLinks2.IDGallery = ".$tab_prefix."gallery.IDGallery)";

	if (0 != strlen($p_order_by)) {
		$query .= " ORDER BY ".$p_order_by;
	}
	 
	return $query;
};

// Checks on database that a gallery exists for the given p_id.
function _galleryExists($p_id) {
	global $ErrorString;
	global $tab_prefix;

	$query = "SELECT 1 FROM ".$tab_prefix."gallery WHERE IDGallery = ".mysql_real_escape_string($p_id);
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

	if ((false == $result) || (0 == mysql_num_rows($result))) {
		return false;
	}
	return true;
};

// Changes the value of field named by $field to $value for gallery identified by $p_id.
function _galleryChangeValue($p_id, $p_field, $p_value) {
	global $ErrorString;
	global $tab_prefix;

	$query = "UPDATE ".$tab_prefix."gallery SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDGallery = ".mysql_real_escape_string($p_id);
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}
	return true;
};

// Changes the value of all fields for gallery identified by $p_id.
function _galleryEdit($p_id, $p_name, $p_desc, $p_pid, $p_tags) {
	global $ErrorString;
	global $tab_prefix;
	global $STR_DELIMITER;

	$query = "UPDATE ".$tab_prefix."gallery SET Name = _utf8'".mysql_real_escape_string($p_name)."', Description = _utf8'".mysql_real_escape_string($p_desc)."', IDParent = '".mysql_real_escape_string($p_pid)."' WHERE IDGallery = ".mysql_real_escape_string($p_id);
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$query = "DELETE FROM ".$tab_prefix."gallerytaglink WHERE IDGallery='".mysql_real_escape_string($p_id)."'";
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
					$query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES ('".mysql_real_escape_string($p_id)."', '".$oldtag->m_id."')";
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
				$query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES ('".mysql_real_escape_string($p_id)."', '".$newid."')";
				$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
				if (false == $result) {
					return false;
				}
			}
		}
	}

	return true;
};

// Adds a new gallery based on passed in fields values.
function _galleryAdd($p_name, $p_desc, $p_parentid, $p_tags) {
	global $ErrorString;
	global $tab_prefix;
	global $STR_DELIMITER;

	$query = "INSERT ".$tab_prefix."gallery (Name, Description, IDParent) VALUES (_utf8'".mysql_real_escape_string($p_name)."', _utf8'".mysql_real_escape_string($p_desc)."', '".mysql_real_escape_string($p_parentid)."');";
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}
	$newid = mysql_insert_id();
	$id = sprintf("%010s", $newid);

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
					$query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES ('".mysql_real_escape_string($id)."', '".$oldtag->m_id."')";
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
				$query = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES ('".mysql_real_escape_string($id)."', '".$newid."')";
				$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
				if (false == $result) {
					return false;
				}
			}
		}
	}

	return true;
};

// Returns the value of field named by $field for gallery specified by $p_id.
function _galleryGetValue($p_id, $p_field ) {
	global $ErrorString;
	global $tab_prefix;

	$query = "SELECT ".mysql_real_escape_string($p_field)." FROM ".$tab_prefix."gallery WHERE IDGallery = ".mysql_real_escape_string($p_id);
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$row = mysql_fetch_array($result);
	return $row[$p_field];
};

// Returns the values of all gallery fields for gallery specified by $p_id.
function _galleryGetAllValues($p_id) {
	global $ErrorString;
	global $tab_prefix;

	$query = "SELECT * FROM ".$tab_prefix."gallery WHERE IDGallery = ".mysql_real_escape_string($p_id);
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$row = mysql_fetch_array($result);

	$gallery = new Gallery;
	$gallery->m_id          = $p_id;
	$gallery->m_name        = $row["Name"];
	$gallery->m_description = $row["Description"];
	$gallery->m_parent_id   = $row["IDParent"];

	return $gallery;
};

// Returns a list of galleries where IDParent is specified by $p_id.
function _galleryGetSubGalleries($p_id) {
	global $ErrorString;
	global $tab_prefix;

	$query = "SELECT * FROM ".$tab_prefix."gallery WHERE IDParent = ".mysql_real_escape_string($p_id);
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$sub_galleries = array();

	while ($row = mysql_fetch_array($result)) {
		$gallery = new Gallery;
		$gallery->m_id          = $row["IDGallery"];
		$gallery->m_name        = $row["Name"];
		$gallery->m_description = $row["Description"];
		$gallery->m_parent_id   = $p_id;

		$sub_galleries[] = $gallery;
	}

	return $sub_galleries;
};

// Returns a list of images where tag match those of the gallery specified by $p_id
function _galleryGetImages($p_id) {
	global $ErrorString;
	global $tab_prefix;

	$query = _buildGalleryContentQuery( $tab_prefix."image.IDImage, ".$tab_prefix."image.Description"
	, $tab_prefix."gallery.IDGallery = '".mysql_real_escape_string($p_id)."'");

	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$images = array();

	while ($row = mysql_fetch_array($result)) {
		$image = new Image;
		$image->m_id          = $row["IDImage"];
		$image->m_description = $row["Description"];

		$images[] = $image;
	}

	return $images;
}

// Returns the ID of the first image in this gallery.
function _galleryGetThumbNail($p_id)
{
	global $tab_prefix;
	$query = _buildGalleryContentQuery( $tab_prefix."image.IDImage"
	, $tab_prefix."gallery.IDGallery = '".mysql_real_escape_string($p_id)."'");
	 
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$image = mysql_fetch_array($result);
	if (false == $image)
	{
		if (0 < _galleryGetSubGalleryCount($p_id))
		{
			$sub_galleries = _galleryGetSubGalleries( $p_id);

			foreach ($sub_galleries as $sub_gallery)
			{
				$found = _galleryGetThumbNail($sub_gallery->m_id);
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
function _galleryGetImageCount($p_id)
{
	global $tab_prefix;
	$query = _buildGalleryContentQuery( "1"
	, $tab_prefix."gallery.IDGallery = '".mysql_real_escape_string($p_id)."'");

	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	return mysql_num_rows($result);
}

// Returns the number of sub-galleries of this gallery.
function _galleryGetSubGalleryCount($p_id)
{
	global $tab_prefix;
	$query = "SELECT 1 FROM ".$tab_prefix."gallery WHERE IDParent = '".mysql_real_escape_string($p_id)."';";
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	return mysql_num_rows($result);
}

// Deletes the gallery indentified by $id.
function _galleryDelete($p_id) {
	global $ErrorString;
	global $tab_prefix;

	$query_safe_id = mysql_real_escape_string($p_id);

	$query = "DELETE FROM ".$tab_prefix."gallerytaglink WHERE IDGallery = '".$query_safe_id."'";
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$query = "SELECT IDParent FROM ".$tab_prefix."gallery WHERE IDGallery = '".$query_safe_id."'";
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$row = mysql_fetch_array($result);

	$query = "UPDATE ".$tab_prefix."gallery SET IDParent = '".$row["IDParent"]."' WHERE IDParent = '".$query_safe_id."'";
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	$query = "DELETE FROM ".$tab_prefix."gallery WHERE IDGallery = '".$query_safe_id."'";
	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	return true;
};

// Returns list of tags for gallery identified by $id
function _galleryGetTagList($p_id) {
	global $tab_prefix;

	$query = "SELECT IDTag FROM ".$tab_prefix."gallerytaglink WHERE IDGallery = '".mysql_real_escape_string($p_id)."'";
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

function _GalleryGetNextImage($p_gallery_id, $p_image_id)
{
	global $tab_prefix;

	// Get just the first ID out of the next images in the same gallery
	$query = _buildGalleryContentQuery( $tab_prefix."image.IDImage"
	, "((".$tab_prefix."image.IDImage > ".$p_image_id.") AND (".$tab_prefix."gallery.IDGallery = ".$p_gallery_id."))"
	, $tab_prefix."image.IDImage ASC LIMIT 1");

	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	// Check for the end of the gallery
	$found = mysql_num_rows($result);
	if (0 == $found)
	{
		// Get just the first ID out of the next images in the same gallery
		$query = _buildGalleryContentQuery( $tab_prefix."image.IDImage"
		, "(".$tab_prefix."gallery.IDGallery = ".$p_gallery_id.")"
		, $tab_prefix."image.IDImage ASC LIMIT 1");

		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false == $result) {
			return false;
		}
	}

	$row = mysql_fetch_array($result);
	return $row["IDImage"];
}

function _GalleryGetPreviousImage($p_gallery_id, $p_image_id)
{
	global $tab_prefix;

	// Get just the first ID out of the previous images in the same gallery
	$query = _buildGalleryContentQuery( $tab_prefix."image.IDImage"
	, "((".$tab_prefix."image.IDImage < ".$p_image_id.") AND (".$tab_prefix."gallery.IDGallery = ".$p_gallery_id."))"
	, $tab_prefix."image.IDImage DESC LIMIT 1");

	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	if (false == $result) {
		return false;
	}

	// Check for the start of the gallery
	$found = mysql_num_rows($result);
	if (0 == $found)
	{
		// Get just the first ID out of the next images in the same gallery
		$query = _buildGalleryContentQuery( $tab_prefix."image.IDImage"
		, "(".$tab_prefix."gallery.IDGallery = ".$p_gallery_id.")"
		, $tab_prefix."image.IDImage DESC LIMIT 1");

		$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
		if (false == $result) {
			return false;
		}
	}

	$row = mysql_fetch_array($result);
	return $row["IDImage"];
}
?>
