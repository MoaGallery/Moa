// Outdated files to be deleted between v1.0 and v1.1
var ver_10100_old_files = ["add_gallery.php",
                           "add_image.php",
                           "admin.php",
                           "admin_maintain.php",
                           "admin_maintain_image.php",
                           "admin_orphans.php",
                           "admin_tags.php",
                           "admin_users.php",
                           "login.php",
                           "map.php",
                           "view_gallery.js.php",
                           "view_gallery.php",
                           "view_gallery_edit.js.php",
                           "view_image.php",
                           "view_image_edit.js.php",
                           "view_image_full.php",
                           "media/loading.png",
                           "sources/box_add_gallery.php",
                           "sources/box_add_image.php",
                           "sources/box_edit_taglist.php",
                           "sources/box_gallery_info.php",
                           "sources/box_gallery_summary.php",
                           "sources/box_gallery_thumbs.php",
                           "sources/box_gallery_titles.php",
                           "sources/box_image.php",
                           "sources/box_image_description.php",
                           "sources/box_image_info.php",
                           "sources/box_image_scaler.php",
                           "sources/box_taglist.php",
                           "sources/box_taglist_add.php",
                           "sources/box_tag_admin.php",
                           "sources/_ajax.js.php",
                           "sources/_checkusername.php",
                           "sources/_gallery_delete.php",
                           "sources/_get_gallery_desc.php",
                           "sources/_get_gallery_title.php",
                           "sources/_get_image_desc.php",
                           "sources/_image_delete.php",
                           "sources/_inherit_tags.php",
                           "sources/_numtags.php",
                           "sources/_settag.php",
                           "sources/_thumbnail_func.php",
                           "sources/_thumb_list.php"];

var ver_10199_00_old_files = ["media/add.png",
                             "media/button-admin.png",
                             "media/button-login.png",
                             "media/button-logout.png",
                             "media/debug-moa-logo-vector.png",
                             "media/fail.png",
                             "media/folder_open.png",
                             "media/gallery.png",
                             "media/gallery_add.png",
                             "media/gallery_delete.png",
                             "media/shadowAlpha.png",
                             "media/shadow-pale.gif",
                             "media/shadow-pale.png",
                             "media/shadow-plain.gif",
                             "media/shadow-plain.png",
                             "media/site-map.png",
                             "media/success.png",
                             "media/warning.png",
                             "sources/_admin_page_links.php",
                             "sources/_breadcrumb.php",
                             "sources/_buttons.php",
                             "sources/_footer.php",
                             "sources/mod_gallery_view.php",
                             "sources/mod_image_view.php"];

var ver_10200_old_files = ["TODO",
                              "media/moa-logo-vector.png"];

var ver_10202_old_files = ['templates/MoaDefault/page_admin_maintain_image_feedback.php',
                           'templates/Aperture/page_admin_maintain_image_feedback.php',
                           'templates/MoaDefault/media/footer-left.png',
                           'templates/MoaDefault/media/footer-right.png',
                           'templates/MoaDefault/media/header1-left.png',
                           'templates/MoaDefault/media/header1-right.png',
                           'templates/MoaDefault/media/header2-left.png',
                           'templates/MoaDefault/media/header2-right.png',
                           'templates/MoaDefault/media/shadow-pale.gif',
                           'templates/MoaDefault/media/shadow-pale.png',
                           'templates/MoaDefault/media/shadow-plain.gif',
                           'templates/MoaDefault/media/shadow-plain.png',
                           'templates/MoaDefault/media/shadowAlpha.png',
                           'templates/MoaDefault/media/testbox-bl.png',
                           'templates/MoaDefault/media/testbox-br.png',
                           'templates/MoaDefault/media/testbox-tl.png',
                           'templates/MoaDefault/media/testbox-tr.png'
                           ];

// Structure to hold a config option
function Option()
{
  var m_name = "";
  var m_value = "";
}

// Structure to hold a file to delete
function File()
{
  var m_filename = "";
}

function Func()
{
  var m_funcname = "";
}

