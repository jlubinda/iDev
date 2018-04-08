<?php 
router(array("HEADER","profile"),"","",'','','file','');
if(chkSes()=="Active")
{
	$user = userData();
	$uid = $user["userID"];
	$Mobilex = $user["Mobile"];
	$Emailx = $user["Email"];
	$userID = $user["userID"];
	$AccountType = $user["AccountType"];
	$UserCode = $user["UserCode"];
	$org = $user["org"];
	$Branch = $user["Branch"];
	$Email = $user["Email"];
	$Mobile = $user["Mobile"];
	$LoginName = $user["LoginName"];
	$FirstName = $user["FirstName"];
	$LastName = $user["LastName"];
	$NickName = $user["NickName"];
	$_idxZx = $user["USER_PASS"];
	$Address = $user["Address"];
	$Postal = $user["Postal"];
	$Fax = $user["Fax"];
	$Telephone = $user["Telephone"];
	$Active = $user["Active"];
	$RecordEnteredBy = $user["RecordEnteredBy"];
	$Remarks = $user["Remarks"];
	$level = $user["level"];
	$userLevel = $user["level"];
	$userCountry = $user["Country"];
?>
<section class="container">
<?php 
if(checkAcceptVehicleOwnerTerms($uid)==1)
{
?>
	<div style="margin:5px; width:93%; padding:5px;">
	<a class="button" href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/addvehicle.php" style="<?php if($refx3[0]=='addvehicle'){echo 'font-weight:bold; color:#000;';}?>">ADD VEHICLE</a>
	<?php
	
		$bookings = listBookings($Mobilex,$Emailx);
			
		
		$carsx = listVehicles($uid,"","","ALL");
		
		if(($carsx[0]['num'])>=1)
		{
			?>
			<a class="button" href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/yourvehicles.php" style="<?php if($refx3[0]=='yourvehicles' || $refx3[0]==''){echo 'font-weight:bold; color:#000;';}?>">YOUR VEHICLES</a>
			<?php
		}
		
		if($bookings[0]['num']>=0)
		{
			?>
			<a class="button" href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/yourhistory.php" style="<?php if($refx3[0]=='yourhistory'){echo 'font-weight:bold; color:#000;';}?>">HIRE HISTORY</a>
			<?php 
		}
		
		?>
		<a class="button" href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/feesschedule.php" style="<?php if($refx3[0]=='feesschedule'){echo 'font-weight:bold; color:#000;';}?>">FEES SCHEDULE</a>
		<a class='button' href='?ref=<?php echo iDevSite("DASHBOARD URL");?>/termowners.php' style='<?php if($refx3[0]=='termowners'){echo 'font-weight:bold; color:#000;';}?>'>TERMS - VEHICLE OWNERS</a>
		</div>
		<br>
		<?php 

		//if($refx3[0]=='termowners' || $refx3[0]=='feesschedule' || $refx3[0]=='addvehicle')
		//{
			?>
			<p style="color:#000;"> As shown in the schedule below, the rate applicable will depend on the vehicle group for that vehicle being listed.
				Typically Vehicle Portal will get between 30-40% commissions depending on the vehicle group. This will help us cover expenses such as insurance, sms text alerts and 24/7 road assistance.<br>
				<ul style="color:#000;">
					<li style="color:#000;">
					 1. All rental prices on all vehicle groups are capped at a maximum value. 
					</li>
					<li style="color:#000;">
					2. Maximum rental amounts payable to vehicle owners are dependant on the vehicle group. 
					</li>
					<li style="color:#000;">
					3. To make your vehicle more attractive and saleable, you can adjust and set a competitive price for it.

                                     <p><strong>The rates indicated below are net amounts  payable perday to the vehicle owner after Vehicle Portal Commission.</strong></p>
									 
									  <p><strong>The rate fee indicated for the 14 seater buses are net of drivers allowance . Vportal will provide the client with its own driver.</strong></p>
									
									  <p><strong>Due to the proximity of the towns in the copper-belt the whole region is treated as one Town.Hence the out of town rate under each copperbelt town only applies when leaving the copperbelt region e.g when hire is to Lusaka</strong></p>
					</li><h2></h2>
				</ul> 
			</p>
			<?php
		//}
	
	
?>

<p><strong>Vehicle Category</strong> | Paid to Car Owner/day</p>
	<?php 
	
		?>
		<div class="col s12 l12 grey lighten-2">
			<strong><u><?php echo strtoupper($countries[$b]["name"]);?></u></strong>
			<?php 
			$orderBy = "id";
			$order="ASC";
			$min=0;
			$max=50;
			if(trim($userCountry)=="")
			{
				$userCountryx = "Zambia";
			}
			else
			{
				$userCountryx = $userCountry;
			}
				$cats = listThirdPartyDues($orderBy,$order,$min,$max,$userCountryx);
				for($a=0; $a<$cats[0]["num"]; $a++)
				{
					?>
					<div class="row">
						<div class="col s12 l12">
							<div class="col s12 m12 l3">
								<b><u><?php echo $cats[$a]["catname"];?></u></b>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>Local Rate</b><br>
								<?php echo $cats[$a]["currency"];?>
								<?php echo $cats[$a]["localrate"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>Out Of Town Rate</b><br>
								<?php echo $cats[$a]["currency"];?>
								<?php echo $cats[$a]["ootrate"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>Out Of Country Rate</b><br>
								<?php echo $cats[$a]["currency"];?>
								<?php echo $cats[$a]["oocrate"];?>
								</div>
							</div>
						</div>
					</div>
					<hr />
					<?php
				}
			?>
		</div>
<hr /> 
	<?php
}
else
{
	if($_POST["submitBtn"]=="Accept" && $_POST["confirmTerms"]=="1")
	{
		$accept = acceptVehicleOwnerTerms($userID);
		
		if($accept==1)
		{
			echo '<p>Success! Please <a href="./?ref='.$_REQUEST["ref"].'" class="btn primary">CLICK HERE</a> to start using VehiclePortal.</p>';
		}
		else
		{
			echo '<p>Error processing your request. Please <a href="./?ref='.$_REQUEST["ref"].'" class="btn primary">CLICK HERE</a> to try again.</p>';
		}
	}
	
	if(!(checkAcceptVehicleOwnerTerms($uid)==1))
	{
		?>
		<article class="row">
			<p>When you list your vehicle for hiring out on Vehicle Portal website the following terms and condition will apply.</p>
			<?php echo getSubTerms();?>
		</article>
		<hr>
		<p>
			<form action="" method="POST">
				By checking this checkbox, you are confirming that you have read the terms and conditions stated above and having full understanding of all their implications accept them and henceforth get into a legally binding contract with City Drive Rent A Car Limited concerning use of their platform - VehiclePortal: 
				<p>
					
						<input type="checkbox"  class="filled-in" value="1" name="confirmTerms" id="indeterminate-checkbox" /><label for="indeterminate-checkbox"> <span>I Agree to the terms & conditions</span>
					</label>
				</p>
				<input type="submit" value="Accept" name="submitBtn" class="btn primary">
			</form>
		</p>
		<?php
	}
}
	?>
</section>
	<style>
a.button {
    border: none;
    color: white;
    padding:5px 2px;
    text-align: center;
    text-decoration: none;
    display:inline-block;
    font-size: 15px;
    margin: 5px;
    cursor: pointer;
}
</style><?php 
}
else
{
	include find_file("login.php");
}
router(array("FOOTER","profile"),"","",'','','file','');
?>