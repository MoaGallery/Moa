<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">                                             
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
      ?>
      <form id="login-form" method="post" action="index.php" enctype="multipart/form-data">
        <table class="area" cellpadding="5" cellspacing="0" style="margin-left:auto; margin-right:auto;">
          <tr>
            <td class="box_header">Login</td>
          </tr>
          <tr>
            <td class="pale_area_nb">
              <table cellpadding="5" cellspacing="0">
                <tr><td class='form_text'>Name:</td><td> <input id="loginname" type="text" name="name" class='form_text' /></td></tr>
                <tr><td class='form_text'>Password:</td><td><input id="loginpass" type="password" name="password" class='form_text' /></td></tr>
                <tr><td class='form_text'>Duration:</td><td>
                	<select name="duration" class='form_text'>
                	  <option value="mins30">30 Minutes</option>
                    <option value="mins60">1 Hour</option>
                    <option value="mins120">2 Hours</option>
                    <option value="forever">Forever</option>
                  </select></td>
                </tr>
                <tr><td colspan="2"><div style="width:60px; margin-left:auto; margin-right:auto;"><input type="submit" value="Login" /></div></td></tr>
              </table>
            </td>
          </tr>
        </table>
      </form>
    <?php
    include_once ("sources/_footer.php");
  ?>
    <script type="text/javascript">
      document.getElementById("loginname").focus();
    </script>
  </body>
</html>