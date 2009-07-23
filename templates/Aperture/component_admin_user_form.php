<ul class="user_editform">
  <li>
    <div class='form_label_text user_editformlabel'>Name</div>
    <input name='name' id='username' type='text' onKeyPress='' onKeyUp='' value=''></input>
    <input name='id' id='userid' type='hidden'></input>
    <br/>
  </li>
  <li>
    <div class='form_label_text user_editformlabel'>Admin rights</div>
    <input name='admin' id='useradmin' type='checkbox' onKeyPress=''></input>
    <br/>
  </li>
  <li>
    <div class='form_label_text user_editformlabel'>Password</div>
    <input name='pass1' id='userpass1' type='password' onKeyPress='' value=''></input>
    <br/>
  </li>
  <li>
    <div class='form_label_text user_editformlabel'>Confirm Password</div>
    <input name='pass2' id='userpass2' type='password' onKeyPress='' value=''></input>
    <br/>
  </li>
  <li>
    <div class='form_label_text user_editformlabel'>&nbsp;</div>
    <input name='id' type='hidden' value=''></input>
    <input name='mode' type='hidden' value=''></input>
    <input type='button' id='formsubmit' value='Submit' onclick='user_list.FormSubmit();'>
    <input type='button' id='formcancel' value='Cancel' onclick='user_list.FormCancel();'>
  </li>
</ul>
