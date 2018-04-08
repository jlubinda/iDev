<?php
	if(chkSes()=="Active")
	{
		$user = userData();
	?>
		  <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">YOUR COMPANIES | ABOUT</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" style="margin:15px;">
					<nav>
						<ul class="nav navbar-top-links navbar-right">
							<?php companiesNav();?>
						</ul>
					</nav>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
			  <!-- start course content -->
				<div class="col-lg-12 col-md-12 col-sm-12"><?php
				if(getOrgUserLevel($_REQUEST["vCode"],$user["userID"])=="-1")
				{
					
		if($_REQUEST["submitBtn"]=="")
		{
		?>
					<h2>Company Settings</h2>
					<form action="" method="post">
					 <label>ENABLE CASHLESS DISTRIBUTION <input type="radio" name="cashlessDistribution" value="<?php echo getOrgName($_REQUEST["vCode"]);?>" required=" "></label><br>
					 <label>DISABLE CASHLESS DISTRIBUTION <input type="radio" name="cashlessDistribution" value="<?php echo getOrgName($_REQUEST["vCode"]);?>" required=" "></label>
					  <br><input type="submit" value="SUBMIT" name="submitBtn">
					</form>
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
		elseif($_REQUEST["submitBtn"]=="SUBMIT")
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