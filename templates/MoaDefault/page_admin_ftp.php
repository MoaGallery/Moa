<moatag type="AdminLinks" location="admin">
<div class="mainblock">
  <p class="mainblockheader">
    FTP
  </p>
  <div class="mainblockcontent">
    <div id='ftpfeedback'>
      <moatag type="FTPStatus">
    </div>
    There are currently <moatag type="FTPCount"> image(s) to be added.<br/><br/>

    <form id="ftpform" method="post" action="index.php?action=admin_ftp&amp;pageaction=add" enctype="multipart/form-data">
      <fieldset class="formFieldset">
        <ul class="formList">
          <li>
            <label for="ftpformdesc" class="formLabel">
              Description:
              <a class='admin_link' id='ftpformexpandlink'>
                [Expand]
              </a>
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="ftp_desc">" alt="popup help" />
            <textarea name='ftpformdesc' id='ftpformdesc' rows='4' cols='37'></textarea>
          </li>
  
          <li>
            <label for="ftpformparent_id" class="formLabel">Target gallery:</label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="ftp_parent">" alt="popup help" />
            <select name='ftpformparent_id' id='ftpformparent_id'>
              <option value='blank'></option>
              <moatag type="FtpGalleryComboList">
            </select>
          </li>
  
          <li>
            <label for="ftpformtags" class="formLabel">Additional tags:</label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="ftp_tags">" alt="popup help" />
            <input type='text' class='form_text ftp_form_tags' name='ftpformtags' id='ftpformtags' onmouseover='bulkUpload.EnableTagHintList(this);' onmouseout='bulkUpload.DisableTagHintList(this);'/>
            <span class="tagPopup" id='formtaglistfeedback'></span>
          </li>
  
          <li class="formButtons">
            <input type="submit" value="Add images" id="ftpformsubmit"/>
          </li>
          
          <li id='ftpformparent_idcomment' class='invalidfieldcomment invalidfieldstyle'>You must choose a gallery to upload images to.</li>
        </ul>
      </fieldset>
    </form>
    
    <form id="ftprefresh" method="post" action="index.php?action=admin_ftp" enctype="multipart/form-data">
      <fieldset class="formFieldset">
        <ul class="secondFormList">
          <li class="formButtons">
            <input type="submit" value="Refresh" id="ftprefreshsubmit"/>
          </li>
        </ul>
      </fieldset>
    </form>
  </div>
</div>