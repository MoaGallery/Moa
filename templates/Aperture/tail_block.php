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

    var link = $('#edit_link');

    if (link.length)
    {
      var check = $('#hidden_hack').html();
      if ("true" == check)
      {
        timeout--;
        setTimeout("AttachHandler()", 100);
        return;
      } else
      {
        link.click(ClickEdit);
        $('#hidden_hack').html('true');
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

    var block = $('#' + type + '_edit');
    var block_bg = $('#' + type + '_edit_bg');
    if (expanded)
    {
      block.height('630px');
    } else
    {
      block.height('445px');
    }
  }

  function ClickEdit(e)
  {
    if ($('#' + type + 'formexpandlink').length)
    {
      $('#' + type + 'formexpandlink').click(ClickExpand);
      $('#' + type + 'formsubmit').click(ClickSubmit);
      var block = $('#' + type + '_edit');
      block.height('445px');
    }
  }

  type = "gallery";
  if (!$('#add_link').length)
  {
    type = "image";
  }
  if ($('#mainblockdesc').length)
  {
    type = "main";
  }

  var link = $('#edit_link');
  if (link.length)
  {
    link.click(ClickEdit);
    $('#hidden_hack').html('true');
  }

  var node = $('#nav_tree_link_0000000000');
  if (node.length)
  {
    node.attr('href', 'index.php');
  }	
</script>