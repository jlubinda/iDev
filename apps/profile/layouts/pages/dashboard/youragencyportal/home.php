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
				<div class="privacy about">
					<div class="agile_about_grids">
						<form action="" method="POST">
							<strong>CUSTOMER: </strong><input name="customer" type="text" size="25" ><br><br>
							<strong>TRANSPORTER: </strong><input name="transporter" type="text" size="25" ><br><br>
							<strong>CONFIRMATION CODE: </strong><input name="code" type="text" size="25" ><br><br>
							<strong></strong><input name="submitBtn" type="submit" value="CONFIRM" ><br>
							<div class="clearfix"> </div>
						</form>
					</div>
				<?php 
				if($_REQUEST["submitBtn"]=="CONFIRM")
				{
					$trans = transact($user["userID"],$_REQUEST["receiver"],$_REQUEST["amount"],"MONEY TRANSFER");
					
					if($trans==0)
					{
						?>
						<div class="agile_about_grids">
							<strong>SORRY! THE FUNDS WERE NOT SENT. PLEASE TRY AGAIN LATER.</strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
					elseif($trans==1)
					{
						?>
						<div class="agile_about_grids">
							<strong>SUCCESS! YOU HAVE SENT <?php echo @number_format($_REQUEST["amount"],2);?> to <?php getNames($_REQUEST["receiver"]);?> YOUR NEW BALANCE IS <?php echo @number_format(accountBalance($user["userID"]),2);?></strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
					elseif($trans==2)
					{
						?>
						<div class="agile_about_grids">
							<strong>INSUFFICIENT FUNDS!</strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
					elseif($trans==3)
					{
						?>
						<div class="agile_about_grids">
							<strong>SORRY! PLEASE TRY AGAIN LATER</strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
					elseif($trans==4)
					{
						?>
						<div class="agile_about_grids">
							<strong>SUCCESS! <?php getNames($_REQUEST["receiver"])?> WILL RECEIVE FUNDS IN ABOUT 4 HOURS.</strong>
							<div class="clearfix"> </div>
						</div>
						<?php
					}
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