<?php
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());        
    
    // Are we viewing \ editing or deleted?
    if (isset($_REQUEST["action"]) == false) {
    	 die("No action supplied");
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
      $result = mysql_query($query) or die("ERROR!".mysql_error()."<BR>");
      
      while ($taglist = mysql_fetch_array($result)) 
      {       	 
        // Spacer
        //echo"<img src='media/trans-pixel.png' width='1' height='20' alt=''/>";
        
        // Tag Data
        echo "<div class='tag_name' id='tag_name_".$taglist["IDTag"]."'>".$taglist["Name"]."</div>\n";
        echo "<div class='tag_link' id='tag_edit_link_".$taglist["IDTag"]."'><a class='admin_link' onclick='javascript: tag_edit( \"".$taglist["IDTag"]."\")'>[Edit]</a></div>\n";       	 
        echo "<div class='tag_link' id='tag_delete_link_".$taglist["IDTag"]."'><a class='admin_link' onclick='javascript: tag_delete( \"".$taglist["IDTag"]."\")'>[Delete]</a></div>\n";
        
        // Edit Controls
        echo "<div class='tag_edit_box' id='tag_edit_box_".$taglist["IDTag"]."'><input id='tag_edit_input_".$taglist["IDTag"]."' class='inline_element' type='text' name='tag_edit_box_".$taglist["IDTag"]."'></div>\n";
        echo "<div class='tag_button' id='tag_edit_submit_".$taglist["IDTag"]."'><button class='tag_buttons' onclick='javascript: tag_submit(\"".$taglist["IDTag"]."\")' class='inline_element'>Ok</button><img src='media/trans-pixel.png' width='6' height='1' alt=''/></div>\n";
        echo "<div class='tag_button' id='tag_edit_cancel_".$taglist["IDTag"]."'><button class='tag_buttons' onclick='javascript: tag_cancel(\"".$taglist["IDTag"]."\")' class='inline_element'>Cancel</button></div>\n";       	 
        echo "<br>";
      }
    }    
    
    function add_tag() {
      global $tab_prefix;

      echo "<head>\n";
      echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
      echo "</head>\n";
      echo "<body>\n";
       
      // If adding a tag
      if (isset($_REQUEST["tagname"]) == true)
      {
      	$query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
        $result = mysql_query($query) or die("ERROR!".mysql_error()."<br>");
  
        if (0 == mysql_num_rows($result))
        {      	
          $query = 'INSERT INTO '.$tab_prefix.'tag (Name) VALUES ("'.mysql_real_escape_string(strip_tags($_REQUEST["tagname"])).'");';
          $result = mysql_query($query) or die("ERROR!".mysql_error()."<BR>");
        }
      }       
      
      display_tag_list();
      
      echo "</body>\n";
    }
        
    function view_tag() {      
       global $tab_prefix;
       
       echo "<head>\n";
       echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
       echo "</head>\n";
       echo "<body>\n";
       
       display_tag_list();

       echo "</body>\n";
    }
    
    function submit_tag() {    
    	global $tab_prefix;
    	
      if (isset($_REQUEST["tag_id"]))
      {
        $tag_id = $_REQUEST["tag_id"];
      } else 
      {
        die();
      }
      
      if (isset($_REQUEST["value"]))
      {
        $value = strip_tags($_REQUEST["value"]);
      } else 
      {
        die();
      }

      $query = 'SELECT 1 FROM '.$tab_prefix.'tag WHERE UPPER(Name) = UPPER("'.mysql_real_escape_string($value).'");';
      $result = mysql_query($query) or die("ERROR!".mysql_error()."<br>");
  
      if (0 == mysql_num_rows($result))
      {      
        $query = "UPDATE ".$tab_prefix."tag SET Name = '".mysql_real_escape_string($value)."' WHERE (IDTag = '".$tag_id."')";
        if ($result = mysql_query($query))
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