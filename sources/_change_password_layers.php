        <div class='add_tag_dialogue' id="add_dialogue">
          <table class='area' cellspacing="0" cellpadding="5" width="150" height="100">
            <tr>
              <td class="box_header">New password</td>
            </tr>
            <tr class="pale_area_nb">
              <td>
                <input type='hidden' id='newpassid'></input>
                <input type='textbox' id='newpass'></input><br><br>
                <input type='button' value='OK' onclick='submit_ChangePass(escape(document.getElementById("newpass").value), escape(document.getElementById("newpassid").value)); document.getElementById("newpass").value=""; hide_ChangePass();'></input>
                <input type='button' value='Cancel' onclick='javascript:hide_ChangePass()'></input>
              </td>
            </tr>
          </table>
        </div>
