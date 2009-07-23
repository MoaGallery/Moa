<moatag type="AdminLinks">
<div class="testbox_tl admin_maintain_image_container">
  <div class="testbox_tr">
    <div class="testbox_bl">
      <div class="testbox_br">
        <p class="testboxheader">Upload missing image file</p>
        <div class="testboxcontent">
     	    <form id="image_add" method="post" action="index.php?action=admin_maintain_image&image_id=<moatag type="ImageID">" enctype="multipart/form-data">
            <dl class="form_items">
              <dt class='form_label_text'>
                Original filename:
              </dt>
              <dd class='form_label_text'>
                <moatag type="ImageFileName">
              </dd>

              <dt class='form_label_text'>
                File:
              </dt>
              <dd>
                <input type="hidden" name="FORM_SUBMITTED" value="true"/>
                <input class='form_label_text' type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
              </dd>

              <br/>
              <br/>

              <dt class='form_label_text'>
                &nbsp
              </dt>
              <dd>
                <input type='submit' value='Add image' id='imageformsubmit'/>
              </dd>
            </dl>
    	    </form>
    	  </div>
      </div>
    </div>
  </div>
</div>
