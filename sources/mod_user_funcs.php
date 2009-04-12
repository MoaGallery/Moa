<?php
  include_once($MOA_PATH."sources/_error_funcs.php");
  include_once($MOA_PATH."sources/_db_funcs.php");

  // Structure for a single user
  class User
  {
    var $m_id;
    var $m_name;
    var $m_admin;
    var $m_password;
    var $m_salt;
  };

  /*
    Checks on database that a user exists for the given id.
  */
  function _UserExists($p_id) {
    global $ErrorString;
    global $tab_prefix;

    $query = "SELECT 1 FROM ".$tab_prefix."users WHERE IDUser = ".mysql_real_escape_string($p_id);
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

    if ((false == $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    return true;
  };

  /*
    Returns the ID of a username.
  */
  function _UserLookup($p_name) {
    global $ErrorString;
    global $tab_prefix;

    $query = "SELECT IDUser FROM ".$tab_prefix."users WHERE Name = '".mysql_real_escape_string($p_name)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

    if ((false == $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    $row = mysql_fetch_array($result);
    return $row["IDUser"];
  };

  /*
    Changes the value of field named by $field to $value for user identified by $id.
  */
  function _UserChangeValue($p_id, $p_field, $p_value) {
    global $ErrorString;
    global $tab_prefix;

    $query = "UPDATE ".$tab_prefix."users SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDUser = ".mysql_real_escape_string($p_id);
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }
    return true;
  };

  /*
    Returns the value of field named by $field for user specified by $id.
  */
  function _UserGetValue($p_id, $p_field ) {
    global $ErrorString;
    global $tab_prefix;

    $query = "SELECT ".mysql_real_escape_string($p_field)." FROM ".$tab_prefix."users WHERE IDUser = ".mysql_real_escape_string($p_id);
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $row = mysql_fetch_array($result);
    return $row[$field];
  };

  /*
    Returns the values of all user fields for user specified by $id.
    DOES NOT RETURN PASSWORD OR SALT for security reasons.
  */
  function _UserGetAllValues($p_id) {
    global $ErrorString;
    global $tab_prefix;

    $query = "SELECT Name, Admin FROM ".$tab_prefix."users WHERE IDUser = ".mysql_real_escape_string($p_id);
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $row = mysql_fetch_array($result);

    $user = new User;
    $user->m_id          = $p_id;
    $user->m_name        = $row["Name"];
    $user->m_admin       = $row["Admin"];

    return $user;
  };

  /*
    Returns a list of users.
    DOES NOT RETURN PASSWORD OR SALT for security reasons.
   */
  function _UserGetUsers() {
    global $ErrorString;
    global $tab_prefix;

    $query = "SELECT IDUser, Name, Admin FROM ".$tab_prefix."users;";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    $users = array();

    while ($row = mysql_fetch_array($result)) {
      $user = new User;
      $user->m_id    = $row["IDUser"];
      $user->m_name  = $row["Name"];
      $user->m_admin = $row["Admin"];

      $users[] = $user;
    }

    return $users;
  }

  /*
    Deletes the user indentified by $id.
  */
  function _UserDelete($p_id) {
    global $ErrorString;
    global $tab_prefix;

    $query = "DELETE FROM ".$tab_prefix."users WHERE IDUser = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    return true;
  };

  /*
    Adds a user.
  */
  function _UserAdd($p_name, $p_admin, $p_pass) {
    global $ErrorString;
    global $tab_prefix;

    $admin_val = 0;
    if (0 == strcmp($p_admin, "true"))
    {
      $admin_val = 1;
    }

    $new_pass = mb_strtoupper(sha1($p_pass));

    $query = "INSERT INTO ".$tab_prefix."users (Name, Admin, Password, Salt) VALUES (_utf8'".mysql_real_escape_string($p_name)."', '".$admin_val."', '".$new_pass."', '000000');";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    return sprintf("%010s",mysql_insert_id());
  };

  /*
    Edits the user indentified by $id.
  */
  function _UserEdit($p_id, $p_name, $p_admin, $p_pass) {
    global $ErrorString;
    global $tab_prefix;

    $admin_val = 0;
    if (0 == strcmp($p_admin, "true"))
    {
    	$admin_val = 1;
    }

    $query = "UPDATE ".$tab_prefix."users SET Name=_utf8'".mysql_real_escape_string($p_name)."', Admin='".$admin_val."' WHERE IDUser = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false == $result) {
      return false;
    }

    if (0 < strlen($p_pass))
    {
    	$new_pass = mb_strtoupper(sha1($p_pass));

	    $query = "UPDATE ".$tab_prefix."users SET Password='".$new_pass."' WHERE IDUser = '".mysql_real_escape_string($p_id)."'";
	    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
	    if (false == $result) {
	      return false;
	    }

    }

    return true;
  };
?>
