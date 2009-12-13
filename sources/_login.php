<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/common.php");

  function BogOff()
  {
    echo "<html><head>\n";
    echo "  <meta http-equiv='Refresh' content='0; url=index.php?action=login&amp;invalid=true'>\n";
    echo "</head><body>\n";
    echo "</body></html>\n";
    die();
  }

  if (isset($_POST["duration"]))
  {
    $login_duration = $_REQUEST["duration"];
    $login_name = $_REQUEST["name"];
    $login_password = $_REQUEST["password"];

    $query = "SELECT * FROM `".$CFG["tab_prefix"]."users` WHERE (Name = '".mysql_real_escape_string($login_name)."');";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    $user = mysql_fetch_array($result);
    if ($user == false)
    {
      BogOff();
    } else
    {
      $login_enc_password = mb_strtoupper(sha1($login_password));
      if (strcmp($login_enc_password, $user["Password"]) == 0)
      {
        //COOKIE!...
        switch ($login_duration)
        {
          case $login_duration == "mins30" : $timeout = 60*30; break;
          case $login_duration == "mins60" : $timeout = 60*60; break;
          case $login_duration == "mins120" : $timeout = 60*60*2; break;
          case $login_duration == "forever" : $timeout = 60*60*24*100; break;
          default : $timeout = 0; break;
        }
        $rand = md5(rand(0, 0x0fffffff));
        $salt = mb_substr($rand, 0, 8);
        $query = "UPDATE `".$CFG["tab_prefix"]."users` SET Salt = '".$salt."' WHERE IDUser = '".$user["IDUser"]."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        $cookie_pw = sha1($login_enc_password.$salt);
        $cookie_data = serialize(array($user["IDUser"], $cookie_pw));
        $c = setcookie($CFG["COOKIE_NAME"], $cookie_data, time()+$timeout, $CFG["COOKIE_PATH"], false, false, false);
        $_COOKIE[$CFG["COOKIE_NAME"]] = $cookie_data;
      } else
      {
        BogOff();
      }
    }
  }
?>
