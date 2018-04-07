<?php

 if(chkSes()=="Inactive")
{

} 
else 
{
echo "<div><table id='segment_nav_head'><td width='60' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=home'>HOME</a></span></td><td width='180' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=supply'>SUPPLY TO COMESA</a></span></td><td></td></table></div>";
}
?>
