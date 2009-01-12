<?php
  $no_image_id = false;
  if (isset($_REQUEST["image_id"]) == false)
  {
    $no_image_id = true;
  } else
  {
    $image_id = $_REQUEST["image_id"];
    $pre_cache = true;
    $pre_image_id = $image_id;
  }
  session_start();
  include_once("sources/id.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Image ";
       if (false == $no_image_id)
       {
         include_once("sources/_get_image_desc.php");
       }
       echo "</title>";
     ?>
  </head>
  <body>    
    <?php
      include ("sources/_header.php");
      if (true == $no_image_id)
      {
        moa_warning("No image ID supplied.");
        include_once ("sources/_footer.php");
        echo "</body>\n</html>\n";
        die();
      }
    ?>
    <?php
      if ($Userinfo->ID != NULL)
      {
        echo '<script type="text/javascript" src="view_image_edit.js.php"> </script>';
      }
    ?>  
    <script type="text/javascript">
      image_id = '<?php echo $image_id ?>';
      parent_id = '<?php echo $_REQUEST['parent_id'] ?>';
      <?php
        $referer = 0;
        if (true == isset($_REQUEST["referer"]))
        {
          if (0 == strcmp("orphan", $_REQUEST["referer"]))
          {
            $referer = 1;
          }
        }
        echo "var referer=".$referer.";\n";
      ?>
    </script>        
    <?php
      $pre_cache = true;
      $pre_image_id = $image_id;
      $pre_parent_id = $_REQUEST["parent_id"];
      $pre_referer = $referer;
    ?>
    <table id="add_table" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top">
          <div id='image'><?php include_once("sources/box_image.php"); ?></div>
        </td>
        <td style="width:4px;">
        </td>
        <td class="pale_area" style="height:100pct; width:300px;" valign="top">
          <table class="area_nb" style="width:100%;" cellpadding="5" cellspacing="0" >
            <tr>
              <td><div class="box_header">Image Info</div></td>
            </tr>
            <tr>
              <td class="pale_area_nb">
                <?php
                  $pre_cache = true;
                  $pre_image_id = $image_id;
                  $pre_parent_id = $_REQUEST["parent_id"];
                  $pre_referer = $referer;
                ?>
                <div id='info'><?php include_once("sources/box_image_info.php"); ?></div>
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
