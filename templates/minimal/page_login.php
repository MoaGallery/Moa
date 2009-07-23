<div class="pageoutline">
  <div class="outlinetitle">page_login.php</div>

  <form id="login-form" method="post" action="index.php" enctype="multipart/form-data">
    <div>
	    <moatag type="LogoutStatus">
	  </div>
    <p>
      Login
    </p>
    <dl>
	    <dt>
	      Name:
	    </dt>
	    <dd>
	      <input id="loginname" type="text" name="name" />
	    </dd>

	    <dt>
	      Password:
	    </dt>
	    <dd>
	      <input id="loginpass" type="password" name="password" />
	    </dd>

	    <dt>
	      Duration:
	    </dt>
	    <dd>
	      <select name="duration" id="loginduration">
	        <option value="mins30">30 Minutes</option>
	        <option value="mins60">1 Hour</option>
	        <option value="mins120">2 Hours</option>
	        <option value="forever">Forever</option>
	      </select>
	    </dd>

	    <dt>
	    </dt>
	    <dd>
	      <input type="submit" value="Login" id="loginsubmit"/>
	    </dd>
    </dl>
	</form>
</div>