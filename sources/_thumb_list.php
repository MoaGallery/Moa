<?php
  echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>".$header."</td></tr><tr><td class='pale_area_nb'>\n";
  echo "<span id='info'></span>";
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or die(mysql_error());    
  
  if (($gallery_id == '0000000000') && ( mysql_num_rows($result) == 0)) {
    echo "<p class='gallery_desc'>No galleries present</p>"; die();
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