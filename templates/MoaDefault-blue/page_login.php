<form id="login-form" method="post" action="index.php?action=admin" enctype="multipart/form-data">
  <p class="logoutstatus">
    <moatag type="LogoutStatus">
  </p>

  <div class="mainblock login_box">
    <p class="mainblockheader">
      Login
    </p>
    <div class="mainblockcontent">
      <fieldset class="formFieldset">
        <ul class="formList">
          <li>
            <label for="loginname" class="formLabel">Name:</label>
            <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="login_name">" alt="popup help" />
            <input id="loginname" type="text" name="name" class='form_text' />
          </li>

          <li>
            <label for="loginpass" class="formLabel">Password:</label>
            <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="login_pass">" alt="popup help" />
            <input id="loginpass" type="password" name="password" class='form_text' />
          </li>

          <li>
            <label for="loginduration" class="formLabel">Duration:</label>
            <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="login_duration">" alt="popup help" />
            <select class='form_text' name="duration" id="loginduration">
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
</form>