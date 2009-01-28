<?php
  function moa_warning($text, $sources = false)
  {
    echo "<div class='warning_box' style='line-height:40px;'>\n";
    $icon = "media/warning.png";
    if (true == $sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='".$icon."' style='vertical-align:middle;' alt='Warning'/>";
    echo "  Warning: ".$text."\n";
    echo "</div><br/>\n";
  }
  
  function moa_error($text, $sources = false)
  {
    echo "<div class='warning_box' style='line-height:40px;'>\n";
    $icon = "media/error.png";
    if (true == $sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='".$icon."' style='vertical-align:middle;' alt='Error'/>";
    echo "  Error: ".$text."\n";
    echo "</div><br/>\n";
  }
  
  function moa_db_error($text, $file, $line)
  {
    echo "<div class='fatalerror_box' style='line-height:40px;'>\n";
    echo "<img src='media/error.png' style='vertical-align:middle;' alt='Error'/>";
    echo "  Fatal error!: Line ".$line." of ".$file."<br/>".$text."\n";
    echo "</div><br/>\n";
    //die();
  }
  
  function moa_success($text, $sources = false)
  {
    echo "<div class='success_box' style='line-height:40px;'>\n";
    $icon = "media/success.png";
    if (true == $sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='media/success.png' style='vertical-align:middle;' alt='Success'/>";
    echo "  Success: ".$text."\n";
    echo "</div><br/>\n";
  }
  
  function moa_feedback($text, $sources = false)
  {
    global $MOA_ROOT;
    echo "<div class='success_box' style='line-height:40px;'>\n";
    $icon = "media/gallery_add.png";
    if (true == $sources)
    {
      $icon = "../".$icon;
    }
    echo "<img src='".$icon."' style='vertical-align:middle;' alt='Feedback'/>";
    echo "  Success: ".$text."\n";
    echo "</div><br/>\n";
  }
?>