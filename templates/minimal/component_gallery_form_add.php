<div class="outline">
  <div class="outlinetitle">component_gallery_form_add.php</div>
<dl>
  <dt>
    Name:
  </dt>
  <dd>
    <input type='text' id='galleryformname'/>
  </dd>

  <dt>
    <div id='galleryformexpandblock'>
      Description:
      <a id='galleryformexpandlink'>
        [Expand]
      </a>
    </div>
  </dt>
  <dd>
    <textarea name='galleryformdesc' id='galleryformdesc' rows='4' cols='50'></textarea>
  </dd>

  <dt>
    Tags:
  </dt>
  <dd>
    <input type='text' id='galleryformtags' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
    <span id='formtaglistfeedback'></span>
  </dd>

  <dt>
    Parent gallery:
  </dt>
  <dd>
    <select name='parent_id' id='galleryformparent_id'>
      <option value='0000000000'>
        Home
      </option>
      <moatag type="GalleryParentComboList">
    </select>
  </dd>

  <dt>
    &nbsp
  </dt>
  <dd>
    <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
    <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
  </dd>
</dl>