<?php
  include_once('sources/_db_funcs.php');

  function ShowProgressStart($stage, $processing)
  {
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

    echo "<table class='normal_text' width='100%'><tr><td valign='top' width='250'>\n";

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
          for ($loop = -1; $loop < count($stages1) - 1; $loop++)
          {
            if ($loop < $stage)
            {
              echo "<img src='media/progress-blank.png'/> <font color='grey'>".$stages2[$loop]." - Done<br></font>\n";
            }
            if ($loop == $stage)
            {
              if (!$processing)
              {
                echo "<img src='media/progress-arrow.png'/> ".$stages1[$loop]."<br/>\n";
              } else
              {
                echo "<img src='media/progress-arrow.png'/> ".$stages2[$loop]."<br/>\n";
              }
            }
            if ($loop > $stage)
            {
              echo "<img src='media/progress-blank.png'/> ".$stages1[$loop]."<br/>\n";
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

  function Stage0()
  {
    ShowProgressStart(-1, true);
    echo "<center><b><font size='6'>Moa install</font></b></center><br>\n";
    echo "<font size='4'>Welcome to Moa install</font></b><br><br>\n";

    // TODO - write some intro text
    echo "hello\n";

    echo "<br><br>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<form name='install_1b' method='post' action='install.php?stage=stage1b' enctype='multipart/form-data'>\n";
    echo "<input type='submit' value='Start install -->'\>\n";
    echo "</form>\n";
    echo "</td></tr></table>\n";

    ShowProgressEnd();
  }

  function Stage1B()
  {
    $check = false;
    ShowProgressStart(0, true);
    echo "<center><b><font size='6'>Moa install</font></b></center><br>\n";
    echo "<font size='4'>Checking server environment to see if Moa will work...</font></b><br><br>\n";

    // Check for GD
    echo "Checking for GD extension to PHP - ";
    if (function_exists('imagecreatefromjpeg'))
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed</font><br>\n";
      $check = true;
    }

    // Check for MySQL
    echo "Checking for MySQL extension to PHP - ";
    if (function_exists('mysql_query'))
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed</font><br>\n";
      $check = true;
    }

    // check Images directory is writable
    // TODO - use pathname from config
    echo "Checking 'images' directory has the correct permissions - ";
    $fp = fopen("images/temp.tmp", "w+");
    if (!$fp)
    {
      echo "<font color='red'>Failed - not writable (or not a directory)</font><br>\n";
      $check = true;
    } else
    {
      $result = fwrite($fp, "Hello");
      if (!$result)
      {
        echo "<font color='red'>Failed - not writable (or not a directory)</font><br>\n";
      $check = true;
      } else
      {
        fseek($fp, 0);
        $result = fread($fp, 5);
        if (!$result)
        {
          echo "<font color='red'>Failed - not readable</font><br>\n";
          $check = true;
        } else
        {
          echo "<font color='green'>Success</font><br>\n";
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
      echo "<font color='red'>Failed - not writable (or not a directory)</font><br>\n";
      $check = true;
    } else
    {
      $result = fwrite($fp, "Hello");
      if (!$result)
      {
        echo "<font color='red'>Failed - not writable (or not a directory)</font><br>\n";
      $check = true;
      } else
      {
        fseek($fp, 0);
        $result = fread($fp, 5);
        if (!$result)
        {
          echo "Failed - not readable</font><br>\n";
          $check = true;
        } else
        {
          echo "<font color='green'>Success</font><br>\n";
        }
      }
      fclose($fp);
      unlink("images/thumbs/temp.tmp");
    }

    echo "<br>\n";
    echo "<table width='600'><tr><td>\n";
    if (false == $check)
    {
      echo "<form name='install_1b' method='post' action='install.php?stage=stage2a' enctype='multipart/form-data'>\n";
      echo "<input type='submit' value='Next -->'\>\n";
      echo "</form>\n";
    } else
    {
      echo "<font color='red'>Please fix the error and come back to this page</font>\n";
    }
    echo "</td></tr></table>\n";

    ShowProgressEnd();
  }

  function Stage2A()
  {
    ShowProgressStart(1, false);
    echo "<center><b><font size='6'>Moa install</font></b></center><br>\n";
    echo "<font size='4'>Gathering data about server environment...</font></b><br><br>\n";


    echo "<form name='install_2a' method='post' action='install.php?stage=stage2b' enctype='multipart/form-data'>\n";
    echo "<table>\n";

    echo "<tr><td><font size='2' color='blue'><b>Database</b></font></td></tr>\n";

    // Servername
    echo "<tr>\n";
    echo "<td>Server address: </td><td><input type='text' name='servername' value='localhost'\></td>\n";
    echo "</tr>\n";

    // Database name
    echo "<tr>\n";
    echo "<td>Database name: </td><td><input type='text' name='dbname'\></td>\n";
    echo "</tr>\n";

    // Database user
    echo "<tr>\n";
    echo "<td>Database username: </td><td><input type='text' name='dbuser'\></td>\n";
    echo "</tr>\n";

    // Database password
    echo "<tr>\n";
    echo "<td>Database password: </td><td><input type='password' name='dbpass'\></td>\n";
    echo "</tr>\n";

    // table prefix
    echo "<tr>\n";
    echo "<td>Table prefix: </td><td><input type='text' name='tabprefix' value='Moa_'\></td>\n";
    echo "</tr>\n";

    // Spacer for titles
    echo "<tr><td><font size='2' color='blue'><b><br><br>Cookies</b></font></td></tr>\n";

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

  function Stage2B()
  {
    $check = false;
    ShowProgressStart(1, true);
    echo "<center><b><font size='6'>Installing...</font></b></center><br>\n";
    echo "<font size='4'>Checking database settings to see if Moa will work.</font></b><br><br>\n";

    // Check database login
    echo "Checking database login - ";
    $db = mysql_connect($_REQUEST["servername"], $_REQUEST["dbuser"], $_REQUEST["dbpass"]) or $db = -999;
    if ($db != -999)
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed</font><br>\n";
      $check = true;
    }

    // Check database
    echo "Checking database - ";
    $select = true;
    mysql_select_db($_REQUEST["dbname"], $db) or $select = false;
    if ($select == true)
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed</font><br>\n";
      $check = true;
    }

    // Save db_config file
    if (false == $check)
    {
      $file = fopen("private/db_config.php", "wt");
      fwrite($file, "<?php\n");
      fwrite($file, "  \$db_host = '".mysql_real_escape_string(strip_tags($_REQUEST["servername"]))."';\n");
      fwrite($file, "  \$db_user = '".mysql_real_escape_string(strip_tags($_REQUEST["dbuser"]))."';\n");
      fwrite($file, "  \$db_pass = '".mysql_real_escape_string(strip_tags($_REQUEST["dbpass"]))."';\n");
      fwrite($file, "  \$db_name = '".mysql_real_escape_string(strip_tags($_REQUEST["dbname"]))."';\n");
      fwrite($file, "  \$tab_prefix = '".mysql_real_escape_string(strip_tags($_REQUEST["tabprefix"]))."';\n");
      fwrite($file, "?>\n");
      fclose($file);

      $file = fopen("config.php", "wt");
      fwrite($file, "<?php\n");
      fwrite($file, "  \$CONFIG_DISPLAY_MAX_WIDTH = 640;\n");
      fwrite($file, "  \$THUMB_PATH  = 'images/thumbs';\n");
      fwrite($file, "  \$IMAGE_PATH  = 'images';\n");
      fwrite($file, "  \$THUMB_WIDTH = 150;\n");
      fwrite($file, "  \$DISPLAY_PLAIN_SUBGALLERIES = true;\n");
      fwrite($file, "  \$GALLERY_COLS = 5;\n");
      fwrite($file, "  \$COOKIE_NAME = '".mysql_real_escape_string(strip_tags($_REQUEST["cookiename"]))."';\n");
            
      $cookie_path = str_replace( "\\", "/", mysql_real_escape_string(strip_tags($_REQUEST["cookiepath"])));
            
      fwrite($file, "  \$COOKIE_PATH = '".addslashes($cookie_path)."';\n");
      fwrite($file, "  \$SHOW_EMPTY_DESC_POPUPS = false;\n");
      fwrite($file, "  \$EMPTY_DESC_POPUP_TEXT = 'No description';\n");
      fwrite($file, "  \$TITLE_DESC_LENGTH = 30;\n");
      fwrite($file, "?>\n");
      fclose($file);
    }

    // Check permissions
    $created = false;
    echo "Checking permission (create table) - ";
    $result = mysql_query("CREATE TABLE `test_table` (`IDtab` int(10))");
    if ($result != false)
    {
      echo "<font color='green'>Success</font><br>\n";
      $created = true;
    } else
    {
      echo "<font color='red'>Failed (".mysql_error().")</font><br>\n";
      $check = true;
    }

    echo "Checking permission (writing data) - ";
    $result = mysql_query("INSERT INTO test_table VALUES(1)");
    if ($result != false)
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed (".mysql_error().")</font><br>\n";
      $check = true;
    }

    echo "Checking permission (deleting data) - ";
    $result = mysql_query("DELETE FROM test_table WHERE (IDtab = 1)");
    if ($result != false)
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed (".mysql_error().")</font><br>\n";
      $check = true;
    }

    if ($created == true)
    {
      $result = mysql_query("DROP TABLE `test_table`");
      if ($result == false)
      {
        echo "<font size='2' color='blue'><b>note: no permission to delete table 'test_table'.<br>\n";
        echo "Not needed for Moa to work but you may wish to delete it by hand</b></font>\n";
      }
    }

    echo "<br>\n";
    echo "<table width='600'><tr><td>\n";
    if (false == $check)
    {
      echo "<form name='install_2b' method='post' action='install.php?stage=stage3a' enctype='multipart/form-data'>\n";
      echo "<input type='submit' value='Next -->'\>\n";
      echo "</form>\n";
    } else
    {
      echo "<font color='red'>Please fix the error and come back to this page</font>\n";
    }
    echo "</td></tr></table>\n";

    ShowProgressEnd();
  }

  function Stage3A()
  {
    ShowProgressStart(2, false);
    echo "<center><b><font size='6'>Installing...</font></b></center><br>\n";
    echo "<font size='4'>Create Moa user</font></b><br><br>\n";

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
    echo "<br><br>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<input type='submit' value='Finish -->'\>\n";
    echo "</td></tr></table>\n";
    echo "</form>\n";

    ShowProgressEnd();
  }

  function Stage3B()
  {
    global $tab_prefix;

    ShowProgressStart(2, true);
    echo "<center><b><font size='6'>Installing...</font></b></center><br>\n";
    echo "<font size='4'>Creating data tables</font></b><br><br>\n";

    echo "<form name='install_3b' method='post' action='install.php?stage=stage4' enctype='multipart/form-data'>\n";

    echo "Creating data structure - ";
    $datainstalled = true;
    $count = 0;

    $result = mysql_query("SELECT * FROM ".$tab_prefix."gallerytaglink");
    if (true == $result)
    {
      $result = runSQLFile("SQL/gallery-drop-constraints.sql");
      if (false != $result)
      {
        $count += $result;
      }
    }

    $result = runSQLFile("SQL/gallery-create.sql");
    if (false != $result)
    {
      $count += $result;
    }
    $result = runSQLFile("SQL/gallery-create-view.sql");
    if (false != $result)
    {
      $count += $result;
    }

    if ($datainstalled != false)
    {
      echo "<font color='green'>Success (".$count." SQL statements ran)</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed - (".mysql_error().")</font><br>\n";
      $check = true;
    }

    echo "Creating user login - ";
    $query = "INSERT INTO ".$tab_prefix."users (Name, Admin, Password) VALUES ('".mysql_real_escape_string(strip_tags($_REQUEST["Moauser"]))."', 1, PASSWORD('".mysql_real_escape_string(strip_tags($_REQUEST["Moapass"]))."'));";
    $result = mysql_query($query) or die(mysql_error());

    if ($result != false)
    {
      echo "<font color='green'>Success</font><br>\n";
    } else
    {
      echo "<font color='red'>Failed - (".mysql_error().")</font><br>\n";
      $check = true;
    }

    echo "<br><br>\n";
    echo "<table width='600'><tr><td>\n";
    echo "<input type='submit' value='Next -->'\>\n";
    echo "</td></tr></table>\n";
    echo "</form>\n";

    ShowProgressEnd();
  }

  function stage4()
  {
    ShowProgressStart(3, true);
    
    echo "<center><b><font size='6'>Congratulations...</font></b></center><br>\n";
    echo "<font>You have successfully installed the Moa Gallery.</font></b><br><br>\n";
        
    echo "Click <a href='index.php'>here</a> to go to you're new site.\n";    
        
    ShowProgressEnd();
  }
  
  if ((isset($_REQUEST["stage"])) && (strcmp($_REQUEST["stage"], "stage2b") == 0))
  {
    setcookie($_REQUEST["cookiename"], "Test", time()+60*60*24*100, $_REQUEST["cookiepath"], false, false, false);
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Site Map</title>";
     ?>
  </head>
  <body>
    <?php
      $INSTALLING = true;

      include_once ("sources/_header.php");
      include_once ("sources/_gallery_delete.php");

      if (isset($_REQUEST["stage"]))
      {
        if (strcmp($_REQUEST["stage"], "stage1b") == 0)
        {
          Stage1B();
        }
        if (strcmp($_REQUEST["stage"], "stage2a") == 0)
        {
          Stage2A();
        }
        if (strcmp($_REQUEST["stage"], "stage2b") == 0)
        {
          Stage2B();
        }
        if (strcmp($_REQUEST["stage"], "stage3a") == 0)
        {
          Stage3A();
        }
        if (strcmp($_REQUEST["stage"], "stage3b") == 0)
        {
          Stage3B();
        }
        if (strcmp($_REQUEST["stage"], "stage4") == 0)
        {
          Stage4();
        }
      } else
      {
        Stage0();
      }

      include ("sources/_footer.php");
    ?>
  </body>
</html>