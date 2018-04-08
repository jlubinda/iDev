<?php
router(array("HEADER","profile"),"","",'','','file','');
	if(chkSes()=="Active")
	{
	$user = userData();
		
		//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'ProfilePic'=>$ProfilePic,'sex'=>$sex,'DOB'=>$DOB,
		//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		?>		
		<div class="banner">
					
			<!-- about -->
				<div class="w3l_banner_nav_right">
					<div class="agileits_team_grids">
						<?php 
							if($_POST["submitBtn"]=="SUBMIT")
							{
								//
								//checkAccount("LOGIN",$userAccount,$password="")
								if(checkAccount("LOGIN",$user["userID"],$_REQUEST["oldPassword"])==1)
								{
									if($_REQUEST["newPassword"]==$_REQUEST["newPassword2"])
									{
										if(resetPassword($user["userID"],$_REQUEST["newPassword"])==1)
										{
											echo '<div class="col-md-3 agileits_team_grid">SUCCESS! YOUR PASSWORD HASS BEEN CHANGED.</div>';
										}
										else
										{
											echo '<div class="col-md-3 agileits_team_grid">SORRY! PLEASE TRY AGAIN LATER.</div>';
										}
									}
									else
									{
										echo '<div class="col-md-3 agileits_team_grid">SORRY! YOUR NEW PASSWORD DOES NOT MATCH WITH THE REPEATED PASSWORD.</div>';
									}
								}
								else
								{
									echo '<div class="col-md-3 agileits_team_grid">SORRY! THE CURRENT PASSWORD YOUR HAVE PROVIDED IS WRONG. USE THE CORRECT ONE AND TRY AGAIN.</div>';
								}
							}
						?>
						<form action="" method="POST">
						<div class="col-md-3 agileits_team_grid">
							<h4>CURRENT PASSWORD</h4>
							<p><input name="oldPassword" placeholder="Your Current Password" type="password"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>NEW<br>PASSWORD</h4>
							<p><input name="newPassword" placeholder="New Password" type="password"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>REPEAT NEW PASSWORD</h4>
							<p><input name="newPassword2" placeholder="Repeat New Password" type="password"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>&nbsp;</h4>
							<p><input name="submitBtn" value="SUBMIT" type="submit" class="button"></p>
						</div>
						</form>
						<div class="clearfix"> </div>
					</div>
				</div>
			<!-- //about -->
					
				<div class="clearfix"></div>
		</div>
		<?php
	}
	else
	{
		include find_file("login.php");
	}
	router(array("FOOTER","profile"),"","",'','','file','');
?>