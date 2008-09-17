<?php  
  // Database Configuration and Website configuration settings
  include_once("private/db_config.php");
  include_once("config.php");
  
  // Common functions
  include_once("_common.php");

  // Connect to database
  if (isset($db_host))
  {
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  }
   
  // Website Icon
  echo "<link rel='SHORTCUT ICON' href='favicon.ico'/>\n";
      
  // Overlib includes
  echo "<script type='text/javascript' src='sources/OverLib/overlib.js'></script>\n";
  echo "<script type='text/javascript' src='sources/OverLib/overlib_adaptive_width.js'></script>\n";
?>

<!--[if lt IE 7.]>
<script defer type="text/javascript" src="sources/pngfix.js"></script>
<![endif]-->

<?php
  // Main stylesheet
  echo "<link rel='stylesheet' href='template/default/style.css' type='text/css'/>\n";  
  
  // Set content type
  echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>\n";
?>
