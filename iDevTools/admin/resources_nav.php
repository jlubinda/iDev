<?php

 if(chkSes()=="Inactive")
{

} 
else 
{
echo "<div><table id='segment_nav_head'><td width='60' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=1&pvCode=".$_REQUEST["pvCode"]."'>PHP INFO</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=1&pvCode=".$_REQUEST["pvCode"]."'></a></span></td></tr></table></div>";
}
	?>
