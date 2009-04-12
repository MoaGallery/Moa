<br/>
  <div class='form_label_text' style='height: 10px; width: 100px; float: left;'>
    Name:
  </div>
  <span>
    <input class='form_text' type='text' id='galleryformname' style='width:382px;'/>
  </span>
  <br/>

  <div>
    <div id='galleryformexpandblock' style='float: left'>
      <div class='form_label_text' style='width: 100px;'>
        Description:
      </div>
      <a class='admin_link' id='galleryformexpandlink' style='width:100px;'>
        [Expand]
      </a>
    </div>
    <textarea class='form_text' name='galleryformdesc' id='galleryformdesc' rows='4' cols='50'></textarea>
  </div>

  <div class='form_label_text' style='height: 10px; width: 100px; float: left;'>
    Tags:
  </div>
  <span>
    <input class='form_text' type='text' id='galleryformtags' style='width:358px; position: relative; top: -1px;' onmouseover='gallery.EnableTagHintList(this);' onmouseout='gallery.DisableTagHintList(this);'/>
  </span>
  <span id='formtaglistfeedback'></span>
  <br/>

  <div class='form_label_text' style='height: 10px; width: 100px; float: left;'>
    Parent gallery:
  </div>
  <span>
    <select name='parent_id' id='galleryformparent_id' style='width:386px;'>
      <option value='0000000000'>
        Home
      </option>
      <moatag type="GalleryParentComboList">
    </select>
  </span>
  <br/>

  <div class='form_label_text' style='height: 10px; width: 100px; float: left;'>
    &nbsp
  </div>
  <input type='button' value='Submit' id='galleryformsubmit' onclick='gallery.SubmitEdit();'/>
  <input type='button' value='Cancel' id='galleryformcancel' onclick='gallery.CancelEdit();'/>
  <br/>
