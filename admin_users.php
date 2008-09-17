<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>User Management</title>";
     ?>
  </head>
  <body>  
     <?php
       include_once "sources/_header.php";
       include_once "sources/id.php";
     ?>
     <script type="text/javascript">
       <?php 
         include_once("sources/_ajax.js.php");
       ?>
        // User Add Functions
        function resize_fade()
        {
          var fade = document.getElementById("fade");
          var tab = document.getElementById("add_user_table");
          fade.style.width = tab.offsetWidth;
          fade.style.height = tab.offsetHeight;
          fade.style.left = tab.offsetLeft;
          fade.style.top = tab.offsetTop;
        }
        
        function show_adduser()
        {
          resize_fade();
          var dia = document.getElementById("add_user_dialogue");
          var tab = document.getElementById("add_user_table");
          dia.style.left = (tab.offsetWidth/2)-75;
          document.getElementById("add_user_dialogue").style.visibility = "visible";
          document.getElementById("fade").style.visibility = "visible";
          document.getElementById("newusername").focus();
        }
        
        function hide_adduser()
        {
          document.getElementById("add_user_dialogue").style.visibility = "hidden";
          document.getElementById("fade").style.visibility = "hidden";          
        }
        
        window.onresize=resize_fade;
        
        function show_ChangePass( id)
        {
          resize_fade();
          var dia = document.getElementById("add_dialogue"); 
          var tab = document.getElementById("add_user_table");
          dia.style.left = (tab.offsetWidth/2)-75;
          
          document.getElementById("newpassid").value = id;
          
          document.getElementById("add_dialogue").style.visibility = "visible";
          document.getElementById("fade").style.visibility = "visible";                    
          
          document.getElementById("newpass").focus();
        }
        
        function hide_ChangePass()
        {
          document.getElementById("add_dialogue").style.visibility = "hidden";
          document.getElementById("fade").style.visibility = "hidden";
        }        
        
        function submit_ChangePass(NewPassword,UserID)
        {            
        var xmlHttp = GetAjaxObject();
    
          xmlHttp.onreadystatechange=function()
          {
          if(xmlHttp.readyState==4)
            {
          //    document.getElementById("userlist").innerHTML=xmlHttp.responseText;
            }
          }
            
          xmlHttp.open("GET","sources/box_user_admin.php?action=changepass&user_id="+UserID+"&password="+NewPassword,true);
          xmlHttp.send(null);
        }
        
        // User Edit Functions
        function ajaxUserView()
        {
        var xmlHttp = GetAjaxObject();
    
          xmlHttp.onreadystatechange=function()
          {
          if(xmlHttp.readyState==4)
            {
              document.getElementById("userlist").innerHTML=xmlHttp.responseText;
            }
          }
          xmlHttp.open("GET","sources/box_user_admin.php?action=view",true);
          xmlHttp.send(null);
        }
        
        // User Edit Functions
        function ajaxUserList(NewUserName, Admin, NewPassword)
        {            
        var xmlHttp = GetAjaxObject();
    
          xmlHttp.onreadystatechange=function()
          {
          if(xmlHttp.readyState==4)
            {
              document.getElementById("userlist").innerHTML=xmlHttp.responseText;
            }
          }
            
          xmlHttp.open("GET","sources/box_user_admin.php?action=add&username="+NewUserName+"&admin="+Admin+"&password="+NewPassword,true);
          xmlHttp.send(null);
        }      
    
        function hide_div( name)
        {
        	 document.getElementById(name).style.display = "none";      	 
        	 document.getElementById(name).style.position = "absolute";
        	 document.getElementById(name).style.cssFloat = "none";
        }
  
        function show_div( name)
        {      	       	
        	 document.getElementById(name).style.position = "static";      	      	 
        	 document.getElementById(name).style.cssFloat = "left";      	 
        	 document.getElementById(name).style.display = "block";
        }
  
        function user_edit( id)
        {
        	 hide_div("user_edit_link_" + id);
        	 hide_div("user_delete_link_" + id);      	 
        	 hide_div("user_name_" + id);      	       	 
        	 hide_div("user_admin_" + id);      	       	 
        	 hide_div("user_password_link_" + id);
        	           
        	 show_div("user_edit_namebox_" + id);
        	 show_div("user_edit_adminbox_" + id);
        	 show_div("user_edit_submit_" + id);
        	 show_div("user_edit_cancel_" + id);
        	 
        	 document.getElementById("user_edit_namebox_" + id).style.clear = "left";      	      	 
        	 //document.getElementById("user_edit_adminbox_" + id).style.clear = "left";      	      	 
        	 document.getElementById("user_edit_inputname_" + id).value = document.getElementById("user_name_" + id).innerHTML;
        	 
        	 if (document.getElementById("user_admin_"+id).tagName == "INPUT")                 
        	 {
        	   document.getElementById("user_edit_inputadmin_" + id).value = document.getElementById("user_admin_" + id).value;
        	 }      	       	 
        }            
        
        function user_cancel( id)
        {
        	 show_div("user_edit_link_" + id);
        	 show_div("user_delete_link_" + id);      	 
        	 show_div("user_name_" + id);      	       	 
        	 show_div("user_admin_" + id);   
        	 show_div("user_password_link_" + id);
        	 
        	 hide_div("user_edit_namebox_" + id);
        	 hide_div("user_edit_adminbox_" + id);
        	 hide_div("user_edit_submit_" + id);
        	 hide_div("user_edit_cancel_" + id);
        	 
        	 document.getElementById("user_edit_namebox_" + id).style.clear = "none";      	      	       	 
        	 document.getElementById("user_edit_adminbox_" + id).style.clear = "none";      	      	       	 
        	 
        	 if ("INPUT" == document.getElementById("user_edit_inputadmin_"+id).tagName)
           {
             if ("Yes" == document.getElementById("user_admin_"+id).innerHTML)
             {
               document.getElementById("user_edit_inputadmin_"+id).checked = true;
             }
             else
             {
               document.getElementById("user_edit_inputadmin_"+id).checked = false;
             }                                
           }
        }
        
        function user_submit( id)
        {          
          var xmlHttp = GetAjaxObject();
    
          var new_name = document.getElementById("user_edit_inputname_"+id).value;                    
          
          if (document.getElementById("user_edit_inputadmin_"+id).tagName == "INPUT")         
          {
            var new_admin = document.getElementById("user_edit_inputadmin_"+id).checked;
          }
          else
          {
          	var new_admin = 'false';
          }
         
          user_cancel(id);
          
          if (new_name.length > 0)
          {
            xmlHttp.onreadystatechange=function()
            {
            if(xmlHttp.readyState==4)
              {                
                if ("OK" == xmlHttp.responseText)
                {
                  document.getElementById("user_name_"+id).innerHTML=new_name;
                  if (document.getElementById("user_admin_"+id).tagName == "INPUT")                 
                  {
                  	document.getElementById("user_admin_"+id).innerHTML="";
                  }                                                      
                  
                  if (true == new_admin)
                  {
                    document.getElementById("user_admin_"+id).innerHTML="Yes";
                    document.getElementById("user_edit_inputadmin_"+id).checked = true;
                  }
                  else {
                  	document.getElementById("user_admin_"+id).innerHTML="";                  
                  	document.getElementById("user_edit_inputadmin_"+id).checked = false;
                  }
                }                                                                
                
                if ("NameInUse" == xmlHttp.responseText)
                {
                  alert("A user by that name already exists");
                }                                
                
                if ("LastAdmin" == xmlHttp.responseText)
                {
                  alert("11th Commandment: Thou shalt not delete the last remaining admin.");                  
                }
                
                if ("INPUT" == document.getElementById("user_edit_inputadmin_"+id).tagName)
                {
                  if ("Yes" == document.getElementById("user_admin_"+id).innerHTML)
                  {
                    document.getElementById("user_edit_inputadmin_"+id).checked = true;
                  }
                  else
                  {
                    document.getElementById("user_edit_inputadmin_"+id).checked = false;
                  }                                
                }
              }
            }
            xmlHttp.open("GET","sources/box_user_admin.php?action=submit&user_id="+id+"&name="+escape(new_name)+"&admin="+new_admin,true);
            xmlHttp.send(null);
          } else
          {
            alert("You must enter a username and password");
          }
        }
        
        function user_delete( id)
        {
          var xmlHttp = GetAjaxObject();
    
          xmlHttp.onreadystatechange=function()
          {
            if(xmlHttp.readyState==4)
            { 
              if (xmlHttp.responseText == "OK")
              {
                ajaxUserView();
              }
            }
          }
          xmlHttp.open("GET","sources/box_user_admin.php?action=delete&user_id="+id,true);
          xmlHttp.send(null);
        }
     </script>

	  <title>User Management</title>
  </head>
  <body>
    <?php
      if ($Userinfo->ID == NULL) {
      	echo "You are not logged in.";
    
      	include_once "sources/_footer.php";
      	echo "</BODY>\n</HTML>";
    
      	die();
      }
    
      include("sources/_admin_page_links.php");
      
      echo "<table class='area' cellpadding='5' cellspacing='0' width='600px' id='add_user_table'>";
      echo "<tr><td class='box_header'>View all users</td></tr>";
      echo "<tr><td class='pale_area_nb'>";
      
      // Show button to add new user
      echo "<a href='javascript:void(0)' class='admin_link' onclick='javascript:show_adduser()'>[Add new user]</a><br><br>";
      
      echo "<table><tr><td><img src='media/trans-pixel.png' width='1' height='200' alt=''/></td><td valign='top'>";
      echo "<span id='userlist'><img src='media/loading.png' alt='Loading' title=''/></span>";
      echo "</td></tr></table>";
      echo "</td>\n</td>\n</table>";
    
      // Include DIV tags need for dialogue boxs 
      include_once("sources/_add_user_layers.php");
      include_once("sources/_change_password_layers.php");
      
      include_once "sources/_footer.php";  
    ?>
    <script type="text/javascript">
      ajaxUserView();
    </script>
  </body>
</html>
