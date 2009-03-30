<?php
  include_once "sources/id.php";

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	 moa_warning("You must have admin rights to use this page.");
  }  else
  {
    include ("sources/_admin_page_links.php");
  }
  $page_title = "Admin";
?>
