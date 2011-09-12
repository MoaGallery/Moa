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

  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  function TagCheckExists()
  {
    $returnInfo = DefaultAjaxResult( 'TagExists');
    
    // Get the action
    $tag_id = GetParam("tag_id");
    if (false === $tag_id)
    {
      $returnInfo['Result'] = 'No tag id supplied.';
      echo json_encode($returnInfo);
      return false;
    }

    // Check that it is a real tag
    if (false === Tag::Exists($tag_id))
    {
      $returnInfo['Result'] = 'Tag does not exist.';
      echo json_encode($returnInfo);
      return false;
    }

    return $tag_id;
  }

  function TagDelete($p_id = NULL)
  {
    global $errorString;

    $returnInfo = DefaultAjaxResult( 'TagDelete');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Try to delete the tag
    if (false === Tag::Delete($p_id))
    {
      $returnInfo['Result'] = 'Could not delete tag.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function TagAdd()
  {
    global $errorString;

    $returnInfo = DefaultAjaxResult('TagAdd');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Get the value
    $newname = GetParam('name');
    if (false === $newname)
    {
      $returnInfo['Result'] = 'No name supplied.';
      return $returnInfo;
    }
    
    // Get the fake ID
    $fake_id = GetParam('fake_id');
    if (false === $fake_id)
    {
      $returnInfo['Result'] = 'No id supplied.';
      return $returnInfo;
    }

    // Check if tag already exists, we don't want duplicates
    $id = Tag::LookUp($newname);
    if (false !== $id)
    {
      $returnInfo['Result'] = 'Tag already exists.';
      return $returnInfo;
    }

    // Try to add the tag
    $tag = new Tag();
    $tag->name = $newname;
    $id = $tag->Commit();
    if (false === $id)
    {
      $returnInfo['Result'] = 'Could not add tag.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    $returnInfo['TagID'] = (int)$id;
    $returnInfo['fake_id'] = $fake_id;
    unset($returnInfo['Result']);

    return $returnInfo;
  }
  
  function TagEdit($p_id = NULL)
  {
    global $errorString;

    $returnInfo = DefaultAjaxResult('TagEdit');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Get the value
    $newname = GetParam('name');
    if (false === $newname)
    {
      $returnInfo['Result'] = 'No name supplied.';
      return $returnInfo;
    }
    
    // Check if tag already exists, we don't want duplicates
    $id = Tag::LookUp($newname);
    if (false !== $id)
    {
      $returnInfo['Result'] = 'Tag already exists.';
      return $returnInfo;
    }

    // Try to add the tag
    $tag = new Tag($p_id);
    $tag->name = $newname;
    $id = $tag->Commit();
    if (false === $id)
    {
      $returnInfo['Result'] = 'Could not edit tag.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function TagAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      $returnInfo = DefaultAjaxResult( 'ActionCheck');
	    $returnInfo['Result'] = 'No action supplied.';
	    echo json_encode($returnInfo);
    }

    DBConnect();

    switch ($action)
    {
    	case "add" :
    	{
        echo json_encode(TagAdd());
    		break;
    	}
      case "delete" :
      {
      	$tag_id =  TagCheckExists();
      	if (false !== $tag_id)
      	{
      	  echo json_encode(TagDelete($tag_id));
      	}
        break;
      }
      case "edit" :
      {
        $tag_id = TagCheckExists();
        if (false !== $tag_id)
      	{
      	  echo json_encode(TagEdit($tag_id));
      	}
        break;
      }
      default :
      {
        $returnInfo = DefaultAjaxResult( 'Unknown');
        $returnInfo['Result'] = 'Unknown action.';
        echo  json_encode($returnInfo);
        break;
      }
    }
  }

  // Only call this if this file is stand-alone. not if it is included from index.php
  if (false === isset($preCache))
  {
    TagAjaxMain();
  }
?>