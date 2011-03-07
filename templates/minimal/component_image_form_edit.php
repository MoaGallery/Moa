<div class="outline">
  <div class="outlinetitle">component_image_form_edit.php</div>
	<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
	  <fieldset>

      <label for="imageformdesc" class="formLabel">
        <span class="formLabelText">
          Description:<br />
          <a id='imageformexpandlink'>
            [Expand]
          </a>
        </span>
        <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="desc">" />
        <textarea name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>
      </label>      

      <label for="imageformtags" class="formLabel">
        <span class="formLabelText">Tags:</span>
        <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="imagetags">" />
        <input type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
        <span id='formtaglistfeedback'></span>
      </label>

      <input type='button' value='Submit' id='imageformsubmit' class='clearleft' onclick='image.SubmitEdit();'/>
      <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
      <br/>
      <div id='imageformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag</div>
      <div id='imageformupload'>
        &nbsp;
      </div>

	  </fieldset>
	</form>
</div>