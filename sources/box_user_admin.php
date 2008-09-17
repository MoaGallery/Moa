<?php
    header("Cache-Control: no-cache, must-revalidate");

    include_once("../private/db_config.php");
    include_once("../config.php");

    
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error - " . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());        

    include_once("id.php");
    
    // Are we viewing \ editing or deleted?
    if (isset($_REQUEST["action"]) == false) {
    	 die("No action supplied");
    }
    
    $action = $_REQUEST["action"];
  
    switch ($action)
    {
    	case "add" :
    	{
    	  add_user();
        break;
    	}
    	case "view" :
    	{
    		view_user( true);
    		break;
    	}
     	case "submit" :
    	{
    		submit_user();
    		break;
    	}
    	case "delete" :
    	{
    		delete_user();
    		break;
    	}
    	case "changepass" :
    	{
    		change_password();
    		break;
    	}
    }    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////
   
    function add_user() {
    	global $tab_prefix;
    	global $Userinfo;
    	
      echo "<head>\n";
      echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
      echo "</head>\n";
      echo "<body>\n";

      // If adding a user
      if ((isset($_REQUEST["username"]) == true) && (true == $Userinfo->UserAdmin))
      {
        $admin = 0;
        if (0 == strcmp(mysql_real_escape_string(strip_tags($_REQUEST["admin"])), "true"))
        { 
          $admin = 1;
        }
        $query = 'INSERT INTO '.$tab_prefix.'users (Name, Password, Admin) VALUES ("'.mysql_real_escape_string(strip_tags($_REQUEST["username"])).'", PASSWORD("'.mysql_real_escape_string(strip_tags($_REQUEST["password"])).'"), "'.$admin.'");';
        $result = mysql_query($query) or die("ERROR!".mysql_error()."<BR>");
      }
      
      view_user( false);
    }        
    
    function view_user( $full) {
    	 global $tab_prefix;
    	 global $Userinfo;
      
       if (true == $full)
       {
         echo "<head>\n";
         echo "<link rel='stylesheet' href='../template/default/style.css' type='text/css'>\n";
         echo "</head>\n";
         echo "<body>\n";
       }
       
       $query = 'SELECT * FROM '.$tab_prefix.'users';
       $result = mysql_query($query) or die("ERROR!".mysql_error()."<BR>");

       echo "<div class='user_name' style='font-size: 60%; font-weight: bold;'>Name</div>\n";
       echo "<div class='user_admin' style='font-size: 60%; font-weight: bold;'>Admin</div><br/>\n";
       
       while ($userlist = mysql_fetch_array($result)) 
       {       	 
       	 // User Data
      	 echo "<div class='user_name' id='user_name_".$userlist["IDUser"]."'>".$userlist["Name"]."</div>\n";
      	 echo "<div class='user_admin' id='user_admin_".$userlist["IDUser"]."'>";
      	       	       	 
      	 if (1 == $userlist["Admin"])
      	 {
      	   echo "Yes";
         }
      	 echo "</div> \n";
      	       	      	 
      	 if ((true == $Userinfo->UserAdmin) || ($Userinfo->ID == $userlist["IDUser"]))
      	 {
        	 echo "<div class='user_link' id='user_edit_link_".$userlist["IDUser"]."'><a class='admin_link' onclick='javascript: user_edit( \"".$userlist["IDUser"]."\")'>[Edit]</a></div>\n";       	 
        	 
        	 if (true == $Userinfo->UserAdmin) 
        	 {        	         	 
        	   echo "<div class='user_link' id='user_delete_link_".$userlist["IDUser"]."'><a class='admin_link' onclick='javascript: user_delete( \"".$userlist["IDUser"]."\")'>[Delete]</a></div>\n";
        	 }
        	 else
        	 {
        	 	 echo "<div class='user_link' id='user_delete_link_".$userlist["IDUser"]."'>&nbsp;</div>\n";        	 	 
        	 }
        	 
        	 echo "<div class='user_link' id='user_password_link_".$userlist["IDUser"]."'><a class='admin_link' onclick='javascript: show_ChangePass( \"".$userlist["IDUser"]."\")'>[Change&nbsp;Password]</a></div>\n";
        	 
        	 // Edit Controls        	 
        	 echo "<div class='user_edit_box' id='user_edit_namebox_".$userlist["IDUser"]."'><input id='user_edit_inputname_".$userlist["IDUser"]."' class='inline_element' type='text' name='user_edit_namebox_".$userlist["IDUser"]."'></div>\n";
        	 
        	 if (true == $Userinfo->UserAdmin) 
        	 {
        	   echo "<div class='user_check_box' id='user_edit_adminbox_".$userlist["IDUser"]."'>&nbsp;&nbsp;<input id='user_edit_inputadmin_".$userlist["IDUser"]."' class='inline_element' type='checkbox' name='user_edit_namebox_".$userlist["IDUser"]."'";
        	 
        	   if (1 == $userlist["Admin"])
        	   {
        	     echo " checked='checked'";
             }
             echo "></div>\n";
        	 }
        	 else
        	 {
        	 	 echo "<div class='user_check_box' id='user_edit_adminbox_".$userlist["IDUser"]."'>&nbsp;&nbsp;<img src='media/trans-pixel.png' id='user_edit_inputadmin_".$userlist["IDUser"]."'/></div>\n";
        	 }        	 
        	         	         	 
        	 echo "<div class='user_button' id='user_edit_submit_".$userlist["IDUser"]."'><button class='user_buttons' onclick='javascript: user_submit(\"".$userlist["IDUser"]."\")' class='inline_element'>Submit</button></div>\n";
        	 echo "<div class='user_button' id='user_edit_cancel_".$userlist["IDUser"]."'><button class='user_buttons' onclick='javascript: user_cancel(\"".$userlist["IDUser"]."\")' class='inline_element'>Cancel</button></div>\n";       	 
      	 }
       	 echo "<br>";
       }
       echo "</body>\n";
    }
    
    function submit_user() {    
    	global $tab_prefix;
    	global $Userinfo;
    	
      if (isset($_REQUEST["user_id"]))
      {
        $user_id = mysql_real_escape_string($_REQUEST["user_id"]);
      } else 
      {
        die("user");
      }
      if (isset($_REQUEST["name"]))
      {
        $name = mysql_real_escape_string(strip_tags($_REQUEST["name"]));
      } else 
      {
        die("name");
      }
      
      if (isset($_REQUEST["admin"]))
      {
        $admin2 = mysql_real_escape_string(strip_tags($_REQUEST["admin"]));
        $admin = 0;
        if ('true' == $admin2)
        {
          $admin = 1;
        }
      } else 
      {
        die("admin");
      }            
      
      $query = "SELECT count(1) AS num_users FROM ".$tab_prefix."users WHERE (UPPER(Name) = UPPER('".$name."')) AND (IDUser !='".$user_id."')";
      $result = mysql_query($query);
      $row = mysql_fetch_array($result);
      if (0 <  $row["num_users"])
      {
        die("NameInUse");
      }
      
      if (0 == $admin)
      {
      	$query = "SELECT count(1) AS num_users FROM ".$tab_prefix."users WHERE admin = 1";
        $result = mysql_query($query);	
      	$row = mysql_fetch_array($result);      	
      	
      	if (1 >= $row["num_users"])
        {
          die("LastAdmin");
        }
      }
      
      if (true == $Userinfo->UserAdmin)
      {
        $query = "UPDATE ".$tab_prefix."users SET Name = '".$name."', Admin = '".$admin."' WHERE (IDUser = '".$user_id."')";              
      
        if ($result = mysql_query($query))
        {
          echo "OK";
        }
      } 
      elseif ($user_id == $Userinfo->ID)
      {
        $query = "UPDATE ".$tab_prefix."users SET Name = '".$name."' WHERE (IDUser = '".$user_id."')";
        if ($result = mysql_query($query))
        {
          echo "OK";
        }      	
      }	
      else      
      {
        echo "No user admin rights";
      }
    }
    
    function delete_user() {    
    	global $tab_prefix;
    	global $Userinfo;
    	
      if (isset($_REQUEST["user_id"]))
      {
        $user_id = $_REQUEST["user_id"];
      } else 
      {
        die();
      }
      
      if (true == $Userinfo->UserAdmin)
      {
        $query = "DELETE FROM ".$tab_prefix."users WHERE (IDUser = '".$user_id."')";
        if ($result = mysql_query($query))
        {
          echo "OK";
        }
      } else
      {
        echo "No user admin rights";
      }
    }
    
    function change_password() {    
    	global $tab_prefix;
    	global $Userinfo;
    	
      if (isset($_REQUEST["user_id"]))
      {
        $user_id = mysql_real_escape_string($_REQUEST["user_id"]);
      } else 
      {
        die("user");
      }                        
  
      $query = 'UPDATE '.$tab_prefix.'users SET Password = PASSWORD("'.mysql_real_escape_string(strip_tags($_REQUEST["password"])).'") WHERE (IDUser = "'.$user_id.'")';
      if ($result = mysql_query($query))
      {
        echo "OK";
      }
    }
?>