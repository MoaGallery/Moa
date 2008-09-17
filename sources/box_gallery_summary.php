<?php
  // Get Gallery info
  $query_summary = "SELECT * FROM ".$tab_prefix."gallery WHERE IDGallery = ".mysql_real_escape_string($gallery_summary_id);
  $result_summary = mysql_query($query_summary) or die(mysql_error());
  
  if (($gallery_summary = mysql_fetch_array($result_summary)) == false) {
    echo "Invalid Gallery ID"; die();
  }    
  $summary_gallery_name = $gallery_summary["Name"];
  $summary_gallery_desc2 = mysql_real_escape_string(nl2br($gallery_summary["Description"]));
  
  $summary_gallery_desc = str_replace("\'", "&#39;", $summary_gallery_desc2);
  
  // Get sub-galleries
  $query_summary = "SELECT * FROM ".$tab_prefix."gallery WHERE IDParent = ".mysql_real_escape_string($gallery_summary_id);
  $result_summary = mysql_query($query_summary) or die(mysql_error());
  
  $number_of_sub_galleries = mysql_num_rows($result_summary);
  
  // Get image info
  $query_summary = "select IDImage from ".$tab_prefix."v_gallery_images where IDGallery = '".mysql_real_escape_string($gallery_summary["IDGallery"])."';";
    
  $result_summary = mysql_query($query_summary) or die(mysql_error());
  
  $number_of_images = mysql_num_rows($result_summary);      
  
  if ($number_of_images == 0) {
    $first_image_id = '"sources/box_image_scaler.php?image_name=../media/empty.png&amp;display_width='.$THUMB_WIDTH.'"';    
  }    
  else {
  	$gallery_summary = mysql_fetch_array($result_summary);
  	
    $first_image_id = '"'.$THUMB_PATH.'/thumb_'.$gallery_summary["IDImage"].'.jpg"';
  }  
  
  if (strlen($summary_gallery_desc) <= 0) {
  	if ($SHOW_EMPTY_DESC_POPUPS == false) 
  	{
  	  $popup = "";
  	} else 
  	{
  	  $popup = "onmouseover='return overlib(\"".$EMPTY_DESC_POPUP_TEXT."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
  	}
  } else 
  {
    $popup = "onmouseover='return overlib(\"".$summary_gallery_desc."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
  }  
?>
<div class='gallery-shadow' style='float:left;'>
	<div class='gallery-shadow2' onclick='window.location="view_gallery.php?gallery_id=<?php echo $gallery_summary_id; ?>"' <?php echo $popup; ?>>
    <div class='gallery-shadow3' style="padding: 10px;">
      
      <table border="0" cellpadding='0' cellspacing='0'>
        <tr>
          <td style="width: <?php echo $THUMB_WIDTH ?>px; height: <?php echo (ceil($THUMB_WIDTH*0.75)) ?>px;">
            <img style="display: block; margin-left: auto; margin-right: auto;" src=<?php echo $first_image_id; ?> alt='Gallery thumbnail' title=''/>
          </td>
        </tr>
      </table>
      <p class="normal_text">
      <?php
        echo $summary_gallery_name."<br/>\n";
        if ($DISPLAY_PLAIN_SUBGALLERIES)
        {
          if ($number_of_sub_galleries > 0)
          {
            echo $number_of_sub_galleries." Sub Galleries<br/>\n";
          } else
          {
            echo $number_of_images." Images\n";
          }
        } else
        {
          echo $number_of_images." Images<br/>\n";
          if ($number_of_sub_galleries > 0)
          {
            echo $number_of_sub_galleries." Sub Galleries<br/>\n";
          } else
          {
            echo "<br/>\n";
          }
        }
      ?>
    </p>
    </div>
  </div>
</div>
