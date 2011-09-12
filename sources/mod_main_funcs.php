<?php
  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/mod_upgrade_funcs.php");

  class MainRecord
  {
    public $description;
  }
  
  class Main
  {
    public $description;
    private $DBValues;
    
    function __construct()
    {
      global $CFG;
  	  
  	  // Set defaults
  	  $this->description = '';
  	  
  	  $this->DBValues = new MainRecord();
  	  $this->DBValues->description = $this->description;

  	  // Attempt to load it if an ID has been supplied
  	  if (_UpgradeGetCurrentVersionID() >= 10201)
  	  {
  	    $query = "SELECT * FROM `".$CFG["tab_prefix"]."frontpage`";
      	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      	if (false !== $result)
      	{
        	$row = mysql_fetch_array($result);
        
        	$this->description = $row['Description'];
        	
      	  $this->DBValues->description = $this->description;
      	}
  	  }
    }
    
    function Commit()
    {
    	global $CFG;
  
    	if (0 != strcmp($this->description, $this->DBValues->description))
    	{
        $query = "UPDATE `".$CFG["tab_prefix"]."frontpage` SET Description = _utf8'".TypeSafeMysqlRealEscapeString( $this->description)."'";
        $result = mysql_query($query) or moa_db_error(mysql_error(), basename(__FILE__), __LINE__);
        if (false === $result)
        {
          return false;
        }
        
        $this->DBValues->description = $this->description; 
    	}
    	
    	return true;
    }
  }
  
?>