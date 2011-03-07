function Gallery(p_delim) {
  var that = this;

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

  this.PreLoad = function(p_gal_id, p_name, p_desc, p_par_id, p_from, p_tagged) {
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
    tags = m_taglist.StringList();

    if ("" == m_gallery_id) {
      m_add_mode = true;
    }
  };

  this.Edit = function() {
    if ((!m_edit_toggle) && (!m_add_mode)) {
      m_titles = document.getElementById("galleryblocktitles").innerHTML;
      document.getElementById("galleryblocktitles").innerHTML = editblock;
      document.getElementById("galleryformname").value = m_name;
      document.getElementById("galleryformdesc").value = str_replace(m_desc, "<br/>", "\n");
      document.getElementById("galleryformtags").value = m_taglist.StringList();
      document.getElementById("galleryformtagged").checked = m_tagged;
      //alert(m_tagged);
      addEvent(document.getElementById("galleryformname"), "keypress", function(e) { return checkKey(e, "galleryformsubmit", "galleryformcancel"); });
      addEvent(document.getElementById("galleryformdesc"), "keypress", function(e) { return checkKey(e, null, "galleryformcancel"); });
      addEvent(document.getElementById("galleryformtags"), "keypress", function(e) { return checkKey(e, "galleryformsubmit", "galleryformcancel"); });
      addEvent(document.getElementById("galleryformparent_id"), "keypress", function(e) { return checkKey(e, "galleryformsubmit", "galleryformcancel"); });
      addEvent(document.getElementById("galleryformexpandlink"), "click", function(e) { gallery.ExpandClick(); });
      addEvent(document.getElementById("galleryformtags"), "keyup", function(e) { gallery.Feedback(); if (m_enabletaglist) {gallery.TagHintList(this);}; });
      addEvent(document.getElementById("galleryformtagged"), "click", function (e) {gallery.ChangeTaggedStatus();});
      document.getElementById("galleryformname").focus();
      m_taglist.Feedback("gallery");
      m_edit_toggle = true;
    }
  };

  this.SubmitEdit = function() {
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

    m_name = document.getElementById("galleryformname").value;
    m_desc = document.getElementById("galleryformdesc").value;
    m_tags = document.getElementById("galleryformtags").value;
    m_tagged = document.getElementById("galleryformtagged").checked;
    m_parent_id = document.getElementById("galleryformparent_id").value;

    m_short_name = ShortName(m_name);
    m_short_desc = ShortName(m_desc);
    that.PageTitle();
    
    if (!m_add_mode) {
      that.CancelEdit();
      document.getElementById("galleryblockname").innerHTML = EscapeHTMLChars(m_name);
      document.getElementById("galleryblockdesc").innerHTML = EscapeNewLine(EscapeHTMLChars(m_desc));
      
      url = "action=edit";
      url += "&name=" + encodeURIComponent(m_name);
      url += "&desc=" + encodeURIComponent(m_desc);
      url += "&gallery_id=" + m_gallery_id;
      url += "&parent_id=" + m_parent_id;
      url += "&tags=" + encodeURIComponent(m_tags);
      url += "&tagged=" + encodeURIComponent(m_tagged);
      var request = new httpRequest("sources/mod_gallery.php", that.SubmitCallback, m_gallery_id);
      request.update(url, "GET");
      
      m_edit_toggle = false;
    } else 
    {
      url = "action=add";
      url += "&name=" + encodeURIComponent(m_name);
      url += "&desc=" + encodeURIComponent(m_desc);
      url += "&parent_id=" + m_parent_id;
      url += "&tags=" + encodeURIComponent(m_tags);
      url += "&tagged=" + encodeURIComponent(m_tagged);
      var request = new httpRequest("sources/mod_gallery.php", that.SubmitCallback, "");
      request.update(url, "GET");
    }

    m_taglist.Assimilate(m_tags);
  };

  this.CancelEdit = function()
  {
    if (!m_add_mode)
    {
      document.getElementById("galleryblocktitles").innerHTML = m_titles;
      m_edit_toggle = false;
      nd();
    } else 
    {
      window.location = m_parent_url;
    }
  };

  this.PageTitle = function() {
    if (!m_add_mode) {
      document.title = 'Gallery';
      var name = m_name;
      
      if (m_short_name.length > 0) {
        name = m_short_name;
      }
      
      document.title += " - '";
      document.title += name;
      document.title += "' - Moa";
    }
  };

  this.SubmitRollback = function() {
    if (!m_add_mode) {
      m_name = m_old_name;
      m_desc = m_old_desc;
      m_tags = m_old_tags;
      m_tagged = m_old_tagged;
      m_parent_id = m_old_parent_id;
      that.CancelEdit();
      document.getElementById("galleryblockname").innerHTML = EscapeHTMLChars(m_name);
      document.getElementById("galleryblockdesc").innerHTML = EscapeNewLine(EscapeHTMLChars(m_desc));
      m_old_name = "";
      m_old_desc = "";
      m_old_tags = "";
      m_old_tagged = false;
      m_old_parent_id = "";

      m_short_name = ShortName(m_name);
      m_short_desc = ShortName(m_desc);
      that.PageTitle();
    }
  };

  this.SubmitCallback = function(p_text, p_status, p_xml, p_note) {
    if (p_status != 200) {
      document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox("Server returned code " + p_status + ".", false);
      that.SubmitRollback();
      return;
    }
    
    if ("OK" != p_text.substr(0, 2)) {
      document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox(p_text, false);
      that.SubmitRollback();
      return;
    } else {
      if (m_add_mode)
      {
        results = p_text.split("\n");
        id = results[1];
        
        document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox(
            "Gallery \"<a href=\"index.php?action=gallery_view&gallery_id="+id+"\">" + m_name + "</a>\" added.", true);
        
        // Only update the header if they are displaying the count
        var hdr_gallerycount = document.getElementById("hdr_gallerycount");
        if (null != hdr_gallerycount)
        {
          var gal_count = hdr_gallerycount.innerHTML;
          gal_count++;
          hdr_gallerycount.innerHTML = gal_count;
        }
      } else
      {
        document.getElementById("nav_tree_" + m_gallery_id).innerHTML = m_name;
        if (m_old_tags != m_tags) {
          url = "action=image_thumbs";
          url += "&gallery_id=" + m_gallery_id;
          var request = new httpRequest("sources/mod_gallery.php",
              that.NewTagsCallback, "");
          request.update(url, "GET");
        }
      }
    }
    m_old_name = "";
    m_old_desc = "";
    m_old_tags = "";
  };

  this.NewTagsCallback = function(p_text, p_status, p_xml, p_note) {
    if (p_status != 200) {
      document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox(
          "Server returned code " + p_status + ".", false);
      that.SubmitRollback();
      return;
    }
    if ("OK" != p_text.substr(0, 2)) {
      document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox(
          p_text, false);
      that.SubmitRollback();
      return;
    } else {      
      document.getElementById("pagegalleryview").innerHTML = p_text.substr(3);
    }
  };

  this.Delete = function() {
    if (("" != m_old_name)) {
      alert("An operation is already pending on this gallery.");
      return;
    }

    if (confirm("Are you sure you want to delete this gallery?")) {
      var url = "action=delete&gallery_id=" + m_gallery_id;
      var request = new httpRequest("sources/mod_gallery.php",
          that.DeleteCallback, m_gallery_id);
      request.update(url, "GET");
    }
  };

  this.DeleteCallback = function(p_text, p_status, p_xml, p_note) {
    if (p_status != 200) {
      document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox(
          "Server returned code " + p_status, false);
      return;
    }
    if ("OK" != p_text.substr(0, 2)) {
      document.getElementById("galleryblockfeedback").innerHTML = FeedbackBox(
          p_text, false);
      return;
    }

    if (m_from == "orphan") {
      document.location = "index.php?action=admin_orphans&deleted=gallery";
    } else {
      if ("0000000000" == m_parent_id)
      {
    	document.location = "index.php?deleted=gallery";
      } else
      {
        document.location = "index.php?action=gallery_view&gallery_id=" + m_parent_id + "&deleted=gallery";
      }
    }
  };

  this.Feedback = function() {
    m_taglist.Feedback("gallery");
  };

  this.FeedbackToggle = function() {
    m_taglist.FeedbackToggle();
    m_taglist.Feedback("gallery");
  };

  this.EnableTagHintList = function(p_element) {
    m_enabletaglist = true;
    m_taglist.TagHintList(p_element);
  }

  this.DisableTagHintList = function(p_element) {
    m_enabletaglist = false;
    nd();
  }

  this.TagHintList = function(p_element) {
    if (m_enabletaglist) {
      m_taglist.TagHintList(p_element);
    }
  };

  this.ExpandClick = function() {
    if (m_descexpand) {
      document.getElementById("galleryformdesc").rows = 4;
      document.getElementById("galleryformdesc").cols = 50;
      document.getElementById("galleryformexpandlink").innerHTML = "[Expand]";
      m_descexpand = false;
    } else {
      document.getElementById("galleryformdesc").rows = 15;
      document.getElementById("galleryformdesc").cols = 80;
      document.getElementById("galleryformexpandlink").innerHTML = "[Shrink]";
      m_descexpand = true;
    }
  };
  
  this.TagHintList = function(p_taglist)
  {
    return m_taglist.TagHintList(p_taglist);
  };

  this.ChangeTaggedStatus = function() {
    var status = $("#galleryformtagged").is(':checked');
    FormCheckSetup('gallery_add', status);
    //alert(status);
  }
}
