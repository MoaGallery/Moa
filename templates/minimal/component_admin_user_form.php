<div class="outline">
  <div class="outlinetitle">component_admin_user_form.php</div>
<fieldset>
  <label for="userid" class="formLabel">
    <span class="formLabelText">Name:</span>
    <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="admin_user_id">" />
    <input name='name' id='username' type='text' onKeyPress='' onKeyUp='' value=''></input>
    <input name='id' id='userid' type='hidden'></input>
  </label>

  <label for="useradmin" class="formLabel">
    <span class="formLabelText">Admin:</span>
    <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="admin_user_admin">" />
    <input name='admin' id='useradmin' type='checkbox' onKeyPress=''></input>
  </label>

  <label for="userpass1" class="formLabel">
    <span class="formLabelText">Password:</span>
    <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="admin_user_password1">" />
    <input name='pass1' id='userpass1' type='password' onKeyPress='' value=''></input>
  </label>

	<label for="userpass2" class="formLabel">
	  <span class="formLabelText">Confirm password:</span>  
    <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="admin_user_password2">" />
    <input name='pass2' id='userpass2' type='password' onKeyPress='' value=''></input>
  </label>

  <div class="clearleft">
    <input type='button' id='formsubmit' value='Submit' onclick='user_list.FormSubmit();'>
    <input type='button' id='formcancel' value='Cancel' onclick='user_list.FormCancel();'>
  </div>
  
  <div id='usernamecomment' class='invalidfieldcomment invalidfieldstyle'>No name supplied.</div>
  <div id='userpass1comment' class='invalidfieldcomment invalidfieldstyle'>Password is blank.</div>
  <div id='userpass2comment' class='invalidfieldcomment invalidfieldstyle'>Confirmation password does not match.</div>
</fieldset>
