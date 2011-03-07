// Set up bit-flags to use on form elements
var NOT_BLANK = 1;
var NUMERIC = 2;
var ABSOLUTE_PATH = 4;
var RELATIVE_PATH = 8;
var CONFIRMATION = 16;
var COMBOSET = 32;

var formElements = null;

// Structure to describe which checks to do on a named form element
function FormField(p_name, p_checks )
{
  this.name = p_name;
  this.checks = p_checks;
}

// Populate list of checks for this page
function FormCheckSetup(p_pageName, p_useTags)
{
  formElements = new Array();
  formElements.length = 0;
  
  switch (p_pageName)
  {
    case 'image_add' : 
    {
      formElements[0] = new FormField('imageformfilename', NOT_BLANK);
      if (p_useTags)
      {
        formElements[1] = new FormField('imageformtags', NOT_BLANK);
      }
      break;
    }
    case 'image_view' : 
    {
      if (p_useTags)
      {
        formElements[0] = new FormField('imageformtags', NOT_BLANK);
      }
      break;
    }
    case 'gallery_add' : 
    {
      formElements[0] = new FormField('galleryformname', NOT_BLANK);
      if (p_useTags)
      {
        formElements[1] = new FormField('galleryformtags', NOT_BLANK);
      }
      break;
    }
    case 'admin_ftp' : 
    {
      formElements[0] = new FormField('ftpformparent_id', COMBOSET);
      break;
    }
    case 'gallery_view' : 
    {
      formElements[0] = new FormField('galleryformname', NOT_BLANK);
      if (p_useTags)
      {
        formElements[1] = new FormField('galleryformtags', NOT_BLANK);
      }
      break;
    }
    case 'login' : 
    {
      formElements[0] = new FormField('loginname', NOT_BLANK);
      formElements[1] = new FormField('loginpass', NOT_BLANK);
      break;
    }
    case 'settings' : 
    {
      formElements[0] = new FormField('setting_TitleDescLength', NOT_BLANK | NUMERIC);
      formElements[1] = new FormField('setting_StrDelimiter', NOT_BLANK);
      formElements[2] = new FormField('setting_ThumbWidth', NOT_BLANK | NUMERIC);
      formElements[3] = new FormField('setting_ConfigDisplayMaxWidth', NOT_BLANK | NUMERIC);
      formElements[4] = new FormField('setting_ImagesPerPage', NOT_BLANK | NUMERIC);
      formElements[5] = new FormField('setting_MoaPath', NOT_BLANK | ABSOLUTE_PATH);
      formElements[6] = new FormField('setting_ImagePath', NOT_BLANK | RELATIVE_PATH);
      formElements[7] = new FormField('setting_ThumbPath', NOT_BLANK | RELATIVE_PATH);
      formElements[8] = new FormField('setting_CookiePath', NOT_BLANK | ABSOLUTE_PATH);
      formElements[9] = new FormField('setting_IncomingPath', NOT_BLANK | RELATIVE_PATH);
      formElements[10] = new FormField('setting_CookieName', NOT_BLANK);
      formElements[11] = new FormField('setting_DBHost', NOT_BLANK);
      formElements[12] = new FormField('setting_DBName', NOT_BLANK);
      formElements[13] = new FormField('setting_DBUser', NOT_BLANK);
      formElements[14] = new FormField('setting_DBPass', NOT_BLANK);
      formElements[15] = new FormField('setting_TabPrefix', NOT_BLANK);
      break;
    }
    case 'user_add' : 
    {
      formElements[0] = new FormField('username', NOT_BLANK);
      formElements[1] = new FormField('userpass1', NOT_BLANK);
      formElements[2] = new FormField('userpass2', CONFIRMATION);
      break;
    }
    case 'user_edit' : 
    {
      formElements[0] = new FormField('username', NOT_BLANK);
      formElements[1] = new FormField('userpass2', CONFIRMATION);
      break;
    }
    case 'admin_maintain_image' : 
    {
      formElements[0] = new FormField('imageformfilename', NOT_BLANK);
      break;
    }
  }
}

function IsBitSet(source, value)
{
  if (0 < (value & source))
  {
    return true;
  }
  
  return false;
}

function CheckField(fieldname, checks)
{
  result = true;
  // Check if the element is blank if needed
  if (IsBitSet(checks, NOT_BLANK))
  {
    value = $('#' + fieldname).val();
    if (0 == value.length)
    {
      result = false;
    }
  }
  
  // Check that a text field only contains numbers
  if (IsBitSet(checks, NUMERIC))
  {
    value = $('#' + fieldname).val();
    value = trim(value);
    intValue = parseInt(value);
    if (intValue)
    {
      len1 = value.length;
      value2 = "" + intValue;
      len2 = value2.length;
      if (len1 != len2)
      {
        result = false;
      }
    }
  }
  
  // Check that a path is absolute
  if (IsBitSet(checks, ABSOLUTE_PATH))
  {
    value = $('#' + fieldname).val();
    value = trim(value);
    
    // Check for a leading slash 
    if (!(value.charAt(0) == "\\" || value.charAt(0) == "/"))
    {
      if (!(value.charAt(1) == ":" && 
          ((value.charAt(2) == "\\") || 
           (value.charAt(2) == "/"))))
      {    	 
        result = false;
      }
    }
  }
  
  // Check that a path is relative
  if (IsBitSet(checks, RELATIVE_PATH))
  {
    value = $('#' + fieldname).val();
    value = trim(value);
    
    // Check no leading slash 
    if (value.charAt(0) == "\\" || value.charAt(0) == "/")
    {
      result = false;
    }
    
    // Check they aren't trying to go back out of this path 
    if (value.indexOf("..") != -1)
    {
      result = false;
    }
    
    // Check they aren't trying to go back out of this path via the home directory 
    if (value.indexOf("~") != -1)
    {
      result = false;
    }
  }
  
  // Check that a combobox isn't empty
  if (IsBitSet(checks, COMBOSET))
  {
    value = $("#" + fieldname + " option:selected").text();
    if (value == "")
    {
      result = false;
    }
  }
  
  // Check a confirmation field
  if (IsBitSet(checks, CONFIRMATION))
  {
    value1 = $('#' + fieldname).val();
    num = fieldname[fieldname.length-1];
    if (num == 1)
    {
      num = 2;
    } else
    {
         num = 1;
    }
    fieldname2 = fieldname.replace(fieldname[fieldname.length-1], num);
    value2 = $('#' + fieldname2).val();
    if (value1 != value2)
    {
      result = false;
    }
  }
  
  if (!result)
  {
    // TODO Change comment bit to hide/show.
    // Field isn't right
    $('#' + fieldname).addClass('invalidfield');
    $('#' + fieldname + 'comment').removeClass('invalidfieldcomment');
  } else
  {
    // Field is OK
    $('#' + fieldname).removeClass('invalidfield');
    $('#' + fieldname + 'comment').addClass('invalidfieldcomment');
  }
  
  return result;
}

function FormCheck()
{
  checksPassed = true;
  $('input').removeClass('invalidfield');
  $('.invalidfieldstyle').addClass('invalidfieldcomment');
  for (i = 0; i< formElements.length; i++)
  {
    result = CheckField(formElements[i].name, formElements[i].checks);
    if (!result)
    {
      checksPassed = false;
    }
  }
  
  return checksPassed;
}
