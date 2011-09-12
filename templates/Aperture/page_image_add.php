<div class="body_section">
  <div class="left_column left_column_shadow">
    <p id="feedback_area"></p>
    <p id="imageprogressbar"></p>
    <p id="imageformnewlist" class="form_label_text recently_added"></p>
    <p id="imageformupload">&nbsp;</p>
  </div>
  <div class="right_column right_column_shadow">
    <h1 class="add_header">
      Add Image
    </h1>
    <div id='imageaddform'>
      <form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
        <fieldset class="formFieldset">
          <input type='hidden' name='imageform' value='true' />
          <input type="hidden" name="imagegalleryid" value="<moatag type="ParentID">" />
          <ul class="formList">
      
            <li>
              <label for="imageformfilename" class="formLabel">File:</label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="file">" alt="popup help" />
              <input class='form_text image_name_file' type='file' id='imageformfilename' size='30' name='filename'></input>
            </li>
        
            <li>
              <label for="imageformdesc" class="formLabel">
                Description: <br />
                <a class='admin_link' id='imageformexpandlink'>
                  [Expand]
                </a>
              </label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="desc">" alt="popup help" />
              <textarea class='form_text image_name_desc' name='imageformdesc' id='imageformdesc' rows='4' cols='45'></textarea>
            </li>
        
            <li>
              <label for="imageformtags" class="formLabel">Tags:</label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="imagetags">" alt="popup help" />
              <input class='form_text image_name_tags' name='imageformtags' type='text' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
              <span id='formtaglistfeedback' class="tagPopup"></span>
            </li>
        
            <li class="formButtons">
              <input type='button' value='Submit' id='imageformsubmit'/>
              <input type='button' value='Cancel' id='imageformcancel'/>
            </li>
            
            <li id='imageformfilenamecomment' class='invalidfieldcomment invalidfieldstyle'>No file selected.</li>
            <li id='imageformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag.</li>
            
          </ul>
        </fieldset>
      </form>
    </div>
  </div>
</div>