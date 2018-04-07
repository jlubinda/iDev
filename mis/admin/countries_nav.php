<?php

 if(@ privacy('Secure|Priv')=='Granted')
{
echo "<div><table id='segment_nav_head'><td width='110' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=1&pvCode=".$_REQUEST["pvCode"]."'>LIST OF COUNTRIES</a></span></td><td width='150' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=1&pvCode=".$_REQUEST["pvCode"]."'>ADD COUNTRY</a></span></td><td width='120'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&unit=3&pvCode=".$_REQUEST["pvCode"]."'>CURRENCY LIST</a></span></td><td width='140'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=2&pvCode=".$_REQUEST["pvCode"]."'>SETUP CURRENCIES</a></span></td><td width='170'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=4&pvCode=".$_REQUEST["pvCode"]."'>SETUP NATIONAL BUREAUX</a></span></td><td width='140'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=5&pvCode=".$_REQUEST["pvCode"]."'>SET EXCHANGE RATE</a></span></td><td width='120'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=add&unit=6&pvCode=".$_REQUEST["pvCode"]."'>TAX SETTINGS</a></span></td></table></div>";
}

?>



