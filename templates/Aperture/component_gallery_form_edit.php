<div id="gallery_edit" class="gallery_edit">
  <div class="gallery_edit_bg">
    <dl class="form_items">
      <dt class='form_label_text'>
        Name:
      </dt>
      <dd>
        <input class='form_text gallery_edit_name' type='text' id='galleryformname'/>
        <br/>
      </dd>

      <dt class='form_label_text'>
        Description:
        <a class='admin_link' id='galleryformexpandlink'>
          [Expand]
        </a>
      </dt>
      <dd>
        <textarea class='form_text gallery_name_desc' name='galleryformdesc' id='galleryformdesc' rows='4' cols='45'></textarea>
      </dd>

      <dt class='form_label_text'>
        Tags:
      </dt>
      <dd>
        <input class='form_text gallery_name_tags' type='text' id='galleryformtags' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
        <span id='formtaglistfeedback' class="gallery_name_tag_icon"></span>
        <br/>
      </dd>

      <dt class='form_label_text'>
        Parent gallery:
      </dt>
      <dd>
        <select class="gallery_name_parent" name='parent_id' id='galleryformparent_id'>
          <option value='0000000000'>
            No Parent
          </option>
          <moatag type="GalleryParentComboList">
        </select>
        <br/>
      </dd>

      <dt class='form_label_text'>
        &nbsp
      </dt>
      <dd>
        <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
        <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
      </dd>
    </dl>
  </div>
</div>