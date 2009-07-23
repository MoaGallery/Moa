<div class="pageoutline">
  <div class="outlinetitle">page_admin_maintain_image.php</div>
	<moatag type="AdminLinks">
  <p>
    Upload missing image file
  </p>
  <form id="image_add" method="post" action="index.php?action=admin_maintain_image&image_id=<moatag type="ImageID">" enctype="multipart/form-data">
    <dl>
      <dt>
        Original filename:
      </dt>
      <dd>
        <moatag type="ImageFileName">
      </dd>

      <dt>
        File:
      </dt>
      <dd>
        <input type="hidden" name="FORM_SUBMITTED" value="true"/>
        <input type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
      </dd>

      <br/>
      <br/>

      <dt>
        &nbsp
      </dt>
      <dd>
        <input type='submit' value='Add image' id='imageformsubmit'/>
      </dd>
    </dl>
  </form>
</div>