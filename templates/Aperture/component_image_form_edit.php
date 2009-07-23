<div id="image_edit" "class="image_edit">
  <div class="image_edit_bg">
    <dl class="form_items">
      <dt class='form_label_text'>
        Description:
        <a class='admin_link' id='imageformexpandlink'>
          &nbsp;&nbsp;[Expand]
        </a>
      </dt>
      <dd>
        <textarea class='form_text image_name_desc' name='imageformdesc' id='imageformdesc' rows='4' cols='45'></textarea>
      </dd>

      <dt class='form_label_text'>
        Tags:
      </dt>
      <dd>
        <input class='form_text image_name_tags' type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
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
  </div>
</div>