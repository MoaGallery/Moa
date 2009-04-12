<?php
  function TagParseTemplatePath($p_tag_options)
  {
    global $template_name;
    global $MOA_PATH;

    $template_path = $MOA_PATH;
    if (isset($template_name))
    {
      $template_path = "templates/".$template_name."/";
    }
    return $template_path;
  }
?>