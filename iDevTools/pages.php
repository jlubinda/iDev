<?php

 if(chkSes()=="Inactive")
{
		include_once "login2.php";
}
else
{
$Operationx = "Accessed";
include_once "iDevTools/system_log.php";

		if($_REQUEST["ref"]=="1")
		{
		include_once "iDevTools/bx.php";
		}
		elseif($_REQUEST["ref"]=="2")
		{
		include_once "iDevTools/fm.php";
		}
		elseif($_REQUEST["ref"]=="3")
		{
		include_once "iDevTools/blx.php";
		}
		elseif($_REQUEST["ref"]=="4")
		{
		include_once "iDevTools/4.php";
		}
		elseif($_REQUEST["ref"]=="5")
		{
		include_once "iDevTools/5.php";
		}
		elseif($_REQUEST["ref"]=="settings")
		{
		include_once "iDevTools/settings.php";
		}
		elseif($_REQUEST["ref"]=="profile")
		{
		include_once "profile.php";
		}
		elseif($_REQUEST["ref"]=="help")
		{
		include_once "help.php";
		}
		else
		{
		include_once "home.php";
		}
}
?>