  var view_gallery_loaded = false;
  var gallery_id = "blank";
  var gallery_name = "blank";


  
  function fit_width()
  { 
    //var l = document.getElementById("image_thumb_0000000066").style.left;
    //var r = document.getElementById("image_thumb_0000000067").style.left;
    //document.getElementById("debug").innerHTML = l+" "+r;
    var tab = document.getElementById("add_table");
    if (navigator.appName == "Netscape")
    {
      var w = document.width;
    } else
    {
      var w = document.documentElement.offsetWidth - 30;
    }

    var tn = 188;
    var s = 12;
    var b = 1;
    
    var x = w - s - b;
    x = ((x/tn)|0);
    
    tab.width = (x * tn)+s;
    if (tab.width < ((tn*2)))
    {
      tab.width = (tn*2)+s;
    }
  }

  view_gallery_loaded = true;
  