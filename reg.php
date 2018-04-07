<?php
include_once "session.php";
include_once "cnct.php";
$PageID = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
//include_once "mis/priv.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "misc/strict.dtd">
<html>
<head>
<link rel="icon" href="images/logo.gif" type="image/x-icon" />
<link rel="shortcut icon" href="images/logo.gif" type="image/x-icon" />
<title>conTRIVA Professional</title>
<link rel="stylesheet" type="text/css" href="css/nav.css" />

	
	<?php 
	
		if(!isset ($_SESSION['sid_nydc']) || !$_SESSION['sid_nydc'])
		{
			$headercolor = "#00002f";
		}
		else
		{
			$headercolor = "#00CCFF";
		}
		
		if(($_REQUEST["ref"]=="returns" && (($_REQUEST["segment"]=="b1" && $_REQUEST["unit"]=="1") || ($_REQUEST["segment"]=="h1" && $_REQUEST["unit"]=="5") || ($_REQUEST["segment"]=="h1" && $_REQUEST["unit"]=="1") || ($_REQUEST["segment"]=="a4" && $_REQUEST["unit"]=="1") || ($_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="3") || ($_REQUEST["segment"]=="a2" && $_REQUEST["unit"]=="1") || ($_REQUEST["segment"]=="a1" && $_REQUEST["unit"]=="1")) && $_REQUEST["function"]=="add") && (isset ($_SESSION['sid_nydc']) || $_SESSION['sid_nydc']))
		{
			$fg = "2";	
			$ddd = "1";
			echo $ddd;
			?>
		<link rel="stylesheet" type="text/css" href="misc/jquery.multiselect.css" />
		<link rel="stylesheet" type="text/css" href="assets/style.css" />
		<link rel="stylesheet" type="text/css" href="assets/prettify.css" />
		<link rel="stylesheet" type="text/css" href="misc/jquery-ui.css" />
		<script type="text/javascript" src="misc/jquery.js"></script>
		<script type="text/javascript" src="misc/jquery-ui.min.js"></script>
		<script type="text/javascript" src="assets/prettify.js"></script>
		<script type="text/javascript" src="src/jquery.multiselect.js"></script>
		<?php
		}
		else
		{
			$fg = "1";
			$ddd = "0";
			?>
		<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery-migrate-1.1.1.js"></script>
		<script type="text/javascript" language="javascript" src="js/jfuct.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="misc/calendar-win2k-1.css" title="win2k-1">
		<script type="text/javascript" src="misc/calendar.js"></script>
		<script type="text/javascript" src="misc/calendar-en.js"></script>
		<script type="text/javascript" src="misc/calendar-setup.js"></script>
		<link rel="stylesheet" href="misc/jquery-ui.min.css" type="text/css" /> <?php
		}
	?>
</head>
<body <?php
if($fg=="2")
{
	?> id="test" onload="prettyPrint();"<?php 
}
?>>
<table align="center" id="sysbg">
	<tr>
		<td bgcolor="<?php echo $headercolor; ?>">
		<table width="101%" align="center" id="the_header">
		<?php
/*
		if(!isset ($_SESSION['sid_nydc']) || !$_SESSION['sid_nydc'])
		{
			
		} 
		else 
		{
		*/
		?>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td><?php
							$PageIDx = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
							
							$select_sys_comp = "SELECT * FROM sys_pages WHERE PageID = '".$PageIDx."';";
							@$res_sys_pages = mysqli_query($db,$select_sys_comp);
							@$num_sys_pages = mysqli_num_rows($res_sys_pages);
							/*
							echo "Number of Page Details: ".$num_sys_pages."<br>";
							
							for($f=0;$f<$num_sys_pages; $f++)
							{
							$row_f = mysqli_fetch_array($res_sys_pages);
							$page_ID = "Page ID: ".$row_f["PageID"]."<br>";
							$page_name = "Page Name: ".$row_f["name"]."<br>";
							$page_description = "Page Description: ".$row_f["description"]."<br>";
							
							echo $page_ID."".$page_name."".$page_description;
							}
							*/
								if($num_sys_pages>="1")
								{
								$registerdX = "2";
								}
								else
								{
								$registerdX = "1";
								echo "<a href='?ref=settings&segment=h1&function=add&regid=".$PageIDx."'>Click here to register this component.</a>";
								}
							?></td><td><table bgcolor="#0000bb" align="right" id="mainnav"><tr><td id="mainnav_td" align="center" width="100" <?php if($_REQUEST["ref"]=="returns"){ echo "bgcolor='#000000'";}?>><?php if(isset ($_SESSION['sid_nydc']) || $_SESSION['sid_nydc']){ ?><a href="?ref=resource&pvCode=<?php echo $_REQUEST["pvCode"];?>">u.EstiMate<span class="main_menu_sub"></span></a><?php } ?></td><td id="mainnav_td" align="center" width="80" <?php if($_REQUEST["ref"]=="settings"){ echo "bgcolor='#000000'";}?>><?php if(isset ($_SESSION['sid_nydc']) || $_SESSION['sid_nydc']){?><a href="?ref=settings&pvCode=<?php echo $_REQUEST["pvCode"];?>">Settings</a><?php }?></td></tr></table></td>
						</tr>
					</table>
				</td>
			</tr>
		<?php
		/*
		}
		*/
		?>
			<tr>
				<td>
				<?php
					//include_once "mis/nav.php";
				?>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="90%" id="mainbody">
		<?php
 
//include_once "system_log.php";

include_once "register.php";
		
		?>
		</td>
	</tr>
	<tr>
		<td id="mainbody2">
		<?php //include_once "mis/footer.php";?>
		</td>
	</tr>
</table>
</body>
</html>