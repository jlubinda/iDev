<?php
 if(chkSes()=="Inactive")
{

} 
else 
{



	echo "<div><table id='segment_nav_head'><td width='60' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=home&home=yes'>HOME</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=supply&unit=1'>ADD ORGANIZATION</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=supply&unit=2'>ADD ORGANIZATION TYPE</a></span></td></tr></table></div>";

	if($bx_permissions=="Yes")
	{

	

	}
	else
	{
	include_once "mis/access_denied.php";
	}
}

?>