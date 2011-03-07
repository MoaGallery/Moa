<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";

  $bodycontent .= "<div class='install_list_top'>Completing upgrade to version ";
  $bodycontent .= $MOA_MAJOR_VERSION.".".$MOA_MINOR_VERSION.".".$MOA_REVISION.$MOA_PATCH;
  $bodycontent .= " <br/><br/></div><br/>\n";
  $bodycontent .= "  <input type=\"button\" value=\"Test upgrade\" id=\"testbutton\"/><br/><br/>\n";
  $bodycontent .= "<div id=\"upgradeprogress\">\n";
  $bodycontent .= "</div><br/><br/>\n";
  $bodycontent .= "  <input type=\"button\" value=\"Complete upgrade\" id=\"upgradebutton\"/><br/><br/>\n";

  $bodycontent .= "<script type=\"text/javascript\" src='sources/common.js'></script>\n";
  $bodycontent .= "<script type=\"text/javascript\" src='sources/_request.js'></script>\n";
  $bodycontent .= "<script type=\"text/javascript\" src='sources/mod_upgrade.js'></script>\n";
  $bodycontent .= "<script type=\"text/javascript\">\n";
  $bodycontent .= "  moa_path = \"".$CFG["MOA_PATH"]."\";";
  $bodycontent .= "  upg = new Upgrade("._UpgradeGetCurrentVersionID().", "._UpgradeGetNewVersionID().");\n";
  $bodycontent .= "</script>\n";
  $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";

  $bodytitle .= "Upgrade - Moa";
?>
