<br/>
<form id="login-form" method="post" action="index.php" enctype="multipart/form-data">
  <div style="width: 270px; margin-left:auto; margin-right:auto;">
    <div class="logoutstatus">
      <moatag type="LogoutStatus"><br/><br/>
    </div>
    <div class="testbox_tl">
      <div class="testbox_tr">
        <div class="testbox_bl">
          <div class="testbox_br">
            <div class="testboxheader">
              Login
            </div>
            <div class="testboxcontent">
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<br/>