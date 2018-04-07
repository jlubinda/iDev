<?php
@$year = date(Y);
@$day = date(z);
@$hour = date(G);
@$hour2 = date(h);
@$mins = date(i);
@$sec = date(s);

include "cnct.php";

$select = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5('CUR_URL')."');";

$res = mysqli_query($db,$select);
@$numS = mysqli_num_rows($res);
@$row = mysqli_fetch_array($res);
$folderA = $row["data"];
$dataID = $row["id"];
	
	if($numS<="0")
	{
	
		$sess_id = rand(0, 999999999999999999999999);
		$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
		$ccc = md5($timex."".$sess_id."".$userID."".SesVar());
		
$folderB = md5(md5(1)."".$ccc);
$sel = "uploads/".$folderA;
$sel2 = "uploads/".$folderB;

$insert = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$userID."','".$folderB."','".md5('CUR_URL')."','');";
@$resINS = mysqli_query($db,$insert);

if($resINS)
{
$rename = mkdir($sel2);
//echo "Success!<br>";
}
else
{
//echo "Error!<br>";
}
	$moment =  $folderB;
	}
	else
	{
	$moment = $folderA;
	}
	
	

$select2 = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE meta_data = '".md5('CUR_URL2')."');";
$res2 = mysqli_query($db,$select2);
@$numS2 = mysqli_num_rows($res2);
@$row2 = mysqli_fetch_array($res2);
$folderA2 = $row2["data"];
$dataID2 = $row2["id"];
	
	if($numS2<="0")
	{
	
		$sess_id2 = rand(0, 999999999999999999999999);
		$timex2 = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
		$ccc2 = md5($timex2."C".$sess_id2."C".$userID."".SesVar());
		
$folderB2 = md5(md5(1)."".$ccc2);
$selB = "downloads/".$folderA2;
$sel2B = "downloads/".$folderB2;

$insert2 = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$userID."','".$folderB2."','".md5('CUR_URL2')."','');";
@$resINS2 = mysqli_query($db,$insert2);

if($resINS2)
{
$rename2 = mkdir($sel2B);
//echo "Success!<br>";
}
else
{
//echo "Error!<br>";
}
	$moment2 =  $folderB2;
	}
	else
	{
	$moment2 = $folderA2;
	}
	
	mysqli_close($db);
	
?>