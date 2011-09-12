<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  class ImageInfo
  {
    var $Id;
    var $Description;
  }
  
  require_once ($CFG["MOA_PATH"].'sources/mod_gallery_funcs.php');
  
  // Get the gallery id
  $no_gallery_id = false;
  if (isset($_GET["gallery_id"]) == false)
  {
    $no_gallery_id = true;
  } else
  {
    $gallery_id = $_GET["gallery_id"];
    $preCache = true;
    $pre_gallery_id = $gallery_id;
  }

  // Flag a break if there is no gallery to show
  $proceed = true;
  if (true == $no_gallery_id)
  {
    moa_warning("No gallery ID supplied.");
    $proceed = false;
  }

  $imageObjectList = Gallery::GetImages($gallery_id);
  
  $imageList = array();
  
  if (false !== $imageObjectList)
  {
    foreach ($imageObjectList as $image)
    {
      $arr = new ImageInfo;
      $arr->Id = $image->id;
      $arr->Description = $image->description;
      $arr->Format = $image->format;
      $imageList[] = $arr;
    }
  }
  
  if ($proceed)
  {
	  $Gallery = new Gallery($gallery_id);

	  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
  	$bodycontent .= LoadTemplateRoot("page_slideshow_view.php");
	  
    $bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_slideshow.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_ui.js'></script>\n";
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    $json = json_encode($imageList);
    $json = str_replace('\\', '\\\\', $json);
    $json = str_replace('"', '\"', $json);
    $json = str_replace('},', "},\"+\n\"", $json);
    $bodycontent .= '  images = "'.$json;
    $bodycontent .= "\";\n";
    $bodycontent .= "  delay = ".((integer)$CFG["SLIDESHOW_DELAY"]).";\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "</script>\n";
    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    
    $bodycontent .= "  var feedback_box = ";
    $bodycontent .= moa_feedback_js();
    $bodycontent .= ";\n";
    
    $bodycontent .= "  var slideshow = new Slideshow();\n";
    $bodycontent .= "  slideshow.PreLoad(images, delay);\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "</script>\n";
	
  	$preCache = true;
  	$pre_gallery_id = $gallery_id;

    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

    $galShortname = $Gallery->name;
    
    if ($CFG["TITLE_DESC_LENGTH"] < strlen($galShortname))
    {
      $galShortname = substr($galShortname, 0, ($CFG["TITLE_DESC_LENGTH"]-3))."...";
    }
    $bodytitle .= "Slideshow '".$galShortname."' - ".html_display_safe($CFG['SITE_NAME']);
  }
?>