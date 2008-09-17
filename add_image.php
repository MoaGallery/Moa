<?php
    session_start();
?>

<script type="text/javascript">
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
    document.getElementById("add_dialogue").style.visibility = "visible";
    document.getElementById("fade").style.visibility = "visible";
  }
  
  window.onresize=resize_fade;
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Add Image</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
      include ("sources/_inherit_tags.php");
    ?>

    <table class='area' cellspacing='0' cellpadding='5' id="add_table">
      <tr>
        <td class='box_header'>Add Image</td>
      </tr>
      <tr>	
        <td class='pale_area_nb'>
          <iframe src="sources/box_add_image.php?PHPSESSID=<?php echo session_id() ?>" frameborder=0 marginwidth=0 width="500" height="200"> </iframe>
          <hr>
        </td>
      </tr>
      <tr>
        <td class='pale_area_nb'>
          <?php
            include "sources/box_taglist_add.php";
          ?>
        </td>
      </tr>
    </table
  </body>

  <script type="text/javascript">
    ajaxTagList("");
  </script>

  <?php
    include ("sources/_footer.php");
    
  ?>
</html>
