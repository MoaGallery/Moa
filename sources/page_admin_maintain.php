<?php
  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
    moa_warning("You must have admin rights to use this page.");
  } else
  {
    include_once($MOA_PATH."sources/common.php");
    include_once($MOA_PATH."sources/_integrity_funcs.php");

    echo LoadTemplateRoot("page_admin_maintain.php");
  }

  $page_title = "Image integrity admin";
?>
