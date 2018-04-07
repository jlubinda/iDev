<div style="width: 99%; background-color:#ccc;">
<?php
 if(@ privacy('Secure|Priv')=='Granted')
{
	
	if($_REQUEST["ref"]=="settings" && !$_REQUEST["segment"])
	{
	include "admin/settings_index.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="c1")
	{
	include "admin/countries.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e1")
	{
	include "admin/user_roles.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e2" && !$_REQUEST["regid"])
	{
	include "admin/user_permissions.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e2" && $_REQUEST["regid"])
	{
	include "admin/user_permissions2.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e3")
	{
	include "admin/user_account_management.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="e4")
	{
	include "admin/user_session_management.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="g1")
	{
	include "admin/organizations.php";
	}
	elseif($_REQUEST["ref"]=="settings" && $_REQUEST["segment"]=="h1")
	{
	include "admin/sys_components.php";
	}
	else
	{
	
	}
}
?>
</div>