        <div class='add_user_dialogue' id="add_user_dialogue">
          <table class='area' cellspacing="0" cellpadding="5" width="230" height="130">
            <tr>
              <td class="box_header" height='20'>Add new user</td>
            </tr>
            <tr class="pale_area_nb"  valign='top'>
              <td>
                <table class='form_label_text'>
                  <tr>
                    <td>Name: </td>
                    <td><input type='textbox' id='newusername'></input></td>
                  </tr><tr>
                    <td>Admin: </td>
                    <td><input type='checkbox' id='newuseradmin'></input><br></td>
                  </tr><tr>
                    <td>Password: </td>
                    <td><input type='textbox' id='newuserpass'></input></td>
                  </tr><tr>
                    <td colspan="2">&nbsp;</td>
                  </tr><tr>
                    <td colspan="2" align="center">
                      <input type='button' value='OK' onclick='ajaxUserList(escape(document.getElementById("newusername").value), escape(document.getElementById("newuseradmin").checked), escape(document.getElementById("newuserpass").value)); document.getElementById("newusername").value=""; document.getElementById("newuseradmin").checked="false";document.getElementById("newuserpass").value=""; hide_adduser();'></input>
                      <input type='button' value='Cancel' onclick='javascript:hide_adduser(); document.getElementById("newusername").value=""; document.getElementById("newuseradmin").checked = false; document.getElementById("newuserpass").value="";'></input>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
        <div class="fade-area" id="fade">
          <img src="media/black-pixel.png" name="fade-img" width="100%" height="100%">
        </div>