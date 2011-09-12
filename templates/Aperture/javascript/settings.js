function toggle_setting_block (p_id)
{
  var title = $('#' + p_id + '_widget');
  if (title.html() == "[-]")
  {
    title.html( '[+]');
    $('#' + p_id).hide(500);
  } else
  {
    var title = $('#' + p_id + '_widget');
    
    title.html( '[-]');
    var block = $('#' + p_id);
    block.show(500);
  }
}

// Upgrade general settings block
var title = $('#settings_general_title');
title.html( '<a href="#" class="settings_title_widget" id="settings_general_widget">[-]</a>' + title.html());
$('#settings_general_widget').click(function() {toggle_setting_block("settings_general");});

// Upgrade visual settings block
title = $('#settings_visual_title');
title.html( '<a href="#" class="settings_title_widget" id="settings_visual_widget">[-]</a>' + title.html());
$('#settings_visual_widget').click(function() {toggle_setting_block("settings_visual");});

// Upgrade server settings block
title = $('#settings_server_title');
title.html( '<a href="#" class="settings_title_widget" id="settings_server_widget">[-]</a>' + title.html());
$('#settings_server_widget').click(function() {toggle_setting_block("settings_server");});

// Upgrade db settings block
title = $('#settings_db_title');
title.html( '<a href="#" class="settings_title_widget" id="settings_db_widget">[-]</a>' + title.html());
$('#settings_db_widget').click(function() {toggle_setting_block("settings_db");});