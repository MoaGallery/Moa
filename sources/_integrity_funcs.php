<?php
  include_once($MOA_PATH."sources/mod_image_funcs.php");

  function GetNonTaggedOrphans()
  {
    global $tab_prefix;
    $hits = array();

    $query = "SELECT * FROM ".$tab_prefix."v_orphan_no_tags;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if ((is_bool($result)) && ($result == false))
    {
      return false;
    }

    while ($row = mysql_fetch_array($result))
    {
      $hit = new Image();
      $hit->m_id          = $row['IDImage'];
      $hit->m_description = $row['Description'];
      $hits[] = $hit;
    }

    return $hits;
  }

  function GetNoGalleryOrphans()
  {
  	global $tab_prefix;
    $hits = array();

    $query = "SELECT * FROM ".$tab_prefix."v_orphan_no_gallery;";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if ((is_bool($result)) && ($result == false))
    {
      return false;
    }

    while ($row = mysql_fetch_array($result))
    {
      $hit = new Image();
      $hit->m_id          = $row['IDImage'];
      $hit->m_description = $row['Description'];
      $hits[] = $hit;
    }

    return $hits;
  }
?>