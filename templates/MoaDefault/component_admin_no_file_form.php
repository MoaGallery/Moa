<form id="image_add" method="post" action="index.php?action=admin_maintain_image&amp;image_id=<moatag type="ImageID">" enctype="multipart/form-data">
  <dl class="form_items">
    <dt class='form_label_text'>
      Original filename:
    </dt>
    <dd>
      <moatag type="ImageFileName">
    </dd>

    <dt class='form_label_text'>
      File:
    </dt>
    <dd>
      <input type="hidden" name="FORM_SUBMITTED" value="true"/>
      <input class='form_text image_name_file' type='file' id='imageformfilename' size='30' name='filename' accept='image/jpg'></input>
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
