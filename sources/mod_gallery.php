<?php
  header('Cache-Control: no-cache');

  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once("_settings.php");
  LoadSettings();

  $gallery_first = false;
  if (!isset($image_first))
  {
    $gallery_first = true;
  }

  include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/_template_parser.php");

  function GalleryCheckExists()
  {
    $returnInfo = DefaultAjaxResult( 'GalleryExists');
    
    // Get the ID
    $gallery_id = GetParam("gallery_id");
    if (false === $gallery_id)
    {
      $returnInfo['Result'] = 'No gallery id supplied.';
      echo json_encode($returnInfo);
      return false;
    }

    // Check that it is a real gallery
    if (false === Gallery::Exists($gallery_id))
    {
      $returnInfo['Result'] = 'Gallery does not exist.';
      echo json_encode($returnInfo);
      return false;
    }

    return $gallery_id;
  }

  function GalleryDelete($p_id)
  {
    global $errorString;

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    $returnInfo = DefaultAjaxResult( 'GalleryDelete');
    
    // Try to delete the gallery
    if (false === Gallery::Delete($p_id))
    {
      $returnInfo['Result'] = 'Could not delete gallery.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    return $returnInfo;
  }

  function GalleryImageThumbs($p_id)
  {
  	global $CFG;
    global $gallery_id;
    global $template_name;
    global $errorString;
    global $page;
    
    // Set global vars if needed
    if (!isset($preCache))
    {
      $gallery_id = $p_id;

	    // Find out which template we should be using. Fall back to MoaDefault if none set
		  $template_name = "MoaDefault";
		  if (isset($CFG["TEMPLATE"]))
		  {
		    if (is_dir("../templates/".$CFG["TEMPLATE"]))
		    {
		      $template_name = $CFG["TEMPLATE"];
		    }
		  }
    }
    
    // Get the page
    $page = GetParam("page");
    if (false === $page)
    {
      $page = 1;
    }
    
    $returnInfo = DefaultAjaxResult( 'GetThumbnails');

    $thumbs = LoadTemplateRoot("page_gallery_view.php");
    
    $returnInfo['HTML'] = $thumbs;
    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function GalleryEdit($p_id)
  {
    $returnInfo = DefaultAjaxResult( 'GalleryEdit');

    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {      
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      $returnInfo['Result'] = 'No name supplied.';
      return $returnInfo;
    }

    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }
    
    // Get the ParentID
    $newpid = GetParam("parent_id");
    if (false === $newpid)
    {      
      $returnInfo['Result'] = 'No parent ID supplied.';
      return $returnInfo;
    }

    // Get the Tagged flag
    $newtagged = GetParam("tagged");
    if (false === $newtagged)
    {           
      $returnInfo['Result'] = 'No tagged flag supplied.';
      return $returnInfo;
    }
    
    // Get the tags
    $newtags = GetParam("tags");
    if (false !== $newtags) {
      $newtags = trim($newtags);

      if ((0 == strcmp($newtagged, "true")) &&
          (strlen($newtags) == 0))
      {       
        $returnInfo['Result'] = 'Whitespace may not be used as a tag.';
        return $returnInfo;
      }
    }
    else
    {
      $returnInfo['Result'] = 'No tags supplied.';
      return $returnInfo;      
    }
    
    // Try to change the gallery
    $Gallery = new Gallery($p_id);
    $Gallery->name = $newname;
    $Gallery->description = $newdesc;
    $Gallery->parent_id = $newpid;
    $Gallery->tags = $newtags;
    $Gallery->useTags = (0 == strcmp($newtagged, 'true')) ? true : false;
    
    if (false === $Gallery->Commit())
    {
      $returnInfo['Result'] = 'Could not update gallery.';
      return $returnInfo;
    }

    unset($returnInfo['Result']);
    $returnInfo['Status'] = 'SUCCESS';
    return $returnInfo;
  }

  function GalleryAdd()
  {       
    global $Userinfo;
    global $CFG;
    
    $returnInfo = DefaultAjaxResult( 'GalleryAdd');    
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {      
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      $returnInfo['Result'] = 'No name supplied.';
      return $returnInfo;
    }

    // Get the description
    $newdesc = GetParam("desc");
    if (false === $newdesc)
    {
      $newdesc = "";
    }

    // Get the ParentID
    $newpid = GetParam("parent_id");
    if (false === $newpid)
    {
      $returnInfo['Result'] = 'No parent ID supplied.';
      return $returnInfo;
    }

    // Get the Tagged flag
    $newtagged = GetParam("tagged");
    if (false === $newtagged)
    {
      $returnInfo['Result'] = 'No tagged flag supplied.';
      return $returnInfo;
    }
    
    // Get the tags
    $newtags = GetParam("tags");
    if (false !== $newtags) {
      $newtags = trim($newtags);

      if ((0 == strcmp($newtagged, "true")) &&
          (strlen($newtags) == 0))
      {
        $returnInfo['Result'] = 'Whitespace may not be used as a tag.';
        return $returnInfo;
      }
    }
    else
    {
      $returnInfo['Result'] = 'No tags supplied.';
      return $returnInfo;
    }
    
    // Try to add the gallery
    $Gallery = new Gallery();
    $Gallery->name = $newname;
    $Gallery->description = $newdesc;
    $Gallery->parent_id = $newpid;
    $Gallery->tags = $newtags;
    $Gallery->useTags = (0 == strcmp($newtagged, 'true')) ? true : false;
    
    $result = $Gallery->Commit();
    if (false === $result)
    {
      $returnInfo['Result'] = 'Could not add gallery.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);
    
    $returnInfo['NewID'] = $Gallery->id;
    return $returnInfo;
  }

  function GalleryAjaxMain()
  {
	  // Get the action
	  $action = GetParam("action");
	  if (false === $action)
	  {
	    $returnInfo = DefaultAjaxResult( 'ActionCheck');
	    $returnInfo['Result'] = 'No action supplied.';
	    echo json_encode($returnInfo);
	    return;
	  }

	  switch ($action)
	  {
	    case "edit" :
	    {
	      $gallery_id = GalleryCheckExists();
	    	if (false !== $gallery_id)
	    	{
	    	  echo json_encode(GalleryEdit($gallery_id));
        }
	      break;
	    }
	    case "add" :
        {                       
          echo json_encode(GalleryAdd());
          break;
        }
	    case "delete" :
	    {
          $gallery_id = GalleryCheckExists();
          if (false !== $gallery_id)
          {
            echo json_encode(GalleryDelete($gallery_id));
          }
          break;
	    }
	    case "image_thumbs" :
        {
          $gallery_id = GalleryCheckExists();
          if (false !== $gallery_id)
          {
            echo json_encode(GalleryImageThumbs($gallery_id));
          }
          break;
        }
        default :
        {
          $returnInfo = DefaultAjaxResult( 'ActionCheck');
          $returnInfo['Result'] = 'Unknown action.';
          echo json_encode($returnInfo);
          break;
        }
	  }
  }

  if ((false === isset($preCache)) && ($gallery_first))
  {
    GalleryAjaxMain();
  }
?>