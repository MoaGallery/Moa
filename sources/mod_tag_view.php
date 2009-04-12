<?php
  include_once($MOA_PATH."config.php");
  include_once($MOA_PATH."sources/mod_tag_funcs.php");
  include_once($MOA_PATH."sources/mod_gallery_funcs.php");

  function ViewAllTagList()
  {
  	global $STR_DELIMITER;

  	$tags = _TagGetTags();

    foreach ($tags as $tag)
    {
      echo $tag->m_id."=".js_var_display_safe($tag->m_name.$STR_DELIMITER);
    }
  }

  function ViewGalleryCurrentTagList($p_id)
  {
  	global $STR_DELIMITER;

    $tags = _galleryGetTagList($p_id);

    foreach ($tags as $tag)
    {
      echo str_display_safe($tag.$STR_DELIMITER);
    }
  }

  function ViewImageCurrentTagList($p_id)
  {
    global $STR_DELIMITER;

    $tags = _ImageGetTagList($p_id);

    foreach ($tags as $tag)
    {
      echo js_var_display_safe($tag.$STR_DELIMITER);
    }
  }
?>