// Standard string replace functionality
function str_replace(p_haystack, p_needle, p_replacement)
{
  var temp = p_haystack.split(p_needle);
  return temp.join(p_replacement);
}

// Returns a shortened version of a string greater than 30 characters as the
// first x characters of that string post fixed with "...".
function ShortName(p_name)
{
  var newName = p_name;
  if (p_name.length > title_max_length)
  {

    newName = p_name.substr(0, (title_max_length-3))+"...";
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

function StripHTMLTags(p_text)
{
  var BannedHTMLTagList = new Array( "html"
		                           , "head"
		                           , "body"
		                           , "iframe"
		                           , "object"
		                           , "script"
		                           , "meta");
  
  var CurrentPos  = 0;
  var MaxPos      = p_text.length;
  var Buffer      = "";
  
  while (CurrentPos < MaxPos) {
    Start = p_text.indexOf("<", CurrentPos);
    End = p_text.indexOf(">", CurrentPos);
    
    if ((End == -1) || (Start == -1)) {
      Buffer += p_text.substr( CurrentPos, MaxPos - CurrentPos);
      CurrentPos = MaxPos;    
    }
    else
    {    
      Buffer += p_text.substr( CurrentPos, Start - CurrentPos);

      Tag = p_text.substr( Start + 1, End - Start - 1);
      Tag = trim(Tag);
      Tag = Tag.toLowerCase();
      
      TagWithoutSlashes = Tag;
      if (Tag.charAt(0) == "/") {
        TagWithoutSlashes = Tag.substr( 1, Tag.length - 1);
      }
      
      if (-1 == TagWithoutSlashes.indexOf(" ", 0)) {
        Name = TagWithoutSlashes;
      }
      else
      {
        Name = TagWithoutSlashes.split(" ", 1);
      }
      
      Found = false;
      
      for (i=0; i < BannedHTMLTagList.length;i++) {
        if (BannedHTMLTagList[i] == Name) {
          Found = true;
        }
      }
      
      if (Found == true) {
        Buffer += "&lt;";
        Buffer += Tag;
        Buffer += "&gt;";
      }
      else
      {
        Buffer += "<";
        Buffer += Tag;
        Buffer += ">";
      }
      CurrentPos = End + 1;
    }
  }
  return Buffer;
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
  var p_type = "Success";

  var newtext = feedback_box;

  // Strip out ERROR and IERROR
  var stub = p_text.substring(0, 5);
  if ("ERROR" == stub)
  {
	  p_text = p_text.substring(6, 4096);
	  p_type = "Error";
  }
  
  stub = p_text.substring(0, 6);
  if ("IERROR" == stub)
  {
	  p_text = p_text.substring(7, 4096);
	  p_type = "Error";
  }

  stub = p_text.substring(0, 2);
  if ("OK" == stub)
  {
    p_text = p_text.substring(3, 4096);
  }

  newtext = str_replace(newtext, "<moavar FeedbackType>", p_type);
  newtext = str_replace(newtext, "<moavar FeedbackText>", p_text);

  return newtext;
}

//Applies neccesary styles to a DIV in order to hide id from view on a page.
function hide_div( p_name)
{
   document.getElementById(p_name).style.display = "none";
   //document.getElementById(p_name).style.position = "absolute";
   //document.getElementById(p_name).style.cssFloat = "none";
}

// Applies neccesary styles to a DIV in order to make it visable on a page.
function show_div( p_name)
{
   //document.getElementById(p_name).style.position = "static";
   //document.getElementById(p_name).style.cssFloat = "left";
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
};

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

function bin2hex(s) {
  // Converts the binary representation of data to hex  
  // 
  // version: 812.316
  // discuss at: http://phpjs.org/functions/bin2hex
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   bugfixed by: Onno Marsman
  // +   bugfixed by: Linuxworld
  // *     example 1: bin2hex('Kev');
  // *     returns 1: '4b6576'
  // *     example 2: bin2hex(String.fromCharCode(0x00));
  // *     returns 2: '00'
  var v,i, f = 0, a = [];
  s += '';
  f = s.length;
  
  for (i = 0; i<f; i++) {
      a[i] = s.charCodeAt(i).toString(16).replace(/^([\da-f])$/,"0$1");
  }
  
  return a.join('');
}