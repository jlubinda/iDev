<?php
						
	if($Roamingzz=="Yes" && $LimitedTozz == "Unlimited")
	{
	$CIDx = "";
	}
	elseif($Roamingzz=="Yes" && $LimitedTozz == "Country")
	{
	$CIDx = $userCountry;
	}
	elseif($Roamingzz=="Yes" && $LimitedTozz == "User`s Organization")
	{
	$CIDx = $userCountry;
	}
	
	if($Roamingzz=="Yes")
	{
	$ResetFilter = '<td width="120"><div id="tier4"><a href="?ref='.$_REQUEST["ref"].'&segment='.$_REQUEST["segment"].'&function='.$_REQUEST["function"].'&unit='.$_REQUEST["unit"].'&CID='.$CIDx.'">Reset Filter</a></div></td>';
	}
	else
	{
	$ResetFilter = '';
	}
	
$nav = '<table align="right"><tr><td width="50"><div id="tier4"><a href="?ref=help">Help</a></div></td><td width="110"><div id="tier4"><a href="?ref=<?php echo iDevSite("DASHBOARD URL");?>">User Profile</a></div></td><td width="50"><div id="tier4"><a href="logout.php">Logout</a></div></td></tr></table>';

if(chkSes()=="Active")
{

if($_REQUEST["ref"]=="1")
{
?>
<table width="100%" id="sysnav">
<tr>
<td align="left">
<table align="left">
<tr><td><table><tr><?php

$PageIDxv = $_REQUEST['ref']."|b1|";


	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	

$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];



	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="100">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a1&function=list&unit=1">STRUCTURE</a>
	</div>
</div>
	</td><?php
	//}
	

$PageIDxv = $_REQUEST['ref']."|c1|";

	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	



$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="70">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b1&function=list&unit=1">SQL</a>
	</div>
</div>
	</td><?php
	//}
	
	

$PageIDxv = $_REQUEST['ref']."|c1|";

	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	



$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="100">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c1&function=list&unit=1">IMPORT</a>
	</div>
</div>
	</td><?php
	//}
	

/*	
	

$PageIDxv = $_REQUEST['ref']."|c1|";

	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	



$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="90">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d1&function=list&unit=1">EXPORT</a>
	</div>
</div>
	</td><?php
	//}
	
	
	
	

$PageIDxv = $_REQUEST['ref']."|c1|";

	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	



$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="90">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e1&function=list&unit=1">IMPORT</a>
	</div>
</div>
	</td><?php
	//}
	
	
	
	

$PageIDxv = $_REQUEST['ref']."|c1|";

	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	



$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="90">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=f1&function=list&unit=1">OPERATIONS</a>
	</div>
</div>
	</td><?php
	//}
	*/
	?>
	</tr></table></td>
</tr>
</table>
</td>
<td align="right">
 <?php 
echo $nav;
 ?>
 </td>
</tr>
</table>
<?php
}
elseif($_REQUEST["ref"]=="2")
{
?>
<table width="100%">
<tr>
<td align="left">
<table align="left">
<tr><td><table><tr><?php

	
	

$PageIDxv = $_REQUEST['ref']."|b1|";


	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	


$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="450">
<div id="menu">
	<div id="tier3">
				<?php
				
	$levels = $_REQUEST["level"];
	$levelsx = $_REQUEST["level"]+1;
	$level_urls = '';
	$level_urlsx = '';
	
echo "<div><table id='segment_nav_head'><tr><td align='center'>";

	if(!$_REQUEST["level"])
	{
	$dirxx = "<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list'>Root</a></span>/";
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
			$rootx = "<span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list'>Root</a></span>";
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
	
echo "</td></tr></table></div>";
				?>
	</div>
</div>
	</td><?php
	//}
	
	

$PageIDxv = $_REQUEST['ref']."|c1|";


	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID like '%".$PageIDxv."%';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	


$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID like '%".$PageIDxv."%' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];

	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="70">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b1"></a>
	</div>
</div>
	</td><?php
	//}
	/*
$PageIDxv = $_REQUEST['ref']."|a1||";


	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID = '".$PageIDxv."';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	


$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID = '".$PageIDxv."' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];


	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="120">
<div id="menu">
	<div id="tier5cm" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		SECESSION OPERATIONS
		<div id="tier6">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e2&function=add&unit=1">30% PREMIUM PAYMENTS</a><br><br>
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e2&function=list&unit=1">PAYOUT HISTORY</a><br><br>
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e3&function=list&unit=1">ISSUANCE HISTORY</a><br><br>
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e4&function=list&unit=1">FINANCIAL STATUS</a><br><br>
		</div>
	</div>
</div>
	</td>
	<?php
	//}
	
	
	
	
$PageIDxv = $_REQUEST['ref']."|a1||";


	
	$select_sys_compV = "SELECT * FROM sys_pages WHERE PageID = '".$PageIDxv."';";
	@$res_sys_pagesV = mysqli_query($db,$select_sys_compV);
	@$num_sys_pagesV = mysqli_num_rows($res_sys_pagesV);
	if($num_sys_pagesV>="1")
	{
	$registerdX2 = "2";
	}
	else
	{
	$registerdX2 = "1";
	}
	


$max_perXT = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID = '".$PageIDxv."' AND UserTypeID = '".$level."'";
$res_perXT = mysqli_query($db,$max_perXT);
@$rowPerXT = mysqli_fetch_array($res_perXT);
$maxPerIDXT = $rowPerXT["maxID"];

$perm_queryT = "SELECT * FROM sys_permissions WHERE id = '".$maxPerIDXT."';";
$res_permT = mysqli_query($db,$perm_queryT);
@$rows_permT = mysqli_fetch_array($res_permT);
$bx_permissionsX = $rows_permT["bx_permissions"];
$bx_permissionsX = $rows_permT["insert_permissions"];
$bx_permissionsX = $rows_permT["delete_permissions"];


	//if(($registerdX2=="2" && ($bx_permissionsX=="Yes" || $bx_permissionsX=="Yes" || $bx_permissionsX=="Yes")) || $registerdX2=="1")
	//{
	?>
	<td width="180">
<div id="menu">
	<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a1&function=list&unit=1">AVAILABLE STOCK LIST</a>
	</div>
</div>
	</td>
	<?php
	//}
	
	*/
	?>
	</tr></table></td>
</tr>
</table>
</td>
<td align="right">
 <?php 
echo $nav;
 ?>
 </td>
</tr>
</table>
<?php
}
elseif($_REQUEST["ref"]=="3")
{
?>
<table width="100%">
<tr>
<td align="left">
<?php
	//if($bx_permissions=="Yes" || $bx_permissions=="Yes" || $bx_permissions=="Yes")
	//{
?>
<table align="left">
<tr>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a1&function=list">MIS BUILDER-X</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b1&function=list">THEMES-X</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d1&function=list">PLUGINS-X</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e1&function=list">CSS-X</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=f1&function=list">SIDEBARS</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=g1&function=list">MENUS</a>
			</div>
	</td><?php
	/*
	?>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c1">Suppliers</a>
			</div>
	</td><?php
	*/
	?>
	<?php
	/*
	?>
	<td>
<div id="menu">
	<div id="tier1" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		Investigations
		<div id="tier2">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=i1">Recource Availability</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=i2">Resource Ratings</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=i3">Supplier Ratings</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=i4">Suppliers' Other Services<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=i5">Miscellaneous</a><br><br>
		</div>
	</div>
</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=f1">Payments</a>
			</div>
	</td><?php
	*/
	?>
	<td><?php
	if($_REQUEST["pvCode"])
	{
		?>
<div id="menu">
	<div id="tier0" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		REPORTS
		<div id="tier2r">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d1">Resource Listing Report</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d2">Resource Quantities/Value</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d3">Resource Sorting</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d4">Cluster Details  Report<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d5">BOQ Report</a><br><br>
		</div>
	</div>
</div>
<?php
	}
	?>
	</td>
</tr>
</table>
<?php
	//}
?>
</td><?php
if($_REQUEST["pvCode"])
{
?><td><span class="projectName1"><b>Current Project: </b></span><span class="projectName2"><?php 
$selP = "SELECT * FROM projects WHERE pvCode = '".$_REQUEST["pvCode"]."';";
$resP = mysqli_query($db,$selP);
@$rwP = mysqli_fetch_array($resP);
$ProjectNmae = $rwP["Name"];
echo $ProjectNmae;
?></span></td><?php
}
?>
<td align="right">
 <?php 
echo $nav;
 ?>
 </td>
</tr>
</table>
<?php
}
elseif($_REQUEST["ref"]=="contractors")
{
?>
<table width="100%">
<tr>
<td align="left">
<?php
	if($bx_permissions=="Yes" || $bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
?>
<table align="left">
<tr>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a1">ADD CONTRACTORS</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b1">CONTRACT DATA</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c1">CONTRACT ADMINISTRATION</a>
			</div>
	</td>
	<td>
<div id="menu">
	<div id="tier1" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		Investigations
		<div id="tier2y">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d1">CONTRACTOR RATINGS</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d2">CONTRACTORS' OTHER SERVICES<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d3">REFERENCES</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d4">MISCELLANEOUS</a><br><br>
		</div>
	</div>
</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e1">AUTHORIZATIONS</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=f1">PAYMENTS</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=g1">MONITOR</a>
			</div>
	</td>
</tr>
</table>
<?php
	}
?>
</td>
<td align="right">
 <?php 
echo $nav;
 ?>
 </td>
</tr>
</table>
<?php
}
elseif($_REQUEST["ref"]=="reports")
{
?>
<table width="100%">
<tr>
<td align="left">
<?php
	if($bx_permissions=="Yes" || $bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
?>
<table align="left">
<tr>
	<td>
<div id="menu">
	<div id="tier1x" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		Project Reports
		<div id="tier2y">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a1">Activity Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a2">Progress Reports<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a3">Budget Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a4">????</a><br><br>
		</div>
	</div>
</div>
	</td>
	<td>
<div id="menu">
	<div id="tier1x" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		Personnel Reports
		<div id="tier2y">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b1">Activity Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b2">Progress Reports<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b3">Budget Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=b4">????</a><br><br>
		</div>
	</div>
</div>
	</td>
	<td>
<div id="menu">
	<div id="tier1x" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		Resources Reports
		<div id="tier2y">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c1">Activity Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c2">Progress Reports<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c3">Budget Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c4">????</a><br><br>
		</div>
	</div>
</div>
	</td>
	<td>
<div id="menu">
	<div id="tier1x" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		Contractor Reports
		<div id="tier2y">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d1">Activity Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d2">Progress Reports<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d3">Budget Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=d4">????</a><br><br>
		</div>
	</div>
</div>
	</td>
	<td>
<div id="menu">
	<div id="tier1x" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		SUMMARY REPORTS
		<div id="tier2y">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e1">Activity Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e2">Progress Reports<br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e3">Budget Reports</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e4">????</a><br><br>
		</div>
	</div>
</div>
	</td>
</tr>
</table>
<?php
	}
?>
</td>
<td align="right">
 <?php 
echo $nav;
 ?>
 </td>
</tr>
</table>
<?php

}
elseif($_REQUEST["ref"]=="settings")
{
?>
<table width="100%">
<tr>
<td align="left">
<?php
	if($bx_permissions=="Yes" || $bx_permissions=="Yes" || $bx_permissions=="Yes")
	{
?>
<table align="left">
<tr>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=a1">PHP</a>
			</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=c1">iDEV</a>
			</div>
	</td>
	<td>
<div id="menu">
	<div id="tier5" onmouseover="ShowSub(this)" onmouseout="CloseSub(this)">
		USERS
		<div id="tier6">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e1">USER ROLES</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e2">USER PERMISSIONS</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e3&function=list">USER ACCOUNT MANAGEMENT</a><br><br>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=e4">USER SESSION MANAGEMENT<br><br>
		</div>
	</div>
</div>
	</td>
	<td>
			<div id="tier3">
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=g1&function=list&unit=1">ORGANIZATIONS</a>
			</div>
	</td>
	<td>
<div id="menu">
	<div id="tier3">
		<a href="?ref=<?php echo $_REQUEST['ref']; ?>&segment=h1">SYSTEM COMPONENTS</a>
	</div>
</div>
	</td>
</tr>
</table>
<?php
	}
?>
</td>
<td align="right">
 <?php 
echo $nav;
 ?>
</td>
</tr>
</table>
<?php
}
else
{
?>
<table width="100%">
<tr>
<td align="left">
</td>
<td align="right">
<?php 
echo $nav;
 ?>
 </td>
</tr>
</table>
<?php
}

}
?>