<?php
				
	$sql21bbb = "INSERT INTO system_log (id,PageID,Operation,userID) VALUES ('','".$PageIDx."','".$Operationx."','".$userID."');";
	@$res21bbb = mysqli_query($db,$sql21bbb);
//echo $sql21bbb;
	if($res21bbb)
	{
	//echo "Activity Logged.";
	}
	else
	{
	//echo "Activity Not Logged.";
	}
?>