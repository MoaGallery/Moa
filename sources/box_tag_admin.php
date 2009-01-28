<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Content-Type: text/html; charset=utf-8");
    include_once("_error_funcs.php");
    include_once("common.php");
    include_once("_db_funcs.php");
    $db = DBConnect();
    
    // Are we viewing \ editing or deleted?
    if (isset($_REQUEST["action"]) == false) {
    	 moa_warning("No action supplied.", true);
    	 die();
    }
    
    $action = $_REQUEST["action"];
  
    switch ($action)
    {
    	case "add" :
    	{
    	  add_tag();
        break;
    	}
    	case "view" :
    	{
    		view_tag();
    		break;
    	}
     	case "submit" :
    	{
    		submit_tag();
    		break;
    	}
    	case "delete" :
    	{
    		delete_tag();
    		break;
    	}
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    function display_tag_list() {
    	global $tab_prefix;

      $query = 'SELECT * FROM '.$tab_prefix.'tag ORDER BY Name';
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      
      while ($taglist = mysql_fetch_array($result)) 
      {       	 
        // Tag Data
        echo "<div class='tag_name' id='tag_name_".$taglist["IDTag"]."'>".html_display_safe($taglist["Name"])."</div>\n";
        echo "<div class='tag_link' id='tag_edit_link_".$taglist["IDTag"]."'><a class='admin_link' onclick='javascript: tag_edit( \"".$taglist["IDTag"]."\")'>[Edit]</a></div>\n";       	 
        echo "<div class='tag_link' id='tag_delete_link_".$taglist["IDTag"]."'><a class='admin_link' onclick='javascript: tag_delete( \"".$taglist["IDTag"]."\")'>[Delete]</a></div>\n";
        
        // Edit Controls
        echo "<div class='tag_edit_box' id='tag_edit_box_".$taglist["IDTag"]."'><input id='tag_edit_input_".$taglist["IDTag"]."' class='inline_element' type='text' name='tag_edit_box_".$taglist["IDTag"]."'></div>\n";
        echo "<div class='tag_button' id='tag_edit_submit_".$taglist["IDTag"]."'><button class='tag_buttons' onclick='javascript: tag_submit(\"".$taglist["IDTag"]."\")' class='inline_element'>Ok</button><img src='media/trans-pixel.png' width='6' height='1' alt='' /></div>\n";
        echo "<div class='tag_button' id='tag_edit_cancel_".$taglist["IDTag"]."'><button class='tag_buttons' onclick='javascript: tag_cancel(\"".$taglist["IDTag"]."\")' class='inline_element'>Cancel</button></div>\n";       	 
        echo "<br/>";
      }
    }    
    
    function add_tag() {
      global $tab_prefix;

      echo "<head>\n";
      echo "<link rel='stylesheet' href='../style/style.css' type='text/css'>\n";
      echo "</head>\n";
      echo "<body>\n";
       
      // If adding a tag
      if (isset($_REQUEST["tagname"]) == true)
      {
        $tagname = magic_url_decode($_REQUEST["tagname"]);
        
      	$query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string($tagname).'");';
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  
        if (0 == mysql_num_rows($result))
        {
          $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES (_utf8"'.mysql_real_escape_string($tagname).'");';
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        }
      }    
      
      display_tag_list();
      
      echo "</body>\n";
    }
        
    function view_tag() {
       global $tab_prefix;
       
       echo "<head>\n";
       echo "<link rel='stylesheet' href='../style/style.css' type='text/css'>\n";
       echo "</head>\n";
       echo "<body>\n";
       
       display_tag_list();

       echo "</body>\n";
    }
    
    function submit_tag() {    
    	global $tab_prefix;
    	
    	// Check for an ID
      if (isset($_REQUEST["tag_id"]))
      {
        $tag_id = $_REQUEST["tag_id"];
      } else 
      {
        echo "No tag id";
        die();
      }
      
      // Check for a new name
      if (isset($_REQUEST["value"]))
      {
        $value = magic_url_decode($_REQUEST["value"]);
      } else 
      {
        echo "No value supplied.";
        die();
      }

      // Check the ID exists
      $query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string($value).'");';
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  
      // It does
      if (0 == mysql_num_rows($result))
      {      
        $query = "UPDATE ".$tab_prefix."tag SET Name = _utf8'".mysql_real_escape_string($value)."' WHERE (IDTag = '".$tag_id."')";
        if ($result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__))
        {
          echo "OK";
        }
      }
    }
    
    function delete_tag() {    
    	global $tab_prefix;
    	
      if (isset($_REQUEST["tag_id"]))
      {
        $tag_id = $_REQUEST["tag_id"];
      } else 
      {
        echo "No tag id";
        die();
      }
      
      $query = "DELETE FROM ".$tab_prefix."imagetaglink WHERE (IDTag = '".$tag_id."')";
      $result = mysql_query($query);
      
      $query = "DELETE FROM ".$tab_prefix."gallerytaglink WHERE (IDTag = '".$tag_id."')";
      $result = mysql_query($query);
      
      $query = "DELETE FROM ".$tab_prefix."tag WHERE (IDTag = '".$tag_id."')";
      if ($result = mysql_query($query))
      {
        echo "OK";
      }
    }
?>