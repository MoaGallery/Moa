  <div id='upgradeprogress'>
     <div class='install_list'>Completing upgrade to version
     <?php
       echo $MOA_MAJOR_VERSION.".".$MOA_MINOR_VERSION.".".$MOA_REVISION;
     ?>
     <br/></div><br/><br/>
    <input type="button" value="Complete upgrade" id="upgradebutton"/><br/><br/>
  </div>

<?php
  echo "<script type='text/javascript' src='sources/common.js'></script>\n";
  echo "<script type='text/javascript' src='sources/_request.js'></script>\n";
  echo "<script type='text/javascript' src='sources/mod_upgrade.js'></script>\n";
  echo "<script type='text/javascript'>\n";
  echo "  upg = new Upgrade("._UpgradeGetCurrentVersionID().", "._UpgradeGetNewVersionID().");\n";
  echo "</script>\n";
?>
