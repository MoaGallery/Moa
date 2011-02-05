<script type="text/javascript">

  /*

      The edit box for galleries and images can be too tall for the page and screw up the layout due
      to an overflow: auto on the body_content div (needed to show the background image).
      This code adjusts the DOM container size to let it fit.

  */

  var type = "";
  var expanded = false;
  var timeout = 600;

  function AttachHandler()
  {
    if (0 == timeout)
    {
      return;
    }

    var link = document.getElementById("edit_link");

    if (null != link)
    {
      var check = document.getElementById("hidden_hack").innerHTML;
      if ("true" == check)
      {
        timeout--;
        setTimeout("AttachHandler()", 100);
        return;
      } else
      {
        addEvent(link, "click", ClickEdit);
        document.getElementById("hidden_hack").innerHTML = "true";
        timeout = 600;
        return;
      }
    } else
    {
      timeout--;
      setTimeout("AttachHandler()", 100);
    }
  }

  function ClickSubmit()
  {
    setTimeout("AttachHandler()", 100);
  }

  function ClickExpand(e)
  {
    expanded = !expanded;

    var block = document.getElementById(type+"_edit");
    var block_bg = document.getElementById(type+"_edit_bg");
    if (expanded)
    {
      block.style.height = "550px";
    } else
    {
      block.style.height = "375px";
    }
  }

  function ClickEdit(e)
  {
    if (null != document.getElementById(type+"formexpandlink"))
    {
      addEvent(document.getElementById(type+"formexpandlink"), "click", ClickExpand);
      addEvent(document.getElementById(type+"formsubmit"), "click", ClickSubmit);
      var block = document.getElementById(type+"_edit");
      block.style.height = "375px";
    }
  }

  type = "gallery";
  if (null == document.getElementById("add_link"))
  {
    type = "image";
  }
  if (null != document.getElementById("mainblockdesc"))
  {
    type = "main";
  }

  var link = document.getElementById("edit_link");
  if (null != link)
  {
    addEvent(link, "click", ClickEdit);
    document.getElementById("hidden_hack").innerHTML = "true";
  }
</script>