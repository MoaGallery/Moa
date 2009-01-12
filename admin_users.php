<?php
  class user
    {
      var $Name;
      var $ID;
      var $Admin;
    };
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php 
      include_once ("sources/_html_head.php");
    ?>
    <title>User management</title>
     
    <script type="text/javascript">
      <?php 
        include_once("sources/_ajax.js.php");
      ?>
      var validname = true;
      var original_name;
      function ajaxCheckUserName(name)
      {
        var xmlHttp = GetAjaxObject();
        
        xmlHttp.onreadystatechange=function()
        {
        if(xmlHttp.readyState==4)
          {
            if ((xmlHttp.responseText == "OK") || (original_name == document.getElementById("namebox").value))
            {
              validname = true;
            } else
            {
              validname = false;
            }
          }
        }    
        
        xmlHttp.open("GET","sources/_checkusername.php?name="+name,true);
      
        xmlHttp.send(null);
      }

      function checkKey(e)
      {					
       var characterCode
    					
       if(e && e.which)
       {				
         e = e	
         characterCode = e.which
       }				
       else		
       {				
         //e = event
         characterCode = e.keyCode
       }				
      				
       // Check for enter
       if(characterCode == 13)
       {				
         document.getElementById("formsubmit").click();
         return false
       }

       return true
      }
      
      function user_delete (id)
      {
        if (confirm("Are you sure you want to delete this user?"))
        {
          window.location = "admin_users.php?action=delete&user_id="+id;
        }
      }
    </script>
  </head>
  <body>  
    <?php
      include_once "sources/_header.php";
      include_once "sources/id.php";
    
      if ((NULL == $Userinfo->ID) || (0 == $Userinfo->UserAdmin))
      {
        moa_warning("You must have admin rights to use this page.");
      } else
      {
        include("sources/_admin_page_links.php");
        
        if (isset($_REQUEST["action"]) == false)
        {
          $action = "view";
        } else
        {
          $action = $_REQUEST["action"];
        }
        
        switch ($action)
        {
        	case "add" :
        	{
        	  add_user();
            break;
        	}
        	case "edit" :
        	{
        		edit_user();
        		break;
        	}
         	case "delete" :
        	{
        		delete_user();
        		break;
        	}
        	case "view" :
        	{
        		view_user();
        		break;
        	}
        	default :
        	{
        	  moa_warning("Unknown action.");
        	  break;
        	}
        }
      }
      
      include_once "sources/_footer.php";  
    ?>
  </body>
</html>

