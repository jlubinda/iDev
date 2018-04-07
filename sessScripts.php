<?php

function verifySession($SesVar){
	
	include "cnct.php";

	$sel1 = "SELECT count(id) AS maxCount FROM online WHERE _sessid = '".$SesVar."';";
	$res1 = mysqli_query($db,$sel1);
	@$num1 = mysqli_num_rows($res1);
	@$rw1 = mysqli_fetch_array($res1);
	$maxCount = $rw1["maxCount"];
	
	mysqli_close($db);
	
	if($maxCount>=1)
	{
	return 1;
	}
	else
	{
	return 0;
	}
}
?>