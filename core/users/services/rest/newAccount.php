<?php 
	
	$app->post('/new/index.php', function ($request, $response, $args) {
			$fname = trim($args['fname']);
			$lname = trim($args['lname']);
			$gender = trim($args['gender']);
			$dob = trim($args['dob']);
			$houseNo = trim($args['houseNo']);
			$street = trim($args['street']);
			$area = trim($args['area']);
			$phoneNumber = trim($args['phoneNumber']);
			$emailAdd = trim($args['emailAdd']);
			$nrcNumber = trim($args['nrcNumber']);
			$town = trim($args['town']);
			$province = trim($args['province']);
			$country = trim($args['country']);
			$username = trim($args['username']);
			$password = trim($args['password']);
			
		//$args = $app->request->post();
		//$data = $args['class'];
		//$data2 = $args['surname'];
		
		//$app->response->setStatus(200);
		//$app->response()->headers->set('Content-Type', 'application/json');
		
		//echo json_encode(array("status" => "success", "code" => 1, "data" => $data, "data2" => $data2));
		
			function chkSes(){
				return "Inactive";
			} 
		
		
		function SesVar(){
			return $_REQUEST["sess"];
		}

		includeScripts();
		
		// array for JSON response
		$response = array();
		 
		// check that the fields that are required are available
		if (isset($args['fname']) && isset($args['lname']) && isset($args['gender']) && isset($args['dob']) && isset($args['houseNo']) && isset($args['street'])&& isset($args['area']) && isset($args['phoneNumber']) && isset($args['emailAdd']) && isset($args['nrcNumber'])&& isset($args['town']) && isset($args['province']) && isset($args['country']) && isset($args['username']) && isset($args['password'])) 
		{
		 
			$fname = trim($args['fname']);
			$lname = trim($args['lname']);
			$gender = trim($args['gender']);
			$dob = trim($args['dob']);
			$houseNo = trim($args['houseNo']);
			$street = trim($args['street']);
			$area = trim($args['area']);
			$phoneNumber = trim($args['phoneNumber']);
			$emailAdd = trim($args['emailAdd']);
			$nrcNumber = trim($args['nrcNumber']);
			$town = trim($args['town']);
			$province = trim($args['province']);
			$country = trim($args['country']);
			$username = trim($args['username']);
			$password = trim($args['password']);
			
			
			
			if(createUserAccount($fname,$lname,$phoneNumber,$fname,$phoneNumber,$emailAdd,$password,$country,"","","","1","0","","","",$phoneNumber,$gender,$dob,$houseNo,$street,$area,$nrcNumber,$town,$province)==1)
			{
				// successfully inserted into database
				$response["success"] = 1;
				$response["message"] = "Account successfully created.";
		 
				// echoing JSON response
				echo json_encode($response);
			} 
			else 
			{
				// failed to insert row
				$response["success"] = 0;
				$response["message"] = "Oops! An error occurred.";
		 
				// echoing JSON response
				echo json_encode($response);
			}
		}

	});
?>