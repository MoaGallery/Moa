<?php
  include_once($MOA_PATH."sources/_template_parser.php");

  $ErrorString = '';

  function moa_feedback($p_text, $p_type)
  {
    $box = LoadTemplate("component_feedback_box.php");

    $box = ParseVar($box, "FeedbackText", $p_text);
    $box = ParseVar($box, "FeedbackType", $p_type);

    echo $box;
  }

  function moa_feedback_js()
  {
    $box = LoadTemplateForJavaScript("component_feedback_box.php");

    return $box;
  }

  function moa_feedback_ret($p_text, $p_type)
  {
    $box = LoadTemplate("component_feedback_box.php");

    $box = ParseVar($box, "FeedbackText", $p_text);
    $box = ParseVar($box, "FeedbackType", "Success");

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
    $box = LoadTemplate("component_feedback_fatal_error_box.php");

    $box = ParseVar($box, "FeedbackText", $p_text);
    $box = ParseVar($box, "FeedbackFile", $p_file);
    $box = ParseVar($box, "FeedbackLine", $p_line);

    echo $box;
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