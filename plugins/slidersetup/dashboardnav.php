<div style="float: left; margin-bottom:10px; margin:0px; font-size:10px; background-color: #fff; padding:2px;">
<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/download.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY DOWNLOADS</div></a>
<?php 

	if(dashboardNav()=="GROUPED BY CONTENT TYPE")
	{	
	?>
		<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/myaudios.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY AUDIOS</div></a>
		<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/myvideos.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY VIDEOS</div></a>
		<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/mydocuments.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY DOCUMENTS</div></a>
		<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/mysoftware.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY SOFTWARE</div></a>
		<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/myotherfiles.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY OTHER FILES</div></a>
	<?php
	}
	elseif(dashboardNav()=="GROUPED ALL TOGETHER" || dashboardNav()=="")
	{
	?>
		<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/mycontent.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">MY CONTENT</div></a>
	<?php
	}
	
?>

<a href="?ref=<?php echo iDevSite("DASHBOARD NAME"); ?>/addcontent.php"><div style="float: left; padding:1px; margin:1px; font-size:10px;">ADD CONTENT</div></a>
</div>