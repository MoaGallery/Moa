<?php
  if (isset($pre_cache) == false)
  {
    header("Cache-Control: no-cache, must-revalidate");
    session_start();
    include_once("_error_funcs.php");
    include_once("../private/db_config.php");
    $db = mysql_connect($db_host, $db_user, $db_pass) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    mysql_select_db($db_name, $db) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
    include_once("../config.php");
    include_once("id.php");
  } else
  {
    $_REQUEST["edit"] = false;
  }

  if (isset($_REQUEST["gallery_id"]) == true)
  {
    $gallery_id = $_REQUEST["gallery_id"];
  } else
  { if (isset($pre_gallery_id) == true)
    {
      $gallery_id = $pre_gallery_id;
    } else
    {
      moa_warning("No gallery ID supplied.");
      die();
    }
  } 

  $query = "SELECT Name, Description FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
  $gallery = mysql_fetch_array($result);

  if ($gallery == false)
  {
    moa_warning("Invalid gallery");
    die();
  }
  
  if (isset($_REQUEST["edit"]) == true)
  {
    if (strcmp($_REQUEST["edit"], "true") == 0)
    {
    ?>
      <form style='margin-bottom: 0px;'>
        <div id="formsection" style="float:left;">
          <table border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td class='form_label_text' style='height: 10px; width: 70px' valign='top'>
                Name:
              </td>
              <td style='height: 10px;' valign='top' colspan='4'>            
                <input class='form_text' type='text' id='gal-name' value='<?php echo $gallery["Name"]; ?>' onkeypress='return checkKey(event);'></input>      
              </td>
            </tr>
            <tr>
              <td rowspan='2' class='form_label_text' style='width: 70px' valign='top'>
                Comment:&nbsp
              </td>
              <td valign='top'>
                <textarea class='form_text' id='gal-comment' rows='4' cols='30'><?php echo $gallery["Description"];?></textarea>
                <br/>
                <br/>
              </td>
            </tr>
            <tr>
              <td colspan='4'>
                <input type='button' value='Submit' id='galsubmit' onclick='CommentButtons("<?php echo session_id(); ?>");'></input>
                <input type='button' value='Cancel' id='galcancel' onclick='CommentButtons("<?php echo session_id(); ?>", true);'></input>
              </td>
            </tr>
          </table>
        </div>
        <div id="tagsection" style="float:left;">
          <table>
            <tr>
              <td rowspan='3' style='width: 20px'></td>
              <td class='form_label_text' rowspan='3' style='width: 70px' valign='top'>
                Tags:
              </td>
              <td rowspan='3' valign='top'>
                <table cellpadding='0' cellspacing='0'>
                  <tr>
                    <td style="width:200px;">
                      <span id='taglist'><img src="media/loading.png" alt="Loading" title=""/></span>
                    </td>
                  </tr>
                </table>
                <br>
              </td>
            </tr>
          </table>
        </div>
      </form>
    <?php
    } else
    {
      if ((isset($_REQUEST["desc"])) && (isset($_REQUEST["name"])))
      {
        if ($Userinfo->ID != NULL)
        {
          $query = "UPDATE ".$tab_prefix."gallery SET Description = '".mysql_real_escape_string(strip_tags($_REQUEST["desc"]))."', Name = '".mysql_real_escape_string(strip_tags($_REQUEST["name"]))."' WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
          $gallery["Description"] = strip_tags($_REQUEST["desc"]);
          $gallery["Name"] = strip_tags($_REQUEST["name"]);

          $query = "DELETE FROM ".$tab_prefix."gallerytaglink WHERE (IDGallery = ".mysql_real_escape_string($gallery_id).")";
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

          // Set all the checked tags
          $query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
          $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
          while ($taglist = mysql_fetch_array($result))
          {
            if (isset($_SESSION["tag-".$taglist["IDTag"]]))
            {
              $query2 = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES (".mysql_real_escape_string($gallery_id).", ".mysql_real_escape_string($taglist["IDTag"]).")";
              $result2 = mysql_query($query2) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
            }
          }
        } else
        {
          moa_warning("You must be logged in.");
          die();
        }
      }

      //print_r($gallery)."<br>\n";

      echo "<div class='gallery_name'>".$gallery["Name"]."</div><br/>";
      if (($gallery["Description"]) != NULL)
      {
        echo "<div class='gallery_desc'>".nl2br(stripslashes($gallery["Description"]))."</div>";
      }
    }
  }
?>