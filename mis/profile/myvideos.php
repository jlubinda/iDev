<?php
if(!$_REQUEST["id"])
{
$VURL = "feature";
}
else
{
$selV = "SELECT * FROM tracks WHERE id = '".$_REQUEST["id"]."';";
$resv = mysqli_query($db,$selV);
@$rwV = mysqli_fetch_array($resv);
$YTubeURL = $rwV["VideoURL"];
$VURL = $YTubeURL;
}
?>
<table align='center' id='tables_css4'>
<tr>
	<td></td>
</tr>
<tr>
	<td height="320"><iframe src="http://www.youtube.com<?php echo $VURL;?>" width="560" height="315" frameborder="0" allowfullscreen></iframe></td><td height="320">
		<table height="100%">
		<tr>
			<td height="20" align='center'><?php
	$limit = 20;
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

	@$pagesx = $numAlb/$limit;
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

		
			$pagexg = $_REQUEST["pagex"]-1;
			$pagexg2 = $_REQUEST["pagex"]+1;
			
			if(!$_REQUEST["pagex"] || $_REQUEST["pagex"]<="1")
			{
			echo "<img src='images/upinactive.png' width='100' height='20' align='center'>";
			}
			else
			{
			echo "<a href='?ref=".$_REQUEST["ref"]."&pagex=".$pagexg."&id=".$_REQUEST["id"]."'><img src='images/upactive.png' width='100' height='20' align='center'></a>";
			}
			?></td>
		</tr>
		<?php
		echo "<tr><td width='150' align='center'>";
		
		$selvB = "SELECT * FROM tracks WHERE VideoURL != '' AND artist = '".$userID."';";
		$resvB = mysqli_query($db,$selvB);
		$numvB = mysqli_num_rows($resvB);
		
		
		$selv = "SELECT * FROM tracks WHERE VideoURL != '' AND artist = '".$userID."' LIMIT ".$lower_limit.", ".$limit.";";
		$resv = mysqli_query($db,$selv);
		$numv = mysqli_num_rows($resv);
		for($i=0; $i<$numv; $i++)
		{
		@$rw = mysqli_fetch_array($resv);
		$id = $rw["id"];
		$album = $rw["album"];
		$titlex = $rw["track_title"];
		
			
		
			echo "<a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&id=".$id."&pagex=".$_REQUEST["pagex"]."'>".$titlex."</a><br>";
		
		
			$array = "";
			$selv2 = "SELECT * FROM tracks WHERE album = '".$album."' AND VideoURL != '' AND artist = '".$userID."';";
			$resv2 = mysqli_query($db,$selv2);
			@$numv2 = mysqli_num_rows($resv2);
			for($i2=0; $i2<($numv2); $i2++)
			{
			@$rw2 = mysqli_fetch_array($resv2);
			$tID = $rw2["id"];
			$array[] = $tID;
			
			}
			//echo $array;
			//$arrayx = explode("|",$array);
			$randID = rand(0,($numv2-1));
			$randTrack = $array[$randID];
			
			$select = "SELECT * FROM tracks WHERE id = '".$randTrack."' AND VideoURL != '' AND artist = '".$userID."';";
			$result = mysqli_query($db,$select);
			@$numbr = mysqli_num_rows($result);
			@$row = mysqli_fetch_array($result);
			$title = $row["track_title"];
			$ID = $row["id"];
			
		}
		echo "</td></tr>";
		?>
		<tr>
			<td height="20" align='center'><?php
			if($_REQUEST["pagex"])
			{
			$pagexbbb = $_REQUEST["pagex"];
			}
			else
			{
			$pagexbbb = 1;
			}
			
			@$limx = $numvB/($limit*$pagexbbb);
			//echo "limit:".$limx."<br>";
			if($limx>"1")
			{
			echo "<a href='?ref=".$_REQUEST["ref"]."&pagex=".$pagexg2."&id=".$_REQUEST["id"]."'><img src='images/downactive.png' width='100' height='20' align='center'></a>";
			}
			else
			{
			echo "<img src='images/downinactive.png' width='100' height='20' align='center'>";
			}
			?></td>
		</tr>
		</table>
	</td>
</tr>
</table>