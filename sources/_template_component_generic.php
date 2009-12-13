<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function TagParseTemplatePath($p_tag_options)
  {
    global $template_name;

    $template_path = "";
    if (isset($template_name))
    {
      $template_path = "templates/".$template_name."/";
    }
    return $template_path;
  }

  function TagParseDebugMode($p_tag_options)
  {
    global $template_name;
    global $CFG;

    $str = "";

    if ($CFG["DEBUG_MODE"])
    {
      if (0 == strcmp($p_tag_options["style"], "divbg"))
      {
        $str .= "<div class='debug_mode'>";
        $str .= "</div>";
      }
      if (0 == strcmp($p_tag_options["style"], "img"))
      {
        $str .= "<img src='templates/".$template_name."/media/debug_mode.png' class='debug_mode' alt='logo'/>";
      }
    }

    return $str;
  }

  function TagParseIE6Warning($p_tag_options)
  {
    $warning = LoadTemplate("component_ie6warning.php");

    $str = "<!--[if IE 6]>\n";

    $str.= $warning;

    $str .= "<![endif]-->";

    return $str;
  }

  function TagParseMessage($p_tag_options)
  {
  	global $g_message_type;
  	global $g_message_text;
    $message = LoadTemplate("component_feedback_box.php");

    $message = ParseVar($message, "FeedbackType", $g_message_type);
    $message = ParseVar($message, "FeedbackText", $g_message_text);

    return $message;
  }

  function TagParseAdminLinks($p_tag_options)
  {
    global $gallery_id;

    if (UserIsLoggedIn())
    {
      if (!isset($p_tag_options["location"]))
      {
        if (0 == strcmp($gallery_id, "0000000000"))
        {
          $p_tag_options["location"] = "home";
        } else
        {
          $p_tag_options["location"] = "gallery";
        }
      }

      if (0 == strcmp($p_tag_options["location"], "gallery"))
      {
        $links = LoadTemplate("component_gallery_admin_links.php");
        $links = ParseVar($links, "GalleryEditLink", "onclick='gallery.Edit();'");
        $links = ParseVar($links, "GalleryDeleteLink", "onclick='gallery.Delete();'");
        $links = ParseVar($links, "ImageAddLink", "href='index.php?action=image_add&amp;parent_id=".$gallery_id."'");
        $links = ParseVar($links, "GalleryAddLink", "href='index.php?action=gallery_add&amp;parent_id=".$gallery_id."'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "home"))
      {
        $links = LoadTemplate("component_gallery_home_admin_links.php");
        $links = ParseVar($links, "HomeEditLink", "onclick='main.Edit();'");
        $links = ParseVar($links, "ImageAddLink", "href='index.php?action=image_add&amp;parent_id=".$gallery_id."'");
        $links = ParseVar($links, "GalleryAddLink", "href='index.php?action=gallery_add&amp;parent_id=".$gallery_id."'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "image"))
      {
        $links = LoadTemplate("component_image_admin_links.php");
        $links = ParseVar($links, "ImageEditLink", "onclick='image.Edit();'");
        $links = ParseVar($links, "ImageDeleteLink", "onclick='image.Delete();'");
        return $links;
      }
      elseif (0 == strcmp($p_tag_options["location"], "admin"))
      {
        $links = LoadTemplate("component_admin_links.php");
        $links = ParseVar($links, "AdminUserLink", "index.php?action=admin_users");
        $links = ParseVar($links, "AdminTagLink", "index.php?action=admin_tag");
        $links = ParseVar($links, "AdminSettingsLink", "index.php?action=admin_settings");
        $links = ParseVar($links, "AdminOrphanLink", "index.php?action=admin_orphans");
        $links = ParseVar($links, "AdminIntegrityLink", "index.php?action=admin_maintain");
        return $links;
      }
      return "";
    }
    return " ";
  }
?>