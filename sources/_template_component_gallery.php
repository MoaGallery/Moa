<?php
// Guard against false config variables being passed via the URL
// if the register_globals php setting is turned on
if (isset($_REQUEST["CFG"]))
{
	echo "Hacking attempt.";
	die();
}

include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");

function TagParseGallerySubmitLink($p_tag_options)
{
  return "onclick='gallery.SubmitEdit();'";
}
  
function TagParseGalleryCancelLink($p_tag_options)
{
  return "onclick='gallery.CancelEdit();'";
}

function TagParseGalleryDescription($p_tag_options)
{
	global $gallery_id;

	$Gallery = new Gallery($gallery_id);
	$desc = $Gallery->description;
	if (0 == strlen($desc))
	{
		$desc = " ";
	}
	return html_display_safe($desc);
}

function TagParseGalleryName($p_tag_options)
{
	global $gallery_id;

	$Gallery = new Gallery($gallery_id);
	$name = $Gallery->name;
	if (0 == strlen($name))
	{
		$name = " ";
	}
	return html_display_safe($name);
}

function TagParseGalleryImageThumbnails($p_tag_options)
{
	global $gallery_id;
	global $CFG;
	global $page;

	if (($CFG["DISPLAY_PLAIN_SUBGALLERIES"]) &&
	    (0 != Gallery::SubGalleryCount($gallery_id)))
	{
		return " ";
	}

	$links = LoadTemplate("component_image_thumbnail.php");
	$thumbs = "";

	$images = Gallery::GetImages($gallery_id, $page);

	if (false !== $images)
	{
  	foreach ($images as $image)
  	{
  		$thumb = "";
  
  		if (mb_strlen($image->description) <= 0) {
  			if ($CFG["SHOW_EMPTY_DESC_POPUPS"] == false)
  			{
  				$popup = "";
  			} else
  			{
  				$popup = "onmouseover='showOverlib(\"".popup_display_safe($CFG["EMPTY_DESC_POPUP_TEXT"])."\");' onmouseout='return hideOverlib();'";
  			}
  		} else
  		{
  			$popup = "onmouseover='showOverlib(\"".popup_display_safe($image->description)."\");' onmouseout='return hideOverlib();'";
  		}
  		
  		$Image = new Image($image->id);
  		$width = $Image->width;
  		$height = $Image->height;
  
  		if ((null == $width) || (null == $height))
  		{
  			$width = 150;
  			$height = 112;
  		}
  
  		if (($width > $CFG["THUMB_WIDTH"]) or ($height > ($CFG["THUMB_WIDTH"]*0.75)))
  		{
  			$w = $width / $CFG["THUMB_WIDTH"];
  			$h = $height / ($CFG["THUMB_WIDTH"] * 0.75);
  			if ($w > $h)
  			{
  				$width = $CFG["THUMB_WIDTH"];
  				$height = $height / $w;
  			} else
  			{
  				$width = $width / $h;
  				$height = $CFG["THUMB_WIDTH"] * 0.75;
  			}
  		}
  
  		$thumb = $links;

  		if (is_file($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".str_pad($image->id, 10, '0', STR_PAD_LEFT).".jpg"))
  		{
  			$thumb = ParseVar($thumb, "ImageThumb", str_display_safe($CFG["THUMB_PATH"])."thumb_".str_pad($image->id, 10, '0', STR_PAD_LEFT).".jpg");
  		}
  		else
  		{
  			$thumb = ParseVar($thumb, "ImageThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$CFG["THUMB_WIDTH"]);
  		}
  
  		$thumb = ParseVar($thumb, "ImageThumbID", $image->id);
  		$thumb = ParseVar($thumb, "ImageThumbGlobalWidth", str_display_safe($CFG["THUMB_WIDTH"]));
  		$thumb = ParseVar($thumb, "ImageThumbGlobalHeight", (ceil($CFG["THUMB_WIDTH"]*0.75)));
  		$thumb = ParseVar($thumb, "GalleryThumbWidth", str_display_safe($width));
  		$thumb = ParseVar($thumb, "GalleryThumbHeight", str_display_safe(ceil($height)));
  		$thumb = ParseVar($thumb, "ImageThumbWidth", str_display_safe($width));
  		$thumb = ParseVar($thumb, "ImageThumbHeight", str_display_safe(ceil($height)));
  		$thumb = ParseVar($thumb, "ImagePopup", $popup);
  		$thumb = ParseVar($thumb, "GalleryID", $gallery_id);
  		$thumb = ParseVar($thumb, "Referer", "");
  		$thumbs .= $thumb;
  	}
	}

	if (0 == strlen($thumbs))
	{
		$thumbs = " ";
	}
	return $thumbs;
}

function TagParseGalleryPagination($p_tag_options)
{
	global $gallery_id;
	global $CFG;
	global $page;

	$element = LoadTemplate("component_gallery_pagination.php");
	$elementNoLink = LoadTemplate("component_gallery_pagination_nolink.php");
	$pagination = "";
  
  // Check if this gallery has sub-galleries and if images are being suppressed
  $sg = Gallery::GetSubGalleries($gallery_id);
  if (0 < count($sg))
  {
    if ($CFG['DISPLAY_PLAIN_SUBGALLERIES'])
    {
      // Don't need to show paginataion
      return " ";
    }
  } 
	
	$imagesCount = Gallery::ImageCount($gallery_id);
	$pageCount = ceil($imagesCount / $CFG['IMAGES_PER_PAGE']);

	if ($page > $pageCount)
	{
	  $page = $pageCount;
	}
	
	if ((1 == $pageCount) || (0 == $imagesCount))
	{
	  return " ";
	}
	
	// Add a 'first' link
	$part = $element;
	$active = 'link';
	if (1 == $page)
	{
	  $part = $elementNoLink;
	  $active = 'inactive';
	}

	$part = ParseVar($part, 'Type', 'end');
	$part = ParseVar($part, 'Active', $active);
	$part = ParseVar($part, 'Text', 'First');
	$part = ParseVar($part, 'Link', '?action=gallery_view&amp;gallery_id='.$gallery_id.'&amp;page=1');
	$pagination .= $part;
	
	// Add a 'previous' link
	$part = $element;
	$active = 'link';
  if (1 == $page)
	{
	  $part = $elementNoLink;
	  $active = 'inactive';
	}

	$part = ParseVar($part, 'Type', 'previous');
	$part = ParseVar($part, 'Active', $active);
	$part = ParseVar($part, 'Text', 'Previous');
	$part = ParseVar($part, 'Link', '?action=gallery_view&amp;gallery_id='.$gallery_id.'&amp;page='.($page-1));
	$pagination .= $part;
		
	// Add pages
	
	$startPage = 1;
	$endPage = $pageCount;
	
	if (7 < $pageCount)
	{
  	$startPage = $page - 3;
  	$endPage = $page + 3;
  	if ($startPage <= 0)
  	{
  	  $startPage = 1;
  	  $endPage = $startPage + 6;
  	}
  	
    if ($endPage > $pageCount)
  	{
  	  $endPage = $pageCount;
  	  $startPage = $endPage - 6; 
  	}
	}
	
	for ($pageNum = ($startPage-1); $pageNum <= ($endPage-1); $pageNum++)
	{
		$part = $element;
		$active = 'link';
  	if (($pageNum+1) == $page)
  	{
  	  $part = $elementNoLink;
  	  $active = 'inactive';
  	}

		$type = 'page';
		if (($pageNum+1) == $page)
		{
		  $type = 'current_page';
		}
		
		$part = ParseVar($part, 'Type', $type);
		$part = ParseVar($part, 'Active', $active);
		$part = ParseVar($part, 'Text', $pageNum+1);
		$part = ParseVar($part, 'Link', '?action=gallery_view&amp;gallery_id='.$gallery_id.'&amp;page='.($pageNum+1));
		$pagination .= $part;
	}

	// Add a 'next' link
	$part = $element;
	$active = 'link';
  if ($pageCount == $page)
	{
	  $part = $elementNoLink;
	  $active = 'inactive';
	}

	$part = ParseVar($part, 'Type', 'next');
	$part = ParseVar($part, 'Active', $active);
	$part = ParseVar($part, 'Text', 'Next');
	$part = ParseVar($part, 'Link', '?action=gallery_view&amp;gallery_id='.$gallery_id.'&amp;page='.($page+1));
	$pagination .= $part;
	
	// Add a 'last' link
	$part = $element;
	$active = 'link';
  if ($pageCount == $page)
	{
	  $part = $elementNoLink;
	  $active = 'inactive';
	}

	$part = ParseVar($part, 'Type', 'end');
	$part = ParseVar($part, 'Active', $active);
	$part = ParseVar($part, 'Text', 'Last');
	$part = ParseVar($part, 'Link', '?action=gallery_view&amp;gallery_id='.$gallery_id.'&amp;page='.$pageCount);
	$pagination .= $part;
	
	if (0 == strlen($pagination))
	{
		$pagination = " ";
	}
	return $pagination;
}

function TagParseGallerySubgalleryThumbBlock($p_tag_options)
{
	global $CFG;
	global $gallery_id;

	$subs = Gallery::SubGalleryCount($gallery_id);
	if (0 == $subs)
	{
		return " ";
	}

	return LoadTemplate("component_gallery_subgallery_thumb_block.php");
}

function TagParseGallerySubGalleryThumbnails($p_tag_options)
{
	global $gallery_id;
	global $CFG;

	// Check if the hidden flag is set
	if (isset($p_tag_options["hide"]))
	{
		// Sub-galleries should be hidden and we have some
		if (($CFG["DISPLAY_PLAIN_SUBGALLERIES"]) && (0 != Gallery::SubGalleryCount($gallery_id)))
		{
			if (0 == strcmp($p_tag_options["hide"], "noimage"))
			{
				return " ";
			}
		}
	}

	$links = LoadTemplate("component_subgallery_thumbnail.php");
	$thumbs = "";

	$galleries = Gallery::GetSubGalleries($gallery_id);

	foreach ($galleries as $gallery)
	{
		// Create an Overlib popup description
		if (mb_strlen($gallery->description) <= 0) {
			if ($CFG["SHOW_EMPTY_DESC_POPUPS"] == false)
			{
				$popup = "";
			} else
			{
				$popup = "onmouseover='return showOverlib(\"".popup_display_safe($CFG["EMPTY_DESC_POPUP_TEXT"])."\");' onmouseout='return hideOverlib();'";
			}
		} else
		{
			$popup = "onmouseover='return showOverlib(\"".popup_display_safe($gallery->description)."\");' onmouseout='return hideOverlib();'";
		}

		// Choose captions of the thumbnail
		$subgallery_count = Gallery::SubGalleryCount($gallery->id);
		$image_count = Gallery::ImageCount($gallery->id);
		
		$cap = "";
		if ($CFG["DISPLAY_PLAIN_SUBGALLERIES"])
		{
			if ($subgallery_count > 0)
			{
				$cap =  $subgallery_count." Subgalleries<br/>";

			} else
			{
				$cap =  $image_count." Images";
			}
		} else
		{
			if ($subgallery_count > 0)
			{
				$cap =  $subgallery_count." Subgalleries<br/>";
				$cap .=  $image_count." Images";
			} else
			{
				$cap =  $image_count." Images<br/><br/>";
			}
		}

		// Set up child vars
		$child_count = 0;
		$child_name = "";
		if ($subgallery_count == 0)
		{
			$child_count = $image_count;
			$child_name = "image";
			if (1 != $image_count)
			{
				$child_name .= "s";
			}
		} else
		{
			$child_count = $subgallery_count;
			$child_name = "subgaller";
			if (1 != $subgallery_count)
			{
				$child_name .= "ies";
			} else
			{
				$child_name .= "y";
			}
		}

		$image_id = Gallery::getThumbNailID($gallery->id);
		$Image = new Image($image_id);
		$width = $Image->width;
		$height = $Image->height;

		if ((null == $width) || (null == $height))
		{
			$width = 150;
			$height = 112;
		}

		if (($width > $CFG["THUMB_WIDTH"]) or ($height > ($CFG["THUMB_WIDTH"]*0.75)))
		{
			$w = $width / $CFG["THUMB_WIDTH"];
			$h = $height / ($CFG["THUMB_WIDTH"] * 0.75);
			if ($w > $h)
			{
				$width = $CFG["THUMB_WIDTH"];
				$height = $height / $w;
			} else
			{
				$width = $width / $h;
				$height = $CFG["THUMB_WIDTH"] * 0.75;
			}
		}

		$thumb = ParseVar($links, "GalleryThumbID", $gallery->id);
		$thumb = ParseVar($thumb, "GalleryThumbGlobalWidth", str_display_safe($CFG["THUMB_WIDTH"]));
		$thumb = ParseVar($thumb, "GalleryThumbGlobalHeight", str_display_safe(ceil($CFG["THUMB_WIDTH"]*0.75)));
		$thumb = ParseVar($thumb, "GalleryThumbWidth", str_display_safe($width));
		$thumb = ParseVar($thumb, "GalleryThumbHeight", str_display_safe(ceil($height)));

		if (is_bool($image_id))
		{
			$thumb = ParseVar($thumb, "GalleryThumb", "sources/_image_scaler.php?image_name=../media/empty.png&amp;display_width=".$CFG["THUMB_WIDTH"]);
		}
		elseif (is_file($CFG["MOA_PATH"].$CFG["THUMB_PATH"]."thumb_".$image_id.".jpg"))
		{
			$thumb = ParseVar($thumb, "GalleryThumb", str_display_safe($CFG["THUMB_PATH"])."thumb_".$image_id.".jpg");
		}
		else
		{
			$thumb = ParseVar($thumb, "GalleryThumb", "sources/_image_scaler.php?image_name=../media/img_scale_error.png&amp;display_width=".$CFG["THUMB_WIDTH"]);
		}

		$short_desc = $gallery->description;
		if (60 < strlen($gallery->description))
		{
			$short_desc = substr($gallery->description, 0, 60);
			$split = explode("\n", $short_desc);
			$short_desc = $split[0]."...";
		}

		$thumb = ParseVar($thumb, "GalleryThumbPopup", $popup);
		$thumb = ParseVar($thumb, "GalleryThumbCaption", $cap);
		$thumb = ParseVar($thumb, "GalleryThumbSubGalleryCount", $subgallery_count);
		$thumb = ParseVar($thumb, "GalleryThumbImageCount", $image_count);
		$thumb = ParseVar($thumb, "GalleryThumbChildCount", $child_count);
		$thumb = ParseVar($thumb, "GalleryThumbChildTypeName", $child_name);
		$thumb = ParseVar($thumb, "GalleryThumbDesc", $short_desc);
		$thumb = ParseVar($thumb, "GalleryID", $gallery_id);
		$thumb = ParseVar($thumb, "GalleryThumbTitle", str_display_safe($gallery->name));
		$thumb = ParseVar($thumb, "GalleryThumbTitleShort", str_display_safe(substr($gallery->name, 0, $CFG["TITLE_DESC_LENGTH"])."..."));
		$thumbs .= $thumb;
	}

	if (0 == strlen($thumbs))
	{
		$thumbs = " ";
	}
	return $thumbs;
}

function TagParseGalleryDeleteFeedback($p_tag_options)
{
	$str = ViewDeleteFeedback();

	if (0 == strlen($str))
	{
		return " ";
	}

	return $str;
}

function TagParseGalleryParentComboList($p_tag_options)
{
	global $parent_id;	

  $optionHtml = Gallery::MakeHtmlOptionsList($parent_id);

	if (0 == strlen($optionHtml))
	{
		return ' ';
	}

	return $optionHtml;
}

function TagParseThumbWidth($p_tag_options)
{
	global $CFG;

	$result = 0;
	if (isset($p_tag_options["add"]))
	{
		$result = $p_tag_options["add"];
	}

	$str = str_display_safe($CFG["THUMB_WIDTH"] + $result);
	return $str;
}

function TagParseThumbHeight($p_tag_options)
{
	global $CFG;

	$result = 0;
	if (isset($p_tag_options["add"]))
	{
		$result = $p_tag_options["add"];
	}

	$str = str_display_safe((($CFG["THUMB_WIDTH"]*0.75))+ $result);
	return $str;
}

function TagParseGallerySlideshow($p_tag_options)
{
  global $gallery_id;
  global $CFG;
  
  $str = ' ';
  
  if (0 != Gallery::ImageCount($gallery_id))
  {
    $str = '<a href="index.php?action=slideshow&amp;gallery_id='.$gallery_id.'">View slideshow</a>';
  } 
  
  return $str;
}

?>