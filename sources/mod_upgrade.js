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

// Structure to hold a config option
function Option()
{
  var m_name = "";
  var m_value = "";
  var m_dest = "";
}

// Structure to hold a file to delete
function File()
{
  var m_filename = "";
}

// Class to help in upgrading
function Upgrade(p_oldver, p_newver)
{
  var that = this;
  var versions = [10000, 10100, 10199.00, 10200];
  var stage_1_list = Array();
  var stage_2_list = Array();
  var stage_3_list = Array();

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

  addEvent(document.getElementById("upgradebutton"), "click", function(e) {upg.Go();});
  
  // Starts the upgrade process
  this.Go = function()
  {
    that.BuildStage1List();
    that.BuildStage2List();
    that.BuildStage3List();
    that.Stage1Banner();
    that.RunStage1(0);
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
  
  // Announces upgrade complete
  this.EndBanner = function()
  {
    var element = document.getElementById("upgradeprogress");
    element.innerHTML += "<br/><br/><span class='install_list_header'>Upgrade finished</span>";
    if (upgrade_result)
    {
      element.innerHTML += " <span class='install_list_header' class='colorgreen'>successfully.</span><br/><br/>";
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
          new_opt.dest = "file";
          stage_1_list[stage_1_list.length] = new_opt;
          
          break;
        }
        case 10199.00 :
        {
          var new_opt = new Option();
          new_opt.name = "$MOA_PATH";
          new_opt.value = '"'+moa_path+'"';
          new_opt.dest = "file";
          stage_1_list[stage_1_list.length] = new_opt;
          
          break;
        }
        case 10200.00 :
        {
          var new_opt = new Option();
          new_opt.name = "$TEMPLATE";
          new_opt.value = '"MoaDefault"';
          new_opt.dest = "file";
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
          new_file.filename = "upgrade-10199_00.sql"
          stage_3_list[stage_3_list.length] = new_file;
          break;
        }
        case 10200.00 :
        {
          var new_file = new File();
          new_file.filename = "upgrade-10200.sql"
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
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>"
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      upgrade_result = false;
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
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>"
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      //upgrade_result = false;
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
      element.innerHTML += "<span class='install_list_success'>Success</span><br/>"
    } else
    {
      element.innerHTML += "<span class='install_list_fail'>Failed " + reason + "</span><br/>";
      upgrade_result = false;
    }
    
    p_note++;
    if (p_note < stage_3_list.length)
    {
      that.RunStage3(p_note);
    } else
    {
      that.EndBanner();
    }
  };
  
  // Runs each step of stage 1
  this.RunStage1 = function(p_step)
  {
    var element = document.getElementById("upgradeprogress");
    if (0 == stage_1_list.length)
    {
      element.innerHTML +=  "<span class='install_list'>Nothing to do</span><br/>";
      that.Stage2Banner();
      that.RunStage2(0);
    }
    element.innerHTML +=  "<span class='install_list'>Adding "+stage_1_list[p_step].name+" - </span>";
    var url =  "action=add_var";
        url += "&dest=file";
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
    }
    element.innerHTML +=  "<span class='install_list'>Deleting "+stage_2_list[p_step].filename+" - </span>";
    var url =  "action=delete_file";
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
      that.EndBanner();
      return;
    }
    element.innerHTML +=  "<span class='install_list'>Running '"+stage_3_list[p_step].filename+"'</span>";
    var url =  "action=modify_db";
        url += "&filename="+encodeURIComponent(stage_3_list[p_step].filename);
    var request = new httpRequest("sources/mod_upgrade.php", that.Stage3Callback, p_step);
    request.update(url, "GET");
  };
}

