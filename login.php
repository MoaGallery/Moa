<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">       
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">                                                 
  <head>
     <?php
       include_once ("sources/_html_head.php");
       echo "<title>Login</title>";
     ?>
  </head>
  <body>
    <?php
      include_once ("sources/_header.php");  
      include_once ("sources/id.php");
      if ($Userinfo->ID == NULL)
      {
    ?>
    <FORM name="login-form" method="post" action="index.php" enctype="multipart/form-data">
      <center>
        <table class="area" cellpadding="5" cellspacing="0">
          <tr>
            <td class="box_header">Login</td>
          </tr>
          <tr>
            <td class="pale_area_nb">
              <table cellpadding="5" cellspacing="0">
                <tr><td class='form_text'>Name:</td><td> <INPUT id="loginname" type="text" name="name" class='form_text'></td></tr>
                <tr><td class='form_text'>Password:</td><td><INPUT id="loginpass" type="password" name="password" class='form_text'></td></tr>
                <tr><td class='form_text'>Duration:</td><td>
                	<SELECT name="duration" class='form_text'>
                	  <OPTION value="mins30">30 Minutes</OPTION>
                    <OPTION value="mins60">1 Hour</OPTION>
                    <OPTION value="mins120">2 Hours</OPTION>
                    <OPTION value="forever">Forever</OPTION>
                  </SELECT></td>
                </tr>
                <tr><td colspan="2"><center><INPUT type="submit" value="Login"></center></td></tr>
              </table>
            </td>
          </tr>
        </table>
      </center>
    </FORM>
  <?php
    }
    include_once ("sources/_footer.php");
  ?>
  </body>
  <script>document.getElementById("loginname").focus();</script>
</html>