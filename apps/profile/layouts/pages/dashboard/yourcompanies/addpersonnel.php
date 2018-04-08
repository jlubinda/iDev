<?php
	if(chkSes()=="Active")
	{
		$user = userData();
	?>
		  <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">YOUR COMPANIES | ADD PERSONNEL</h3>
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
						<form action="" method="post">
						</form>
					  </div>
					 <?php 
						$orgID = orgID($_REQUEST["vCode"]);
						$orgArray = orgData($orgID);
						$org_country = $orgArray["country"];
					?>
					  <div class="form">
						<form action="" method="post">
						 <label>First Name <input type="text" size="31" name="FirstName" required=" "></label><br>
						 <label>Last Name <input type="text" size="31" name="LastName" required=" "></label><br>
						 <label>NRC/Passport # <input type="text" size="31" name="NRC" required=" "></label><br>
						 <label>Mobile #<input type="text" size="31" name="Mobile" required=" " placeholder="+260 9XX XXXXXX"></label><br>
						 <label>Work Phone <input type="text" size="31" name="WorkPhone" required=" " placeholder="+260 XXX XXXXXX"></label><br>
						 <label>Work Email <input type="email" size="31" name="WorkEmail" required=" "></label><br>
						 <label>MALE <input type="radio" value="M" name="sex" required=" "></label> &nbsp;&nbsp;&nbsp;<label>FEMALE <input type="radio" value="F" name="sex" required=" "></label><br><br>
						 <label>House # <input type="text" size="31" name="HouseNo" required=" "></label><br>
						 <label>Street <input type="text" size="31" name="Street" required=" "></label><br>
						 <label>Area <input type="text" size="31" name="Area" required=" "></label><br>
						 <label>Town <input type="text" size="31" value="<?php echo $orgArray["town"];?>" name="Town" required=" "></label><br>
						 <label>Country <input type="text" size="31" value="<?php echo $org_country;?>" name="Country" required=" " readonly></label><br>
						 <label>User Level 
							 <select name="userLevel" required=" ">
								<option value="6">Principle</option>
								<option value="5">Head of Administration</option>
								<option value="4">Lecturer</option>
								<option value="3">Accountant</option>
								<option value="2">Administrative Officer</option>
								<option value="1">Student</option>
								<option value="-2">Administrator</option>
								<option value="-1">Super User</option>
							 </select>
						 </label><br>
						  <br><input type="submit" value="SUBMIT" name="submitBtn">
						</form>
					  </div>
					</div>
				</div>
			</div>
			<?php
				
			}
			elseif($_REQUEST["submitBtn"]=="SUBMIT")
			{
				$Password = genPassword(6,12);
				$Address = $_REQUEST["HouseNo"]." ".$_REQUEST["Street"].", ".$_REQUEST["Area"].", ".$_REQUEST["Town"]." - ".$_REQUEST["Country"];
						
				if(checkUserAccountStatus($_REQUEST["WorkEmail"])==1 && checkUserAccountStatus($_REQUEST["Mobile"])==1)
				{
					$userID = userID($_REQUEST["WorkEmail"]);
					
					$update = editUserAccount($userID,$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Country"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],$_REQUEST["NRC"],$_REQUEST["Town"],"live");
					
					if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["Mobile"]),$_REQUEST["userLevel"]))
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
									<h2>ERROR!</h2>
								  </div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				elseif(checkUserAccountStatus($_REQUEST["WorkEmail"])==1 && checkUserAccountStatus($_REQUEST["Mobile"])==0)
				{
					$userID = userID($_REQUEST["WorkEmail"]);
					
					$update = editUserAccount($userID,$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Country"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],$_REQUEST["NRC"],$_REQUEST["Town"],"live");
					
					if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["Mobile"]),$_REQUEST["userLevel"]))
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
									<h2>ERROR!</h2>
								  </div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				elseif(checkUserAccountStatus($_REQUEST["WorkEmail"])==0 && checkUserAccountStatus($_REQUEST["Mobile"])==1)
				{
					$userID = userID($_REQUEST["WorkEmail"]);
					
					$update = editUserAccount($userID,$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Country"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],$_REQUEST["NRC"],$_REQUEST["Town"],"live");
					
					if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["Mobile"]),$_REQUEST["userLevel"]))
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
									<h2>ERROR!</h2>
								  </div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				elseif(checkUserAccountStatus($_REQUEST["WorkEmail"])==0 && checkUserAccountStatus($_REQUEST["Mobile"])==0)
				{
					if(checkAccountWorkEmailUsed($_REQUEST["WorkEmail"])==1 && checkAccountMobileUsed($_REQUEST["Mobile"])==1)
					{
						$userID = userID($_REQUEST["WorkEmail"]);
						
						$update = editUserAccount($userID,$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Country"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],$_REQUEST["NRC"],$_REQUEST["Town"],"live");
						
						
						if(activateUserAccount($_REQUEST["WorkEmail"])==1)
						{
							resetPassword(userID($_REQUEST["Mobile"]),$Password);
							$message = "Hello ".$_REQUEST["FirstName"]."<br><br>";
							$message .= "Welcome to Zuha Learn! Your account information has been updated for you:<br>";
							$message .= "<b>USERNAME:</b> ".$_REQUEST['WorkEmail'];
							$message .= "<b>PASSWORD:</b> ".$Password."<br><br>";
							$message .= "<a href='http://zuha.applodes.com/?ref=login' target='_new'>Click here to login</a> Or go to http://zuha.applodes.com/?ref=login<br><br>";
							$message .= "Provide your email address as the username and the assigned password. Go to your profile page and change your password to something you can easily remember.<br><br>";
							$message .= "Once again, welcome to the family. We look forward working with you. <br><br>";
							$message .= "Warm regards,<br><br>";
							$message .= "Joseph Lubinda<br>";
							$message .= "CEO";
							
							email("WELCOME TO UAGRO",$message,"info@uagro.applodes.com",$_REQUEST['WorkEmail']);
							
					
							if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["WorkEmail"]),$_REQUEST["userLevel"]))
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
											<h2>ERROR!</h2>
										  </div>
										</div>
									</div>
								</div>
								<?php
							}
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
										<h2>ERROR!</h2>
									  </div>
									</div>
								</div>
							</div>
							<?php
						}
					}
					elseif(checkAccountWorkEmailUsed($_REQUEST["WorkEmail"])==1 && checkAccountMobileUsed($_REQUEST["Mobile"])==0)
					{
						$userID = userID($_REQUEST["WorkEmail"]);
						
						$update = editUserAccount($userID,$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Country"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],$_REQUEST["NRC"],$_REQUEST["Town"],"live");
						
						
						if(activateUserAccount($_REQUEST["WorkEmail"])==1)
						{
							resetPassword($userID,$Password);
							$message = "Hello ".$_REQUEST["FirstName"]."<br><br>";
							$message .= "Welcome to Zuha Learn! Your account information has been updated for you:<br>";
							$message .= "<b>USERNAME:</b> ".$_REQUEST['WorkEmail'];
							$message .= "<b>PASSWORD:</b> ".$Password."<br><br>";
							$message .= "<a href='http://zuha.applodes.com/?ref=login' target='_new'>Click here to login</a> Or go to http://zuha.applodes.com/?ref=login<br><br>";
							$message .= "Provide your email address as the username and the assigned password. Go to your profile page and change your password to something you can easily remember.<br><br>";
							$message .= "Once again, welcome to the family. We look forward working with you. <br><br>";
							$message .= "Warm regards,<br><br>";
							$message .= "Joseph Lubinda<br>";
							$message .= "CEO";
							
							email("WELCOME TO ZUHA-LEARN",$message,"info@zuha.applodes.com",$_REQUEST['WorkEmail']);
													
							if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["WorkEmail"]),$_REQUEST["userLevel"]))
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
											<h2>ERROR!</h2>
										  </div>
										</div>
									</div>
								</div>
								<?php
							}
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
										<h2>ERROR!</h2>
									  </div>
									</div>
								</div>
							</div>
							<?php
						}
					}
					elseif(checkAccountEmailUsed(userID($_REQUEST["Mobile"]),"live")==0 && checkAccountMobileUsed(userID($_REQUEST["Mobile"]),"live")==1)
					{
						$userID = userID($_REQUEST["Mobile"]);
						
						$update = editUserAccount($userID,$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Country"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],$_REQUEST["NRC"],$_REQUEST["Town"],"live");
						
						if(activateUserAccount($_REQUEST["Mobile"])==1)
						{
							resetPassword($userID,$Password);
							$message = "Hello ".$_REQUEST["FirstName"]."<br><br>";
							$message .= "Welcome to Zuha Learn! Your account information has been updated for you:<br>";
							$message .= "<b>USERNAME:</b> ".$_REQUEST['WorkEmail'];
							$message .= "<b>PASSWORD:</b> ".$Password."<br><br>";
							$message .= "<a href='http://zuha.applodes.com/?ref=login' target='_new'>Click here to login</a> Or go to http://zuha.applodes.com/?ref=login<br><br>";
							$message .= "Provide your email address as the username and the assigned password. Go to your profile page and change your password to something you can easily remember.<br><br>";
							$message .= "Once again, welcome to the family. We look forward working with you. <br><br>";
							$message .= "Warm regards,<br><br>";
							$message .= "Joseph Lubinda<br>";
							$message .= "CEO";
							
							email("WELCOME TO ZUHA-LEARN",$message,"info@zuha.applodes.com",$_REQUEST['WorkEmail']);
							
													
							if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["WorkEmail"]),$_REQUEST["userLevel"]))
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
											<h2>ERROR!</h2>
										  </div>
										</div>
									</div>
								</div>
								<?php
							}
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
										<h2>ERROR!</h2>
									  </div>
									</div>
								</div>
							</div>
							<?php
						}
					}
					elseif(checkAccountEmailUsed($_REQUEST["WorkEmail"])==0 && checkAccountMobileUsed($_REQUEST["Mobile"])==0)
					{
						$createUserAccount = createUserAccount($_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["Mobile"],$_REQUEST["FirstName"],$_REQUEST["Mobile"],$_REQUEST["email"],$Password,$_REQUEST["Country"],"User","","","1","0",$Address,"","",$_REQUEST["WorkPhone"],$_REQUEST["sex"],"",$_REQUEST["HouseNo"],$_REQUEST["Street"],$_REQUEST["Area"],"",$_REQUEST["Town"],"",$_REQUEST["WorkEmail"]);
						if($createUserAccount==1)
						{
							$message = "Hello ".$_REQUEST["FirstName"]."<br><br>";
							$message .= "Welcome to Zuha Learn! Your account information has been updated for you:<br>";
							$message .= "<b>USERNAME:</b> ".$_REQUEST['WorkEmail'];
							$message .= "<b>PASSWORD:</b> ".$Password."<br><br>";
							$message .= "<a href='http://zuha.applodes.com/?ref=login' target='_new'>Click here to login</a> Or go to http://zuha.applodes.com/?ref=login<br><br>";
							$message .= "Provide your email address as the username and the assigned password. Go to your profile page and change your password to something you can easily remember.<br><br>";
							$message .= "Once again, welcome to the family. We look forward working with you. <br><br>";
							$message .= "Warm regards,<br><br>";
							$message .= "Joseph Lubinda<br>";
							$message .= "CEO";
							
							email("WELCOME TO UAGRO",$message,"info@uagro.applodes.com",$_REQUEST['WorkEmail']);
													
							if(addUserToOrg($_REQUEST["vCode"],userID($_REQUEST["WorkEmail"]),$_REQUEST["userLevel"]))
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
											<h2>ERROR!</h2>
										  </div>
										</div>
									</div>
								</div>
								<?php
							}
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
										<h2>ERROR!</h2>
									  </div>
									</div>
								</div>
							</div>
							<?php
						}
					}
				}
				
			}
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
						<h2>SORRY! YOU DO NOT HAVE PERMISSION TO ACCESS THIS FEATURE.</h2>
					  </div>
					</div>
				</div>
			</div>
			<?php
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