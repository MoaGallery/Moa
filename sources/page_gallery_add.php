    <?php
      include_once("sources/mod_gallery_view.php");
      include_once("sources/mod_tag_view.php");

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
      echo "  var editform = "; ViewGalleryForm($parent_id, true); echo ";\n";
      echo "  var gallery = new Gallery('".$STR_DELIMITER."');\n";
      echo "  gallery.PreLoad('', '', '', '".$parent_id."');\n";
      echo "</script>\n";
    ?>
    <div id='galleryblockfeedback'></div>

    <table border='0' class='area' cellspacing='0' cellpadding='5' id="add_table">
      <tr>
        <td class='box_header'>Add Gallery</td>
      </tr>
      <tr class='pale_area_nb'>
        <td>
	        <div id='galleryaddform'></div>
        </td>
      </tr>
    </table>
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