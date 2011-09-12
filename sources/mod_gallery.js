var LastAction = 
{ 
  none: 0,	 
  addGallery: 1,  
  editGallery: 2,
  deleteGallery: 3,
  getThumbnails: 4
};

function Gallery(p_delim)
{
  var that = this;

  var m_last_action;
  var m_gallery_id;
  var m_name;
  var m_desc;
  var m_tags;
  var m_tagged;
  var m_parent_id;
  var m_short_name;
  var m_short_desc;
  var m_from;

  var m_titles;
  var m_old_name;
  var m_old_desc;
  var m_old_tags;
  var m_old_tagged;
  var m_old_parent_id;
  var m_edit_toggle = false;
  var m_add_mode = false;
  var m_enabletaglist = false;
  var m_descexpand = false;
  var m_delimiter = p_delim;

  var m_taglist = new TagList(m_delimiter);
  
  var m_parent_url = document.referrer;

  this.PreLoad = function(p_gal_id, p_name, p_desc, p_par_id, p_from, p_tagged)
  {
    nd();
    m_gallery_id = p_gal_id;
    m_name = p_name;
    m_desc = p_desc;
    m_parent_id = p_par_id;
    m_from = p_from;
    m_tagged = p_tagged;

    m_short_name = ShortName(m_name);
    m_short_desc = ShortName(m_desc);

    m_old_name = "";
    m_old_desc = "";
    m_old_tags = "";
    m_old_tagged = false;
    m_old_parent_id = "";
    m_titles = "";

    m_taglist.PreLoad(all_tags, cur_tags);
    m_tags = m_taglist.StringList();

    if ("" === m_gallery_id)
    {
      m_add_mode = true;
      //$('#galleryaddform').html(editform);
      that.AddFormEvents(false);
      that.Feedback('');
    }

    $(document).ready(gallery.SuppressPopups);
  };

  this.SuppressPopups = function()
  {
    $('.picture_thumb').mouseout();
  };
  
  this.AddFormEvents = function(p_enableCancel)
  {
    cancel = null;
    if (p_enableCancel)
    {
      cancel = 'galleryformcancel';
    }
    
    $('#galleryformname').keypress(function(e) { return checkKey(e, 'galleryformsubmit', cancel); });
    $('#galleryformdesc').keypress(function(e) { return checkKey(e, null, cancel); });
    $('#galleryformtags').keypress(function(e) { return checkKey(e, 'galleryformsubmit', cancel); });
    $('#galleryformparent_id').keypress(function(e) { return checkKey(e, 'galleryformsubmit', cancel); });
    $('#galleryformtags').keyup(function(e) { gallery.Feedback(); if (m_enabletaglist) {gallery.TagHintList(this);}; });
    $('#galleryformexpandlink').click(function(e) { gallery.ExpandClick(); });
    $('#galleryformtagged').click(function (e) {gallery.ChangeTaggedStatus();});
    $('#galleryformname').focus();
  };
  
  this.Edit = function()
  {
    if ((!m_edit_toggle) && (!m_add_mode))
    {
      m_titles = $('#galleryblocktitles').html();
      $('#galleryblocktitles').html(editblock);
      $('#galleryformname').val(m_name);
      $('#galleryformdesc').val(str_replace(m_desc, "<br/>", "\n"));
      $('#galleryformtags').val(m_taglist.StringList());
      $('#galleryformparent_id').val(m_parent_id);
      $('#galleryformtagged').attr('checked', m_tagged);
      that.ChangeTaggedStatus();

      that.AddFormEvents(true);
      m_taglist.Feedback("gallery");
      m_edit_toggle = true;
    }
  };

  this.SubmitEdit = function()
  {
    var url = "";

    if (("" != m_old_name) && (!m_add_mode)) {
      alert("An operation is already pending on this gallery.");
      return;
    }
    
    if (!FormCheck())
    {
      return false;
    }
    
    m_old_name = m_name;
    m_old_desc = m_desc;
    m_old_tags = m_tags;
    m_old_tagged = m_tagged;
    m_old_parent_id = m_parent_id;

    m_name = $('#galleryformname').val();
    m_desc = $('#galleryformdesc').val();
    m_tags = $('#galleryformtags').val();
    m_tagged = $('#galleryformtagged').attr('checked');
    m_parent_id = $('#galleryformparent_id').val();

    m_short_name = ShortName(m_name);
    m_short_desc = ShortName(m_desc);
    MoaUI.PageTitle('Gallery', m_short_name);
    
    if (!m_add_mode) {
      that.CancelEdit();
      $('#galleryblockname').html(EscapeHTMLChars(m_name));
      $('#galleryblockdesc').html(EscapeNewLine(EscapeHTMLChars(m_desc)));
      
      params = "action=edit";
      params += "&name=" + encodeURIComponent(m_name);
      params += "&desc=" + encodeURIComponent(m_desc);
      params += "&gallery_id=" + m_gallery_id;
      params += "&parent_id=" + m_parent_id;
      params += "&tags=" + encodeURIComponent(m_tags);
      params += "&tagged=" + encodeURIComponent(m_tagged);
      
      m_last_action = LastAction.editGallery;
      $.ajax({ url: 'sources/mod_gallery.php',
             data: params,
             type: 'POST',
     	       success: that.AjaxCallback,
    	       error: that.AjaxCallbackFail,
    	       cache: false});
      
      m_edit_toggle = false;
    } else 
    {
      params = "action=add";
      params += "&name=" + encodeURIComponent(m_name);
      params += "&desc=" + encodeURIComponent(m_desc);
      params += "&parent_id=" + m_parent_id;
      params += "&tags=" + encodeURIComponent(m_tags);
      params += "&tagged=" + encodeURIComponent(m_tagged);
      
      m_last_action = LastAction.addGallery;      
      $.ajax({ url: 'sources/mod_gallery.php',
             data: params,
             type: 'POST',
     	       success: that.AjaxCallback,
    	       error: that.AjaxCallbackFail,
    	       cache: false});
     }

    m_taglist.Assimilate(m_tags);
  };

  this.CancelEdit = function()
  {
    if (!m_add_mode)
    {
      $('#galleryblocktitles').html(m_titles);
      m_edit_toggle = false;
      nd();
    } else 
    {
      document.location = m_parent_url;
    }
  };
  
  this.AjaxCallbackFail = function(p_request, p_status, p_errorThrown)
  {
  	if (m_last_action == LastAction.editGallery) 
  	{
  	  that.SubmitRollback();
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
  	    case 'GalleryAdd':
  	    {
            id = result.NewID;		              
            MoaUI.DisplayFeedback("Gallery \"<a href=\"index.php?action=gallery_view&gallery_id="+id+"\">" + m_name + "</a>\" added.", Feedback.success);                            
            MoaUI.HeaderGalleryCountAdd(1);
            break;
  	    }
  	    case 'GalleryEdit':
  	    {
  	      MoaUI.BreadcrumbChange(m_gallery_id, m_name);
  	      m_old_name = "";
            m_old_desc = "";
            m_old_tags = "";
  	      if (m_old_tags != m_tags)
  	      {
  	        params = "?action=image_thumbs";
  	        params += "&gallery_id=" + m_gallery_id;
  	        params += "&page=" + page;
  	        
  	        m_last_action = LastAction.getThumbnails;      
  	        $.ajax({ url: 'sources/mod_gallery.php' + params,
  	                 success: that.AjaxCallback,
  	                 error: that.AjaxCallbackFail,
  	                 cache: false});
  	      }
  	      break;
  	    }
  	    case 'GalleryDelete':
          {
  	      if (m_from == "orphan")
  	      {
  	        document.location = "index.php?action=admin_orphans&deleted=gallery";
  	      } else
  	      {
  	        if ("0000000000" == m_parent_id)
  	        {
  	          document.location = "index.php?deleted=gallery";
  	        } else
  	        {
  	          document.location = "index.php?action=gallery_view&gallery_id=" + m_parent_id + "&deleted=gallery";
  	        }
  	      }
            break;
          }
  	    case 'GetThumbnails':
  	    {
  	      $('#pagegalleryview').html(result.HTML);
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
  
  this.SubmitRollback = function()
  {
    if (!m_add_mode) {
      m_name = m_old_name;
      m_desc = m_old_desc;
      m_tags = m_old_tags;
      m_tagged = m_old_tagged;
      m_parent_id = m_old_parent_id;
      that.CancelEdit();
      $('#galleryblockname').html(EscapeHTMLChars(m_name));
      $('#galleryblockdesc').html(EscapeNewLine(EscapeHTMLChars(m_desc)));
      m_old_name = "";
      m_old_desc = "";
      m_old_tags = "";
      m_old_tagged = false;
      m_old_parent_id = "";

      m_short_name = ShortName(m_name);
      m_short_desc = ShortName(m_desc);
      MoaUI.PageTitle('Gallery', m_short_name);
    }
  };

  this.Delete = function()
  {
    if (("" != m_old_name))
    {
      alert("An operation is already pending on this gallery.");
      return;
    }

    if (confirm("Are you sure you want to delete this gallery?"))
    {
      params = "?action=delete";
      params += "&gallery_id=" + m_gallery_id;
      
      m_last_action = LastAction.deleteGallery;      
      $.ajax({ url: 'sources/mod_gallery.php' + params,
               success: that.AjaxCallback,
               error: that.AjaxCallbackFail,
               cache: false});
    }
  };

  this.Feedback = function()
  {
    m_taglist.Feedback("gallery");
  };

  this.FeedbackToggle = function()
  {
    m_taglist.FeedbackToggle();
    m_taglist.Feedback("gallery");
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
      return m_taglist.TagHintList(p_element);
    }
  };

  this.ExpandClick = function()
  {
    if (m_descexpand)
    {
      $('#galleryformdesc').attr('rows', 4);
      $('#galleryformdesc').attr('cols', 50);
      $('#galleryformexpandlink').html('[Expand]');
      m_descexpand = false;
    } else
    {
      $('#galleryformdesc').attr('rows', 15);
      $('#galleryformdesc').attr('cols', 80);
      $('#galleryformexpandlink').html('[Shrink]');
      m_descexpand = true;
    }
  }; 

  this.ChangeTaggedStatus = function()
  {
    var status = $("#galleryformtagged").is(':checked');
    FormCheckSetup('gallery_add', status);    
  };
}
