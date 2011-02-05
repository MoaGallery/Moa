<moatag type="AdminLinks" location="admin">
<div class="admin_maintain_image_container">
  <p class="mainblockheader">
    Upload missing image file
  </p>
  <div class="mainblockcontent">
    <form id="image_add" method="post" action="index.php?action=admin_maintain_image&amp;image_id=<moatag type="ImageID">" enctype="multipart/form-data">
      <fieldset class="formFieldset">
        <ul class="formList">
          <li>
            <label class="formLabelNoIcon">Original name:</label>
            <moatag type="ImageFileName">
          </li>
  
          <li>
            <label for="imageformfilename" class="formLabel">File:</label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="file">" alt="popup help" />
            <input type="hidden" name="FORM_SUBMITTED" value="true"/>
            <input class='form_label_text' type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
          </li>

          <li class="formButtons">
            <input type='submit' value='Add image' id='imageformsubmit'/>
          </li>
          
          <li id='imageformfilenamecomment' class='invalidfieldcomment invalidfieldstyle'>No file selected.</li>
        </ul>
      </fieldset>
    </form>
  </div>
</div>
