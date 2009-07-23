<li id='tag_<moavar AdminTagID>' class="outline">
  <div class="outlinetitle">component_admin_tag_line.php</div>
  <div id='tag_name_<moavar AdminTagID>' ondblclick='tag_list.Edit( "<moavar AdminTagID>")'>
    <moavar AdminTagName>
  </div>
  <div id='tag_edit_link_<moavar AdminTagID>'>
    <a onclick='tag_list.Edit( "<moavar AdminTagID>")'>
      [Edit]
    </a>
  </div>
  <div id='tag_delete_link_<moavar AdminTagID>'>
    <a onclick='tag_list.Delete( "<moavar AdminTagID>")'>
      [Delete]
    </a>
  </div>
  <div id='tag_edit_box_<moavar AdminTagID>'>
    <input id='tag_edit_input_<moavar AdminTagID>' type='text' name='tag_edit_box_<moavar AdminTagID>' onKeyPress='checkKey(event, "tag_edit_submit_button_<moavar AdminTagID>", "tag_edit_cancel_button_<moavar AdminTagID>")'>
  </div>
  <div id='tag_edit_cancel_<moavar AdminTagID>'>
    <button id='tag_edit_cancel_button_<moavar AdminTagID>' onclick='javascript: tag_list.CancelEdit("<moavar AdminTagID>")'>
      Cancel
    </button>
  </div>
  <div id='tag_edit_submit_<moavar AdminTagID>'>
    <button id='tag_edit_submit_button_<moavar AdminTagID>' onclick='javascript: tag_list.SubmitEdit("<moavar AdminTagID>")'>
      Save
    </button>
  </div>
</li>