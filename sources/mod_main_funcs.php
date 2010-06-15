<?php
  // mod_gallery_funcs.php - This is a collection of functions that interect with the database and a gallery.
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_image_funcs.php");

  // Returns the description of the home gallery.
  function _MainGetDescription() {
    global $errorString;
    global $CFG;

    $query = "SELECT Description FROM `".$CFG["tab_prefix"]."frontpage`";

    $result = @mysql_query($query);// or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    if (!is_bool($result))
    {
      $desc = mysql_fetch_array($result);
      return $desc["Description"];
    }

    return "";
  };

  function _MainEdit( $p_new_description) {
  	global $errorString;
  	global $CFG;

    $query = "UPDATE `".$CFG["tab_prefix"]."frontpage` SET Description = _utf8'".TypeSafeMysqlRealEscapeString( $p_new_description)."'";

    $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);

    return $result;
  }
?>