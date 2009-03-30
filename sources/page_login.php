    <?php
      include_once ("sources/id.php");
      ?>
      <form id="login-form" method="post" action="index.php" enctype="multipart/form-data">
        <table class="area" cellpadding="5" cellspacing="0" style="margin-left:auto; margin-right:auto;">
          <tr>
            <td class="box_header">Login</td>
          </tr>
          <tr>
            <td class="pale_area_nb">
              <table cellpadding="5" cellspacing="0">
                <tr><td class='form_text'>Name:</td><td> <input id="loginname" type="text" name="name" class='form_text' /></td></tr>
                <tr><td class='form_text'>Password:</td><td><input id="loginpass" type="password" name="password" class='form_text' /></td></tr>
                <tr><td class='form_text'>Duration:</td><td>
                	<select name="duration" id="loginduration" class='form_text'>
                	  <option value="mins30">30 Minutes</option>
                    <option value="mins60">1 Hour</option>
                    <option value="mins120">2 Hours</option>
                    <option value="forever">Forever</option>
                  </select></td>
                </tr>
                <tr><td colspan="2"><div style="width:60px; margin-left:auto; margin-right:auto;"><input type="submit" value="Login" id="loginsubmit"/></div></td></tr>
              </table>
            </td>
          </tr>
        </table>
      </form>

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
