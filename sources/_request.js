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


// Dynamicaly creates a new IFRAME inside the given named DIV.  
function _CreateIFrameTag( p_divName, p_callback)
{
  // Create a random name string for our new object
  var id ='f' + Math.floor(Math.random() * 99999);

  var target = $('#'+p_divName);
  var div = '<div id="d'+id+'"><div id="progress-'+id+'" class="form_label_text"></div><iframe class="displaynone" src="about:blank" id="'+id+'" name="'+id+'">&nbsp;</iframe></div>';
  target.append(div);

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
  var m_formObj    = $('#'+m_formName);

  var m_targetName = "";
  
  var m_loadedCallback = p_loadedCallback;
  var m_onComplete = p_onCompleteFunc || function () { return true; };
  
  this.reset = function()
  {
    m_targetName = _CreateIFrameTag( m_div, m_loadedCallback);
    var SubItem = new SubmittedItem();
    SubItem.id = m_targetName;
    SubItem.inuse = true;
    SubItem.onComplete = m_onComplete;
    m_SubmitList.push(SubItem);

    // Set target of form to the targetName assigned to this instance of httpForm
    m_formObj.attr('target', m_targetName);
  };
  
  that.reset();
  
  this.submit = function(p_text)
  {
    $('#'+m_targetName).load(function() {that.loaded();});
    $('#'+'progress-'+m_targetName).html(p_text);
  };
  
  this.loaded = function()
  {
    for (var i in m_SubmitList)
    {
      if ($('#'+m_SubmitList[i].id)[0])
      {
        contents = $('#'+m_SubmitList[i].id)[0].contentDocument.body.innerHTML;

        if ('{' === contents.charAt(0))
        {
          if (typeof(m_SubmitList[i].onComplete) == 'function')
          {
            m_SubmitList[i].onComplete(contents);
          }
          m_SubmitList[i].inuse = false;
          $('#progress-'+m_SubmitList[i].id).html('');
          $('#d'+m_SubmitList[i].id).remove();
        }
      }
    }
  };
}


