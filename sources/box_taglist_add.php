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
        echo "&tagname='+encodeURIComponent(NewTagName),true);\n";
      ?>
    }
    xmlHttp.send(null);
  }
  
  function ajaxResetTagList()
  {
    var xmlHttp = GetAjaxObject();

    xmlHttp.open("GET","sources/_settag.php?reset=true",true);
    xmlHttp.send(null);
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
  
</script>

<table cellpadding='0' cellspacing='0' style="width:240px;">
  <tr>
    <td>
      <span id='taglist'></span>
    </td>          
  </tr>
</table>
