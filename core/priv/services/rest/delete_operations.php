<?php
if(strtolower($applode)=="annime")
{
							
	$vehicles = array(
							"name"=>"vehicles",
							"description"=>"DELETE VEHICLE",
							"instructions"=>"Make sure you use a GET request when sending data on this API. The full URL to which you are to GET data is formated as follows: [|THIS_OPERATIONS_COMPLETE_URL|] where as {YOUR_LIVE_API_KEY} is your live API Key, {OUTPUT_FORMAT} is the output format you desire (either json or xml), {DATA_CENTRE} is the data centre you are using (either live or test; use test for all your tests and only use live when you go live on your app or website) and {ID} is either the Vehicle Registration Number, Chassis Number or Engine Number of the vehicle. Ensure the fields posted meet meet the mininimum specifications (do not leave required fields empty).Ensure that you specify either xml or json output format after the API version number in the URL to ensure you get the right output format.",
							"errorcodes"=>"0000:Vehicle successfully created|0001:Vehicle already exists for the provided Vehicle ID Number|0002:You have left some required fields empty|9997:Vehicle verification failed|9998:Vehicle addition failed|9999:Undefined error related to vehicle verification",
							"examples"=>"",
							"operation"=>"delete",
							"downloads"=>"",
							"inputfields"=>"",
							"processor"=>"deleteVehicle.php",
							"id1"=>"ABC1234",
							"id2"=>"123",
							"misc"=>""
							);
							
	if($applodeOp=="")
	{
		$operationsArray = array();
		$operationsArray[] = $vehicles;
	}
	else
	{
		if($applodeOp=="vehicles")
		{
			$operationsArray = $vehicles;
		}
	}
}
?>