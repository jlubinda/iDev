<?php

if($_REQUEST["ref"]=="1")
{
	if(!$_REQUEST["segment"])
	{
	//include_once "shoutout/project_index_nav.php";
	}
	elseif($_REQUEST["segment"]=="a1")
	{
	//include_once "shoutout/a_confirmation_nav.php";
	}
	elseif($_REQUEST["segment"]=="b1")
	{
	//include_once "shoutout/a2_confirmation_nav.php";
	}
	elseif($_REQUEST["segment"]=="c1" && !$_REQUEST["unit"])
	{
	//include_once "shoutout/b_confirmation_nav.php";
	}
	elseif($_REQUEST["segment"]=="c1" && $_REQUEST["unit"])
	{
	//include_once "shoutout/stocklist_nav.php";
	}
	elseif($_REQUEST["segment"]=="d1")
	{
	//include_once "shoutout/c_confirmation_nav.php";
	}
	elseif($_REQUEST["segment"]=="e1")
	{
	//include_once "shoutout/d_confirmation_nav.php";
	}
	elseif($_REQUEST["segment"]=="f1")
	{
	//include_once "shoutout/e_confirmation_nav.php";
	}
	else
	{

	}
}
elseif($_REQUEST["ref"]=="2")
{
//echo "<form action='' method='get'><div align='right'><input type='hidden' size='25' name='page' value='".$_REQUEST["ref"]."'><input type='hidden' size='25' name='segment' value='d1'><input type='text' size='25' name='search'><input type='submit' value='Search' name='searchBtn'></div></form>";

	if(!$_REQUEST["segment"])
	{
	//include_once "filemanagerfiles/inssuance_index_nav.php";
	}
	elseif($_REQUEST["segment"]=="a1")
	{
	include_once "filemanagerfiles/mis_nav.php";
	}
	elseif($_REQUEST["segment"]=="b1")
	{
	include_once "filemanagerfiles/iDevTools_nav.php";
	}
	elseif($_REQUEST["segment"]=="c1")
	{
	//include_once "filemanagerfiles/cancelation_nav.php";
	}
	elseif($_REQUEST["segment"]=="d1")
	{
	//include_once "search_nav.php";
	}
	elseif($_REQUEST["segment"]=="e2")
	{
	//include_once "filemanagerfiles/payout_nav.php";
	}
	elseif($_REQUEST["segment"]=="e1")
	{
	//include_once "filemanagerfiles/payouthistory_nav.php";
	}
	elseif($_REQUEST["segment"]=="e3")
	{
	//include_once "filemanagerfiles/filemanagerfileshistory_nav.php";
	}
	elseif($_REQUEST["segment"]=="e4")
	{
	//include_once "filemanagerfiles/financialstatus_nav.php";
	}
	else
	{

	}
}
elseif($_REQUEST["ref"]=="3")
{
	if($_REQUEST["segment"]=="a1")
	{
	include_once "ultrbuilder/mis_nav.php";
	}
	elseif($_REQUEST["segment"]=="b1")
	{
	include_once "ultrbuilder/themes_nav.php";
	}
	elseif($_REQUEST["segment"]=="c1")
	{
	include_once "ultrbuilder/site_nav.php";
	}
	elseif($_REQUEST["segment"]=="d1")
	{
	include_once "ultrbuilder/splugin_nav.php";
	}
	elseif($_REQUEST["segment"]=="e1")
	{
	include_once "ultrbuilder/css_nav.php";
	}
	elseif($_REQUEST["segment"]=="f1")
	{
	include_once "ultrbuilder/sidebar_nav.php";
	}
	elseif($_REQUEST["segment"]=="g1")
	{
	include_once "ultrbuilder/menu_nav.php";
	}
}
elseif($_REQUEST["ref"]=="4")
{
//include_once "4_nav.php";
}
elseif($_REQUEST["ref"]=="5")
{
//include_once "5_nav.php";
}
elseif($_REQUEST["ref"]=="settings")
{
	
	if(!$_REQUEST["segment"])
	{
	//include_once "admin/settings_index_nav.php";
	}
	elseif($_REQUEST["segment"]=="a1")
	{
	include_once "admin/resources_nav.php";
	}
	elseif($_REQUEST["segment"]=="b1")
	{
	//include_once "admin/units_nav.php";
	}
	elseif($_REQUEST["segment"]=="c1")
	{
	include_once "admin/countries_nav.php";
	}
	elseif($_REQUEST["segment"]=="d1")
	{
	//include_once "admin/routes_nav.php";
	}
	elseif($_REQUEST["segment"]=="e1")
	{
	include_once "admin/user_roles_nav.php";
	}
	elseif($_REQUEST["segment"]=="e2")
	{
	include_once "admin/user_permissions_nav.php";
	}
	elseif($_REQUEST["segment"]=="e3")
	{
	include_once "admin/user_account_management_nav.php";
	}
	elseif($_REQUEST["segment"]=="e4")
	{
	include_once "admin/user_session_management_nav.php";
	}
	elseif($_REQUEST["segment"]=="f1")
	{
	include_once "admin/vehicles_nav.php";
	}
	elseif($_REQUEST["segment"]=="g1")
	{
	include_once "admin/organizations_nav.php";
	}
	elseif($_REQUEST["segment"]=="h1")
	{
	include_once "admin/sys_components_nav.php";
	}
	else
	{
	
	}
}
elseif($_REQUEST["ref"]=="profile")
{
include_once "profile/profile_nav.php";
}
elseif($_REQUEST["ref"]=="help")
{
//include_once "help_nav.php";
}
else
{
//include_once "home_nav.php";
}
?>