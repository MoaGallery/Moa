function Main(p_delim)
{
	var that = this;

	var m_desc;

	var m_titles;	
	var m_old_desc;
	var m_edit_toggle = false;
	var m_descexpand = false;
	var m_delimiter = p_delim;

	this.PreLoad = function(p_desc)
	{
		nd();
		m_desc = p_desc;
		m_short_desc = ShortName(m_desc);
		m_old_desc = "";
	};

	this.Edit = function()
	{
		if (!m_edit_toggle) {
			m_titles = $('#mainblocktitles').html();
			$('#mainblocktitles').html( editblock);
			
			$('#mainformdesc').val( str_replace(m_desc, "<br/>", "\n"));
			$('#mainformdesc').keypress( function(e) {return checkKey(e, null, "mainformcancel");});
			$('#mainformexpandlink').click( function(e) {main.ExpandClick();});
			$('#mainformdesc').focus();
			m_edit_toggle = true;
		}
	};

	this.SubmitEdit = function()
	{
		var url = "";

		m_old_desc = m_desc;

		m_desc = $('#mainformdesc').val();

		m_short_desc = ShortName(m_desc);

		that.CancelEdit();
		$('#mainblockdesc').html(EscapeNewLine(EscapeHTMLChars(m_desc)));

    params = "action=edit";    
    params += "&desc=" + encodeURIComponent(m_desc);

    $.ajax({ url: 'sources/mod_main.php',
             data: params,
             type: 'POST',
             success: that.AjaxCallback,
             error: that.AjaxCallbackFail,
             cache: false});
    	
		m_edit_toggle = false;
	};

	this.CancelEdit = function()
	{
	  $('#mainblocktitles').html( m_titles);
		m_edit_toggle = false;
		nd();
	};

  this.AjaxCallbackFail = function(p_request, p_status, p_errorThrown)
  {    
    m_desc = m_old_desc;
    that.CancelEdit();
    $('#mainblockdesc').html(StripHTMLTags(m_desc));

    m_old_desc = "";
    m_short_desc = ShortName(m_desc);
        
    MoaUI.DisplayFeedback( 'Server returned "' + p_request.status + ' ' + p_request.statusText + '".', Feedback.error);
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
    
    if (result.Status == 'SUCCESS')
    {   
      switch (result.Operation)
      {
        case 'MainAdd':
        {          
	        m_old_desc = "";
        }       
      }
    }
    else
    {
      var error = {status: '', statusText: result.Result};
      that.AjaxCallbackFail(error);
    }
	};

	this.ExpandClick = function()
	{
		if (m_descexpand) {
		  $('#mainformdesc').attr('rows', 4);
		  $('#mainformdesc').attr('cols', 50);
		  $('#mainformexpandlink').html("[Expand]");
			m_descexpand = false;
		} else {
		  $('#mainformdesc').attr('rows', 15);
		  $('#mainformdesc').attr('cols', 80);
		  $('#mainformexpandlink').html("[Shrink]");
			m_descexpand = true;
		}
	};
}