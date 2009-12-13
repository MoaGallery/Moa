<form id="login-form" method="post" action="index.php?action=admin" enctype="multipart/form-data">
  <div>
    <div class="logoutstatus">
      <moatag type="LogoutStatus">
    </div>
    <div class="testbox_tl login_box">
      <div class="testbox_tr">
        <div class="testbox_bl">
          <div class="testbox_br">
            <p class="testboxheader">
              Login
            </p>
            <div class="testboxcontent">
              <dl class="form_items">
                <dt class='form_text'>
                  Name:
                </dt>
                <dd>
                  <input id="loginname" type="text" name="name" class='form_text' />
                </dd>

                <dt class='form_text'>
                  Password:
                </dt>
                <dd>
                  <input id="loginpass" type="password" name="password" class='form_text' />
                </dd>

                <dt class='form_text'>
                  Duration:
                </dt>
                <dd>
                  <select class='form_text' name="duration" id="loginduration">
                    <option value="mins30">30 Minutes</option>
                    <option value="mins60">1 Hour</option>
                    <option value="mins120">2 Hours</option>
                    <option value="forever">Forever</option>
                  </select>
                </dd>

                <dt>
                  &nbsp;
                </dt>
                <dd>
                  <input type="submit" value="Login" id="loginsubmit"/>
                </dd>
              </dl>
              <div class="new_line">&nbsp;</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<br/>