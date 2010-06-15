<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST['CFG']))
  {
    echo 'Hacking attempt.';
    die();
  }

  include_once($CFG['MOA_PATH'].'sources/_template_variables.php');
  include_once($CFG['MOA_PATH'].'sources/mod_bulkupload_funcs.php');

  function TagParseFTPCount()
  {    
  	$count = GetTemplateVars()->GetVar('IncomingImagesCount');
    
    if (false === $count)
    { 
    	return ' ';
    }
    return '<span id="ftpcount">'.$count.'</span>';
  }
  
  function TagParseFTPStatus()
  {
    $feedback = ' ';
  	if (GetTemplateVars()->IsVarSet('IncomingFeedback'))
    {
  	  $feedback = GetTemplateVars()->GetVar('IncomingFeedback');
    }
    return $feedback;  
  }

  function TagParseFtpGalleryComboList($p_tag_options)
	{	 
	  $Gallery = new Gallery();
	  
	  $optionHtml = $Gallery->makeHtmlOptionsFromGalleryNames();
	
	  if (0 == strlen($optionHtml))
	  {
	    return ' ';
	  }
	
	  return $optionHtml;
  }  
?>