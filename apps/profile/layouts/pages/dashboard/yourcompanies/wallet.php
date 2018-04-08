<?php
	if(chkSes()=="Active")
	{

		$user = orgData(orgID($_REQUEST["vCode"]));
		
				//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'productImage'=>$productImage,'sex'=>$sex,'DOB'=>$DOB,
				//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		$currency = "K";
		$balance = accountBalance($_REQUEST["vCode"]);
		$onsell = totalOrgValueOnSale($_REQUEST["vCode"]);
		//echo "test: ".$onsell."<br>"; 
				?>
		<div class="banner">
				<div class="col-md-3 top_brand_left" style="width:300px; margin:15px; font-size:12px;">
				<!-- about -->
					<div class="hover14 column" style="background-color:#efefef; width:300px">
						<div class="agile_top_brand_left_grid" style="width:300px;">
							<strong>VALUE OF GOODS ON SALE</strong>: <?php  echo $currency." ".@number_format($onsell,2); ?><br><br>
							<strong>CURRENT BALANCE</strong>: <?php  echo $currency." ".@number_format($balance,2); ?><br><br>
							<strong>MINIMUM BALANCE</strong>: <?php  echo $currency." ".@number_format(getServiceCharge($onsell,"FLOAT"),2); ?><br><br>
							<strong>AVAILABLE BALANCE</strong>: <?php  echo $currency." ".@number_format(($balance-getServiceCharge($onsell,"FLOAT")),2); ?><br>
							<div class="clearfix"> </div>
						</div>
					</div>
				<!-- //about -->
				</div>
				<div class="clearfix"></div>
		</div>

		<?php
		
		if($_REQUEST["submitBtn"]=="")
		{
						
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
		include find_file("login.php");
	}
?>