<?php
if(strtolower($applode)=="annime")
{
		
	$addvehicles = array(
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
							
	$viewvehicles = array(
							"name"=>"vehicles",
							"description"=>"VIEW VEHICLE",
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
							
	$searchvehicles = array(
							"name"=>"vehicles",
							"description"=>"SEARCH VEHICLE",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either ASC (Ascending Order) or DESC (Descending Order). Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"search",
							"downloads"=>"",
							"inputfields"=>"order_by|limit_min|limit_max|search_details",
							"processor"=>"searchVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$listvehicles = array(
							"name"=>"vehicles",
							"description"=>"VIEW VEHICLES",
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
							
	$editVehicle = array(       
							"name"=>"vehicles",
							"description"=>"EDIT VEHICLE DETAILS",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"addVehicle",
							"operation"=>"edit",
							"downloads"=>"addVehicle",
							"inputfields"=>"vehicle_reg|vehiclemake|vehicletype|bodytype|enginesize|vehicle_color|vehicle_weight|fueltype|conrate|enginenumber|chassisnumber|tanksize|transmission|seats|modelyear|doors|aircon|entertainment|safety|country|misc",
							"processor"=>"editVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
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
							"inputfields"=>"order_by|limit_min|limit_max|search_details",
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
							"inputfields"=>"order_by|limit_min|limit_max|search_details",
							"processor"=>"availableVPVehicles.php",
							"id1"=>"ASC",
							"id2"=>"DESC",
							"misc"=>""
							);
							
	$activateVehicleOnVP = array(
							"name"=>"activateVehicleOnVP",
							"description"=>"ACTIVATE VEHICLE ON VEHICLE PORTAL",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"activateVehicleOnVP",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"activateVehicleOnVP.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	$deactivateVehicleOnVP = array(
							"name"=>"deactivateVehicleOnVP",
							"description"=>"DEACTIVATE VEHICLE ON VEHICLE PORTAL",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"deactivateVehicleOnVP",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"deactivateVehicleOnVP.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
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
							
	$deleteVehicle = array(
							"name"=>"deleteVehicle",
							"description"=>"DELETE VEHICLE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"deleteVehicle",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"deleteVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
	
	$addHire = array(
							"name"=>"addHire",
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
							
	$viewHire = array(
							"name"=>"viewHire",
							"description"=>"VIEW HIRE",
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
							
	$viewHires = array(
							"name"=>"viewHires",
							"description"=>"VIEW HIRES",
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
							
	$editHire = array(
							"name"=>"editHire",
							"description"=>"EDIT HIRE",
							"instructions"=>"Make sure you use a POST request when sending data on this API. The full URL to which you are to POST data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"editHire",
							"downloads"=>"",
							"inputfields"=>"firstName|lastName|pickup_time|pickup_place|date_of_arrival|end_date|dropoff_time|dropoff_place|drive_mode|destination|phone|email",
							"processor"=>"editHire.php",
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
							
	$viewFitness = array(
							"name"=>"viewFitness",
							"description"=>"VIEW FITNESS",
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
							"name"=>"checkFitnessValidity",
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
							
	$viewInsurance = array(
							"name"=>"viewInsurance",
							"description"=>"VIEW INSURANCE",
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
							"name"=>"checkInsuranceValidity",
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
							
	$viewRoadTax = array(
							"name"=>"viewRoadTax",
							"description"=>"VIEW ROAD TAX",
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
							"name"=>"checkRoadTaxValidity",
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
							"name"=>"viewMileage",
							"description"=>"VIEW MILEAGE",
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
							"name"=>"checkRemainingMileage",
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
							
	$listMaintenanceDetails = array(
							"name"=>"listMaintenanceDetails",
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
							
	$getMaintenanceDetails = array(
							"name"=>"getMaintenanceDetails",
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
							
	$getBreakdownDetails = array(
							"name"=>"getBreakdownDetails",
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
							
	$listBreakdowns = array(
							"name"=>"listBreakdowns",
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
							
	$getContractDetails = array(
							"name"=>"getContractDetails",
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
							
	$getInspectionDetails = array(
							"name"=>"getInspectionDetails",
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
							
	$listInspections = array(
							"name"=>"listInspections",
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
		$operationsArray[] = $addvehicles;
		$operationsArray[] = $viewvehicles;
		$operationsArray[] = $searchvehicles;
		$operationsArray[] = $listvehicles;
		$operationsArray[] = $availableAnnimeVehicles;
		$operationsArray[] = $availableVPVehicles;
		$operationsArray[] = $editVehicle;
		$operationsArray[] = $activateVehicleOnAnnime;
		$operationsArray[] = $deactivateVehicleOnAnnime;
		$operationsArray[] = $activateVehicleOnVP;
		$operationsArray[] = $deactivateVehicleOnVP;
		$operationsArray[] = $deleteVehicle;
		$operationsArray[] = $addHire;
		$operationsArray[] = $viewHire;
		$operationsArray[] = $viewHires;
		$operationsArray[] = $editHire;
		$operationsArray[] = $endHire;
		$operationsArray[] = $addFitness;
		$operationsArray[] = $viewFitness;
		$operationsArray[] = $checkFitnessValidity;
		$operationsArray[] = $addInsurance;
		$operationsArray[] = $viewInsurance;
		$operationsArray[] = $checkInsuranceValidity;
		$operationsArray[] = $addRoadTax;
		$operationsArray[] = $viewRoadTax;
		$operationsArray[] = $checkRoadTaxValidity;
		$operationsArray[] = $viewMileage;
		$operationsArray[] = $checkRemainingMileage; 
		$operationsArray[] = $addMainenanceDetails; 
		$operationsArray[] = $listMaintenanceDetails; 
		$operationsArray[] = $getMaintenanceDetails; 
		$operationsArray[] = $addBreakdown; 
		$operationsArray[] = $getBreakdownDetails; 
		$operationsArray[] = $listBreakdowns;
		$operationsArray[] = $addContract; 
		$operationsArray[] = $getContractDetails; 
		$operationsArray[] = $listContracts;   
		$operationsArray[] = $terminateContract;
		$operationsArray[] = $addInspection; 
		$operationsArray[] = $getInspectionDetails;
		$operationsArray[] = $listInspections;  
	}
	else
	{
		if($applodeOp=="vehicles")
		{
			$operationsArray = $vehicles;
		}
		elseif($applodeOp=="viewVehicle")
		{
			$operationsArray = $viewVehicle;
		}
		elseif($applodeOp=="searchVehicle")
		{
			$operationsArray = $searchVehicle;
		}
		elseif($applodeOp=="viewVehicles")
		{
			$operationsArray = $viewVehicles;
		}
		elseif($applodeOp=="availableAnnimeVehicles")
		{
			$operationsArray = $availableAnnimeVehicles;
		}
		elseif($applodeOp=="availableVPVehicles")
		{
			$operationsArray = $availableVPVehicles;
		}
		elseif($applodeOp=="editVehicle")
		{
			$operationsArray = $editVehicle;
		}
		elseif($applodeOp=="activateVehicleOnAnnime")
		{
			$operationsArray = $activateVehicleOnAnnime;
		}
		elseif($applodeOp=="deactivateVehicleOnAnnime")
		{
			$operationsArray = $deactivateVehicleOnAnnime;
		}
		elseif($applodeOp=="activateVehicleOnVP")
		{
			$operationsArray = $activateVehicleOnVP;
		}
		elseif($applodeOp=="deactivateVehicleOnVP")
		{
			$operationsArray = $deactivateVehicleOnVP;
		}
		elseif($applodeOp=="deleteVehicle")
		{
			$operationsArray = $deleteVehicle;
		}
		elseif($applodeOp=="addHire")
		{
			$operationsArray = $addHire;
		}
		elseif($applodeOp=="viewHire")
		{
			$operationsArray = $viewHire;
		}
		elseif($applodeOp=="viewHires")
		{
			$operationsArray = $viewHires;
		}
		elseif($applodeOp=="editHire")
		{
			$operationsArray = $editHire;
		}
		elseif($applodeOp=="endHire")
		{
			$operationsArray = $endHire;
		}
		elseif($applodeOp=="addFitness")
		{
			$operationsArray = $addFitness;
		}
		elseif($applodeOp=="viewFitness")
		{
			$operationsArray = $viewFitness;
		}
		elseif($applodeOp=="addInsurance")
		{
			$operationsArray = $addInsurance;
		}
		elseif($applodeOp=="viewInsurance")
		{
			$operationsArray = $viewInsurance;
		}
		elseif($applodeOp=="addRoadTax")
		{
			$operationsArray = $addRoadTax;
		}
		elseif($applodeOp=="viewRoadTax")
		{
			$operationsArray = $viewRoadTax;
		}
		elseif($applodeOp=="checkFitnessValidity")
		{
			$operationsArray = $checkFitnessValidity;
		}
		elseif($applodeOp=="checkInsuranceValidity")
		{
			$operationsArray = $checkInsuranceValidity;
		}
		elseif($applodeOp=="checkRoadTaxValidity")
		{
			$operationsArray = $checkRoadTaxValidity;
		}
		elseif($applodeOp=="viewMileage")
		{
			$operationsArray = $viewMileage;
		}
		elseif($applodeOp=="checkRemainingMileage")
		{
			$operationsArray = $checkRemainingMileage;
		}
		elseif($applodeOp=="addMainenanceDetails")
		{
			$operationsArray = $addMainenanceDetails;
		}
		elseif($applodeOp=="listMaintenanceDetails")
		{
			$operationsArray = $listMaintenanceDetails;
		}
		elseif($applodeOp=="getMaintenanceDetails")
		{
			$operationsArray = $getMaintenanceDetails;
		}
		elseif($applodeOp=="addBreakdown")
		{
			$operationsArray = $addBreakdown;
		}
		elseif($applodeOp=="getBreakdownDetails")
		{
			$operationsArray = $getBreakdownDetails;
		}
		elseif($applodeOp=="listBreakdowns")
		{
			$operationsArray = $listBreakdowns;
		}
		elseif($applodeOp=="addContract")
		{
			$operationsArray = $addContract;
		}
		elseif($applodeOp=="getContractDetails")
		{
			$operationsArray = $getContractDetails;
		}
		elseif($applodeOp=="listContracts")
		{
			$operationsArray = $listContracts;
		}
		elseif($applodeOp=="terminateContract")
		{
			$operationsArray = $terminateContract;
		}
		elseif($applodeOp=="addInspection")
		{
			$operationsArray = $addInspection;
		}
		elseif($applodeOp=="getInspectionDetails")
		{
			$operationsArray = $getInspectionDetails;
		}
		elseif($applodeOp=="listInspections")
		{
			$operationsArray = $listInspections;
		}
	}
}
?>