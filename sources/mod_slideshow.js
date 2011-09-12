function Slideshow()
{
  var that = this;
  var m_images = {};
  var m_scrWidth = 0;
  var m_scrHeight = 0;
  var m_imgWidth = 0;
  var m_imgHeight = 0;
  var m_curImage = 0;
  var m_curFrame = 1;
  var m_nextFrame = 2;
  var m_vector = 1;
  var m_paused = false;
  var m_timeoutID = 0;
  var m_delay = 8000;
  var m_optionsShown = false;
  var m_loading = Array(4);
  
  this.PreLoad = function(p_images, p_delay)
  {
    m_images = $.parseJSON(p_images);
    m_delay = p_delay;
    m_loading[1] = false;
    m_loading[2] = false;
    m_loading[3] = false;
    
    for(i = 0; i < m_images.length; i++)
    {
      m_images[i].Description = str_replace(m_images[i].Description, '\n', '<br />');
    }
  };
  
  this.Pause = function()
  {
    m_paused = !m_paused;
    if (m_paused)
    {
      clearTimeout(m_timeoutID);
      $('.slideshowPause').html('Play');
    } else
    {
      $('.slideshowPause').html('Pause');
      that.Next(m_delay);
    }
  };
  
  this.Next = function(delay)
  {
    if (m_vector == -1)
    {
      var t = m_curFrame;
      m_curFrame = m_nextFrame;
      m_nextFrame = t;
      
      m_curImage += 2;
      if (m_curImage >= m_images.length)
      {
        m_curImage -= m_images.length;
      }
    }
    
    m_vector = 1;
    clearTimeout(m_timeoutID);
    if ((delay <= 100) &&
        (!m_paused))
    {
      that.Pause();
    }
    m_timeoutID = setTimeout(slideshow.NextImage, delay);
  };
  
  this.Previous = function()
  {
    if (m_vector == 1)
    {
      var t = m_curFrame;
      m_curFrame = m_nextFrame;
      m_nextFrame = t;
      
      m_curImage -= 2;
      if (m_curImage < 0)
      {
        m_curImage += m_images.length;
      }
    }

    m_vector = -1;
    clearTimeout(m_timeoutID);
    if (!m_paused)
    {
      that.Pause();
    }
    m_timeoutID = setTimeout(slideshow.NextImage, 100);
  };
  
  this.NextImage = function()
  {
    m_scrHeight = $('.slideshowFullscreen').height();
    m_scrWidth = $('.slideshowFullscreen').width();
    
    $('.slideshowName').hide();
    
    //if (0 == m_imgWidth)
    if (m_loading[m_curFrame])
    {
      $('.slideshowLoading').show();
      m_timeoutID = setTimeout(slideshow.NextImage, 200);
      return;
    }
    
    $('.slideshowLoading').hide();

    m_imgWidth = $('#img_'+m_curFrame).width();
    m_imgHeight = $('#img_'+m_curFrame).height();
    
    var left = ((m_scrWidth - m_imgWidth) / 2);
    var top = ((m_scrHeight - m_imgHeight) / 2) - 15;
    $('#img_'+m_curFrame).css('left', left);
    $('#img_'+m_curFrame).css('top', top);
    
    $('.slideshowDesc').html(m_images[m_curImage].Description);
    
    var w = $('.slideshowProgressBar').css('width');
    w = Number(w.replace('px', ''));
    w -= 2;
    var div = w /m_images.length;
    
    w = (m_curImage + 1) * div;
    
    $('.slideshowProgressBar div').css('width', w);
    
    $('#img_'+m_curFrame).show();
    
    m_curImage += m_vector;
    
    if (m_curImage >= m_images.length)
    {
      m_curImage = 0;
    }
    if (m_curImage < 0)
    {
      m_curImage = m_images.length - 1;
    }
    
    
    m_curFrame += m_vector;
    if (m_curFrame > 3)
    {
      m_curFrame = 1;
    }
    if (m_curFrame < 1)
    {
      m_curFrame = 3;
    }
    
    m_nextFrame += m_vector;
    if (m_nextFrame > 3)
    {
      m_nextFrame = 1;
    }
    if (m_nextFrame < 1)
    {
      m_nextFrame = 3;
    }
    
    $('#img_'+m_nextFrame).hide();
    $('#img_'+m_curFrame).hide();
    
    $('#img_'+m_curFrame).html('<img src="sources/_image_scaler.php?image_name='+strPad(m_images[m_curImage].Id, 10)+'.'+m_images[m_curImage].Format+'&display_height='+(m_scrHeight-40)+'&display_width='+(m_scrWidth-10)+'" onload="slideshow.Loaded('+m_curFrame+')">');
    m_loading[m_curFrame] = true;
    
    if (!m_paused)
    {
      m_timeoutID = setTimeout(slideshow.NextImage, m_delay);
    }
  };
  
  this.Loaded = function(p_id)
  {
    m_loading[p_id] = false;
  };
  
  this.ShowOptions = function()
  {
    $('#slideshowOptionsForm').show();
    var h = $('#slideshowOptionsForm').css('height');
    h = h.replace('px', '');
    h = 40 + Number(h);
    $('.slideshowOptions').css('height', h + 'px');
    m_optionsShown = true;
  };
  
  this.HideOptions = function()
  {
    $('#slideshowOptionsForm').hide();
    $('.slideshowOptions').css('height', '20px');
    m_optionsShown = false;
  };
  
  this.ClickOptions = function()
  {
    console.log('dfdf');
    if (m_optionsShown)
    {
      that.HideOptions();
    } else
    {
      that.ShowOptions();
    }
  };
  
  this.ChangeDelay = function()
  {
    var d = $('#slideshowOptionDelay').val();
    if (!isNaN(d-0))
    {
      m_delay = d  * 1000;
    }
  };
  
  this.ChangeDescVisibility = function()
  {
    if ($('#slideshowOptionShowDesc').is(':checked'))
    {
      $('.slideshowDetails').show();
    } else
    {
      $('.slideshowDetails').hide();
    }
  };
  
  this.PageLoad = function()
  {
    $('body').css('background-color', '#000000');
    
    $('#slideshowOptionDelay').val(m_delay/1000);
    $('#slideshowOptionsForm').hide();
    $('.slideshowOptions').mouseover(function(){slideshow.ShowOptions();});
    $('.slideshowOptions').mouseout(function(){slideshow.HideOptions();});
    $('.slideshowOptions span').click(function(){slideshow.ClickOptions();});
    
    $('#slideshowOptionDelay').change(function(){slideshow.ChangeDelay();});
    $('#slideshowOptionShowDesc').change(function(){slideshow.ChangeDescVisibility();});
    
    $('.slideshowPause').click(function(){that.Pause();});
    $('.slideshowNext').click(function(){that.Next(100);});
    $('.slideshowPrevious').click(function(){that.Previous();});
    m_scrHeight = $('.slideshowFullscreen').height();
    m_scrWidth = $('.slideshowFullscreen').width();
    
    $('#img_'+m_curFrame).hide();
    if (undefined != m_images[m_curImage])
    {
      $('#img_1').html('<img src="sources/_image_scaler.php?image_name='+strPad(m_images[m_curImage].Id, 10)+'.'+m_images[m_curImage].Format+'&display_height='+(m_scrHeight-40)+'&display_width='+(m_scrWidth-1)+'" onload="slideshow.Loaded('+m_curFrame+')">');
      m_timeoutID = setTimeout(slideshow.NextImage, m_delay);
    }
  };
}

$(document).ready(function(){slideshow.PageLoad();});