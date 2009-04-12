<?php
  include_once("../config.php");
  include_once($MOA_PATH."sources/_error_funcs.php");
  include_once($MOA_PATH."sources/_db_funcs.php");
  include_once($MOA_PATH."sources/mod_user_funcs.php");
  include_once($MOA_PATH."sources/id.php");
  include_once($MOA_PATH."sources/common.php");

  function UserCheckExists()
  {
    // Get the ID
    $user_id = GetParam("user_id");
    if (false == $user_id)
    {
      RaiseFatalError("No user id supplied.");
      return false;
    }

    // Check that it is a real user
    if (false == _userExists($user_id))
    {
      RaiseFatalError($user_id." User does not exist.");
      return false;
    }

    return $user_id;
  }

  function UserChangeValue($p_id, $p_field, $p_varname)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Check they have admin rights and is not themself
    if ((!UserIsAdmin()))
    {
      if (UserID() != $p_id)
      {
        RaiseFatalError("You do not have user admin rights to edit other users.");
        return false;
      } else
      {
        if ((0 == strcmp("Admin", $p_field)) || (0 == strcmp("admin", $p_field)))
        {
          RaiseFatalError("You do not have user admin rights to promote yourself.");
          return false;
        }
      }
    }

    // Get the value
    $newvalue = GetParam($p_varname);
    if (false == $newvalue)
    {
      RaiseFatalError("No ".$p_varname." supplied.");
      return false;
    }

    // Try to change the value
    if (false == _UserChangeValue($p_id, $p_field, $newvalue))
    {
      RaiseFatalError("Could not set new ".$p_varname, false);
      return false;
    }

    OutputPrefix("OK");
    return true;
  }

  function UserGetValue($p_id, $p_field, $p_short = false)
  {
    $value = _UserGetValue($p_id, $p_field);

    if (false == $value)
    {
      RaiseFatalError("Could not get value for field '".$p_field."'", false);
      return false;
    }

    OutputPrefix("OK");
    if (($p_short) && (20 < mb_strlen($value)))
    {
      echo mb_substr($value, 0, 17)."...";
    } else
    {
      echo $value;
    }
    return true;
  }

  function UserDelete($p_id)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Check they have admin rights
    if (!UserIsAdmin())
    {
      RaiseFatalError("You do not have user admin rights to delete users.");
      return false;
    }

    // Try to delete the image
    if (false == _UserDelete($p_id))
    {
      RaiseFatalError("Could not delete user.", false);
      return false;
    }

    OutputPrefix("OK");
    echo $p_id;
    return true;
  }

  function UserAdd()
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Check they have admin rights
    if (!UserIsAdmin())
    {
      RaiseFatalError("You do not have user admin rights to add new users.");
      return false;
    }

    // Get the name
    $newname = GetParam("name");
    if (false == $newname)
    {
      RaiseFatalError("No name supplied.");
      return false;
    }

    // Check if tag name already exists
    $luid = _UserLookUp($newname);
    if (! ((is_bool($luid)) && (false == $luid)) )
    {
      RaiseFatalError("This username already exists.");
      return false;
    }

    // Get the admin flag
    $newadmin = GetParam("admin");
    if (false == $newadmin)
    {
      RaiseFatalError("No admin flag supplied.");
      return false;
    }

    // Get the password
    $newpass = GetParam("pass");
    if (is_bool($newpass))
    {
      RaiseFatalError("No password supplied.");
      return false;
    }

    // Try to add the user
    $id = _UserAdd($newname, $newadmin, $newpass);
    if (is_bool($id) && (false == $id))
    {
      RaiseFatalError("Could not add user.", false);
      return false;
    }

    OutputPrefix("OK");
    echo $id;
    return true;
  }

  function UserEdit($p_id)
  {
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      RaiseFatalError("Not logged in.");
      return false;
    }

    // Get the name
    $newname = GetParam("name");
    if (false == $newname)
    {
      RaiseFatalError("No name supplied.");
      return false;
    }

    // Check if user name already exists and isn't the user being editted
    $luid = _UserLookUp($newname);
    if ((! ((is_bool($luid)) && (false == $luid)) ) && ($luid != $p_id))
    {
      RaiseFatalError("This username already exists.");
      return false;
    }

    // Get the admin flag
    $newadmin = GetParam("admin");
    if (false == $newadmin)
    {
      RaiseFatalError("No admin flag supplied.");
      return false;
    }

    // Check they have admin rights and is not themself
    if ((!UserIsAdmin()))
    {
      if (UserID() != $p_id)
      {
        RaiseFatalError("You do not have user admin rights to edit other users.");
        return false;
      } else
      {
        if (0 == strcmp("true", $newadmin))
        {
          RaiseFatalError("You do not have user admin rights to promote yourself.");
          return false;
        }
      }
    }

    // Get the password
    $newpass = GetParam("pass");
    if (is_bool($newpass))
    {
      RaiseFatalError("No password supplied.");
      return false;
    }

    // Try to edit the user
    if (false == _UserEdit($p_id, $newname, $newadmin, $newpass))
    {
      RaiseFatalError("Could not edit user.", false);
      return false;
    }

    OutputPrefix("OK");
    echo $p_id;
    return true;
  }

  function UserAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false == $action)
    {
      RaiseFatalError("No action supplied.");
    }

    DBConnect();

    switch ($action)
    {
      case "add" :
      {
        UserAdd();
        break;
      }
      case "changedesc" :
      {
      	$user_id = UserCheckExists();
        if (false != $user_id)
        {
	        UserChangeValue($user_id, "Description", "desc");
        }
        break;
      }
      case "delete" :
      {
      	$user_id = UserCheckExists();
        if (false != $user_id)
        {
          UserDelete($user_id);
        }
        break;
      }
      case "edit" :
      {
        $user_id = UserCheckExists();
        if (false != $user_id)
        {
          UserEdit($user_id);
        }
        break;
      }
      case "getdesc" :
      {
      	$user_id = UserCheckExists();
        if (false != $user_id)
        {
          UserGetValue($user_id, "Description");
        }
        break;
      }
      default :
      {
        RaiseFatalError("Unknown action.");
        break;
      }
    }
  }

  // Only call this if we are running stand-alone (not included from index.php)
  if (false == isset($pre_cache))
  {
    UserAjaxMain();
  }
?>