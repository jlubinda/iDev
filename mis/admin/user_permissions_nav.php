<?php

 if(!isset (SesVar()) || !SesVar())
{

} 
else 
{
echo "<div><table id='segment_nav_head'><td width='60' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=2&pvCode=".$_REQUEST["pvCode"]."'>LIST</a></span></td><td width='180' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&pvCode=".$_REQUEST["pvCode"]."'>ASSIGN PERMISSIONS</a></span></td><td></td></table></div>";
}
?>
