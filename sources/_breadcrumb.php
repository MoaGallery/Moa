<?php
  class Nav 
  {
    var $m_name;
    var $m_id;
  };

	function ShowBreadcrumbBar($p_gal_id)
	{
		global $tab_prefix;
	
		$temp_nav_history = Array();
		
		// Find parent galleries going back to Home gallery 
	  while (0 != strcmp($p_gal_id, "0000000000"))
	  {
	    $query = "SELECT Name, IDParent FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($p_gal_id)."')";
	    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	    $gal_name = mysql_fetch_array($result) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	    $nav = new Nav;
	    $nav->m_name = $gal_name["Name"];
	    $nav->m_id = $p_gal_id;
	    $temp_nav_history[] = $nav;
	    $p_gal_id = $gal_name["IDParent"];
	  }
	  
	  // Add home gallery list history list 
	  $nav = new Nav;
	  $nav->m_name = "Home";
	  $nav->m_id = "0000000000";
	  $temp_nav_history[] = $nav;
	
	  $nav_history = array_reverse($temp_nav_history);
	
	  echo "<div class='breadcrumb_box pale_area_nb'>\n";
	  $count = 0;
	  foreach($nav_history as $nav_node)
	  {
	    echo "<div style='height:19px;'>\n";
	    echo "  <div style='float:left;width:".(12*$count)."px;height:16px;'></div>";
	
	    if (0 == strcmp($nav_node->m_id, "0000000000"))
	    {
	      echo "  <div style='line-height:16px;'>\n";
	      echo "    <a class ='nav_icon' href='index.php'><img class='breadcrumbicon' src='media/folder_open.png' style='vertical-align:middle; margin-top:1px;' alt='Folder icon'/>&nbsp;</a>\n";
	      echo "    <a id='nav_tree_0000000000' class='nav_link' href='index.php'>".html_display_safe($nav_node->m_name)."</a><br/>\n";
	      echo "  </div>\n";
	    } else
	    {
	      echo "  <div style='line-height:16px;'>\n";
	      echo "    <a class='nav_icon' href='index.php?action=gallery_view&amp;gallery_id=".$nav_node->m_id."'><img class='breadcrumbicon' src='media/folder_open.png' style='vertical-align:middle;' alt='Folder icon'/>&nbsp;</a>\n";
	      echo "    <a id='nav_tree_".$nav_node->m_id."' class='nav_link' href='index.php?action=gallery_view&amp;gallery_id=".$nav_node->m_id."'>".html_display_safe($nav_node->m_name)."</a><br/>\n";
	      echo "  </div>\n";
	    }
	    echo "</div>\n";
	
	    $count++;
	  }
	  echo "</div>\n";
	}
?>