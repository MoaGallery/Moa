<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">  
	<head>
		<title>View Image</title>
	</head>
	<body>
<?php
    include_once("config.php");
    echo "    <a onClick='history.go(-1)'><img src='".$IMAGE_PATH."/".$_REQUEST["image_id"];
?>
.jpg' onMouseOver='this.style.cursor="hand"'></img></a>
  </body>
</html>