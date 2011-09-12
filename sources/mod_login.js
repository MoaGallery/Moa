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
    $('#login-form').submit(that.Submit);
    $('#loginsubmit').click(that.Submit);
    $('#loginname').keypress(function (e) {checkKey(e, 'loginsubmit', null);});
    $('#loginpass').keypress(function (e) {checkKey(e, 'loginsubmit', null);});
    $('#loginduration').keypress(function (e) {checkKey(e, 'loginsubmit', null);});
  };

  that.RegisterEvents();
  $('#loginname').focus();
}