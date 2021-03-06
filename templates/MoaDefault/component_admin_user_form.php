<fieldset class="formFieldset">
  <ul class="formList">
	  <li>
	    <label for="username" class="formLabel">Name:</label>
	    <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="admin_user_id">" alt="popup help" />
	    <input name='name' id='username' type='text' onKeyPress='' onKeyUp='' value=''></input>
	    <input name='id' id='userid' type='hidden'></input>
	  </li>

	  <li>
	    <label for="useradmin" class="formLabel">Admin</label>
	    <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="admin_user_admin">" alt="popup help" />
	    <input name='admin' id='useradmin' type='checkbox' onKeyPress=''></input>
	  </li>

	  <li>
	    <label for="userpass1" class="formLabel">Password</label>
	    <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="admin_user_password1">" alt="popup help" />
	    <input name='pass1' id='userpass1' type='password' onKeyPress='' value=''></input>
	  </li>

	  <li>
	    <label for="userpass2" class="formLabel">Confirm Password</label>
	    <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="admin_user_password2">" alt="popup help" />
	    <input name='pass2' id='userpass2' type='password' onKeyPress='' value=''></input>
	  </li>
	  
	  <li class="formButtons">
      <input name='id' type='hidden' value=''></input>
      <input name='mode' type='hidden' value=''></input>
      <input type='button' id='formsubmit' value='Submit' <moatag type="AdminUserFormSubmitLink">>
      <input type='button' id='formcancel' value='Cancel' <moatag type="AdminUserFormCancelLink">>
    </li>
    
    <li id='usernamecomment' class='invalidfieldcomment invalidfieldstyle'>No name supplied.</li>
    <li id='userpass1comment' class='invalidfieldcomment invalidfieldstyle'>Password is blank.</li>
    <li id='userpass2comment' class='invalidfieldcomment invalidfieldstyle'>Confirmation password does not match.</li>
  </ul>
</fieldset>