<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
  <input type='hidden' name='imageform' value='true' />

  <div>
    <div id='imageformexpandblock' style='float: left'>
      <div class='form_label_text' style='width: 100px;'>
        Description:
      </div>
      <a class='admin_link' id='imageformexpandlink' style='width:100px;'>
        [Expand]
      </a>
    </div>
    <br\>

    <textarea class='form_text' name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>
  </div>

  <div class='form_label_text' style='width: 100px; float: left;'>
    Tags:
  </div>
  <br\>
  <span>
    <input class='form_text' type='text' name='imageformtags' id='imageformtags' style='width:267px;' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
  </span>
  <span id='formtaglistfeedback'></span>

  <div class='form_label_text' style='height: 10px; width: 100px;'>
    &nbsp;
  </div>
  <input type='button' value='Submit' id='imageformsubmit' onclick='image.SubmitEdit();'/>
  <input type='button' value='Cancel' id='imageformcancel' onclick='image.CancelEdit();'/>
  <br/>
</form>

<div id='imageformupload'>
  &nbsp;
</div>
