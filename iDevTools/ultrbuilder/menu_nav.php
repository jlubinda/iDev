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
	
echo "<div><table id='segment_nav_head'><tr><td><table><tr><td width='90'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=view&unit=1'>Menu Builder</a></td><td width='70'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=view&unit=3'>Menu List</a></td></tr></table></td></tr>";
if($_REQUEST["unit"]=="2")
{
echo "<tr><td align='left'>";

	if(!$_REQUEST["level"])
	{
	$dirxx = "<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list'>MIS</a></span>/";
	}
	else
	{
		for($ov=0; $ov<($levelsx); $ov++)
		{
		
			
		for($ox=0; $ox<($ov+1); $ox++)
		{
			if($_REQUEST["level".$ox])
			{
			$level_urlsx .='&level'.$ox.'='.$_REQUEST["level".$ox]."";
			}
		}
			if(($ov)==0)
			{
			$rootx = "<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list'>MIS</a></span>";
			}
			else
			{
			$rootx = "";
			}
			
				if($_REQUEST["level".$ov])
				{
				$dirxx .= $rootx."/<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&level=".($ov+1)."&".$level_urlsx."'>".$_REQUEST["level".$ov]."</a></span>";
				}
				else
				{
				$dirxx .= "";
				}
		}
	}
		
		
	echo "".$dirxx."<br>";
	
echo "</td></tr>";
}
echo "</table></div>";
}
?>
