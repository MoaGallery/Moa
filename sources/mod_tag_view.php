<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."config.php");
  include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_gallery_funcs.php");

  function ViewAllTagList()
  {
  	global $CFG;
    global $bodycontent;

    $Tag = new Tag();
  	$tags = $Tag->getTags();

    foreach ($tags as $tag)
    {
      $bodycontent .= $tag->m_id."=".js_var_display_safe($tag->m_name.$CFG["STR_DELIMITER"]);
    }
  }

  function ViewGalleryCurrentTagList($p_id)
  {
  	global $CFG;
    global $bodycontent;

    $Gallery = new Gallery();
    $tags = $Gallery->getTagObjectArray($p_id);

    foreach ($tags as $tag)
    {
      $bodycontent .= str_display_safe($tag.$CFG["STR_DELIMITER"]);
    }
  }

  function ViewImageCurrentTagList($p_id)
  {
    global $CFG;
    global $bodycontent;

    $Image = new Image();
    $Image->loadId($p_id);
    $tags = $Image->getTagObjectArray();

    foreach ($tags as $tag)
    {
      $bodycontent .= js_var_display_safe($tag.$CFG["STR_DELIMITER"]);
    }
  }
?>