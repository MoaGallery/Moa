<td class='pale_area_nb'>
 <form name='edit_form' method='post' action='admin_users.php?action=view'  enctype='multipart/form-data'>
    <div class='form_label_text' style='width:120px; float:left;'>Name</div>
    <input name='name' id='username' type='text' onKeyPress='' onKeyUp='' value=''></input>
    <input name='id' id='userid' type='hidden'></input>
    <br/>
    <div class='form_label_text' style='width:120px; float:left;'>Admin</div>
    <input name='admin' id='useradmin' type='checkbox' onKeyPress=''></input>
    <br/>
    <div class='form_label_text' style='width:120px; float:left;'>Password</div>
    <input name='pass1' id='userpass1' type='password' onKeyPress='' value=''></input>
    <br/>
    <div class='form_label_text' style='width:120px; float:left;'>Confirm Password</div>
    <input name='pass2' id='userpass2' type='password' onKeyPress='' value=''></input>
    <br/><br/>
    <input name='id' type='hidden' value=''></input>
    <input name='mode' type='hidden' value=''></input>
    <input type='button' id='formsubmit' value='Submit' onclick='user_list.FormSubmit();'>
    <input type='button' id='formcancel' value='Cancel' onclick='user_list.FormCancel();'>
  </form>
</td>