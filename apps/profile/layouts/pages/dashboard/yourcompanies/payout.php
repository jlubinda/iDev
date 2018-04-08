<?php
	if(chkSes()=="Active")
	{

		$user = userData();
		
		$org = orgData(orgID($_REQUEST["vCode"]));
		
		$currency = "K";
		$balance = accountBalance($_REQUEST["vCode"]);
		$onsell = totalOrgValueOnSale($_REQUEST["vCode"]);
		//echo "test: ".$onsell."<br>";
				?>
				<div class="banner">
				<div class="w3l_banner_nav_right">
		<!-- about -->
				<div class="privacy about">
					<div class="agile_about_grids">
						<form action="" method="POST">
							<strong>CASH PAYOUT</strong><br><br>
							<strong>AMOUNT: </strong><input name="amount" type="text" size="25" ><br><br>
							<strong>PAY TO: </strong><input name="receiver" type="text" size="25" ><br><br>
							<strong></strong><input name="submitBtn" type="submit" value="PAYOUT" ><br>
							<div class="clearfix"> </div>
						</form>
					</div>
				<?php 
				if($_REQUEST["submitBtn"]=="PAYOUT")
				{
					$trans = transact($_REQUEST["vCode"],$_REQUEST["receiver"],$_REQUEST["amount"],"MONEY TRANSFER","",$user["userID"],"WEB");
					
					if(checkOrgAccount("UNIQUE",$_REQUEST["receiver"])>=1)
					{
						$receiverName = getOrgName($_REQUEST["receiver"]);
					}
					else
					{
						$receiverName = getNames($_REQUEST["receiver"]);
					}
					
					
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
							<strong>SUCCESS! YOU HAVE SENT <?php echo @number_format($_REQUEST["amount"],2);?> to <?php echo $receiverName;?> YOUR NEW BALANCE IS <?php echo @number_format(accountBalance($_REQUEST["vCode"]),2);?></strong>
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