<?php
	if(chkSes()=="Active")
	{
		$user = userData();
		
				//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'productImage'=>$productImage,'sex'=>$sex,'DOB'=>$DOB,
				//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		$currency = "K";
		$balance = accountBalance($user["userID"]);
		$onsell = totalValueOnSale($user["userID"]);
		
				?>
		<div class="banner">
				<div class="w3l_banner_nav_right">
		<!-- about -->
				<?php 
				if($_REQUEST["submitBtn"]=="")
				{
				?>
				<div class="privacy about">
					<div class="agile_about_grids">
						<form action="" method="POST">
							<strong><u>VERSION <?php echo getTerms("ID","AGENT"); ?></u></strong>
							<?php 
							echo getTerms("VIEW","AGENT");
							?>
							<br><br>
							<strong><label>BY CHECKING THE FOLLOWING CHECKBOX AND SUBMITTING THE FORM, YOU ARE AGREEING TO ALL THE TERMS AND CONDITIONS STATED ABOVE AND THE PRIVACY POLICY FOUND HERE - <A HREF="./?ref=privacypolicy.php">PRIVACY POLICY</A><br><br>I AGREE: <input name="accept" type="checkbox" value="AGREE" ></label></strong><br><br>
							<strong></strong><input name="submitBtn" type="submit" value="SUBMIT" ><br>
							<div class="clearfix"> </div>
						</form>
					</div>
				<?php 
				}
				
				if($_REQUEST["submitBtn"]=="SUBMIT" && $_REQUEST["accept"]=="AGREE")
				{
					$user = userData();
					
					$trans = acceptAgentTerm($user["userID"]);
					
					if($trans==0)
					{
						?>
						<div class="agile_about_grids">
							<strong>SORRY! PLEASE TRY AGAIN LATER.</strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
					elseif($trans==1)
					{
						?>
						<div class="agile_about_grids">
							<strong>SUCCESS! YOU ARE NOW AN AGENT.</strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
				}
				else
				{
					?>
					<div class="agile_about_grids">
						<strong>SORRY YOU CANNOT ACCESS THIS SECTION UNLESS YOU ARE AN AGENT.</strong>
						<div class="clearfix"> </div>
					</div>
					<?php
				}
				?>
				</div>
		<!-- //about -->
				</div>
				<div class="clearfix"></div>
		</div>

		<?php
	}
	else
	{
		include find_file("login.php");
	}
?>