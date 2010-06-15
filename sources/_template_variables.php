<?php
  class TemplateVariables {
    private $variables = array();
    
    public function AddVar( $p_name = '/dev/null', $p_value = null) {
    	global $errorString;
    	
    	if ((!is_string( $p_name)) || (0 === strlen( $p_name)))
    	{
    		$errorString = 'Invalid template variable';
    		return false;
    	}
    	
    	$this->variables[$p_name] = $p_value;
    	return true;    	    
    }
    
    public function AppendVar( $p_name = '/dev/null', $p_value = null) {
      global $ErrorString;
            
      if ((!is_string( $p_name)) || (0 === strlen( $p_name)))
      {
        $ErrorString = 'Invalid template variable';
        return false;
      }
      
      if (isset($this->variables[$p_name]))
      {
        $this->variables[$p_name] .= $p_value;
      } else
      {      
        $this->variables[$p_name] = $p_value;
      }
      return true;          
    }    
    
    public function GetVar( $p_name = '/dev/null') {
      global $errorString;
      
      if ((!is_string( $p_name)) || (0 === strlen( $p_name)))
      {
        $errorString = 'Invalid template variable ('.$p_name.')';
        return false;
      }

      if (!isset($this->variables[$p_name]))
      {      	      	
      	$errorString = 'Invalid template variable ('.$p_name.')';
      	return false;
      }
      return $this->variables[$p_name];         
    }
   
    public function IsVarSet( $p_name) {
      if (!isset($this->variables[$p_name]))
      {
        return false;
      }
      return true;
    }               
  }
  
  $_variables = new TemplateVariables();
  
  function GetTemplateVars()
  {
  	global $_variables;
  	
    return $_variables;
  }
?>