<?php

  // Used to hold 1 gallery for the breadcrumb data
  class Nav
  {
    var $m_name;
    var $m_id;
  };

  function TagParseHeaderUserName($p_tag_options)
  {
    $name = UserName();
    return html_display_safe($name);
  }

  function TagParseHeaderImageCount($p_tag_options)
  {
    global $tab_prefix;
    global $ErrorString;

    $query = "SELECT count(1) as Count FROM ".$tab_prefix."image";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    $row = mysql_fetch_array($result);
    return $row["Count"];
  }

  function TagParseHeaderGalleryCount($p_tag_options)
  {
    global $tab_prefix;
    global $ErrorString;

    $query = "SELECT count(1) as Count FROM ".$tab_prefix."gallery";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    $row = mysql_fetch_array($result);
    return $row["Count"];
  }

  function TagParseHeaderSystemDate($p_tag_options)
  {
    date_default_timezone_set("GMT");
    $date = get_time_at_page_load();

    return $date;
  }

  function TagParseMainButtonBlock($p_tag_options)
  {
    $blankbutton = LoadTemplate("component_header_button.php");

    $button = $blankbutton;
    $button = ParseVar($button, "Label", "Site map");
    $button = ParseVar($button, "Link", "index.php?action=sitemap");
    $buttons = $button;

    if (UserIsLoggedIn())
    {
      $button = $blankbutton;
      $button = ParseVar($button, "Label", "Admin");
      $button = ParseVar($button, "Link", "index.php?action=admin");
      $buttons .= $button;

      $button = $blankbutton;
      $button = ParseVar($button, "Label", "Logout");
      $button = ParseVar($button, "Link", "index.php?action=logout");
      $buttons .= $button;
    } else
    {
      $button = $blankbutton;
      $button = ParseVar($button, "Label", "Login");
      $button = ParseVar($button, "Link", "index.php?action=login");
      $buttons .= $button;
    }

    return $buttons;
  }

  function TagParseHeaderWelcome($p_tag_options)
  {
    if (UserIsloggedin())
    {
      return LoadTemplate("component_header_welcome.php");
    }

    return " ";
  }

  function TagParseBreadcrumbList($p_tag_options)
  {
    global $gallery_id;
    global $tab_prefix;

    $linear = false;
    if (isset($p_tag_options["format"]))
    {
      if (0 == strcmp($p_tag_options["format"], "linear"))
      {
        $linear = true;
      }
    }

    $temp_nav_history = Array();
    $blanknode = LoadTemplate("component_breadcrumb_node.php");
    $count = 0;
    $dead = false;

    // Find parent galleries going back to Home gallery
    while ((0 != strcmp($gallery_id, "0000000000")) && (!$dead))
    {
      $query = "SELECT Name, IDParent FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      if ((is_bool($result)) && (!$result))
      {
        $dead = true;
      } else
      {
        $gal_name = mysql_fetch_array($result) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        if ((is_bool($gal_name)) && (!$gal_name))
        {
          $dead = true;
        } else
        {
          $nav = new Nav;
          $nav->m_name = $gal_name["Name"];
          $nav->m_id = $gallery_id;
          $temp_nav_history[] = $nav;
          $gallery_id = $gal_name["IDParent"];
        }
      }
    }

    // Add home gallery list history list
    $nav = new Nav;
    $nav->m_name = "Home";
    $nav->m_id = "0000000000";
    $temp_nav_history[] = $nav;

    // Reverse the order so home is first
    $nav_history = array_reverse($temp_nav_history);

    $nodes = "";

    $end = count($nav_history);

    foreach($nav_history as $nav_node)
    {
      $node = $blanknode;
      if ($linear)
      {
        if (($count+1) == $end)
        {
          $node = ParseVar($node, "SpacerWidth", "0");
        } else
        {
          $node = ParseVar($node, "SpacerWidth", "20");
        }
      } else
      {
        $node = ParseVar($node, "SpacerWidth", ($count*$p_tag_options["spacing"]));
      }
      $node = ParseVar($node, "NodeID", $nav_node->m_id);
      $node = ParseVar($node, "NodeName", $nav_node->m_name);
      $nodes .= $node;
      $count++;
    }

    return $nodes;
  }

  function TagParseBreadcrumbSpacer($p_tag_options)
  {
    return LoadTemplate("component_breadcrumb_spacer.php");
  }
?>