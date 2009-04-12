<?php
  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }

  if(!$INSTALLING)
  {
    include_once($MOA_PATH."sources/_db_funcs.php");
    include_once($MOA_PATH."config.php");
    include_once($MOA_PATH."sources/common.php");
  }

  $db = DBConnect();

  // Class - Holds information of user who is currently logged in.
  class LoginInfo
  {
    var $m_name;
    var $m_id;
    var $m_admin;
  };

  global $Userinfo;
  $Userinfo = new LoginInfo;

  $Userinfo->m_name  = null;
  $Userinfo->m_id    = null;
  $Userinfo->m_admin = false;

  if (isset($COOKIE_NAME) == true)
  {
    if (isset($_COOKIE[$COOKIE_NAME]))
  	{
  		$Cookie = $_COOKIE[$COOKIE_NAME];
  		$cookie_info = array();
  		$cookie_info = unserialize(stripslashes($Cookie));
  		$cookie_id = $cookie_info[0];
  		$Cookie_pw = $cookie_info[1];
  		$query = "SELECT * FROM ".$tab_prefix."users WHERE (IDUser = '".mysql_real_escape_string($cookie_id)."');";
  		$result = mysql_query($query);
  	  if ($user = mysql_fetch_array($result))
  	  {
  	    $pw = $user["Password"];
  	    $salt = $user["Salt"];
  	    $hash = sha1($pw.$salt);
  	    if (0 != strcmp($hash, $Cookie_pw))
  	    {
  	      $Userinfo->m_name = null;
          $Userinfo->m_id = null;
          $Userinfo->m_admin = false;
          $c = setcookie($COOKIE_NAME, null, time()-100000, $COOKIE_PATH, false, false, false);
          $_COOKIE[$COOKIE_NAME] = null;
  	    } else
  	    {
  	      $Userinfo->m_id = $user["IDUser"];
    	  	$Userinfo->m_name = $user["Name"];
    	  	$admin = $user["Admin"];
    	  	if (0 == strcmp($admin, "1"))
    	  	{
    	  	  $Userinfo->m_admin = true;
    	  	} else
    	  	{
    	  	  $Userinfo->m_admin = false;
    	  	}
    	  }
  	  }
  	}
  }

  function UserIsLoggedIn()
  {
    global $Userinfo;

    if (null == $Userinfo->m_id)
    {
    	return false;
    }
    return true;
  }

  function UserIsAdmin()
  {
  	global $Userinfo;

  	if (UserIsLoggedIn() && ( $Userinfo->m_admin))
  	{
  		return true;
  	}
    return false;
  }

  function UserID()
  {
    global $Userinfo;

    if (UserIsLoggedIn())
    {
      return $Userinfo->m_id;
    }
    return false;
  }

  function UserName()
  {
  	global $Userinfo;

    if (UserIsLoggedIn())
    {
      return $Userinfo->m_name;
    }
    return false;
  }
?>