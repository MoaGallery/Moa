<?php
  if (false == isset($INSTALLING)) {
    $INSTALLING = false;
  }
  
  if(!$INSTALLING)
  {
    if (file_exists("private/db_config.php"))
    {
      include_once("private/db_config.php");
    } else
    {
      include_once("../private/db_config.php");
    }
    
    if (file_exists("config.php"))
    {
      include_once("config.php");
    } else
    {
      include_once("../config.php");
    }
  }

  $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

  class LoginInfo
  {
    var $Name;
    var $ID;
    var $UserAdmin;
  };
  
  global $Userinfo;
  $Userinfo = new LoginInfo;
  
  $Userinfo->Name = NULL;
  $Userinfo->ID = NULL;
  $Userinfo->UserAdmin = false;
  
  if (isset($COOKIE_NAME) == true)
  {
    if (isset($_COOKIE[$COOKIE_NAME]))
  	{
  		$Cookie = $_COOKIE[$COOKIE_NAME];
  		$cookie_info = array();
  		$cookie_info = unserialize(stripslashes($Cookie));
  		$Cookie_ID = $cookie_info[0];
  		$Cookie_pw = $cookie_info[1];
  		$query = "SELECT * FROM ".$tab_prefix."users WHERE (IDUser = '".mysql_real_escape_string(strip_tags($Cookie_ID))."');";
  		$result = mysql_query($query);
  	  if ($user = mysql_fetch_array($result))
  	  {
  	    $pw = $user["Password"];
  	    $salt = $user["Salt"];
  	    $hash = sha1($pw.$salt);
  	    if (0 != strcmp($hash, $Cookie_pw))
  	    {
  	      $Userinfo->Name = NULL;
          $Userinfo->ID = NULL;
          $Userinfo->UserAdmin = false;
          $c = setcookie($COOKIE_NAME, NULL, time()-100000, $COOKIE_PATH, false, false, false);
          $_COOKIE[$COOKIE_NAME] = NULL;
  	    } else
  	    {
  	      $Userinfo->ID = mysql_real_escape_string(strip_tags($user["IDUser"]));
    	  	$Userinfo->Name = mysql_real_escape_string(strip_tags($user["Name"]));
    	  	$admin = mysql_real_escape_string(strip_tags($user["Admin"]));
    	  	if (0 == strcmp($admin, "1"))
    	  	{
    	  	  $Userinfo->UserAdmin = true;
    	  	} else
    	  	{
    	  	  $Userinfo->UserAdmin = false;
    	  	}
    	  }
  	  }
  	}
  }
?>