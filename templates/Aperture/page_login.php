<div class="body_section">
  <form id="login-form" method="post" action="index.php?action=admin" enctype="multipart/form-data" >
    <div class="left_column left_column_shadow">
      &nbsp;
    </div>
    <div class="right_column right_column_shadow">
      <div class="login_block">
        <div class="login_box">
          <h3>
            Admin sign in
          </h3>
          
          <fieldset class="formFieldset">
            <ul class="formList">
              <li>
                <label for="loginname" class="formLabel">Name:</label>
                <img src="templates/Aperture/media/help.png" title="<moatag type="FormPopupHelp" field="login_name">" alt="popup help" />
                <input id="loginname" type="text" name="name" class='form_text loginFormInputBorder' />
              </li>
              
              <li>
                <label for="loginpass" class="formLabel">Password:</label>
                <img src="templates/Aperture/media/help.png" title="<moatag type="FormPopupHelp" field="login_pass">"  alt="popup help"/>
                <input id="loginpass" type="password" name="password" class='form_text loginFormInputBorder' />
              </li>
              
              <li>
                <label for="loginduration" class="formLabel">Duration:</label>
                <img src="templates/Aperture/media/help.png" title="<moatag type="FormPopupHelp" field="login_duration">" alt="popup help"/>
                <select name="duration" id="loginduration" class='form_text login_input_width'>
                  <option value="mins30">30 Minutes</option>
                  <option value="mins60">1 Hour</option>
                  <option value="mins120">2 Hours</option>
                  <option value="forever">Forever</option>
                </select>
              </li>
              
              <li class="formButtons">
                <input type="submit" value="Login" id="loginsubmit"/>
              </li>
              
              <li id='loginnamecomment' class='invalidfieldcomment invalidfieldstyle'>You must supply a user name.</li>
              <li id='loginpasscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply a password.</li>
            </ul>
          </fieldset>
        </div>
      </div>
    </div>
  </form>
</div>