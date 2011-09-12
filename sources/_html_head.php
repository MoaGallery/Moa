<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }

  // Common functions
  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");

  if (!$INSTALLING)
  {
    // Database Configuration and Website configuration settings
    include_once("config.php");
    include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");

    // Connect to database
    if (isset($db_host))
    {
      $db = DBConnect();
    }
  }

  // Website Icon
  echo "<link rel='SHORTCUT ICON' href='favicon.ico'/>\n";

  // Inline stylesheet template
  echo "<style type='text/css'>\n";
  echo LoadTemplate("style_inline.php")."\n";
  echo "</style>\n";
?>

<!-- IE6 PNG transparency hack -->
<!--[if IE 6]>
<script defer='defer' type='text/javascript' src='sources/pngfix.js'></script>
<![endif]-->

<!-- Overlib includes -->
<script type='text/javascript' src='sources/OverLib/overlib.js'></script>
<script type='text/javascript' src='sources/OverLib/overlib_adaptive_width.js'></script>

<!-- JQuery include -->
<script type='text/javascript' src='sources/jquery/jquery.js'></script>

<script type='text/javascript' src='sources/common.js'></script>

<?php
  $filename = "templates/".$template_name."/style/style.css";
  if (!file_exists($filename))
  {
    if (!file_exists("templates/MoaDefault/style/style.css"))
    {
      echo "Cannot find template style - '".$filename."'";
    } else
    {
      $filename = "templates/MoaDefault/style/style.css";
    }
  }

  // Main stylesheet
  echo "<link rel='stylesheet' href='".$filename."' type='text/css'/>\n";

  // Set content type
  echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>\n";
?>
