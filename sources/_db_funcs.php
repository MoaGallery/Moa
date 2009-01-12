<?php
  function RunSQLFile($filename)
  {
  	global $tab_prefix;
  	
    $error = false; 
    $file = fopen($filename, "r");
    $fstat = fstat($file);
    $SQLfile = fread($file, $fstat["size"]);
    fclose($file);
    
    $count = 0;
    $tok = strtok($SQLfile, ";");
    while ($tok != false)
    {
      if (strlen($tok) >= 10)
      {        
        $sql_statement = str_replace( '<prefix>', $tab_prefix, $tok);
        
        $result = mysql_query($sql_statement) or die(mysql_error());
        if (false == $result)
        {
          $error = true;
        }
        $count++;
      }
      $tok = strtok(";");
    }
    if ($error)
    { 
      return false;
    } else
    {
      return $count;
    }
  }    
?>