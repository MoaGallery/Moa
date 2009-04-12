<?php
  global $MOA_PATH;

  // Tell included files not to run in "stand-alone" mode
  $pre_cache = true;

  // if no config run the install, else include the config
  if (is_file("config.php") == false)
  {
    include("install.php");
    die();
  }

  include_once ("config.php");

  // If MOA_PATH is not set in config.php then set it here
  // to the likely value to all processing to continue.
  //
  // Needed for when 1.2 are first copied over a existing install.
  if (!isset($MOA_PATH))
  {
    $file_path = str_replace( "\\", "/", dirname(realpath(__FILE__)));
    $MOA_PATH = str_replace( getenv("DOCUMENT_ROOT"), "", $file_path) . "/";
  }

  // Include login/cookie stub if we aren't installing
  if (isset($FRESH_INSTALL) == false)
  {
    include_once($MOA_PATH."sources/_logout.php");
    include_once($MOA_PATH."sources/_login.php");
  }

  // Find out which template we should be using. Fall back to MoaDefault if none set
  $template_name = "MoaDefault";
  $query = "SELECT * FROM ".$tab_prefix."options WHERE Name = 'Template';";
  $result = mysql_query($query);
  if ($result) {
    $row = mysql_fetch_array($result);
    $template_name = $row["Value"];
  }

  $action = GetParam("action");

  // Don't show header/footer when viewing the full image
  $show_headers = true;
  if (0 == strcmp($action, "image_view_full"))
  {
    $show_headers = false;
  }

  include_once($MOA_PATH."sources/id.php");
  include_once($MOA_PATH."sources/common.php");
  include_once($MOA_PATH."sources/mod_upgrade_funcs.php");
  include_once($MOA_PATH."sources/_template_parser.php");

  // See if we need an upgrade warning
  if (_MoaDetectOldVersion())
  {
  	// If logged in
  	if (UserIsLoggedIn())
  	{
  	  moa_warning("Upgraded files have been installed. Please click <a href='index.php?action=upgrade'><i>here</i></a> to complete the upgrade.", false);
  	} else
  	{
  		moa_warning("Upgrade in progress.", false);
  	}
  }

  // Fill in vars early if available
  if (isset($_REQUEST["image_id"]))
  {
    $image_id = $_REQUEST["image_id"];
  }

  if (isset($_REQUEST["gallery_id"]))
  {
    $gallery_id = $_REQUEST["gallery_id"];
  } else
  {
    $_REQUEST["gallery_id"] = "0000000000";
    $gallery_id = "0000000000";
  }

  if (isset($_REQUEST["parent_id"]))
  {
    $parent_id = $_REQUEST["parent_id"];
    $_REQUEST["gallery_id"] = $parent_id;
    $gallery_id = $parent_id;
  }
  $current_gallery = $gallery_id;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       if (isset($FRESH_INSTALL))
       {
         include("install.php");
         die();
       }
       echo "<title></title>";
     ?>
  </head>
  <body>
    <?php
      if ($show_headers)
      {
        include_once ("sources/_header.php");
      }

      switch($action)
      {
        case "admin" :
        {
          include_once("sources/page_admin.php");
          break;
        }
        case "admin_maintain_image" :
        {
          include_once("sources/page_admin_maintain_image.php");
          break;
        }
        case "admin_maintain" :
        {
          include_once("sources/page_admin_maintain.php");
          break;
        }
        case "admin_orphans" :
        {
          include_once("sources/page_admin_orphans.php");
          break;
        }
        case "admin_tag" :
      	{
      		include_once("sources/page_admin_tags.php");
          break;
      	}
        case "admin_users" :
        {
          include_once("sources/page_admin_users.php");
          break;
        }
      	case "gallery_add" :
        {
          include_once("sources/page_gallery_add.php");
          break;
        }
        case "gallery_view" :
        {
          include_once("sources/page_gallery_view.php");
          break;
        }
        case "image_add" :
        {
          include_once("sources/page_image_add.php");
          break;
        }
      	case "image_view" :
      	{
      		include_once("sources/page_image_view.php");
      		break;
      	}
        case "image_view_full" :
        {
          include_once("sources/page_image_view_full.php");
          break;
        }
        case "login" :
        {
        	$logout = false;
          include_once("sources/page_login.php");
          break;
        }
        case "logout" :
        {
        	$logout = true;
          include_once("sources/page_login.php");
          break;
        }
        case "sitemap" :
        {
          include_once("sources/page_sitemap.php");
          break;
        }
        case "upgrade" :
        {
          include_once("sources/page_upgrade.php");
          break;
        }
      	default :
      	{
      		include_once("sources/page_main_view.php");
      		break;
      	}
      }

      if (isset($page_title))
      {
        echo "<script type='text/javascript'>\n";
        echo "  document.title = '".$page_title."';\n";
        echo "</script>\n";
      }

      if ($show_headers)
      {
        echo LoadTemplate("component_footer.php");
      }
    ?>
  </body>
</html>