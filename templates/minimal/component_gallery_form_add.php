<div class="outline">
  <div class="outlinetitle">component_gallery_form_add.php</div>
  
  <fieldset>
    <label for="galleryformname" class="formLabel">
      <span class="formLabelText">Name:</span>
      <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="gal_name">" />
      <input type='text' id='galleryformname'/>
    </label>
  
    <label for="galleryformdesc" class="formLabel">
      <span class="formLabelText">
        Description:<br />
        <a id='galleryformexpandlink'>
          [Expand]
        </a>
      </span>
      <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="gal_desc">" />
      <textarea name='galleryformdesc' id='galleryformdesc' rows='4' cols='50'></textarea>
    </label>

    <label for="galleryformtags" class="formLabel">
      <span class="formLabelText">Tags:</span>
      <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="gal_tags">" />
      <input type='text' id='galleryformtags' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
      <span id='formtaglistfeedback'></span>
    </label>

    <label for="galleryformparent_id" class="formLabel">
      <span class="formLabelText">Parent gallery:</span>
      <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="gal_parent">" />
      <select name='parent_id' id='galleryformparent_id'>
        <option value='0000000000'>
          Home
        </option>
        <moatag type="GalleryParentComboList">
      </select>
    </label>

    <div class="clearleft">
      <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
      <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
    </div>
    
    <div id='galleryformnamecomment' class='invalidfieldcomment invalidfieldstyle'>The gallery must have a name.</div>
    <div id='galleryformtagscomment' class='invalidfieldcomment invalidfieldstyle'>You must supply at least one tag.</div>
  </fieldset>