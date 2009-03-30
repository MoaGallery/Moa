// Standard string replace functionality
function str_replace(p_haystack, p_needle, p_replacement)
{
  var temp = p_haystack.split(p_needle);
  return temp.join(p_replacement);
}

// Returns a shortened version of a string greater than 30 characters as the
// first 27 characters of that string post fixed with "...".
function ShortName(p_name)
{
  var newName = p_name;

  if (p_name.length > 30)
  {
    newName = p_name.substr(0, 27)+"...";
  }    
  return newName;
}

// Standard whitespace trimming function that will remove leading and trailing spaces from a string 
function trim(p_text)
{
  var result = p_text.replace(/^\s+|\s+$/g, '');
  
  return result;
}

function EscapeHTMLChars(p_text)
{
  p_text = str_replace(p_text, "&", "&amp;");
  p_text = str_replace(p_text, "<", "&lt;");
  p_text = str_replace(p_text, ">", "&gt;");
  
  return p_text;
}

function EscapeNewLine(p_text)
{
  p_text = str_replace(p_text, "\n", "<br />");
 
  return p_text;
}

function UnEscapeNewLine(p_text)
{
  p_text = str_replace(p_text, "<br />", "\n");
 
  return p_text;
}

function FeedbackBox(p_text, p_success)
{
  var p_type = "error";
  var p_name = "Error";
  if (p_success)
  {
    p_type = "success";
    p_name = "Success";
  }
  var newtext = "<div class='" + p_type + "_box' style='line-height:40px;'>\n";
  newtext += "<img src='media/" + p_type + ".png' style='vertical-align:middle;' alt='" + p_name + "'/>\n";
  newtext += "  " + p_name + ": " + p_text + "\n";
  newtext += "</div><br/>\n";
  
  return newtext;
}

//Applies nesesary styles to a DIV in order to hide id from view on a page.
function hide_div( p_name)
{
   document.getElementById(p_name).style.display = "none";         
   document.getElementById(p_name).style.position = "absolute";
   document.getElementById(p_name).style.cssFloat = "none";
}

// Applies nesesary styles to a DIV in order to make it visable on a page.
function show_div( p_name)
{               
   document.getElementById(p_name).style.position = "static";                
   document.getElementById(p_name).style.cssFloat = "left";        
   document.getElementById(p_name).style.display = "block";
}

// Helper function that can be attached to the key event on a form input object.
// Activates the submit button when Enter is pressed and the cancel button when escape is pressed.
function checkKey(p_e, p_submit, p_cancel)
{
  var characterCode;
  
  if(p_e && p_e.which)
  {
    p_e = p_e;
    characterCode = p_e.which;
  }
  else
  {
    //e = event
    characterCode = p_e.keyCode;
  }
  
  // Check for enter
  if((characterCode == 13) && (null != p_submit))
  {
    document.getElementById(p_submit).click();
    if(p_e.preventDefault)
    {
      p_e.preventDefault();
    } else
    {
      p_e.returnValue = false;
    }
    return false;
  }
  
  // Check for escape
  if((characterCode == 27) && (null != p_cancel))
  {
    document.getElementById(p_cancel).click();
    if(p_e.preventDefault)
    {
      p_e.preventDefault();
    } else
    {
      p_e.returnValue = false;
    }
    return false;
  }
  
  return true;
}

// Add an event function to a javascript DOM object
function addEvent( p_obj, p_type, p_fn )
{
  if (p_obj.addEventListener)
    p_obj.addEventListener( p_type, p_fn, false );
  else if (p_obj.attachEvent)
  {
    p_obj["e"+p_type+p_fn] = p_fn;
    p_obj[p_type+p_fn] = function() { p_obj["e"+p_type+p_fn]( window.event ); }
    p_obj.attachEvent( "on"+p_type, p_obj[p_type+p_fn] );
  }
}

//Remove an event function from a DOM object
function removeEvent( p_obj, p_type, p_fn )
{
  if (p_obj.removeEventListener)
    p_obj.removeEventListener( p_type, p_fn, false );
  else if (p_obj.detachEvent)
  {
    p_obj.detachEvent( "on"+p_type, p_obj[p_type+p_fn] );
    p_obj[p_type+p_fn] = null;
    p_obj["e"+p_type+p_fn] = null;
  }
}
