<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  $install = false;
  if (isset($INSTALLING))
  {
    if ($INSTALLING)
    {
      $install = true;
    }
  }

  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");

  // Connects to MySQL database using global values defined in db_config.php setting character set to UTF8.
  function DBConnect()
  {
    global $install;
    if (!$install)
    {
      global $CFG;

      $db = @mysql_connect($CFG["db_host"], $CFG["db_user"], $CFG["db_pass"]) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__)   or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

      @mysql_select_db($CFG["db_name"], $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      @mysql_query("SET NAMES utf8;") or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      @mysql_query("SET CHARACTER SET utf8")  or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

      @mb_language('uni');
      @mb_internal_encoding('UTF-8');

      return $db;
    }
  }

  // Look through each statement in a file and execute it in MySQL
  function RunSQLFile($p_filename)
  {
  	global $CFG;

    $error = false;
    $file = fopen($p_filename, "r");
    $fstat = fstat($file);
    $SQLfile = fread($file, $fstat["size"]);
    fclose($file);

    $count = 0;
    $tok = strtok($SQLfile, ";");

    // Loop through each statement from the SQL file and execute it in turn
    while ($tok != false)
    {
      if (mb_strlen($tok) >= 10)
      {
        $sql_statement = str_replace( '<prefix>', $CFG["tab_prefix"], $tok);

        $result = mysql_query($sql_statement);
        if (false === $result)
        {
          echo mysql_error()."\n\n<br>";
          $error = true;
        }
        $count++;
      }
      $tok = strtok(";");
    }
    if ($error)
    {
      return false;
    } else
    {
      return $count;
    }
  }

  // Returns a string containing the last MySQL error formated with file of origin and line number.
  function DBMakeErrorString($p_file,$p_line) {
  	global $ErrorString;

  	$ErrorString = mysql_error()."<br/>\n in ".basename($p_file)." (Line: ".$p_line.")";
  }
?>
