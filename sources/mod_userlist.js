var LastAction = 
{ 
  none: 0,   
  addUser: 1,  
  editUser: 2,
  deleteUser: 3
};

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
function UserList(p_delim, p_user_container_template, p_user_row_template)
{
  var that = this;
  
  var m_delimiter = p_delim;
  var m_users = new Array(); // All users in Moa Gallery
  var m_userlistHTML = "";
  var m_fake_id = -1;  // To keep track of new users before a page load
  var m_add_mode = false;
  var m_user_row_template = p_user_row_template;
  var m_user_container_template = p_user_container_template;
  
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
    var cont = m_user_container_template;
    var val = "";
    for (var i = 0; i < m_users.length; i++)
    {
      if (m_users[i].m_inuse)
      {
        val += that.ViewSingle(i);
      }
    }
    cont = str_replace(cont, "<moavar AdminUserList>", val);
    return cont;
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
        case 'UserAdd':
        {
          for (var i = 0; i < m_users.length; i++)
          {
            if ((m_users[i].m_id == result.fake_id) && (m_users[i].m_inuse))
            {
              m_users[i].m_id = result.UserID;
              var line = $('#user_'+result.fake_id);
              $('#user_'+result.fake_id).attr('id','user_'+result.UserID);

              if (null != line)
              {
                $('#user_lines').html( user_list.ViewAll());
              }
              MoaUI.DisplayFeedback("User added ("+m_users[i].m_name+").", Feedback.success);
            }
          }
          break;
        }
        case 'UserEdit':
        {
          for (var i = 0; i < m_users.length; i++)
          {
            if ((m_users[i].m_id == m_lastID) && (m_users[i].m_inuse))
            {
              m_users[i].m_old_name = "";
              m_users[i].m_old_innerHTML="";
              m_users[i].m_old_admin = false;
            }
          }
          break;
        }
        case 'UserDelete':
        {
          for (var i = 0; i < m_users.length; i++)
          {
            if ((m_users[i].m_id == m_lastID) && (!m_users[i].m_inuse))
            {
              MoaUI.DisplayFeedback('Deleted "'+m_users[i].m_name+'"', Feedback.success);
              m_users[i].m_old_name = "";
              m_users[i].m_old_admin = "";
              m_users[i].m_old_innerHTML = "";
            }
          }
          break;
        }
        default:
        { 
          that.AjaxCallbackFail({status: 'Unknown error - ', statusText: result.Status});
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
      case LastAction.addUser:
      {
        $('#user_'+m_lastID).remove();

        for (var i = 0; i < m_users.length; i++)
        {
          if (m_users[i].m_id == m_lastID)
          {
            m_users[i].m_inuse = false;
          }
        }
        break;
      }
      case LastAction.editUser:
      {
        for (var i = 0; i < m_users.length; i++)
        {
          if (m_users[i].m_id == m_lastID)
          {
            m_users[i].m_name = m_users[i].m_old_name;
            m_users[i].m_admin = m_users[i].m_old_admin;
            $('#username_'+m_lastID).html( m_users[i].m_name);
            if (m_users[i].m_admin)
            {
              $('#useradmin_'+m_lastID).html('Admin');
            } else
            {
              $('#useradmin_'+m_lastID).html( '&nbsp;');
            }
            m_users[i].m_inuse = true;
            m_users[i].m_old_name = "";
            m_users[i].m_old_admin = "";
            m_users[i].m_old_innerHTML = "";
          }
        }
        m_users.sort(UserSort);
        $('#user_lines').html( user_list.ViewAll());
        break;
      }
      case LastAction.deleteUser:
      {
        for (var i = 0; i < m_users.length; i++)
        {
          if (m_users[i].m_id == m_lastID)
          {
            m_users[i].m_name = m_users[i].m_old_name;
            m_users[i].m_admin = m_users[i].m_old_admin;
            $('#user_'+m_lastID).html( m_users[i].m_old_innerHTML);
            m_users[i].m_inuse = true;
            m_users[i].m_old_name = "";
            m_users[i].m_old_admin = "";
            m_users[i].m_old_innerHTML = "";
          }
        }
        break;
      }
    }
    
    MoaUI.DisplayFeedback( 'Server returned "' + p_request.status + ' ' + p_request.statusText + '".', Feedback.error);
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
            m_users[i].m_old_innerHTML = $('#user_'+p_id).html();
            
            var params = '?action=delete';
                params += '&user_id='+p_id;
            
            
            m_lastAction = LastAction.deleteUser;   
            m_lastID = p_id;
            $.ajax({ url: 'sources/mod_user.php' + params,
                     success: that.AjaxCallback,
                     error: that.AjaxCallbackFail,
                     cache: false});

            $('#user_'+p_id).hide(500);
          }
        }
      }
    }
  };
  
  // Show the edit form
  this.Edit = function(p_id)
  {
    m_userlistHTML = $('#userblock').html();
    $('#userblock').html( userform);
    
    for (var i = 0; i < m_users.length; i++)
    {
      if (m_users[i].m_id == p_id)
      {
        $('#username').val( m_users[i].m_name);
        $('#userid').val( p_id);
        if (m_users[i].m_admin)
        {
          $('#useradmin').attr('checked', true);
        }
      }
    }
    FormCheckSetup('user_edit', false);
    $('#username').focus();
    m_add_mode = false;
  };
  
  // Show the add form
  this.Add = function()
  {
    m_userlistHTML = $('#userblock').html();
    $('#userblock').html( userform);
    FormCheckSetup('user_add');
    $('#username').focus();
    m_add_mode = true;
  };
  
  // Cancel button pressed 
  this.FormCancel = function()
  {
    $('#userblock').html( m_userlistHTML);
    m_users.sort(UserSort);
    $('#user_lines').html( user_list.ViewAll());
    m_userlistHTML = "";
    $('#admin_user_add_link').click(function(){that.Add();});
  };
  
  // Submit button pressed
  this.FormSubmit = function()
  {
    if (!FormCheck())
    {
      return false;
    }
    var name = $('#username').val();
    var pass1 = $('#userpass1').val();
    var pass2 = $('#userpass2').val();
    var admin = $('#useradmin').attr('checked');
    var id = $('#userid').val();
    var valid = true;
    
    // All seems ok, submit it
    if (valid)
    {
      $('#userblock').html( m_userlistHTML);
      m_users.sort(UserSort);
      $('#user_lines').html( user_list.ViewAll());
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
            m_users[i].m_old_innerHTML = $('#user_'+id);
            
            m_users[i].m_name = name;
            m_users[i].m_admin = admin;
            
            $('#username_'+id).html( m_users[i].m_name);
            if (m_users[i].m_admin)
            {
              $('#useradmin_'+id).html( 'Admin');
            } else
            {
              $('#useradmin_'+id).html( '&nbsp;');
            }
            
            m_lastID = id;
            m_lastAction = LastAction.editUser;
            var params = "?action=edit";
                params += "&user_id="+id;
                params += "&name="+encodeURIComponent(name);
                params += "&admin="+admin;
                params += "&pass="+encodeURIComponent(pass1);
            $.ajax({ url: 'sources/mod_user.php' + params,
                     success: that.AjaxCallback,
                     error: that.AjaxCallbackFail,
                     cache: false});    
            
            m_users.sort(UserSort);
            $('#user_lines').html( user_list.ViewAll());
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
        
        m_lastID = m_fake_id;
        m_lastAction = LastAction.addUser;
        var params = "?action=add";
            params += "&name="+encodeURIComponent(name);
            params += "&admin="+admin;
            params += "&fake_id="+m_fake_id;
            params += "&pass="+encodeURIComponent(pass1);
            
        $.ajax({ url: 'sources/mod_user.php' + params,
                 success: that.AjaxCallback,
                 error: that.AjaxCallbackFail,
                 cache: false});    
        
        m_fake_id--;

        m_users.sort(UserSort);
        $('#user_lines').html( user_list.ViewAll());
      }
    }
  };
}
