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
  var m_newlist = ["", "", "", "", ""];
  var m_enabletaglist = false;
  var m_descexpand = false;
  var m_delimiter = p_delim;
  
  var m_taglist = new TagList( m_delimiter);
  
  this.PreLoad = function(p_image_id, p_desc, p_width, p_height, p_from)
  {
    m_image_id = p_image_id;
    m_desc = p_desc;
    m_width = p_width;
    m_height = p_height;
    m_from = p_from;
    
    m_short_desc = ShortName(m_desc); 
    m_old_desc = "";
    m_old_tags = "";
    
    m_taglist.PreLoad(all_tags, cur_tags);
    m_tags = m_taglist.StringList();
    
    if ("" == m_image_id)
    {
      m_add_mode = true;
      m_formobject = new httpForm( "imageform", "imageformupload", that.AddCallback, "image.loaded");
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
      m_formobject.submit("Uploading '"+document.getElementById("imageformfilename").value+"'...");
      document.getElementById("imageform").submit();
      m_formobject.reset();
    }
  	
  	m_taglist.Assimilate(m_tags);
  };
  
  this.CancelEdit = function()
  {
    if (!m_add_mode)
    {
      document.getElementById("imageblockinfo").innerHTML = m_titles;
      m_edit_toggle = false;
    } else
    {
      history.go(-1);
    }
  };
  
  this.PageTitle = function()
  {
    document.title = 'Image';
    if (m_short_desc.length > 0)
    {
      document.title += " - '";
      document.title += m_short_desc;
      document.title += "'";
    }
  };
  
  this.SubmitRollback = function()
  {
    m_desc = m_old_desc;
    m_tags = m_old_tags;
    document.getElementById("imageblockdesc").innerHTML = EscapeNewLine(EscapeHTMLChars(m_desc));
    m_old_desc = "";
    m_old_tags = "";
    
    m_short_desc = ShortName(m_desc);
    that.PageTitle();
  };
  
  this.SubmitCallback = function(p_text, p_status, p_xml, p_note)
  {
    if (p_status != 200)
    {
      document.getElementById("imageblockfeedback").innerHTML = FeedbackBox("Server returned code " + p_status + ".", false);   
      that.SubmitRollback();
      return;
    }
    if ("OK" != p_text.substr(0, 2))
    {
      document.getElementById("imageblockfeedback").innerHTML = FeedbackBox(p_text, false);      
      that.SubmitRollback();
      return;
    }
    m_old_desc = "";
    m_old_tags = "";
  };
  
  this.AddCallback = function(p_result)
  {
    if ("OK" != p_result.substr(0, 2))
    {
      document.getElementById("imageblockfeedback").innerHTML = FeedbackBox(p_result, false);      
      return;
    } else
    {
      var fname = p_result.substr(3);
      document.getElementById("imageblockfeedback").innerHTML = FeedbackBox("Image '"+fname+"' added.", true);
      
      document.getElementById("imageformnewlist").innerHTML = "Recently added -<br/>\n";
      var img_count = document.getElementById("hdr_imagecount").innerHTML;
      img_count++;
      document.getElementById("hdr_imagecount").innerHTML = img_count;
      
      fname += "<br/>\n";
      
      if (m_newlistcount < 5)
      {
        m_newlist[m_newlistcount] = fname;
        m_newlistcount++;
      } else
      {
        m_newlist[0] = m_newlist[1];
        m_newlist[1] = m_newlist[2];
        m_newlist[2] = m_newlist[3];
        m_newlist[3] = m_newlist[4];
        m_newlist[4] = fname;
      }
      
      for (var i = 0; i < m_newlistcount; i++)
      {
        document.getElementById("imageformnewlist").innerHTML += m_newlist[i];
      }
    }
    m_old_desc = "";
    m_old_tags = "";
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
  
  this.PopulateForm = function()
  {
    if (m_add_mode)
    {
      document.getElementById("imageformtags").value = m_taglist.StringList(); 
      document.getElementById("imageformdesc").focus();
      m_taglist.Feedback("image");
      addEvent(document.getElementById("imageformtags"), "keypress", function (e) {return checkKey(e, "imageformsubmit", null);});
      addEvent(document.getElementById("imageformtags"), "keyup", function (e) {image.Feedback(); image.TagHintList(this);});
      addEvent(document.getElementById("imageformexpandlink"), "click", function (e) {image.ExpandClick();});
    } else
    {
      document.getElementById("imageformdesc").focus();
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
  }
  
  this.DisableTagHintList = function(p_element)
  {
    m_enabletaglist = false;
    nd();  
  }
  
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
      document.getElementById("imageformdesc").rows = 4;
      document.getElementById("imageformdesc").cols = 37;
      document.getElementById("imageformexpandlink").innerHTML = "[Expand]";
      m_descexpand = false;
    } else
    {
      document.getElementById("imageformdesc").rows = 15;
      document.getElementById("imageformdesc").cols = 80;
      document.getElementById("imageformexpandlink").innerHTML = "[Shrink]";
      m_descexpand = true;
    }
  };
}