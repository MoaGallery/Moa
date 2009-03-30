<?php
  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
    moa_warning("You must be logged in to use this page.");
  } else
  {
  	include_once("sources/common.php");
    include_once ("sources/_admin_page_links.php");
    include_once ("sources/_integrity_funcs.php");

    echo "<div id='orphanblockfeedback'>"; ViewDeleteFeedback(); echo"</div>\n";
    echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>Orphan Images</td></tr><tr><td class='pale_area_nb'>\n";

    ShowNonTaggedOrphans();
    echo "<hr>\n";
    ShowNoGalleryOrphans();

    echo "</td></tr></table>\n";
  }

  $page_title = "Orphan admin";
?>
