<?php
  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
    moa_warning("You must have admin rights to use this page.");
  } else
  {
    include_once ("sources/_admin_page_links.php");
    include_once ("sources/_integrity_funcs.php");

    echo "<table id='add_table' class='area' width='100%' cellspacing='0' cellpadding='5'><tr><td class='box_header'>Image integrity</td></tr><tr><td class='pale_area_nb'>\n";

    ShowNoFileMaintain();
    echo "<hr>\n";
    ShowNoImageFileMaintain();
    echo "<hr>\n";
    ShowNoThumbFileMaintain();

    echo "</td></tr></table>\n";
  }

  $page_title = "Image integrity admin";
?>
