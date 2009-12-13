<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function TagParseSiteMapList($p_tag_options)
  {
    $output = "";
    $spacing = 10;

    if (isset($p_tag_options['spacing']))
    {
    	$spacing = $p_tag_options['spacing'];
    }

    $output .= get_sub_galleries( "0000000000", 0, $output, $spacing);

    return $output;
  }

  function TagParseSiteMapNodeSpacer($p_tag_options)
  {

  }


  // Recurse through all galleries
  function get_sub_galleries( $p_parent_id, $p_level, $p_output, $p_spacing)
  {
    global $CFG;

    $line    = LoadTemplate("component_sitemap_node.php");
    $spacer  = LoadTemplate("component_sitemap_spacer.php");

    $query = "SELECT IDGallery, name, description FROM ".$CFG["tab_prefix"]."gallery WHERE (IDParent='".mysql_real_escape_string($p_parent_id)."')";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if (($p_parent_id == '0000000000') && ( mysql_num_rows($result) == 0))
    {
      return "There are currently no galleries. ";
    }
    else
    {
      while ($gallery = mysql_fetch_array($result))
      {
        $node = "";

        $node .= $line;

        if ($gallery["description"] == NULL)
        {
          if ($CFG["SHOW_EMPTY_DESC_POPUPS"] == true)
          {
            $popup = "";
          } else
          {
            $popup = "onmouseover='return overlib(\"".popup_display_safe($CFG["EMPTY_DESC_POPUP_TEXT"])."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
          }
        } else
        {
          $popup = "onmouseover='return overlib(\"".popup_display_safe($gallery["description"])."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }

        $node = ParseVar( $node, "SiteMapNodePopUp"      , $popup);
        $node = ParseVar( $node, "SiteMapNodeName"       , html_display_safe($gallery["name"]));
        $node = ParseVar( $node, "SiteMapNodeDescription", html_display_safe($gallery["description"]));
        $node = ParseVar( $node, "SiteMapNodeID"         , html_display_safe($gallery["IDGallery"]));
        $node = ParseVar( $node, "SiteMapNodeSpacer"     , $spacer);
        $node = ParseVar( $node, "SpacerWidth"     , $p_spacing*$p_level);

        $p_output .= get_sub_galleries( $gallery["IDGallery"], $p_level + 1, $node, $p_spacing);
      }
    }
    return $p_output;
  }
?>