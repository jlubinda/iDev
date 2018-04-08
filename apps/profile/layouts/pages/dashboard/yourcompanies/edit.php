<?php
	if(chkSes()=="Active")
	{
		$user = userData();
	?>
    <div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">YOUR COMPANIES | EDIT</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<nav>
					<ul class="nav navbar-top-links navbar-right">
							<?php companiesNav();?>
					</ul>
				</nav>
			</div>
			<!-- /.col-lg-12 -->
		</div>
        <div class="row">
			<div class="col-lg-12">
				<?php
				if(getOrgUserLevel($_REQUEST["vCode"],$user["userID"])=="-1")
				{
					
		if($_REQUEST["submitBtn"]=="" || ($_REQUEST["submitBtn"]=="Edit" && ($_REQUEST["companyName"]=="" || $_REQUEST["shortname"]=="" || $_REQUEST["companyRegNumber"]=="" || $_REQUEST["TPIN"]=="" || $_REQUEST["Email"]=="" || $_REQUEST["Phone"]=="" || $_REQUEST["Address"]=="" || $_REQUEST["Postal"]=="")))
		{
		?>
		<div class="w3_login">
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="form">
					<form action="" method="post">
					 COMPANY NAME <input type="text" name="companyName" value="<?php echo getOrgName($_REQUEST["vCode"]);?>" required=" ">
					 SHORT NAME <input type="text" name="shortname" value="<?php echo getOrgShortName($_REQUEST["vCode"]);?>" required=" ">
					 REGISTRATION NUMBER <input type="text" name="companyRegNumber" value="<?php echo getOrgRegNumber($_REQUEST["vCode"]);?>" required=" ">
					 TAX NUMBER <input type="text" name="TPIN" value="<?php echo getOrgTaxNumber($_REQUEST["vCode"]);?>" required=" ">
					 EMAIL <input type="email" name="Email" value="<?php echo getOrgEmail($_REQUEST["vCode"]);?>" required=" ">
					 PHONE <input type="text" name="Phone" value="<?php echo getOrgphone($_REQUEST["vCode"]);?>" required=" ">
					 PHYSICAL ADDRESS <input type="text" name="Address" value="<?php echo getOrgPhysicalAddress($_REQUEST["vCode"]);?>" required=" ">
					 POSTAL ADDRESS <input type="text" name="Postal" value="<?php echo getOrgPostalAddress($_REQUEST["vCode"]);?>" required=" ">
					 TOWN <input type="text" name="town" value="<?php echo getOrgTown($_REQUEST["vCode"]);?>" required=" ">
					 PROVINCE <input type="text" name="province" value="<?php echo getOrgProvince($_REQUEST["vCode"]);?>" required=" ">
					 COUNTRY <input type="text" name="country" value="<?php echo getOrgCountry($_REQUEST["vCode"]);?>" required=" ">
					 <input type="submit" value="Edit" name="submitBtn">
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
		elseif($_REQUEST["submitBtn"]=="Edit" && ($_REQUEST["companyName"] && $_REQUEST["shortname"] && $_REQUEST["companyRegNumber"] && $_REQUEST["TPIN"] && $_REQUEST["Email"] && $_REQUEST["Phone"] && $_REQUEST["Address"] && $_REQUEST["Postal"]))
		{
			$createOrg = editOrgAccount($_REQUEST["vCode"],$_REQUEST["companyName"],$_REQUEST["shortname"],$_REQUEST["companyRegNumber"],$_REQUEST["TPIN"],$_REQUEST["Email"],$_REQUEST["Phone"],$_REQUEST["Address"],$_REQUEST["Postal"],$_REQUEST["town"],$_REQUEST["province"],$_REQUEST["country"]);
			
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
					echo "You do not have permission to access this component.";
				}
		?>
					</div>
				</div>
			</div>
		<?php
	}
	else
	{
		include find_file("login.php");
	}
?>