<script type="text/javascript">
  
  function ajaxTagList(NewTagName)
  {
    var xmlHttp;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
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
        echo "xmlHttp.open('GET','sources/box_taglist.php?PHPSESSID=";
        echo session_id();
        if (isset($_REQUEST["parent_id"]))
        {
          echo "&parent_id=".$_REQUEST["parent_id"];
        }
        echo "',true);\n";
      ?>
    } else
    {
      <?php
        echo "xmlHttp.open('GET','sources/box_taglist.php?PHPSESSID=".session_id();
        if (isset($_REQUEST["parent_id"]))
        {
          echo "&parent_id=".$_REQUEST["parent_id"];
        }
        echo "&tagname='+NewTagName,true);\n";
      ?>
    }
    xmlHttp.send(null);
  }
  
  function ajaxResetTagList()
  {
  var xmlHttp;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
    xmlHttp.open("GET","sources/_settag.php?reset=true",true);
    xmlHttp.send(null);
  }
  
  function ajaxSetTag(tagid, ticked)
  {
  var xmlHttp;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      try
        {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
      catch (e)
        {
        alert("Your browser does not support AJAX!");
        return false;
        }
      }
    }
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
  
  function hide_add()
  {
    document.getElementById("add_dialogue").style.visibility = "hidden";
    document.getElementById("fade").style.visibility = "hidden";
  }
</script>

<table>
  <tr>
    <td>
      <span id='taglist'></span>
    </td>          
  </tr>
</table>
<?php
  include_once("_add_dialogue_layers.php");
?>