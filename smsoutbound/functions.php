<?php 

function httpPost($url,$params){
	$postData = '';
   //create name value pairs seperated by &
	foreach($params as $k => $v) 
	{ 
		$postData .= $k . '='.$v.'&'; 
	}
   
	$postData = rtrim($postData, '&');
 
	$ch = curl_init();  
 
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_POST, count($postData));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    
 
	$output=curl_exec($ch);
 
	curl_close($ch);
	
	return $output;
}


function markSynced($id){
	
	include_once "cnct.php";
	
	$upd = "UPDATE message SET syncstate = '1' WHERE id = '".$id."';";
	$res = mysqli_query($db,$upd);
	
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function OUTBOUND_SMS_URL(){
	return "http://localhost/carrental/inbound_sms.php";
}


function PERIODIC_URL(){
	return "http://localhost/carrental/sms_service.php";
}
?>