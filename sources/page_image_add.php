    <?php
      include_once("sources/mod_gallery_view.php");
      include_once("sources/mod_tag_view.php");

      $parent_id = GetParam("parent_id");
      if (false == $parent_id)
      {
        $parent_id = "0000000000";
      }
      echo "<script type='text/javascript' src='sources/common.js'></script>\n";
      echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
      echo "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
      echo "<script type='text/javascript'>\n";
      echo "  all_tags = '"; ViewAllTagList(); echo "';\n";
      echo "  cur_tags = '"; ViewGalleryCurrentTagList($parent_id); echo "';\n";
      echo "</script>\n";
      echo "<script type='text/javascript' src='sources/mod_image.js'></script>\n";
      echo "<script type='text/javascript'>\n";
      echo "  //<![CDATA[\n";
      echo "    var editform = "; ViewImageForm(true); echo ";\n";
      echo "  //]]>\n";
      echo "    var image = new Image('".$STR_DELIMITER."');\n";
      echo "</script>\n";
    ?>
    <div id='imageblockfeedback'></div>

    <table border='0' class='area' cellspacing='0' cellpadding='5' id="add_table">
      <tr>
        <td class='box_header'>Add Image</td>
      </tr>
      <tr class='pale_area_nb'>
        <td>
          <div id='imageaddform'></div>
        </td>
      </tr>
    </table>
    <div style='float: left;'>&nbsp;&nbsp;</div><div id="imageformnewlist" style='float: left;' class='form_label_text'></div>
    <script type='text/javascript'>
      document.getElementById("imageaddform").innerHTML = editform;
      image.PreLoad('', '', '', '".$parent_id."');
      image.PopulateForm();
    </script>

    <?php
      $page_title = "Add image";
    ?>