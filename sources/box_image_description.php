<?php
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  
  if (isset($_REQUEST["image_id"]) == false)
  {
    die("Error: No Image ID supplied");
  }
  
  $image_id = $_REQUEST["image_id"];
  
  include_once("../private/db_config.php");
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  include_once("../config.php");
  include_once("id.php");
  
  $query = "SELECT Description FROM ".$tab_prefix."image WHERE (IDImage = '".mysql_real_escape_string($image_id)."')";
  $result = mysql_query($query) or die(mysql_error());
  $image = mysql_fetch_array($result);

  if ($image == false)
  {
    die();
  }

	if (isset($_REQUEST["edit"]) == true)
  {
    if (strcmp($_REQUEST["edit"], "true") == 0)
    {
      echo "<textarea class='form_text' id='image-comment' rows='4' cols='37'>".$image["Description"]."</textarea><br>\n";
      ?>
      <table>
        <tr>
          <td width=200 colspan='2'>
            <?php echo "<br><a href='javascript:void(0)' class='admin_link' onclick='javascript:show_add()'>[Add new tag]</a><br><br>"; ?>
            <span id='taglist'></span>
          </td>
        </tr>
      </table>
      <?php
      echo "<br>\n";
      echo "<input type='submit' value='Submit' onclick='CommentButtons(\"".session_id()."\");'></input>\n";
      echo "<input type='submit' value='Cancel' onclick='CommentButtons(\"".session_id()."\", true);'></input>\n";
    } else
    {
      if (isset($_REQUEST["desc"]))
      {
        //print_r($Userinfo);
        if ($Userinfo->ID != NULL)
        {
          $query = "UPDATE ".$tab_prefix."image SET Description = '".mysql_real_escape_string(strip_tags($_REQUEST["desc"]))."' WHERE (IDImage = '".mysql_real_escape_string($image_id)."')";
          $result = mysql_query($query) or die(mysql_error());
          $image["Description"] = strip_tags($_REQUEST["desc"]);
          
          $query = "DELETE FROM ".$tab_prefix."imagetaglink WHERE (IDImage = ".mysql_real_escape_string($image_id).")";
          $result = mysql_query($query) or die(mysql_error());
          
          // Set all the checked tags
          $query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
          $result = mysql_query($query) or die(mysql_error());
          while ($taglist = mysql_fetch_array($result))
          {
            if (isset($_SESSION["tag-".$taglist["IDTag"]]))
            {
              $query2 = "INSERT INTO ".$tab_prefix."imagetaglink (IDImage, IDTag) ".
                        " VALUES (".mysql_real_escape_string($image_id).", ".mysql_real_escape_string($taglist["IDTag"]).")";                            
              
              $result2 = mysql_query($query2) or die(mysql_error());
            }
          }
        } else
        {
          echo "You must be logged in<br>\n";
          die();
        }      
      }

      // If description length is zero then output a non-breaking space instead
      if (strlen( $image["Description"]) == 0) {
        echo "&nbsp";
      } else
      {
        echo "<div class='image_desc'>".nl2br(htmlspecialchars($image["Description"])."<div/>");
      }
    }
  }
  include_once("_add_dialogue_layers.php");
?>