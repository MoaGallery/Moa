<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/_template_component_header.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_footer.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_image.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_gallery.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_admin.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_login.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_sitemap.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_generic.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_settings.php");
  include_once($CFG["MOA_PATH"]."sources/_template_component_main.php");

  function LoadTemplate($p_filename)
  {
    global $template_name;
    global $pre_cache;
    global $CFG;

    $filename = $CFG["MOA_PATH"]."templates/".$template_name."/".$p_filename;

    $fp = @fopen($filename, "r");
    if ((!$fp) && (is_bool($fp)))
    {
      $fp = $fp = @fopen($CFG["MOA_PATH"]."templates/MoaDefault/".$p_filename, "r");
      if ((!$fp) && (is_bool($fp)))
      {
        return "Cannot find template file - '".$filename."'";
      }
    }

    $template = fread($fp, 1000000);
    fclose($fp);

    return ParseTemplate($template);
  }

  function LoadTemplateForJavaScript($p_filename)
  {
    $template = LoadTemplate($p_filename);

    $new_template = "";
    $lines = explode("\n", $template);
    foreach ($lines as $line)
    {
      $line = str_replace("\"", "\\\"", $line);
      $line = str_replace("\x0A", "", $line);
      $line = str_replace("\x0D", "", $line);
      $new_template .= "  \"".$line."\\n\" +\n";
    }

    // Strip off the final '+'
    $new_template = substr($new_template, 0, strlen($new_template)-2);

    return $new_template;
  }

  function LoadTemplateRoot($p_template)
  {
    global $CFG;

    $template = LoadTemplate($p_template);
    ob_start();
    ob_flush();

    if ($CFG["DEBUG_MODE"])
    {
      $result = eval(" ?> ".$template." <?php ");
    } else
    {
      $result = @eval(" ?> ".$template." <?php ");
    }

    $result = ob_get_clean();

    if (false === $result)
    {
      $result = "error";
    }

    return $result;
  }

  function LoadTemplateRootForJavaScript($p_template)
  {
    global $CFG;

    $template = LoadTemplateforJavaScript($p_template);
    ob_start();
    ob_flush();

    if ($CFG["DEBUG_MODE"])
    {
      eval(" ?> ".$template." <?php ");
    } else
    {
      @eval(" ?> ".$template." <?php ");
    }

    $result = ob_get_clean();

    if (is_bool($result))
    {
      $result = "error";
    }

    return $result;
  }

  function SplitTag($source)
  {
    $instring = false;

    for ($i = 0; $i < (strlen($source) - 1); $i++)
    {
      if (($source[$i] == "\"") || ($source[$i] == "'"))
      {
        if ($i > 0)
        {
          if (!($source[$i-1] == "\\"))
          {
            $instring = !$instring;
          }
        }
      }
      if ($source[$i] == " ")
      {
        if ($instring)
        {
          $source[$i] = "\x01";
        }
      }
    }

    $result = explode(" ", $source);
    $result = str_replace( "\x01", " ", $result);

    return $result;
  }

  function ParseTemplate($p_template)
  {
    global $CFG;

    $template = $p_template;
    $start = 0;
    $end = 0;

    while (!is_bool(strpos($template, "<moatag")))
    {
      $start = strpos($template, "<moatag");
      $end = strpos($template, ">", $start);
      $fulltag = substr($template, $start, $end-$start+1);
      $tagstring = substr($fulltag, 7, strlen($fulltag)-8);
      $str_b = false;
      $tag_options = Array();
      $type = "";

      $tags = SplitTag($tagstring);

      foreach ($tags as $tag)
      {
        $tag = trim($tag);
        if (0 < strlen($tag))
        {
          $tag_attribute = explode("=", $tag);
          if (!isset($tag_attribute[1]))
          {
            $tag_attribute[1] = "";
          }
          $tag_attribute[1] = substr($tag_attribute[1], 1, strlen($tag_attribute[1])-2);
          if (0 == strcmp($tag_attribute[0], "type"))
          {
            $type = $tag_attribute[1];
          } else
          {
            $tag_options[$tag_attribute[0]] = $tag_attribute[1];
          }
        }
      }

      // Generate expected parsing function name
      $fname = "TagParse".$type;

      // Call it if it exists
      if (function_exists($fname))
      {
      	$str_b = $fname($tag_options);
      }

      if ((0 == strlen($str_b)) && ($CFG["DEBUG_MODE"]))
      {
        $str_b = "TEMPLATE WARNING: Tag not found - '".html_display_safe($fulltag)."'.";
      }

      $str_a = substr($template, 0, $start);
      $str_c = substr($template, $end+1, strlen($template));
      $template= $str_a.$str_b.$str_c;

    }

    return $template;
  }

  function ParseVar($p_text, $p_name, $p_value)
  {
    $progress = 0;
    while ((!is_bool(strpos($p_text, "<moavar", $progress))))
    {
      $start = strpos($p_text, "<moavar", $progress);
      $end = strpos($p_text, ">", $start);
      $fulltag = trim(substr($p_text, $start, $end-$start+1));
      $varname = trim(substr($fulltag, 7, strlen($fulltag)-8));

      if (0 == strcmp($varname, $p_name))
      {
        $newtext = substr($p_text, 0, $start);
        $newtext .= $p_value;
        $newtext .= substr($p_text, $end+1);
        $p_text = $newtext;
        $progress = 0;
      } else
      {
        $progress = $end;
      }
    }

    return $p_text;
  }
?>