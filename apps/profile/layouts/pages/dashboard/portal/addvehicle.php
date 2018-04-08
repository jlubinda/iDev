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
			<p style="color:#000;"><a style="font-weight:bold; text-decoration:underine;" href="?ref=<?php echo iDevSite("DASHBOARD URL");?>/feesschedule.php">Click here to view the Fees Schedule</a>. The rate applicable will depend on the vehicle group for that vehicle being listed.
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
	
	
	$err = 0;

	if($_REQUEST["submitBtn"]=='PROCEED')
	{
		if($_REQUEST["model"]=='')
		{
			$err = $err+1;
		}
		
		if($_REQUEST["catname"]=='')
		{
			$err = $err+1;
		}
		
		if($_REQUEST["mileage"]=='')
		{
			$err = $err+1;
		}
		
		if($_REQUEST["regnumber"]=='')
		{
			$err = $err+1;
		}
		
		if($_REQUEST["yearmake"]=='')
		{
			$err = $err+1;
		}
	}


	if($_REQUEST["submitBtn"]=='' || ($err>=1) || ($_REQUEST["submitBtn"]=='EDIT'))
	{
	?>
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="col s12 l12">
			<?php 
			if($err>=1)
			{
				?>
			
			<div style="margin:5px; padding:5px;"><b>ERROR! SOME DETAILS ARE MISSING. PLEASE FILL ALL FIELDS.</b></div>	
				<?php
			}
			?>
			<div style="margin:5px; padding:5px; width:93%;"><div style=" padding:7px;"><b>MODEL:</b> </div><div style=""><input name="model" type="text" size="30" value="<?php echo $_REQUEST['model'];?>" placeholder="e.g. Toyota Corolla"></div></div>
			<div style="margin:5px; padding:5px; width:93%;"><div style=" padding:7px;"><b>MODEL YEAR:</b> </div><div style=""><input name="yearmake" type="text" size="30" value="<?php echo $_REQUEST['yearmake'];?>" placeholder="e.g. 2005"></div></div>
			<div style="margin:5px; padding:5px; width:93%;"><div style=" padding:7px;"><b>CATEGORY:</b> </div><div style=""><select name="catname">
			<?php
				$cats = listVehicleCategories();
				
				if(!($_REQUEST['catname']==""))
				{
					?>
					<option value='<?php echo $_REQUEST['catname'];?>'><?php echo getVehicleCategory($_REQUEST['catname']);?></option>
					<?php
				}
				
				for($a=0; $a<$cats[0]['num']; $a++)
				{
					?>
					<option value='<?php echo $cats[$a]["id"];?>'><?php echo $cats[$a]["name"];?></option>
					<?php
				}
				?>
			</select></div></div>
			<div style="margin:5px; padding:5px; width:93%;"><div style=" padding:7px;"><b>CURRENT MILEAGE:</b> </div><div style=""><input name="mileage" type="text" value="<?php echo $_REQUEST['mileage'];?>" size="15"></div></div>
			<div style="margin:5px; padding:5px; width:93%;"><div style=" padding:7px;"><b>REGISTRATION NUMBER:</b> </div><div style=""><input name="regnumber" type="text" value="<?php echo $_REQUEST['regnumber'];?>" size="15"></div></div>
			<div style="margin:5px; padding:5px; width:93%;"><div style=" padding:7px;"><b>TOWN:</b> </div><div style=""><select name="town">
			<?php
			
			
				@$towns = listTowns($userCountry);
				
				if(!($_REQUEST['town']==""))
				{
					?>
					<option value='<?php echo $_REQUEST['town'];?>'><?php echo $_REQUEST['town'];?></option>
					<?php
				}
				
				for($ac=0; $ac<$towns[0]['num']; $ac++)
				{
					?>
					<option value='<?php echo $towns[$ac]["id"];?>'><?php echo $towns[$ac]["name"];?></option>
					<?php
				}
				?>
			</select></div></div>
			<div style=" width:93%;"><div style="margin:5px; padding:5px; "><input class="btn primary" type="submit" name="submitBtn" value="PROCEED"></div></div>
		</div>
	</form>
	
	<?php
	}
	elseif($_REQUEST["submitBtn"]=='PROCEED' && $err==0)
	{
	?>
	<div style=" min-width:280px; max-width: 350px; background-color:#222; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
		<form action="" method="POST" enctype="multipart/form-data">
		<input name="model" type="hidden" value="<?php echo $_REQUEST['model'];?>">
		<input name="catname" type="hidden" value="<?php echo $_REQUEST['catname'];?>">
		<input name="mileage" type="hidden" value="<?php echo $_REQUEST['mileage'];?>">
		<input name="regnumber" type="hidden" value="<?php echo $_REQUEST['regnumber'];?>">
		<input name="yearmake" type="hidden" value="<?php echo $_REQUEST['yearmake'];?>">
		<input name="town" type="hidden" value="<?php echo $_REQUEST['town'];?>">
		
		<div style="margin:5px; padding:5px;"><b>VERIFY THE DETAILS YOU ENTERED:</b></div>
		<div style="margin:5px; padding:5px; width: 93%;"><div style="margin:5px; padding:5px;"><b>MODEL:</b> </div><div style="margin:5px;  padding:5px; background-color:#222;"><?php echo $_REQUEST['model'];?></div></div>
		<div style="margin:5px; padding:5px; width: 93%;"><div style="margin:5px; padding:5px;"><b>MODEL YEAR:</b> </div><div style="margin:5px;  padding:5px; background-color:#222;"><?php echo $_REQUEST['yearmake'];?></div></div>
		<div style="margin:5px; padding:5px; width: 93%;"><div style="margin:5px; padding:5px;"><b>CATEGORY:</b> </div><div style="margin:5px;  padding:5px; background-color:#222;"><?php echo getVehicleCategory($_REQUEST['catname']);?></div></div>
		<div style="margin:5px; padding:5px; width: 93%;"><div style="margin:5px; padding:5px;"><b>CURRENT MILEAGE:</b> </div><div style="margin:5px;  padding:5px; background-color:#222;"><?php echo $_REQUEST['mileage'];?></div></div>
		<div style="margin:5px; padding:5px; width: 93%;"><div style="margin:5px; padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px;  padding:5px; background-color:#222;"><?php echo $_REQUEST['regnumber'];?></div></div>
		<div style="margin:5px; padding:5px; width: 93%;"><div style="margin:5px; padding:5px;"><b>TOWN:</b> </div><div style="margin:5px;  padding:5px; background-color:#222;"><?php echo getTown($_REQUEST['town']);?></div></div>
		<div style="margin:5px; padding:5px; "><input type="submit" name="submitBtn" value="EDIT"></div>
		<div style="margin:5px;  padding:5px; "><input type="submit" name="submitBtn" value="SUBMIT"></div>
		</form>
	</div>
	<?php
	}
	elseif($_REQUEST["submitBtn"]=='SUBMIT')
	{
		echo '<div style=" min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
		
		
		$registration = registerVehicle($userID,$_REQUEST['catname'],$_REQUEST['model'],$_REQUEST['yearmake'],$_REQUEST['regnumber'],$userCountry,$_REQUEST['town']);
		
		if($registration>="1")
		{
			addVehicleMilage($registration,$_REQUEST['mileage']);
			
			$to = "operations@vehicleportal.co.zm";
			$no_reply = "no-reply@vehicleportal.co.zm";
			$email_message = "<b><u>Vportal Vehicle Registration</u></b><br>\n";
			$email_message .= "VEHICLE TYPE: ".getVehicleCategory($_REQUEST['catname'])."<br>\n";
			$email_message .= "REGISTRATION NUMBER: ".$_REQUEST['regnumber']."<br>\n";
			$email_message .= "LOCATION: ".getTown($_REQUEST['town'])."<br>\n";
			$email_message .= "OWNER: ".$FirstName." ".$LastName.", Mobile Number - ".$Mobile.", Email Address - ".$Email.".<br><br>\n\n";

			email("NEW VEHICLE REGISTERED",$email_message,$no_reply,$to);
		
			echo "Success! Your vehicle has been added.<br>
			Please upload images of your vehicle <a class='button' href='?ref=".iDevSite("DASHBOARD URL")."/yourvehicles.php&id=".$registration."&function=add&type=images&action=upload'>UPLOAD IMAGES</a><br><br>
			After uploading images of your vehicle, ensure you drive it to the Vehicle Portal offices or any of the approved Vehicle Portal agents for inspection as soon as possible. Thank you.<br><br>";
		}
		else
		{
			echo "Error adding vehicle.<br><br>";
		}
		echo '</div>';
	}
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