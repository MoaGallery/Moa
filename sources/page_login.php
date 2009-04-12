    <?php
      include_once ($MOA_PATH."sources/id.php");

      echo LoadTemplateRoot("page_login.php");
    ?>

    <script type='text/javascript' src='sources/common.js'></script>
    <script type="text/javascript">
      addEvent(document.getElementById('loginname'), "keypress", function (e) {checkKey(e, "loginsubmit", null);});
      addEvent(document.getElementById('loginpass'), "keypress", function (e) {checkKey(e, "loginsubmit", null);});
      addEvent(document.getElementById('loginduration'), "keypress", function (e) {checkKey(e, "loginsubmit", null);});
      document.getElementById("loginname").focus();
    </script>

    <?php
      $page_title = "Login";
    ?>
