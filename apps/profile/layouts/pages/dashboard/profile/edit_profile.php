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
								if(editUserAccount($user["Mobile"],$_REQUEST["FirstName"],$_REQUEST["LastName"],$_REQUEST["country"],$_REQUEST["sex"],$_REQUEST["DOB"],$_REQUEST["houseNo"],$_REQUEST["street"],$_REQUEST["area"],$_REQUEST["nrcNumber"],$_REQUEST["town"])==1)
								{
									echo '<div class="col-md-3 agileits_team_grid">SUCCESS! YOU HAVE UPDATED YOUR DETAILS.</div>';
								}
								else
								{
									echo '<div class="col-md-3 agileits_team_grid">SORRY! PLEASE TRY AGAIN LATER.</div>';
								}
							}
						?>
						<form action="" method="POST">
						<div class="col-md-3 agileits_team_grid">
							<h4>FIRST NAME</h4>
							<p><input name="FirstName" value="<?php echo $user["FirstName"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>LAST NAME</h4>
							<p><input name="LastName" value="<?php echo $user["LastName"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>GENDER</h4>
							<p><select name="sex"><option value="<?php echo $user["sex"];?>"><?php echo $user["sex"];?></option><option value="Male">Male</option><option value="Female">Female</option></select></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>DATE OF BIRTH</h4>
							<p><input name="DOB" value="<?php echo $user["DOB"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>NRC/ID</h4>
							<p><input name="nrcNumber" value="<?php echo $user["nrcNumber"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>HOUSE No.</h4>
							<p><input name="houseNo" value="<?php echo $user["houseNo"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>STREET</h4>
							<p><input name="street" value="<?php echo $user["street"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>AREA</h4>
							<p><input name="area" value="<?php echo $user["area"];?>" type="text"></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>TOWN</h4>
							<p><select name="town"><option value="<?php echo $user["town"];?>"><?php echo $user["town"];?></option><option value="Lusaka">Lusaka</option><option value="Chongwe">Chongwe</option><option value="Kafue">Kafue</option><option value="Chibombo">Chibombo</option><option value="Chisamba">Chisamba</option><option value="Kabwe">Kabwe</option><option value="Kapiri">Kapiri</option><option value="Mkushi">Mkushi</option><option value="Mumbwa">Mumbwa</option></select></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>COUNTRY</h4>
							<p><select name="country"><option value="<?php echo $user["country"];?>"><?php echo $user["country"];?></option><option value="Zambia">Zambia</option></select></p>
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