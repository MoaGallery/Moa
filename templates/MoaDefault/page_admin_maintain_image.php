<moatag type="AdminLinks">
<br/>
<div class="testbox_tl" style="display: table-cell;">
  <div class="testbox_tr">
    <div class="testbox_bl">
      <div class="testbox_br">
        <div class="testboxheader">
          Upload missing image file
        </div>
        <div class="testboxcontent">
     	    <form id="image_add" method="post" action="index.php?action=admin_maintain_image&image_id=<moatag type="ImageID">" enctype="multipart/form-data">
    	      <div id="debug">
    	      </div>
    	      <table cellpadding="5" border=0>
    	        <tr>
    	           <td class="form_label_text">
    	             Original Filename:
    	           </td>
    	           <td class="form_label_text">
    	             <moatag type="ImageFileName">
    	           </td>
    	        </tr>
    	        <tr>
    	           <td class="form_label_text">
    	             Description:
    	           </td>
    	           <td class="form_label_text">
    	             <moatag type="ImageDescription">
    	           </td>
    	        </tr>
    	        <tr>
    	          <td class="form_label_text">File:</td>
    	          <td>
    	            <input type="hidden" name="FORM_SUBMITTED" value="true"/>
    	            <input type="file" id="file_dlg" size="30" name="filename"  class="form_label_text"accept="image/jpg"></input>
    	            <br/>
    	          </td>
    	        </tr>
    	        <tr>
    	          <td colspan="2">
    	            <input type='submit' value='Add Image'></input>
    	          </td>
    	        </tr>
    	      </table>
    	    </form>
    	  </div>
      </div>
    </div>
  </div>
</div>
