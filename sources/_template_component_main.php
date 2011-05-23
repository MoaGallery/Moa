<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function TagParseMainDescription($p_tag_options)
  {
    global $gallery_id;
    global $CFG;

    $desc = _MainGetDescription();

    if (0 == strlen($desc))
    {
      $desc = " ";
    }

    return html_display_safe($desc);
  }

  function TagParseMainDeleteFeedback($p_tag_options)
  {
    $str = ViewDeleteFeedback();

    if (0 == strlen($str))
    {
      return " ";
    }

    return $str;
  }

?>