<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST['CFG']))
  {
    echo 'Hacking attempt.';
    die();
  }

  include_once($CFG['MOA_PATH']."sources/_db_funcs.php");
  include_once($CFG['MOA_PATH']."sources/mod_image_funcs.php");
  
  function CheckPathIsValid($p_path = '', $p_varName = '')
  {
    global $CFG;
    global $errorString;

    $error = false;
    
    // Check path is terminated by a slash
    if (0 != strcmp(substr($p_path, -1, 1), '/'))
    {
      $errorString .= $p_varName.' Path must be terminated by a "/".'."\n";
      $error = true;
    }
    
    // Check path isn't trying to back out of the Moa directory
    if (-1 < strpos($p_path, '..'))
    {
      $errorString .= $p_varName.' Path may not contain "..".'."\n";
      $error = true;
    }
    
    // Check path isn't trying to return to the root
    if (0 == strcmp(substr($p_path, 0, 1), '/'))
    {
      $errorString .= $p_varName.' Path may not start with "/".'."\n";
      $error = true;
    }
    
    // Check path exists
    if (!is_dir($CFG['MOA_PATH'].$p_path))
    {
      $errorString .= $p_varName.' Path does not exist'."\n";
      $error = true;
    }
    
    if ($error)
    {
      return false;
    }
    
    return true;
  }

  function CheckPaths()
  {
    global $CFG;
    $testPassed = true;
    
    $result = CheckPathIsValid($CFG['IMAGE_PATH'], 'IMAGE_PATH');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckPathIsValid($CFG['THUMB_PATH'], 'THUMB_PATH');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckPathIsValid($CFG['BULKUPLOAD_PATH'], 'BULKUPLOAD_PATH');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    if (!$testPassed)
    {
      return false;
    }
    
    return true;
  }
  
  function CheckDBTable($p_tableName = '', $p_prefix = '')
  {
    global $CFG;
    global $errorString;
    
    if (0 == strcmp($p_prefix, ''))
    {
      $p_prefix = $CFG['tab_prefix'];
    }
    
    $result = mysql_query('SELECT * FROM `'.mysql_real_escape_string($p_prefix).mysql_real_escape_string($p_tableName).'`;');
    
    if (false === $result)
    {
      $errorString .= 'Could not open '.$p_tableName.' table.'."\n";
      return false;
    }
    
    return true;
  }
  
  function CheckDBSettings($p_host, $p_user, $p_pass, $p_name)
  {
    global $errorString;
    
    $dbTest = @mysql_connect($p_host, $p_user, $p_pass, true);
    if (false === $dbTest)
    {
      $errorString .= 'Invalid database settings.'."\n";
      return false;
    }
    
    $result = @mysql_select_db($p_name, $dbTest);
    if (false === $result)
    {
      $errorString .= 'Database not found (connection to server OK).'."\n";
      mysql_close($dbTest);
      return false;
    }
    
    return true;
  }
  
  function CheckDB()
  {
    global $CFG;
    global $errorString;
    $testPassed = true;
    
    $result = CheckDBSettings($CFG['db_host'], $CFG['db_user'], $CFG['db_pass'], $CFG['db_name']);
    if (false == $result)
    {
      return false;
    }
    
    @mysql_query("SET NAMES utf8;");
    @mysql_query("SET CHARACTER SET utf8");
    
    $result = CheckDBTable('gallery');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckDBTable('gallerytaglink');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckDBTable('image');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckDBTable('imagetaglink');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckDBTable('tag');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    $result = CheckDBTable('users');
    if (false == $result)
    {
      $testPassed = false;
    }
    
    // Needed to stop an upgrade from before 1.2.1 breaking
    $result = mysql_query('SELECT Format FROM '.$CFG['tab_prefix'].'image;');
    if (false !== $result)
    {
      $result = CheckDBTable('frontpage');
      if (false == $result)
      {
        $testPassed = false;
      }
      
      $result = CheckDBTable('settings');
      if (false == $result)
      {
        $testPassed = false;
      }
    }
    
    
    @mysql_close($db);
    
    if (!$testPassed)
    {
      return false;
    }
    
    return true;
  }

  function GetNonTaggedOrphans()
  {
    global $CFG;
    $orphans = array();

    $query = "SELECT Img.*
                FROM `".$CFG["tab_prefix"]."image` AS Img LEFT JOIN `".$CFG["tab_prefix"]."imagetaglink` As ImgTagLinks ON Img.IDImage = ImgTagLinks.IDImage
               GROUP BY Img.IDImage
              HAVING (((COUNT(ImgTagLinks.IDTag))=0));";

    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if ((is_bool($result)) && ($result == false))
    {
      return false;
    }

    while ($row = mysql_fetch_array($result))
    {
      $image = new Image();
      $image->loadId($row['IDImage']);
      $image->m_id          = $image->id;
      $image->m_description = $image->description;
      $orphans[] = $image;
    }

    return $orphans;
  }

  function GetNoGalleryOrphans()
  {
  	global $CFG;
    $orphans = array();

    // Holy crap!
    $query = "SELECT orphan_images.*
                FROM (SELECT img3.IDImage
                           , img3.Description
                           , img3.Filename
                           , img3.Height
                           , img3.Width
                        FROM  `".$CFG["tab_prefix"]."image` img3
                       WHERE img3.IDImage NOT IN (SELECT gvgi3.IDImage
                                                    FROM (SELECT gg2.IDGallery
                                                               , itl2.IDImage
                                                               , img2.Description
                                                            FROM `".$CFG["tab_prefix"]."imagetaglink` itl2,
                                                                 `".$CFG["tab_prefix"]."gallerytaglink` gtl2,
                                                                 `".$CFG["tab_prefix"]."image` img2,
                                                                 `".$CFG["tab_prefix"]."gallery` gg2
                                                           WHERE itl2.IDTag = gtl2.IDTag
                                                             AND itl2.IDImage = img2.IDImage
                                                             AND gtl2.IDGallery = gg2.IDGallery
                                                        GROUP BY gg2.IDGallery, itl2.IDimage, img2.Description
                                                          HAVING COUNT(itl2.IDTag) = (SELECT COUNT(gtl2.IDTag)
                                                                                        FROM `".$CFG["tab_prefix"]."gallerytaglink` gtl2
                                                                                       WHERE gtl2.IDGallery = gg2.IDGallery)) AS gvgi3)) AS orphan_images
           LEFT JOIN (SELECT `".$CFG["tab_prefix"]."image`.*
           		        FROM `".$CFG["tab_prefix"]."image`
           		        LEFT JOIN `".$CFG["tab_prefix"]."imagetaglink` ON `".$CFG["tab_prefix"]."image`.IDImage=`".$CFG["tab_prefix"]."imagetaglink`.IDImage
                       GROUP BY `".$CFG["tab_prefix"]."image`.IDImage
                      HAVING (((COUNT(`".$CFG["tab_prefix"]."imagetaglink`.IDTag))=0))) AS orphan_no_tags ON orphan_images.IDImage = orphan_no_tags.IDImage
                GROUP BY orphan_images.IDImage
               HAVING (((COUNT(orphan_no_tags.IDImage))=0))";


    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if ((is_bool($result)) && ($result == false))
    {
      return false;
    }

    while ($row = mysql_fetch_array($result))
    {
      $image = new Image();
      $image->loadId($row['IDImage']);
      $image->m_id          = $image->id;
      $image->m_description = $image->description;
      $orphans[] = $image;
    }

    return $orphans;
  }
?>
