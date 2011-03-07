function Login()
{
  var that = this;
  
  this.Submit = function()
  {
    if (!FormCheck())
    {
      return false;
    }

  	return true;
  };


  this.RegisterEvents = function()
  {
    //addEvent(document.getElementById("login-form"), "submit", function (e) {return login.Submit();});
    $("#login-form").submit(that.Submit);
  };

  that.RegisterEvents();
}