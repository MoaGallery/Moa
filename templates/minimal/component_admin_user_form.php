<div class="outline">
  <div class="outlinetitle">component_admin_user_form.php</div>
<form name='edit_form' method='post' action='admin_users.php?action=view'  enctype='multipart/form-data'>
  <dl>
	  <dt>
	    Name
	  </dt>
	  <dd>
	    <input name='name' id='username' type='text' onKeyPress='' onKeyUp='' value=''></input>
	    <input name='id' id='userid' type='hidden'></input>
	  </dd>

	  <dt>
	    Admin
	  </dt>
	  <dd>
	    <input name='admin' id='useradmin' type='checkbox' onKeyPress=''></input>
	  </dd>

	  <dt>
	    Password
	  </dt>
	  <dd>
	    <input name='pass1' id='userpass1' type='password' onKeyPress='' value=''></input>
	  </dd>

	  <dt>
	    Confirm Password
	  </dt>
	  <dd>
	    <input name='pass2' id='userpass2' type='password' onKeyPress='' value=''></input>
	  </dd>
  </dl>
  <input name='id' type='hidden' value=''></input>
  <input name='mode' type='hidden' value=''></input>
  <input type='button' id='formsubmit' value='Submit' onclick='user_list.FormSubmit();'>
  <input type='button' id='formcancel' value='Cancel' onclick='user_list.FormCancel();'>
</form>
