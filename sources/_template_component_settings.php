<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }


  function TagParseSettingsDatabaseForm($p_tag_options)
  {
    global $Userinfo;

    $output = " ";

    if ($Userinfo->m_admin)
    {
      $output = LoadTemplate("component_db_settings.php");
    }

    return $output;
  }

  function TagParseSettingsValue_SiteName($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["SITE_NAME"]))
    {
      $output = $CFG["SITE_NAME"];
    }

    return $output;
  }

  function TagParseSettingsValue_SiteByline($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["SITE_BYLINE"]))
    {
      $output = $CFG["SITE_BYLINE"];
    }

    return $output;
  }
  
  function TagParseSettingsValue_ShowEmptyDescPopups($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if ($CFG["SHOW_EMPTY_DESC_POPUPS"])
    {
      $output = "checked = 'checked'";
    }

    return $output;
  }

  function TagParseSettingsValue_EmptyDescPopupText($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["EMPTY_DESC_POPUP_TEXT"]))
    {
      $output = $CFG["EMPTY_DESC_POPUP_TEXT"];
    }

    return $output;
  }

  function TagParseSettingsValue_TitleDescLength($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["TITLE_DESC_LENGTH"]))
    {
      $output = $CFG["TITLE_DESC_LENGTH"];
    }

    return $output;
  }

  function TagParseSettingsValue_StrDelimiter($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["STR_DELIMITER"]))
    {
      $output = $CFG["STR_DELIMITER"];
    }

    return $output;
  }

  function TagParseSettingsValue_ThumbWidth($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["THUMB_WIDTH"]))
    {
      $output = $CFG["THUMB_WIDTH"];
    }

    return $output;
  }

  function TagParseSettingsValue_ConfigDisplayMaxWidth($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["CONFIG_DISPLAY_MAX_WIDTH"]))
    {
      $output = $CFG["CONFIG_DISPLAY_MAX_WIDTH"];
    }

    return $output;
  }

  function TagParseSettingsValue_DisplayPlainSubgalleries($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if ($CFG["DISPLAY_PLAIN_SUBGALLERIES"])
    {
      $output = "checked = 'checked'";
    }

    return $output;
  }
  
  function TagParseSettingsValue_ImagesPerPage($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["IMAGES_PER_PAGE"]))
    {
      $output = $CFG["IMAGES_PER_PAGE"];
    }

    return $output;
  }
  
  function TagParseSettingsValue_SlideshowDelay($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["SLIDESHOW_DELAY"]))
    {
      $output = $CFG["SLIDESHOW_DELAY"];
    }

    return $output;
  }

  function TagParseSettingsValue_MoaPath($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["MOA_PATH"]))
    {
      $output = $CFG["MOA_PATH"];
    }

    return $output;
  }

  function TagParseSettingsValue_ImagePath($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["IMAGE_PATH"]))
    {
      $output = $CFG["IMAGE_PATH"];
    }

    return $output;
  }

  function TagParseSettingsValue_ThumbPath($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["THUMB_PATH"]))
    {
      $output = $CFG["THUMB_PATH"];
    }

    return $output;
  }

  function TagParseSettingsValue_CookiePath($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["COOKIE_PATH"]))
    {
      $output = $CFG["COOKIE_PATH"];
    }

    return $output;
  }

  function TagParseSettingsValue_IncomingPath($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["BULKUPLOAD_PATH"]))
    {
      $output = $CFG["BULKUPLOAD_PATH"];
    }

    return $output;
  }

  function TagParseSettingsValue_CookieName($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["COOKIE_NAME"]))
    {
      $output = $CFG["COOKIE_NAME"];
    }

    return $output;
  }

  function TagParseSettingsFeedback($P_tag_options)
  {
    global $SETTINGS_FEEDBACK;

    if (0 == strlen($SETTINGS_FEEDBACK))
    {
      return " ";
    }

    return moa_feedback_ret($SETTINGS_FEEDBACK, "Error");
  }



  function TagParseSettingsValue_DBHost($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["db_host"]))
    {
      $output = $CFG["db_host"];
    }

    return $output;
  }

  function TagParseSettingsValue_DBName($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["db_name"]))
    {
      $output = $CFG["db_name"];
    }

    return $output;
  }

  function TagParseSettingsValue_DBUser($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["db_user"]))
    {
      $output = $CFG["db_user"];
    }

    return $output;
  }

  function TagParseSettingsValue_DBPass($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["db_pass"]))
    {
      $output = $CFG["db_pass"];
    }

    return $output;
  }

  function TagParseSettingsValue_TabPrefix($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["tab_prefix"]))
    {
      $output = $CFG["tab_prefix"];
    }

    return $output;
  }

  function TagParseSettingsValue_Template($p_tag_options)
  {
    global $CFG;

    $output = " ";

    if (0 < strlen($CFG["TEMPLATE"]))
    {
      $output = "";

      $dir = opendir($CFG["MOA_PATH"]."templates/");
      while (false !== ($file = readdir($dir)))
      {
        if (is_dir($CFG["MOA_PATH"]."templates/".$file))
        {
          if ('.' != substr($file, 0, 1))
          {
            $selected = "";
            if (0 == strcmp($file, $CFG["TEMPLATE"]))
            {
              $selected = " selected = \"selected\"";
            }
            $output .= "<option".$selected.">".$file."</option>\n";
          }
        }
      }
    }

    return $output;
  }

?>