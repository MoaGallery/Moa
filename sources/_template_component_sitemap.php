<?php

  function TagParseSiteMapList($p_tag_options)
  {
    $output = "";

    $output .= get_sub_galleries( "0000000000", 0, $output);

    return $output;
  }

  function TagParseSiteMapSpacer($p_tag_options)
  {
    return "Spacer";
  }

  function TagParseSiteMapNode($p_tag_options)
  {
    return "Node";
  }

    // Recurse through all galleries
  function get_sub_galleries( $p_parent_id, $p_level, $p_output)
  {
    global $EMPTY_DESC_POPUP_TEXT;
    global $SHOW_EMPTY_DESC_POPUPS;
    global $tab_prefix;

    $line    = LoadTemplate("component_sitemap_node.php");
    $spacer  = LoadTemplate("component_sitemap_spacer.php");

    $query = "SELECT IDGallery, name, description FROM ".$tab_prefix."gallery WHERE (IDParent='".mysql_real_escape_string($p_parent_id)."')";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if (($p_parent_id == '0000000000') && ( mysql_num_rows($result) == 0))
    {
      echo "No galleries.";
    }
    else
    {
      while ($gallery = mysql_fetch_array($result))
      {
        $node = "";
        $node_spacer ="";

        $node .= $line;

        for ($i = 0; $i < $p_level; $i++)
        {
          $node_spacer .= $spacer;
        }

        if ($gallery["description"] == NULL)
        {
          if ($SHOW_EMPTY_DESC_POPUPS == true)
          {
            $popup = "";
          } else
          {
            $popup = "onmouseover='return overlib(\"".$EMPTY_DESC_POPUP_TEXT."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
          }
        } else
        {
          $popup = "onmouseover='return overlib(\"".html_display_safe($gallery["description"])."\", ADAPTIVE_WIDTH, 100);' onmouseout='return nd();'";
        }

        $node = ParseVar( $node, "SiteMapNodePopUp"      , $popup);
        $node = ParseVar( $node, "SiteMapNodeName"       , html_display_safe($gallery["name"]));
        $node = ParseVar( $node, "SiteMapNodeDescription", html_display_safe($gallery["description"]));
        $node = ParseVar( $node, "SiteMapNodeID"         , html_display_safe($gallery["IDGallery"]));
        $node = ParseVar( $node, "SiteMapNodeSpacer"     , $node_spacer);

        $p_output .= get_sub_galleries( $gallery["IDGallery"], $p_level + 1, $node);
      }
    }
    return $p_output;
  }
?>