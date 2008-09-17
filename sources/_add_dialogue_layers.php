        <div class='add_tag_dialogue' id="add_dialogue">
          <table class='area' cellspacing="0" cellpadding="5" width="150" height="100">
            <tr>
              <td class="box_header">Add new tag</td>
            </tr>
            <tr class="pale_area_nb">
              <td>
                <input type='textbox' id='newtag'></input><br><br>
                <input type='button' value='OK' onclick='ajaxTagList(escape(document.getElementById("newtag").value)); document.getElementById("newtag").value=""; hide_add();'></input>
                <input type='button' value='Cancel' onclick='javascript:hide_add()'></input>
              </td>
            </tr>
          </table>
        </div>
        <div class="fade-area" id="fade">
          <img src="media/black-pixel.png" name="fade-img" width="100%" height="100%">
        </div>