<?php
  function view_user()
  {
    global $tab_prefix;
    
    if (isset($_REQUEST["mode"]))
    {
      $mode = $_REQUEST["mode"];
      if (0 == strcmp($_REQUEST["mode"], "add"))
      {
        $name = mysql_real_escape_string(strip_tags($_REQUEST["name"]));
        $pass = mysql_real_escape_string(strip_tags($_REQUEST["pass1"]));
        if (isset($_REQUEST["admin"]))
        {
          $admin = 1;
        } else
        {
          $admin = 0;
        }
        $query = "SELECT Name FROM ".$tab_prefix."users WHERE Name = '".$name."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        if (0 < mysql_fetch_array($result))
        {
          moa_error("That user already exists<br/>");
        } else
        {
          $query = "INSERT INTO ".$tab_prefix."users (Name, Password, Admin, Salt) VALUES ('".$name."', PASSWORD('".$pass."'),".$admin.", '000000')";
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        }
      }
      if (0 == strcmp($_REQUEST["mode"], "edit"))
      {
        $name = mysql_real_escape_string(strip_tags($_REQUEST["name"]));
        $pass = mysql_real_escape_string(strip_tags($_REQUEST["pass1"]));
        $id = mysql_real_escape_string(strip_tags($_REQUEST["id"]));
        if (isset($_REQUEST["admin"]))
        {
          $admin = 1;
        } else
        {
          $admin = 0;
        }
        $query = "SELECT IDUser FROM ".$tab_prefix."users WHERE IDUser = '".$id."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        if (0 == mysql_fetch_array($result))
        {
          moa_error("Invalid user\n");
        }
        if (0 < strlen($pass))
        {
          $pass_string = "Password= PASSWORD('".$pass."'), ";
        } else
        {
          $pass_string = "";
        }
        $query = "UPDATE ".$tab_prefix."users SET Name='".$name."', ".$pass_string."Admin=".$admin." WHERE IDUser='".$id."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      }
    }
    
    $users = array();
    
    $query = "SELECT * FROM ".$tab_prefix."users ORDER BY Admin DESC, Name";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    $loop = 0;
    while ($userlist = mysql_fetch_array($result)) 
    {
      $users[$loop] = new User;
      $users[$loop]->Name = $userlist["Name"];
      $users[$loop]->ID = $userlist["IDUser"];
      $users[$loop]->Admin = $userlist["Admin"];
      $loop++;
    }
    ?>
    <table class='area_nb' height='100%' width='400px' cellpadding='5' cellspacing='0' >
      <tr>
        <td><div class='box_header'>User admin</div></td>
      </tr>
      <tr>
        <td class='pale_area_nb'>
        <a class='admin_link' href='admin_users.php?action=add'>[Add new user]</a><br/><br/>
          <?php
            foreach($users as $user)
            {
              echo "<div class='user_name'>".$user->Name."</div>";
              echo "<div class='user_admin'>";
              if (1 == $user->Admin)
              {
                echo "Admin";
              } else
              {
                echo "&nbsp;";
              }
              echo "</div>";
              echo "<div class='user_link'>";
              echo "<a href='admin_users.php?action=edit&user_id=".$user->ID."' class='admin_link'>[Edit]</a>";
              echo "<a class='admin_link' onclick='javascript: user_delete(\"".$user->ID."\");'>[Delete]</a>";
              echo "</div>";
              echo "<br/>\n";
            }
          ?>
        </td>
      </tr>
    </table>
    <?php
  }
  
  function add_user()
  {
    $user = new user;
    $user->Name = "";
    $user->ID = "0000000000";
    $user->Password = "";
    $user->Admin=0;
    show_user_form($user);
  }
  
  function edit_user()
  {
    global $tab_prefix;
    
    $user = new user;
    
    if (false == isset($_REQUEST["user_id"]))
    {
      moa_warning("No user specified to edit");
      return;
    }
    $query = "SELECT IDUser, Name, Admin FROM ".$tab_prefix."users WHERE IDUser = '".mysql_real_escape_string(strip_tags($_REQUEST["user_id"]))."'";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    $user_rec = mysql_fetch_array($result);
    if (0 < $user_rec)
    {
      $user->Name = $user_rec["Name"];
      $user->ID = $user_rec["IDUser"];
      $user->Admin=$user_rec["Admin"];
    } else
    {
      moa_warning("Invalid user\n");
      return;
    }
    
    show_user_form($user);
  }
  
  function delete_user()
  {
    global $tab_prefix;
    
    if (false == isset($_REQUEST["user_id"]))
    {
      moa_warning("No user specified to delete.");
    } else
    {
      $user = $_REQUEST["user_id"];
      $goahead = true;
      $name = "";
      
      // Check the user exists
      $query = "SELECT IDUser, Name FROM ".$tab_prefix."users WHERE IDUser = '".$user."'";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      $count = mysql_affected_rows();
      if (0 == $count)
      {
        moa_warning("User not found, cannot delete.");
        $goahead = false;
      } else
      {
        $row = mysql_fetch_array($result);
        $name = $row["Name"];
        // Check they are not the last remaining admin
        $query = "SELECT IDUser FROM ".$tab_prefix."users WHERE Admin = '1'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        $count = mysql_affected_rows();
        if (1 == $count)
        {
          $row = mysql_fetch_array($result);
          $deluser = $row["IDUser"];
          if ($deluser == $user)
          {
            moa_warning("You cannot delete the last admin user.");
            $goahead = false;
          }
        } 
      }
      
      if (true == $goahead)
      {
        $query = "DELETE FROM ".$tab_prefix."users WHERE IDUser = '".$user."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        $count = mysql_affected_rows();
        moa_success("User '".$name."' deleted");
      }
    }
   
    view_user();
  }
  
  function show_user_form($user)
  {
    ?>
    <table class='area_nb' height='100%' cellpadding='5' cellspacing='0' >
      <tr>
        <td>
          <div class='box_header'>
          <?php
            if (0 == $user->ID)
            {
              echo "Add user";
              $mode = "add";
            } else
            {
              echo "Edit user";
              $mode = "edit";
            }
          ?>
          </div></td>
      </tr>
      <tr>
        <td class='pale_area_nb'>
          <form name="edit_form" method="post" action="admin_users.php?action=view"  enctype="multipart/form-data">
            <div class="form_label_text" style="width:120px; float:left;">Name</div>
              <input name="name" id="namebox" type="text" onKeyPress='checkKey(event);' onKeyUp='ajaxCheckUserName(document.getElementById("namebox").value);' value="<?php echo $user->Name; ?>"></input><br/>
            <div class="form_label_text" style="width:120px; float:left;">Admin</div>
                <input name="admin" type="checkbox" onKeyPress='checkKey(event)'<?php
                if (1 == $user->Admin)
                {
                  echo " checked='true'";
                }
                ?>"></input><br/>
            <div class="form_label_text" style="width:120px; float:left;">Password</div>
                <input name="pass1" type="password" onKeyPress='checkKey(event)' value=""></input><br/>
            <div class="form_label_text" style="width:120px; float:left;">Confirm Password</div>
                <input name="pass2" type="password" onKeyPress='checkKey(event)' value=""></input><br/><br/>
            <input name="id" type="hidden" value="<?php echo $user->ID; ?>"></input>
            <input name="mode" type="hidden" value="<?php echo $mode; ?>"></input>
            <input type="button" id="formsubmit" value="Submit" onclick="validate();">
            <input type="button" id="formcancel" value="Cancel" onclick="document.location='admin_users.php';">
          </form>
        </td>
      </tr>
    </table>
    <script type="text/javascript">
      document.getElementById("namebox").focus();
      original_name = document.getElementById("namebox").value;
      
      function validate()
      {
        pass1 = document.edit_form.pass1.value;
        pass2 = document.edit_form.pass2.value;
        valid = true;
        if (pass1 != pass2)
        {
          alert ("The passwords do not match");
          valid = false;
        }
        
        if ('<?php echo $mode; ?>' == 'add')
        {
          if (0 == document.edit_form.pass1.value.length)
          {
            alert ("No password given");
            valid = false;
          }
        }
        
        if ((false == validname) && (original_name != document.getElementById("namebox").value))
        {
          alert ("That username is already in use");
          valid = false;
        }
        
        if (valid)
        {
          document.edit_form.submit();
        }
      }
    </script>
    <?php
  }
?>
