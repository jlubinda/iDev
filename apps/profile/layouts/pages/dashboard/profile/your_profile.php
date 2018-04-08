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
						<div class="col-md-3 agileits_team_grid">
							<p>
								<a href="./?ref=<?php echo $_REQUEST["ref"];?>&function=&unit=3" title='CHANGE PROFILE PICTURE'><?php echo "<img src='profilepics/".getProfilePicture($user["userID"])."' align='center' width='100' title='CHANGE PROFILE PICTURE'>"; ?></a>
							</p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>FIRST NAME</h4>
							<p><strong><?php echo $user["FirstName"];?></strong> </p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>LAST NAME</h4>
							<p><strong><?php echo $user["LastName"];?></strong> </p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>GENDER</h4>
							<p><strong><?php echo $user["sex"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>DATE OF BIRTH</h4>
							<p><strong><?php echo $user["DOB"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>NRC/ID</h4>
							<p><strong><?php echo $user["nrcNumber"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>MOBILE</h4>
							<p><strong><?php echo $user["Mobile"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>EMAIL</h4>
							<p><strong><?php echo $user["Email"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>HOUSE No.</h4>
							<p><strong><?php echo $user["houseNo"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>STREET</h4>
							<p><strong><?php echo $user["street"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>AREA</h4>
							<p><strong><?php echo $user["area"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>TOWN</h4>
							<p><strong><?php echo $user["town"];?></strong></p>
						</div>
						<div class="col-md-3 agileits_team_grid">
							<h4>COUNTRY</h4>
							<p><strong><?php echo $user["country"];?></strong></p>
						</div>
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