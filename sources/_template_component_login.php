<?php

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