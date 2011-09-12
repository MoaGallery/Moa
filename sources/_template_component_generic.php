<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function TagParseTemplatePath($p_tag_options)
  {
    global $template_name;

    $template_path = "";
    if (isset($template_name))
    {
      $template_path = "templates/".$template_name."/";
    }
    return $template_path;
  }

  function TagParseDebugMode($p_tag_options)
  {
    global $template_name;
    global $CFG;

    $str = "";

    if ($CFG["DEBUG_MODE"])
    {
      if (0 == strcmp($p_tag_options["style"], "divbg"))
      {
        $str .= "<div class='debug_mode'></div>";
      }
      if (0 == strcmp($p_tag_options["style"], "img"))
      {
        $str .= "<img src='templates/".$template_name."/media/debug_mode.png' class='debug_mode' alt='logo'/>";
      }
    }

    return $str;
  }

  function TagParseIE6Warning($p_tag_options)
  {
    $warning = LoadTemplate("component_ie6warning.php");

    $str = "<!--[if IE 6]>\n";

    $str.= $warning;

    $str .= "<![endif]-->";

    return $str;
  }

  function TagParseMessage($p_tag_options)
  {
  	global $g_message_type;
  	global $g_message_text;
    $message = LoadTemplate("component_feedback_box.php");

    $message = ParseVar($message, "FeedbackType", $g_message_type);
    $message = ParseVar($message, "FeedbackText", $g_message_text);

    return $message;
  }

?>