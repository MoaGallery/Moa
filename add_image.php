<?php
    session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Add image</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");
      include ("sources/_inherit_tags.php");
    ?>

    <table border='0' class='area' cellspacing='0' cellpadding='5' id="add_table">
      <tr>
        <td colspan='3' class='box_header'>Add Image</td>
      </tr>
      <tr class='pale_area_nb'>	
        <td valign='top'>          
					<?php                                                                                                                
						echo "<object data='sources/box_add_image.php?PHPSESSID=".session_id();                                          
						                                                                                                                   
						if (isset($_REQUEST["parent_id"]))                                                                                 
						{                                                                                                                  
						  echo "&parent_id=".$_REQUEST["parent_id"];                                                                       
						}                                                                                                                  
						echo "' vspace='0' hspace='0' border='0' marginwidth='0' width='415' height='240' type='text/html'></object>";
					?>
        </td>
        <td class='form_label_text' style='width: 50px' valign='top'>Tags:</td>
        <td valign='top' style='width:250px;'>
          <?php
            include "sources/box_taglist_add.php";
          ?>
          <img src='media/trans-pixel.png' width='200' height='1' alt='' />
        </td>
      </tr>
    </table
  </body>

  <script type="text/javascript">
    ajaxTagList("");
  </script>

  <?php
    include ("sources/_footer.php");
    
  ?>
</html>
