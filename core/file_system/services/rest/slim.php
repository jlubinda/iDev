<?php 

/*
$app->get('/accounts/NEWACCOUNT[/{fname}/{lname}/{gender}/{dob}/{houseNo}/{street}/{area}/{phoneNumber}/{emailAdd}/{nrcNumber}/{town}/{province}/{country}/{username}/{password}/index.php]', function ($request, @$response, $args) {
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
	@$response = array();
	 
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
			@$response["success"] = 1;
			@$response["message"] = "Account successfully created.";
	 
			// echoing JSON response
			echo json_encode(@$response);
		} 
		else 
		{
			// failed to insert row
			@$response["success"] = 0;
			@$response["message"] = "Oops! An error occurred.";
	 
			// echoing JSON response
			echo json_encode(@$response);
		}
	}

});


$app->get('/accounts/AUTHENTICATION[/{phoneNumber}/{password}/index.php]', function ($request, @$response, $args) {
 
    //$allPostVars = $app->request->post();
    //$data = $allPostVars['class'];
    //$data2 = $allPostVars['surname'];
	
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
	@$response = array();
	
		//script for username and password
		// if success
		$userAccount = trim($args["phoneNumber"]);
		$password = trim($args["password"]);
		$searchterm = md5(trim($args["password"]));
		
			//echo json_encode($userAccount);
			
			
		if(checkAccount("CHECK",$userAccount)==1)
		{

		//$login = array();
		
			$login = checkAccount("LOGIN",$userAccount,$password);
			
			if($login==0)
			{
				// echoing JSON response
				@$response["success"] = 0;	
				// user node
				@$response["usercheck"] = array();
				@$response["message"] = "Wrong Log In Details";
				@$response["vCode"] = "";
				@$response["sessStart"] = 0;
				@$response["sessMaxTime"] = 0;
				@$response["sessID"] = "";
				@$response["lockout"] = "";
	 
				array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
				
				
			}
			else
			{
				////////////////////////////////////////////////////////////////////////////////
					$Password = getUserData($userAccount,"PASSWORD");
					$LoginNames = getUserData($userAccount,"LoginName");
					$Email = getUserData($userAccount,"Email");
					$Mobile = getUserData($userAccount,"Mobile");
					
					$MaxStatus = getSessionData($userAccount,"STATUS","Logged On");
					$MaxTime = getSessionData($userAccount,"TIME","Logged On");
					$date_set = getSessionData($userAccount,"DATE","Logged On");
					$vCode = getSessionData($userAccount,"VCODE","Logged On");


					$MaxStatus2 = getSessionData($userAccount,"STATUS","Logged Out");
					$MaxTime2 = getSessionData($userAccount,"TIME","Logged Out");
					$date_set2 = getSessionData($userAccount,"DATE","Logged Out");
					
					//echo "Last Logged on at: ".$date_set."<br>";
					//echo "Last Logged Off at: ".$date_set2."<br>";

					if($MaxTime2>=$MaxTime)
					{
					$lockoutx="0";
					}
					else
					{
					$lockoutx="1";
					}

					$y = explode(" ", $date_set);
					@$datexx = trim($y[0]);

					$y = explode("-", $datexx);
					@$Yearxx = trim($y[0]);
					@$Monthxx = trim($y[1]);
					@$Dayxx = trim($y[2]);
					@$timexx = trim($y[1]);

					$TimeCheck = currentTimeInSeconds();

					$SessionDuration = getSessionSetting("DURATION");
					$multi_log = getSessionSetting("SESSION TYPE");

					$sessDurHour = $SessionDuration*60*60;
					
					//echo "Multilog".$multi_log."<br>";

					if($multi_log=="No")
					{
						 if(($lockoutx=="1")&&($sessDurHour<=$MaxTime))
						 {
						 $lockout="1";
						 $ccc = "";
						 $sessStart = 0;
								
								// echoing JSON response
								@$response["success"] = $sessStart;	
								// user node
								@$response["usercheck"] = "";
								@$response["message"] = "You currently have an active session. Please end it to login here.";
								@$response["vCode"] = $vCodex;
								@$response["sessStart"] = $sessStart;
								@$response["sessMaxTime"] = $MaxTimex;
								@$response["sessID"] = $ccc;
								@$response["lockout"] = $lockout;
					 
								//array_push(@$response["usercheck"], $login);
								
								echo json_encode(@$response);
								
						 }
						 else
						 {
						 $lockout="0";
						 
							if (($searchterm==$Password)&&($userAccount==$LoginNames || $userAccount==$Email || standadizesMobile($userAccount)==$Mobile))
							{
								$userAccountess = createSession($userAccount);
								
								if ($userAccountess==0)
								{
									$sessStart = 0;
									@$response["message"] = "Sorry! Session could not be started for you at this moment. Please try again later.";
									@$response["sessID"] = "";
								}
								else
								{
								$name = $level;
								$sestrue = 7;
								$sessStart = 1;
								@$response["message"] = "Success!";
								
								$ccc = $userAccountess['ccc'];
								$MaxTimex = $userAccountess['time'];
								$vCodex = $userAccountess['vCode'];
								@$response["sessID"] = "sess".$ccc;
								
								
								//set session cookie
								//$_SESSION[SesUID()] = $ccc;
							
								//$sql21 = "INSERT INTO system_log (id,PageID,userID) VALUES ('','Login','".$userID."');";
								//@$res21 = mysqli_query($db,$sql21);
								}
								
								// echoing JSON response
								@$response["success"] = $sessStart;	
								// user node
								@$response["usercheck"] = array();
								
								@$response["vCode"] = $vCodex;
								@$response["sessStart"] = $sessStart;
								@$response["sessMaxTime"] = $MaxTimex;
								@$response["lockout"] = $lockout;
					 
								array_push(@$response["usercheck"], $login);
								
								echo json_encode(@$response);
							}
							else
							{
								$ccc = "";
								$sessStart = "-1";
								$MaxTimex = 0;
								$vCodex = "";
								
								// echoing JSON response
								@$response["success"] = $sessStart;	
								// user node
								@$response["usercheck"] = array();
								@$response["message"] = "Sorry! Session could not be started for you at this moment. Please try again later.";
								@$response["vCode"] = $vCodex;
								@$response["sessStart"] = $sessStart;
								@$response["sessMaxTime"] = $MaxTimex;
								@$response["sessID"] = $ccc;
								@$response["lockout"] = $lockout;
					 
								array_push(@$response["usercheck"], $login);
								
								echo json_encode(@$response);
							}
							
						 }
					 
					}
					else
					{
						 $lockout="0";
						 
							if (($searchterm==$Password)&&($userAccount==$LoginNames || $userAccount==$Email || standadizesMobile($userAccount)==$Mobile))
							{
								$userAccountess = createSession($userAccount);
								
								if ($userAccountess==0)
								{
									$sessStart = 0;
									@$response["message"] = "Sorry! Session could not be started for you at this moment. Please try again later.";
									@$response["sessID"] = "";
								}
								else
								{
								$name = $level;
								$sestrue = 7;
								$sessStart = 1;
								@$response["message"] = "Success!";
								
								$ccc = $userAccountess['ccc'];
								$MaxTimex = $userAccountess['time'];
								$vCodex = $userAccountess['vCode'];
								@$response["sessID"] = "sess".$ccc;
								
								//set session cookie
								//$_SESSION[SesUID()] = $ccc;
								}
								
								// echoing JSON response
								@$response["success"] = $sessStart;	
								// user node
								@$response["usercheck"] = array();
								
								@$response["vCode"] = $vCodex;
								@$response["sessStart"] = $sessStart;
								@$response["sessMaxTime"] = $MaxTimex;
								@$response["lockout"] = $lockout;
					 
								array_push(@$response["usercheck"], $login);
								
								echo json_encode(@$response);
							}
							else
							{
								$ccc = "";
								$sessStart = "-1";
								$MaxTimex = 0;
								$vCodex = "";
								
								// echoing JSON response
								@$response["success"] = 0;	
								// user node
								@$response["usercheck"] = array();
								@$response["message"] = "Sorry! Session could not be started for you at this moment. Please try again later.";
								@$response["vCode"] = $vCodex;
								@$response["sessStart"] = $sessStart;
								@$response["sessMaxTime"] = $MaxTimex;
								@$response["sessID"] = $ccc;
								@$response["lockout"] = $lockout;
					 
								array_push(@$response["usercheck"], $login);
								
								echo json_encode(@$response);
							}
					}
				}
				////////////////////////////////////////////////////////////////////////////////
				
			}

});


$app->get('/accounts/VERIFICATION/sess[{name}/{password}/index.php]', function ($request, @$response, $args) {

	includeSessScripts();
	
	if(verifySession($args['name'])==1)
	{
		$_REQUEST["sess"] = $args['name'];

		function chkSes(){
			return "Active";
		} 
	}
	else
	{
		$_REQUEST["sess"] = "";

		function chkSes(){
			return "Inactive";
		} 
	}
	
	
	function SesVar(){
		return $_REQUEST["sess"];
	}

	includeScripts();
	

// array for JSON response
	@$response = array();
	
		//script for username and password
		// if success
		$userID = userIDFromSessID(SesVar());
		$userAccount = getMobile($userID);
		$password = trim($args["password"]);
		$searchterm = md5(trim($args["password"]));
		
			//echo json_encode($userAccount);
			
			
		if(checkAccount("CHECK",$userAccount)==1)
		{
		
			$login = checkAccount("LOGIN",$userAccount,$password);
			
			if($login==0)
			{

				// echoing JSON response
				@$response["success"] = 0;	
				// user node
				//@$response["usercheck"] = "";
				@$response["message"] = "Wrong Log In Details";
	 
				//array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
				
			}
			else
			{

				// echoing JSON response
				@$response["success"] = 1;	
				// user node
				//@$response["usercheck"] = array();
				@$response["message"] = "Success!";
				
	 
				//array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
			}
				
		}
		else
		{
			// echoing JSON response
			@$response["success"] = 0;	
			// user node
			//@$response["usercheck"] = "";
			@$response["message"] = "Sorry! Account not found.";
 
			//array_push(@$response["usercheck"], $login);
			
			echo json_encode(@$response);
		}

});

*/
?>