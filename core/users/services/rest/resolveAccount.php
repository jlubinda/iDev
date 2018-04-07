<?php
	// API group
	$app->group('/resolve', function () use ($app) {

		$app->get('/initiate/[{id}/index.php]', function ($request, $response, $args) {

			includeSessScripts();
			
			$_REQUEST["sess"] = "";

			function chkSes(){
				return "Inactive";
			}
			
			
			function SesVar(){
				return $_REQUEST["sess"];
			}
			

		// array for JSON response
			$response = array();

			includeScripts();
			
			//script for username and password
			// if success
			$userID = userID($args["id"]);
			$userAccount = getMobile($userID);
			
			//echo json_encode($userAccount);
				
			if(checkAccount("CHECK",$userAccount)==1)
			{
				$vCode = genAccountVCode($userAccount);

				if($vCode==0)
				{
					// echoing JSON response
					$response["success"] = 0;	
					// user node
					//$response["usercheck"] = "";
					$response["message"] = "Sorry. Your previous session can not be ended at this moment. Please try again later.";
		 
					//array_push($response["usercheck"], $login);
					
					echo json_encode($response);
				}
				elseif($vCode=="-1")
				{
					// echoing JSON response
					$response["success"] = 0;	
					// user node
					//$response["usercheck"] = "";
					$response["message"] = "Sorry. You have already generated a Verification Code. You can generate a new one after 15 minutes or you can contact the UAgro Support Team for help: support@uagro.co";
		 
					//array_push($response["usercheck"], $login);
					
					echo json_encode($response);
				}
				else
				{
					//sendVCode($_POST["Mobile"],$vCode);
					
					// echoing JSON response
					$response["success"] = 1;	
					// user node
					//$response["usercheck"] = "";
					$response["message"] = "Success! The Verification Code has been sent to your mobile phone. ".$vCode;
		 
					//array_push($response["usercheck"], $login);
					
					echo json_encode($response);
				}
			}
			else
			{
				// echoing JSON response
				$response["success"] = 0;	
				// user node
				//$response["usercheck"] = "";
				$response["message"] = "Sorry! Account not found.";
	 
				//array_push($response["usercheck"], $login);
				
				echo json_encode($response);
			}
		});
		
		
		

		$app->get('/finalize/[{id}/{vCode}/index.php]', function ($request, $response, $args) {

			includeSessScripts();
			
			$_REQUEST["sess"] = "";

			function chkSes(){
				return "Inactive";
			}
			
			
			function SesVar(){
				return $_REQUEST["sess"];
			}
			

		// array for JSON response
			$response = array();

			includeScripts();
			
			//script for username and password
			// if success
			$userID = userID($args["id"]);
			$userAccount = getMobile($userID);
			
			//echo json_encode($userAccount);
				
			if(checkAccount("CHECK",$userAccount)==1)
			{
				$vCode = endActiveSession($args["vCode"],$userAccount);

				if($vCode==1)
				{
					// echoing JSON response
					$response["success"] = 1;	
					// user node
					//$response["usercheck"] = "";
					$response["message"] = "Success! Your previous session has been ended for you.";
		 
					//array_push($response["usercheck"], $login);
					
					echo json_encode($response);
				}
				else
				{
					// echoing JSON response
					$response["success"] = 0;	
					// user node
					//$response["usercheck"] = "";
					$response["message"] = "Sorry. The Verification Code you have provided is not correct. You can generate a new one after 15 minutes or contact the Uagro Support Team for help: support@uagro.co.";
		 
					//array_push($response["usercheck"], $login);
					
					echo json_encode($response);
				}
			}
			else
			{
				// echoing JSON response
				$response["success"] = 0;	
				// user node
				//$response["usercheck"] = "";
				$response["message"] = "Sorry! Account not found.";
	 
				//array_push($response["usercheck"], $login);
				
				echo json_encode($response);
			}
		});
	});
?>