function Main(p_delim) {
	var that = this;

	var m_desc;

	var m_titles;	
	var m_old_desc;
	var m_edit_toggle = false;
	var m_descexpand = false;
	var m_delimiter = p_delim;

	this.PreLoad = function(p_desc) {
		nd();
		m_desc = p_desc;
		m_short_desc = ShortName(m_desc);
		m_old_desc = "";
	};

	this.Edit = function() {
		if (!m_edit_toggle) {
			m_titles = document.getElementById("mainblocktitles").innerHTML;
		    document.getElementById("mainblocktitles").innerHTML = editblock;
			
			document.getElementById("mainformdesc").value = str_replace(m_desc, "<br/>", "\n");
			addEvent(document.getElementById("mainformdesc"), "keypress",
					function(e) {
						return checkKey(e, null, "mainformcancel");
					});
			addEvent(document.getElementById("mainformexpandlink"), "click",
					function(e) {
						main.ExpandClick();
					});
			document.getElementById("mainformdesc").focus();
			m_edit_toggle = true;
		}
	};

	this.SubmitEdit = function() {
		var url = "";

		m_old_desc = m_desc;

		m_desc = document.getElementById("mainformdesc").value;

		m_short_desc = ShortName(m_desc);

		that.CancelEdit();
		document.getElementById("mainblockdesc").innerHTML = StripHTMLTags(m_desc);

		url = "action=edit";
		url += "&desc=" + encodeURIComponent(m_desc);
		var request = new httpRequest("sources/mod_main.php",
				that.SubmitCallback);
		request.update(url, "GET");

		m_edit_toggle = false;
	};

	this.CancelEdit = function() {
	    document.getElementById("mainblocktitles").innerHTML = m_titles;
		m_edit_toggle = false;
		nd();
	};

	this.SubmitRollback = function() {
		m_desc = m_old_desc;
		that.CancelEdit();
		document.getElementById("mainblockdesc").innerHTML = StripHTMLTags(m_desc);

		m_old_desc = "";
		m_short_desc = ShortName(m_desc);
	};

	this.SubmitCallback = function(p_text, p_status, p_xml, p_note) {
		if (p_status != 200) {
			document.getElementById("mainblockfeedback").innerHTML = FeedbackBox(
					"Server returned code " + p_status + ".", false);
			that.SubmitRollback();
			return;
		}

		if ("OK" != p_text.substr(0, 2)) {
			document.getElementById("mainblockfeedback").innerHTML = FeedbackBox(
					p_text, false);
			that.SubmitRollback();
			return;
		} 
				
		m_old_desc = "";		
	};

	this.ExpandClick = function() {
		if (m_descexpand) {
			document.getElementById("mainformdesc").rows = 4;
			document.getElementById("mainformdesc").cols = 50;
			document.getElementById("mainformexpandlink").innerHTML = "[Expand]";
			m_descexpand = false;
		} else {
			document.getElementById("mainformdesc").rows = 15;
			document.getElementById("mainformdesc").cols = 80;
			document.getElementById("mainformexpandlink").innerHTML = "[Shrink]";
			m_descexpand = true;
		}
	};
}