<?php
if(strtolower($applode)=="annime")
{					
	$searchVehicles = array(
							"name"=>"searchVehicles",
							"description"=>"SEARCH VEHICLES",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"search",
							"downloads"=>"",
							"inputfields"=>"order_by*|limit_min*|limit_max*|search_details",
							"processor"=>"searchVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$listvehicles = array(
							"name"=>"vehicles",
							"description"=>"LIST VEHICLES",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"list",
							"downloads"=>"",
							"inputfields"=>"order_by*|limit_min*|limit_max*",
							"processor"=>"viewVehicles.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$availableAnnimeVehicles = array(
							"name"=>"availableAnnimeVehicles",
							"description"=>"AVAILABLE ANNIME VEHICLES",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"availableAnnimeVehicles",
							"downloads"=>"",
							"inputfields"=>"order_by*|limit_min*|limit_max*|search_details",
							"processor"=>"availableAnnimeVehicles.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$availableVPVehicles = array(
							"name"=>"availableVPVehicles",
							"description"=>"AVAILABLE V-PORTAL VEHICLES",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"availableVPVehicles",
							"downloads"=>"",
							"inputfields"=>"order_by*|limit_min*|limit_max*|search_details",
							"processor"=>"availableVPVehicles.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$viewHires = array(
							"name"=>"hires",
							"description"=>"LIST HIRES",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"viewHires",
							"downloads"=>"",
							"inputfields"=>"order_by|limit_min|limit_max|search_details",
							"processor"=>"viewHires.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$listMaintenanceDetails = array(
							"name"=>"maintenanceDetails",
							"description"=>"LIST MAINTENANCE DETAILS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"listMaintenanceDetails",
							"downloads"=>"",
							"inputfields"=>"order_by|limit_min|limit_max",
							"processor"=>"listMaintenanceDetails.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$listBreakdowns = array(
							"name"=>"breakdowns",
							"description"=>"LIST BREAKDOWNS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"listBreakdowns",
							"downloads"=>"",
							"inputfields"=>"order_by|limit_min|limit_max|search_details",
							"processor"=>"listBreakdowns.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$listInspections = array(
							"name"=>"inspections",
							"description"=>"LIST INSPECTIONS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"listInspections",
							"downloads"=>"",
							"inputfields"=>"order_by|limit_min|limit_max|search_details",
							"processor"=>"listInspections.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	if($applodeOp=="")
	{
		$operationsArray = array();
		$operationsArray[] = $listvehicles;
		$operationsArray[] = $searchvehicles;
		$operationsArray[] = $availableAnnimeVehicles;
		$operationsArray[] = $availableVPVehicles;
		$operationsArray[] = $viewHires;
		$operationsArray[] = $listMaintenanceDetails; 
		$operationsArray[] = $listBreakdowns; 
		$operationsArray[] = $listInspections;  
	}
	else
	{
		if($applodeOp=="vehicles")
		{
			$operationsArray = $listvehicles;
		}
		elseif($applodeOp=="searchVehicle")
		{
			$operationsArray = $searchVehicle;
		}
		elseif($applodeOp=="availableAnnimeVehicles")
		{
			$operationsArray = $availableAnnimeVehicles;
		}
		elseif($applodeOp=="availableVPVehicles")
		{
			$operationsArray = $availableVPVehicles;
		}
		elseif($applodeOp=="hires")
		{
			$operationsArray = $viewHires;
		}
		elseif($applodeOp=="maintenanceDetails")
		{
			$operationsArray = $listMaintenanceDetails;
		}
		elseif($applodeOp=="breakdowns")
		{
			$operationsArray = $listBreakdowns;
		}
		elseif($applodeOp=="inspections")
		{
			$operationsArray = $listInspections;
		}
	}
}
?>