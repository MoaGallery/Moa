<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Site Map</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
      include_once("private/db_config.php");
      include_once("config.php");  
      
      $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
      mysql_select_db($db_name, $db) or die("Error" . mysql_error());
      
      function display_gallery_link( $id, $level, $name, $description)
      {        
        global $SHOW_EMPTY_DESC_POPUPS;
        global $EMPTY_DESC_POPUP_TEXT;
        
        for($loop = 0; $loop < $level; $loop++)
        {
          echo "&nbsp&nbsp ";
        }    
        
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
                
        echo "<a class='nav_icon' href='view_gallery.php?gallery_id=".$id."' ".$popup."><img src='media/folder_open.gif'>&nbsp </a>";
        echo "<a id='nav_tree_".$id."' class='nav_link' href='view_gallery.php?gallery_id=".$id."' ".$popup.">".$name."</a><br>\n";    
      }
      
      function get_sub_galleries( $parent_id, $level) 
      {    
        global $tab_prefix;
        
        $query = "SELECT IDGallery, name, description FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($parent_id)."')";
        $result = mysql_query($query) or die(mysql_error());    
      
        if (($parent_id == '0000000000') && ( mysql_num_rows($result) == 0)) 
        {
          echo "<p class='gallery_desc'>No galleries present</p>"; die();
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

      // Include DIV tags needed for dialogue boxs
      include_once("sources/_add_dialogue_layers.php");

      include_once "sources/_footer.php";
    ?>
  </body>
</html>
