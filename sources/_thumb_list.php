<?php
  echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>".$header."</td></tr><tr><td class='pale_area_nb'>\n";
  echo "<div id='info'>";
  
  $index = false;
  if(isset($pre_index) == true)
  {
    $index = $pre_index;
  }
  
  if ($index == false)
  {
    if (isset($pre_cache_from_sources) == false)
    {
      $pre_cache_from_sources = false;
    }
    
    if ($pre_cache_from_sources == true)
    {
      include_once("box_gallery_info.php");
    } else
    {
      include_once("sources/box_gallery_info.php");
    }
  }
  echo "</div>";
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);  
  
  if (($gallery_id == '0000000000') && ( mysql_num_rows($result) == 0)) {
    moa_warning("No galleries.");
  }
  else {  
    while ($gallery = mysql_fetch_array($result))
    {
      $gallery_summary_id = $gallery["IDGallery"];
      include ("box_gallery_summary.php");
    }
  }
  echo "</td></tr></table>\n";
?>