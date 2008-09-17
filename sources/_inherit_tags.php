<?php
  // Resets all tags
  $inherit_tags_query = "SELECT * FROM ".$tab_prefix."tag";
  $inherit_tags_result = mysql_query($inherit_tags_query) or die(mysql_error());

  while ($inherit_tags_taglist = mysql_fetch_array($inherit_tags_result))
  {
    unset ($_SESSION["tag-".$inherit_tags_taglist["IDTag"]]);
  }
  
  if (isset($_REQUEST["parent_id"]))
  {
    $inherit_tags_query = "SELECT IDTag FROM ".$tab_prefix."gallerytaglink WHERE (IDGallery=".mysql_real_escape_string($_REQUEST["parent_id"]).")";
    $inherit_tags_result = mysql_query($inherit_tags_query) or die(mysql_error());
    
    while ($inherit_tags_taglist = mysql_fetch_array($inherit_tags_result))
    {
      $_SESSION["tag-".$inherit_tags_taglist["IDTag"]] = true;
    }
  }
?>