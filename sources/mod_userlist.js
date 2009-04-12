// Used to sort users alphabetically
function UserSort(p_a, p_b)
{
  if (p_a.m_name.toLowerCase() > p_b.m_name.toLowerCase())
  {
    return 1;
  } else
  {
    return -1;
  }
}

// Structure to store info about one user
function User()
{
  this.m_id = "";
  this.m_name = "";
  this.m_admin = false;
  this.m_inuse = false;
  this.m_old_name = "";
  this.m_old_admin = false;
  this.m_old_innerHTML = "";
}

// Class to keep track of all users
function UserList(p_delim, p_user_row_template)
{
  var that = this;
  
  var m_delimiter = p_delim;
  var m_users = new Array(); // All users in Moa Gallery
  var m_userlistHTML = "";
  var m_fake_id = -1;  // To keep track of new users before a page load
  var m_add_mode = false;
  var m_user_row_template = p_user_row_template;
  
  // Load user values into memory when we start
  this.PreLoad = function( p_master)
  {
    m_users = new Array();
    var all_users = p_master.split( m_delimiter);    
    
    for (var i = 0; i < all_users.length; i++)
    {      
      if (all_users[i].length > 0)
      {
        var pos = all_users[i].indexOf('=');
        var user = new User();
      
        user.m_id   = all_users[i].substring(0, pos);
        
        var new_str = all_users[i].substring(pos + 1);
        pos = new_str.indexOf('=');
        
        if(0 == new_str.substring(0, pos))
        {
          user.m_admin = false;
        } else
        {
          user.m_admin = true;
        }
        user.m_name = new_str.substring(pos + 1);
        user.m_inuse = true;
      
        m_users[i] = user;        
      }
    }
    m_users.sort(UserSort);
  };
  
  // Add a new user internally
  this.Assimilate = function(user)
  {
    var mcount = m_users.length;
    
    m_users[mcount] = user;
    var id = ""+m_fake_id;
    m_users[mcount].m_id = id;
    m_fake_id--;
    m_users.sort(UserSort);
  };
  
  // Display a single row in the user table
  this.ViewSingle = function(index)
  {
    var val = m_user_row_template;
    var rights = "";
    
    if (1 == m_users[index].m_admin)
    {
      rights = "Admin\n";
    } else
    {
      rights = "&nbsp;\n";
    }
    
    val = str_replace(val, "<moavar AdminUserID>", m_users[index].m_id);
    val = str_replace(val, "<moavar AdminUserName>", m_users[index].m_name);
    val = str_replace(val, "<moavar AdminUserRights>", rights);
    
    val = str_replace(val, "<moavar AdminUserEditLink>", "onclick='javascript: user_list.Edit(\""+m_users[index].m_id+"\");'");
    val = str_replace(val, "<moavar AdminUserDeleteLink>", "onclick='javascript: user_list.Delete(\""+m_users[index].m_id+"\");'");
    
    return val;
  };
  
  // Show the user table
  this.ViewAll = function()
  {
    var val = "";
    for (var i = 0; i < m_users.length; i++)
    {
      if (m_users[i].m_inuse)
      {
        val += that.ViewSingle(i);
      }
    }
    return val;
  };

  // If the delete request fails, restore the user
  this.DeleteRollback = function(p_id)
  {
    for (var i = 0; i < m_users.length; i++)
    {
      if (m_users[i].m_id == p_id)
      {
        m_users[i].m_name = m_users[i].m_old_name;
        m_users[i].m_admin = m_users[i].m_old_admin;
        document.getElementById('user_'+p_id).innerHTML = m_users[i].m_old_innerHTML;
        m_users[i].m_inuse = true;
        m_users[i].m_old_name = "";
        m_users[i].m_old_admin = "";
        m_users[i].m_old_innerHTML = "";
      }
    }
  };
  
  // When the delete request returns from the server
  this.DeleteCallback = function(p_text, p_status, p_xml, p_note)
  {
    if (p_status != 200)
    {
      document.getElementById("userblockfeedback").innerHTML = FeedbackBox("Server returned code " + p_status, false);   
      that.DeleteRollback(""+p_note);
      return;
    }
    if ("OK" != p_text.substr(0, 2))
    {
      document.getElementById("userblockfeedback").innerHTML = FeedbackBox(p_text, false);      
      that.DeleteRollback(""+p_note);
      return;
    } else
    {
      var id = p_text.substr(3);
      
      for (var i = 0; i < m_users.length; i++)
      {
        if ((m_users[i].m_id == id) && (!m_users[i].m_inuse))
        {
          document.getElementById("userblockfeedback").innerHTML = FeedbackBox("Deleted \""+m_users[i].m_name+"\"", true);
          document.getElementById('user_lines').removeChild(document.getElementById('user_'+p_note));
          m_users[i].m_old_name = "";
          m_users[i].m_old_admin = "";
          m_users[i].m_old_innerHTML = "";
        }
      }
    }
  };
  
  // Request a user to be deleted
  this.Delete = function(p_id)
  {
    for (var i = 0; i < m_users.length; i++)
    {
      if ((m_users[i].m_id == p_id) && (m_users[i].m_inuse))
      {
        if ("" != m_users[i].m_old_name)
        {
          alert("An operation is already pending on this user.");
        } else
        {
          if (confirm("Are you sure you want to delete this user ("+m_users[i].m_name+")?"))
          {
            m_users[i].m_inuse = false;
            m_users[i].m_old_name = m_users[i].m_name;
            m_users[i].m_old_admin = m_users[i].m_admin;
            m_users[i].m_old_innerHTML = document.getElementById('user_'+p_id).innerHTML;
            var url = "action=delete&user_id="+p_id;
            var request = new httpRequest("sources/mod_user.php", that.DeleteCallback, m_users[i].m_id);
            request.update(url, "GET");
            document.getElementById('user_'+p_id).innerHTML = "";
          }
        }
      }
    }
  };
  
  // Show the edit form
  this.Edit = function(p_id)
  {
    m_userlistHTML = document.getElementById('userblock').innerHTML;
    document.getElementById('userblock').innerHTML = userform;
    addEvent(document.getElementById('username'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    addEvent(document.getElementById('useradmin'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    addEvent(document.getElementById('userpass1'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    addEvent(document.getElementById('userpass2'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    
    for (var i = 0; i < m_users.length; i++)
    {
      if (m_users[i].m_id == p_id)
      {
        document.getElementById('username').value = m_users[i].m_name;
        document.getElementById('userid').value = p_id;
        if (m_users[i].m_admin)
        {
          document.getElementById('useradmin').checked = true;
        }
      }
    }
    document.getElementById('username').focus();
    m_add_mode = false;
  };
  
  // Show the add form
  this.Add = function()
  {
    m_userlistHTML = document.getElementById('userblock').innerHTML;
    document.getElementById('userblock').innerHTML = userform;
    document.getElementById('username').focus();
    addEvent(document.getElementById('username'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    addEvent(document.getElementById('useradmin'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    addEvent(document.getElementById('userpass1'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    addEvent(document.getElementById('userpass2'), "keypress", function (e) {checkKey(e, "formsubmit", "formcancel");});
    m_add_mode = true;
  };
  
  // The form submit failed so restore any edits made
  this.FormRollback = function(p_id)
  {
    // Edit mode
    if (!m_add_mode)
    {
      for (var i = 0; i < m_users.length; i++)
      {
        if (m_users[i].m_id == p_id)
        {
          m_users[i].m_name = m_users[i].m_old_name;
          m_users[i].m_admin = m_users[i].m_old_admin;
          document.getElementById('username_'+p_id).innerHTML = m_users[i].m_name;
          if (m_users[i].m_admin)
          {
            document.getElementById('useradmin_'+p_id).innerHTML = "Admin";
          } else
          {
            document.getElementById('useradmin_'+p_id).innerHTML = "&nbsp;";
          }
          m_users[i].m_inuse = true;
          m_users[i].m_old_name = "";
          m_users[i].m_old_admin = "";
          m_users[i].m_old_innerHTML = "";
        }
      }
      m_users.sort(UserSort);
      document.getElementById('user_lines').innerHTML=user_list.ViewAll();
    } else
    // Add mode
    {
      var line = document.getElementById('user_'+p_id);
      document.getElementById('user_lines').removeChild(line);
      for (var i = 0; i < m_users.length; i++)
      {
        if (m_users[i].m_id == p_id)
        {
          m_users[i].m_inuse = false;
        }
      }
    }
  };
  
  // Form submit has completed
  this.FormCallback = function(p_text, p_status, p_xml, p_note)
  {
    if (p_status != 200)
    {
      document.getElementById("userblockfeedback").innerHTML = FeedbackBox("Server returned code " + p_status, false);   
      that.FormRollback(p_note);
      return;
    }
    if ("OK" != p_text.substr(0, 2))
    {
      document.getElementById("userblockfeedback").innerHTML = FeedbackBox(p_text, false);      
      that.FormRollback(p_note);
      return;
    } else
    {
      var id = p_text.substr(3);
      
      for (var i = 0; i < m_users.length; i++)
      {
        if ((m_users[i].m_id == p_note) && (m_users[i].m_inuse))
        {
          // Edit mode
          if (!m_add_mode)
          {
            m_users[i].m_old_name = "";
            m_users[i].m_old_innerHTML="";
            m_users[i].m_admin = false;
          } else
          // Add mode
          {
            m_users[i].m_id = id;
            var line = document.getElementById('user_'+p_note);
            if (null != line)
            {
              document.getElementById('user_lines').innerHTML=user_list.ViewAll();
            }
            document.getElementById("userblockfeedback").innerHTML = FeedbackBox("User added ("+m_users[i].m_name+").", true);
          }
        }
      }
    }
  };

  // Cancel button pressed 
  this.FormCancel = function()
  {
    document.getElementById('userblock').innerHTML = m_userlistHTML;
    m_users.sort(UserSort);
    document.getElementById('user_lines').innerHTML=user_list.ViewAll();
    m_userlistHTML = "";
  };
  
  // Submit button pressed
  this.FormSubmit = function()
  {
    var name = document.getElementById("username").value;
    var pass1 = document.getElementById("userpass1").value;
    var pass2 = document.getElementById("userpass2").value;
    var admin = document.getElementById("useradmin").checked;
    var id = document.getElementById("userid").value;
    var valid = true;
    
    // Check for a name
    if ("" == name)
    {
      alert("You must supply a user name.");
      valid = false;
    }
    
    // Check for mismatched passwords
    if (pass1 != pass2)
    {
      alert("The passwords do not match.");
      valid = false;
    }
    
    // All seems ok, submit it
    if (valid)
    {
      document.getElementById('userblock').innerHTML = m_userlistHTML;
      m_users.sort(UserSort);
      document.getElementById('user_lines').innerHTML=user_list.ViewAll();
      m_userlistHTML = "";
      // Edit mode
      if (!m_add_mode)
      {
        for (var i = 0; i < m_users.length; i++)
        {
          if (m_users[i].m_id == id)
          {
            m_users[i].m_old_name = m_users[i].m_name;
            m_users[i].m_old_admin = m_users[i].m_admin;
            m_users[i].m_old_innerHTML = document.getElementById("user_"+id);
            
            m_users[i].m_name = name;
            m_users[i].m_admin = admin;
            
            document.getElementById('username_'+id).innerHTML = m_users[i].m_name;
            if (m_users[i].m_admin)
            {
              document.getElementById('useradmin_'+id).innerHTML = "Admin";
            } else
            {
              document.getElementById('useradmin_'+id).innerHTML = "&nbsp;";
            }
            
            var url = "action=edit";
               url += "&user_id="+id;
               url += "&name="+encodeURIComponent(name);
               url += "&admin="+admin;
               url += "&pass="+encodeURIComponent(pass1);
            var request = new httpRequest("sources/mod_user.php", that.FormCallback, id);
            request.update(url, "GET");
            
            m_users.sort(UserSort);
            document.getElementById('user_lines').innerHTML=user_list.ViewAll();
          }
        }
      } else
      // Add mode
      {
        var user = new User();
        user.m_name = name;
        user.m_id = m_fake_id;
        user.m_admin = admin;
        user.m_inuse = true;
        user.m_old_name = "";
        user.m_old_admin = false;
        user.innerHTML = "";
        m_users[m_users.length] = user;
        
        var url = "action=add";
        url += "&name="+encodeURIComponent(name);
        url += "&admin="+admin;
        url += "&pass="+encodeURIComponent(pass1);
        var request = new httpRequest("sources/mod_user.php", that.FormCallback, m_fake_id);
        request.update(url, "GET");
        
        m_fake_id--;

        m_users.sort(UserSort);
        document.getElementById('user_lines').innerHTML=user_list.ViewAll();
      }
    }
  };
}
