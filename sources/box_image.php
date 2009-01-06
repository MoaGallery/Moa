<?php
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    include_once("../config.php");
    $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  }
    
    $width = 0;
    $height = 0;
    
    if (isset($_REQUEST["image_id"]) == false)
    {
       moa_warning("No image specified");
    } else
    {
      $query = "SELECT IDImage,Width,Height FROM ".$tab_prefix."image WHERE (IDImage='".mysql_real_escape_string($_REQUEST["image_id"])."');";
      $result = mysql_query($query);
      $image = mysql_fetch_array($result);

      if (mysql_num_rows($result) > 0)
      {
        $width = $image["Width"];
        $height = $image["Height"];
        
        echo "<div onclick='window.location=\"view_image_full.php?image_id=".$_REQUEST["image_id"]."\"' class='picture-shadow'>";
        echo "  <div class='picture-shadow2'>";
//        echo "<div class='picture-shadow3' style='padding:0px;'>";
        if (($width > $CONFIG_DISPLAY_MAX_WIDTH) or ($height > ($CONFIG_DISPLAY_MAX_WIDTH*0.75)))
        {                  
          echo "<img class='picture-shadow3' style='display:block;' src='sources/box_image_scaler.php?image_name=".$_REQUEST["image_id"].".jpg' alt='image preview'/>";
        } else
        {          
          echo "<img style='display:block;' src='../".$IMAGE_PATH."/".$_REQUEST["image_id"].".jpg'></img>";
        }
//        echo "</div>";
        echo "  </div>";
        echo "</div>";
      } else
      {
        moa_warning("Image does not exist");
      }
    }
?>
