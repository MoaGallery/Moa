<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  function CheckFolder($p_path, $p_description)
  {
    global $ErrorString;

  	$result = CheckFolderPerms($p_path);
    if (false === $result)
    {
      $ErrorString = "Can't find ".$p_description." folder.";
      GetTemplateVars()->AppendVar( 'IncomingFeedback', moa_feedback_ret($ErrorString, 'Error'));
      return false;
    }
    else
    {
      if (!(($result->readable == true) && ($result->writeable == true)))
      {
        $ErrorString = "The ".$p_description." folder is not readable and writeable.";
      	GetTemplateVars()->AppendVar( 'IncomingFeedback', moa_feedback_ret($ErrorString, 'Error'));
        return false;
      }
    }
    return true;
  }

  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
  {
  	global $g_message_type;
  	global $g_message_text;
  	global $ErrorString;

  	$proceed = false;

  	$g_message_text = "Not logged in";
  	$g_message_type = "Warning";
  	echo LoadTemplateRoot("page_message.php");
  } else
  {
  	include_once($CFG["MOA_PATH"]."sources/common.php");
  	include_once($CFG["MOA_PATH"]."sources/mod_bulkupload_funcs.php");
  	include_once($CFG["MOA_PATH"]."sources/_template_variables.php");
  	include_once($CFG["MOA_PATH"]."sources/mod_tag_funcs.php");
  	include_once($CFG["MOA_PATH"]."sources/mod_tag_view.php");

  	/* Check folder permissions */
    $result = CheckFolder($CFG["BULKUPLOAD_PATH"], 'bulk upload') ||
              CheckFolder($CFG["IMAGE_PATH"], 'image path') ||
              CheckFolder($CFG["THUMB_PATH"], 'thumbnail path');

    if (true === $result)
    {
      if (isset($_REQUEST['pageaction']))
      {
        if (0 == strcmp('add', $_REQUEST['pageaction']))
        {
        	$fileAddedCount = 0;
          $uploadPath = $CFG['MOA_PATH'].$CFG['BULKUPLOAD_PATH'];
          $dirHandle = @opendir($uploadPath);

          $noTags = false;

          $imageDescription = $_REQUEST['ftpformdesc'];
          $imageTags = $_REQUEST['ftpformtags'];
          $parentID = $_REQUEST['ftpformparent_id'];

          if ((strcmp( $parentID, 'blank') == 0) && (strlen($imageTags) == 0))
          {
            $noTags = true;
            $errorString = 'No tags or target gallery specified';
            GetTemplateVars()->AppendVar( 'IncomingFeedback',
                                          moa_feedback_ret($errorString, 'Error'));
          } else
          {
	          while (false !== ($fileName = @readdir($dirHandle)))
	          {
	            // Do not count any file/dir starting with a dot (hidden in *nix and special folders such as '..')
	            if (('.' != substr($fileName, 0, 1)) && (is_image($uploadPath.$fileName)))
	            {
                $tag = new Tag();
	            	$tagString = '';

                if (0 != strcmp($parentID, 'blank'))
	            	{
                  $tagString .= $tag->getTagStringForGallery($parentID);

	            	  if (strlen($imageTags) > 0)
                  {
                    $tagString .= ', ';
                  }
	            	}

                $tagString .= $imageTags;

	            	set_time_limit(20);

	          	  if (AddImageFromIncoming( $imageDescription, $tagString, $fileName))
	          	  {
	           		  $fileAddedCount++;
	         	    } else
	        	    {
	          	    GetTemplateVars()->AppendVar( 'IncomingFeedback',
	                                              moa_feedback_ret($errorString, 'Error'));
	        	    }
	            }
	          }
	          GetTemplateVars()->AppendVar( 'IncomingFeedback',
	                                        moa_feedback_ret('Added '.$fileAddedCount.' image(s).', 'Success'));
	        }
        }
      }

      /* Gather list images and produce an image count */
      $ftpList = _BulkUpload_ScanDir();
      GetTemplateVars()->AddVar('IncomingImagesCount', count($ftpList));
    }
    else
    {
      /* Folder permissions are bad.  Set Image count to 0 */
    	GetTemplateVars()->AddVar('IncomingImagesCount', 0);

      GetTemplateVars()->AppendVar( 'IncomingFeedback',
                                    moa_feedback_ret('Check folder permissions.', 'Error'));
    }

    $bodycontent .= "<script type='text/javascript' src='sources/common.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_taglist.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/jquery/jquery.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/JSON/json_parse.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/mod_bulkupload.js'></script>\n";
    $bodycontent .= "<script type='text/javascript' src='sources/formcheck.js'></script>\n";

    $bodycontent .= "\n\n\n".LoadTemplateRoot("head_block.php")."\n\n";
    $bodycontent .= LoadTemplateRoot('page_admin_ftp.php');

    $bodycontent .= "<script type='text/javascript'>\n";
    $bodycontent .= "  //<![CDATA[\n";
    $bodycontent .= "  all_tags = '"; ViewAllTagList();
    $bodycontent .= "';\n";
    $bodycontent .= "  cur_tags = '"; ViewGalleryCurrentTagList(0);
    $bodycontent .= "';\n";
    $bodycontent .= "  delimiter = '".$CFG["STR_DELIMITER"]."';\n";
    $bodycontent .= "  fileList = '"._BulkUpload_JSONFileList()."';\n";
    $bodycontent .= "  var feedback_box = ";
    $bodycontent .= moa_feedback_js();
    $bodycontent .= ";\n";
    $bodycontent .= "  var template_path = 'templates/".$template_name."/';\n";
    $bodycontent .= "  bulkUpload = new BulkUpload(delimiter,fileList);\n";
    $bodycontent .= "  bulkUpload.RegisterEvents();\n";
    $bodycontent .= " //]]>\n";
    $bodycontent .= "  FormCheckSetup('admin_ftp', false);\n";
    $bodycontent .= "</script>\n";

    $bodycontent .= "\n\n\n".LoadTemplateRoot("tail_block.php")."\n\n";
  }

  $bodytitle .= "FTP add - ".html_display_safe($CFG['SITE_NAME']);
?>
