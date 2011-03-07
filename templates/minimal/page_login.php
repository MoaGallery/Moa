<div class="pageoutline">
  <div class="outlinetitle">page_login.php</div>

  <form id="login-form" method="post" action="index.php" enctype="multipart/form-data">
    <div>
	    <moatag type="LogoutStatus">
	  </div>
    <p>
      Login
    </p>
    
    <fieldset>
	    <label for="loginname" class="formLabel">
	      <span class="formLabelText">User name:</span>
        <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="login_name">" />
  	    <input id="loginname" type="text" name="name" />
	    </label>

	    <label for="loginpass" class="formLabel">
	      <span class="formLabelText">Password:</span>
        <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="login_pass">" />
        <input id="loginpass" type="password" name="password" />
      </label>

	    <label for="loginduration" class="formLabel">
	      <span class="formLabelText">Duration:</span>
        <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="login_duration">" />
        <select name="duration" id="loginduration">
	        <option value="mins30">30 Minutes</option>
	        <option value="mins60">1 Hour</option>
	        <option value="mins120">2 Hours</option>
	        <option value="forever">Forever</option>
	      </select>
	    </label>

	    <div class="clearleft">
	      <input type="submit" value="Login" id="loginsubmit"/>
	    </div>
	    
	    <div id='loginnamecomment' class='invalidfieldcomment invalidfieldstyle'>You must supply a user name.</div>
      <div id='loginpasscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply a password.</div>
    </fieldset>
    
	</form>
</div>