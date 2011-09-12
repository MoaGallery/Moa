var Feedback = {
  success: 0,
  error:   1,
  warning: 2
};

var MoaUI = {

  PageTitle: function(p_section, p_title)
  {
    var title = p_section;
  
    if (p_title.length > 0)
    {
      var name = p_title;
      
      if (name.length > title_max_length)
      {
        name = ShortName(name);
      }
      
      title += " - '";
      title += name;
    }
    
    title += "' - Moa";
    document.title = title;
  },
  
  BreadcrumbChange: function(p_id, p_name)
  {
    $('#nav_tree_'+p_id).html(EscapeHTMLChars(p_name));
  },
  
  _AddToHTMLNumber: function(p_obj, p_amount)
  {
    var count = parseInt(p_obj.text());
    if (!isNaN(count))
    {
      count += p_amount;
      p_obj.text(count);
    }
  },
  
  HeaderGalleryCountAdd: function(p_amount)
  {
    $('#hdr_gallerycount').each(function(){MoaUI._AddToHTMLNumber($(this), p_amount);});
  },
  
  HeaderImageCountAdd: function(p_amount)
  {
    $('#hdr_imagecount').each(function(){MoaUI._AddToHTMLNumber($(this), p_amount);});
  },

  DisplayFeedback: function(p_text, p_type)
  {
  	var successFlag = false;
  	if (p_type == Feedback.success)
  	{
  	  successFlag = true;
  	  
  	  $('#feedback_area').show()
                         .html(FeedbackBox(p_text, successFlag))
                         .delay(10000)
                         .hide(500);
  	} else
  	{
  	  $('#feedback_area').show()
  	                     .html(FeedbackBox(p_text, successFlag));
  	}
  },
  
  RemoveFeedback: function()
  {
    $('#feedback_area').hide(500)
                       .delay(500);
  }
};