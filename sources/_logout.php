<?php
  if (isset($_REQUEST["action"]))
  {
    if (0 == strcmp($_REQUEST["action"], "logout"))
    {
      $c = setcookie($COOKIE_NAME, NULL, time()-100000, $COOKIE_PATH, false, false, false);
      $_COOKIE[$COOKIE_NAME] = NULL;
      session_start();
      session_unset();
      session_destroy();
    }
  }
?>