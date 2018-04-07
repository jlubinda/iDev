<?php

 if(chkSes()=="Inactive")
{

} 
else 
{

	$levels = $_REQUEST["level"];
	$levelsx = $_REQUEST["level"]+1;
	$level_urls = '';
	$level_urlsx = '';
	
echo "<div><table id='segment_nav_head'><tr><td><table><tr><td width='130'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=view&unit=1'>Theme Installer</a></td><td width='70'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=view&unit=3'>Theme List</a></td></tr></table></td></tr>";
echo "</table></div>";
}
?>
