	<?php
	  include_once($MOA_PATH."config.php");
	  echo "    <a onclick='history.go(-1)'><img src='".$IMAGE_PATH."/".$_REQUEST["image_id"];
	  echo ".jpg' onmouseover='this.style.cursor=\"hand\"' alt='Full size image' /></a>";
	  $page_title = "Image";
	  $desc = _ImageGetValue($_REQUEST["image_id"], "Description");
	  if (strlen($desc) > 0)
	  {
	  	if (strlen($desc) > $TITLE_DESC_LENGTH)
	  	{
	  		$page_title .= " - \'" . html_display_safe(mb_substr($desc, 0, $TITLE_DESC_LENGTH-3)) . "...\'";
	  	} else
	  	{
	  		$page_title .= " - \'" . html_display_safe($desc) . "\'";
	  	}
	  }
  ?>
