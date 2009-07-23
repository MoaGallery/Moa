<div class="outline">
  <div class="outlinetitle">component_image_form_edit.php</div>
	<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
	  <ul>
	    <dt>
	      <div id='imageformexpandblock'>
	        <div>
	          Description:
	        </div>
	        <a id='imageformexpandlink'>
	          [Expand]
	        </a>
	      </div>
	    </dt>
	    <dd>
	      <textarea name='imageformdesc' id='imageformdesc' rows='4' cols='37'></textarea>
	    </dd>

	    <dt>
	      Tags:
	    </dt>
	    <dd>
	      <input type='text' name='imageformtags' id='imageformtags' onmouseover='image.EnableTagHintList(this);' onmouseout='image.DisableTagHintList(this);'/>
	      <span id='formtaglistfeedback'></span>
	    </dd>

	    <dt>
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
</div>