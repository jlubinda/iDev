<?php
	if(chkSes()=="Active")
	{
		$user = userData();
	?>
		  <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">YOUR COMPANIES | STATUS</h3>
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
		<div class="w3_login">
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="form">
					<h2></h2>
					<form action="" method="post">
					</form>
				  </div>
				  <div class="form">
					<h2>Company Status</h2>
					<form action="" method="post">
					 <label>ACTIVE COMPANY <input type="radio" name="status" value="Active" required=" "></label><br>
					 <label>DEACTIVE COMPANY <input type="radio" name="status" value="Inactive" required=" "></label>
					  <br><input type="submit" value="SUBMIT" name="submitBtn">
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
		elseif($_REQUEST["submitBtn"]=="SUBMIT")
		{
			
			if($_REQUEST["status"]=="Active")
			{
				if(activateOrg($_REQUEST["vCode"])==1)
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
								<h2>COMPANY ACTIVATED!</h2>
							  </div>
							</div>
						</div>
					</div>
				<?php
				}
				else
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
								<h2>COMPANY NOT ACTIVATED!</h2>
							  </div>
							</div>
						</div>
					</div>
				<?php
				}
			}
			elseif($_REQUEST["status"]=="Inactive")
			{
				if(deactivateOrg($_REQUEST["vCode"])==1)
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
								<h2>COMPANY DEACTIVATED!</h2>
							  </div>
							</div>
						</div>
					</div>
				<?php
				}
				else
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
								<h2>COMPANY NOT DEACTIVATED!</h2>
							  </div>
							</div>
						</div>
					</div>
				<?php
				}
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