<dl class='form_items'>
  <dt class='form_label_text'>
    Name:
  </dt>
  <dd>
    <input class='form_text gallery_form_name' type='text' id='galleryformname'/>
  </dd>

  <dt id='galleryformexpandblock'>
    <span class='form_label_text'>
      Description:
    </span>
    <a class='admin_link' id='galleryformexpandlink'>
      [Expand]
    </a>
  </dt>
  <dd>
    <textarea class='form_text' name='galleryformdesc' id='galleryformdesc' rows='4' cols='50'></textarea>
  </dd>

  <dt class='form_label_text'>
    Tags:
  </dt>
  <dd>
    <input class='form_text gallery_form_tags' type='text' id='galleryformtags' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
    <span id='formtaglistfeedback'></span>
  </dd>

  <dt class='form_label_text'>
    Parent gallery:
  </dt>
  <dd>
    <select name='parent_id' id='galleryformparent_id' class='gallery_form_parent'>
      <option value='0000000000'>
        Home
      </option>
      <moatag type="GalleryParentComboList">
    </select>
  </dd>

  <dt class='form_label_text'>
    &nbsp
  </dt>
  <dd>
    <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
    <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
  </dd>
</dl>