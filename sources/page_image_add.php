    <?php
      include_once($MOA_PATH."sources/mod_tag_view.php");

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

      echo "    var editform = ";
      echo LoadTemplateRootForJavaScript("component_image_form_add.php");
      echo ";\n";

      echo "  var feedback_box = ";
      echo moa_feedback_js();
      echo ";\n";
      echo "  var template_path = 'templates/".$template_name."/';\n";

      echo "  //]]>\n";
      echo "    var image = new Image('".$STR_DELIMITER."');\n";
      echo "</script>\n";

      echo "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
      echo LoadTemplateRoot("page_image_add.php");
    ?>

    <script type='text/javascript'>
      document.getElementById("imageaddform").innerHTML = editform;
      image.PreLoad('', '', '', '".$parent_id."');
      image.PopulateForm();
    </script>

    <?php
      $page_title = "Add image";
      echo "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
    ?>