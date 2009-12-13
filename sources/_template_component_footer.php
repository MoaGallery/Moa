<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function TagParseFooterMoaCopyright($p_tag_options)
  {
    global $CFG;
    return "<a href='http://www.moagallery.net/'>Moa ".$CFG["MOA_VERSION"]."</a> &copy; 2008-2009";
  }

  function TagParseFooterLink($p_tag_options)
  {
    global $CFG;

    $str = "";

    switch ($p_tag_options["dest"])
    {
      case "PHP" :
      {
        $str = "<a href='http://www.php.net/'><img class='footer_logo' src='media/php-logo.png' alt='PHP Logo'/></a>";
        break;
      }
      case "Overlib" :
      {
        $str = "<a href='http://www.bosrup.com/web/overlib/'><img class='footer_logo' src='media/overliblogo.png' alt='Popups by overLIB!'/></a>";
        break;
      }
      case "W3C" :
      {
        $str = "<a href='http://validator.w3.org/check/referer'><img class='footer_logo' src='media/xhtml10-logo.png'  alt='Valid XHTML 1.0 Transitional'/></a>";
        break;
      }
      case "MySQL" :
      {
        $str = "<a href='http://www.mysql.com/'><img class='footer_logo' src='media/mysql-logo.png' alt='MySQL Logo'/></a>";
        break;
      }
      default:
      {
        if ($CFG["DEBUG_MODE"])
        {
          $str = "TEMPLATE WARNING: Unknown Link in FooterLink tag - '".html_display_safe($p_tag_options["dest"])."'.";
        }
        break;
      }
    }

    return $str;
  }
?>