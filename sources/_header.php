<?php
  class Nav
  {
    var $Name;
    var $ID;
  }

  $nav_history = array();
  $temp_nav_history = array();

  include_once("private/db_config.php");
  include_once("config.php");

  if (isset($db_host))
  {
    $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
    mysql_select_db($db_name, $db) or die("Error" . mysql_error());
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
  while (0 != strcmp($current_gallery, "0000000000"))
  {
    $query = "SELECT Name, IDParent FROM ".$tab_prefix."gallery WHERE (IDGallery = '".$current_gallery."')";
    $result = mysql_query($query) or die("Error: ".mysql_error());
	  $gal_name = mysql_fetch_array($result) or die("Error: ".mysql_error());
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
            if (false == isset($INSTALLING)) {
              $INSTALLING = false;
            }
            
            if (!$INSTALLING)
            {
              echo "<td><a href='index.php'><img src='media/moa-logo-vector.png' alt='Logo'/></a>&nbsp;</td>\n";
            } else
            {
              echo "<td><img src='media/moa-logo-vector.png' alt='Logo'/>&nbsp;</td>\n";
            }
          ?>
          <td class='header_text'>
            <?php
              include_once ("sources/id.php");
              if (!$INSTALLING)
              {
                if ($Userinfo->ID != NULL)
                {                                
                  // Show the username                
                  echo "Welcome ".$Userinfo->Name."<BR>\n";
                }
              } else
              {
                echo "Welcome to Moa<BR>\n";
              }
              
              if (!$INSTALLING)
              {
                // Show the image stats
                $query = "SELECT count(1) AS recordcount FROM ".$tab_prefix."image";
                $result = mysql_query($query) or die("Error: ".mysql_error());
                $count = mysql_fetch_array($result);
                if ($count)
                {
                  echo "Currently holding ".$count["recordcount"]." images";
                }

                // Show the gallery stats
                $query = "SELECT count(1) AS recordcount FROM ".$tab_prefix."gallery";
                $result = mysql_query($query) or die("Error: ".mysql_error());
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
      <td class="width100pct">
        <?php
          // echo "<a href='index.php'><img src='media/button-home.png'></a>";
          if ($Userinfo->ID == NULL)
          {
            echo "<a href='login.php'><img src='media/button-login.png\n' alt='Login button'/></a>\n";
            echo "<a href='map.php'><img src='media/site-map.png\n' alt='Site map button'/></a>";
          } else
          {
            echo "<a href='admin.php'><img src='media/button-admin.png' alt='Admin button'/></a>\n";
            echo "<a href='map.php'><img src='media/site-map.png\n' alt='Site map button'/></a>\n";
            echo "<a href='index.php?logout=true'><img src='media/button-logout.png' alt='Logout button'/></a>\n";
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
      <td class="width100pct">
        <?php
          $count = 0;
          foreach($nav_history as $nav_node)
          {
            for($loop = 0; $loop < $count; $loop++)
            {
              echo "&nbsp;&nbsp;";
            }
  
            if (0 == strcmp($nav_node->ID, "0000000000"))
            {
              echo "<a class ='nav_icon' href='index.php'><img src='media/folder_open.gif' alt='Folder icon'/>&nbsp;</a>";
              echo "<a id='nav_tree_0000000000' class='nav_link' href='index.php'>".$nav_node->Name."</a><br/>\n";                        
              
            } else
            {
              echo "<a class='nav_icon' href='view_gallery.php?gallery_id=".$nav_node->ID."'><img src='media/folder_open.gif' alt='Folder icon'/>&nbsp;</a>";
              echo "<a id='nav_tree_".$nav_node->ID."' class='nav_link' href='view_gallery.php?gallery_id=".$nav_node->ID."'>".$nav_node->Name."</a><br/>\n";
            }
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