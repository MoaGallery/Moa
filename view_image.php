<?php
  if (isset($_REQUEST["image_id"]) == false)
  {
    echo "No image ID supplied";
    die();
  }
  $image_id = $_REQUEST["image_id"];
  session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>View Image</title>";
     ?>
  </head>
  <body>    
    <?php
      include ("sources/_header.php");
    ?>
    <script type="text/javascript" src="view_image.js.php"> </script>
    <script type="text/javascript">
      function on_load()
      {
        while (view_image_js_loaded == false)
        {
        }
        
        image_id = '<?php echo $image_id ?>';
        window.onresize=resize_fade;
        
        ajaxInfoFunction("<?php echo $image_id.'", "'.$_REQUEST['parent_id'] ?>");
        ajaxImageFunction("<?php echo $image_id ?>");
      }
      
      window.onload=on_load;
    </script>        
    
    <table id="add_table" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
          <span id='image'><img src="media/loading.png" alt="Loading" title=""/></span>
        </td>
        <td style="width:4px;">
        </td>
        <td class="pale_area" style="height:100pct; width:300px;" valign="top">
          <table class="area_nb" height="100%" width="100%" cellpadding="5" cellspacing="0" >
            <tr>
              <td><div class="box_header">Image Info</div></td>
            </tr>
            <tr>
              <td class="pale_area_nb">
                <span id='info'><img src="media/loading.png" alt="Loading" title=""/></span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  
  <?php
    include ("sources/_footer.php");
  ?>
</body>
</html>
