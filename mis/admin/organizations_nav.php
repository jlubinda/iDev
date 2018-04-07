<?php


 if(@ privacy('Secure|Priv')=='Granted')
{

		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="1")
		{
		echo "<form action='' method='POST'><table align='right' id=''><tr><td> &nbsp;&nbsp; <input name='search' type='text' size='25'> <input name='submitBtn' type='submit' value='Search'><br><br></td></tr></table></form>";
		}
	echo "<div><table id='segment_nav_head'><td width='130' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=1&pvCode=".$_REQUEST["pvCode"]."'>ORGANIZATIONS LIST</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=1&pvCode=".$_REQUEST["pvCode"]."'>ADD ORGANIZATION</a></span></td><td width='160' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=2&pvCode=".$_REQUEST["pvCode"]."'>ORGANIZATION TYPE LIST</a></span></td><td width='170' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=2&pvCode=".$_REQUEST["pvCode"]."'>ADD ORGANIZATION TYPE</a></span></td><td width='180' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=3&pvCode=".$_REQUEST["pvCode"]."'>ADD ORGANIZATION BRANCH</a></span></td></tr></table></div>";
}
?>
