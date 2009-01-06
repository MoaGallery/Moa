<?php
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    include_once("../config.php");
    include_once("_error_funcs.php");
    $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    include_once ("id.php");
  }
  
  
  
  if (false == isset($_REQUEST["image_id"]))
  {
    if (false == isset($pre_cache))
    {
      moa_warning("No image specified");
      $image_id = 0;
    } else
    {
      $image_id = $pre_image_id;
    }
  } else
  {
    $image_id = $_REQUEST["image_id"];
  }
  
  if (false == isset($_REQUEST["parent_id"]))
  {
    if (false == isset($pre_cache))
    {
      $parent_id = 0;
    } else
    {
      $parent_id = $pre_parent_id;
    }
  } else
  {
    $parent_id = $_REQUEST["parent_id"];
  }
  
  if (false == isset($_REQUEST["referer"]))
  {
    if (false == isset($pre_cache))
    {
      $referer = 0;
    } else
    {
      $referer = $pre_referer;
    }
  } else
  {
    $referer = $_REQUEST["referer"];
  }
  
  if (0 != $image_id)
  {
    $query = "SELECT * FROM ".$tab_prefix."image WHERE (IDImage='".mysql_real_escape_string($image_id)."');";
    $result = mysql_query($query);
    $image = mysql_fetch_array($result);
  
    if (mysql_num_rows($result) > 0)
    {
      if ($Userinfo->ID != NULL) {
        echo "<a class='admin_link' onclick='ajaxInfoDescription(\"".$image_id."\", \"NULL\", \"true\")'>[Edit]</a> ";
        echo "<a class='admin_link' onclick='image_delete(\"".$image_id."\", \"".$parent_id."\", ".$referer.");'>[Delete]</a>\n";
        echo "<br><br>\n";
      }
      $width = $image["Width"];
      $height = $image["Height"];
      echo "<div id='imagedesc'>";
      include_once("sources/box_image_description.php");
      echo "</div><br/><br/>\n";
      
      echo "<div class='image_desc'>\n";
      if (($width > $CONFIG_DISPLAY_MAX_WIDTH) or ($height > $CONFIG_DISPLAY_MAX_WIDTH * 0.75))
      {
        echo "Size:&nbsp;".$width."x".$height."<br/>";          
        echo "View full size: <a href='view_image_full.php?image_id=".$image_id."'>link</a>\n";
      }        
      echo "</div>";
    } else
    {
      moa_warning("Image does not exist");
    }
  }
?>