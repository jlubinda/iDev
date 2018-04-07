<?php
if(strtolower($applode)=="annime")
{
							
	$vehicles = array(
							"name"=>"vehicles",
							"description"=>"GET VEHICLE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"view",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"viewVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$viewHire = array(
							"name"=>"hires",
							"description"=>"GET HIRE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"viewHire",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"viewHire.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$viewFitness = array(
							"name"=>"fitness",
							"description"=>"GET FITNESS",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"viewFitness",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"viewFitness.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$checkFitnessValidity = array(
							"name"=>"fitnessValidity",
							"description"=>"CHECK FITNESS VALIDITY",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"checkFitnessValidity",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"checkFitnessValidity.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$viewInsurance = array(
							"name"=>"insurance",
							"description"=>"GET INSURANCE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"viewInsurance",
							"downloads"=>"addVehicle",
							"inputfields"=>"",
							"processor"=>"viewInsurance.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$checkInsuranceValidity = array(
							"name"=>"insuranceValidity",
							"description"=>"CHECK INSURANCE VALIDITY",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"checkInsuranceValidity",
							"downloads"=>"addVehicle",
							"inputfields"=>"",
							"processor"=>"checkInsuranceValidity.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$viewRoadTax = array(
							"name"=>"roadTax",
							"description"=>"GET ROAD TAX",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"viewRoadTax",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"viewRoadTax.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$checkRoadTaxValidity = array(
							"name"=>"roadTaxValidity",
							"description"=>"CHECK ROAD TAX VALIDITY",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"checkRoadTaxValidity",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"checkRoadTaxValidity.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$viewMileage = array(
							"name"=>"mileage",
							"description"=>"GET MILEAGE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"viewMileage",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"viewMileage.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$checkRemainingMileage = array(
							"name"=>"remainingMileage",
							"description"=>"CHECK REMAINING MILEAGE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"checkRemainingMileage",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"checkRemainingMileage.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$getMaintenanceDetails = array(
							"name"=>"maintenanceDetails",
							"description"=>"GET MAINTENANCE DETAILS",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"getMaintenanceDetails",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"getMaintenanceDetails.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$getBreakdownDetails = array(
							"name"=>"breakdownDetails",
							"description"=>"GET BREAKDOWN DETAILS",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"getBreakdownDetails",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"getBreakdownDetails.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$getContractDetails = array(
							"name"=>"contractDetails",
							"description"=>"GET CONTRACT DETAILS",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Booking Reference Number or the Hire ID Number. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"getContractDetails",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"getContractDetails.php",
							"id1"=>"4403AE4E96132EFFED18B993EBB4A42A",
							"id2"=>"123",
							"misc"=>""
							);
							
	$getInspectionDetails = array(
							"name"=>"inspectionDetails",
							"description"=>"GET INSPECTION DETAILS",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"getInspectionDetails",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"getInspectionDetails.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	if($applodeOp=="")
	{
		$operationsArray = array();
		$operationsArray[] = $vehicles;
		$operationsArray[] = $viewHire;
		$operationsArray[] = $viewFitness;
		$operationsArray[] = $checkFitnessValidity;
		$operationsArray[] = $viewInsurance;
		$operationsArray[] = $checkInsuranceValidity;
		$operationsArray[] = $viewRoadTax;
		$operationsArray[] = $checkRoadTaxValidity;
		$operationsArray[] = $viewMileage;
		$operationsArray[] = $checkRemainingMileage; 
		$operationsArray[] = $getMaintenanceDetails; 
		$operationsArray[] = $getBreakdownDetails; 
		$operationsArray[] = $getContractDetails; 
		$operationsArray[] = $getInspectionDetails;
	}
	else
	{
		if($applodeOp=="vehicles")
		{
			$operationsArray = $vehicles;
		}
		elseif($applodeOp=="hire")
		{
			$operationsArray = $viewHire;
		}
		elseif($applodeOp=="fitness")
		{
			$operationsArray = $viewFitness;
		}
		elseif($applodeOp=="insurance")
		{
			$operationsArray = $viewInsurance;
		}
		elseif($applodeOp=="roadTax")
		{
			$operationsArray = $viewRoadTax;
		}
		elseif($applodeOp=="fitnessValidity")
		{
			$operationsArray = $checkFitnessValidity;
		}
		elseif($applodeOp=="insuranceValidity")
		{
			$operationsArray = $checkInsuranceValidity;
		}
		elseif($applodeOp=="roadTaxValidity")
		{
			$operationsArray = $checkRoadTaxValidity;
		}
		elseif($applodeOp=="mileage")
		{
			$operationsArray = $viewMileage;
		}
		elseif($applodeOp=="remainingMileage")
		{
			$operationsArray = $checkRemainingMileage;
		}
		elseif($applodeOp=="maintenanceDetails")
		{
			$operationsArray = $getMaintenanceDetails;
		}
		elseif($applodeOp=="breakdownDetails")
		{
			$operationsArray = $getBreakdownDetails;
		}
		elseif($applodeOp=="contractDetails")
		{
			$operationsArray = $getContractDetails;
		}
		elseif($applodeOp=="inspectionDetails")
		{
			$operationsArray = $getInspectionDetails;
		}
	}
}
?>