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

var ver_10205_old_files = ["SQL/gallery-create-view.sql",
                           "templates/Aperture/media/aperture.gif",
                           "templates/MoaDefault/media/moa-logo-vector.png",
                           "templates/MoaDefault/media/debug_mode.png"];

var ver_10206_old_files = ["templates/MoaDefault/component_gallery_form_add.php",
                           "templates/MoaDefault/component_image_form_add.php",
                           "templates/MoaDefault-blue/component_gallery_form_add.php",
                           "templates/MoaDefault-blue/component_image_form_add.php",
                           "templates/Aperture/component_gallery_form_add.php",
                           "templates/Aperture/component_image_form_add.php",
                           "sources/JSON/json_parse.js",
                           "sources/JSON"];

var stageBannerText = ['',
                       'Adding new settings',
                       'Remove old files',
                       'Database changes',
                       'Final steps'];

var runStageDesc = ['',
                    'Adding',
                    'Deleting',
                    'Running SQL',
                    'Running'];

function resStruct()
{
  var Status = '';
  var Result = '';
}


// Structure to hold a config option
function Option()
{
  var name = "";
  var value = "";
}

// Structure to hold a file to delete
function File()
{
  var name = "";
}

function Func()
{
  var name = "";
}

// Class to help in upgrading
function Upgrade(p_oldver, p_newver)
{
  var that = this;
  var versions = [10000, 10100, 10199.00, 10200, 10201, 10202, 10203, 10204, 10205, 10206];
  var stage_list = new Array();
  stage_list[1] = new Array();
  stage_list[2] = new Array();
  stage_list[3] = new Array();
  stage_list[4] = new Array();
  
  var stage = 1;
  var stage_index = 0;
  var testMode = true;
  
  var index_old = 0;
  var index_new = 0;
  var upgrade_result = true;
  
  var currentTest = '';
  var successfulTestCount = 0;
  
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
  
  $('#testbutton').click( function(e) {upg.Test();});
  $('#upgradebutton').click( function(e) {upg.Go();});
  $('#upgradebutton').hide();
  
  // Test the upgrade process
  this.Test = function()
  {
    that.upgrade_result = true;
    that.testMode = true;
    that.stage = 1;
    that.stageIndex = 0;
    that.successfulTestCount = 0;
    
    $('#upgradeprogress').html('');
    $('#upgradebutton').hide(); 
    
    that.StageBanner();
    that.RunStage();
  };
  
  // Start the upgrade process
  this.Go = function()
  {
    that.upgrade_result = true;
    that.testMode = false;
    that.stage = 1;
    that.stageIndex = 0;
    that.successfulTestCount = 0;
    
    that.StageBanner();
    that.RunStage();
  };
  
  // Announces the stage currently working on
  this.StageBanner = function()
  {
    testText = '';
    testIDText = '';
    if (that.testMode)
    {
      testText = '(test) - ';
      testIDText = 'test';
    }
    
    var element = $('#upgradeprogress');
    element.html( element.html() + '<span class="install_list_header">Stage ' + that.stage +
    		  ' - ' + testText + stageBannerText[that.stage] + ' (<span id="stage' + that.stage + testIDText + 'count">0</span> succeeded)</span><br/>');
  };
  
  // Announces upgrade complete
  this.EndBanner = function()
  {
    testText = 'Upgrade';
    failText = "<br/><span class='install_list_fail'>One or more commands failed to run correctly as listed above."
             + " See the manual upgrade procedure in the documentation to complete the upgrade.</span><br/><br/>";
    if (that.testMode)
    {
      testText = 'Testing';
      failText = '<br/><span class="install_list_fail">One or more parts failed the upgrade test as listed above.<br/>'
                 + 'Please fix the issues mentioned and re-run the upgrade test.<br/><br/>';
    }
    
    var element = $('#upgradeprogress');
    element.html( element.html() + '<br/><br/><span class="install_list_header">' + testText + ' finished</span>');
    
    if (that.upgrade_result)
    {
      element.html( element.html() + " <span class='install_list_header' class='colorgreen'>successfully.</span><br/><br/>");
      if (that.testMode)
      {
        $('#upgradebutton').show();
      } else
      {
        $('#upgradebutton').hide();
      }
    } else
    {
      element.html( element.html() + failText); 
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
          new_opt.name = "STR_DELIMITER";
          new_opt.value = "\",\"";
          stage_list[1][stage_list[1].length] = new_opt;
          
          break;
        }
        case 10199.00 :
        {
          var new_opt = new Option();
          new_opt.name = "MOA_PATH";
          new_opt.value = '"'+moa_path+'"';
          stage_list[1][stage_list[1].length] = new_opt;
          
          break;
        }
        case 10200.00 :
        {
          var new_opt = new Option();
          new_opt.name = "TEMPLATE";
          new_opt.value = '"MoaDefault"';
          stage_list[1][stage_list[1].length] = new_opt;
          
          break;
        }
        case 10202.00 :
        {
          var new_opt = new Option();
          new_opt.name = 'BULKUPLOAD_PATH';
          new_opt.value = 'incoming/';
          stage_list[1][stage_list[1].length] = new_opt;
          
          break;
        }
        case 10204.00 :
        {
          var new_opt = new Option();
          new_opt.name = 'IMAGES_PER_PAGE';
          new_opt.value = '30';
          stage_list[1][stage_list[1].length] = new_opt;
          
          break;
        }
        case 10205.00 :
        {
          var new_opt = new Option();
          new_opt.name = 'SITE_NAME';
          new_opt.value = '<your site name>';
          stage_list[1][stage_list[1].length] = new_opt;
          
          var new_opt = new Option();
          new_opt.name = 'SITE_BYLINE';
          new_opt.value = '<your byline>';
          stage_list[1][stage_list[1].length] = new_opt;
          
          break;
        }
        case 10206.00 :
        {
          var new_opt = new Option();
          new_opt.name = 'SLIDESHOW_DELAY';
          new_opt.value = '8000';
          stage_list[1][stage_list[1].length] = new_opt;
          
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
            new_file.name = ver_10100_old_files[j];
            stage_list[2][stage_list[2].length] = new_file;
          }
          break;
        }
        case 10199.00 :
        {
          for (var j = 0; j < ver_10199_00_old_files.length; j++)
          {
            var new_file = new File();
            new_file.name = ver_10199_00_old_files[j];
            stage_list[2][stage_list[2].length] = new_file;
          }
          break;
        }
        case 10200 :
        {
          for (var j = 0; j < ver_10200_old_files.length; j++)
          {
            var new_file = new File();
            new_file.name = ver_10200_old_files[j];
            stage_list[2][stage_list[2].length] = new_file;
          }
          break;
        }
        case 10202 :
        {
          for (var j = 0; j < ver_10202_old_files.length; j++)
          {
            var new_file = new File();
            new_file.name = ver_10202_old_files[j];
            stage_list[2][stage_list[2].length] = new_file;
          }
          break;
        }
        case 10205 :
        {
          for (var j = 0; j < ver_10205_old_files.length; j++)
          {
            var new_file = new File();
            new_file.name = ver_10205_old_files[j];
            stage_list[2][stage_list[2].length] = new_file;
          }
          break;
        }
        case 10206 :
        {
          for (var j = 0; j < ver_10206_old_files.length; j++)
          {
            var new_file = new File();
            new_file.name = ver_10206_old_files[j];
            stage_list[2][stage_list[2].length] = new_file;
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
          new_file.name = "upgrade-10199_00.sql";
          stage_list[3][stage_list[3].length] = new_file;
          break;
        }
        case 10200.00 :
        {
          var new_file = new File();
          new_file.name = "upgrade-10200.sql";
          stage_list[3][stage_list[3].length] = new_file;
          break;
        }
        case 10201.00 :
        {
          var new_file = new File();
          new_file.name = "upgrade-10201.sql";
          stage_list[3][stage_list[3].length] = new_file;
          break;
        }
        case 10204.00 :
        {
          // Add galleryindex table
          var new_file = new File();
          new_file.name = "upgrade-10204.sql";
          stage_list[3][stage_list[3].length] = new_file;
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
          new_func.name = "upgrade_10201_AddImageFormats";
          stage_list[4][stage_list[4].length] = new_func;
          var new_func = new Func();
          new_func.name = "upgrade_10201_UpgradeConfigFile";
          stage_list[4][stage_list[4].length] = new_func;
          break;          
        }
        case 10204.00 :
        {
          var new_func = new Func();
          new_func.name = "upgrade_10204_AddGalleryIndices";
          stage_list[4][stage_list[4].length] = new_func;
          break;          
        }
        default :
        {
          break;
        }
      }
    }
    
    var new_func = new Func();
    new_func.name = "upgrade_complete";
    stage_list[4][stage_list[4].length] = new_func;
  };
  
  this.AjaxCallbackFail = function(p_request, p_status, p_errorThrown)
  {
    var result;
    result.Status = 'Err';
    result.Result = 'Server returned "' + p_request.status + ' ' + p_request.statusText + '".';
    AjaxCallback(result);
  };
  
  this.AjaxCallback = function(p_result)
  {
    var reason = '';
    var element = $('#upgradeprogress');
    var result = new resStruct;
    
    if(!p_result.Status)
    {
      try
      {
        result = $.parseJSON(p_result);
      }
      catch(e)
      {
        result.Status = 'Err';
        result.Result = 'Unknown response from server.';
      }
    } else
    {
      result = p_result;
    }

    if (result.Status == 'SUCCESS')
    {
      that.successfulTestCount++;
      testIDText = '';
      if (that.testMode)
      {
        testIDText = 'test';
      }
      $('#stage' + that.stage + testIDText + 'count').html( that.successfulTestCount);
    } else
    {
      element.html( element.html() + that.currentTest + "<span class='install_list_fail'>" + result.Result + "</span><br/>");
      that.upgrade_result = false;
    }
    
    that.stageIndex++;
    
    if (that.stageIndex >= stage_list[that.stage].length)
    {
      that.stage++;
      
      //Stop if this is the last stage
      if (that.stage >= 5)
      {
        that.EndBanner();
        return;
      }
      
      that.stageIndex = 0;
      that.successfulTestCount = 0;
      that.StageBanner();
    }
    
    that.RunStage();
  };
  
  // Tests each step of stage 1
  this.RunStage = function()
  {
    // Check if we should skip this stage due to being empty
    if (that.stageIndex == stage_list[that.stage].length)
    {
      if (that.stage < 4)
      {
        that.stage++;
        that.stageIndex = 0;
        that.successfulTestCount = 0;
        that.StageBanner();
        that.RunStage(that.stage);
      }
      return;
    }
    
    testText = '(test) - ';
    if (!that.testMode)
    {
      testText = '';
    }
    
    that.currentTest =  '<span class="install_list">' + testText + runStageDesc[that.stage] + ' "' +stage_list[that.stage][that.stageIndex].name+'" - </span>';
    
    switch (that.stage)
    {
      case 1:
      {
        url =  "?action=add_var";
        url += "&name="+encodeURIComponent(stage_list[that.stage][that.stageIndex].name);
        url += "&value="+encodeURIComponent(stage_list[that.stage][that.stageIndex].value);
        break;
      }
      case 2:
      {
        url =  "?action=delete_file";
        url += "&filename="+encodeURIComponent(stage_list[that.stage][that.stageIndex].name);
        break;
      }
      case 3:
      {
        url =  "?action=modify_db";
        url += "&filename="+encodeURIComponent(stage_list[that.stage][that.stageIndex].name);
        break;
      }
      case 4:
      {
        url =  "?action=run_func";
        url += "&func="+encodeURIComponent(stage_list[that.stage][that.stageIndex].name);
        break;
      }
    }
    
    if (!that.testMode)
    {
      url += "&test=false";
    }
    
    $.ajax({ url: 'sources/mod_upgrade.php' + url,
             success: that.AjaxCallback,
             error: that.AjaxCallbackFail,
             cache: false});
  };

  that.BuildStage1List();
  that.BuildStage2List();
  that.BuildStage3List();
  that.BuildStage4List();
}
