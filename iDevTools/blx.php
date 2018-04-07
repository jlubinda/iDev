<table align="center" width="100%" bgcolor="#ffffff" border="0" height="100%">
<tr>
	<td>
<?php
 if(chkSes()=="Active")
{
//echo "<form action='' method='get'><div id='search_field'><input type='hidden' size='25' name='page' value='".$_REQUEST["ref"]."'><input type='hidden' size='25' name='segment' value='d1'><input type='text' size='25' name='search'><input type='submit' value='Search' name='searchBtn'></div></form>";

	if($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="1")
	{
	include_once "ultrbuilder/mis_builder.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/mis.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="3")
	{
	include_once "ultrbuilder/mispages.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="b1" && $_REQUEST["unit"]=="1")
	{
	include_once "ultrbuilder/theme_installer.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="b1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/blog.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="b1" && $_REQUEST["unit"]=="3")
	{
	include_once "ultrbuilder/theme_list.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="c1" && $_REQUEST["unit"]=="1")
	{
	include_once "ultrbuilder/site_builder.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="c1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/site.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="c1" && $_REQUEST["unit"]=="3")
	{
	include_once "ultrbuilder/sitepages.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="d1" && $_REQUEST["unit"]=="1")
	{
	include_once "ultrbuilder/plugin_installer.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="d1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/plugins.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="d1" && $_REQUEST["unit"]=="3")
	{
	include_once "ultrbuilder/plugin_list.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="e1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/css.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="f1" && $_REQUEST["unit"]=="1")
	{
	include_once "ultrbuilder/sidebar_builder.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="f1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/sidebars.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="f1" && $_REQUEST["unit"]=="3")
	{
	include_once "ultrbuilder/sidebar_list.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="f1" && $_REQUEST["unit"]=="4")
	{
	include_once "ultrbuilder/missidebars.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="g1" && $_REQUEST["unit"]=="1")
	{
	include_once "ultrbuilder/menu_builder.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="g1" && $_REQUEST["unit"]=="2")
	{
	include_once "ultrbuilder/menus.php";
	}
	elseif($_REQUEST["ref"]=="3" && $_REQUEST["segment"]=="g1" && $_REQUEST["unit"]=="3")
	{
	include_once "ultrbuilder/menu_list.php";
	}
	else
	{

	}
}
?></td>
</tr></table>