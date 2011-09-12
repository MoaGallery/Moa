<?php
  header('Cache-Control: no-cache');

  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once("_settings.php");
  LoadSettings();

  include_once($CFG["MOA_PATH"]."sources/mod_user_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/id.php");
  include_once($CFG["MOA_PATH"]."sources/common.php");

  function UserCheckExists()
  {
    $returnInfo = DefaultAjaxResult( 'UserExists');
    
    // Get the ID
    $user_id = GetParam("user_id");
    if (false === $user_id)
    {
      $returnInfo['Result'] = 'No user id supplied.';
      echo json_encode($returnInfo);
      return false;
    }

    // Check that it is a real user
    if (false === User::Exists($user_id))
    {
      $returnInfo['Result'] = 'User does not exist.';
      echo json_encode($returnInfo);
      return false;
    }

    return $user_id;
  }

  function UserDelete($p_id)
  {
    $returnInfo = DefaultAjaxResult( 'UserDelete');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Check they have admin rights
    if (!UserIsAdmin())
    {
      $returnInfo['Result'] = 'You do not have user admin rights to delete users.';
      return $returnInfo;
    }

    // Try to delete the image
    if (false === User::Delete($p_id))
    {
      $returnInfo['Result'] = 'Could not delete user.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function UserAdd()
  {
    $returnInfo = DefaultAjaxResult( 'UserAdd');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Check they have admin rights
    if (!UserIsAdmin())
    {
      $returnInfo['Result'] = 'You do not have user admin rights to add new users.';
      return $returnInfo;
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      $returnInfo['Result'] = 'No name supplied.';
      return $returnInfo;
    }

    // Check if tag name already exists
    $luid = User::LookUp($newname);
    if (false !== $luid)
    {
      $returnInfo['Result'] = 'This username already exists.';
      return $returnInfo;
    }

    // Get the fake id
    $fake_id = GetParam("fake_id");
    if (false === $fake_id)
    {
      $returnInfo['Result'] = 'No fake id supplied.';
      return $returnInfo;
    }
    
  // Get the admin flag
    $admin = GetParam("admin");
    if (false === $admin)
    {
      $returnInfo['Result'] = 'No admin flag supplied.';
      return $returnInfo;
    }
    $newadmin = false;
    if (0 == strcmp($admin, 'true'))
    {
      $newadmin = true;
    }

    // Get the password
    $newpass = GetParam("pass");
    if (false === $newpass)
    {
      $returnInfo['Result'] = 'No password supplied.';
      return $returnInfo;
    }

    // Check the password isn't blank
    if (0 == strcmp($newpass, ""))
    {
      $returnInfo['Result'] = 'Password is blank.';
      return $returnInfo;
    }

    // Try to add the user
    $user = new User();
    $user->name = $newname;
    $user->admin = $newadmin;
    $id = $user->Commit($newpass);
    if (false === $id)
    {
      $returnInfo['Result'] = 'Could not add user.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    $returnInfo['UserID'] = (int)$id;
    $returnInfo['fake_id'] = $fake_id;
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function UserEdit($p_id)
  {
    $returnInfo = DefaultAjaxResult( 'UserEdit');
    
    // Only proceed if a user is logged in
    if (!UserIsLoggedIn())
    {
      $returnInfo['Result'] = 'Not logged in.';
      return $returnInfo;
    }

    // Get the name
    $newname = GetParam("name");
    if (false === $newname)
    {
      $returnInfo['Result'] = 'No name supplied.';
      return $returnInfo;
    }

    // Check if user name already exists and isn't the user being editted
    $luid = User::LookUp($newname);
    if ((false !== $luid) && ($luid != $p_id))
    {
      $returnInfo['Result'] = 'This username already exists.';
      return $returnInfo;
    }

    // Get the admin flag
    $admin = GetParam("admin");
    if (false === $admin)
    {
      $returnInfo['Result'] = 'No admin flag supplied.';
      return $returnInfo;
    }
    $newadmin = false;
    if (0 == strcmp($admin, 'true'))
    {
      $newadmin = true;
    }

    // Check they have admin rights and is not themself
    if ((!UserIsAdmin()))
    {
      if (UserID() != $p_id)
      {
        $returnInfo['Result'] = 'You do not have user admin rights to edit other users.';
        return $returnInfo;
      } else
      {
        if (0 == strcmp("true", $newadmin))
        {
          $returnInfo['Result'] = 'You do not have user admin rights to promote yourself.';
          return $returnInfo;
        }
      }
    }

    // Get the password
    $newpass = GetParam("pass");
    if (false === $newpass)
    {
      $returnInfo['Result'] = 'No password supplied.';
      return $returnInfo;
    }

    // Try to edit the user
    $user = new User($p_id);
    $user->name = $newname;
    $user->admin = $newadmin;
    if (false === $user->Commit($newpass))
    {
      $returnInfo['Result'] = 'Could not edit user.';
      return $returnInfo;
    }

    $returnInfo['Status'] = 'SUCCESS';
    unset($returnInfo['Result']);

    return $returnInfo;
  }

  function UserAjaxMain()
  {
    // Get the action
    $action = GetParam("action");
    if (false === $action)
    {
      $returnInfo = DefaultAjaxResult( 'ActionCheck');
	    $returnInfo['Result'] = 'No action supplied.';
	    echo json_encode($returnInfo);
    }

    DBConnect();

    switch ($action)
    {
      case "add" :
      {
        echo json_encode(UserAdd());
        break;
      }
      case "delete" :
      {
      	$user_id = UserCheckExists();
        if (false !== $user_id)
        {
          echo json_encode(UserDelete($user_id));
        }
        break;
      }
      case "edit" :
      {
        $user_id = UserCheckExists();
        if (false !== $user_id)
        {
          echo json_encode(UserEdit($user_id));
        }
        break;
      }
      default :
      {
        $returnInfo = DefaultAjaxResult( 'Unknown');
        $returnInfo['Result'] = 'Unknown action.';
        echo  json_encode($returnInfo);
        break;
      }
    }
  }

  // Only call this if we are running stand-alone (not included from index.php)
  if (false === isset($preCache))
  {
    UserAjaxMain();
  }
?>