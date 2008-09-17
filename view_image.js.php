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
        document.title = "View Image";
      } else
      {
        document.title = "View Image" + xmlHttp.responseText;
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

function ajaxInfoFunction(id, par)
{
  var xmlHttp = GetAjaxObject();
  
  xmlHttp.onreadystatechange=function()
  {
  if(xmlHttp.readyState==4)
    {
      document.getElementById("info").innerHTML=xmlHttp.responseText;
      ajaxInfoDescription( id, 'NULL', 'false', "<?php echo session_id(); ?>", true);
    }
  }
  xmlHttp.open("GET","sources/box_image_info.php?image_id="+id+"&parent_id="+par,true);
  xmlHttp.send(null);
}

function ajaxInfoDescription(id, desc, edit, SessID, initial)
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

function image_delete (image_id, gallery_id)
{
  if (confirm("Are you sure you want to delete this image?"))
  {
    window.location = 'view_gallery.php?gallery_id='+gallery_id+'&image_delete_id='+image_id+'&image_delete=true';
  }
}

function resize_fade()
{
  var fade = document.getElementById("fade");
  var tab = document.getElementById("add_table");
  //fade.style.width = tab.offsetWidth;
  //fade.style.height = tab.offsetHeight;
  //fade.style.left = tab.offsetLeft;
  //fade.style.top = tab.offsetTop;
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

view_image_js_loaded = true;
