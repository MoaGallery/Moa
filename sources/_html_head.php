<?php  
  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }
  
  // Common functions
  include_once("common.php");
  include_once("_error_funcs.php");
  
  if (!$INSTALLING)
  {
    // Database Configuration and Website configuration settings
    include_once("private/db_config.php");
    include_once("config.php");
  
    // Connect to database
    if (isset($db_host))
    {
      $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    }
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
  echo "<link rel='stylesheet' href='style/style.css' type='text/css'/>\n";  
  
  // Set content type
  echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>\n";
?>
