<div class="outline">
  <div class="outlinetitle">component_image_form_add.php</div>
	<form id='imageform' method='post' enctype='multipart/form-data' action='sources/mod_image.php?action=add'>
	  <ul>
		  <dt>
		    File:
		  </dt>
		  <dd>
			  <input type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
			  <input type='hidden' name='imageform' value='true' />
			</dd>

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