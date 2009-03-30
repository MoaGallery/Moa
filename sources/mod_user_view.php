<?php
  include_once("config.php");
  include_once("mod_user_funcs.php");

  function ViewUserBlock()
  {
  	echo "<div id='userblockfeedback'></div>\n";
    echo "  <table border='0' style='width:500px;' class='area' cellspacing='0' cellpadding='5' id='user_table'>\n";
    echo "    <tr>\n";
    echo "      <td class='box_header' id='userblockheader'>\n";
    echo "        User management\n";
    echo "      </td>\n";
    echo "    </tr>\n";
    echo "    <tr class='pale_area_nb'>\n";
    echo "      <td>\n";
    echo "        <div id='userblock'>\n";
    echo "          <a class='admin_link' onclick='user_list.Add()'>[Add new user]</a><br/><br/>\n";
    echo "          <div id='user_lines'></div>\n";
    echo "        </td>\n";
    echo "      </div>\n";
    echo "    </tr>\n";
    echo "  </table>\n";
    echo "</div>\n";
  }

  function ViewUserForm()
  {
  	echo "\"<td class='pale_area_nb'>\" +\n";
    echo "  \" <form name='edit_form' method='post' action='admin_users.php?action=view'  enctype='multipart/form-data'>\" +\n";
    echo "  \"    <div class='form_label_text' style='width:120px; float:left;'>Name</div>\" +\n";
    echo "  \"      <input name='name' id='username' type='text' onKeyPress='' onKeyUp='' value=''></input>\" +\n";
    echo "  \"      <input name='id' id='userid' type='hidden'></input><br/>\" +\n";
    echo "  \"    <div class='form_label_text' style='width:120px; float:left;'>Admin</div>\" +\n";
    echo "  \"       <input name='admin' id='useradmin' type='checkbox' onKeyPress=''></input><br/>\" +\n";
    echo "  \"    <div class='form_label_text' style='width:120px; float:left;'>Password</div>\" +\n";
    echo "  \"        <input name='pass1' id='userpass1' type='password' onKeyPress='' value=''></input><br/>\" +\n";
    echo "  \"    <div class='form_label_text' style='width:120px; float:left;'>Confirm Password</div>\" +\n";
    echo "  \"        <input name='pass2' id='userpass2' type='password' onKeyPress='' value=''></input><br/><br/>\" +\n";
    echo "  \"    <input name='id' type='hidden' value=''></input>\" +\n";
    echo "  \"    <input name='mode' type='hidden' value=''></input>\" +\n";
    echo "  \"    <input type='button' id='formsubmit' value='Submit' onclick='user_list.FormSubmit();'>\" +\n";
    echo "  \"    <input type='button' id='formcancel' value='Cancel' onclick='user_list.FormCancel();'>\" +\n";
    echo "  \"  </form>\" +\n";
    echo "  \"</td>\"";
  }

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