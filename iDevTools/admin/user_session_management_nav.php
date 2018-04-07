<?php

 if(chkSes()=="Inactive")
{

} 
else 
{
echo "<div><table id='segment_nav_head'><td width='130' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&pvCode=".$_REQUEST["pvCode"]."'>ONLINE USERS LIST</a></span></td><td></td></table></div>";
}
?>
