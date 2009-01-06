<?php
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    include_once("../private/db_config.php");
    include_once("../config.php");  
    include_once("_error_funcs.php");
  }

  $pre_cache_from_sources = false;
  if (isset($pre_cache) == false)
  {
    $pre_cache_from_sources = true;
  }

  if (isset($_REQUEST["gallery_id"]) == true)
  {
    $gallery_id = sprintf( "%010d", $_REQUEST["gallery_id"]);
  } else
  {
    if (isset($pre_gallery_id) == true)
    {
      $gallery_id = sprintf( "%010d", $pre_gallery_id);
    } else
    {
      moa_warning("No gallery ID supplied");
      die();
    }
  }
  
  $index = false;
  if (isset($_REQUEST["index"]) == true)
  {
    $index = $_REQUEST["index"];
  } else
  {
    if (isset($pre_index) == true)
    {
      $index = $pre_index;
    }
  }
  
  $pre_cache = true;
  $pre_gallery_id = $gallery_id;
  $pre_index = $index;
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDGallery='".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $gallery = mysql_fetch_array($result);
  
  if ($gallery == false)
  {
    moa_warning("Invalid gallery ID");
    die();
  }    
  
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $subgalleries = mysql_fetch_array($result);
    
  if ((($subgalleries == true) && ($DISPLAY_PLAIN_SUBGALLERIES == false)) || ($subgalleries == false))
  {
    $query = "select IDImage, Description from ".$tab_prefix."v_gallery_images where IDGallery = '".mysql_real_escape_string($gallery_id)."';";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>Photos</td></tr><tr><td class='pale_area_nb'>\n";
    echo "<div id='info'>";
    if (isset($pre_cache_from_sources) == false)
    {
      $pre_cache_from_sources = false;
    }
    
    if ($pre_cache_from_sources == true)
    {
      include_once("box_gallery_info.php");
    } else
    {
      include_once("sources/box_gallery_info.php");
    }
    echo "</div></td></tr><tr><td class='pale_area_nb'>";
    
    $query = "select IDImage, Description from ".$tab_prefix."v_gallery_images where IDGallery = '".mysql_real_escape_string($gallery_id)."';";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    
    if (0 == mysql_num_rows($result)) 
    {
    	echo "<p class='normal_text'>No images</p>";
    }
    
    while ($imagelist = mysql_fetch_array($result))
    {          
      $image_desc2 = mysql_real_escape_string(nl2br($imagelist["Description"]));
      $image_desc = str_replace("\'", "&#39", $image_desc2);                                                                          
      
      if (strlen($image_desc) <= 0) {
      	if ($SHOW_EMPTY_DESC_POPUPS == false) 
      	{
          $popup = '';
      	} else 
      	{
          $popup = "onmouseover='return overlib(\"".$EMPTY_DESC_POPUP_TEXT."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      	}
      } else 
      {        
        $popup = "onmouseover='return overlib(\"".$image_desc."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
      }
      
      ?>
      
      <div style='float:left;' id='image_thumb_<?php echo $imagelist["IDImage"] ?>'>
        <div class='gallery-shadow' <?php echo $popup ?> onclick='window.location="view_image.php?image_id=<?php echo $imagelist["IDImage"]?>&amp;parent_id=<?php echo $gallery_id ?>"'>
          <div class='gallery-shadow2'>
            <div class='gallery-shadow3' style="vertical-align:middle; width:<?php echo ($THUMB_WIDTH+20) ?>px; height: <?php echo (ceil($THUMB_WIDTH*0.75)+20); ?>px;">
              <?php
                echo '<div style="margin:10px; background-image: url(\'';
                echo $THUMB_PATH."/thumb_".$imagelist["IDImage"].".jpg";
                echo '\'); background-repeat: no-repeat; background-position: center; width: ';
                echo $THUMB_WIDTH.'px; height: '.ceil($THUMB_WIDTH*0.75).'px">';
                echo '</div>';
              ?>
            </div>
          </div>
        </div>
      </div>
      
      <?php
    }
    echo "</td></tr></table>\n";
  }
  
  if (($subgalleries == true) || ($index == true))
  {
    $header = "Sub-galleries";
    include ("_thumb_list.php");
  }
?>