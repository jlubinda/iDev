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
						<strong>YOUR ACCOUNT BALANCE: </strong><?php  echo $currency." ".@number_format($balance,2); ?><br><br>
						<strong>MINIMUM BALANCE: </strong><?php  echo $currency." ".@number_format(getServiceCharge($onsell,"FLOAT"),2); ?><br><br>
						<strong>AVAILABLE BALANCE: </strong><?php  echo $currency." ".@number_format(($balance-getServiceCharge($onsell,"FLOAT")),2); ?><br>
						<div class="clearfix"> </div>
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