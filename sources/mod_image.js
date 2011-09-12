var LastAction = 
{ 
  none: 0,   
  addImage: 1,  
  editImage: 2,
  deleteImage: 3
};

function resStruct()
{
  var Status = '';
  var Result = '';
}

function Image( p_delim)
{
  var that = this;

  var m_image_id;
  var m_desc;
  var m_tags;
  var m_short_desc;
  var m_width;
  var m_height;
  var m_parent_id;
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
  var m_lastAction = LastAction.none;

  this.PreLoad = function(p_image_id, p_desc, p_width, p_height, p_parent_id)
  {
    m_image_id = p_image_id;
    m_desc = p_desc;
    m_width = p_width;
    m_height = p_height;
    m_parent_id = p_parent_id;

    m_short_desc = ShortName(m_desc);
    m_old_desc = '';
    m_old_tags = '';

    m_taglist.PreLoad(all_tags, cur_tags);
    m_tags = m_taglist.StringList();
    
    if ('' == m_image_id)
    {
      m_add_mode = true;
      m_formobject = new httpForm( 'imageform', 'imageformupload', image.AjaxCallback, image.loaded);
    }
  };

  this.CreateProgressBar = function()
  {
    divWidth = 0;

    text  = "<div id='progressbar-outer' style='position: relative; '>";
    text += "<div id='progressbar-text' style='position: absolute; top: 0; left: 0; '></div>";
    text += "<div id='progressbar-inner' style='width: 0px;'>&nbsp;</div></div>";

    $('#imageprogressbar').html(text);

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
   
  this.Edit = function()
  {
    if (!m_edit_toggle)
    {
      m_titles = $('#imageblockinfo').html();
      $('#imageblockinfo').html( editblock);
      $('#imageformdesc').val( str_replace(m_desc, "<br />", "\n"));
      $('#imageformtags').val( m_taglist.StringList());
           
      $('#imageformdesc').keypress( function (e) {return checkKey(e, null, "imageformcancel");});
      $('#imageformtags').keypress( function (e) {return checkKey(e, "imageformsubmit", "imageformcancel");});
      $('#imageformtags').keyup( function (e) {image.Feedback(); if (m_enabletaglist) {image.TagHintList(this);};});
      $('#imageformexpandlink').click( function (e) {image.ExpandClick();});
      $('#imageformsubmit').click( function (e) {image.SubmitEdit();});
      $('#imageformcancel').click( function (e) {image.CancelEdit();});
      $('#imageformdesc').focus();
      
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

    m_desc = $('#imageformdesc').val();
    m_tags = $('#imageformtags').val();
    if (!m_add_mode)
    {
  	  m_short_desc = ShortName(m_desc);
  	  MoaUI.PageTitle('Image', m_short_desc);

  	  that.CancelEdit();
  	  $('#imageblockdesc').html( EscapeNewLine(EscapeHTMLChars(m_desc)));

    	var params =  "action=edit";
    	params += "&desc="+encodeURIComponent(m_desc);
    	params += "&tags="+encodeURIComponent(m_tags);
    	params += "&image_id="+m_image_id;
    	
    	m_lastAction = LastAction.editImage;      
      $.ajax({ url: 'sources/mod_image.php',
               data: params,
               type: 'POST',
               success: that.AjaxCallback,
               error: that.AjaxCallbackFail,
               cache: false});

    	m_edit_toggle = false;
    } else
    {
      console.log("ff");
      if (m_count > 0)
      {
        console.log("ff");
        $('#imageformsubmit').attr("disabled", true);
        $('#imageformcancel').attr("disabled", true);

        m_resend = true;
        
        var params = "action=addstep";
        params += "&filename="+m_fileList[m_count];
        params += "&parentid="+encodeURIComponent(m_parent_id);
        params += "&imageformtags="+encodeURIComponent(m_tags);
        params += "&imageformdesc="+encodeURIComponent(m_desc);
        
        m_last_action = LastAction.addGallery;
        $.ajax({ url: 'sources/mod_image.php',
                 data: params,
                 type: 'POST',
                 success: that.AjaxCallback,
                 error: that.AjaxCallbackFail,
                 cache: false});
        return;
      }

      m_formobject.submit("Uploading '"+$('#imageformfilename').val()+"'...");
      $('#imageform').submit();
      m_formobject.reset();
    }

  	m_taglist.Assimilate(m_tags);
  	
  	return true;
  };

  this.CancelEdit = function()
  {
    if (!m_add_mode)
    {
      $('#imageblockinfo').html( m_titles);
      m_edit_toggle = false;
    } else
    {
      window.location = m_parent_url;
    }
    nd();
  };

  this.AjaxCallback = function(p_result)
  { 
    if (null === p_result)
    {
      return;
    }
    
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
        case 'ImageAdd':
        {
          m_fileList = result.FileList;
          m_count = 1;

          that.UpdateRecentUploads(m_fileList[0]);
          MoaUI.HeaderImageCountAdd(1);

          if (m_fileList.length == 1)
          {
            feedback = $("#imageblockfeedback").html();
            
            MoaUI.DisplayFeedback("Added - "+m_fileList[0], Feedback.success);

            m_fileList = [];
            m_count = 0;
          } else
          {
            that.CreateProgressBar();
  
            var buttonSubmit = $('#imageformsubmit');
            buttonSubmitText = buttonSubmit.text();
            buttonSubmit.attr('text', '');
            m_submitWording = buttonSubmit.attr('value');
            buttonSubmit.attr('text', buttonSubmitText);
            buttonSubmit.attr('value', 'Continue');
            
            $('#imageformsubmit').attr("disabled", "true");
            $('#imageformcancel').attr("disabled", "true");
            
            var params = "action=addstep";
            params +=    "&filename="+m_fileList[m_count];
            params +=    "&imagegalleryid="+encodeURIComponent(m_parent_id);
            params +=    "&imageformtags="+encodeURIComponent(m_tags);
            params +=    "&imageformdesc="+encodeURIComponent(m_desc);
            
            $.ajax({
                    success: that.AjaxCallback, 
            				error: that.AjaxCallbackFail, 
            				cache:false,
            				url:"sources/mod_image.php",
            				data: params,
            				type: 'POST'
            			 });
          }
          break;
        }
        case 'ImageEdit':
        {
          var tagsChanged = false;
          if (m_old_tags != m_tags)
          {
            tagsChanged = true;
          }
          
          m_old_desc = '';
          m_old_tags = '';
          
          if (tagsChanged)
          {
            $.ajax({url:"sources/mod_image.php?action=getinfotags&image_id="+encodeURIComponent(m_image_id), success: that.AjaxCallback, error: that.AjaxCallbackFail, cache:false});
            $.ajax({url:"sources/mod_image.php?action=getinfogalleries&image_id="+encodeURIComponent(m_image_id), success: that.AjaxCallback, error: that.AjaxCallbackFail, cache:false});
          }
          break;
        }
        case 'ImageDelete':
        {
          if (m_parent_id == "orphan")
          {
            document.location = "index.php?action=admin_orphans&deleted=image";
          }
          else
          {
            document.location = "index.php?action=gallery_view&gallery_id=" + m_parent_id + "&deleted=image";
          }
          break;
        }
        case 'GetTags':
        {
          var tags = result.Tags;    
          $('#image_tag_list').html(tags);
          break;
        }
        case 'GetGalleries':
        {
          var galleries = result.Galleries;    
          $('#image_gallery_list').html(galleries);
          break;
        }
        case 'ImageAddStep':
        {
          that.UpdateRecentUploads(m_fileList[m_count]);
          MoaUI.HeaderImageCountAdd(1);

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
            var params = "action=addstep&";
            params += "filename="+m_fileList[m_count]+"&";
            params += "imagegalleryid="+encodeURIComponent(m_parent_id)+"&";
            params += "imageformtags="+encodeURIComponent(m_tags)+"&";
            params += "imageformdesc="+encodeURIComponent(m_desc);
            $.ajax({
                    success: that.AjaxCallback, 
                    error: that.AjaxCallbackFail, 
                    cache:false,
                    url:"sources/mod_image.php?",
                    data: params,
                    type: 'POST'
                   });
          }
          break;
        }
        default:
        {
          that.AjaxCallbackFail('Unknown error -', result.Status, '');
        }
      }
    }
    else
    {
      that.AjaxCallbackFail({status: '', statusText: result.Result});
    }
  };
  
  this.AjaxCallbackFail = function(p_request, p_status, p_errorThrown)
  {
    if (m_lastAction == LastAction.editImage) 
    {
      that.SubmitRollback();
    }
    MoaUI.DisplayFeedback( 'Server returned "' + p_request.status + ' ' + p_request.statusText + '".', Feedback.error);
    $('#imageformsubmit').removeAttr("disabled");
    $('#imageformcancel').removeAttr("disabled");
  };
  
  this.SubmitRollback = function()
  {
    m_desc = m_old_desc;
    m_tags = m_old_tags;

    $('#imageblockdesc').html(EscapeNewLine(EscapeHTMLChars(m_desc)));

    m_old_desc = '';
    m_old_tags = '';

    m_short_desc = ShortName(m_desc);

    MoaUI.PageTitle('Image', m_short_desc);
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

    $('#imageformnewlist').html("Recently added -<br/>\n");

    for (var i = 0; i < m_newlistcount; i++)
    {
      $('#imageformnewlist').html( $('#imageformnewlist').html() + m_newlist[i]);
    }
  };

  this.Delete = function()
  {
    if (confirm("Are you sure you want to delete this image?"))
    {
      var params =  "?action=delete";
      params += "&image_id="+m_image_id;
      
      m_lastAction = LastAction.editImage;      
      $.ajax({ url: 'sources/mod_image.php' + params,
               success: that.AjaxCallback,
               error: that.AjaxCallbackFail,
               cache: false});
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
    $('#imageformtags').keypress( function (e) {return checkKey(e, "imageformsubmit", null);});
    $('#imageformtags').keyup( function (e) {image.Feedback(); image.TagHintList(this);});
    $('#imageformexpandlink').click( function (e) {image.ExpandClick();});
    $('#imageformsubmit').click( function (e) {image.SubmitEdit();});
    $('#imageformcancel').click( function (e) {image.CancelEdit();});
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
    if ('undefined' != typeof(m_formobject))
    {
      m_formobject.loaded(p_message);
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