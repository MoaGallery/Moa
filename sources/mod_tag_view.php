<?php
  include_once("config.php");
  include_once("mod_tag_funcs.php");
  include_once("mod_gallery_funcs.php");

  function TagAddLink()
  {
  	return "<a class='admin_link' onclick='tag_list.ShowAdd();'>[Add New Tag]</a>";
  }

  function ViewTagAddLink()
  {
    echo "\"".TagAddLink()."\"";
  }

  function ViewTagAddForm()
  {
    echo "\"<div id='tag_add'>\" +\n";
    echo "  \"<div class='tag_edit_box' id='tag_add_box'>\" +\n";
    echo "  \"<input id='tag_add_input' class='inline_element' type='text' name='tag_add_box'></input>\" +\n";
    echo "  \"</div>\" +\n";
    echo "  \"<div class='tag_button' id='tag_add_submit'>\" +\n";
    echo "  \"<button id='tag_add_submit_button' class='tag_buttons' onclick='tag_list.SubmitAdd(document.getElementById(\\\"tag_add_input\\\").value);' class='inline_element'>Add</button>\" +\n";
    echo "  \"<img src='media/trans-pixel.png' width='6' height='1' alt='' />\" +\n";
    echo "  \"</div>\" +\n";
    echo "  \"<div class='tag_button' id='tag_add_cancel'>\" +\n";
    echo "  \"<button id='tag_add_cancel_button' class='tag_buttons' onclick='tag_list.CancelAdd();' class='inline_element'>Cancel</button>\" +\n";
    echo "  \"</div>\" +\n";
    echo "  \"<br/>\" +\n";
    echo "  \"\"";
  }

  function TagBlock()
  {
    echo "<div id='tagblockfeedback'></div>\n";
    echo "<table border='0' style='width:500px; float: left;' class='area' cellspacing='0' cellpadding='5' id='tag_table'>\n";
    echo "<tr>\n";
    echo "<td class='box_header'>Tag Management</td>\n";
    echo "</tr>\n";
    echo "<tr class='pale_area_nb'>\n";
    echo "<td>\n";
    echo "<div id='tag_add_line'>".TagAddLink()."</div><br/>\n";
    echo "<div id='tag_lines'></div>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
  }

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