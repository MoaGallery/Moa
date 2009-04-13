<?php
  $APACHE_MIN_VERSION = ARRAY( 2, 0, 0);
  $PHP_MIN_VERSION    = ARRAY( 5, 2, 0);
  $GD_MIN_VERSION     = ARRAY( 2, 0, 0);
  $MYSQL_MIN_VERSION  = ARRAY( 5, 0, 0);

  session_start();
  session_unset();
  session_destroy();

  function get_apache_version() {
	  $apache_info = @apache_get_version();

	  $next   = false;
	  $found  = false;
	  $result = "";

	  $version = array();

	  $tok = strtok( $apache_info, "/ ");

	  while (false != $tok) {
	    if (($next == true) && ($found == false)) {
	    	$result = $tok;
	    	$found = true;
	    	$next = false;
	    }
	    if (0 == strcasecmp($tok, "Apache")) {
	      $next = true;
	    }

	    $tok = strtok( "/ ");
	  }

    if (false == $found) {
    	return false;
    }

		$tok = strtok( $result, ".");
		$version[0] = (int)$tok;

		$tok = strtok( ".");
		$version[1] = (int)$tok;

		$tok = strtok( ".");
		$version[2] = (int)$tok;

	  return $version;
	}

	function get_gd_version() {
	  $gd_info = @gd_info();
	  $gd_version = $gd_info["GD Version"];

	  $found  = false;
	  $result = "";

	  $version = array();

	  $tok = strtok( $gd_version, "() ");

	  while (false != $tok) {
	    if (false == $found) {
		    $first = strpos( $tok, ".");
		    if (false != $first)
		    {
		    	$second = strpos( $tok, ".", $first + 1);

		    	if (false != $second)
		    	{
	  	    	$result = $tok;
		    	  $found = true;
		      }
		    }
      }

	    $tok = strtok( "() ");
	  }

    if (false == $found) {
    	return false;
    }

		$tok = strtok( $result, ".");
		$version[0] = (int)$tok;

		$tok = strtok( ".");
		$version[1] = (int)$tok;

		$tok = strtok( ".");
		$version[2] = (int)$tok;

	  return $version;
	}

	function get_php_version() {
	  $php_version = @phpversion();

		$tok = strtok( $php_version, ".");
		$version[0] = (int)$tok;

		$tok = strtok( ".");
		$version[1] = (int)$tok;

		$tok = strtok( ".");
		$version[2] = (int)$tok;

	  return $version;
	}

	function get_mysql_version() {
	  $mysql_version = @mysql_get_server_info();

		$tok = strtok( $mysql_version, ".");
		$version[0] = (int)$tok;

		$tok = strtok( ".");
		$version[1] = (int)$tok;

		$tok = strtok( ".");
		$version[2] = (int)$tok;

	  return $version;
	}

  function ShowProgressStart($p_stage, $p_processing)
  {
  	// Set up stages
    $stages1 = array();
    $stages1[-1] = "Welcome";
    $stages1[0] = "Check environment";
    $stages1[1] = "Get server info";
    $stages1[2] = "Create Moa user";
    $stages1[3] = "Finish";

    $stages2 = array();
    $stages2[-1] = "Welcome";
    $stages2[0] = "Checking environment";
    $stages2[1] = "Initialise server config";
    $stages2[2] = "Setting up server";
    $stages2[3] = "Finished";

    // Draw progress box
    echo "<table class='normal_text' style='width:100%;'><tr><td valign='top' style='width:250px;'>\n";

    echo "<table class='area' width='250' cellspacing='0' cellpadding='5'>\n";
      echo "<tr>\n";
        echo "<td class='box_header'>\n";
          echo "Progress\n";
        echo "</td>\n";
      echo "</tr>\n";
      echo "<tr>\n";
        echo "<td align='left' class='pale_area_nb'>\n";
          echo"<img src='media/trans-pixel.png' width='250' height='1' alt=''/>";
          echo "<br/>\n";
          // For each line in the box
          for ($loop = -1; $loop < count($stages1) - 1; $loop++)
          {
            if ($loop < $p_stage)
            {
              echo "<img src='media/progress-blank.png' alt=''/> <span style='color: grey'>".$stages2[$loop]." - Done<br/></span>\n";
            }
            if ($loop == $p_stage)
            {
              if (!$p_processing)
              {
                echo "<img src='media/progress-arrow.png' width='21' height='10'  alt=''/> ".$stages1[$loop]."<br/>\n";
              } else
              {
                echo "<img src='media/progress-arrow.png' width='21' height='10' alt=''/> ".$stages2[$loop]."<br/>\n";
              }
            }
            if ($loop > $p_stage)
            {
              echo "<img src='media/progress-blank.png' alt=''/> ".$stages1[$loop]."<br/>\n";
            }
            echo"<img src='media/trans-pixel.png' height='15' width='1' alt=''/>";
          }
        echo "</td>\n";
      echo "</tr>\n";
    echo "</table>\n";

    echo "</td>\n";

    echo "<td>\n";
    echo"<img src='media/trans-pixel.png' width='10' height='1' alt=''/>\n";
    echo "</td>\n";

    echo "<td valign='top'>\n";
  }

  function ShowProgressEnd()
  {
    echo "</td>\n";
    echo "<td>\n";
    echo"<img src='media/trans-pixel.png' width='10' height='1' alt=''/>\n";
    echo "</td>\n";
    echo "</tr>\n";
    echo "</table>\n";
  }

  // Stage 0 = Welcome message
  function Stage0()
  {
    ShowProgressStart(-1, true);
    echo "<div style='width:200px; margin-left:auto; margin-right:auto; font-size:30px;'><b>Moa install</b></div><br/>\n";

    echo "<br/><br/>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<form id='install_1b' method='post' action='install.php?stage=stage1b' enctype='multipart/form-data'>\n";
    echo "<p><input type='submit' value='Start install -->'></input></p>\n";
    echo "</form>\n";
    echo "</td></tr></table>\n";

   ShowProgressEnd();
  }

  // Stage 1B = Version checks
  function Stage1B()
  {
  	global $APACHE_MIN_VERSION;
  	global $PHP_MIN_VERSION;
  	global $GD_MIN_VERSION;

    $check = false;
    ShowProgressStart(0, true);
    echo "<b><div style='width:200px; margin-left:auto; margin-right:auto; font-size:30px;'>Moa install</div></b><br/>\n";
    echo "<span style='font-size:20px;'>Checking server environment to see if Moa will work...</span></b><br/><br/>\n";

    // Check the Apache version
    echo "Checking for Apache version ".$APACHE_MIN_VERSION[0]." or later - ";
    $apache_version = false;
    if (function_exists("apache_get_version"))
    {
      $apache_version = get_apache_version();
    }

    if (false == $apache_version)
    {
      echo "<span style='color: red'>Failed (Cannot determine version)</span><br/>\n";
    	echo "<span style='color: red'>Installation will continue.  Please check Apache version manually.</span><br/>\n";
    } else
    {
	  	$passed = false;

	  	// Major version
	  	if ($apache_version[0] > $APACHE_MIN_VERSION[0])
	  	{
	  	   $passed = true;
	  	} else
	  	{ if ($apache_version[0] == $APACHE_MIN_VERSION[0])
	  		{
	  			// Now check minor version
	  			if ($apache_version[1] > $APACHE_MIN_VERSION[1])
	  			{
	  			  $passed = true;
	  			} else
	  			{ if ($apache_version[1] == $APACHE_MIN_VERSION[1])
	  				{
	  			    // Now check revision version
	  			    if ($apache_version[2] >= $APACHE_MIN_VERSION[2])
	  			    {
	  			      $passed = true;
	  			    }
	  				}
	  			}
	  		}
	  	}

	  	if (false == $passed)
    	{
    	  echo "<span style='color: red'>Failed (".$apache_version[0].".".$apache_version[1].".".$apache_version[2].")</span><br/>\n";
        $check = true;
      } else
      {
      	echo "<span style='color: green'>Success (".$apache_version[0].".".$apache_version[1].".".$apache_version[2].")</span><br/>\n";
      }
    }

    // Check the PHP version
    echo "Checking for PHP version ".$PHP_MIN_VERSION[0].".".$PHP_MIN_VERSION[1].".".$PHP_MIN_VERSION[2]." or later - ";
    $php_version = get_php_version();

  	$passed = false;

  	// Major version
  	if ($php_version[0] > $PHP_MIN_VERSION[0])
  	{
  	   $passed = true;
  	} else
  	{ if ($php_version[0] == $PHP_MIN_VERSION[0])
  		{
  			// Now check minor version
  			if ($php_version[1] > $PHP_MIN_VERSION[1])
  			{
  			  $passed = true;
  			} else
  			{ if ($php_version[1] == $PHP_MIN_VERSION[1])
  				{
  			    // Now check revision version
  			    if ($php_version[2] >= $PHP_MIN_VERSION[2])
  			    {
  			      $passed = true;
  			    }
  				}
  			}
  		}
  	}

  	if (false == $passed)
  	{
   	  echo "<span style='color: red'>Failed (".$php_version[0].".".$php_version[1].".".$php_version[2].")</span><br/>\n";
      $check = true;
    } else
    {
    	echo "<span style='color: green'>Success (".$php_version[0].".".$php_version[1].".".$php_version[2].")</span><br/>\n";
    }

    // Check for GD
    echo "Checking for GD extension to PHP - ";
    $gd_present = function_exists('imagecreatefromjpeg');

    if ($gd_present)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed</span><br/>\n";
      $check = true;
    }

    // Only check the GD version of GD is present
    if ($gd_present) {
	    // Check the GD version
	    echo "Checking for version ".$GD_MIN_VERSION[0]." of GD extension or later - ";
	    $gd_version = get_gd_version();

	  	$passed = false;

	  	// Major version
	  	if ($gd_version[0] > $GD_MIN_VERSION[0])
	  	{
	  	   $passed = true;
	  	} else
	  	{ if ($gd_version[0] == $GD_MIN_VERSION[0])
	  		{
	  			// Now check minor version
	  			if ($gd_version[1] > $GD_MIN_VERSION[1])
	  			{
	  			  $passed = true;
	  			} else
	  			{ if ($gd_version[1] == $GD_MIN_VERSION[1])
	  				{
	  			    // Now check revision version
	  			    if ($gd_version[2] >= $GD_MIN_VERSION[2])
	  			    {
	  			      $passed = true;
	  			    }
	  				}
	  			}
	  		}
	  	}

	  	if (false == $passed)
	  	{
	   	  echo "<span style='color: red'>Failed (".$gd_version[0].".".$gd_version[1].".".$gd_version[2].")</span><br/>\n";
	      $check = true;
	    } else
	    {
	    	echo "<span style='color: green'>Success (".$gd_version[0].".".$gd_version[1].".".$gd_version[2].")</span><br/>\n";
	    }
    }

    // Check for MySQL
    echo "Checking for MySQL extension to PHP - ";
    if (function_exists('mysql_query'))
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed</span><br/>\n";
      $check = true;
    }

    // Check for mbstring
    echo "Checking for mbstring extension to PHP - ";
    if (function_exists('mb_strpos'))
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed</span><br/>\n";
      $check = true;
    }

    // check Images directory is writable
    echo "Checking 'images' directory has the correct permissions - ";
    $fp = fopen("images/temp.tmp", "w+");
    if (!$fp)
    {
      echo "<span style='color: red'>Failed - not writable (or not a directory)</span><br/>\n";
      $check = true;
    } else
    {
      $result = fwrite($fp, "Hello");
      if (!$result)
      {
        echo "<span style='color: red'>Failed - not writable (or not a directory)</span><br/>\n";
      $check = true;
      } else
      {
        fseek($fp, 0);
        $result = fread($fp, 5);
        if (!$result)
        {
          echo "<span style='color: red'>Failed - not readable</span><br/>\n";
          $check = true;
        } else
        {
          echo "<span style='color: green'>Success</span><br/>\n";
        }
      }
      fclose($fp);
      unlink("images/temp.tmp");
    }

    // check Images/Thumbs directory is writable
    echo "Checking 'images/thumbs' directory has the correct permissions - ";
    $fp = fopen("images/thumbs/temp.tmp", "w+");
    if (!$fp)
    {
      echo "<span style='color: red'>Failed - not writable (or not a directory)</span><br/>\n";
      $check = true;
    } else
    {
      $result = fwrite($fp, "Hello");
      if (!$result)
      {
        echo "<span style='color: red'>Failed - not writable (or not a directory)</span><br/>\n";
      $check = true;
      } else
      {
        fseek($fp, 0);
        $result = fread($fp, 5);
        if (!$result)
        {
          echo "<span style='color: red'>Failed - not readable</span><br/>\n";
          $check = true;
        } else
        {
          echo "<span style='color: green'>Success</span><br/>\n";
        }
      }
      fclose($fp);
      unlink("images/thumbs/temp.tmp");
    }

    echo "<br/>\n";
    echo "<table width='600'><tr><td>\n";
    if (false == $check)
    {
      echo "<form name='install_1b' method='post' action='install.php?stage=stage2a' enctype='multipart/form-data'>\n";
      echo "<input type='submit' value='Next -->'\>\n";
      echo "</form>\n";
    } else
    {
      echo "<span style='color: red'>Please fix the error and come back to this page</span>\n";
    }
    echo "</td></tr></table>\n";

    ShowProgressEnd();
  }

  // Stage 2A = Gather system settings
  function Stage2A()
  {
    echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
    echo "<script type='text/javascript' src='sources/common.js'></script>\n";
    echo "<script type='text/javascript'>\n";
    echo "function dbcheck()\n";
    echo "{\n";
	  echo "  var l_dbname = document.getElementById('dbname').value;\n";
	  echo "  var l_dbuser = document.getElementById('dbuser').value;\n";
	  echo "  var l_dbpass = document.getElementById('dbpass').value;\n";
	  echo "  var l_dbhost = document.getElementById('servername').value;\n";
    echo "\n";
	  echo "  var url = 'action=dbcheck' +\n";
	  echo "            '&dbname='+l_dbname +\n";
	  echo "            '&dbuser='+l_dbuser +\n";
	  echo "            '&dbpass='+l_dbpass +\n";
	  echo "            '&dbhost='+l_dbhost;\n";
	  echo "\n";
	  echo "  var request = new httpRequest('install.php', Stage2ACallback, null);\n";
	  echo "  request.update(url, 'GET');\n";
    echo "}\n";
    echo "\n";
    echo "function Stage2ACallback(text, status, xml, note)\n";
    echo "{\n";
	  echo "  if (status != 200)\n";
	  echo "  {\n";
	  echo "    document.getElementById('checkresultdb').innerHTML = 'Server returned code ' + status;\n";
	  echo "    return;\n";
	  echo "  }\n";
	  echo "  if ('OK' != text.substr(0, 2))\n";
	  echo "  {\n";
	  echo "    document.getElementById('checkresultdb').innerHTML = text;\n";
	  echo "    return;\n";
	  echo "  } else\n";
	  echo "  {\n";
	  echo "    document.getElementById('checkresultdb').innerHTML = text;\n";
	  echo "  }\n";
    echo "}\n";
    echo "</script>\n";

  	ShowProgressStart(1, false);
    echo "<b><div style='width:200px; margin-left:auto; margin-right:auto; font-size: 30px'>Moa install</div></b><br/>\n";
    echo "<span style='font-size: 20px'>Gathering data about server environment...</span></b><br/><br/>\n";

    echo "<form name='install_2a' method='post' action='install.php?stage=stage2b' enctype='multipart/form-data'>\n";
    echo "<table>\n";

    echo "<tr><td><span style='color: blue; font-size:13px;'><b>Database</b></span></td></tr>\n";

    // Servername
    echo "<tr>\n";
    echo "<td>Server address: </td><td><input type='text' name='servername' id='servername' value='localhost'\></td>\n";
    echo "</tr>\n";

    // Database name
    echo "<tr>\n";
    echo "<td>Database name: </td><td><input type='text' name='dbname' id='dbname'\></td>\n";
    echo "</tr>\n";

    // Database user
    echo "<tr>\n";
    echo "<td>Database username: </td><td><input type='text' name='dbuser' id='dbuser'\></td>\n";
    echo "</tr>\n";

    // Database password
    echo "<tr>\n";
    echo "<td>Database password: </td><td><input type='password' name='dbpass' id='dbpass'\></td>\n";
    echo "</tr>\n";

    // table prefix
    echo "<tr>\n";
    echo "<td>Table prefix: </td><td><input type='text' name='tabprefix' value='moa_'\></td>\n";
    echo "</tr>\n";

    echo "<tr>\n";
    echo "<td colspan='2'><input id='checklogin' type='button' value='Check Login'/><span id='checkresultdb'></span></td></tr>\n";

    echo "<script type='text/javascript'>\n";
    echo "addEvent( document.getElementById('checklogin'), 'click', function(e) {dbcheck();});\n";
    echo "</script>\n";

    // Spacer for titles
    echo "<tr><td><span style='color: blue; font-size:13px;'><b><br/><br/>Cookies</b></span></td></tr>\n";

    // Cookie name
    echo "<tr>\n";
    echo "<td>Cookie name: </td><td><input type='text' name='cookiename' value='_MoaCookie_'\></td>\n";
    echo "</tr>\n";

    // Cookie path
    $file_path = str_replace( "\\", "/", dirname(realpath(__FILE__)));
    $dir_path = str_replace( getenv("DOCUMENT_ROOT"), "", $file_path) . "/";

    echo "<tr>\n";
    echo "<td>Cookie Path: </td><td><input type='text' name='cookiepath' value='".$dir_path."'\></td>\n";
    echo "</tr>\n";

    echo "</table>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<input type='submit' value='Next -->'\>\n";
    echo "</td></tr></table>\n";
    echo "</form>\n";

    ShowProgressEnd();
  }

  // Stage 2B = Check DB settings and write config files
  function Stage2B()
  {
    global $MYSQL_MIN_VERSION;

    $check = false;
    ShowProgressStart(1, true);
    echo "<b><div style='width:200px; margin-left:auto; margin-right:auto; font-size: 30px;'>Installing...</div></b><br/>\n";
    echo "<span style='font-size: 20px'>Checking database settings to see if Moa will work.</span></b><br/><br/>\n";

    // Check database login
    echo "Checking database login - ";
    $db = mysql_connect($_REQUEST["servername"], $_REQUEST["dbuser"], $_REQUEST["dbpass"]) or $db = -999;
    if ($db != -999)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed</span><br/>\n";
      $check = true;
    }

    $servername = mysql_real_escape_string($_REQUEST["servername"]);
    $dbuser     = mysql_real_escape_string($_REQUEST["dbuser"]);
    $dbpass     = mysql_real_escape_string($_REQUEST["dbpass"]);
    $dbname     = mysql_real_escape_string($_REQUEST["dbname"]);
    $tabprefix  = mysql_real_escape_string($_REQUEST["tabprefix"]);
    $cookiename = mysql_real_escape_string($_REQUEST["cookiename"]);
    $cookiepath = mysql_real_escape_string($_REQUEST["cookiepath"]);

    // Check the MYSQL version
    echo "Checking for MYSQL version ".$MYSQL_MIN_VERSION[0].".".$MYSQL_MIN_VERSION[1].".".$MYSQL_MIN_VERSION[2]." or later - ";
    $mysql_version = get_mysql_version();

  	$passed = false;

  	// Major version
  	if ($mysql_version[0] > $MYSQL_MIN_VERSION[0])
  	{
  	   $passed = true;
  	} else
  	{ if ($mysql_version[0] == $MYSQL_MIN_VERSION[0])
  		{
  			// Now check minor version
  			if ($mysql_version[1] > $MYSQL_MIN_VERSION[1])
  			{
  			  $passed = true;
  			} else
  			{ if ($mysql_version[1] == $MYSQL_MIN_VERSION[1])
  				{
  			    // Now check revision version
  			    if ($mysql_version[2] >= $MYSQL_MIN_VERSION[2])
  			    {
  			      $passed = true;
  			    }
  				}
  			}
  		}
  	}

    if (false == $passed)
  	{
   	  echo "<span style='color: red'>Failed (".$mysql_version[0].".".$mysql_version[1].".".$mysql_version[2].")</span><br/>\n";
      $check = true;
    } else
    {
    	echo "<span style='color: green'>Success (".$mysql_version[0].".".$mysql_version[1].".".$mysql_version[2].")</span><br/>\n";
    }

    // Check database
    echo "Checking database - ";
    $select = true;
    mysql_select_db($dbname, $db) or $select = false;
    if ($select == true)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed</span><br/>\n";
      $check = true;
    }

    // Check for magic quotes
    $magic_quotes = "false";
    if (function_exists("get_magic_quotes_gpc"))
    {
      if (1 == get_magic_quotes_gpc())
      {
        $magic_quotes = "true";
      }
    }

    // Save db_config file
    if (false == $check)
    {
      $file = fopen("private/db_config.php", "wt");
      fwrite($file, "<?php\n");
      fwrite($file, "  \$db_host = '".strip_tags($_REQUEST["servername"])."';\n");
      fwrite($file, "  \$db_user = '".strip_tags($_REQUEST["dbuser"])."';\n");
      fwrite($file, "  \$db_pass = '".strip_tags($_REQUEST["dbpass"])."';\n");
      fwrite($file, "  \$db_name = '".strip_tags($_REQUEST["dbname"])."';\n");
      fwrite($file, "  \$tab_prefix = '".strip_tags($_REQUEST["tabprefix"])."';\n");
      fwrite($file, "?>\n");
      fclose($file);

      $file = fopen("config.php", "wt");
      fwrite($file, "<?php\n");
      fwrite($file, "  \$CONFIG_DISPLAY_MAX_WIDTH = 640;\n");
      fwrite($file, "  \$THUMB_PATH  = 'images/thumbs';\n");
      fwrite($file, "  \$IMAGE_PATH  = 'images';\n");
      fwrite($file, "  \$THUMB_WIDTH = 150;\n");
      fwrite($file, "  \$DISPLAY_PLAIN_SUBGALLERIES = true;\n");
      fwrite($file, "  \$COOKIE_NAME = '".strip_tags($_REQUEST["cookiename"])."';\n");

      $cookie_path = str_replace( "\\", "/", strip_tags($_REQUEST["cookiepath"]));

      fwrite($file, "  \$COOKIE_PATH = '".$cookie_path."';\n");
      fwrite($file, "  \$SHOW_EMPTY_DESC_POPUPS = false;\n");
      fwrite($file, "  \$EMPTY_DESC_POPUP_TEXT = 'No description';\n");
      fwrite($file, "  \$TITLE_DESC_LENGTH = 30;\n");
      fwrite($file, "  \$MAGIC_QUOTES = ".$magic_quotes.";\n");
      fwrite($file, "  \$STR_DELIMITER = \",\";\n");
      fwrite($file, "  \$MOA_PATH = ".$MOA_PATH.";\n");
      fwrite($file, "?>\n");
      fclose($file);
    }

    // Check permissions
    $created = false;
    echo "Checking permission (create table) - ";
    $result = mysql_query("CREATE TABLE `test_table` (`IDtab` int(10))");
    if ($result != false)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
      $created = true;
    } else
    {
      echo "<span style='color: red'>Failed (".mysql_error().")</span><br/>\n";
      $check = true;
    }

    echo "Checking permission (writing data) - ";
    $result = mysql_query("INSERT INTO test_table VALUES(1)");
    if ($result != false)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed (".mysql_error().")</span><br/>\n";
      $check = true;
    }

    echo "Checking permission (deleting data) - ";
    $result = mysql_query("DELETE FROM test_table WHERE (IDtab = 1)");
    if ($result != false)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed (".mysql_error().")</span><br/>\n";
      $check = true;
    }

    if ($created == true)
    {
      $result = mysql_query("DROP TABLE `test_table`");
      if ($result == false)
      {
        echo "<span style='color: blue; font-size: 13px;'><b>note: no permission to delete table 'test_table'.<br/>\n";
        echo "Not needed for Moa to work but you may wish to delete it by hand</b></span>\n";
      }
    }

    echo "<br/>\n";
    echo "<table width='600'><tr><td>\n";
    if (false == $check)
    {
      echo "<form name='install_2b' method='post' action='install.php?stage=stage3a' enctype='multipart/form-data'>\n";
      echo "<input type='submit' value='Next -->'\>\n";
      echo "</form>\n";
    } else
    {
      echo "<span style='color: red'>Please fix the error and come back to this page</span>\n";
    }
    echo "</td></tr></table>\n";

    ShowProgressEnd();
  }

  // Stage 3A = Gather new user settings
  function Stage3A()
  {
    ShowProgressStart(2, false);
    echo "<b><div style='width:200px; margin-left:auto; margin-right:auto; font-size: 30px;'>Installing...</div></b><br/>\n";
    echo "<span style='font-size: 20px;'>Create Moa user</span></b><br/><br/>\n";

    echo "<form name='install_3a' method='post' action='install.php?stage=stage3b' enctype='multipart/form-data'>\n";
    echo "<table>\n";

    // Database user
    echo "<tr>\n";
    echo "<td>Moa username: </td><td><input type='text' name='Moauser'\></td>\n";
    echo "</tr>\n";

    // Database password
    echo "<tr>\n";
    echo "<td>Moa password: </td><td><input type='password' name='Moapass'\></td>\n";
    echo "</tr>\n";

    echo "</table>\n";
    echo "<br/><br/>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<input type='submit' value='Finish -->'\>\n";
    echo "</td></tr></table>\n";
    echo "</form>\n";

    ShowProgressEnd();
  }

  // Stage 3B = Create database and add new user
  function Stage3B()
  {
    global $tab_prefix;

    ShowProgressStart(2, true);
    echo "<b><div style='width:200px; margin-left:auto; margin-right:auto; font-size: 30px;'>Installing...</div></b><br/>\n";
    echo "<span style='font-size: 20px;'>Creating data tables</span></b><br/><br/>\n";

    echo "<form name='install_3b' method='post' action='install.php?stage=stage4' enctype='multipart/form-data'>\n";

    echo "Creating data structure - ";
    $max_run = 21;
    $datainstalled = true;
    $count = 0;

    $result = mysql_query("SELECT * FROM ".$tab_prefix."gallerytaglink");
    if (false != $result)
    {
      $result = RunSQLFile("SQL/gallery-drop-constraints.sql");
      if (false != $result)
      {
        $count += $result;
      }
    } else
    {
      $max_run -= 2;
    }

    $result = RunSQLFile("SQL/gallery-create.sql");
    if (false != $result)
    {
      $count += $result;
    }
    $result = RunSQLFile("SQL/gallery-create-view.sql");
    if (false != $result)
    {
      $count += $result;
    }

    // Check for successfull database installation
    if ($max_run == $count)
    {
      echo "<span style='color: green'>Success (".$count."/".$max_run." SQL statements ran)</span><br/>\n";
    } else
    {
    	if (0 == $count) {
    	  echo "<span style='color: red'>Failed - (".mysql_error().")</span><br/>\n";
    	}
    	else
    	{
    	  echo "<span style='color: red'>Failed (".$count."/".$max_run." SQL statements ran)</span><br/>\n";
    	  if (18 == $count) {
          echo "<span style='color: red'>This could be because you don't have permission to create views.  See install document for possible work around.</span><br/>\n";
        }
      }
      $check = true;
    }

    echo "Creating user login - ";
    $new_pass = mb_strtoupper(sha1($_REQUEST["Moapass"]));
    $query = "INSERT INTO ".$tab_prefix."users (Name, Admin, Password, Salt) VALUES (_utf8'".mysql_real_escape_string($_REQUEST["Moauser"])."', 1, '".$new_pass."', '000000');";
    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if ($result != false)
    {
      echo "<span style='color: green'>Success</span><br/>\n";
    } else
    {
      echo "<span style='color: red'>Failed - (".mysql_error().")</span><br/>\n";
      $check = true;
    }

    echo "<br/><br/>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<input type='submit' value='Next -->'\>\n";
    echo "</td></tr></table>\n";
    echo "</form>\n";

    ShowProgressEnd();
  }

  // Stage 4 = Finish
  function Stage4()
  {
    ShowProgressStart(3, true);

    echo "<b><div style='width:200px; margin-left:auto; margin-right:auto; font-size: 30px;'>Congratulations...</div></b><br/>\n";
    echo "<span>You have successfully installed the Moa Gallery.</span></b><br/><br/>\n";

    echo "Click <a href='index.php'>here</a> to go to your new gallery.\n";

    ShowProgressEnd();
  }

  // httpRequested part. Checks the database details to see if they are valid
  function dbcheck()
  {

    $dbname = GetParam('dbname');
    if (false == $dbname)
    {
      RaiseFatalError("No database name supplied.");
      return false;
    }

    $dbuser = GetParam('dbuser');
    if (false == $dbuser)
    {
      RaiseFatalError("No user name supplied.");
      return false;
    }

    $dbpass = GetParam('dbpass');
    if (false == $dbpass)
    {
      RaiseFatalError("No database password supplied.");
      return false;
    }

    $dbhost = GetParam('dbhost');
    if (false == $dbhost)
    {
      RaiseFatalError("No database host name supplied.");
      return false;
    }

    $success = true;
  	$db = mysql_connect($dbhost, $dbuser, $dbpass) or $success = false;

  	if (!$success)
  	{
  		echo "Could not connect to database server.";
  		return false;
  	}
		mysql_select_db($dbname, $db) or $success = false;

		if (!$success)
		{
			echo "Could not select database '".$dbname."'.";
			return false;
		}

		echo "OK";
		return true;
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
     <?php
       $INSTALLING = true;
       $template_name = "MoaDefault";
       $MOA_PATH = str_replace( "\\", "/", dirname(realpath(__FILE__)))."/";

       include_once("sources/_db_funcs.php");
       include_once("sources/id.php");
       include_once("sources/common.php");
       include_once("sources/_template_parser.php");

	     if (isset($_REQUEST["action"]))
	     {
	       if (strcmp($_REQUEST["action"], "dbcheck") == 0)
	       {
	         dbcheck();
	         die();
	       }
	     }

       include_once ("sources/_html_head.php");
       echo "<title>Moa install</title>";
     ?>
  </head>
  <body>
    <?php
      //include_once ("sources/_header.php");

      if (isset($_REQUEST["stage"]))
      {
      	$stage = $_REQUEST["stage"];

      	switch ($stage)
      	{
      		case "stage1b" :
          {
            Stage1B();
            break;
          }
      		case "stage2a" :
	        {
	          Stage2A();
	          break;
          }
      		case "stage2b" :
	        {
	          Stage2B();
	          break;
	        }
      		case "stage3a" :
	        {
	          Stage3A();
	          break;
	        }
      		case "stage3b" :
	        {
	          include_once("private/db_config.php");
	          include_once("config.php");
	          $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	          mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	          // Turn on UTF-8 support
	          mysql_query("SET NAMES utf8;") or moa_db_error(mysql_error());
	          mysql_query("SET CHARACTER SET utf8")  or moa_db_error(mysql_error());
	          Stage3B();
	          break;
	        }
      		case "stage4" :
	        {
	          include_once("private/db_config.php");
	          include_once("config.php");
	          $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	          mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
	          // Turn on UTF-8 support
	          mysql_query("SET NAMES utf8;") or moa_db_error(mysql_error());
	          mysql_query("SET CHARACTER SET utf8")  or moa_db_error(mysql_error());
	          Stage4();
	          break;
	        }
      		default :
      		{
      			Stage0();
      		  break;
      	  }
      	}
      } else
      {
        Stage0();
      }


      //include ("sources/_footer.php");
    ?>
  </body>
</html>