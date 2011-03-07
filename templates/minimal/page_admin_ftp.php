<div class="pageoutline">
  <div class="outlinetitle">page_admin_ftp.php</div>
  <moatag type="AdminLinks" location="admin">

  <h1>FTP </h1>
  <div id='ftpfeedback'>
    <moatag type="FTPStatus">
  </div>
  There are currently <moatag type="FTPCount"> image(s) to be added.<br/>
  
  <form id="ftpform" method="post" action="index.php?action=admin_ftp&pageaction=add" enctype="multipart/form-data">
    <fieldset>
      <dt>
        <div id='ftpformexpandblock'>
          <div>
            Description:
          </div> 
          <a id='ftpformexpandlink'>
            [Expand]
          </a>
        </div>
      </dt>
      <dd>
        <textarea name='ftpformdesc' id='ftpformdesc' rows='4' cols='37'></textarea>
      </dd>

      <dt>
        Target gallery:
      </dt>
      <dd>
        <select name='ftpformparent_id' id='ftpformparent_id'>
          <option value='blank'></option>
          <moatag type="FtpGalleryComboList">
        </select>
      </dd>
      
      <dt>
        Additional tags:
      </dt>
      <dd>
        <input type='text' name='ftpformtags' id='ftpformtags' onmouseover='bulkUpload.EnableTagHintList(this);' onmouseout='bulkUpload.DisableTagHintList(this);'/>
        <span id='formtaglistfeedback'></span>
      </dd>

      <dt>
      </dt>
      <dd>
        <input type="submit" value="Add images" id="ftpformsubmit"/>        
      </dd>
    </fieldset>
  </form>
  <form id="ftprefresh" method="post" action="index.php?action=admin_ftp" enctype="multipart/form-data">     
     <input type="submit" value="Refresh" id="ftprefreshsubmit"/>         
  </form>
</div>