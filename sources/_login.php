<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/common.php");

  function LoginFail()
  {
    echo "<html><head>\n";
    echo "  <meta http-equiv='Refresh' content='0; url=index.php?action=login&amp;invalid=true'>\n";
    echo "</head><body>\n";
    echo "</body></html>\n";
    die();
  }

  if (isset($_POST["duration"]))
  {
    $loginDuration = $_REQUEST["duration"];
    $loginName = $_REQUEST["name"];
    $loginPassword = $_REQUEST["password"];

    $query = "SELECT * FROM `".$CFG["tab_prefix"]."users` WHERE (Name = '".mysql_real_escape_string($loginName)."');";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    $userRecord = mysql_fetch_array($result);
    if ($userRecord == false)
    {
      LoginFail();
    } else
    {
      $encryptedPassword = mb_strtoupper(sha1($loginPassword));
      if (strcmp($encryptedPassword, $userRecord["Password"]) == 0)
      {
        //COOKIE!...
        switch ($loginDuration)
        {
          case $loginDuration == "mins30" : $loginTimeout = 60*30; break;
          case $loginDuration == "mins60" : $loginTimeout = 60*60; break;
          case $loginDuration == "mins120" : $loginTimeout = 60*60*2; break;
          case $loginDuration == "forever" : $loginTimeout = 60*60*24*100; break;
          default : $loginTimeout = 0; break;
        }
        $seed = md5(rand(0, 0x0fffffff));
        $salt = mb_substr($seed, 0, 8);
        $query = "UPDATE `".$CFG["tab_prefix"]."users` SET Salt = '".$salt."' WHERE IDUser = '".$userRecord["IDUser"]."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        $cookiePassword = sha1($encryptedPassword.$salt);
        $cookieData = serialize(array($userRecord["IDUser"], $cookiePassword));
        $cookie = setcookie($CFG["COOKIE_NAME"],
                            $cookieData,
                            time() + $loginTimeout,
                            $CFG["COOKIE_PATH"],
                            false,
                            false,
                            false);
        $_COOKIE[$CFG["COOKIE_NAME"]] = $cookieData;
      } else
      {
        LoginFail();
      }
    }
  }
?>
