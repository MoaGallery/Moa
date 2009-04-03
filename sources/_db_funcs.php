<?php
  $install = false;
  if (isset($INSTALLING))
  {
    if ($INSTALLING)
    {
      $install = true;
    }
  }
  
  if (!$install)
  {
    if (file_exists("private/db_config.php"))
    {
      include_once("private/db_config.php");
    }
    else
    {
      include_once("../private/db_config.php");
    }
  }
  
  include_once("_error_funcs.php");
  
  // Connects to MySQL database using global values defined in config.php setting character set to UTF8.
  function DBConnect() 
  {
    global $install;
    if (!$install)
    {
      global $db_host;
      global $db_user;
      global $db_pass;
      global $db_name;
      
      $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
      mysql_query("SET NAMES utf8;") or moa_db_error(mysql_error());
      mysql_query("SET CHARACTER SET utf8")  or moa_db_error(mysql_error());
      
      mb_language('uni');
      mb_internal_encoding('UTF-8');

      return $db;
    }
  }

  // Look through each statement in a file and execute it in MySQL
  function RunSQLFile($p_filename)
  {
  	global $tab_prefix;
  	
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
        $sql_statement = str_replace( '<prefix>', $tab_prefix, $tok);
        
        $result = mysql_query($sql_statement);
        if (false == $result)
        {
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