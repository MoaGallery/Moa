  var addTagLink  = "<a href='javascript:void(0)' class='admin_link' onclick='javascript:show_add()'>[Add new tag]</a>";
  var addTagForm  = "<input type='textbox' id='newtag'  onKeyPress='checkKey(event)'></input><br>";
      addTagForm += "<input type='button' id='tagsubmit' value='Add Tag' onclick='ajaxTagList(escape(document.getElementById(\"newtag\").value)); document.getElementById(\"newtag\").value=\"\"; hide_add();'></input>";
      addTagForm += "&nbsp;<input type='button' id='tagcancel' value='Cancel' onclick='javascript:hide_add()'></input>";
      
  <?php 
    include_once("sources/_ajax.js.php");
  ?>

  function ajaxShowThumbs(id)
  {
    var xmlHttp = GetAjaxObject();
  
    xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
        document.getElementById("thumbs").innerHTML=xmlHttp.responseText;
        //ajaxShowInfo(id);
      }
    }
    xmlHttp.open("GET","sources/box_gallery_thumbs.php?gallery_id="+id,true);
    xmlHttp.send(null);
  }
          
  function ajaxShowInfo(id)
  {
    var xmlHttp = GetAjaxObject();
    
    xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
        document.getElementById("info").innerHTML=xmlHttp.responseText;
        ajaxShowTitles(id, null, null, null, '<?php echo session_id(); ?>', true);
      }
    }
    xmlHttp.open("GET","sources/box_gallery_info.php?gallery_id="+id,true);
    xmlHttp.send(null);
  }
  
  function ajaxShowTitles(id, name, desc, edit, SessID, initial)
  {
    var xmlHttp = GetAjaxObject();
    
    xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
        document.getElementById("galleryeditinfo").innerHTML=xmlHttp.responseText;
        if (edit == "true")
        {
          ajaxTagList("");  
          document.getElementById("gal-name").focus();        
        } else
        {
          if (initial == "false")
          {
            ajaxShowThumbs(gallery_id);
          }
        }
          
        ajaxGetGalleryName(id);
      }
    }
    if (initial == true)
    {
      xmlHttp.open("GET","sources/box_gallery_titles.php?gallery_id="+id+"&edit="+edit+"&PHPSESSID="+SessID,true);
    } else
    {
      xmlHttp.open("GET","sources/box_gallery_titles.php?gallery_id="+id+"&name="+name+"&desc="+desc+"&edit="+edit+"&PHPSESSID="+SessID,true);
    }
    xmlHttp.send(null);
  }
  
  function ajaxGetGalleryName(id)
  {
    var xmlHttp = GetAjaxObject();
    
    xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
        gallery_name = xmlHttp.responseText;
        document.title = "Gallery - " + gallery_name;
      }
    }    
    
    xmlHttp.open("GET","sources/_get_gallery_title.php?gallery_id="+id,true);

    xmlHttp.send(null);
  }
  
  function CommentButtons(SessID, cancel)
  {
    if (cancel==true)
    {
      ajaxShowTitles(gallery_id, "", "", "false", SessID, true);
    } else
    {
      var desc = encodeURI(document.getElementById("gal-comment").value);
      var name = encodeURI(document.getElementById("gal-name").value);
      ajaxShowTitles(gallery_id, name, desc, "false", SessID, "false");
    }
  }
  
  function ajaxSetTag(tagid, ticked)
  {
    var xmlHttp = GetAjaxObject();
      
    var tagstatus = ""
    if (ticked)
    {
      var tagstatus = "true"
    } else
    {
      var tagstatus = "false"
    }
    xmlHttp.open("GET","sources/_settag.php?PHPSESSID=<?php echo session_id() ?>&ticked="+tagstatus+"&tagid="+tagid,true);
    xmlHttp.send(null);
  }
  
  function onTick(tagid)
  {
    if (document.getElementById("tag-"+tagid).checked == true)
    {
      ajaxSetTag(tagid, true);
    } else
    {
      ajaxSetTag(tagid, false);
    }
  }
  
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
    if (NewTagName == "")
    {
      <?php
        echo "xmlHttp.open('GET','sources/box_edit_taglist.php?PHPSESSID=".session_id()."&gallery_id='+gallery_id+'&type=gallery',true);\n";
      ?>
    } else
    {
      <?php
        echo "xmlHttp.open('GET','sources/box_edit_taglist.php?PHPSESSID=".session_id()."&tagname='+NewTagName+'&gallery_id='+gallery_id+'&type=gallery',true);\n";
      ?>
    }
    xmlHttp.send(null);
  }
  
  function gallery_delete (gallery_id, parent_id)
  {
    if (confirm("Are you sure you want to delete this gallery?"))
    {
      if (parent_id == 0000000000)
      {
         window.location = 'index.php?gallery_id='+parent_id+'&gallery_delete=true&gallery_delete_id='+gallery_id;
      } else
      {
         window.location = 'view_gallery.php?gallery_id='+parent_id+'&gallery_delete=true&gallery_delete_id='+gallery_id;
      }
    }
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
	
  function show_title( name)
  {
  	document.title = name;
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
      document.getElementById("galsubmit").click();
      return false
    }
    
    // Check for escape
    if(characterCode == 27)
    {
      document.getElementById("galcancel").click();
      return false
    }
    
    return true
  }