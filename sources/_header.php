<?php
  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }

  if (!$INSTALLING)
  {
    include_once("_db_funcs.php");
    include_once("config.php");
    include_once("_breadcrumb.php");
    include_once("_buttons.php");
  }

  if (!isset($DEBUG_MODE))
  {
  	$DEBUG_MODE = false;
  }

  if (!$DEBUG_MODE)
  {
    if ((is_file("install.php")) && (is_file("config.php")) && (false == isset($FRESH_INSTALL)) && (!$INSTALLING))
    {
      moa_warning("Please delete or rename install.php");
    }
  }

  if (isset($db_host))
  {
    $db = DBConnect();
  }

  // Set gal_id to homepage if none is set
  if (false == isset($_REQUEST["gallery_id"]))
  {
    $_REQUEST["gallery_id"] = "0000000000";
  }
  // Set gal_id to parent_id if it is set
  if (true == isset($_REQUEST["parent_id"]))
  {
    $_REQUEST["gallery_id"] = $_REQUEST["parent_id"];
  }
  $current_gallery = $_REQUEST["gallery_id"];

  // Check gallery exists and set to home if it doesn't
  if (0 != strcmp("0000000000", $current_gallery))
  {
    $query = "SELECT Name FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($current_gallery)."')";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    if (0 == mysql_num_rows($result))
    {
      $current_gallery = "0000000000";
    }
  }
?>

<div id='overDiv' style='position:absolute; visibility:hidden; z-index:1000;'></div>
<table class="area" border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2">
      <table border="0" cellpadding="0">
        <tr>
          <?php
            if (!$INSTALLING)
            {
              echo "<td><a href='index.php'><img class='mainlogo' style='display: block;' src='media/";
              if ($DEBUG_MODE)
              {
              	echo "debug-";
              }
              echo "moa-logo-vector.png' alt='Logo'/></a>&nbsp;</td>\n";
            } else
            {
              echo "<td><img class='mainlogo' src='media/moa-logo-vector.png' alt='Logo'/>&nbsp;</td>\n";
            }
          ?>
          <td class='header_text'>
            <?php
              if (!$INSTALLING)
              {
                include_once ("sources/id.php");
                if (UserIsLoggedIn())
                {
                  // Show the username
                  echo "Welcome ".html_display_safe(UserName())."<br/>\n";
                }
              } else
              {
                echo "Welcome<br/>\n";
              }

              if (!$INSTALLING)
              {
                // Show the image stats
                $query = "SELECT count(1) AS recordcount FROM ".$tab_prefix."image";
                $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
                $count = mysql_fetch_array($result);
                if ($count)
                {
                  echo "Currently holding <span id='hdr_imagecount'>".$count["recordcount"]."</span> images";
                }

                // Show the gallery stats
                $query = "SELECT count(1) AS recordcount FROM ".$tab_prefix."gallery";
                $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
                $count = mysql_fetch_array($result);
                if ($count)
                {
                  echo " and <span id='hdr_gallerycount'>".$count["recordcount"]."</span> galleries<br/>\n";
                }
              }

              // Show the current date and time
              date_default_timezone_set("GMT");
              $date = get_time_at_page_load();

              echo $date."\n";

              echo"<img src='media/trans-pixel.png' width='300' height='1' alt=''/>";

              // For debug messages
              echo "<br/><div id='debug'></div>";
            ?>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?php
    if (!$INSTALLING)
    {
  ?>
    <tr>
      <td class="area_nb">&nbsp;</td>
      <td class="fullwidth">
        <?php
          ShowButtons();
        ?>
      </td>
    </tr>
  <?php
    }
  ?>
</table>
<?php
  if (!$INSTALLING)
  {
  	ShowBreadcrumbBar($current_gallery);
  }
?>
<div class="height10"></div>