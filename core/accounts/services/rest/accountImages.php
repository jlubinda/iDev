<?php
	// API group
	$app->group('/images', function () use ($app) {

		$app->get('/profile/[{id}/index.php]', function ($request, @$response, $args) {

			includeSessScripts();
			
			$_REQUEST["sess"] = "";

			function chkSes(){
				return "Inactive";
			}
			
			
			function SesVar(){
				return $_REQUEST["sess"];
			}
			

		// array for JSON response
			@$response = array();

			includeScripts();
			
			//script for username and password
			// if success
			$userID = userID($args["id"]);
			$userAccount = getMobile($userID);
			
			//echo json_encode($userAccount);
				
			if(checkAccount("CHECK",$userAccount)==1)
			{
				// echoing JSON response
				@$response["success"] = 0;
				@$response["siteurl"] = iDevSite();
				@$response["folder"] = "profilepics";
				@$response["image"] = getProfilePicture($userID);
				if(getProfilePicture($userID)=="placeholder.png")
				{
					@$response["thumbnail"] = getProfilePicture($userID);
				}
				else
				{
					@$response["thumbnail"] = "thumb_".getProfilePicture($userID);
				}
					
				// user node
				//@$response["usercheck"] = "";
				@$response["message"] = "Success.";
	 
				//array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
			}
			else
			{
				// echoing JSON response
				@$response["success"] = 0;
				@$response["siteurl"] = "";
				@$response["folder"] = "";
				@$response["image"] = "";
				@$response["thumbnail"] = "";	
				// user node
				//@$response["usercheck"] = "";
				@$response["message"] = "Sorry! Account not found.";
	 
				//array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
			}
		});
		
		
		

		$app->get('/cover/[{id}/index.php]', function ($request, @$response, $args) {

			includeSessScripts();
			
			$_REQUEST["sess"] = "";

			function chkSes(){
				return "Inactive";
			}
			
			
			function SesVar(){
				return $_REQUEST["sess"];
			}
			

		// array for JSON response
			@$response = array();

			includeScripts();
			
			//script for username and password
			// if success
			$userID = userID($args["id"]);
			$userAccount = getMobile($userID);
			
			//echo json_encode($userAccount);
				
			if(checkAccount("CHECK",$userAccount)==1)
			{
				// echoing JSON response
				@$response["success"] = 0;
				@$response["siteurl"] = iDevSite();
				@$response["folder"] = "images";
				@$response["image"] = getCoverImage($userID);
				@$response["thumbnail"] = getCoverImage($userID);
					
				// user node
				//@$response["usercheck"] = "";
				@$response["message"] = "Success.";
				//array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
			}
			else
			{
				// echoing JSON response
				@$response["success"] = 0;
				@$response["siteurl"] = iDevSite();
				@$response["image"] = "";
				@$response["thumbnail"] = "";	
				// user node
				//@$response["usercheck"] = "";
				@$response["message"] = "Sorry! Account not found.";
	 
				//array_push(@$response["usercheck"], $login);
				
				echo json_encode(@$response);
			}
		});
	});
?>