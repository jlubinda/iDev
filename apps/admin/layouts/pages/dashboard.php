<?php 

	$refx = explode("/",$_REQUEST["ref"]);
	$ref = $refx[0];
	
	$refx2 = explode(".",$refx[0]);
	$ref2 = $refx2[0];
	
	$refx3 = explode(".",$refx[1]);
	$ref3 = $refx3[0];
?>
	<section id="four_columns">
	<div style="margin:5px; width:93%; padding:5px;">
	<a class="button" href="?ref=<?php echo $refx2[0]; ?>/addvehicle.php" style="<?php if($refx3[0]=='addvehicle'){echo 'font-weight:bold; color:#000;';}?>">ADD VEHICLE</a>
	<?php
		$SesVar = SesVar();
		include_once "cnct.php";
		$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
		$online_res = mysqli_query($db,$online);
		$row_online = mysqli_fetch_array($online_res);
		$uid = $row_online["_idcry"];

		$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (ACTIVE = '1' OR ACTIVE = 'Yes');";
		$sess_res = mysqli_query($db,$session_query);
		@$num_sess = mysqli_num_rows($sess_res);
		$row_sess = mysqli_fetch_array($sess_res);
		$userCountry = $row_sess["Country"];
		$userID = $row_sess["userID"];
		$Mobilex = $row_sess["Mobile"];
		$Emailx = $row_sess["Email"];
			
		$bookings = listBookings($Mobilex,$Emailx);
			
		
		$carsx = listVehicles($uid,"","","ALL");
		
		if(($carsx[0]['num'])>=1)
		{
			?>
			<a class="button" href="?ref=<?php echo $refx2[0]; ?>/yourvehicles.php" style="<?php if($refx3[0]=='yourvehicles' || $refx3[0]==''){echo 'font-weight:bold; color:#000;';}?>">YOUR VEHICLES</a>
			<?php
		}
		
		if($bookings[0]['num']>=0)
		{
			?>
			<a class="button" href="?ref=<?php echo $refx2[0]; ?>/yourhistory.php" style="<?php if($refx3[0]=='yourhistory'){echo 'font-weight:bold; color:#000;';}?>">HIRE HISTORY</a>
			<?php 
		}
		
		?>
		<a class="button" href="?ref=<?php echo $refx2[0]; ?>/feesschedule.php" style="<?php if($refx3[0]=='feesschedule'){echo 'font-weight:bold; color:#000;';}?>">FEES SCHEDULE</a>
		<a class='button' href='?ref=<?php echo $refx2[0]; ?>/termowners.php' style='<?php if($refx3[0]=='termowners'){echo 'font-weight:bold; color:#000;';}?>'>TERMS - VEHICLE OWNERS</a>
		</div>
		<br>
		<?php 

		if($refx3[0]=='termowners' || $refx3[0]=='feesschedule' || $refx3[0]=='addvehicle')
		{
			?>
			<p style="color:#000;"><a style="font-weight:bold; text-decoration:underine;" href="?ref=<?php echo $refx2[0]; ?>/feesschedule.php">Click here to view the Fees Schedule</a>. The rate applicable will depend on the vehicle group for that vehicle being listed.
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
					</li><h2></h2>
				</ul> 
			</p>
			<?php
		}
	
	if($refx3[0]=='yourvehicles' || $refx3[0]=='')
	{
		include_once "layout/portal/yourvehicles.php";
	}
	elseif($refx3[0]=='addvehicle')
	{
		include_once "layout/portal/addvehicle.php";
	}
	elseif($refx3[0]=='yourhistory')
	{
		include_once "layout/portal/yourhistory.php";
	}
	elseif($refx3[0]=='feesschedule')
	{
		include_once "layout/portal/feesschedule.php";
	}
	elseif($refx3[0]=='termowners')
	{
		include_once "layout/portal/termowners.php";
	}
	?>
</section>
