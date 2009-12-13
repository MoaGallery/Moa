<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  /* mod_tag_funcs.php
   This is a collection of functions that interect with the database and a tag.
  */
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");

  //  Structure for a single tag
  class Tag
  {
    var $m_id;
    var $m_name;
  };

  function _TagExists($p_id)
  {
    global $ErrorString;
    global $CFG;

    $query = "SELECT 1 FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

    if ((false === $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    return true;
  };

  function _TagLookup($p_name)
  {
    global $ErrorString;
    global $CFG;

    $query = "SELECT IDTag FROM `".$CFG["tab_prefix"]."tag` WHERE Name = '".mysql_real_escape_string($p_name)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);

    if ((false === $result) || (0 == mysql_num_rows($result))) {
      return false;
    }
    $row = mysql_fetch_array($result);
    return $row["IDTag"];
  };

  function _TagChangeValue($p_id, $p_field, $p_value)
  {
    global $ErrorString;
    global $CFG;

    $query = "UPDATE `".$CFG["tab_prefix"]."tag` SET ".mysql_real_escape_string($p_field)." = _utf8'".mysql_real_escape_string($p_value)."' WHERE IDTag = '".$p_id."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }
    return true;
  };

  function _TagGetValue($p_id, $p_field )
  {
    global $ErrorString;
    global $CFG;

    $query = "SELECT ".mysql_real_escape_string($p_field)." FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);
    return $row[$p_field];
  };

  function _TagGetAllValues($p_id)
  {
    global $ErrorString;
    global $CFG;

    $query = "SELECT * FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $row = mysql_fetch_array($result);

    $tag = new Tag;
    $tag->m_id          = $p_id;
    $tag->m_name        = $row["Name"];

    return $tag;
  };

  function _TagGetTags()
  {
    global $ErrorString;
    global $CFG;

    $query = "SELECT * FROM `".$CFG["tab_prefix"]."tag`;";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $tags = array();

    while ($row = mysql_fetch_array($result)) {
      $tag = new Tag;
      $tag->m_id   = $row["IDTag"];
      $tag->m_name = $row["Name"];

      $tags[] = $tag;
    }

    return $tags;
  };

  function _TagDelete($p_id)
  {
    global $ErrorString;
    global $CFG;

    $query = "DELETE FROM `".$CFG["tab_prefix"]."imagetaglink` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $query = "DELETE FROM `".$CFG["tab_prefix"]."gallerytaglink` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    $query = "DELETE FROM `".$CFG["tab_prefix"]."tag` WHERE IDTag = '".mysql_real_escape_string($p_id)."'";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    return true;
  };

  function _TagAdd($p_name)
  {
    global $ErrorString;
    global $CFG;

    $query = "INSERT INTO `".$CFG["tab_prefix"]."tag` (Name) VALUES (_utf8'".mysql_real_escape_string($p_name)."')";
    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    if (false === $result) {
      return false;
    }

    return sprintf("%010s",mysql_insert_id());
  };
?>
