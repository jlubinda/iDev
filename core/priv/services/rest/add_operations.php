<?php
if(strtolower($applode)=="annime")
{
		
	$vehicles = array(
							"name"=>"vehicles",
							"description"=>"ADD VEHICLES",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully added|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"add",
							"downloads"=>"",
							"inputfields"=>"vehicle_reg*|vehiclemake*|vehicletype*|bodytype*|enginesize*|fueltype*|vehicle_color|vehicle_weight|conrate|enginenumber|chassisnumber|tanksize|transmission|seats|modelyear*|doors|aircon|entertainment|safety|country|misc",
							"processor"=>"addVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
	
	$addHire = array(
							"name"=>"hires",
							"description"=>"ADD HIRE",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addHire",
							"downloads"=>"",
							"inputfields"=>"firstName|lastName|pickup_time|pickup_place|date_of_arrival|end_date|dropoff_time|dropoff_place|drive_mode|destination|phone|email|vehicle_id",
							"processor"=>"addHire.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addFitness = array(
							"name"=>"addFitness",
							"description"=>"ADD FITNESS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addFitness",
							"downloads"=>"",
							"inputfields"=>"valid_from|valid_to",
							"processor"=>"addFitness.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addInsurance = array(
							"name"=>"addInsurance",
							"description"=>"ADD INSURANCE",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addInsurance",
							"downloads"=>"",
							"inputfields"=>"valid_from|valid_to",
							"processor"=>"addInsurance.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addRoadTax = array(
							"name"=>"addRoadTax",
							"description"=>"ADD ROAD TAX",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addRoadTax",
							"downloads"=>"",
							"inputfields"=>"valid_from|valid_to",
							"processor"=>"addRoadTax.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addMainenanceDetails = array(
							"name"=>"addMainenanceDetails",
							"description"=>"ADD MAINENANCE DETAILS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addMainenanceDetails",
							"downloads"=>"",
							"inputfields"=>"works_type|details_of_works|parts_removed|parts_added|mileage|status",
							"processor"=>"addMainenanceDetails.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addBreakdown = array(
							"name"=>"addBreakdown",
							"description"=>"ADD BREAKDOWN",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addBreakdown",
							"downloads"=>"",
							"inputfields"=>"driver_name|driver_id|details_of_breakdown|details_of_works|status",
							"processor"=>"addBreakdown.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$addInspection = array(
							"name"=>"addInspection",
							"description"=>"ADD INSPECTION",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"addInspection",
							"downloads"=>"",
							"inputfields"=>"Tires|Jerk|WheelsSpanner|Winder|Interior|Radio|Exterior|SpareWheel|GPS_HardCopyMap|EngineCheck|WindScreenFront|WindScreenRear|WipersFront|Fender|SideMirrors|WipersRear|WindowsBlinders|RoofTop|Dents|Comments|CheckedBy|SignedBy|Signature",
							"processor"=>"addInspection.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	if($applodeOp=="")
	{
		$operationsArray = array();
		$operationsArray[] = $vehicles;
		$operationsArray[] = $addHire;
		$operationsArray[] = $addFitness;
		$operationsArray[] = $addInsurance;
		$operationsArray[] = $addRoadTax; 
		$operationsArray[] = $addMainenanceDetails; 
		$operationsArray[] = $addBreakdown; 
		$operationsArray[] = $addContract; 
		$operationsArray[] = $addInspection;
	}
	else
	{
		if($applodeOp=="vehicles")
		{
			$operationsArray = $vehicles;
		}
		elseif($applodeOp=="addHire")
		{
			$operationsArray = $addHire;
		}
		elseif($applodeOp=="addFitness")
		{
			$operationsArray = $addFitness;
		}
		elseif($applodeOp=="addInsurance")
		{
			$operationsArray = $addInsurance;
		}
		elseif($applodeOp=="addRoadTax")
		{
			$operationsArray = $addRoadTax;
		}
		elseif($applodeOp=="addMainenanceDetails")
		{
			$operationsArray = $addMainenanceDetails;
		}
		elseif($applodeOp=="addBreakdown")
		{
			$operationsArray = $addBreakdown;
		}
		elseif($applodeOp=="addContract")
		{
			$operationsArray = $addContract;
		}
		elseif($applodeOp=="addInspection")
		{
			$operationsArray = $addInspection;
		}
	}
}
?>