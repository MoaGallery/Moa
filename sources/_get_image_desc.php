<?php
  $pre_cache_from_sources = false;
  $prefix = "../";
  $prefix2 = "";
  $ajax = false;
  if (isset($pre_cache) == true)
  {
    if (true == $pre_cache)
    {
      $image_id = $pre_image_id;
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
    if (isset($_REQUEST["image_id"]) == false)
    {
      die();
    }
    
    $image_id = $_REQUEST["image_id"];
  }
  
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    session_start();
    include_once("_db_funcs.php");
    $db = DBConnect();
    include_once($prefix."config.php");
    include_once($prefix2."id.php");
    include_once($prefix2."common.php");
  }
  
  $query = "SELECT Description FROM ".$tab_prefix."image WHERE (IDImage = '".mysql_real_escape_string($image_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $image = mysql_fetch_array($result);
  
  // Strip off the first line if more than one
  $firstbr = mb_strpos($image["Description"], "\n");
  if (0 < $firstbr)
  {
    $image["Description"] = mb_substr($image["Description"], 0, $firstbr);
  }
  
  if ($TITLE_DESC_LENGTH > 0)
  {
    if (mb_strlen($image["Description"]) <= $TITLE_DESC_LENGTH)
    {
      echo " - " . html_display_safe($image["Description"]);
    } else
    {
      echo " - " . mb_substr(html_display_safe($image["Description"]), 0, $TITLE_DESC_LENGTH-3) . "...";
    }
  }
?>