<?php
  header("Cache-Control: no-cache, must-revalidate");
  session_start();
  
  if (isset($_REQUEST["gallery_id"]) == false)
  {
    die("Error: No Gallery ID supplied");
  }
  
  $gallery_id = $_REQUEST["gallery_id"];
  
  include_once("../private/db_config.php");
  
  $db = mysql_connect($db_host, $db_user, $db_pass) or die("Error" . mysql_error());
  mysql_select_db($db_name, $db) or die("Error" . mysql_error());
  include_once("../config.php");
  include_once("id.php");
  
  $query = "SELECT Name, Description FROM ".$tab_prefix."gallery WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
  $result = mysql_query($query) or die(mysql_error());
  $gallery = mysql_fetch_array($result);
  
  if ($gallery == false)
  {
    die();
  }
  
  if (isset($_REQUEST["edit"]) == true)
  {
    if (strcmp($_REQUEST["edit"], "true") == 0)
    {
      echo "<table cellpadding='0' cellspacing='0'>\n";
      echo "<tr><td class='form_label_text' style='width: 70px' valign='top'>Name:</td><td colspan='4'><input class='form_text' type='text' id='gal-name' value='".$gallery["Name"]."'></input></td>\n";      
      echo "<td rowspan='2' style='width: 20px'></td><td class='form_label_text' rowspan='2' style='width: 70px' valign='top'>Tags:</td><td rowspan='2'  valign='top'>\n";
      ?>
      <table cellpadding='0' cellspacing='0'>
        <tr>          
          <td width=200>                      	
            <?php echo "<a href='javascript:void(0)' class='admin_link' style='float: none' onclick='javascript:show_add()'>[Add new tag]</a><br/>"; ?>
            &nbsp;
          </td>
        </tr>
        <tr>
          <td width=200>            
            <span id='taglist'><img src="media/loading.png" alt="Loading" title=""/></span>            
          </td>
        </tr>        
      </table>
      <br>
      <?php
      echo "</td></tr>";
      echo "<tr><td class='form_label_text' style='width: 70px' valign='top'>Comment:&nbsp</td><td><textarea class='form_text' id='gal-comment'  rows='4' cols='30'>".$gallery["Description"]."</textarea><br/><br/></td></tr>\n";
      echo "<tr><td></td><td colspan='4'><input type='submit' value='Submit' onclick='CommentButtons(\"".session_id()."\");'></input>\n";
      echo "<input type='submit' value='Cancel' onclick='CommentButtons(\"".session_id()."\", true);'></input></td></tr>\n";
      echo "</table><br>";
    } else
    {
      if ((isset($_REQUEST["desc"])) && (isset($_REQUEST["name"])))
      {
        if ($Userinfo->ID != NULL)
        {
          $query = "UPDATE ".$tab_prefix."gallery SET Description = '".mysql_real_escape_string(strip_tags($_REQUEST["desc"]))."', Name = '".mysql_real_escape_string(strip_tags($_REQUEST["name"]))."' WHERE (IDGallery = '".mysql_real_escape_string($gallery_id)."')";
          $result = mysql_query($query) or die(mysql_error());
          $gallery["Description"] = strip_tags($_REQUEST["desc"]);
          $gallery["Name"] = strip_tags($_REQUEST["name"]);
          
          $query = "DELETE FROM ".$tab_prefix."gallerytaglink WHERE (IDGallery = ".mysql_real_escape_string($gallery_id).")";
          $result = mysql_query($query) or die(mysql_error());
          
          // Set all the checked tags
          $query = "SELECT * FROM ".$tab_prefix."tag ORDER BY Name";
          $result = mysql_query($query) or die(mysql_error());
          while ($taglist = mysql_fetch_array($result))
          {
            if (isset($_SESSION["tag-".$taglist["IDTag"]]))
            {
              $query2 = "INSERT INTO ".$tab_prefix."gallerytaglink (IDGallery, IDTag) VALUES (".mysql_real_escape_string($gallery_id).", ".mysql_real_escape_string($taglist["IDTag"]).")";
              $result2 = mysql_query($query2) or die(mysql_error());
            }           
          }
        } else
        {
          echo "You must be logged in<br>\n";
          die();
        }
      }

      //print_r($gallery)."<br>\n";  
      
      echo "<div class='gallery_name'>".$gallery["Name"]."</div><br>";
      if (($gallery["Description"]) != NULL) 
      {        
        echo "<div class='gallery_desc'>".nl2br(stripslashes($gallery["Description"]))."</div>";
      }      
    }
  }
  include_once("_add_dialogue_layers.php");
?>