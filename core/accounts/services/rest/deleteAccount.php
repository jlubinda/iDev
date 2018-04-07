<?php

	$app->delete('/delete/sess[{name}/{id}/index.php]', function ($request, @$response, $args) {

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
		

	// array for JSON response
		@$response = array();

		if(chkSes()=="Active")
		{
		includeScripts();
		
			//script for username and password
			// if success
			$userID = userID($args['id']);
			$userAccount = getMobile($userID);
			$password = trim($args["password"]);
			$searchterm = md5(trim($args["password"]));
			
				//echo json_encode($userAccount);
				
				
			if(checkAccount("CHECK",$userAccount)==1)
			{
			
				$login = deactivateUserAccount($userAccount);
				
				if($login==0)
				{

					// echoing JSON response
					@$response["success"] = 0;	
					// user node
					//@$response["usercheck"] = "";
					@$response["message"] = "Sorry. Account could not be deactivated.";
		 
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
		}
		else
		{
			// echoing JSON response
			@$response["success"] = 0;	
			// user node
			//@$response["usercheck"] = "";
			@$response["message"] = "You must be logged in to access this.";
 
			//array_push(@$response["usercheck"], $login);
			
			echo json_encode(@$response);
		}
	});
?>