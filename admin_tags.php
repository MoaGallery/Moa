  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>		
    <?php
       include_once ("sources/_html_head.php");      
       
       echo "<title>Tag management</title>";
    ?>
    <script type="text/javascript" src="sources/_ajax.js.php"> </script>
    <script type="text/javascript">      
		  var addTagLink  = "<a href='javascript:void(0)' class='admin_link' onclick='javascript:show_add()'>[Add new tag]</a>";
		  var addTagForm  = "<input type='textbox' id='newtag'  onKeyPress='checkKey(event)'></input><br/>";
		      addTagForm += "<input type='button' id='tagsubmit' value='Add Tag' onclick='ajaxTagList(document.getElementById(\"newtag\").value); document.getElementById(\"newtag\").value=\"\"; hide_add();'></input>";
		      addTagForm += "&nbsp;<input type='button' id='tagcancel' value='Cancel' onclick='javascript:hide_add()'></input>";
    
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
		      document.getElementById("tagsubmit").click();
		      return false
		    }
		    
		    // Check for escape
		    if(characterCode == 27)
		    {
		      document.getElementById("tagcancel").click();
		      return false
		    }
		    
		    return true
		  }
		              
      // Tag Edit Functions
      function ajaxTagView()
      {
        var xmlHttp = GetAjaxObject();
      
        xmlHttp.onreadystatechange=function()
        {
          if(xmlHttp.readyState==4)
          {
             document.getElementById("taglist").innerHTML=xmlHttp.responseText;
             document.getElementById("addtagarea").innerHTML=addTagLink;
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
            document.getElementById("addtagarea").innerHTML=addTagLink;
          }
        }
          
        var encodedTagName = encodeURIComponent(NewTagName);
        xmlHttp.open("GET","sources/box_tag_admin.php?action=add&tagname="+encodedTagName,true);
        xmlHttp.send(null);
      }      
    
			function show_add()
			{
			  document.getElementById("addtagarea").innerHTML=addTagForm;
			  document.getElementById("newtag").focus();
			}
			
			function hide_add()
			{
				 document.getElementById("newtag").blur();
				 document.getElementById("addtagarea").innerHTML=addTagLink;
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
      	 var name = document.getElementById("tag_name_" + id).innerHTML;
      	 name = name.replace("&lt;", "<");
      	 name = name.replace("&gt;", ">");
      	 name = name.replace("&amp;", "&");
      	 name = name.replace("&quote;", "\"");
      	 name = name.replace("&apos;", "\'");
      	 document.getElementById("tag_edit_input_" + id).value = name;
      	 
      	 document.getElementById("tag_edit_box_" + id).focus();
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
        var edit_name = document.getElementById("tag_edit_input_"+id).value;
        
        if (edit_name.length > 0)
        {
          xmlHttp.onreadystatechange=function()
          {
          if(xmlHttp.readyState==4)
            {
              if (xmlHttp.responseText == "OK")
              {
                document.getElementById("tag_name_"+id).innerHTML=edit_name;
              }
            }
          }
          var new_name = encodeURIComponent(edit_name);
          xmlHttp.open("GET","sources/box_tag_admin.php?action=submit&tag_id="+id+"&value="+new_name,true);
          xmlHttp.send(null);
        } else
        {
          alert("You must enter a value");
        }
      }
      
      function tag_delete( id)
      {
        if (confirm("Are you sure you want to delete this tag?"))
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
    </script>
	  <title>Tag Management</title>
  </head>	
  <body>
    <?php
      include_once "sources/_header.php";
      include_once "sources/id.php";

      if ($Userinfo->ID == NULL) {
      	moa_warning("You must be logged in to use this page.");
        include_once ("sources/_footer.php");
        echo "</body>\n</html>\n";
        die();
      }

      include("sources/_admin_page_links.php");

      echo "<table class='area' cellpadding='5' cellspacing='0' width='600px' id='add_table'>";
      echo "<tr><td class='box_header'>View all tags</td></tr>";
      echo "<tr><td class='pale_area_nb'>";
      
      // Show button to add new tag      
      echo "<div id='addtagarea'></div><br/>\n";              
      echo "<span id='taglist'><img src='media/loading.png' alt='Loading' title=''/></span>";
      echo "</td>\n</td>\n</table>";
         
      include_once "sources/_footer.php";  
    ?>
    <script type="text/javascript">
      ajaxTagView();
    </script>
  </body>
</html>
