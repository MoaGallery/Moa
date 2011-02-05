function BulkUpload(p_delimiter, p_fileList)
{
  var that = this;

  var m_delimiter = p_delimiter;
  var m_descexpand = false;
  var m_enabletaglist = false;
  var m_taglist = new TagList( m_delimiter);
  var m_fileList = json_parse( p_fileList);
  var m_count = 0;
  var m_oneFile = 0.0;
  var m_curWidth = 0;
  var m_refreshed = false;

  var m_tags = '';
  var m_desc = '';
  var m_parentID = 0;

  m_taglist.PreLoad(all_tags, cur_tags);
  m_taglist.Feedback("ftp");

  this.RegisterEvents = function()
  {
    addEvent(document.getElementById("ftpformtags"), "keypress", function (e) {return checkKey(e, "ftpformsubmit", null);});
    addEvent(document.getElementById("ftpformtags"), "keyup", function (e) {bulkUpload.TagHintList(this);});
    addEvent(document.getElementById("ftpformexpandlink"), "click", function (e) {bulkUpload.ExpandClick();});
    addEvent(document.getElementById("ftpformtags"), "keyup", function (e) {bulkUpload.Feedback(); bulkUpload.TagHintList(this);});

    $("#ftpform").submit(function(){return that.StartAddingFiles();});
    $("#ftprefresh").submit(function(){return that.Refresh();});
  };

  this.Feedback = function()
  {
    m_taglist.Feedback("ftp");
  };

  this.Refresh = function()
  {
    $.ajax({url:"sources/mod_bulkupload.php?action=list", success: that.ListCallback, error: that.ListCallbackFail, cache:false});
    return false;
  };

  this.ExpandClick = function()
  {
    if (m_descexpand)
    {
      document.getElementById("ftpformdesc").rows = 4;
      document.getElementById("ftpformdesc").cols = 37;
      document.getElementById("ftpformexpandlink").innerHTML = "[Expand]";
      m_descexpand = false;
    } else
    {
      document.getElementById("ftpformdesc").rows = 14;
      document.getElementById("ftpformdesc").cols = 60;
      m_descexpand = true;
      document.getElementById("ftpformexpandlink").innerHTML = "[Shrink]";
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

  this.ListCallback = function(p_result)
  {
    var s = p_result.split('\n');

    if (s[0] == 'OK')
    {
      m_fileList = json_parse( s[1]);
      m_count = 0;

      that.RemoveProgressBar();
      $('#ftpcount').html(m_fileList.length);
      $('#ftpformsubmit').removeAttr("disabled");
      m_refreshed = true;
    }
    else
    {
      $("#ftpfeedback").html(FeedbackBox("ERROR\nCannot refresh", false));
      m_refreshed = false;
    }
  };

  this.ListCallbackFail = function(p_request, p_status, p_errorThrown)
  {
    $("#ftpfeedback").html(FeedbackBox("ERROR\nRefresh failed with status '" + p_status + "'", false));
    m_refreshed = false;
  };

  this.CreateProgressBar = function()
  {
    var divWidth = 0;

    var text  = '<div id="progressbar-outer" style="position: relative; ">';
    text += '<div id="progressbar-text" style="position: absolute; top: 0; left: 0; "></div>';
    text += '<div id="progressbar-inner" style="width: 0px;">&nbsp;</div></div>';

    $("#ftpfeedback").html(text);

    divWidth = $("#progressbar-outer").width();
    m_oneFile = divWidth / m_fileList.length;
    m_curWidth = m_oneFile * m_count;
  };

  this.UpdateProgressBar = function()
  {
    if (m_count == m_fileList.length)
    {
      $("#progressbar-text").html("Done");
      $("#progressbar-inner").width(m_fileList.length * m_oneFile);
    }
    else
    {
      $("#progressbar-inner").width(m_curWidth);
      $("#progressbar-text").html('Adding file '+m_count+' of '+m_fileList.length);

      var divWidth = $("#progressbar-outer").width();
      var textWidth = $("#progressbar-text").width();

      $("#progressbar-text").css('left', (((divWidth/2)-(textWidth/2)))+'px');
    }
  };

  this.RemoveProgressBar = function()
  {
    $("#ftpfeedback").html('');
  };

  this.StartAddingFiles = function()
  {
    if (!FormCheck())
    {
      return false;
    }
    
    if (m_fileList.length == 0)
    {
      $("#ftpfeedback").html(FeedbackBox("ERROR\nThere are no files to load", false));
      return false;
    }

    m_tags = $('#ftpformtags').val();
    m_desc = $('#ftpformdesc').val();
    m_parentID = $('#ftpformparent_id').val();

    that.AddOneImage("OK\nStart");
    return false;
  };

  this.AddImageFail = function(p_request, p_status, p_errorThrown)
  {
    $('#ftpformsubmit').removeAttr("disabled");

    m_refreshed = false;
    $("#ftpfeedback").html(FeedbackBox("ERROR\nAdd image failed with status '" + p_status + "'", false));
  };

  //TODO: Restructure this function as it has duplicate code in it
  this.AddOneImage = function(p_result)
  {
    var crPos = p_result.indexOf('\n') + 1;
    var action = p_result.substring(crPos, crPos + 5);
    var status = p_result.substring(0, crPos - 1);

    if (status != 'OK')
    {
      var feedback = $("#ftpfeedback").html();
      var errorMessage = 'Unknown response from server';

      if ((status == 'ERROR') || (status == 'IERROR'))
      {
        errorMessage = p_result.substring(crPos);
      }
      else
      {
        status = 'ERROR';
      }

      $('#ftpformsubmit').removeAttr("disabled");
      $('#ftpfeedback').html(feedback+FeedbackBox(status + "\n" + errorMessage), false);
    }
    else
    {
      switch (action)
      {
        case "Start":
        {
          m_refreshed = false;
          that.CreateProgressBar();

          $('#ftpformsubmit').attr("disabled", true);

          $.ajax({url:"sources/mod_bulkupload.php?action=step&filename="+m_fileList[m_count]+"&parentid="+encodeURIComponent(m_parentID)+"&tags="+encodeURIComponent(m_tags)+"&desc="+encodeURIComponent(m_desc), success: that.AddOneImage, error: that.AddImageFail, cache:false});
          break;
        }
        case "Added":
        {
          if (m_refreshed == false)
          {
            m_curWidth = m_curWidth + m_oneFile;
            m_count++;

            $('#ftpcount').html(m_fileList.length - m_count);

            that.UpdateProgressBar();
            if (m_count == m_fileList.length)
            {
              m_fileList = [];
              m_count = 0;

              $('#ftpformsubmit').removeAttr("disabled");

              break;
            }

            $.ajax({url:"sources/mod_bulkupload.php?action=step&filename="+m_fileList[m_count]+"&parentid="+encodeURIComponent(m_parentID)+"&tags="+encodeURIComponent(m_tags)+"&desc="+encodeURIComponent(m_desc), success: that.AddOneImage, error: that.AddImageFail, cache:false});
            break;
          }
          else {
            m_refreshed = false;
            break;
          }
        }
        default:
        {
          var feedback = $("#ftpfeedback").html();
          $("#ftpfeedback").html(feedback+FeedbackBox("ERROR\nUnknown response from server", false));
          break;
        }
      }
    }

    return false;
  };
}