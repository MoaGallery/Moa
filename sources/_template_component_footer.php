<?php

  function TagParseFooterMoaCopyright($p_tag_options)
  {
    global $MOA_VERSION;
    return "Powered by <a class='footer_text_link' href='http://www.moagallery.net/'>Moa ".$MOA_VERSION."</a> &copy; 2008-2009";
  }

  function TagParseFooterLink($p_tag_options)
  {
    global $DEBUG_MODE;
    global $image_id;

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
        if ($DEBUG_MODE)
        {
          $str = "TEMPLATE WARNING: Unknown Link in FooterLink tag - '".html_display_safe($p_tag_options["dest"])."'.";
        }
        break;
      }
    }

    return $str;
  }
?>