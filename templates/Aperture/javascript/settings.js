function toggle_setting_block (p_id)
{
  var title = document.getElementById(p_id+"_widget");
  if (title.innerHTML == "[-]")
  {
    title.innerHTML = "[+]";
    var block = document.getElementById(p_id);
    block.style.display = "none";
  } else
  {
    var title = document.getElementById(p_id+"_widget");
    title.innerHTML = "[-]";
    var block = document.getElementById(p_id);
    block.style.display = "block";
  }
}

// Upgrade general settings block
var title = document.getElementById("settings_general_title");
title.innerHTML = '<a href="#" class="settings_title_widget" id="settings_general_widget">[-]</a>' + title.innerHTML;
addEvent(document.getElementById("settings_general_widget"), "click", function (e) {toggle_setting_block("settings_general");});

// Upgrade visual settings block
title = document.getElementById("settings_visual_title");
title.innerHTML = '<a href="#" class="settings_title_widget" id="settings_visual_widget">[-]</a>' + title.innerHTML;
addEvent(document.getElementById("settings_visual_widget"), "click", function (e) {toggle_setting_block("settings_visual");});

// Upgrade server settings block
title = document.getElementById("settings_server_title");
title.innerHTML = '<a href="#" class="settings_title_widget" id="settings_server_widget">[-]</a>' + title.innerHTML;
addEvent(document.getElementById("settings_server_widget"), "click", function (e) {toggle_setting_block("settings_server");});

// Upgrade db settings block
title = document.getElementById("settings_db_title");
title.innerHTML = '<a href="#" class="settings_title_widget" id="settings_db_widget">[-]</a>' + title.innerHTML;
addEvent(document.getElementById("settings_db_widget"), "click", function (e) {toggle_setting_block("settings_db");});