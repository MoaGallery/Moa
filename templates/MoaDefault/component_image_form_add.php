<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
  <fieldset class="formFieldset">
    <ul class="formList">
      <li>
        <label for="imageformfilename" class="formLabel">File:</label>
        <img src="templates/MoaDefault/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="file">" alt="popup help" />
    	  <input class='form_text' type='file' id='imageformfilename' size='30' name='filename'></input>
    	  <input type='hidden' name='imageform' value='true' />
    	</li>
  
      <li>
    	  <label for="imageformdesc" class="formLabel">
    	    Description:<br />
    	    <a class='admin_link' id='imageformexpandlink'>
    	      [Expand]
    	    </a>
    	  </label>
    	  <img src="templates/MoaDefault/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="desc">" alt="popup help" />
        <textarea class='form_text' name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>
      </li>
  
      <li>
    	  <label for="imageformtags" class="formLabel">Tags:</label>
        <img src="templates/MoaDefault/media/help.png" width="16" height="16" class="popupImage" title="<moatag type="FormPopupHelp" field="imagetags">" alt="popup help" />
        <input class='form_text image_form_tags' type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
    	  <span class="tagPopup" id='formtaglistfeedback'>&nbsp;</span>
    	</li> 
  
  	  <li class="formButtons">
  		  <input type='button' value='Submit' id='imageformsubmit'/>
  		  <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
      </li>
      
      <li id='imageformupload'>
        &nbsp;
      </li>
      
      <li id='imageformfilenamecomment' class='invalidfieldcomment invalidfieldstyle'>No file selected.</li>
      <li id='imageformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag.</li>
    </ul>
  </fieldset>
</form>
<div class="new_line height_1px">&nbsp;</div>
