<?php  
  $no_gallery_id = false;
  if (isset($_REQUEST["gallery_id"]) == false)
  {
    $no_gallery_id = true;
  } else
  {
    $gallery_id = $_REQUEST["gallery_id"];
    $pre_cache = true;
    $pre_gallery_id = $gallery_id;
  }  
  session_start();
  session_unset();
  include_once("sources/id.php");  
  header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Gallery ";
       if (false == $no_gallery_id)
       {
         include_once("sources/_get_gallery_title.php");
       }
       echo "</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
      
      if (true == $no_gallery_id)
      {
        moa_warning("No gallery ID supplied.");
        include_once ("sources/_footer.php");
        echo "</body>\n</html>\n";
        die();
      }
    ?>

    <script type="text/javascript" src="view_gallery.js.php"> </script>
    <?php
      if ($Userinfo->ID != NULL)
      {
        echo '<script type="text/javascript" src="sources/_ajax.js.php"> </script>';
        echo '<script type="text/javascript" src="view_gallery_edit.js.php"> </script>';
      }
    ?>
    
    <script type="text/javascript">
      gallery_id = '<?php echo $gallery_id ?>';
      window.onresize=fit_width;
    </script>
    
    <?php
      include_once ("sources/_image_delete.php");
      include_once ("sources/_gallery_delete.php");
      
      $pre_cache = true;
      $pre_gallery_id = $gallery_id;
      $pre_index = false;
    ?>
    
    <div id="thumbs"><?php include_once("sources/box_gallery_thumbs.php"); ?></div>
    
    <script type="text/javascript">
      if ('<?php echo $gallery_id ?>' == '0000000000')
      {
        document.location = "index.php";
      }
    </script>
    <?php
      include ("sources/_footer.php");
    ?>
  </body>
</html>
