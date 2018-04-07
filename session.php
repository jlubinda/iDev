<?php
include_once "uid.php";

$SesVar = $_SESSION[SesUID()];
$sessName = "PHPSESSID";

	if (!isset ($SesVar) || !$SesVar) 
	{
		ob_start();
	}
	
	ini_set('session.auto_start', 0);
	ini_set('session.use_strict_mode', 1);
	ini_set('session.use_cookies', 1);
	ini_set('session.use_only_cookies', 1);
	ini_set('session.cookie_lifetime', 0);
	ini_set('session.cookie_httponly', 0);
	ini_set('session.name', $sessName);
	
	session_start();

if(function_exists("check_login"))
{
	
}
else
{
	function check_login() {
		if (!isset ($SesVar) || !$SesVar) 
		{
		/* If no UID is in the cookie, we redirect to the login page */
		$login_page = "yes";
		}
		else
		{
		$login_page = "no";
		}
	}
}
?>