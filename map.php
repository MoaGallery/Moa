<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Site map</title>";
     ?>
  </head>
  <body>
    <?php
      include_once("sources/_header.php");
      include_once("config.php");  
      include_once("sources/common.php");
      include_once("sources/_db_funcs.php");
      $db = DBConnect();
      
      function display_gallery_link( $id, $level, $name, $description)
      {        
        global $SHOW_EMPTY_DESC_POPUPS;
        global $EMPTY_DESC_POPUP_TEXT;
        
        echo "<div style='height:19px;'><div style='float:left;width:".(12*$level)."px;height:16px;'></div>";
        
        if ($description == NULL) 
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
          $description = str_replace("\'", "&#39;", str_display_safe($description));
          $description = str_replace('\"', '&#39;', str_display_safe($description));
          $description = str_replace("<","&lt;",$description);
          $description = str_replace(">","&gt;",$description);
          
          $popup = "onmouseover='return overlib(\"".$description."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }      
                
        echo "<div style='line-height:16px;'>";
        echo "<a class='nav_icon' href='view_gallery.php?gallery_id=".$id."' ".$popup."><img class='breadcrumbicon' src='media/folder_open.png' style='vertical-align:bottom;' alt='tree node' />&nbsp;</a>\n";
        echo "<a id='nav_tree_".$id."' class='nav_link' href='view_gallery.php?gallery_id=".$id."' ".$popup.">".$name."</a><br/>\n";    
        echo "</div></div>";
      }
      
      function get_sub_galleries( $parent_id, $level) 
      {    
        global $tab_prefix;
        
        $query = "SELECT IDGallery, name, description FROM ".$tab_prefix."gallery WHERE (IDParent='".$parent_id."')";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      
        if (($parent_id == '0000000000') && ( mysql_num_rows($result) == 0)) 
        {
          echo "No galleries.";
        }
        else
        {
        	while ($gallery = mysql_fetch_array($result)) 
          {
          	display_gallery_link( $gallery["IDGallery"], $level, $gallery["name"], $gallery["description"]);
          	
          	get_sub_galleries( $gallery["IDGallery"], $level + 1);
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

      include_once "sources/_footer.php";
    ?>
  </body>
</html>
