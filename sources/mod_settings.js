var g_form_valid;
var g_default_background_color;

function submit_check ()
{
  g_form_valid = true;

  if (!FormCheck())
  {
    return false;
  }
  
  $('#settings_form').submit();
  return true;
}
