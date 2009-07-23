<li id='tag_<moavar AdminTagID>'>
  <p class='tag_name' id='tag_name_<moavar AdminTagID>' ondblclick='tag_list.Edit( "<moavar AdminTagID>")'>
    <moavar AdminTagName>
  </p>
  <div class="tag_link" id='tag_delete_link_<moavar AdminTagID>'>
    <a class='admin_link' onclick='tag_list.Delete( "<moavar AdminTagID>")'>
      [Delete]
    </a>
  </div>
  <div class="tag_link" id='tag_edit_link_<moavar AdminTagID>'>
    <a class='admin_link' onclick='tag_list.Edit( "<moavar AdminTagID>")'>
      [Edit]
    </a>
  </div>

  <div class='tag_edit_box' id='tag_edit_box_<moavar AdminTagID>'>
    <input id='tag_edit_input_<moavar AdminTagID>' type='text' name='tag_edit_box_<moavar AdminTagID>' onKeyPress='checkKey(event, "tag_edit_submit_button_<moavar AdminTagID>", "tag_edit_cancel_button_<moavar AdminTagID>")'>
  </div>
  <div class='tag_button'>
    <div id='tag_edit_cancel_<moavar AdminTagID>'>
      <button id='tag_edit_cancel_button_<moavar AdminTagID>' onclick='javascript: tag_list.CancelEdit("<moavar AdminTagID>")' class='inline_element'>
        Cancel
      </button>
    </div>
    <div id='tag_edit_submit_<moavar AdminTagID>'>
      <button id='tag_edit_submit_button_<moavar AdminTagID>' onclick='javascript: tag_list.SubmitEdit("<moavar AdminTagID>")' class='inline_element'>
        Ok
      </button>
    </div>
  </div>
  <br/>
</li>