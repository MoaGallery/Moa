<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
  <dl class="form_items">
    <dt id='imageformexpandblock'>
      <span class='form_label_text'>
        Description:
      </span>
      <a class='admin_link' id='imageformexpandlink'>
        [Expand]
      </a>
    </dt>
    <dd>
      <textarea class='form_text' name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>
    </dd>

    <dt class='form_label_text'>
      Tags:
    </dt>
    <dd>
      <input class='form_text image_form_tags' type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
      <span id='formtaglistfeedback'></span>
    </dd>

    <dt class='form_label_text'>
      &nbsp;
    </dt>
    <dd>
      <input type='button' value='Submit' id='imageformsubmit' onclick='image.SubmitEdit();'/>
      <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
      <br/>
      <div id='imageformupload'>
        &nbsp;
      </div>
    </dd>
  </dl>
</form>
<div class="new_line height1px">&nbsp;</div>