    <?php
      include_once("config.php");
      include_once("sources/common.php");
      include_once("sources/_db_funcs.php");
      $db = DBConnect();

      // Shows one line of the sitemap
      function display_gallery_link( $p_id, $p_level, $p_name, $p_description)
      {
        global $SHOW_EMPTY_DESC_POPUPS;
        global $EMPTY_DESC_POPUP_TEXT;

        echo "<div style='height:19px;'><div style='float:left;width:".(12*$p_level)."px;height:16px;'></div>";

        if ($p_description == NULL)
        {
      	  if ($SHOW_EMPTY_DESC_POPUPS == true)
      	  {
      	    $popup = "";
      	  } else
      	  {
      	    $popup = "onmouseover='return overlib(\"".$EMPTY_DESC_POPUP_TEXT."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
          }
        } else
        {
          $p_description = str_replace("\'", "&#39;", str_display_safe($p_description));
          $p_description = str_replace('\"', '&#39;', str_display_safe($p_description));
          $p_description = str_replace("<","&lt;",$p_description);
          $p_description = str_replace(">","&gt;",$p_description);

          $popup = "onmouseover='return overlib(\"".$p_description."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }

        echo "<div style='line-height:16px;'>";
        echo "<a class='nav_icon' href='index.php?action=gallery_view&amp;gallery_id=".$p_id."' ".$popup."><img class='breadcrumbicon' src='media/folder_open.png' style='vertical-align:bottom;' alt='tree node' />&nbsp;</a>\n";
        echo "<a id='nav_tree_".$p_id."' class='nav_link' href='index.php?action=gallery_view&amp;gallery_id=".$p_id."' ".$popup.">".$p_name."</a><br/>\n";
        echo "</div></div>";
      }

      // Recurse through all galleries
      function get_sub_galleries( $p_parent_id, $p_level)
      {
        global $tab_prefix;

        $query = "SELECT IDGallery, name, description FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($p_parent_id)."')";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

        if (($p_parent_id == '0000000000') && ( mysql_num_rows($result) == 0))
        {
          echo "No galleries.";
        }
        else
        {
        	while ($gallery = mysql_fetch_array($result))
          {
          	display_gallery_link( $gallery["IDGallery"], $p_level, $gallery["name"], $gallery["description"]);

          	get_sub_galleries( $gallery["IDGallery"], $p_level + 1);
          }
        }
      }

      echo "<table class='area' cellpadding='5' cellspacing='0' id='add_table' width='300'>";
      echo "<tr><td class='box_header'>Site Map</td></tr>";
      echo "<tr><td class='pale_area_nb'>";

      get_sub_galleries( '0000000000', 0);

      echo"<img src='media\trans_pixel.png' width='400' height='1' alt='' />";

      echo "</td>\n</tr>";
      echo "</table>";

      $page_title = "Sitemap";
    ?>
