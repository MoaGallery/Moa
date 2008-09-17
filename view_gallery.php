<?php
   if (isset($_REQUEST["gallery_id"]) == false)
  {
    echo "No gallery ID supplied";
    die();
  }
  $gallery_id = $_REQUEST["gallery_id"];
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>View Gallery</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
    ?>

    <script type="text/javascript" src="view_gallery.js.php"> </script>
    
    <script type="text/javascript">
      function on_load()
      {
        while (view_gallery_loaded == false)
        {
        }

        gallery_id = '<?php echo $gallery_id ?>';
        window.onresize=resize_fade;
        
        ajaxGetGalleryName('<?php echo $gallery_id; ?>');
        ajaxShowThumbs('<?php echo $gallery_id; ?>');
      }
      
      window.onload=on_load;
    </script>
    
    <?php
      include_once ("sources/_image_delete.php");
      include_once ("sources/_gallery_delete.php");
    ?>
    
    <script type="text/javascript">
      if (<?php echo $gallery_id ?> == 0000000000)
      {
        document.location = "index.php";
      }
    </script>
    
    <span id="thumbs"><img src="media/loading.png" alt="Loading" title=""/></span>
    <?php
      include ("sources/_footer.php");
    ?>
  </body>
</html>
