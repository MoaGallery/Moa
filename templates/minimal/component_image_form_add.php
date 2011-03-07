<div class="outline">
  <div class="outlinetitle">component_image_form_add.php</div>
	<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>

    <fieldset>
	    <label for="imageformfilename" class="formLabel">
	      <span class="formLabelText">File:</span>
  	    <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="file">" />
  		  <input type='file' id='imageformfilename' size='30' name='filename'></input>
  		  <input type='hidden' name='imageform' value='true' />
  		</label>


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

      <div class="clearleft">
		    <input type='button' value='Submit' id='imageformsubmit'/>
		    <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
		  </div>

      <div id='imageformfilenamecomment' class='invalidfieldcomment invalidfieldstyle'>No file selected.</div>
      <div id='imageformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag.</div>

		  <div id='imageformupload'>
		    &nbsp;
		  </div>
    </fieldset>
	</form>
</div>