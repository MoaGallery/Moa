<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");

  function GetNonTaggedOrphans()
  {
    global $CFG;
    $hits = array();

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
      $hit = new Image();
      $hit->m_id          = $row['IDImage'];
      $hit->m_description = $row['Description'];
      $hits[] = $hit;
    }

    return $hits;
  }

  function GetNoGalleryOrphans()
  {
  	global $CFG;
    $hits = array();

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
      $hit = new Image();
      $hit->m_id          = $row['IDImage'];
      $hit->m_description = $row['Description'];
      $hits[] = $hit;
    }

    return $hits;
  }
?>
