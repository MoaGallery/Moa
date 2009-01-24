<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../config.php");
  include_once("_error_funcs.php");
  include_once("common.php");
  include_once("_db_funcs.php");
  $db = DBConnect();
    
  include_once ("id.php");
  
  session_start();
    
  $edit_tag_gallery = false;
  $edit_tag_image = false;
    
  if (isset($_REQUEST["type"]))
  {
    if (strcmp($_REQUEST["type"], "gallery") == 0)
    {
      $edit_tag_gallery = true;
      if (isset($_REQUEST["gallery_id"]))
      {
        $gallery_id = $_REQUEST["gallery_id"];
      } else
      {
        moa_warning("no gallery ID supplied", true);
        die();
      }
    }
    if (strcmp($_REQUEST["type"], "image") == 0)
    {
      $edit_tag_image = true;
      if (isset($_REQUEST["image_id"]))
      {
        $image_id = $_REQUEST["image_id"];
      } else
      {
        moa_warning("no image ID supplied", true);
        die();
      }
    }
  }  

  if (isset($_REQUEST["tagname"]) == true)
  {
  	$new_tag_name = magic_url_decode($_REQUEST["tagname"]);
  	
    $query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string($new_tag_name).'");';
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    
    if (0 == mysql_num_rows($result))
    {    
      $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES (_utf8"'.mysql_real_escape_string($new_tag_name).'");';
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    }
  }

  $edit_tag_query = "SELECT * FROM ".$tab_prefix."tag";
  $edit_tag_result = mysql_query($edit_tag_query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  
  // Unset all tags in the session array
  while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
  {
    unset ($_SESSION["tag-".$edit_tag_taglist["IDTag"]]);
  }
  
  if ($edit_tag_gallery == true)
  {
    // Mark just the ones valid for this gallery as set
    $edit_tag_query = "SELECT * FROM ".$tab_prefix."gallerytaglink WHERE (IDGallery=".mysql_real_escape_string($gallery_id).")";
    $edit_tag_result = mysql_query($edit_tag_query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    
    while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
    {
      $_SESSION["tag-".$edit_tag_taglist["IDTag"]] = true;
    }
  }
  
  if ($edit_tag_image == true)
  {
    // Mark just the ones valid for this image as set
    $edit_tag_query = "SELECT * FROM ".$tab_prefix."imagetaglink WHERE (IDImage=".mysql_real_escape_string($image_id).")";
    $edit_tag_result = mysql_query($edit_tag_query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    
    while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
    {
      $_SESSION["tag-".$edit_tag_taglist["IDTag"]] = true;
    }
  }
  
  echo "<div id='addtagarea'></div><br/>\n";
    
  // display the list of tags
  $edit_tag_query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
  $edit_tag_result = mysql_query($edit_tag_query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
  {    
    echo "<div style='clear: both'><input style='float: left' class='form_label_text' type='checkbox' onClick='onTick(\"".$edit_tag_taglist["IDTag"]."\");' ";
    if (isset($_SESSION["tag-".$edit_tag_taglist["IDTag"]]))
    {
      echo "checked='true' ";
    }
    echo "id='tag-".$edit_tag_taglist["IDTag"]."'><div class='form_label_text'> ".str_display_safe($edit_tag_taglist["Name"])."</div></input></div>\n";
  }
  
?>