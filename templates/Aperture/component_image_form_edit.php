<div id="image_edit" class="image_edit">
  <div class="image_edit_bg">
    <fieldset class="formFieldset">
      <ul class="formList">
        <li>
          <label for="imageformdesc" class="formLabelNewLine">
            Description:
            <a class='admin_link' id='imageformexpandlink'>
              &nbsp;&nbsp;[Expand]
            </a>
          </label>
          <img src="templates/Aperture/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="desc">" alt="popup help" />
          <textarea class='form_text image_name_desc' name='imageformdesc' id='imageformdesc' rows='4' cols='45'></textarea>
        </li>
  
        <li>
          <label for="imageformtags" class="formLabelNewLine">
            Tags:
          </label>
          <img src="templates/Aperture/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="imagetags">" alt="popup help" />
          <input class='form_text image_name_tags' type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
          <span id='formtaglistfeedback' class="image_name_tag_icon"></span>
        </li>
  
        <li class="formButtonsNewLine">
          <input type='button' value='Submit' id='imageformsubmit'/>
          <input type='button' value='Cancel' id='imageformcancel'/>
        </li>
        
        <li id='imageformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag</li>
      </ul>
    </fieldset>
  </div>
</div>