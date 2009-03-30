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

function TagList(p_delim) {
  var that = this;

  var m_delimiter = p_delim;
  var m_master = new Array(); // All tags in Moa Gallery
  var m_current = new Array(); // All tags for current object (Admin, Image or
                              // Gallery)
  var m_verbose_feedback = false; // Shows a tick/cross for tag entry or a
                                // breakdown
  var m_fake_id = -1; // To keep track of new tags before a page load

  // Load the existing tags as well as any for a local gallery/image
  this.PreLoad = function(p_master, p_current) {
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
  this.Feedback = function(p_source) {
    var taglist = document.getElementById(p_source + 'formtags').value;

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
      output = "<span onmouseup='" + p_source + ".FeedbackToggle();'>" + feedback
          + "</span>";
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

      switch (mode) {
      case "fail":
        output = "<span style='padding: 3px 0 0 0; position: absolute;' onmouseup='"
            + p_source
            + ".FeedbackToggle();' onmouseover='overlib(\""
            + feedback
            + "\", WRAP);' onmouseout='nd();'><img src='media/fail.png' width='16' height='16' /></span>";
        nd();
        break;
      case "add":
        output = "<span style='padding: 3px 0 0 0; position: absolute;' onmouseup='"
            + p_source
            + ".FeedbackToggle();' onmouseover='overlib(\""
            + feedback
            + "\", WRAP);' onmouseout='nd();'><img src='media/add.png' width='16' height='16' /></span>";
        nd();
        break;
      case "success":
        output = "<span style='padding: 3px 0 0 0; position: absolute;' onmouseup='"
            + p_source
            + ".FeedbackToggle();' onmouseover='overlib(\""
            + feedback
            + "\", WRAP);' onmouseout='nd();'><img src='media/success.png' width='16' height='16' /></span>";
        nd();
        break;
      default:
        output = "";
        break;
      }
    }

    document.getElementById('formtaglistfeedback').innerHTML = output;
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
  this.ViewSingle = function(p_index) {
    // Tag Data
    var tag_line = "";
    tag_line = "<div id='tag_" + m_master[p_index].m_id + "'>\n";
    tag_line += "<div class='tag_name' id='tag_name_" + m_master[p_index].m_id + "' ondblclick='tag_list.Edit( \""
        + m_master[p_index].m_id + "\")'>"
        + m_master[p_index].m_name + "</div>\n";
    tag_line += "<div class='tag_link' id='tag_edit_link_" + m_master[p_index].m_id
        + "'><a class='admin_link' onclick='tag_list.Edit( \""
        + m_master[p_index].m_id + "\")'>[Edit]</a></div>\n";
    tag_line += "<div class='tag_link' id='tag_delete_link_" + m_master[p_index].m_id
        + "'><a class='admin_link' onclick='tag_list.Delete( \""
        + m_master[p_index].m_id + "\")'>[Delete]</a></div>\n";

    // Edit Controls
    tag_line += "<div class='tag_edit_box' id='tag_edit_box_"
        + m_master[p_index].m_id + "'><input id='tag_edit_input_" + m_master[p_index].m_id
        + "' class='inline_element' type='text' name='tag_edit_box_"
        + m_master[p_index].m_id + "' onKeyPress='checkKey(event,\"tag_edit_submit_button_"+ m_master[p_index].m_id +"\",\"tag_edit_cancel_button_" + m_master[p_index].m_id +"\")'></div>\n";
    tag_line += "<div class='tag_button' id='tag_edit_submit_"
        + m_master[p_index].m_id
        + "'><button id='tag_edit_submit_button_" + m_master[p_index].m_id + "' class='tag_buttons' onclick='javascript: tag_list.SubmitEdit(\""
        + m_master[p_index].m_id
        + "\")' class='inline_element'>Ok</button><img src='media/trans-pixel.png' width='6' height='1' alt='' /></div>\n";
    tag_line += "<div class='tag_button' id='tag_edit_cancel_"
        + m_master[p_index].m_id
        + "'><button id='tag_edit_cancel_button_" + m_master[p_index].m_id + "' class='tag_buttons' onclick='javascript: tag_list.CancelEdit(\""
        + m_master[p_index].m_id
        + "\")' class='inline_element'>Cancel</button></div>\n";
    tag_line += "<br/>\n";
    tag_line += "</div>\n";

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
  this.Delete = function(p_id) {
    for ( var i = 0; i < m_master.length; i++) {
      if ((m_master[i].m_id == p_id) && (m_master[i].m_inuse)) {
        if ("" != m_master[i].m_oldname) {
          alert("An operation is already pending on this tag.");
        } else {
          if (confirm("Are you sure you want to delete this tag ("
              + m_master[i].m_name + ")?")) {
            m_master[i].m_inuse = false;
            m_master[i].m_oldname = m_master[i].m_name;
            m_master[i].m_innerHTML = document.getElementById("tag_" + p_id).innerHTML;

            document.getElementById("tag_" + p_id).innerHTML = "";

            var url = "action=delete&tag_id=" + p_id;
            var request = new httpRequest("sources/mod_tag.php",
                that.DeleteCallback, m_master[i].m_id);
            request.update(url, "GET");
          }
        }
      }
    }
  };

  // If delete request fails, restore the tag
  this.DeleteRollback = function(p_id) {
    for ( var i = 0; i < m_master.length; i++) {
      if (m_master[i].m_id == p_id) {
        m_master[i].m_name = m_master[i].m_oldname;
        document.getElementById("tag_" + p_id).innerHTML = m_master[i].m_innerHTML;
        m_master[i].m_oldname = "";
        m_master[i].m_inuse = true;
      }
    }
  };

  // Called when the delete request returns
  this.DeleteCallback = function(p_text, p_status, p_xml, p_note) {
    if (p_status != 200) {
      document.getElementById("tagblockfeedback").innerHTML = FeedbackBox(
          "Server returned code " + p_status, false);
      that.DeleteRollback(p_note);
      return;
    }
    if ("OK" != p_text.substr(0, 2)) {
      document.getElementById("tagblockfeedback").innerHTML = FeedbackBox(p_text, false);
      that.DeleteRollback(p_note);
      return;
    } else {      
      for ( var i = 0; i < m_master.length; i++) {
        if ((m_master[i].m_id == p_note) && (!m_master[i].m_inuse)) {
          document.getElementById('tag_lines').removeChild(
              document.getElementById('tag_' + p_note));

          document.getElementById("tagblockfeedback").innerHTML = FeedbackBox(
              "Deleted \"" + m_master[i].m_name + "\"", true);
        }
      }
    }
  };

  // Enables the edit form
  this.Edit = function(p_id) {
    hide_div("tag_edit_link_" + p_id);
    hide_div("tag_delete_link_" + p_id);
    hide_div("tag_name_" + p_id);

    show_div("tag_edit_box_" + p_id);
    show_div("tag_edit_submit_" + p_id);
    show_div("tag_edit_cancel_" + p_id);

    document.getElementById("tag_edit_box_" + p_id).style.clear = "left";
    var name = document.getElementById("tag_name_" + p_id).innerHTML;
    name = name.replace("&lt;", "<");
    name = name.replace("&gt;", ">");
    name = name.replace("&amp;", "&");
    name = name.replace("&quote;", "\"");
    name = name.replace("&apos;", "\'");
    document.getElementById("tag_edit_input_" + p_id).value = name;

    document.getElementById("tag_edit_input_" + p_id).focus();
  };

  this.CancelEdit = function(id) {
    show_div("tag_edit_link_" + id);
    show_div("tag_delete_link_" + id);
    show_div("tag_name_" + id);

    hide_div("tag_edit_box_" + id);
    hide_div("tag_edit_submit_" + id);
    hide_div("tag_edit_cancel_" + id);

    document.getElementById("tag_edit_box_" + id).style.clear = "none";
  };

  // Submits an edit request
  this.SubmitEdit = function(p_id) {    
    for ( var i = 0; i < m_master.length; i++) {
      if ((m_master[i].m_id == p_id) && (m_master[i].m_inuse)) {
        if (("" != m_master[i].m_oldname)) {
          alert("An operation is already pending on this tag.");          
          return;
        }
        if ("" == document.getElementById("tag_edit_input_" + p_id).value) {
          alert("You must give the tag a name.");
          return;
        }

        that.CancelEdit(p_id);
        
        if (m_master[i].m_name == document.getElementById("tag_edit_input_" + p_id).value)
        {
          //alert("The tag name has not changed.");
          return;
        }
        
        m_master[i].m_oldname = m_master[i].m_name;
        m_master[i].m_name = document.getElementById("tag_edit_input_" + p_id).value;       
        
        document.getElementById("tag_name_" + p_id).innerHTML = m_master[i].m_name;                      
        
        var url = "action=edit";
        url += "&tag_id=" + encodeURIComponent(m_master[i].m_id);
        url += "&name=" + encodeURIComponent(m_master[i].m_name);
        var request = new httpRequest("sources/mod_tag.php", that.EditCallback, m_master[i].m_id);
        request.update(url, "GET");
      }
    }

    m_master.sort(TagSort);
    document.getElementById('tag_lines').innerHTML = that.ViewAll();
  };

  // If the edit request fails 
  this.EditRollback = function(p_id) {
    for ( var i = 0; i < m_master.length; i++) {
      if (m_master[i].m_id == p_id) {
        m_master[i].m_name = m_master[i].m_oldname;
        document.getElementById("tag_edit_input_" + p_id).value = m_master[i].m_name;
        m_master[i].m_oldname = "";
      }
    }
    
    m_master.sort(TagSort);
    document.getElementById('tag_lines').innerHTML = that.ViewAll();    
  };

  // Called when the edit request returns
  this.EditCallback = function(p_text, p_status, p_xml, p_note) {
    that.CancelEdit(p_note);

    if (p_status != 200) {
      document.getElementById("tagblockfeedback").innerHTML = FeedbackBox("Server returned code " + p_status, false);
      that.EditRollback(p_note);
      return;
    }
    if ("OK" != p_text.substr(0, 2)) {
      document.getElementById("tagblockfeedback").innerHTML = FeedbackBox(p_text, false);
      that.EditRollback(p_note);
      return;
    } else {
      for ( var i = 0; i < m_master.length; i++) {
        if (m_master[i].m_id == p_note) {        
          m_master[i].m_oldname = "";
        }
      }          
    }
  };
  
  // Show the inline add tag form
  this.ShowAdd = function()
  {       
    document.getElementById("tag_add_line").innerHTML=add_form;    
    
    show_div("tag_add_box");
    show_div("tag_add_submit");
    show_div("tag_add_cancel");
    
    addEvent(document.getElementById('tag_add_input'), "keyup", function (e) { return checkKey(e, "tag_add_submit_button", "tag_add_cancel_button");});
    document.getElementById("tag_add_input").focus();
  };
  
  // Hides the inline add form
  this.HideAdd = function ()
  {
    document.getElementById("tag_add_input").blur();
    
    hide_div("tag_add_box");
    hide_div("tag_add_submit");
    hide_div("tag_add_cancel");
    
    document.getElementById("tag_add_line").innerHTML=add_link;
  };
  
  // Submit an add request
  this.SubmitAdd = function (p_NewTagName)
  {    
    if ("" == p_NewTagName) {
      alert("You must give the tag a name.");
      return;
    }
    
    that.CancelAdd();
    
    var tag = new Tag();
    
    tag.m_id    = m_fake_id;
    tag.m_name  = p_NewTagName;
    tag.m_inuse = true;
    
    m_master[m_master.length] = tag;
    m_fake_id--;
    
    var url = "action=add";
        url += "&name=" + encodeURIComponent(p_NewTagName);
    
    var request = new httpRequest("sources/mod_tag.php", that.AddCallback, tag.m_id);
    request.update(url, "GET");
    
    m_master.sort(TagSort);
    document.getElementById('tag_lines').innerHTML = that.ViewAll();
  };

  // Cancel button pressed
  this.CancelAdd = function ()
  {
    that.HideAdd();   
  };
  
  // Add request failed
  this.AddRollback = function(p_id) {
    for ( var i = 0; i < m_master.length; i++) {
      if (m_master[i].m_id == p_id) {
        m_master[i].m_inuse = false;
      }
    }
    
    m_master.sort(TagSort);
    document.getElementById('tag_lines').innerHTML = that.ViewAll();    
  };

  // Called when the add request returns
  this.AddCallback = function(p_text, p_status, p_xml, p_note) {
    that.CancelEdit(p_note);

    if (p_status != 200) {
      document.getElementById("tagblockfeedback").innerHTML = FeedbackBox(
          "Server returned code " + status, false);
      that.AddRollback(p_note);
      return;
    }
    if ("OK" != p_text.substr(0, 2)) {
      document.getElementById("tagblockfeedback").innerHTML = FeedbackBox(p_text,
          false);
      that.AddRollback(p_note);
      return;
    } else {
      for ( var i = 0; i < m_master.length; i++) {
        if (m_master[i].m_id == p_note) {        
          m_master[i].m_oldname = "";
          m_master[i].m_id = p_text.substr( 3);
          document.getElementById('tag_lines').innerHTML = that.ViewAll();
        }
      }      
    }
  };
  
  // Generate a list of all tags, highlighting current ones
  this.TagHintList = function(p_element)
  {
    var hintlist = "";
    var m_current_string = p_element.value;
    var m_current_tags = m_current_string.split(m_delimiter);
    var fclass = "";
    
    for ( var i = 0; i < m_master.length; i++) {
      fclass = "tag_hint_inner";
      for (var j = 0; j < m_current_tags.length; j++)
      {
        if (trim(m_current_tags[j].toUpperCase()) == m_master[i].m_name.toUpperCase())
        {
          
          fclass = "tag_hint_inner_match";
        }
      }
      hintlist += "<div class='tag_hint_outer'><div class='"+fclass+"'>" + m_master[i].m_name + "</div></div>";
    }
    
    return overlib(hintlist, ADAPTIVE_WIDTH, 50); 
  };
}