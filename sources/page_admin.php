<?php
  include_once $MOA_PATH."sources/id.php";

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	 moa_warning("You must have admin rights to use this page.");
  }  else
  {
    echo LoadTemplateRoot("page_admin.php");
  }
  $page_title = "Admin";
?>
