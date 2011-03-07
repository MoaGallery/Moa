<div class="pageoutline">
  <div class="outlinetitle">page_admin_maintain_image.php</div>
	<moatag type="AdminLinks" location="admin">
  <p>
    Upload missing image file
  </p>
  <form id="image_add" method="post" action="index.php?action=admin_maintain_image&image_id=<moatag type="ImageID">" enctype="multipart/form-data">
    <fieldset>
      <label class="formLabel">
        <span class="formLabelText">Original filename:</span>
        <moatag type="ImageFileName">
      </label>

      <label for="imageformfilename" class="formLabel">
        <span class="formLabelText">File:</span>
        <img src="templates/minimal/media/help.png" title="<moatag type="FormPopupHelp" field="file">" />
        <input type="hidden" name="FORM_SUBMITTED" value="true"/>
        <input type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
      </label>

      <div class="clearleft">
        <input type='submit' value='Add image' id='imageformsubmit'/>
      </div>
      
      <div id='imageformfilenamecomment' class='invalidfieldcomment invalidfieldstyle'>No file selected.</div>
    </fieldset>
  </form>
</div>