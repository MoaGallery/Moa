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
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  
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
      $result = mysql_query($query) or die(mysql_error());
      $user = mysql_fetch_array($result);
      if ($user == false)
      {
        BogOff();
      } else
      {
        $query = "SELECT PASSWORD('".mysql_real_escape_string(strip_tags($login_password))."');";
        $result = mysql_query($query) or die(mysql_error());
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
          $c = setcookie($COOKIE_NAME, $user["IDUser"], time()+$timeout, $COOKIE_PATH, false, false, false);
          $_COOKIE[$COOKIE_NAME] = $user["IDUser"];
          //print_r($c);
        } else
        {
          BogOff();
        }
      }
    }
}
?>