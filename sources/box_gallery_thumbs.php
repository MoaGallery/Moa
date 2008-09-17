<?php
  header("Cache-Control: no-cache, must-revalidate");
  include_once("../private/db_config.php");
  include_once("../config.php");  

  if (isset($_REQUEST["gallery_id"]) == false)
  {
    echo "No gallery ID supplied";
    die();
  }
  $gallery_id = sprintf( "%010d", $_REQUEST["gallery_id"]);
  
  if (isset($_REQUEST["index"]) == true)
  {
    $index = $_REQUEST["index"];
  }
  else
  {
  	$index = false;
  }
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDGallery='".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or die(mysql_error());
  $gallery = mysql_fetch_array($result);
  
  if ($gallery == false)
  {
    echo "Invalid gallery ID";
    die();
  }    
  
  $query = "SELECT * FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or die(mysql_error());
  $gallery = mysql_fetch_array($result);
    
  if ((($gallery == true) && ($DISPLAY_PLAIN_SUBGALLERIES == false)) || ($gallery == false))
  {
    $query = "select IDImage, Description from ".$tab_prefix."v_gallery_images where IDGallery = '".mysql_real_escape_string($gallery_id)."';";
    $result = mysql_query($query) or die(mysql_error());
    echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>Photos</td></tr><tr><td class='pale_area_nb'>\n";
    echo "<span id='info'><img src='media/loading.png' alt='Loading' title=''/></span></td></tr><tr><td class='pale_area_nb'>";
    
    if (0 == mysql_num_rows($result)) 
    {
    	echo "No images";
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
            <div class='gallery-shadow3' style="width:<?php echo ($THUMB_WIDTH+20) ?>px; height: <?php echo (ceil($THUMB_WIDTH*0.75)+20); ?>px;">
              <div style="margin:10px;">
                <?php
                  echo '<img style="display: block; margin-left: auto; margin-right: auto;" src="';
                  echo $THUMB_PATH;
                  echo '/thumb_';
                  echo $imagelist["IDImage"];
                  echo '.jpg">';
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php
    }
    echo "</td></tr></table>\n";
  }
  
  if (($gallery == true) || ($index == true))
  {
    $header = "Sub-galleries";
    include ("_thumb_list.php");
  }
?>