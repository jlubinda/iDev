<?php
if(strtolower($applode)=="annime")
{		
	$activateVehicleOnAnnime = array(
							"name"=>"activateVehicleOnAnnime",
							"description"=>"ACTIVATE VEHICLE ON ANNIME",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"activateVehicleOnAnnime",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"activateVehicleOnAnnime.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$deactivateVehicleOnAnnime = array(
							"name"=>"deactivateVehicleOnAnnime",
							"description"=>"DEACTIVATE VEHICLE ON ANNIME",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"deactivateVehicleOnAnnime",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"deactivateVehicleOnAnnime.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$endHire = array(
							"name"=>"endHire",
							"description"=>"END HIRE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"endHire",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"endHire.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addContract = array(
							"name"=>"addContract",
							"description"=>"ADD CONTRACT",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addContract",
							"downloads"=>"",
							"inputfields"=>"customer_name|Client_ID_NO|driver_id|driver_name|Residentia_Address|Postal_Address|Email|Phone|Name_of_employer|emergencyContactPerson|contactPersonNumber|Mode_of_payment|Signature|_Date|status",
							"processor"=>"addContract.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$listContracts = array(
							"name"=>"listContracts",
							"description"=>"LIST CONTRACTS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"listContracts",
							"downloads"=>"",
							"inputfields"=>"order_by|limit_min|limit_max|status|search_details",
							"processor"=>"listContracts.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$terminateContract = array(
							"name"=>"terminateContract",
							"description"=>"TERMINATE CONTRACT",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Booking Reference Number or the Hire ID Number. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"terminateContract",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"terminateContract.php",
							"id1"=>"4403AE4E96132EFFED18B993EBB4A42A",
							"id2"=>"123",
							"misc"=>""
							);
							
	if($applodeOp=="")
	{
		$operationsArray = array();
		$operationsArray[] = $activateVehicleOnAnnime;
		$operationsArray[] = $deactivateVehicleOnAnnime;
		$operationsArray[] = $endHire;
		$operationsArray[] = $addContract; 
		$operationsArray[] = $listContracts;   
		$operationsArray[] = $terminateContract;
	}
	else
	{
		if($applodeOp=="activateVehicleOnAnnime")
		{
			$operationsArray = $activateVehicleOnAnnime;
		}
		elseif($applodeOp=="deactivateVehicleOnAnnime")
		{
			$operationsArray = $deactivateVehicleOnAnnime;
		}
		elseif($applodeOp=="endHire")
		{
			$operationsArray = $endHire;
		}
		elseif($applodeOp=="addContract")
		{
			$operationsArray = $addContract;
		}
		elseif($applodeOp=="listContracts")
		{
			$operationsArray = $listContracts;
		}
		elseif($applodeOp=="terminateContract")
		{
			$operationsArray = $terminateContract;
		}
	}
}
?>