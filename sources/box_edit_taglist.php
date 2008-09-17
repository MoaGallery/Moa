<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../private/db_config.php");
  include_once("../config.php");
    
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
    
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
        die ("no gallery ID supplied");
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
        die ("no image ID supplied");
      }
    }
  }

  if (isset($_REQUEST["tagname"]) == true)
  {
    $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES ("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
    $result = mysql_query($query) or die("ERROR!".mysql_error()."<BR>");
  }

  $edit_tag_query = "SELECT * FROM ".$tab_prefix."tag";
  $edit_tag_result = mysql_query($edit_tag_query) or die(mysql_error());
  
  // Unset all tags in the session array
  while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
  {
    unset ($_SESSION["tag-".$edit_tag_taglist["IDTag"]]);
  }
  
  if ($edit_tag_gallery == true)
  {
    // Mark just the ones valid for this gallery as set
    $edit_tag_query = "SELECT * FROM ".$tab_prefix."gallerytaglink WHERE (IDGallery=".mysql_real_escape_string($gallery_id).")";
    $edit_tag_result = mysql_query($edit_tag_query) or die(mysql_error());
    
    while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
    {
      $_SESSION["tag-".$edit_tag_taglist["IDTag"]] = true;
    }
  }
  
  if ($edit_tag_image == true)
  {
    // Mark just the ones valid for this image as set
    $edit_tag_query = "SELECT * FROM ".$tab_prefix."imagetaglink WHERE (IDImage=".mysql_real_escape_string($image_id).")";
    $edit_tag_result = mysql_query($edit_tag_query) or die(mysql_error());
    
    while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
    {
      $_SESSION["tag-".$edit_tag_taglist["IDTag"]] = true;
    }
  }
  
  // display the list of tags
  $edit_tag_query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
  $edit_tag_result = mysql_query($edit_tag_query) or die(mysql_error());
  while ($edit_tag_taglist = mysql_fetch_array($edit_tag_result))
  {    
    echo "<div style='clear: both'><input style='float: left' class='form_label_text' type='checkbox' onClick='onTick(\"".$edit_tag_taglist["IDTag"]."\");' ";
    if (isset($_SESSION["tag-".$edit_tag_taglist["IDTag"]]))
    {
      echo "checked='true' ";
    }
    echo "id='tag-".$edit_tag_taglist["IDTag"]."'><div class='form_label_text'> ".$edit_tag_taglist["Name"]."</div></input></div>\n";
  }
  
?>