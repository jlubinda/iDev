<?php
	// API group
	$app->group('/recover', function () use ($app) {
		
		$app->group('/email', function () use ($app) {
			
			$app->get('/initiate/[{id}/index.php]', function ($request, $response, $args) {

				includeSessScripts();
				
				$_REQUEST["sess"] = "";

				function chkSes(){
					return "Inactive";
				}
				
				
				function SesVar(){
					return $_REQUEST["sess"];
				}
				
				if(iDevSite()=="localhost")
				{
					$server_url = "http://localhost/uagrosite/";
					$server_url2 = "http://localhost/uagrosite/";
				}
				else
				{
					$server_url = "https://uagro.co";
					$server_url2 = "https://uagro.co";
				}

			// array for JSON response
				$response = array();

				includeScripts();
				
				//script for username and password
				// if success
				$userID = userID($args["id"]);
				$userAccount = getMobile($userID);
				$userEmail = getEmail($userID);
				
				//echo json_encode($userAccount);
					
				if(checkAccount("CHECK",$userAccount)==1)
				{
					
					
				// EDIT THE 2 LINES BELOW AS REQUIRED
				$email_to = $userEmail;
				$email_subject = "Vehicle Portal Account Recovery";
				$email_from = "no-reply@vehicleportal.payitapp.co";
				$first_name = getUserData($userEmail,"FirstName"); // required
				$last_name = getUserData($userEmail,"LastName"); // required
				 
				$email_message = "Form details below.\n\n";
				 
				function clean_string($string) {
				  $bad = array("content-type","bcc:","to:","cc:","href");
				  return str_replace($bad,"",$string);
				}
				 
				$email_message .= "Hello ".clean_string($first_name).". <br>";
				$email_message .= "Thank you for using our online account recovery service. Please click the link below to create a new password for your account. <br>\n";
				
				$ddd = explode("@",$email_to);
				$domainX = $ddd[1];
				$dsss = explode(".",$domainX);
				$domainX1 = $ddd[0];
				
				//echo $domainX1;
				
				$RVCode = resetAccount($userEmail);
				
				$email_message .= "<a href='".$server_url2."/?ref=recover&RVCode=".$RVCode."'>Click here to create a new password.</a><br>\n";
				
				$email_message .= "Or input this code in to the input field provided: ".$RVCode."<br>\n";
				 
				 
			// create email headers

				$headers = "From: " . strip_tags($email_from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($email_from) . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				//echo $email_message."<br>";

				if($RVCode==0)
				{
					echo "ERROR. Please try again later.";
				}
				else
				{
					@mail($email_to, $email_subject, $email_message, $headers); 
					echo "PLEASE CHECK YOUR MAIL FOR YOUR RECOVER INSTRUCTIONS.";
				}
				
				 //////////////////////MAILER////////////////////////////////////////////
				 

					if($RVCode==0)
					{
						// echoing JSON response
						$response["success"] = 0;	
						// user node
						//$response["usercheck"] = "";
						$response["message"] = "Sorry. Your account cannot be rocovered at this moment. Please try again later.";
			 
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
						$response["message"] = "Success! The Verification Code/Link has been sent to your email. ".$RVCode;
			 
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
			
			

			$app->get('/finalize/[{vCode}/{password1}/{password2}/index.php]', function ($request, $response, $args) {

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
				$userID = getAccountFromRecoveryCode($args["vCode"]);
				$userAccount = getMobile($userID);
				
				//echo json_encode($userAccount);
					
				if(checkAccount("CHECK",$userAccount)==1)
				{
					$vCode = mobileRecovery($args["vCode"],$userAccount,$args["password1"],$args["password2"]);

					if(recoveryCodeStatus($userID,$args["vCode"])>=1 && (checkOpenRecoveryStatus($userID)>=1) && !(checkOpenRecoveryStatus($userID)=="ACCOUNT NOT FOUND") && !(checkOpenRecoveryStatus($userID)=="ERROR"))
					{
						if(trim($args["password1"]) == trim($args["password2"]))
						{
							if(closeRecovery($userID,$_REQUEST["RVCode"],$_POST["newpassword"])==1)
							{
								// echoing JSON response
								$response["success"] = 1;	
								// user node
								//$response["usercheck"] = "";
								$response["message"] = "Success! You have updated your password.";
					 
								//array_push($response["usercheck"], $login);
								
								echo json_encode($response);
							}
							else
							{
								// echoing JSON response
								$response["success"] = 0;	
								// user node
								//$response["usercheck"] = "";
								$response["message"] = "Sorry. Your account could not be recovered. Start the process again or contact support for help.";
					 
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
							$response["message"] = "Error! Your passwords do not match.";
				 
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
						$response["message"] = "Sorry. Your Recovery Link/Code is invalid. Start the process again or contact support for help.";
			 
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
		
		$app->group('/mobile', function () use ($app) {
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
						$response["message"] = "Sorry. Your account cannot be rocovered at this moment. Please try again later.";
			 
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
			
			

			$app->get('/verify/[{id}/{vCode}/index.php]', function ($request, $response, $args) {

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
					$vCode = verifyAccountVCode($args["vCode"],$userAccount);

					if($vCode==1)
					{
						// echoing JSON response
						$response["success"] = 1;	
						// user node
						//$response["usercheck"] = "";
						$response["message"] = "Your verification code is correct.";
			 
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
			
			

			$app->get('/finalize/[{id}/{vCode}/{password1}/{password2}/index.php]', function ($request, $response, $args) {

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
					$vCode = mobileRecovery($args["vCode"],$userAccount,$args["password1"],$args["password2"]);

					
					if($vCode==2)
					{
						// echoing JSON response
						$response["success"] = 0;	
						// user node
						//$response["usercheck"] = "";
						$response["message"] = "Sorry. Your password could not be updated. Please try again later.";
			 
						//array_push($response["usercheck"], $login);
						
						echo json_encode($response);
					}
					elseif($vCode==1)
					{
						// echoing JSON response
						$response["success"] = 1;	
						// user node
						//$response["usercheck"] = "";
						$response["message"] = "Success! You have updated your password.";
			 
						//array_push($response["usercheck"], $login);
						
						echo json_encode($response);
					}
					elseif($vCode==0)
					{
						// echoing JSON response
						$response["success"] = 0;	
						// user node
						//$response["usercheck"] = "";
						$response["message"] = "Sorry. The Verification Code you have provided is not correct. You can generate a new one after 15 minutes or contact the Uagro Support Team for help: support@uagro.co.";
			 
						//array_push($response["usercheck"], $login);
						
						echo json_encode($response);
					}
					elseif($vCode==-1)
					{
						// echoing JSON response
						$response["success"] = 0;	
						// user node
						//$response["usercheck"] = "";
						$response["message"] = "Your passwords do not match.Please try again with correct details.";
			 
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
	});
?>