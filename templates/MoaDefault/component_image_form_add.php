<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
  <ul class="form_items">
	  <dt class='form_label_text'>
	    File:
	  </dt>
	  <dd>
		  <input class='form_text' type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
		  <input type='hidden' name='imageform' value='true' />
		</dd>

	  <dt>
	    <div id='imageformexpandblock'>
	      <div class='form_label_text'>
	        Description:
	      </div>
	      <a class='admin_link' id='imageformexpandlink'>
	        [Expand]
	      </a>
	    </div>
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
  </ul>
</form>
<div class="new_line height_1px">&nbsp;</div>
