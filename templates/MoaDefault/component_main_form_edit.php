<fieldset class="formFieldset">
  <ul class="formList">
    <li>
      <label for="mainformdesc" class="formLabel">
        Description:
        <a class='admin_link' id='mainformexpandlink'>
          [Expand]
        </a>
      </label>
      <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="main_desc">" alt="popup help" />
      <textarea class='form_text' name='mainformdesc' id='mainformdesc' rows='4' cols='50'></textarea>
    </li>
  
    <li class="formButtons">
      <input type='button' value='Submit' id='mainformsubmit' onclick='main.SubmitEdit();'/>
      <input type='button' value='Cancel' id='mainformcancel' onclick='main.CancelEdit();'/>
    </li>
  </ul>
</fieldset>