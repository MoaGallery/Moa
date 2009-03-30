<?php
function ShowButtons()
{
  // Only proceed if a user is logged in
  if (!UserIsLoggedIn())
	{
	  echo "<a href='index.php?action=sitemap'><img src='media/site-map.png\n' alt='Site map button' width='80' height='21'/></a>\n";
	  echo "<a href='index.php?action=login'><img src='media/button-login.png\n' alt='Login button' width='80' height='21'/></a>\n";
	} else
	{
	  echo "<a href='index.php?action=sitemap'><img src='media/site-map.png\n' alt='Site map button' width='80' height='21'/></a>\n";
	  echo "<a href='index.php?action=admin'><img src='media/button-admin.png' alt='Admin button' width='80' height='21'/></a>\n";
	  echo "<a href='index.php?logout=true'><img src='media/button-logout.png' alt='Logout button' width='80' height='21'/></a>\n";
	}
}
?>