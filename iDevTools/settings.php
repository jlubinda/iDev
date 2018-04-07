<table align="center" width="100%" bgcolor="#ffffff" border="0" height="100%">
<tr>
	<td>
<?php
 if(chkSes()=="Inactive")
{

} 
else 
{
	
	
	if($_REQUEST["ref"]=="settings" && !$_REQUEST["segment"])
	{
	include_once "admin/settings_index.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="a1")
	{
	include_once "admin/resources.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="b1")
	{
	include_once "admin/units.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="c1")
	{
	include_once "admin/countries.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="d1")
	{
	include_once "admin/routes.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e1")
	{
	include_once "admin/user_roles.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e2" && !$_REQUEST["regid"])
	{
	include_once "admin/user_permissions.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e2" && $_REQUEST["regid"])
	{
	include_once "admin/user_permissions2.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e3")
	{
	include_once "admin/user_account_management.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e4")
	{
	include_once "admin/user_session_management.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="f1")
	{
	include_once "admin/vehicles.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="g1")
	{
	include_once "admin/organizations.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="h1")
	{
	include_once "admin/sys_components.php";
	}
	else
	{
	
	}
}
?><br><br><br></td>
</tr></table>