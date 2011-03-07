<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function LanguageEnglish()
  {
    global $languageStrings;
    global $CFG;
    
    $languageStrings = array('popupHelp_file'                        => 'Choose a file to upload',
                             'popupHelp_desc'                         => 'Write a description',
                             'popupHelp_imagetags'                    => "Choose some tags, separated by the '".$CFG['STR_DELIMITER']."' character",
                             'popupHelp_gal_parent'                   => "The new gallery will be created inside the one specified here",
                             'popupHelp_gal_desc'                     => 'Write a description for the new gallery',
                             'popupHelp_gal_name'                     => "A short name for the new gallery",
                             'popupHelp_gal_tags'                     => "Choose some tags, separated by the '".$CFG['STR_DELIMITER']."' character",
                             'popupHelp_gal_tagged'                   => "Should this gallery automatically contain ONLY images that have the same tags?",
                             'popupHelp_ftp_parent'                   => "The images will be uploaded inside the gallery specified here",
                             'popupHelp_ftp_desc'                     => 'Write a description that will be added to all the uploaded images',
                             'popupHelp_ftp_tags'                     => "Choose some tags, separated by the '".$CFG['STR_DELIMITER']."' character",
                             'popupHelp_main_desc'                    => 'Write a description for the front page or leave it blank',
                             'popupHelp_setting_show_popups'          => "Whether to show image and gallery descriptions when you mouse over a thumbnail",
                             'popupHelp_setting_empty_desc_popup'     => "What text to show when mousing over a thumbnail with no description (if show popups is on)",
                             'popupHelp_setting_title_desc_length'    => "How many characters of the title/description to show in the browser title bar or tab",
                             'popupHelp_setting_str_delimiter'        => "Example - 'tag1,tag2,tag3' would need comma set as the character",
                             'popupHelp_setting_template'             => "Choose how Moa looks.",
                             'popupHelp_setting_thumb_width'          => "Width of image thumbnails in pixels",
                             'popupHelp_setting_preview_width'        => "Width of the larger image preview in pixels",
                             'popupHelp_setting_plain_subgalleries'   => "Choose whether to hide images in a gallery if it also has sub-galleries",
                             'popupHelp_setting_images_per_page'      => "How many images to show on each page in a gallery.",
                             'popupHelp_setting_moapath'              => "Path to Moa on the server. Must be absolute",
                             'popupHelp_setting_imagepath'            => "Path to images on server. Must be relative to the Moa path",
                             'popupHelp_setting_thumbpath'            => "Path to image thumbnails on server. Must be relative to the Moa path",
                             'popupHelp_setting_cookiepath'           => "Path to Moa on the website URL. Must be absolute",
                             'popupHelp_setting_cookiename'           => "Name of the stored cookie in the users web browser. Should be unique to your site",
                             'popupHelp_setting_incomingpath'         => "Path to put uploaded .zip files in on server. Must be relative to the Moa path",
                             'popupHelp_setting_dbhost'               => "Hostname or IP address of the MySQL server. Usually 'localhost'",
                             'popupHelp_setting_dbname'               => "Database name on the MySQL server",
                             'popupHelp_setting_dbuser'               => "Database username on the MySQL server",
                             'popupHelp_setting_dbpass'               => "Database password on the MySQL server",
                             'popupHelp_setting_tabprefix'            => "Table prefix on the MySQL server. Should be set if more than one thing is using the same database",
                             'popupHelp_admin_user_id'                => "Name of the user",
                             'popupHelp_admin_user_admin'             => "Should this user have rights to add more people?",
                             'popupHelp_admin_user_password1'         => "Users password",
                             'popupHelp_admin_user_password2'         => "Users password. Must be the same as the previous field",
                             'popupHelp_login_name'                   => "Username to log in as",
                             'popupHelp_login_pass'                   => "Password for the user",
                             'popupHelp_login_duration'               => "How long to stay logged in for",
                             'popupHelp_default'                      => 'No help field specified');
  }
  
  function TagParseFormPopupHelp($p_tag_options)
  {
    global $CFG;
    global $languageStrings;
    
    $output = '';

    $field = 'default';
    
    if (isset($p_tag_options['field']))
    {
    	$field = $p_tag_options['field'];
    }

    $field = 'popupHelp_'.$field;
    if (isset($languageStrings[$field]))
    {
      $output = $languageStrings[$field];
    } else
    {
      $output = $languageStrings['popupHelp_default'];
    }

    return $output;
  }


?>
