<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Site map</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
      include_once("private/db_config.php");
      include_once("config.php");  
      
      $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      
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
          $description = str_replace("\'", "&#39;", mysql_real_escape_string(nl2br($description)));
          
          $popup = "onmouseover='return overlib(\"".$description."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }      
                
        echo "<div style='line-height:16px;'>";
        echo "<a class='nav_icon' href='view_gallery.php?gallery_id=".$id."' ".$popup."><img src='media/folder_open.png' style='vertical-align:bottom;'>&nbsp</a>";
        echo "<a id='nav_tree_".$id."' class='nav_link' href='view_gallery.php?gallery_id=".$id."' ".$popup.">".$name."</a><br>\n";    
        echo "</div></div>";
      }
      
      function get_sub_galleries( $parent_id, $level) 
      {    
        global $tab_prefix;
        
        $query = "SELECT IDGallery, name, description FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($parent_id)."')";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      
        if (($parent_id == '0000000000') && ( mysql_num_rows($result) == 0)) 
        {
          moa_warning("No galleries present.");
          include_once ("sources/_footer.php");
          echo "</body>\n</html>\n";
          die();
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

      echo"<img source='media\trans_pixel.png' width='400' height='1'>";

      echo "</td>\n</tr>";
      echo "</table>";

      include_once "sources/_footer.php";
    ?>
  </body>
</html>
