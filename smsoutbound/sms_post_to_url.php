<?php

include_once("cnct.php");
include_once("functions.php");

$sql="SELECT * FROM message WHERE syncstate != '1' ORDER BY id ASC LIMIT 0,30 ";
$result = mysqli_query($db,$sql);
@$num = mysqli_num_rows($result);
for($a=0; $a<$num; $a++)
{
	@$row = mysqli_fetch_array($result);
	
	$params = array(
   "date" => $row['date'],
   "dtype" => $row['dtype'],
   "from" => $row['senderMsisdn'],
   "status" => $row['status'],
   "text" => $row['textContent'],
   "type" => $row['type']
	);
	
	if(httpPost(OUTBOUND_SMS_URL(),$params))
	{
		if(markSynced($row['id'])==1)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
}
?>