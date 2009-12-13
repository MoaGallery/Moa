<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }


  if (isset($_REQUEST["action"]))
  {
    if (0 == strcmp($_REQUEST["action"], "logout"))
    {
      $c = setcookie($CFG["COOKIE_NAME"], NULL, time()-100000, $CFG["COOKIE_PATH"], false, false, false);
      $_COOKIE[$CFG["COOKIE_NAME"]] = NULL;
      session_start();
      session_unset();
      session_destroy();
    }
  }
?>