<?php
	
	$sortx = $_REQUEST["sort"];
	if($_REQUEST["sort"])
	{
	$sorting = $sortx;
	}
	else
	{
	$sorting = 'id';
	}
	
	//Pages
	$limit = "20";
	$pagex = $_REQUEST["pagex"];
	if(!$pagex)
	{
	$page = "1";
	}
	else
	{
	$page = $pagex;
	}
	$upper_limit = ($page*$limit);
	$lower_limit = ($page*$limit)-$limit;
	
	
	if(!$_REQUEST["unit"])
	{
	$daysADDED = 365;
	}
	elseif($_REQUEST["unit"]=="1")
	{
	$daysADDED = 365;
	}
	elseif($_REQUEST["unit"]=="2")
	{
	$daysADDED = 1;
	}
	elseif($_REQUEST["unit"]=="3")
	{
	$daysADDED = 7;
	}
	elseif($_REQUEST["unit"]=="4")
	{
	$daysADDED = 30;
	}
	elseif($_REQUEST["unit"]=="5")
	{
	$daysADDED = 365;
	}
	
	$expirey = strtotime("- ".$daysADDED." day",strtotime(date("Y-m-j")));
	$expirey = date("Y-m-j",$expirey);
		
$selD = "SELECT track,sum(paidtoken) AS sumPaidDownloads,sum(token) AS sumDownloads FROM downloads WHERE dateset > '".$expirey."' AND uid = '".$userID."';";
$selRes = mysqli_query($db,$selD);
@$selNum = mysqli_num_rows($selRes);
	@$rowDc = mysqli_fetch_array($selRes);
	$trackID = $rowDc["track"];
	$sumDownloads = $rowDc["sumDownloads"];
	$sumPaidDownloads = $rowDc["sumPaidDownloads"];

$selPrice = "SELECT * FROM _token_price WHERE id = (SELECT max(id) AS maxID FROM _token_price);";
@$resPrice = mysqli_query($db,$selPrice);
$rowPrice = mysqli_fetch_array(@$resPrice);
$tokenQ = $rowPrice["tokens"];
$priceQ = $rowPrice["price"];
$tokenRate = $priceQ/$tokenQ;

$tokens =  $_POST["amountPaid"]/$tokenRate;


	$selTr1xQg = "SELECT * FROM _artist_percentage WHERE id = (SELECT max(id) AS maxID FROM _artist_percentage);";
	$resTr1xQg = mysqli_query($db,$selTr1xQg);
	$rowTr1xQg = mysqli_fetch_array($resTr1xQg);
	$percentageQg = $rowTr1xQg["percentage"];
	
	$artistAmount = ($percentageQg/100)*$sumPaidDownloads/$tokenRate;	
?>
<table align='center' width='98%' id='tables_css'>
<tr>
	<td><b>Total Downloads:</b> <?php echo $sumDownloads;?></td><td><b>Total Paid Downloads:</b> <?php echo $sumPaidDownloads;?></td><td><b>Total Grossed:</b> K <?php echo @number_format($artistAmount,2);?></td><td><b>Total Earnings:</b> K <?php echo @number_format($artistPaidAmount,2);?></td><td><b>Outstandting Balance:</b> K <?php echo @number_format(($artistAmount-$artistPaidAmount),2);?></td>
</tr>
</table><br>
<?php
	$query2 = "SELECT * FROM downloads  WHERE (uid = '".$userID."') GROUP BY track;";
	$result2 = mysqli_query($db,$query2);
	@$numb2 = mysqli_num_rows($result2);
	$pagesx = $numb2/$limit;
	$pagesy = @number_format($pagesx,0);
	if($pagesx>$pagesy)
	{
	$pagesz = $pagesy+1;
	$pagesv = @number_format($pagesz,0);
	}
	else
	{
	$pagesv = @number_format($pagesy,0);
	}
	$pages = $pagesv;
	
	//Pages
?>
<p>
<?php

if($_REQUEST["order"]=="DESC") 
{ 
$ordering = "ASC";
} 
else 
{ 
$ordering = "DESC";
}
$ordering2 = $_REQUEST["order"];

echo "<br><br>Page: ";
	for($f=0; $f<$pages; $f++)
	{
	$b = $f + 1;
	if($b==$page)
	{
	echo "<strong><u><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=c1&function=&unit=1&unitx=".$_REQUEST["unitx"]."&lban=".$_REQUEST["lban"]."&pagex=$b&order=$ordering2'>$b</a></u> &nbsp;&nbsp;</strong>";
	}
	else
	{
	echo "<a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=c1&function=&unit=1&unitx=".$_REQUEST["unitx"]."&lban=".$_REQUEST["lban"]."&pagex=$b&order=$ordering2'>$b</a> &nbsp;&nbsp;";
	}
	}
	?>	
</p>
<table align='center' width='98%' id='tables_css'>
<tr>
	<td><b>No.</b></td><td><b>Track</b></td><td><b>Album</b></td><td><b>Date Released</b></td><td><b>No. of Downloads</b></td><td><b>No. of Paid Downloads</b></td><td><b>Amount Grossed By Track</b></td><td><b></b></td>
</tr><?php

	$query = "SELECT track,sum(token) AS sumTokens,sum(paidtoken) AS sumPaidTokens FROM downloads  WHERE uid = '".$userID."' GROUP BY track order by ".$sorting." ".$ordering." LIMIT ".$lower_limit.", ".$limit.";";
	$result = mysqli_query($db,$query);
	@$nume = mysqli_num_rows($result);
for($e=0; $e<$nume; $e++)
{
$rwE = mysqli_fetch_array($result);
$sumTokens = $rwE["sumTokens"];
$sumPaidTokens = $rwE["sumPaidTokens"];
$track = $rwE["track"];

$selT = "SELECT * FROM tracks WHERE id = '".$track."';";
$resT = mysqli_query($db,$selT);
@$rwT = mysqli_fetch_array($resT);
$trackTitle = $rwT["track_title"];
$date_of_release = $rwT["date_of_release"];
$album = $rwT["album"];

$selU = "SELECT * FROM albums WHERE url = '".$album."';";
$resU = mysqli_query($db,$selU);
@$rwU = mysqli_fetch_array($resU);
$albumTitle = $rwU["album"];

$amoutDueonTrack = ($percentageQg/100)*$sumPaidTokens/$tokenRate;;
?>
<tr>
	<td><?php echo ($e+1);?></td><td><?php echo $trackTitle;?></td><td><?php echo $albumTitle;?></td><td><?php echo $date_of_release;?></td><td><?php echo $sumTokens;?></td><td><?php echo $sumPaidTokens;?></td><td><?php echo @number_format($amoutDueonTrack,2);?></td><td width='120'><a href='?ref=3&segment=a1&function=&unit=3&unitx=<?php echo $track;?>&lban=<?php echo $album;?>'>View Track Details</a></td>
</tr>
<?php
}
?>
</table>
<p>
<?php
echo "Page: ";
	for($e=0; $e<$pages; $e++)
	{
	$x = $e + 1;
	if($x==$page)
	{
	echo "<strong><u><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=c1&function=&unit=1&pagex=$x&order=$ordering2".$org_filter."'>$x</a></u> &nbsp;&nbsp;</strong>";
	}
	else
	{
	echo "<a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=c1&function=&unit=1&pagex=$x&order=$ordering2".$org_filter."'>$x</a> &nbsp;&nbsp;";
	}
	}
?>
</p>
