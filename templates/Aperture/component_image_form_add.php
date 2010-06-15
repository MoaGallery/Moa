<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
  <input type='hidden' name='imageform' value='true' />
  <dl class="form_items">

    <dt class='form_label_text'>
      File:
    </dt>
    <dd>
      <input class='form_text image_name_file' type='file' id='imageformfilename' size='30' name='filename'></input>
    </dd>

    <dt class='form_label_text'>
      Description: &nbsp;
      <a class='admin_link' id='imageformexpandlink'>
        [Expand]
      </a>
    </dt>
    <dd>
      <textarea class='form_text image_name_desc' name='imageformdesc' id='imageformdesc' rows='4' cols='45'></textarea>
    </dd>

    <dt class='form_label_text'>
      Tags:
    </dt>
    <dd>
      <input class='form_text image_name_tags' name='imageformtags' type='text' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
      <span id='formtaglistfeedback' class="image_name_tag_icon"></span>
    </dd>
    <br/>

    <dt class='form_label_text'>
      &nbsp
    </dt>
    <dd>
      <input type='button' value='Submit' id='imageformsubmit' onclick='image.SubmitEdit();'/>
      <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
    </dd>
  </dl>
</form>
