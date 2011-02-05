function Image( p_delim)
{
  var that = this;

  var m_image_id;
  var m_desc;
  var m_tags;
  var m_short_desc;
  var m_width;
  var m_height;
  var m_from;
  var m_formobject;

  var m_titles;
  var m_old_desc;
  var m_old_tags;
  var m_edit_toggle = false;
  var m_add_mode = false;
  var m_newlistcount = 0;
  var m_newlist = ['', '', '', '', ''];
  var m_enabletaglist = false;
  var m_descexpand = false;
  var m_delimiter = p_delim;

  var m_taglist = new TagList( m_delimiter);

  var m_parent_url = document.referrer;

  var m_fileList = [];
  var m_count = 0;

  var m_oneFile = 0.0;
  var m_curWidth = 0;

  var m_resend = false;

  var m_submitWording = '';

  this.PreLoad = function(p_image_id, p_desc, p_width, p_height, p_from)
  {
    m_image_id = p_image_id;
    m_desc = p_desc;
    m_width = p_width;
    m_height = p_height;
    m_from = p_from;

    m_short_desc = ShortName(m_desc);
    m_old_desc = '';
    m_old_tags = '';

    m_taglist.PreLoad(all_tags, cur_tags);
    m_tags = m_taglist.StringList();

    if ('' == m_image_id)
    {
      m_add_mode = true;
      m_formobject = new httpForm( 'imageform', 'imageformupload', that.AddCallback, 'image.loaded');
    }
  };

  this.CreateProgressBar = function()
  {
    divWidth = 0;

    text  = "<div id='progressbar-outer' style='position: relative; '>";
    text += "<div id='progressbar-text' style='position: absolute; top: 0; left: 0; '></div>";
    text += "<div id='progressbar-inner' style='width: 0px;'>&nbsp;</div></div>";

    $('#imageblockfeedback').html(text);

    divWidth = $('#progressbar-outer').width();
    m_oneFile = divWidth / m_fileList.length;
    m_curWidth = m_oneFile * m_count;

    that.UpdateProgressBar();
  };

  this.UpdateProgressBar = function()
  {
    if (m_count == m_fileList.length)
    {
      $('#progressbar-text').html('Done');
      $('#progressbar-inner').width(m_fileList.length * m_oneFile);
    }
    else
    {
      $('#progressbar-inner').width(m_curWidth);
      $('#progressbar-text').html('Adding file '+m_count+' of '+m_fileList.length);

      divWidth = $('#progressbar-outer').width();
      textWidth = $('#progressbar-text').width();

      $('#progressbar-text').css('left', (((divWidth/2)-(textWidth/2)))+'px');
    }
  };

  this.RemoveProgressBar = function()
  {
    $('#imageblockfeedback').html('');
  };

  this.UpdateImageCount = function()
  {
    // Only update the header if they are displaying the count
    var hdr_imagecount = document.getElementById('hdr_imagecount');
    if (null != hdr_imagecount)
    {
      var img_count = hdr_imagecount.innerHTML;
      img_count++;
      hdr_imagecount.innerHTML = img_count;
    }
  };

  this.Edit = function()
  {
    if (!m_edit_toggle)
    {
      m_titles = document.getElementById("imageblockinfo").innerHTML;
    	document.getElementById("imageblockinfo").innerHTML = editblock;
    	document.getElementById("imageformdesc").value = str_replace(m_desc, "<br />", "\n");
    	document.getElementById("imageformtags").value = m_taglist.StringList();
    	addEvent(document.getElementById("imageformdesc"), "keypress", function (e) {return checkKey(e, null, "imageformcancel");});
        addEvent(document.getElementById("imageformtags"), "keypress", function (e) {return checkKey(e, "imageformsubmit", "imageformcancel");});
        addEvent(document.getElementById("imageformtags"), "keyup", function (e) {image.Feedback(); image.TagHintList(this);});
        addEvent(document.getElementById("imageformexpandlink"), "click", function (e) {image.ExpandClick();});
    	document.getElementById("imageformdesc").focus();
    	m_taglist.Feedback("image");
    	m_edit_toggle = true;
    	m_add_mode = false;
    }
  };

  this.SubmitEdit = function()
  {
    if (!m_add_mode)
    {
  	  if ("" != m_old_desc)
    	{
    	  alert("An operation is already pending on this Image.");
    	  return;
    	}
  	}

    if (!FormCheck())
    {
      return false;
    }
    
    m_old_desc = m_desc;
    m_old_tags = m_tags;

    m_desc = document.getElementById("imageformdesc").value;
    m_tags = document.getElementById("imageformtags").value;

  	if (!m_add_mode)
    {
  	  m_short_desc = ShortName(m_desc);
  	  that.PageTitle();

  	  that.CancelEdit();
    	document.getElementById("imageblockdesc").innerHTML = EscapeNewLine(EscapeHTMLChars(m_desc));

    	var url =  "action=edit";
    	    url += "&desc="+encodeURIComponent(m_desc);
    	    url += "&tags="+encodeURIComponent(m_tags);
    	    url += "&image_id="+m_image_id;
    	var request = new httpRequest("sources/mod_image.php", that.SubmitCallback, m_image_id);
    	request.update(url, "GET");

    	m_edit_toggle = false;
    } else
    {
      if (m_count > 0)
      {
        $('#imageformsubmit').attr("disabled", true);
        $('#imageformcancel').attr("disabled", true);

        m_resend = true;
        $.ajax({url:"sources/mod_image.php?action=addstep&filename="+m_fileList[m_count]+"&imageformtags="+encodeURIComponent(m_tags)+"&imageformdesc="+encodeURIComponent(m_desc), success: that.StepCallBack, error: that.AddCallbackFail, cache:false});

        return;
      }

      m_formobject.submit("Uploading '"+document.getElementById("imageformfilename").value+"'...");
      document.getElementById("imageform").submit();
      m_formobject.reset();
    }

  	m_taglist.Assimilate(m_tags);
  	
  	return true;
  };

  this.CancelEdit = function()
  {
    if (!m_add_mode)
    {
      document.getElementById("imageblockinfo").innerHTML = m_titles;
      m_edit_toggle = false;
    } else
    {
      window.location = m_parent_url;
    }
    nd();
  };

  this.PageTitle = function()
  {
    title = 'Image';
    if (m_short_desc.length > 0)
    {
      title += " - '";
      title += m_short_desc;
      title += "' - Moa";
    }

    document.title = title;
  };

  this.SubmitRollback = function()
  {
    m_desc = m_old_desc;
    m_tags = m_old_tags;

    $('#imageblockdesc').html(EscapeNewLine(EscapeHTMLChars(m_desc)));

    m_old_desc = '';
    m_old_tags = '';

    m_short_desc = ShortName(m_desc);

    that.PageTitle();
  };

  this.SubmitCallback = function(p_text, p_status, p_xml, p_note)
  {
    if (p_status != 200)
    {
      $('#imageblockfeedback').html(FeedbackBox('Server returned code ' + p_status + '.', false));
      that.SubmitRollback();
      return;
    }
    if ('OK' != p_text.substr(0, 2))
    {
      $('#imageblockfeedback').html(FeedbackBox(p_text, false));
      that.SubmitRollback();
      return;
    }
    m_old_desc = '';
    m_old_tags = '';
  };

  this.UpdateRecentUploads = function(p_filename)
  {
    var fname = p_filename;
    fname += "<br/>\n";

    if (m_newlistcount < 5)
    {
      m_newlist[m_newlistcount] = fname;
      m_newlistcount++;
    }
    else
    {
      m_newlist[0] = m_newlist[1];
      m_newlist[1] = m_newlist[2];
      m_newlist[2] = m_newlist[3];
      m_newlist[3] = m_newlist[4];
      m_newlist[4] = fname;
    }

    document.getElementById("imageformnewlist").innerHTML = "Recently added -<br/>\n";

    for (var i = 0; i < m_newlistcount; i++)
    {
      document.getElementById("imageformnewlist").innerHTML += m_newlist[i];
    }
  };

  this.StepCallBack = function(p_result)
  {
    var crPos = p_result.indexOf("\n") + 1;
    var action = p_result.substring(crPos, crPos + 5);
    var status = p_result.substring(0, crPos - 1);

    if ('OK' != status)
	  {
      feedback = $('#imageblockfeedback').html();
      errorMessage = 'Unknown response from server';
      supressError = false;

      if ((status == 'ERROR') || (status == 'IERROR'))
      {
        if (m_resend)
        {
          if (p_result.indexOf('is not an image') == -1) {
            errorMessage = p_result.substring(crPos);
          }
          else
          {
            supressError = true;
          }
          m_resend = false;
        }
      }
      else
      {
        status = 'ERROR';
      }

      if (!supressError)
      {
        $('#imageblockfeedback').html(feedback+FeedbackBox(status + "\n" + errorMessage), false);
      }
	  } else
	  {
      that.UpdateRecentUploads(m_fileList[m_count]);
      that.UpdateImageCount();
	  }

    m_curWidth = m_curWidth + m_oneFile;
    m_count++;

    that.UpdateProgressBar();

    if (m_count == m_fileList.length)
    {
      m_fileList = [];
      m_count = 0;

      $('#imageformsubmit').attr('value', m_submitWording);

      $('#imageformsubmit').removeAttr("disabled");
      $('#imageformcancel').removeAttr("disabled");
    }
    else
    {
      $.ajax({url:"sources/mod_image.php?action=addstep&filename="+m_fileList[m_count]+"&imageformtags="+encodeURIComponent(m_tags)+"&imageformdesc="+encodeURIComponent(m_desc), success: that.StepCallBack, error: that.AddCallbackFail, cache:false});
	  }
  };

  this.AddCallbackFail = function(p_request, p_status, p_errorThrown)
  {
    $('#imageformsubmit').removeAttr("disabled");
    $('#imageformcancel').removeAttr("disabled");
  };

  this.AddCallback = function(p_result)
  {
    /* Silly hack to keep IE happy with pre formatted text takening from an IFRAME */
    p_result = str_replace(p_result , "<PRE>", "");
    p_result = str_replace(p_result , "</PRE>", "");
    p_result = str_replace(p_result , "<pre>", "");
    p_result = str_replace(p_result , "</pre>", "");

    p_result = str_replace(p_result , "\r", "");

    var crPos = p_result.indexOf("\n") + 1;
    var action = p_result.substring(crPos, crPos + 5);
    var status = p_result.substring(0, crPos - 1);

    if (status != 'OK')
    {
      var feedback = $("#imageblockfeedback").html();
      var errorMessage = 'Unknown response from server';

      if ((status == 'ERROR') || (status == 'IERROR'))
      {
        errorMessage = p_result.substring(crPos);
      }
      else
      {
        status = 'ERROR';
      }

      $('#imageblockfeedback').html(FeedbackBox(status + '\n' + errorMessage), false);
    }
    else
    {
      if (status == "OK")
      {
        m_fileList = json_parse( p_result.substr(3));
        m_count = 1;

        that.UpdateRecentUploads(m_fileList[0]);
        that.UpdateImageCount();

        if (m_fileList.length == 1) {
          feedback = $("#imageblockfeedback").html();

          $('#imageblockfeedback').html(FeedbackBox('Added - ' + m_fileList[0]), true);

          m_fileList = [];
          m_count = 0;

          return;
        }

        that.CreateProgressBar();

        var buttonSubmit = $('#imageformsubmit');
        buttonSubmitText = buttonSubmit.text();
        buttonSubmit.attr('text', '');
        m_submitWording = buttonSubmit.attr('value');
        buttonSubmit.attr('text', buttonSubmitText);
        buttonSubmit.attr('value', 'Continue');

        $('#imageformsubmit').attr("disabled", "true");
        $('#imageformcancel').attr("disabled", "true");

        $.ajax({url:"sources/mod_image.php?action=addstep&filename="+m_fileList[m_count]+"&imageformtags="+encodeURIComponent(m_tags)+"&imageformdesc="+encodeURIComponent(m_desc), success: that.StepCallBack, error: that.AddCallbackFail, cache:false});
      }
    }
  };

  this.Delete = function()
  {
    if (confirm("Are you sure you want to delete this image?"))
    {
      var url = "action=delete&image_id="+m_image_id;
      var request = new httpRequest("sources/mod_image.php", that.DeleteCallback, m_image_id);
      request.update(url, "GET");
    }
  };

  this.DeleteCallback = function(p_text, p_status, p_xml, p_note)
  {
    if (p_status != 200)
    {
      document.getElementById("imageblockfeedback").innerHTML = FeedbackBox("Server returned code " + p_status, false);
      return;
    }
    if ("OK" != p_text.substr(0, 2))
    {
      document.getElementById("imageblockfeedback").innerHTML = FeedbackBox(p_text, false);
      return;
    }

    if (m_from == "orphan")
    {
      document.location = "index.php?action=admin_orphans&deleted=image";
    }
    else
    {
      document.location = "index.php?action=gallery_view&gallery_id=" + m_from + "&deleted=image";
    }
  };

  this.Feedback = function()
  {
    m_taglist.Feedback("image");
  };

  this.FeedbackToggle = function()
  {
    m_taglist.FeedbackToggle();
    m_taglist.Feedback("image");
  };

  this.RegisterEvents = function()
  {
    addEvent(document.getElementById("imageformtags"), "keypress", function (e) {return checkKey(e, "imageformsubmit", null);});
    addEvent(document.getElementById("imageformtags"), "keyup", function (e) {image.Feedback(); image.TagHintList(this);});
    addEvent(document.getElementById("imageformexpandlink"), "click", function (e) {image.ExpandClick();});
    addEvent(document.getElementById("imageformsubmit"), "click", function (e) {image.SubmitEdit();});
  };

  this.PopulateForm = function()
  {
    if (m_add_mode)
    {
      $("#imageformtags").val(m_taglist.StringList());
      $("#imageformdesc").focus();
      that.RegisterEvents();
      m_taglist.Feedback("image");
    } else
    {
      $("#imageformdesc").focus();
      that.RegisterEvents();
      m_taglist.Feedback("image");
    }
  };

  this.loaded = function(p_message)
  {
    m_formobject.loaded(p_message);
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

  this.TagHintList = function(p_element)
  {
    if (m_enabletaglist)
    {
      m_taglist.TagHintList(p_element);
    }
  };

  this.ExpandClick = function()
  {
    if (m_descexpand)
    {
      $("#imageformdesc").attr('rows', 4);
      $("#imageformdesc").attr('cols', 37);
      $("#imageformexpandlink").html("[Expand]");

      m_descexpand = false;
    } else
    {
      $("#imageformdesc").attr('rows', 14);
      $("#imageformdesc").attr('cols', 60);
      $("#imageformexpandlink").html("[Shrink]");

      m_descexpand = true;
    }
  };
}