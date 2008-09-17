<?php
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
  
  if (isset($_COOKIE[$COOKIE_NAME]))
	{
		$Cookie_ID = $_COOKIE[$COOKIE_NAME];
		$query = "SELECT * FROM ".$tab_prefix."users WHERE (IDUser = '".mysql_real_escape_string(strip_tags($Cookie_ID))."');";
		$result = mysql_query($query);
	  if ($user = mysql_fetch_array($result))
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
?>