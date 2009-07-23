<div class="body_section">
  <form id="login-form" method="post" action="index.php" enctype="multipart/form-data" >
    <div class="left_column left_column_shadow">
      &nbsp;
    </div>
    <div class="right_column right_column_shadow">
      <div class="login_block">
        <div class="login_box">
          <h3>
            Admin sign in
          </h3>
          <dl class="login_form_items">
            <dt class='form_label_text'>
              Name:
            </dt>
            <dd>
              <input id="loginname" type="text" name="name" class='form_text login_input_width' />
            </dd>
            <dt class='form_label_text'>
              Password:
            </dt>
            <dd>
              <input id="loginpass" type="password" name="password" class='form_text login_input_width' />
            </dd>
            <dt class='form_label_text'>
              Duration:
            </dt>
            <dd>
              <select name="duration" id="loginduration" class='form_text login_input_width'>
                <option value="mins30">30 Minutes</option>
                <option value="mins60">1 Hour</option>
                <option value="mins120">2 Hours</option>
                <option value="forever">Forever</option>
              </select>
            </dd>
            <dt class='form_label_text'>

            </dt>
            <dd>
              <div class="loginbutton">
                <input type="submit" value="Login" id="loginsubmit"/>
              </div>
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </form>
</div>