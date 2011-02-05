<div class="body_section">
  <div class="left_column left_column_shadow">
    <moatag type="AdminLinks" location="admin">
    <br/>
  </div>
  <div class="right_column right_column_shadow">
    <div class="content_wrapper">
    <h1>
      Upload missing image file
    </h1>
 	    <form id="image_add" method="post" action="index.php?action=admin_maintain_image&amp;image_id=<moatag type="ImageID">" enctype="multipart/form-data">
 	      <fieldset class="formFieldset">
          <ul class="formList">
            <li>
              <label class="formLabelNoIcon">Original filename:</label>
              <span class="staticFormValue"><moatag type="ImageFileName"></span>
            </li>
  
            <li>
              <label for="imageformfilename" class="formLabel">File:</label>
              <img src="templates/Aperture/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="file">" alt="popup help" />
              <input type="hidden" name="FORM_SUBMITTED" value="true"/>
              <input class='form_text image_name_file' type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
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
</div>