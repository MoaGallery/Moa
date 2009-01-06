<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>Image</title>
		<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
	</head>
	<body>
	  <div>
<?php
    include_once("config.php");
    echo "    <a onclick='history.go(-1)'><img src='".$IMAGE_PATH."/".$_REQUEST["image_id"];
?>
.jpg' onmouseover='this.style.cursor="hand"' alt='Full size image'></img></a>
  </div>
  </body>
</html>