var LastAction = 
{ 
  none: 0,   
  addTag: 1,  
  editTag: 2,
  deleteTag: 3
};

// Used to sort tags alphabetically
function TagSort(p_a, p_b) {
  if (p_a.m_name.toLowerCase() > p_b.m_name.toLowerCase()) {
    return 1;
  } else {
    return -1;
  }
}

// Structure to hold a single tag
function Tag() {
  this.m_id = null;
  this.m_name = "";
  this.m_inuse = false;
  this.m_oldname = "";
  this.m_innerHTML = "";
}

// Structure to help with feedback
function TagTokens() {
  this.m_valid_count = 0;
  this.m_new_count = 0;
  this.m_new_list = null;
}

// Class to represent a list of tags

function TagList(p_delim, p_tag_row_template) {
  var that = this;

  var m_delimiter = p_delim;
  var m_master = new Array(); // All tags in Moa Gallery
  var m_current = new Array(); // All tags for current object (Admin, Image or
                              // Gallery)
  var m_verbose_feedback = false; // Shows a tick/cross for tag entry or a
                                // breakdown
  var m_fake_id = -1; // To keep track of new tags before a page load
  var m_tag_row_template = p_tag_row_template; 
  var m_add_form = "";
  var m_lastAction = LastAction.none;
  var m_lastID = 0;

  // Load the existing tags as well as any for a local gallery/image
  this.PreLoad = function(p_master, p_current, p_add_form) {
    m_master = new Array();
    m_current = new Array();
    var all_tags = p_master.split(m_delimiter);
    var cur_tags = p_current.split(m_delimiter);

    for ( var i = 0; i < all_tags.length; i++) {
      if (all_tags[i].length > 0) {
        var pos = all_tags[i].indexOf("=");
        var tag = new Tag();

        tag.m_id = all_tags[i].substring(0, pos);
        tag.m_name = all_tags[i].substring(pos + 1);
        tag.m_inuse = true;
        tag.m_oldname = "";

        m_master[i] = tag;
      }
    }

    for (i = 0; i < cur_tags.length; i++) {
      if (cur_tags[i].length > 0) {
        m_current[i] = cur_tags[i];
      }
    }

    m_master.sort(TagSort);

    m_add_form = p_add_form;
  };

  // Output a delimiter seperated string of current tags
  this.StringList = function() {
    var output = "";
    var cur_length = m_current.length;

    for ( var i = 0; i < cur_length; i++) {
      if (i > 0) {
        output += m_delimiter + " ";
      }

      for ( var j = 0; j < m_master.length; j++) {
        if (m_current[i] == m_master[j].m_id) {
          output += m_master[j].m_name;
        }
      }
    }
    return output;
  };

  // Split a delimited string into individual tokens
  this.StringSplit = function(p_tag_string) {
    var valid = 0;
    var invalid_count = 0;
    var invalid = new Array();

    var tokens = new TagTokens();

    var tags = p_tag_string.split(m_delimiter);

    for ( var i = 0; i < tags.length; i++) {
      tags[i] = trim(tags[i]);

      if (tags[i].length > 0) {
        var found = false;

        for ( var j = 0; j < m_master.length; j++) {
          if (tags[i].toLowerCase() == m_master[j].m_name.toLowerCase()) {
            valid++;
            found = true;
          }
        }

        if (false == found) {
          invalid[invalid_count] = tags[i];
          invalid_count++;
        }
      }
    }

    tokens.m_valid_count = valid;
    tokens.m_new_count = invalid_count;
    tokens.m_new_list = invalid;

    return tokens;
  };

  // Mark a tag as being used
  this.SetCurrent = function(p_tag_string) {
    m_current = new Array();
    var cur = 0;

    var tags = p_tag_string.split(m_delimiter);

    for ( var i = 0; i < tags.length; i++) {
      tags[i] = trim(tags[i]);
      for ( var j = 0; j < m_master.length; j++) {
        if (m_master[j].m_name.toLowerCase() == tags[i].toLowerCase()) {
          m_current[cur] = m_master[j].m_id;
          cur++;
        }
      }
    }

    return true;
  };

  // Count valid/used tags for info 
  this.Feedback = function(p_source)
  {
    var taglist = $('#' + p_source + 'formtags').val();

    var taginfo = that.StringSplit(taglist);
    var valid = taginfo.m_valid_count;
    var invalid_count = taginfo.m_new_count;
    var invalid = taginfo.m_new_list;

    var feedback = "";
    var output = "";
    if (valid > 0) {
      feedback += valid + " existing tag";
      if (valid > 1) {
        feedback += "s";
      }
      feedback += ".";
    }

    if (invalid.length > 0) {
      feedback += " " + invalid.length + " new tag";
      if (invalid.length > 1) {
        feedback += "s";
      }
      feedback += "	(";

      for (i = 0; i < invalid.length; i++) {
        if (i > 0) {
          feedback += m_delimiter + " ";
        }
        feedback += invalid[i];
      }

      feedback += ")";
    }

    if (m_verbose_feedback) {
      output = "<div onmouseup='" + p_source + ".FeedbackToggle();'>" + feedback
          + "</div>";
    } else {
      var mode = "add";
      if (0 == invalid.length) {
        if (0 == valid) {
          mode = "fail";
          feedback = "There must be at least 1 tag.";
        } else {
          mode = "success";
        }
      }

      switch (mode)
      {
        case "fail":
        {
          output = "<div onmouseup='"
              + p_source
              + ".FeedbackToggle();' onmouseover='showOverlib(\""
              + feedback
              + "\");' onmouseout='hideOverlib();'><img src='"+template_path+"media/fail.png' width='16' height='16' alt='no tags'/></div>";
          nd();
          break;
        }
        case "add":
        {
          output = "<div onmouseup='"
              + p_source
              + ".FeedbackToggle();' onmouseover='showOverlib(\""
              + feedback
              + "\");' onmouseout='hideOverlib();'><img src='"+template_path+"media/add.png' width='16' height='16' alt='new tag'/></div>";
          nd();
          break;
        }
        case "success":
        {
          output = "<div onmouseup='"
              + p_source
              + ".FeedbackToggle();' onmouseover='showOverlib(\""
              + feedback
              + "\");' onmouseout='hideOverlib();'><img src='"+template_path+"media/Success.png' width='16' height='16' alt='all tags ok'/></div>";
          nd();
          break;
        }
        default:
        {
          output = "";
          break;
        }
      }
    }
    $('#formtaglistfeedback').html(output);
  };

  // Take a string of tags and add any new ones to the master list
  this.Assimilate = function(p_tag_string) {
    var tags = that.StringSplit(p_tag_string);
    var mcount = m_master.length;

    for ( var i = 0; i < tags.m_new_list.length; i++) {
      m_master[mcount] = new Tag();
      m_master[mcount].m_name = tags.m_new_list[i];
      var id = "" + m_fake_id;
      m_master[mcount].m_id = id;
      m_fake_id--;
      mcount++;
    }

    that.SetCurrent(p_tag_string);
    m_master.sort(TagSort);
  };

  // Turn verbose feedback on or off
  this.FeedbackToggle = function() {
    m_verbose_feedback = !m_verbose_feedback;
    nd();
  };

  // Generate an HTML table row for the specified tag 
  this.ViewSingle = function(p_index)
  {
    var tag_line = m_tag_row_template;
    
    var tag = m_master[p_index];
    
    tag_line = str_replace(tag_line, "<moavar AdminTagID>", tag.m_id);
    tag_line = str_replace(tag_line, "<moavar AdminTagName>", EscapeHTMLChars(tag.m_name));
    tag_line = str_replace(tag_line, "<moavar AdminTagEditLink>", "onclick='tag_list.Edit(\""+tag.m_id+"\")'");
    tag_line = str_replace(tag_line, "<moavar AdminTagDeleteLink>", "onclick='tag_list.Delete(\""+tag.m_id+"\")'");
    tag_line = str_replace(tag_line, "<moavar AdminTagSubmitEditLink>", "onclick='tag_list.SubmitEdit(\""+tag.m_id+"\")'");
    tag_line = str_replace(tag_line, "<moavar AdminTagCancelEditLink>", "onclick='tag_list.CancelEdit(\""+tag.m_id+"\")'");
   
    return tag_line;
  };

  // Output HTML table for all tags
  this.ViewAll = function() {
    var tag_form = "";
    for ( var i = 0; i < m_master.length; i++) {
      if (m_master[i].m_inuse) {
        tag_form += that.ViewSingle(i);
      }
    }
    return tag_form;
  };

  // Submit a delete request
  this.Delete = function(p_id)
  {
    for ( var i = 0; i < m_master.length; i++)
    {
      if ((m_master[i].m_id == p_id) && (m_master[i].m_inuse))
      {
        if ("" != m_master[i].m_oldname)
        {
          alert("An operation is already pending on this tag.");
        } else
        {
          if (confirm("Are you sure you want to delete this tag (" + m_master[i].m_name + ")?"))
          {
            m_master[i].m_inuse = false;
            m_master[i].m_oldname = m_master[i].m_name;
            m_master[i].m_innerHTML = $('#tag_' + p_id).html();

            $('#tag_' + p_id).animate({height:0}, 500);

            var params = '?action=delete';
           		 params += '&tag_id=' + p_id;
           		 
         		m_lastAction = LastAction.deleteTag;   
            m_lastID = m_master[i].m_id;
            $.ajax({ url: 'sources/mod_tag.php' + params,
                     success: that.AjaxCallback,
                     error: that.AjaxCallbackFail,
                     cache: false});
          }
        }
      }
    }
  };

  // Enables the edit form
  this.Edit = function(p_id) 
  {
    hide_div("tag_edit_link_" + p_id);
    hide_div("tag_delete_link_" + p_id);
    hide_div("tag_name_" + p_id);

    show_div("tag_edit_box_" + p_id);
    show_div("tag_edit_submit_" + p_id);
    show_div("tag_edit_cancel_" + p_id);

    $('#tag_edit_box_' + p_id).css( 'clear' ,'left');
    var name = $('#tag_name_' + p_id).html();
    name = name.replace("&lt;", "<");
    name = name.replace("&gt;", ">");
    name = name.replace("&amp;", "&");
    name = name.replace("&quote;", "\"");
    name = name.replace("&apos;", "\'");
    name = trim(name);
    $('#tag_edit_input_' + p_id).val( name);

    $('#tag_edit_input_' + p_id).focus();
  };

  this.CancelEdit = function(p_id) 
  {
    show_div("tag_edit_link_" + p_id);
    show_div("tag_delete_link_" + p_id);
    show_div("tag_name_" + p_id);

    hide_div("tag_edit_box_" + p_id);
    hide_div("tag_edit_submit_" + p_id);
    hide_div("tag_edit_cancel_" + p_id);

    $('#tag_edit_box_' + p_id).css( 'clear', 'none');
  };

  // Submits an edit request
  this.SubmitEdit = function(p_id) 
  {    
    for ( var i = 0; i < m_master.length; i++)
    {
      if ((m_master[i].m_id == p_id) && (m_master[i].m_inuse))
      {
        if (("" != m_master[i].m_oldname)) {
          alert("An operation is already pending on this tag.");          
          return;
        }
        if ("" == $('#tag_edit_input_' + p_id).val()) 
        {
          alert("You must give the tag a name.");
          return;
        }
        
        that.CancelEdit(p_id);
        
        if (m_master[i].m_name == $('#tag_edit_input_' + p_id).val())
        {
          return;
        }
        
        m_master[i].m_oldname = m_master[i].m_name;
        m_master[i].m_name = $('#tag_edit_input_' + p_id).val();       
        
        $('#tag_name_' + p_id).html( m_master[i].m_name);                      
        
        var params  = "?action=edit";
        params += "&tag_id=" + encodeURIComponent(m_master[i].m_id);
        params += "&name=" + encodeURIComponent(m_master[i].m_name);
    
        m_lastAction = LastAction.editTag;   
        m_lastID = m_master[i].m_id;
        $.ajax({ url: 'sources/mod_tag.php' + params,
                 success: that.AjaxCallback,
                 error: that.AjaxCallbackFail,
                 cache: false});
      }
    }

    m_master.sort(TagSort);
    $('#tag_lines').html( that.ViewAll());
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

    if (result.Status === 'SUCCESS')
    {       
      switch (result.Operation)
      {
        case 'TagAdd':
        {
          that.CancelEdit(result.fake_id);

          for ( var i = 0; i < m_master.length; i++)
          {
            if (m_master[i].m_id == result.fake_id)
            {        
              m_master[i].m_oldname = "";
              m_master[i].m_id = result.TagID;
              $('#tag_lines').html(that.ViewAll());
            }
          }      
          break;
        }
        case 'TagEdit':
        {
          for ( var i = 0; i < m_master.length; i++)
          {
            if (m_master[i].m_id == m_lastID)
            {        
              m_master[i].m_oldname = "";
            }
          }
          break;
        }
        case 'TagDelete':
        {
          id = m_lastID;
          for ( var i = 0; i < m_master.length; i++)
          {
            if ((m_master[i].m_id == id) && (!m_master[i].m_inuse))
            {
              $('#tag_' + id).remove();

              MoaUI.DisplayFeedback("Deleted \"" + m_master[i].m_name + "\"", Feedback.success);
            }
          }
          break;
        }
        default:
        {
          that.AjaxCallbackFail({status: 'Unknown error - ', statusText: resultStatus});
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
    p_id = m_lastID;
    
    switch(m_lastAction)
    {
      case LastAction.addTag:
      {
        for ( var i = 0; i < m_master.length; i++)
        {
          if (m_master[i].m_id == p_id)
          {
            m_master[i].m_inuse = false;
          }
        }
        
        m_master.sort(TagSort);
        $('#tag_lines').html(that.ViewAll());
        break;
      }
      case LastAction.editTag:
      {
        for ( var i = 0; i < m_master.length; i++)
        {
          if (m_master[i].m_id == p_id)
            {
            m_master[i].m_name = m_master[i].m_oldname;
            $('#tag_edit_input_' + p_id).val( m_master[i].m_name);
            m_master[i].m_oldname = "";
          }
        }
              
        m_master.sort(TagSort);
        $('#tag_lines').html(that.ViewAll());
        break;
      }
      case LastAction.deleteTag:
      {
        for ( var i = 0; i < m_master.length; i++)
        {
          if (m_master[i].m_id == p_id)
          {
            m_master[i].m_name = m_master[i].m_oldname;
            m_master[i].m_oldname = "";
            m_master[i].m_inuse = true;
          }
          $('#tag_lines').html(that.ViewAll());
        }
        break;
      }
    }
    
    MoaUI.DisplayFeedback( 'Server returned "' + p_request.status + ' ' + p_request.statusText + '".', Feedback.error);
  };

  // Show the inline add tag form
  this.ShowAdd = function()
  {       
    $('#tag_add_line').html( m_add_form);
    
    show_div("tag_add_box");
    show_div("tag_add_submit");
    show_div("tag_add_cancel");
    
    $('#tag_add_input'.keyup, function (e) { return checkKey(e, "tag_add_submit_button", "tag_add_cancel_button");});
    $('#tag_add_input').focus();
  };
  
  // Hides the inline add form
  this.HideAdd = function ()
  {
    $('#tag_add_input').blur();
    
    hide_div("tag_add_box");
    hide_div("tag_add_submit");
    hide_div("tag_add_cancel");
    
    $('#tag_add_line').html( add_link);
  };
  
  // Submit an add request
  this.SubmitAdd = function (p_NewTagName)
  {    
    if ("" == p_NewTagName) {
      alert("You must give the tag a name.");
      return;
    }
    
    var duplicate = false;
    
    for (i = 0; i < m_master.length; i++)
    {
      if (m_master[i].m_name == p_NewTagName)
      {
        duplicate = true;
        i = m_master.length;
      }
    }
    
    if (!duplicate)
    {
      that.CancelAdd();
      
      var tag = new Tag();
      
      tag.m_id    = m_fake_id;
      tag.m_name  = p_NewTagName;
      tag.m_inuse = true;
      
      m_master[m_master.length] = tag;
      
      var params  = "?action=add";
          params += "&name=" + encodeURIComponent(p_NewTagName);
          params += "&fake_id=" + m_fake_id;
      
      m_lastAction = LastAction.addTag;      
      $.ajax({ url: 'sources/mod_tag.php' + params,
               success: that.AjaxCallback,
               error: that.AjaxCallbackFail,
               cache: false});
  
      m_lastID = m_fake_id;
      m_fake_id--;
      m_master.sort(TagSort);
      $('#tag_lines').html(that.ViewAll());
      
      MoaUI.RemoveFeedback();
    } else
    {
      MoaUI.DisplayFeedback('This tag already exists.', Feedback.warning)
    }
  };

  // Cancel button pressed
  this.CancelAdd = function ()
  {
    that.HideAdd();   
  };
  
  // Generate a list of all tags, highlighting current ones
  this.TagHintList = function(p_element)
  {
    var hintlist = "<ul class='popuptaglist'>";
    if (null != p_element)
    {
      var m_current_string = p_element.value;
      var m_current_tags = m_current_string.split(m_delimiter);
    } else
    {
      m_current_tags = Array();
    }
    
    for ( var i = 0; i < m_master.length; i++) {
      fclass = "tag_hint_inner";
      for (var j = 0; j < m_current_tags.length; j++)
      {
        if (trim(m_current_tags[j].toUpperCase()) == m_master[i].m_name.toUpperCase())
        {
          
          fclass = "tag_hint_inner_match";
        }
      }
      hintlist += "<li class='tag_hint_outer'><div class='"+fclass+"'>" + EscapeHTMLChars(m_master[i].m_name) + "</div></li>";
    }
    
    hintlist += "</ul>";
    return showOverlib(hintlist); 
  };
}