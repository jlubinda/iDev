<?php

	if(chkSes()=="Active")
	{
		$user = userData();
		
		//('userID'=>$userID,'AccountType'=>$AccountType,'UserCode'=>$UserCode,'org'=>$org,'Branch'=>$Branch,'Email'=>$Email,'LoginName'=>$LoginName,'FirstName'=>$FirstName,'LastName'=>$LastName,'NickName'=>$NickName,'Password'=>$_idxZx,'Address'=>$Address,'Postal'=>$Postal,'Fax'=>$Fax,'Telephone'=>$Telephone,'Active'=>$Active,'QuasAdmin'=>$QuasAdmin,'MobileVerified'=>$MobileVerified,'EmailVerified'=>$EmailVerified,'level'=>$level,'Country'=>$userCountry,'productImage'=>$productImage,'sex'=>$sex,'DOB'=>$DOB,
		//'houseNo'=>$houseNo,'street'=>$street,'area'=>$area,'nrcNumber'=>$nrcNumber,'town'=>$town,'province'=>$province);
		?>
		  <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header">YOUR COMPANIES | ABOUT</h3>
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
				<div class="col-lg-12 col-md-12 col-sm-12">
						<?php 
				if(getOrgUserLevel($_REQUEST["vCode"],$user["userID"])=="-1")
				{
					
						if($_REQUEST["vCode"])
						{
							?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3>Details</h3>
								</div>
								<div class="panel-body">
									<div class="row">
									 <b>COMPANY NAME:</b> <?php echo getOrgName($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>SHORT NAME:</b> <?php echo getOrgShortName($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>REGISTRATION NUMBER:</b> <?php echo getOrgRegNumber($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>TAX NUMBER:</b> <?php echo getOrgTaxNumber($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>EMAIL:</b> <?php echo getOrgEmail($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>PHONE:</b> <?php echo getOrgphone($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>PHYSICAL ADDRESS:</b> <?php echo getOrgPhysicalAddress($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>POSTAL ADDRESS:</b> <?php echo getOrgPostalAddress($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>TOWN:</b> <?php echo getOrgTown($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>PROVINCE:</b> <?php echo getOrgProvince($_REQUEST["vCode"]);?>
									</div>
									<div class="row">
									 <b>COUNTRY:</b> <?php echo getOrgCountry($_REQUEST["vCode"]);?>
									</div>
								</div>
							</div>
						<?php
						}
				}
				else
				{
					echo "You do not have permission to access this component.";
				}
						?>
				</div>
			</div>
<!-- //about -->
		</div>
		<?php
	}
	else
	{
		include find_file("login.php");
	}
?>