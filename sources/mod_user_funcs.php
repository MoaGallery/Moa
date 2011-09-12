<?php
  // Guard against false config variables being passed via the URL
  // if the register_globals php setting is turned on
  if (isset($_REQUEST["CFG"]))
  {
    echo "Hacking attempt.";
    die();
  }

  include_once($CFG["MOA_PATH"]."sources/_error_funcs.php");
  include_once($CFG["MOA_PATH"]."sources/_db_funcs.php");

  // Structure for a single user
  class UserRecord
  {
    public $id;
    public $name;
    public $admin;
    public $password;
    public $salt;
  };

  class User
  {
    public $id;
    public $name;
    public $admin;
    public $password;
    public $salt;
    private $DBValues;
    
    function __construct($p_user_id = NULL)
    {
      global $CFG;
  	  
  	  // Set defaults
  	  $this->id = (int)$p_user_id;
  	  $this->name = '';
  	  $this->admin = false;
  	  $this->password = '';
  	  $this->salt = '';
  	  
  	  $this->DBValues = new TagRecord();
  	  $this->DBValues->id = $this->id;
  	  $this->DBValues->name = $this->name;
      $this->DBValues->admin = false;
  	  $this->DBValues->password = '';
  	  $this->DBValues->salt = '';

  	  // Attempt to load it if an ID has been supplied
  	  if (NULL !== $p_user_id)
  	  {
  	    $query = "SELECT * FROM `".$CFG["tab_prefix"]."user` WHERE IDTag = '".mysql_real_escape_string($this->id)."'";
      	$result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      	if (false !== $result)
      	{
        	$row = mysql_fetch_array($result);
        
        	$this->name        = $row['Name'];
        	$this->admin       = ($row['Admin'] == 0) ? true : false;
      	  $this->password    = $row['Password'];
      	  $this->salt        = $row['Salt'];
        	
      	  $this->DBValues->name        = $this->name;
      	  $this->DBValues->admin       = $this->admin ;
      	  $this->DBValues->password    = $this->password;
      	  $this->DBValues->salt        = $this->salt;
      	}
  	  }
    }
    
    public function Commit($p_pass = "")
    {
      global $CFG;

      $admin_val = 0;
      if ($this->admin)
      {
      	$admin_val = 1;
      }

      if (NULL == $this->id)
      {
        $new_pass = mb_strtoupper(sha1($p_pass));
  
        $query = "INSERT INTO `".$CFG["tab_prefix"]."users` (Name, Admin, Password, Salt) ".
                 "VALUES (_utf8'".mysql_real_escape_string($this->name)."', ".
                          "'".$admin_val."', ".
                          "'".$new_pass."', ".
                          "'000000');";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result) {
          return false;
        }
    
        return str_pad(mysql_insert_id(), 10, '0', STR_PAD_LEFT);
      } else
      {
        $query = "UPDATE `".$CFG["tab_prefix"]."users` SET Name=_utf8'".mysql_real_escape_string($this->name)."', ".
                                                          "Admin='".$admin_val."' ".
                                                      "WHERE IDUser = '".mysql_real_escape_string($this->id)."'";
        $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
        if (false === $result) {
          return false;
        }
    
        if (0 < strlen($p_pass))
        {
        	$new_pass = mb_strtoupper(sha1($p_pass));
    
    	    $query = "UPDATE `".$CFG["tab_prefix"]."users` SET Password='".$new_pass."' WHERE IDUser = '".mysql_real_escape_string($this->id)."'";
    	    $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
    	    if (false === $result) {
    	      return false;
    	    }
        }
      }
  
      return true;
    }
    
    /*
      Checks on database that a user exists for the given id.
    */
    static function Exists($p_id)
    {
      global $CFG;
  
      $query = "SELECT 1 FROM `".$CFG["tab_prefix"]."users` WHERE IDUser = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  
      if ((false === $result) || (0 == mysql_num_rows($result))) {
        return false;
      }
      return true;
    }
  
    /*
      Returns the ID of a username.
    */
    static function Lookup($p_name)
    {
      global $CFG;
  
      $query = "SELECT IDUser FROM `".$CFG["tab_prefix"]."users` WHERE Name = _utf8'".mysql_real_escape_string($p_name)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
  
      if ((false === $result) || (0 == mysql_num_rows($result))) {
        return false;
      }
      $row = mysql_fetch_array($result);
      return $row["IDUser"];
    }
 
    /*
      Returns a list of users.
      DOES NOT RETURN PASSWORD OR SALT for security reasons.
     */
    static function GetUsers()
    {
      global $CFG;
  
      $query = "SELECT IDUser, Name, Admin FROM `".$CFG["tab_prefix"]."users`;";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
  
      $users = array();
  
      while ($row = mysql_fetch_array($result)) {
        $user = new User;
        $user->id    = $row["IDUser"];
        $user->name  = $row["Name"];
        $user->admin = $row["Admin"];
  
        $users[] = $user;
      }
  
      return $users;
    }
  
    /*
      Deletes the user indentified by $id.
    */
    static function Delete($p_id)
    {
      global $CFG;
  
      $query = "DELETE FROM `".$CFG["tab_prefix"]."users` WHERE IDUser = '".mysql_real_escape_string($p_id)."'";
      $result = mysql_query($query) or DBMakeErrorString(__FILE__,__LINE__);
      if (false === $result) {
        return false;
      }
  
      return true;
    }

  }
  
?>
