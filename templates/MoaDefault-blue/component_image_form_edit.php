<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
  <fieldset class="formFieldset">
    <ul class="formList">
      <li class="formLine">
        <label for="imageformdesc" class="formLabelNewLine">
          Description:
          <a class='admin_link' id='imageformexpandlink'>
            [Expand]
          </a>
        </label>
        <img src="templates/MoaDefault-blue/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="desc">" alt="popup help" />
        <textarea class='form_text' name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>
      </li>
  
      <li class="formLine">
        <label for="imageformtags" class="formLabelNewLine">Tags:</label>
        <img src="templates/MoaDefault-blue/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="imagetags">" alt="popup help" />
        <input class='form_text image_form_tags' type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);' />
        <span class="tagPopup" id='formtaglistfeedback'>&nbsp;xcxc</span>
      </li>
  
      <li class="formButtonsNewLine">
        <input type='button' value='Submit' id='imageformsubmit' onclick='image.SubmitEdit();'/>
        <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
      </li>
  
      <li id='imageformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag</li>
      </ul>
  </fieldset>
</form>
<div class="new_line height1px">&nbsp;</div>