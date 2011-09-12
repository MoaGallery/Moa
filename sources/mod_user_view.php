<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_user_funcs.php");

  function ViewAllUserList()
  {
  	global $CFG;
    global $bodycontent;

  	$users = User::GetUsers();

    foreach ($users as $user)
    {
      $bodycontent .= $user->id."=".$user->admin."=".str_display_safe($user->name.$CFG["STR_DELIMITER"]);
    }
  }
?>