<div id="gallery_edit" class="gallery_edit">
  <div class="gallery_edit_bg">
    <fieldset class="formFieldset">
      <ul class="formList">
        <li>
          <label for="galleryformname" class="formLabelNewLine">
            Name:
          </label>
          <img src="templates/Aperture/media/help.png" class="popupImage" width="16" height="16" title="<moatag type="FormPopupHelp" field="gal_name">" alt="popup help" />
          <input class='form_text gallery_edit_name cleared' type='text' id='galleryformname'/>
        </li>
  
        <li>
          <label for="galleryformdesc" class="formLabelNewLine">
            Description:
            <a class='admin_link' id='galleryformexpandlink'>
              [Expand]
            </a>
          </label>
          <img src="templates/Aperture/media/help.png" class="popupImage" width="16" height="16" title="<moatag type="FormPopupHelp" field="gal_desc">" alt="popup help" />
          <textarea class='form_text gallery_name_desc' name='galleryformdesc' id='galleryformdesc' rows='4' cols='45'></textarea>
        </li>
  
        <li>
          <label for="galleryformtags" class="formLabelNewLine">Tags:</label>
          <img src="templates/Aperture/media/help.png" class="popupImage" width="16" height="16" title="<moatag type="FormPopupHelp" field="gal_tags">" alt="popup help" />
          <input class='form_text gallery_name_tags' type='text' id='galleryformtags' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
          <span id='formtaglistfeedback' class="gallery_name_tag_icon"></span>
        </li>
  
        <li>
          <label for="galleryformparent_id" class="formLabelNewLine">Parent gallery:</label>
          <img src="templates/Aperture/media/help.png" class="popupImage" width="16" height="16" title="<moatag type="FormPopupHelp" field="gal_parent">" alt="popup help" />
          <select class="gallery_name_parent" name='parent_id' id='galleryformparent_id'>
            <option value='0000000000'>
              No Parent
            </option>
            <moatag type="GalleryParentComboList">
          </select>
        </li>
        
        <li>
          <label for="galleryformtagged" class="formLabelNewLine">Tagged gallery:</label>
          <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="gal_tagged">" alt="popup help" />
          <input class='form_text gallery_form_tagged' type='checkbox' id='galleryformtagged' />
        </li>
  
        <li class="formButtonsLeft">
          <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
          <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
        </li>
        
        <li id='galleryformnamecomment' class='invalidfieldcomment invalidfieldstyle'>The gallery must have a name.</li>
        <li id='galleryformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag.</li>
      </ul>
    </fieldset>
  </div>
</div>