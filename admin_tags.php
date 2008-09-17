<html>	 	
	<head>		
    <?php
       include_once ("sources/_html_head.php");      
       
       echo "<title>Tag Management</title>";
    ?>
    <script type="text/javascript">      
      <?php
        include_once("sources/_ajax.js.php");                
      ?>
    
      // Tag Add Functions
      function resize_fade()
      {
        var fade = document.getElementById("fade");
        var tab = document.getElementById("add_table");
        fade.style.width = tab.offsetWidth;
        fade.style.height = tab.offsetHeight;
        fade.style.left = tab.offsetLeft;
        fade.style.top = tab.offsetTop;
      }
      
      function show_add()
      {
        resize_fade();
        var dia = document.getElementById("add_dialogue");
        var tab = document.getElementById("add_table");
        dia.style.left = (tab.offsetWidth/2)-75;
        document.getElementById("add_dialogue").style.visibility = "visible";
        document.getElementById("fade").style.visibility = "visible";
      }
      
      function hide_add()
      {
        document.getElementById("add_dialogue").style.visibility = "hidden";
        document.getElementById("fade").style.visibility = "hidden";
      }
      
      window.onresize=resize_fade;    
      
      // Tag Edit Functions
      function ajaxTagView()
      {
      var xmlHttp = GetAjaxObject();
      
        xmlHttp.onreadystatechange=function()
        {
          if(xmlHttp.readyState==4)
          {
             document.getElementById("taglist").innerHTML=xmlHttp.responseText;
          }
        }
        xmlHttp.open("GET","sources/box_tag_admin.php?action=view",true);
        xmlHttp.send(null);
      }
        
      // Tag Edit Functions
      function ajaxTagList(NewTagName)
      {            
      var xmlHttp = GetAjaxObject();
    
        xmlHttp.onreadystatechange=function()
        {
        if(xmlHttp.readyState==4)
          {
            document.getElementById("taglist").innerHTML=xmlHttp.responseText;
          }
        }
          
        xmlHttp.open("GET","sources/box_tag_admin.php?action=add&tagname="+NewTagName,true);
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
    
      function tag_edit( id)
      {
      	 hide_div("tag_edit_link_" + id);
      	 hide_div("tag_delete_link_" + id);      	 
      	 hide_div("tag_name_" + id);      	       	 
      	 
      	 show_div("tag_edit_box_" + id);
      	 show_div("tag_edit_submit_" + id);
      	 show_div("tag_edit_cancel_" + id);
      	 
      	 document.getElementById("tag_edit_box_" + id).style.clear = "left";      	      	 
      	 document.getElementById("tag_edit_input_" + id).value = document.getElementById("tag_name_" + id).innerHTML;
      }            
      
      function tag_cancel( id)
      {
      	 show_div("tag_edit_link_" + id);
      	 show_div("tag_delete_link_" + id);      	 
      	 show_div("tag_name_" + id);      	       	 
      	 
      	 hide_div("tag_edit_box_" + id);
      	 hide_div("tag_edit_submit_" + id);
      	 hide_div("tag_edit_cancel_" + id);
      	 
      	 document.getElementById("tag_edit_box_" + id).style.clear = "none";      	      	       	 
      }
        
      function tag_submit( id)
      {
        tag_cancel(id);
        var xmlHttp = GetAjaxObject();
    
        var new_name = document.getElementById("tag_edit_input_"+id).value;
        if (new_name.length > 0)
        {
          xmlHttp.onreadystatechange=function()
          {
          if(xmlHttp.readyState==4)
            {
              if (xmlHttp.responseText == "OK")
              {
                document.getElementById("tag_name_"+id).innerHTML=new_name;
              }
            }
          }
          xmlHttp.open("GET","sources/box_tag_admin.php?action=submit&tag_id="+id+"&value="+escape(new_name),true);
          xmlHttp.send(null);
        } else
        {
          alert("You must enter a value");
        }
      }
      
      function tag_delete( id)
      {
        var xmlHttp = GetAjaxObject();
    
        xmlHttp.onreadystatechange=function()
        {
          if(xmlHttp.readyState==4)
          { 
            if (xmlHttp.responseText == "OK")
            {
              ajaxTagView();
            }
          }
        }
        xmlHttp.open("GET","sources/box_tag_admin.php?action=delete&tag_id="+id,true);
        xmlHttp.send(null);
      }
    </script>
	  <title>Tag Management</title>
  </head>	
  <body>
    <?php
      include_once "sources/_header.php";  
      include_once "sources/id.php";    
    
      if ($Userinfo->ID == NULL) {
      	echo "You are not logged in.";
    
      	include_once "sources/_footer.php";
      	echo "</BODY>\n</HTML>";
    
      	die();
      }
    
      include("sources/_admin_page_links.php");
      
      echo "<table class='area' cellpadding='5' cellspacing='0' width='600px' id='add_table'>";
      echo "<tr><td class='box_header'>View all tags</td></tr>";
      echo "<tr><td class='pale_area_nb'>";
      
      // Show button to add new tag
      echo "<a href='javascript:void(0)' class='admin_link' onclick='javascript:show_add()'>[Add new tag]</a><br><br>";
      
      echo "<span id='taglist'><img src='media/loading.png' alt='Loading' title=''/></span>";
      echo "</td>\n</td>\n</table>";
    
      // Include DIV tags need for dialogue boxs 
      include_once("sources/_add_dialogue_layers.php");
      
      include_once "sources/_footer.php";  
    ?>
    <script type="text/javascript">
      ajaxTagView();
    </script>
  </body>
</html>
