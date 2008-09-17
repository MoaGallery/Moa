  var view_gallery_loaded = false;
  var gallery_id = "blank";
  var gallery_name = "blank";

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
        ajaxShowInfo(id);
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
        } else
        {
          if (initial == "false")
          {
            ajaxShowThumbs(gallery_id);
          }
        }
        resize_fade();  
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
        ajaxGetGalleryDesc(gallery_id);
      }
    }    
    
    xmlHttp.open("GET","sources/_get_gallery_title.php?gallery_id="+id,true);

    xmlHttp.send(null);
  }
  
  function ajaxGetGalleryDesc(id)
  {
    var xmlHttp = GetAjaxObject();
    
    xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
        document.getElementById("nav_tree_" + id).innerHTML = gallery_name;
        if (xmlHttp.responseText == "")
        {
          document.title = "View Gallery - " + gallery_name;
        } else
        {
          document.title = "View Gallery - " + gallery_name + xmlHttp.responseText;
        }
      }
    }    
    
    xmlHttp.open("GET","sources/_get_gallery_desc.php?gallery_id="+id,true);
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
  
  function fit_width()
  {
    //var l = document.getElementById("image_thumb_0000000066").style.left;
    //var r = document.getElementById("image_thumb_0000000067").style.left;
    //document.getElementById("debug").innerHTML = l+" "+r;
    var tab = document.getElementById("add_table");
    if (navigator.appName == "Netscape")
    {
      var w = document.width;
    } else
    {
      var w = document.documentElement.offsetWidth - 30;
    }

    var tn = 188;
    var s = 12;
    var b = 1;
    
    var x = w - s - b;
    x = ((x/tn)|0);
    //alert (tab.width);
    tab.width = (x * tn)+s;
    if (tab.width < ((tn*2)))
    {
      tab.width = (tn*2)+s;
    }
  }
  
  function resize_fade()
  {
    var fade = document.getElementById("fade");
    var tab = document.getElementById("add_table");
    //fade.style.width = tab.offsetWidth + "px";
    //fade.style.height = tab.offsetHeight + "px";
    //fade.style.left = tab.offsetLeft + "px";
    //fade.style.top = tab.offsetTop + "px";
    
    fit_width();
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
  
  function show_title( name)
  {
  	document.title = name;
  }
  
  view_gallery_loaded = true;
  