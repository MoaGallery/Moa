<?php
  $ErrorString = '';

  function moa_warning($p_text, $p_sources = false)
  {
    echo "<div class='warning_box' style='line-height:40px;'>\n";
    $icon = "media/warning.png";
    if (true == $p_sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='".$icon."' style='vertical-align:middle;' alt='Warning'/>";
    echo "  Warning: ".$p_text."\n";
    echo "</div><div><br/></div>\n";
  }

  function moa_error($p_text, $p_sources = false)
  {
    echo "<div class='warning_box' style='line-height:40px;'>\n";
    $icon = "media/error.png";
    if (true == $p_sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='".$icon."' style='vertical-align:middle;' alt='Error'/>";
    echo "  Error: ".$p_text."\n";
    echo "</div><div><br/></div>\n";
  }

  function moa_db_error($p_text, $p_file, $p_line)
  {
    echo "<div class='fatalerror_box' style='line-height:40px;'>\n";
    echo "<img src='media/error.png' style='vertical-align:middle;' alt='Error'/>";
    echo "  Fatal error!: Line ".$p_line." of ".$p_file."<br/>".$p_text."\n";
    echo "</div><div><br/></div>\n";
  }

  function moa_success($p_text, $p_sources = false)
  {
    echo "<div class='success_box' style='line-height:40px;'>\n";
    $icon = "media/success.png";
    if (true == $p_sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='media/success.png' style='vertical-align:middle;' alt='Success'/>";
    echo "  Success: ".$p_text."\n";
    echo "</div><div><br/></div>\n";
  }

  function moa_feedback($p_text, $p_sources = false)
  {
    global $MOA_ROOT;
    echo "<div class='success_box' style='line-height:40px;'>\n";
    $icon = "media/gallery_add.png";
    if (true == $p_sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='".$icon."' style='vertical-align:middle;' alt='Feedback'/>";
    echo "  Success: ".$p_text."\n";
    echo "</div><div><br/></div>\n";
  }
?>