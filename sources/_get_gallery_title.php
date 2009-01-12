<?php
  $pre_cache_from_sources = false;
  $prefix = "../";
  $prefix2 = "";
  $ajax = false;
  if (isset($pre_cache) == true)
  {
    if (true == $pre_cache)
    {
      $gallery_id = $pre_gallery_id;
      $pre_cache_from_sources = true;
      $prefix = "";
      $prefix2 = "sources/";
    } else
    {
      $ajax = true;
    }
  } else
  {
    $ajax = true;
  }
  
  if (true == $ajax)
  {
    if (isset($_REQUEST["gallery_id"]) == false)
    {
      die();
    }
    
    $gallery_id = $_REQUEST["gallery_id"];
  }
  
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    session_start();
    include_once($prefix."private/db_config.php");
  
    $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    include_once($prefix."config.php");
    include_once($prefix2."id.php");
  }
  
  $query = "SELECT Name FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $gallery = mysql_fetch_array($result);
  
  if ($TITLE_DESC_LENGTH > 0)
  {
    if (strlen($gallery["Name"]) <= $TITLE_DESC_LENGTH)
    {
      echo " - " . $gallery["Name"];
    } else
    {
      echo " - " . substr($gallery["Name"], 0, $TITLE_DESC_LENGTH-3) . "...";
    }
  }
?>