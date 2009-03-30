<?php  
  $proceed = true;

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	$proceed = false;
    moa_error( 'Not logged in');
  }

  // If we are logged in
  if ($proceed)
  {
    include_once("sources/mod_tag_view.php");
    include_once("sources/_admin_page_links.php");

    echo "<script type='text/javascript' src='sources/common.js'></script>\n";
    echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
    echo "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
    TagBlock();
    echo "<script type='text/javascript'>\n";
    echo "  all_tags = '"; ViewAllTagList(); echo "';\n";
    echo "  add_form = "; ViewTagAddForm(); echo ";\n";
    echo "  add_link = "; ViewTagAddLink(); echo ";\n";
    echo "  tag_delimiter = '".$STR_DELIMITER."';\n";
    echo "  var tag_list = new TagList( tag_delimiter);\n";
    echo "  tag_list.PreLoad(all_tags, '');\n";
    echo "  document.getElementById('tag_lines').innerHTML = tag_list.ViewAll();\n";
    echo "</script>\n";
  }

  $page_title = "Tag admin";
?>