<?php
if(function_exists("phpjavascripts"))
{
	
}
else
{
	function phpjavascripts(){
	$ax = themeurl();
	return (include_once find_file("themes/".$ax."/javascripts.php"));
	}
}

if(function_exists("phpcss"))
{
	
}
else
{
	function phpcss(){
	$ax = themeurl();
	return (include_once find_file("themes/".$ax."/css.php"));
	}
}

if(function_exists("search"))
{
	
}
else
{
	function search(){
	echo "<form action='' method='post'><input type='text' name='search' size='15'><br><input type='submit' value='Search' name='searchBtn'></form>";
	}
}

include find_file("plugins/includes/myplugins.php");

PluginFunctions();
?>