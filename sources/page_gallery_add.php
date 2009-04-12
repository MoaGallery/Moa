    <?php
      include_once($MOA_PATH."sources/mod_tag_view.php");

      // If no parent, make it come off the root node
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
      echo "  cur_tags = '';\n";
      echo "</script>\n";
      echo "<script type='text/javascript' src='sources/mod_gallery.js'></script>\n";
      echo "<script type='text/javascript'>\n";
      echo "  //<![CDATA[\n";

      echo "  var editform = ";
      echo LoadTemplateRootForJavaScript("component_gallery_form_add.php");
      echo ";\n";

      echo "  var feedback_box = ";
      echo moa_feedback_js();
      echo ";\n";
      echo "  var template_path = 'templates/".$template_name."/';\n";

      echo "  //]]>\n";
      echo "  var gallery = new Gallery('".$STR_DELIMITER."');\n";
      echo "  gallery.PreLoad('', '', '', '".$parent_id."');\n";
      echo "</script>\n";

      echo LoadTemplateRoot("page_gallery_add.php");
    ?>

    <script type='text/javascript'>
      // Add event handlers for the form
      document.getElementById("galleryaddform").innerHTML = editform;
      addEvent(document.getElementById("galleryformname"), "keypress", function (e) {return checkKey(e, "galleryformsubmit", null);});
      addEvent(document.getElementById("galleryformtags"), "keypress", function (e) {return checkKey(e, "galleryformsubmit", null);});
      addEvent(document.getElementById("galleryformparent_id"), "keypress", function (e) {return checkKey(e, "galleryformsubmit", null);});
      addEvent(document.getElementById("galleryformtags"), "keyup", function (e) {gallery.Feedback(); gallery.TagHintList(this);});
      addEvent(document.getElementById("galleryformexpandlink"), "click", function (e) {gallery.ExpandClick();});

      gallery.Feedback();
    </script>

    <?php
      $page_title = "Add gallery";
    ?>