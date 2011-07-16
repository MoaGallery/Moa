<fieldset class="formFieldset">
  <ul class="formList">
    <li>
      <label for="galleryformname" class="formLabel">Name:</label>
      <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="gal_name">" alt="popup help" />
      <input class='form_text gallery_form_name' type='text' id='galleryformname'/>
    </li>
  
    <li>
      <label for="galleryformdesc" class="formLabel">
        Description:
        <a class='admin_link' id='galleryformexpandlink'>
          [Expand]
        </a>
      </label>
      <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="gal_desc">" alt="popup help" />
      <textarea class='form_text' name='galleryformdesc' id='galleryformdesc' rows='4' cols='50'></textarea>
    </li>
  
    <li>
      <label for="galleryformtags" class="formLabel">Tags:</label>
      <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="gal_tags">" alt="popup help" />
      <input class='form_text gallery_form_tags' type='text' id='galleryformtags' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
      <span id='formtaglistfeedback'></span>
    </li>
  
    <li>
      <label for="galleryformparent_id" class="formLabel">Parent gallery:</label>
      <img src="templates/MoaDefault-blue/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="gal_parent">" alt="popup help" />
      <select name='parent_id' id='galleryformparent_id' class='gallery_form_parent'>
        <option value='0000000000'>
          Home
        </option>
        <moatag type="GalleryParentComboList">
      </select>
    </li>
    
    <li>
      <label for="galleryformtagged" class="formLabel">Tagged gallery:</label>
      <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="gal_tagged">" alt="popup help" />
      <input class='form_text gallery_form_tagged' type='checkbox' id='galleryformtagged' />
    </li>
  
    <li class="formButtons">
      <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
      <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
    </li>
    
    <li id='galleryformnamecomment' class='invalidfieldcomment invalidfieldstyle'>The gallery must have a name.</li>
    <li id='galleryformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag.</li>
  </ul>
</fieldset>