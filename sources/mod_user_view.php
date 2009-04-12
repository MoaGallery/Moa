<?php
  include_once("config.php");
  include_once($MOA_PATH."sources/mod_user_funcs.php");

  function ViewAllUserList()
  {
  	global $STR_DELIMITER;

  	$users = _UserGetUsers();

    foreach ($users as $user)
    {
      echo $user->m_id."=".$user->m_admin."=".str_display_safe($user->m_name.$STR_DELIMITER);
    }
  }
?>