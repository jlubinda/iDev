<?php

 if(chkSes()=="Inactive")
{

} 
else 
{

		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="1")
		{
		echo "<form action='' method='POST'><table align='right' id=''><tr><td> &nbsp;&nbsp; <input name='search' type='text' size='25'> <input name='submitBtn' type='submit' value='Search'><br><br></td></tr></table></form>";
		}
	echo "<div><table id='segment_nav_head'><td width='130' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=1&pvCode=".$_REQUEST["pvCode"]."'>ORGANIZATIONS LIST</a></span></td></tr></table></div>";
}
?>
