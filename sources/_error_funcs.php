<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/_template_parser.php");

  $ErrorString = '';

  function moa_feedback($p_text, $p_type)
  {
    global $bodycontent;

    $box = LoadTemplate("component_feedback_box.php");

    $box = ParseVar($box, "FeedbackText", $p_text);
    $box = ParseVar($box, "FeedbackType", $p_type);

    $bodycontent .= $box;
  }

  function moa_feedback_js()
  {
    $box = LoadTemplateForJavaScript("component_feedback_box.php");

    return $box;
  }

  function moa_feedback_ret($p_text, $p_type = "Success")
  {
    $box = LoadTemplate("component_feedback_box.php");

    $box = ParseVar($box, "FeedbackText", $p_text);
    $box = ParseVar($box, "FeedbackType", $p_type);

    return $box;
  }

  function moa_warning($p_text)
  {
    moa_feedback($p_text, "Warning");
  }

  function moa_error($p_text)
  {
    moa_feedback($p_text, "Error");
  }

  function moa_db_error($p_text, $p_file, $p_line)
  {
    global $bodycontent;

    $box = LoadTemplate("component_feedback_fatal_error_box.php");

    $box = ParseVar($box, "FeedbackText", $p_text);
    $box = ParseVar($box, "FeedbackFile", $p_file);
    $box = ParseVar($box, "FeedbackLine", $p_line);

    $bodycontent .= $box;
  }

  function moa_success($p_text)
  {
    moa_feedback($p_text, "Success");
  }

  function moa_success_ret($p_text)
  {
    return moa_feedback_ret($p_text, "Success");
  }


?>