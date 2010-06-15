<?php
  header('Cache-Control: no-cache');

  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  global $errorString;
  global $CFG;

  $bodycontent = '';
  $headercontent = '';
  $errorString = '';

  // Tell included files not to run in "stand-alone" mode
  $preCache = true;

  // if no config run the install, else include the config
  if (is_file("config.php") == false)
  {
    include("install.php");
    die();
  }

  // Load Moa settings
  include_once("sources/_settings.php");
  LoadSettings();

  // Include login/cookie stub if we aren't installing
  if (isset($FRESH_INSTALL) == false)
  {
    include_once($CFG["MOA_PATH"]."sources/_logout.php");
    include_once($CFG["MOA_PATH"]."sources/_login.php");
  }

  $action = GetParam("action");

  // Don't show header/footer when viewing the full image
  $show_headers = true;
  if (0 == strcmp($action, "image_view_full"))
  {
    $show_headers = false;
  }

  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");
  include_once($CFG["MOA_PATH"]."sources/mod_upgrade_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_template_parser.php");

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


  // Process submitted data
  if (isset($_REQUEST["moa_form_submitted"]))
  {
    if (0 == strcmp($_REQUEST["moa_form_submitted"], "true"))
    {
      switch ($action)
      {
        case "admin_settings" :
        {
          include_once("sources/page_admin_settings_submit.php");
          break;
        }
      }
    }
  }

  // Find out which template we should be using. Fall back to MoaDefault if none set
  $template_name = "MoaDefault";
  if (isset($CFG["TEMPLATE"]))
  {
    if (is_dir("templates/".$CFG["TEMPLATE"]))
    {
      $template_name = $CFG["TEMPLATE"];
    }
  }

  // Start generating the content
  $bodycontent = "";
  $bodytitle = "";

  // Redirect admin access for anyone not logged in
  if ((!UserIsLoggedIn()) && (0 == strcmp(substr($action, 0, 5), 'admin')))
  {
    $action = 'login';
  }
  
  switch($action)
  {
    case "admin" :
    {
      include_once("sources/page_admin.php");
      break;
    }
    case "admin_ftp" :
    {
      include_once("sources/page_admin_ftp.php");
      break;
    }
    case "admin_settings" :
    {
      include_once("sources/page_admin_settings.php");
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

  if ($show_headers)
  {
  	include_once ("sources/_header.php");
    $bodycontent .= LoadTemplateRoot("component_footer.php");
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
     <?php
       include_once ("sources/_html_head.php");
       if (isset($FRESH_INSTALL))
       {
         include("install.php");
         die();
       }
       echo "<title>".$bodytitle."</title>";
     ?>
  </head>
  <body>
     <?php
       echo $headercontent;
       echo $bodycontent;
       if ($CFG["DEBUG_MODE"])
       {
       	 if (0 !== strlen($errorString))
       	 {
       	   echo moa_feedback_ret($errorString, 'Error');
       	 }
       }
     ?>
  </body>
</html>