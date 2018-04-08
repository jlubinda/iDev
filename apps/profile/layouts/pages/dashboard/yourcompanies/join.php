<?php
	if(chkSes()=="Active")
	{
		$user = userData();
	
		if($_REQUEST["submitBtn"]=="" || ($_REQUEST["submitBtn"]=="Register" && ($_REQUEST["companyName"]=="" || $_REQUEST["shortname"]=="" || $_REQUEST["companyRegNumber"]=="" || $_REQUEST["TPIN"]=="" || $_REQUEST["Email"]=="" || $_REQUEST["Phone"]=="" || $_REQUEST["Address"]=="" || $_REQUEST["Postal"]=="")))
		{
		?>
		<div class="w3_login">
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="form">
					<h2></h2>
					<form action="" method="post">
					</form>
				  </div>
				  <div class="form">
					<h2>Add Company</h2>
					<form action="" method="post">
					  <input type="text" name="companyName" placeholder="Full Company Name" required=" ">
					  <input type="text" name="shortname" placeholder="Short Name" required=" ">
					  <input type="text" name="companyRegNumber" placeholder="Company Reg. Number" required=" ">
					  <input type="text" name="TPIN" placeholder="Tax Payer ID Number" required=" ">
					  <input type="email" name="Email" placeholder="Email Address" required=" ">
					  <input type="text" name="Phone" placeholder="Phone Number" required=" ">
					  <input type="text" name="Address" placeholder="Registered Physical Address" required=" ">
					  <input type="text" name="Postal" placeholder="Postal Address" required=" ">
					  <input type="submit" value="Register" name="submitBtn">
					</form>
				  </div>
				</div>
			</div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
		<?php
			
		}
		elseif($_REQUEST["submitBtn"]=="Register" && ($_REQUEST["companyName"] && $_REQUEST["shortname"] && $_REQUEST["companyRegNumber"] && $_REQUEST["TPIN"] && $_REQUEST["Email"] && $_REQUEST["Phone"] && $_REQUEST["Address"] && $_REQUEST["Postal"]))
		{
			$createOrg = createOrgAccount($user["userID"],$_REQUEST["companyName"],$_REQUEST["shortname"],$_REQUEST["companyRegNumber"],$_REQUEST["TPIN"],$_REQUEST["Email"],$_REQUEST["Phone"],$_REQUEST["Address"],$_REQUEST["Postal"]);
			
			if($createOrg==1)
			{
			?>
			<div class="w3_login">
				<div class="w3_login_module">
					<div class="module form-module">
					  <div class="form">
						<h2></h2>
						<form action="" method="post">
						</form>
					  </div>
					  <div class="form">
						<h2>SUCCESS!</h2>
					  </div>
					</div>
				</div>
			</div>
			<?php
			}
			elseif($createOrg==2)
			{
			?>
			<div class="w3_login">
				<div class="w3_login_module">
					<div class="module form-module">
					  <div class="form">
						<h2></h2>
						<form action="" method="post">
						</form>
					  </div>
					  <div class="form">
						<h2>AN ORGANIZATION WITH THESE DETAILS IS ALREADY REGISTERED!</h2>
					  </div>
					</div>
				</div>
			</div>
			<?php
			}
			elseif($createOrg=="0")
			{
			?>
			<div class="w3_login">
				<div class="w3_login_module">
					<div class="module form-module">
					  <div class="form">
						<h2></h2>
						<form action="" method="post">
						</form>
					  </div>
					  <div class="form">
						<h2>ERROR!</h2>
					  </div>
					</div>
				</div>
			</div>
			<?php
			}
		}
	}
	else
	{
		include find_file("login.php");
	}
?>