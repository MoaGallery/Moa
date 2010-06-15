var g_form_valid;
var g_default_background_color;

function check_empty (p_id)
{
  var title = document.getElementById("setting_"+p_id);
  if (trim(title.value) == "")
  {
    title.style.backgroundColor = "#ff8080";
    g_form_valid = false;
  } else
  {
    title.style.backgroundColor = g_default_background_color;
  }
}

function check_all()
{
  check_empty("TitleDescLength");
  check_empty("StrDelimiter");
  check_empty("ThumbWidth");
  check_empty("ConfigDisplayMaxWidth");
  check_empty("MoaPath");
  check_empty("ImagePath");
  check_empty("ThumbPath");
  check_empty("CookiePath");
  check_empty("CookieName");
  check_empty("IncomingPath");
  check_empty("DBHost");
  check_empty("DBName");
  check_empty("DBUser");
  check_empty("DBPass");
  check_empty("TabPrefix");
}

function submit_check ()
{
  g_form_valid = true;
  
  check_all();
  
  if (false == g_form_valid)
  {
    alert ("You didn't fill in a field");
    return false;
  }
  
  document.getElementById("settings_form").submit();
  return true;
}

// Upgrade input elements for verification
var input = document.getElementById("setting_EmptyDescPopupText");
g_default_background_color = input.style.backgroundColor;

addEvent(document.getElementById("setting_TitleDescLength"), "keyup", function (e) {check_empty("TitleDescLength");});
addEvent(document.getElementById("setting_StrDelimiter"), "keyup", function (e) {check_empty("StrDelimiter");});
addEvent(document.getElementById("setting_ThumbWidth"), "keyup", function (e) {check_empty("ThumbWidth");});
addEvent(document.getElementById("setting_ConfigDisplayMaxWidth"), "keyup", function (e) {check_empty("ConfigDisplayMaxWidth");});
addEvent(document.getElementById("setting_MoaPath"), "keyup", function (e) {check_empty("MoaPath");});
addEvent(document.getElementById("setting_ImagePath"), "keyup", function (e) {check_empty("ImagePath");});
addEvent(document.getElementById("setting_ThumbPath"), "keyup", function (e) {check_empty("ThumbPath");});
addEvent(document.getElementById("setting_CookiePath"), "keyup", function (e) {check_empty("CookiePath");});
addEvent(document.getElementById("setting_IncomingPath"), "keyup", function (e) {check_empty("IncomingPath");});
addEvent(document.getElementById("setting_CookieName"), "keyup", function (e) {check_empty("CookieName");});
addEvent(document.getElementById("setting_DBHost"), "keyup", function (e) {check_empty("DBHost");});
addEvent(document.getElementById("setting_DBName"), "keyup", function (e) {check_empty("DBName");});
addEvent(document.getElementById("setting_DBUser"), "keyup", function (e) {check_empty("DBUser");});
addEvent(document.getElementById("setting_DBPass"), "keyup", function (e) {check_empty("DBPass");});
addEvent(document.getElementById("setting_TabPrefix"), "keyup", function (e) {check_empty("TabPrefix");});

// Set them initially
check_all();

var btnclass = document.getElementById("settings_submit").className;
var btntext = document.getElementById("settings_submit").value;
var oldbtn = document.getElementById("settings_submit");
var container = document.getElementById("submit_container");

oldbtn.parentNode.removeChild(oldbtn);

var newbtn = document.createElement("button");
container.appendChild(newbtn);
newbtn.innerHTML = btntext;
newbtn.className = btnclass;
newbtn.id = "settings_submit";

addEvent(document.getElementById("settings_submit"), "click", function (e) {return(submit_check());});


