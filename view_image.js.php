var addTagLink  = "<a href='javascript:void(0)' class='admin_link' onclick='javascript:show_add()'>[Add new tag]</a>";
var addTagForm  = "<input type='textbox' id='newtag'  onKeyPress='checkKey(event)'></input><br>";
    addTagForm += "<input type='button' id='tagsubmit' value='Add Tag' onclick='ajaxTagList(escape(document.getElementById(\"newtag\").value)); document.getElementById(\"newtag\").value=\"\"; hide_add();'></input>";
    addTagForm += "&nbsp;<input type='button' id='tagcancel' value='Cancel' onclick='javascript:hide_add()'></input>";

var view_image_js_loaded = false;
var image_id = "blank";

<?php 
  include_once("sources/_ajax.js.php");
?>

function ajaxGetImageDesc(id)
{
  var xmlHttp = GetAjaxObject();
  
  xmlHttp.onreadystatechange=function()
  {
  if(xmlHttp.readyState==4)
    {
      if (xmlHttp.responseText == "")
      {
        document.title = "Image";
      } else
      {
        document.title = "Image - " + xmlHttp.responseText;
      }
    }
  }    
  
  xmlHttp.open("GET","sources/_get_image_desc.php?image_id="+id,true);

  xmlHttp.send(null);
}

function ajaxImageFunction(id)
{
  var xmlHttp = GetAjaxObject();
  
  xmlHttp.onreadystatechange=function()
  {
  if(xmlHttp.readyState==4)
    {
      document.getElementById("image").innerHTML=xmlHttp.responseText;
    }
  }
  xmlHttp.open("GET","sources/box_image.php?image_id="+id,true);
  xmlHttp.send(null);
}

function ajaxInfoFunction(id, par, referer)
{
  var xmlHttp = GetAjaxObject();
  
  xmlHttp.onreadystatechange=function()
  {
  if(xmlHttp.readyState==4)
    {
      document.getElementById("info").innerHTML=xmlHttp.responseText;
      ajaxInfoDescription( id, 'NULL', 'false', "<?php echo session_id(); ?>", true, referer);
    }
  }
  
  xmlHttp.open("GET","sources/box_image_info.php?image_id="+id+"&parent_id="+par+"&referer="+referer,true);
  xmlHttp.send(null);
}

function ajaxInfoDescription(id, desc, edit, SessID, initial, referer)
{
  var xmlHttp = GetAjaxObject();
  
  xmlHttp.onreadystatechange=function()
  {
  if(xmlHttp.readyState==4)
    {
      document.getElementById("imagedesc").innerHTML=xmlHttp.responseText;
      if (edit == "true")
      {
        ajaxTagList("");
        document.getElementById("image-comment").focus();
      } else
      {
        if (initial == "false")
        {
          ajaxGetImageDesc(image_id);
        }
      }
    }
  }
  if (initial == true)
  {
    xmlHttp.open("GET","sources/box_image_description.php?image_id="+id+"&edit="+edit+"&PHPSESSID="+SessID,true);
    ajaxGetImageDesc(image_id);
  } else
  {
    xmlHttp.open("GET","sources/box_image_description.php?image_id="+id+"&desc="+desc+"&edit="+edit+"&PHPSESSID="+SessID,true);
  }
  xmlHttp.send(null);
}

function CommentButtons(SessID, cancel)
{
  if (cancel==true)
  {
    ajaxInfoDescription(image_id, "", "false", SessID, true);
  } else
  {
    var desc = encodeURI(document.getElementById("image-comment").value);
    ajaxInfoDescription(image_id, desc, "false", SessID, "false");
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
      echo "xmlHttp.open('GET','sources/box_edit_taglist.php?PHPSESSID=".session_id()."&image_id='+image_id+'&type=image',true);\n";
    ?>
  } else
  {
    <?php
      echo "xmlHttp.open('GET','sources/box_edit_taglist.php?PHPSESSID=".session_id()."&tagname='+NewTagName+'&image_id='+image_id+'&type=image',true);\n";
    ?>
  }
  xmlHttp.send(null);
}

function image_delete (image_id, gallery_id, orphan)
{
  if (confirm("Are you sure you want to delete this image?"))
  {
    if (0 == orphan)
    {
      window.location = 'view_gallery.php?gallery_id='+gallery_id+'&image_delete_id='+image_id+'&image_delete=true';
    } else
    {
      window.location = 'admin_orphans.php?image_delete_id='+image_id+'&image_delete=true';
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
  
view_image_js_loaded = true;
