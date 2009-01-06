<?php
  include_once("config.php");
  
  function BogOff()
  {
    echo "<html><head>\n";
    echo "  <meta http-equiv='Refresh' content='0; url=login.php'>\n";
    echo "</head><body>\n";
    echo "</body></html>\n";
    die();
    return;
  }

  include_once("private/db_config.php");
  $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  
  if (isset($_REQUEST["logout"]))
  {
    $c = setcookie($COOKIE_NAME, NULL, time()-100000, $COOKIE_PATH, false, false, false);
    $_COOKIE[$COOKIE_NAME] = NULL;
  } else
  {
    if (isset($_POST["duration"]))
    {
      $login_duration = $_POST["duration"];
      $login_name = $_POST["name"];
      $login_password = $_POST["password"];
      
      $query = "SELECT * FROM ".$tab_prefix."users WHERE (Name = '".mysql_real_escape_string(strip_tags($login_name))."');";
      $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      $user = mysql_fetch_array($result);
      if ($user == false)
      {
        BogOff();
      } else
      {
        $query = "SELECT PASSWORD('".mysql_real_escape_string(strip_tags($login_password))."');";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        $enc = mysql_fetch_array($result);
        $login_enc_password = $enc[0];
        if (strcmp($login_enc_password, $user["Password"]) == 0)
        {
          //COOKIE
          switch ($_POST["duration"])
          {
            case $_POST["duration"] == "mins30" : $timeout = 60*30; break;
            case $_POST["duration"] == "mins60" : $timeout = 60*60; break;
            case $_POST["duration"] == "mins120" : $timeout = 60*60*2; break;
            case $_POST["duration"] == "forever" : $timeout = 60*60*24*100; break;
          }
          $rand = md5(rand(0, 0x0fffffff));
          $salt = substr($rand, 0, 8);
          $query = "UPDATE ".$tab_prefix."users SET Salt = '".$salt."' WHERE IDUser = '".$user["IDUser"]."'";
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
          $cookie_pw = sha1($login_enc_password.$salt);
          $cookie_data = serialize(array($user["IDUser"], $cookie_pw));
          $c = setcookie($COOKIE_NAME, $cookie_data, time()+$timeout, $COOKIE_PATH, false, false, false);
          $_COOKIE[$COOKIE_NAME] = $cookie_data;
          //print_r($c);
        } else
        {
          BogOff();
        }
      }
    }
}
?>