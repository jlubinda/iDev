<?php

 if(chkSes()=="Inactive")
{

} 
else 
{
if($_REQUEST['function']=="list")
{
echo "<form action='' method='POST'><table align='right' id=''><tr><td><input name='search' type='text' size='25'> <input name='submitBtn' type='submit' value='Search'></td></tr></table></form>";
}
echo "<div><table id='segment_nav_head'><td width='60' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&pvCode=".$_REQUEST["pvCode"]."'>LIST</a></span></td><td></td></table></div>";
}
?>
