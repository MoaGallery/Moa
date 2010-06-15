<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/_template_parser.php");

  $errorString = '';

  function moa_feedback($p_text, $p_type)
  {
    global $bodycontent;

    $bodycontent .= moa_feedback_ret($p_text, $p_type);
  }

  function moa_feedback_js()
  {
    $feedback = LoadTemplateForJavaScript("component_feedback_box.php");

    return $feedback;
  }

  function moa_feedback_ret($p_text, $p_type = "Success")
  {
    $feedback = LoadTemplate("component_feedback_box.php");

    $feedback = ParseVar($feedback, "FeedbackText", $p_text);
    $feedback = ParseVar($feedback, "FeedbackType", $p_type);

    return $feedback;
  }

  function moa_warning($p_text)
  {
    moa_feedback($p_text, "Warning");
  }

  function moa_warning_ret($p_text)
  {
    return moa_feedback_ret($p_text, "Warning");
  }
  
  function moa_error($p_text)
  {
    moa_feedback($p_text, "Error");
  }

  function moa_db_error($p_text, $p_file, $p_line)
  {
    global $bodycontent;

    $feedback = LoadTemplate("component_feedback_fatal_error_box.php");

    $feedback = ParseVar($feedback, "FeedbackText", $p_text);
    $feedback = ParseVar($feedback, "FeedbackFile", $p_file);
    $feedback = ParseVar($feedback, "FeedbackLine", $p_line);

    $bodycontent .= $feedback;
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