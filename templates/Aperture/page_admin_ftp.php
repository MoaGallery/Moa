<div class="body_section">
  <div class="left_column left_column_shadow">
    <moatag type="AdminLinks" location="admin">
    <br/>
    <div id='ftpfeedback'>
      <moatag type="FTPStatus">
    </div>
  </div>
  <div class="right_column right_column_shadow">
    <div class="content_wrapper">

    <h1>
      FTP
    </h1>

    <span class="ftp_count_message">
      There are currently <moatag type="FTPCount"> image(s) to be added.<br/>
    </span>
    <br/>

    <form id="ftpform" method="post" action="index.php?action=admin_ftp&amp;pageaction=add" enctype="multipart/form-data">
      <dl class="form_items">
        <dt class='form_label_text'>
          Description: &nbsp;
          <a class='admin_link' id='ftpformexpandlink'>
            [Expand]
          </a>
        </dt>
        <dd>
          <textarea name='ftpformdesc' class='form_text image_name_desc' id='ftpformdesc' rows='4' cols='37'></textarea>
        </dd>
  
        <dt class='form_label_text'>
          Target gallery:
        </dt>
        <dd>
          <select name='ftpformparent_id' id='ftpformparent_id'>
            <option value='blank'></option>
            <moatag type="FtpGalleryComboList">
          </select>
        </dd>
        
        <dt class='form_label_text'>
          Additional tags:
        </dt>
        <dd>
          <input type='text' class='form_text ftp_tags' name='ftpformtags' id='ftpformtags' onmouseover='bulkUpload.EnableTagHintList(this);' onmouseout='bulkUpload.DisableTagHintList(this);'/>
          <span id='formtaglistfeedback'  class="image_name_tag_icon">&nbsp;</span>
        </dd>
  
        <dt class='form_label_text'>
        </dt>
        <dd>
          <br/>
          <input type="submit" value="Add images" id="ftpformsubmit"/>
        </dd>
      </dl>
    </form>
    <br/>
    <form id="ftprefresh" method="post" action="index.php?action=admin_ftp" enctype="multipart/form-data">
       <input type="submit" value="Refresh" id="ftprefreshsubmit" class="ftp_refresh_button"/>
    </form>
    </div>
  </div>
</div>