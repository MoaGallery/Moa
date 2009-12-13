<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }


  function TagParseLogoutStatus($p_tag_options)
  {
    global $logout;

    if ($logout)
    {
      return "You have been logged out.";
    }

    return " ";
  }

?>