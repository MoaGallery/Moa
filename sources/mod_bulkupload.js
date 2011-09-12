var LastAction = 
{ 
  none: 0,   
  addImage: 1,  
  getImageList: 2
};

function BulkUpload(p_delimiter, p_fileList)
{
  var that = this;

  var m_delimiter = p_delimiter;
  var m_descexpand = false;
  var m_enabletaglist = false;
  var m_taglist = new TagList( m_delimiter);
  var m_fileList = $.parseJSON( p_fileList);
  var m_count = 0;
  var m_oneFile = 0.0;
  var m_curWidth = 0;
  var m_refreshed = false;

  var m_tags = '';
  var m_desc = '';
  var m_parentID = 0;

  m_taglist.PreLoad(all_tags, cur_tags);
  m_taglist.Feedback('ftp');

  this.RegisterEvents = function()
  {
    $('#ftpformtags').keypress( function (e) {return checkKey(e, 'ftpformsubmit', null);});
    $('#ftpformtags').keyup( function (e) {bulkUpload.TagHintList(this);});
    $('#ftpformexpandlink').click( function (e) {bulkUpload.ExpandClick();});
    $('#ftpformtags').keyup( function (e) {bulkUpload.Feedback(); bulkUpload.TagHintList(this);});
    $('#ftpform').submit(function(){return that.StartAddingFiles();});
    $('#ftprefresh').submit(function(){return that.Refresh();});
  };

  this.Feedback = function()
  {
    m_taglist.Feedback('ftp');
  };

  this.Refresh = function()
  {
    params =  '?action=list';
    
    m_last_action = LastAction.addImage;      
    $.ajax({ url: 'sources/mod_bulkupload.php' + params,
             success: that.AjaxCallback,
             error: that.AjaxCallbackFail,
             cache: false});
    
    return false;
  };

  this.ExpandClick = function()
  {
    if (m_descexpand)
    {
      $('#ftpformdesc').attr('rows', 4);
      $('#ftpformdesc').attr('cols', 37);
      $('#ftpformexpandlink').html('[Expand]');
      m_descexpand = false;
    } else
    {
      $('#ftpformdesc').attr('rows', 14);
      $('#ftpformdesc').attr('cols', 60);
      $('#ftpformexpandlink').html('[Shrink]');
      m_descexpand = true;
    }
  };

  this.TagHintList = function(p_element)
  {
    if (m_enabletaglist)
    {
      m_taglist.TagHintList(p_element);
    }
  };

  this.EnableTagHintList = function(p_element)
  {
    m_enabletaglist = true;
    m_taglist.TagHintList(p_element);
  };

  this.DisableTagHintList = function(p_element)
  {
    m_enabletaglist = false;
    nd();
  };

  this.CreateProgressBar = function()
  {
    var divWidth = 0;

    var text  = '<div id="progressbar-outer" style="position: relative; ">';
    text += '<div id="progressbar-text" style="position: absolute; top: 0; left: 0; "></div>';
    text += '<div id="progressbar-inner" style="width: 0px;">&nbsp;</div></div>';

    $('#ftpprogressbar').html(text);

    divWidth = $('#progressbar-outer').width();
    m_oneFile = divWidth / m_fileList.length;
    m_curWidth = m_oneFile * m_count;
  };

  this.UpdateProgressBar = function()
  {
    if (m_count == m_fileList.length)
    {
      $('#progressbar-text').html('Done');
      $('#progressbar-inner').width(m_fileList.length * m_oneFile);
      $('#ftpprogressbar').delay(10000)
                          .hide(500);
    }
    else
    {
      $('#progressbar-inner').width(m_curWidth);
      $('#progressbar-text').html('Adding file '+m_count+' of '+m_fileList.length);

      var divWidth = $('#progressbar-outer').width();
      var textWidth = $('#progressbar-text').width();

      $('#progressbar-text').css('left', (((divWidth/2)-(textWidth/2)))+'px');
    }
  };

  this.RemoveProgressBar = function()
  {
    $('#ftpprogressbar').html('');
  };

  this.StartAddingFiles = function()
  {
    if (!FormCheck())
    {
      return false;
    }
    
    if (m_fileList.length == 0)
    {
      MoaUI.DisplayFeedback('There are no files to load', Feedback.error);
      return false;
    }

    m_tags = $('#ftpformtags').val();
    m_desc = $('#ftpformdesc').val();
    m_parentID = $('#ftpformparent_id').val();

    m_refreshed = false;
    
    that.CreateProgressBar();

    $('#ftpformsubmit').attr("disabled", true);

    params =  '?action=step';
    params += '&filename='+m_fileList[m_count];
    params += '&parentid='+encodeURIComponent(m_parentID);
    params += '&tags='+encodeURIComponent(m_tags);
    params += '&desc='+encodeURIComponent(m_desc);
    
    m_last_action = LastAction.addImage;      
    $.ajax({ url: 'sources/mod_bulkupload.php' + params,
             success: that.AjaxCallback,
             error: that.AjaxCallbackFail,
             cache: false});
    
    return false;
  };
  
  this.AjaxCallbackFail = function(p_request, p_status, p_errorThrown)
  {
    switch (m_last_action)
    {
      case LastAction.addImage:
      {
        $('#ftpformsubmit').removeAttr("disabled");
        m_refreshed = false;
        break;
      }
      case LastAction.getImageList:
      {
        m_refreshed = false;
        break;
      }
    }
    
    MoaUI.DisplayFeedback( 'Server returned "' + p_request.status + ' ' + p_request.statusText + '".', Feedback.error);
  };
  
  this.AjaxCallback = function(p_result)
  { 
    try
    {
      var result = $.parseJSON(p_result);
    }
    catch(e)
    {
      var error = {status: '', statusText: 'Unknown response from server.'};
      that.AjaxCallbackFail(error);
      return;
    }
    
    if (result.Status == 'SUCCESS')
    {   
      switch (result.Operation)
      {
        case 'ftpGetFileList':
        {
          m_fileList = result.FileList;
          m_count = 0;

          that.RemoveProgressBar();
          $('#ftpcount').html(m_fileList.length);
          $('#ftpformsubmit').removeAttr("disabled");
          m_refreshed = true;
          break;
        }
        case 'ftpAddOneFile':
        {
          if (m_refreshed == false)
          {
            m_curWidth = m_curWidth + m_oneFile;
            m_count++;
            that.UpdateProgressBar();

            $('#ftpcount').html(m_fileList.length - m_count);

            if (m_count == m_fileList.length)
            {
              m_fileList = [];
              m_count = 0;

              $('#ftpformsubmit').removeAttr("disabled");
            } else
            {
              params =  '?action=step';
              params += '&filename='+m_fileList[m_count];
              params += '&parentid='+encodeURIComponent(m_parentID);
              params += '&tags='+encodeURIComponent(m_tags);
              params += '&desc='+encodeURIComponent(m_desc);
              
              m_last_action = LastAction.addImage;      
              $.ajax({ url: 'sources/mod_bulkupload.php' + params,
                       success: that.AjaxCallback,
                       error: that.AjaxCallbackFail,
                       cache: false});
            }
          }
          else
          {
            m_refreshed = false;
          }
          
          break;
        }
      }
    }
    else
    {
      var error = {status: '', statusText: result.Result};
      that.AjaxCallbackFail(error);
    }
  };
  
}