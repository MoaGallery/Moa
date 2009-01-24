<?php
  class Nav
  {
    var $Name;
    var $ID;
  }

  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }

  $nav_history = array();
  $temp_nav_history = array();

  if (!$INSTALLING)
  {
    include_once("_db_funcs.php");
    include_once("config.php");
  }

  if ((is_file("install.php")) && (is_file("config.php")) && (false == isset($FRESH_INSTALL)) && (!$INSTALLING))
  {
    moa_warning("Please delete or rename install.php");
  }

  if (isset($db_host))
  {
    $db = DBConnect();
  }

  // Get nav history
  if (false == isset($_REQUEST["gallery_id"]))
  {
    $_REQUEST["gallery_id"] = "0000000000";
  }
  if (true == isset($_REQUEST["parent_id"]))
  {
    $_REQUEST["gallery_id"] = $_REQUEST["parent_id"];
  }
  $current_gallery = $_REQUEST["gallery_id"];
  
  if (0 != strcmp("0000000000", $current_gallery))
  {
    $query = "SELECT Name FROM ".$tab_prefix."gallery WHERE (IDGallery = '".$current_gallery."')";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    if (0 == mysql_num_rows($result))
    {
      $current_gallery = "0000000000";
    }
  }
  while (0 != strcmp($current_gallery, "0000000000"))
  {
    $query = "SELECT Name, IDParent FROM ".$tab_prefix."gallery WHERE (IDGallery = '".$current_gallery."')";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	  $gal_name = mysql_fetch_array($result) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	  $nav = new Nav;
    $nav->Name = $gal_name["Name"];
    $nav->ID = $current_gallery;
    $temp_nav_history[] = $nav;
    $current_gallery = $gal_name["IDParent"];
  }
  $nav = new Nav;
  $nav->Name = "Home";
  $nav->ID = "0000000000";
  $temp_nav_history[] = $nav;

  $nav_history = array_reverse($temp_nav_history);
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
              echo "<td><a href='index.php'><img class='mainlogo' style='display: block;' src='media/moa-logo-vector.png' alt='Logo'/></a>&nbsp;</td>\n";
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
                if ($Userinfo->ID != NULL)
                {                                
                  // Show the username                
                  echo "Welcome ".html_display_safe($Userinfo->Name)."<br/>\n";
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
                  echo "Currently holding ".$count["recordcount"]." images";
                }

                // Show the gallery stats
                $query = "SELECT count(1) AS recordcount FROM ".$tab_prefix."gallery";
                $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
                $count = mysql_fetch_array($result);
                if ($count)
                {
                  echo " and ".$count["recordcount"]." galleries<br/>\n";
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
          if ($Userinfo->ID == NULL)
          {
            echo "<a href='map.php'><img src='media/site-map.png\n' alt='Site map button' width='80' height='21'/></a>\n";
            echo "<a href='login.php'><img src='media/button-login.png\n' alt='Login button' width='80' height='21'/></a>\n";
          } else
          {
            echo "<a href='map.php'><img src='media/site-map.png\n' alt='Site map button' width='80' height='21'/></a>\n";
            echo "<a href='admin.php'><img src='media/button-admin.png' alt='Admin button' width='80' height='21'/></a>\n";
            echo "<a href='index.php?logout=true'><img src='media/button-logout.png' alt='Logout button' width='80' height='21'/></a>\n";
          }
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
?>
  <table class="pale_area_nb" border="0" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td class="height5"></td>
      <td></td>
    </tr>
    <tr>
      <td class="width5">&nbsp;</td>
      <td class="fullwidth" style='vertical-align:middle;'>
        <?php
          $count = 0;
          foreach($nav_history as $nav_node)
          {
            echo "<div style='height:19px;'>\n";
            echo "  <div style='float:left;width:".(12*$count)."px;height:16px;'></div>";
  
            if (0 == strcmp($nav_node->ID, "0000000000"))
            {
              echo "  <div style='line-height:16px;'>\n";
              echo "    <a class ='nav_icon' href='index.php'><img class='breadcrumbicon' src='media/folder_open.png' style='vertical-align:middle; margin-top:1px;' alt='Folder icon'/>&nbsp;</a>\n";
              echo "    <a id='nav_tree_0000000000' class='nav_link' href='index.php'>".html_display_safe($nav_node->Name)."</a><br/>\n";                        
              echo "  </div>\n";  
            } else
            {
              echo "  <div style='line-height:16px;'>\n";
              echo "    <a class='nav_icon' href='view_gallery.php?gallery_id=".$nav_node->ID."'><img class='breadcrumbicon' src='media/folder_open.png' style='vertical-align:middle;' alt='Folder icon'/>&nbsp;</a>\n";
              echo "    <a id='nav_tree_".$nav_node->ID."' class='nav_link' href='view_gallery.php?gallery_id=".$nav_node->ID."'>".html_display_safe($nav_node->Name)."</a><br/>\n";
              echo "  </div>\n";
            }
            echo "</div>\n";
            
            $count++;
          }
        ?>
      </td>
    </tr>
    <tr>
      <td class="height5">
      </td>
    </tr>
  </table>
<?php
}
?>
<table>
  <tr class="height10">
    <td>
    </td>
  </tr>
</table>