// Class to help in upgrading
function Upgrade(p_oldver, p_newver)
{
  var that = this;
  var versions = [10000, 10100, 10199.00, 10200, 10201, 10202];
  var stage_1_list = new Array();
  var stage_2_list = new Array();
  var stage_3_list = new Array();
  var stage_4_list = new Array();

  var index_old = 0;
  var index_new = 0;
  var upgrade_result = true;
  
  for (var i = 0; i < versions.length; i++)
  {
    if (versions[i] == p_oldver)
    {
      index_old = i+1;
    }
    if (versions[i] == p_newver)
    {
      index_new = i;
    }
  }

  addEvent(document.getElementById("testbutton"), "click", function(e) {upg.Test();});
  addEvent(document.getElementById("upgradebutton"), "click", function(e) {upg.Go();});
  document.getElementById("upgradebutton").style.display = "none";
  
  // Test the upgrade process
  this.Test = function()
  {
    that.upgrade_result = true;
   
    document.getElementById("upgradeprogress").innerHTML = "";
    document.getElementById("upgradebutton").style.display = "none"; 
    that.Stage1TestBanner();
    that.RunStage1Test(0);
  };
  
  // Start the upgrade process
  this.Go = function()
  {
    that.upgrade_result = true;
    
    document.getElementById("upgradeprogress").innerHTML = "";
    that.Stage1Banner();
    that.RunStage1(0);
  };
  
  // Announces test stage 1 (Adding config vars)
  this.Stage1TestBanner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<span class='install_list_header'>Stage 1 - Testing config file...</span><br/><br/>";
  };
  
  // Announces test stage 2 (Deleting old files)
  this.Stage2TestBanner = function()
  {      
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<br/><br/><span class='install_list_header'>Stage 2 - Testing file permissions...<br/></span><br/><br/>";
  };
  
  // Announces test stage 3 (Database changes)
  this.Stage3TestBanner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<br/><br/><span class='install_list_header'>Stage 3 - Testing database access...</span><br/><br/>";
  };
  
  // Announces test stage 4 (Other changes)
  this.Stage4TestBanner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<br/><br/><span class='install_list_header'>Stage 4 - Testing post-upgrade processes...</span><br/><br/>";
  };
  
  // Announces testing complete
  this.EndTestBanner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML += "<br/><br/><span class='install_list_header'>Testing finished</span>";
    if (that.upgrade_result)
    {
      element.innerHTML += " <span class='install_list_header' class='colorgreen'>successfully.</span><br/><br/>";
      document.getElementById("upgradebutton").style.display = "block";
    } else
    {
      element.innerHTML += "<br/><span class='install_list_fail'>One or more parts failed the upgrade test as listed above.<br/>\n"+
                           "Please fix the issues mentioned and re-run the upgrade test.<br/><br/>\n";
    }
  };
  
  // Announces stage 1 (Adding config vars)
  this.Stage1Banner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<span class='install_list_header'>Stage 1 - Adding config vars...</span><br/><br/>";
  };
  
  // Announces stage 2 (Deleting old files)
  this.Stage2Banner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<br/><br/><span class='install_list_header'>Stage 2 - Removing outdated Moa files...<br/></span><br/><br/>";
  };
  
  // Announces stage 3 (Database changes)
  this.Stage3Banner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<br/><br/><span class='install_list_header'>Stage 3 - Applying database changes...</span><br/><br/>";
  };
  
  // Announces stage 4 (Other changes)
  this.Stage4Banner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML +=  "<br/><br/><span class='install_list_header'>Stage 4 - Finalising changes...</span><br/><br/>";
  };
  
  // Announces upgrade complete
  this.EndBanner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML += "<br/><br/><span class='install_list_header'>Upgrade finished</span>";
    if (upgrade_result)
    {
      element.innerHTML += " <span class='install_list_header' class='colorgreen'>successfully.</span><br/><br/>";
      document.getElementById("upgradebutton").style.display = "none";
    } else
    {
      element.innerHTML += "<br/><span class='install_list_fail'>One or more commands failed to run correctly as listed above." +
                           " See the manual upgrade procedure in the documentation to complete the upgrade.</span><br/><br/>";
    }
  };
  
  // Puts together a list of all vars to upgrade
  this.BuildStage1List = function()
  {
    for (var i = index_old; i <= index_new; i++)
    {
      switch (versions[i])
      {
        case 10100 :
        {
          var new_opt = new Option();
          new_opt.name = "$STR_DELIMITER";
          new_opt.value = "\",\"";
          stage_1_list[stage_1_list.length] = new_opt;
          
          break;
        }
        case 10199.00 :
        {
          var new_opt = new Option();
          new_opt.name = "$MOA_PATH";
          new_opt.value = '"'+moa_path+'"';
          stage_1_list[stage_1_list.length] = new_opt;
          
          break;
        }
        case 10200.00 :
        {
          var new_opt = new Option();
          new_opt.name = "$TEMPLATE";
          new_opt.value = '"MoaDefault"';
          stage_1_list[stage_1_list.length] = new_opt;
          
          break;
        }
        case 10202.00 :
        {
          var new_opt = new Option();
          new_opt.name = '$BULKUPLOAD_PATH';
          new_opt.value = '"incoming/"';
          stage_1_list[stage_1_list.length] = new_opt;
          
          break;
        }
        default :
        {
          break;
        }
      }
    }
  };
  
  // Puts together a list of all files to delete
  this.BuildStage2List = function()
  {
    for (var i = index_old; i <= index_new; i++)
    {
      switch (versions[i])
      {
        case 10100 :
        {
          for (var j = 0; j < ver_10100_old_files.length; j++)
          {
            var new_file = new File();
            new_file.filename = ver_10100_old_files[j];
            stage_2_list[stage_2_list.length] = new_file;
          }
          break;
        }
        case 10199.00 :
        {
          for (var j = 0; j < ver_10199_00_old_files.length; j++)
          {
            var new_file = new File();
            new_file.filename = ver_10199_00_old_files[j];
            stage_2_list[stage_2_list.length] = new_file;
          }
          break;
        }
        case 10200 :
        {
          for (var j = 0; j < ver_10200_old_files.length; j++)
          {
            var new_file = new File();
            new_file.filename = ver_10200_old_files[j];
            stage_2_list[stage_2_list.length] = new_file;
          }
          break;
        }
        case 10202 :
        {
          for (var j = 0; j < ver_10202_old_files.length; j++)
          {
            var new_file = new File();
            new_file.filename = ver_10202_old_files[j];
            stage_2_list[stage_2_list.length] = new_file;
          }
          break;
        }
        default :
        {
          break;
        }
      }
    }
  };
  
  // Puts together a list of all database mods to run
  this.BuildStage3List = function()
  {
    for (var i = index_old; i <= index_new; i++)
    {
      switch (versions[i])
      {
        case 10100 :
        {
          break;
        }
        case 10199.00 :
        {
          var new_file = new File();
          new_file.filename = "upgrade-10199_00.sql";
          stage_3_list[stage_3_list.length] = new_file;
          break;
        }
        case 10200.00 :
        {
          var new_file = new File();
          new_file.filename = "upgrade-10200.sql";
          stage_3_list[stage_3_list.length] = new_file;
          break;
        }
        case 10201.00 :
        {
          var new_file = new File();
          new_file.filename = "upgrade-10201.sql";
          stage_3_list[stage_3_list.length] = new_file;
          break;
        }        
        default :
        {
          break;
        }
      }
    }
  };
  
  // Puts together a list of all upgrade functions to run
  this.BuildStage4List = function()
  {
    for (var i = index_old; i <= index_new; i++)
    {
      switch (versions[i])
      {
        case 10201.00 :
        {
          var new_func = new Func();
          new_func.m_funcname = "upgrade_10201_AddImageFormats";
          stage_4_list[stage_4_list.length] = new_func;
          var new_func = new Func();
          new_func.m_funcname = "upgrade_10201_UpgradeConfigFile";
          stage_4_list[stage_4_list.length] = new_func;
          break;          
        }        
        default :
        {
          break;
        }
      }
    }
    
    var new_func = new Func();
    new_func.m_funcname = "upgrade_complete";
    stage_4_list[stage_4_list.length] = new_func;
  };
  
  // Called after each stage 1 element is run
  this.Stage1TestCallback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>" + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_1_list.length)
    {
      that.RunStage1Test(p_note);
    } else
    {
      that.Stage2TestBanner();
      that.RunStage2Test(0);
    }
  };
  
  // Called after each stage 2 element is run
  this.Stage2TestCallback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>" + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_2_list.length)
    {
      that.RunStage2Test(p_note);
    } else
    {
      that.Stage3TestBanner();
      that.RunStage3Test(0);
    }
  };
  
  // Called after each stage 3 element is run
  this.Stage3TestCallback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>" + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_3_list.length)
    {
      that.RunStage3Test(p_note);
    } else
    {
      that.Stage4TestBanner();
      that.RunStage4Test(0);
    }
  };
  
  // Called after each stage 3 element is run
  this.Stage4TestCallback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_4_list.length)
    {
      that.RunStage4Test(p_note);
    } else
    {
      that.EndTestBanner();
    }
  };
  
  // Called after each stage 1 element is run
  this.Stage1Callback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_1_list.length)
    {
      that.RunStage1(p_note);
    } else
    {
      that.Stage2Banner();
      that.RunStage2(0);
    }
  };
  
  // Called after each stage 2 element is run
  this.Stage2Callback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_2_list.length)
    {
      that.RunStage2(p_note);
    } else
    {
      that.Stage3Banner();
      that.RunStage3(0);
    }
  };
  
  // Called after each stage 3 element is run
  this.Stage3Callback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_3_list.length)
    {
      that.RunStage3(p_note);
    } else
    {
      that.Stage4Banner();
      that.RunStage4(0);
    }
  };
  
  // Called after each stage 4 element is run
  this.Stage4Callback = function(p_text, p_status, p_xml, p_note)
  {
    var success = true;
    var reason = "";
    var element = document.getElementById("upgradeprogress");
    
    if (200 != p_status)
    {
      success = false;
      reason = "Server error (status "+p_status+")."; 
    }
    
    if (p_text.substr(0, 2) != "OK")
    {
      success = false;
      reason = p_text;
    }
    
    if (success)
    {
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>";
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      that.upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_4_list.length)
    {
      that.RunStage4(p_note);
    } else
    {
      that.EndBanner();
    }
  };
  
  // Tests each step of stage 1
  this.RunStage1Test = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_1_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage2TestBanner();
      that.RunStage2Test(0);
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Testing - adding '"+stage_1_list[p_step].name+"' - </span>";
    var url =  "action=add_var";
        url += "&name="+encodeURIComponent(stage_1_list[p_step].name);
        url += "&value="+encodeURIComponent(stage_1_list[p_step].value);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage1TestCallback, p_step);
    request.update(url, "GET");
  };
  
  // Tests each step of stage 2
  this.RunStage2Test = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_2_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage3TestBanner();
      that.RunStage3Test(0);
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Testing deletion of '"+stage_2_list[p_step].filename+"' - </span>";
    var url =  "action=delete_file";
        url += "&filename="+encodeURIComponent(stage_2_list[p_step].filename);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage2TestCallback, p_step);
    request.update(url, "GET");
  };
  
  // Tests each step of stage 3
  this.RunStage3Test = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_3_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage4TestBanner();
      that.RunStage4Test(0);
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Testing SQL upgrade '"+stage_3_list[p_step].filename+"' - </span>";
    var url =  "action=modify_db";
        url += "&filename="+encodeURIComponent(stage_3_list[p_step].filename);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage3TestCallback, p_step);
    request.update(url, "GET");
  };
  
  // Tests each step of stage 4
  this.RunStage4Test = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_4_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.EndTestBanner();
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Testing '"+stage_4_list[p_step].m_funcname+"'</span>";
    var url =  "action=run_func";
        url += "&func="+encodeURIComponent(stage_4_list[p_step].m_funcname);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage4TestCallback, p_step);
    request.update(url, "GET");
  };

  this.RunStage1 = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_1_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage2Banner();
      that.RunStage2(0);
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Adding '"+stage_1_list[p_step].name+"' - </span>";
    var url =  "action=add_var";
        url += "&test=false";
        url += "&name="+encodeURIComponent(stage_1_list[p_step].name);
        url += "&value="+encodeURIComponent(stage_1_list[p_step].value);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage1Callback, p_step);
    request.update(url, "GET");
  };
  
  // Runs each step of stage 2
  this.RunStage2 = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_2_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage3Banner();
      that.RunStage3(0);
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Deleting '"+stage_2_list[p_step].filename+"' - </span>";
    var url =  "action=delete_file";
        url += "&test=false";
        url += "&filename="+encodeURIComponent(stage_2_list[p_step].filename);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage2Callback, p_step);
    request.update(url, "GET");
  };
  
  // Runs each step of stage 3
  this.RunStage3 = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_3_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage4Banner();
      that.RunStage4(0);
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Running '"+stage_3_list[p_step].filename+"'</span>";
    var url =  "action=modify_db";
        url += "&test=false";
        url += "&filename="+encodeURIComponent(stage_3_list[p_step].filename);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage3Callback, p_step);
    request.update(url, "GET");
  };
  
  // Runs each step of stage 4
  this.RunStage4 = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_4_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.EndBanner();
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Running '"+stage_4_list[p_step].m_funcname+"'</span>";
    var url =  "action=run_func";
        url += "&test=false";
        url += "&func="+encodeURIComponent(stage_4_list[p_step].m_funcname);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage4Callback, p_step);
    request.update(url, "GET");
  };
  
  that.BuildStage1List();
  that.BuildStage2List();
  that.BuildStage3List();
  that.BuildStage4List();
}

