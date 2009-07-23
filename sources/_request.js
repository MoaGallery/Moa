/*-------------------------------------------------------*/
/* http Classes (Javascript)                             */
/* Copyright (c)2009 Richard Talbutt \ Dan Brown         */
/*                                                       */
/* Provides Javascript classes for request Put & Get     */
/* methods.                                              */
/*                                                       */
/* Also provided is a class that will allow http request */
/* like functionality to be achieved using an IFRAME tag */
/*-------------------------------------------------------*/

// Class - Allows dynamic communication with server using a XMLHttpRequest 
function httpRequest(p_requestUrl, p_callbackFunction, p_note)
{
  var that    = this;
  var m_urlCall = p_requestUrl;
  var m_note    = p_note;

  this.m_updating = false;
  this.m_callback = p_callbackFunction || function () { };

  this.m_http = null;
  
  this.abort = function() {
    if (that.m_updating)
    {
      that.m_updating=false;
      that.m_http.abort();
      that.m_http=null;
    }
  };

  this.update = function(p_postData, p_postMethod) {
    if (that.m_updating) { return false; }
    that.m_http = null;
    if (window.XMLHttpRequest) {
      that.m_http=new XMLHttpRequest();
    }
    else
    {
      that.m_http=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (that.m_http==null)
    {
      return false;
    }
    else
    {
      that.m_http.onreadystatechange = function() {
        if (that.m_http.readyState==4) {
          that.m_updating=false;
          that.m_callback(that.m_http.responseText,that.m_http.status,that.m_http.responseXML, m_note);
          that.m_http=null;
        }
      }

      that.m_updating = new Date();

      switch (p_postMethod.toUpperCase())
      {
        case 'POST': // Use HTTP POST method to send request
        {
          var uri=m_urlCall+'?'+that.m_updating.getTime();

          that.m_http.open("POST", uri, true);
          that.m_http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          that.m_http.setRequestHeader("Content-Length", p_postData.length);
          that.m_http.send(p_postData);

          break;
        }
        case 'GET': // Use HTTP GET method to send request
        {
          var uri=m_urlCall+'?'+p_postData+'&timestamp='+(that.m_updating.getTime());

          that.m_http.open("GET", uri, true);
          that.m_http.send(null);
        }
      }
      return true;
    }
  };
}

// Dynamicaly creates a new IFRAME inside the given named DIV.  
function _httpCreateIFrameTag( p_divName, p_callback)
{
  // Create a random name string for our new object
  var id ='f' + Math.floor(Math.random() * 99999);

  // Locate DIV tag with ID given by p_divName
  var target = document.getElementById( p_divName);  
  
  // Create an OBJECT tag inside the DIV
  var newdiv = document.createElement("div");
  newdiv.setAttribute("id", "d"+id)
    
  newdiv.innerHTML = '<div id="progress-'+id+'" class="form_label_text"></div><iframe class="displaynone" src="about:blank" id="'+id+'" name="'+id+'" onload="'+p_callback+'(\''+id+'\');"></iframe>'; 
  
  target.appendChild(newdiv); 

  return id;
}

// Structure to represent the state of one Item
function SubmittedItem ()
{
  var id = "";
  var inuse = false;
  var onComplete = function(){return true;};
}

// Class - Allows dynamic form submits via an IFRAME
function httpForm( p_formName, p_divName, p_onCompleteFunc, p_loadedCallback)
{
  var that = this;
  var m_SubmitList = [];
  var m_div = p_divName;

  var m_formName   = p_formName;
  var m_formObj    = document.getElementById(m_formName);

  var m_targetName = "";
  var m_targetObj = null;
  
  var m_loadedCallback = p_loadedCallback;
  var m_onComplete = p_onCompleteFunc || function () { return true };
  
  this.reset = function()
  {
    m_targetName = _httpCreateIFrameTag( m_div, m_loadedCallback);
    var SubItem = new SubmittedItem();
    SubItem.id = m_targetName;
    SubItem.inuse = true;
    SubItem.onComplete = m_onComplete;
    m_SubmitList.push(SubItem);
    m_targetObj  = document.getElementById(m_targetName);
    // Set target of form to the targetName assigned to this instance of httpForm
    m_formObj.setAttribute('target', m_targetName);
  };
  
  that.reset();
  
  this.submit = function(p_text)
  {
    document.getElementById("progress-"+m_targetName).innerHTML = p_text;
  };
  
  this.loaded = function( p_targetName) {
    var target = document.getElementById(p_targetName);
    if (target.contentDocument)
    {
      var docObj = target.contentDocument;
    }
    else if (target.contentWindow)
    {
      var docObj = target.contentWindow.document;
    }
    else
    {
      var docObj = window.frames[p_targetName].document;
    }

    if (docObj.body.innerHTML == "")
    {
      return;
    }

    for (var i in m_SubmitList)
    {
      if (m_SubmitList[i].id == p_targetName)
      {
        if (typeof(m_SubmitList[i].onComplete) == 'function')
        {
          m_SubmitList[i].onComplete(docObj.body.innerHTML);
        }
        m_SubmitList[i].inuse = false;
        document.getElementById("progress-"+m_SubmitList[i].id).innerHTML = "";
        document.getElementById(m_div).removeChild(document.getElementById("d"+m_SubmitList[i].id));
      }
    }
  }; 
}


