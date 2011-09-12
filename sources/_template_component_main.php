<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function TagParseMainSubmitLink($p_tag_options)
  {
    return "onclick='main.SubmitEdit();'";
  }
    
  function TagParseMainCancelLink($p_tag_options)
  {
    return "onclick='main.CancelEdit();'";
  }
  
  function TagParseMainDescription($p_tag_options)
  {
    global $gallery_id;
    global $CFG;

    $main = new Main();
    $desc = $main->description;

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