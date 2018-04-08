<?php 
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
		<div style="float: left; min-width:280px; max-width: 600px; background-color:#222; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<?php 
			if($err>=1)
			{
				?>
			
			<div style="margin:5px; float: left; padding:5px;"><b>ERROR! SOME DETAILS ARE MISSING. PLEASE FILL ALL FIELDS.</b></div>	
				<?php
			}
			?>
			<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>MODEL:</b> </div><div style="float: right;"><input name="model" type="text" size="30" value="<?php echo $_REQUEST['model'];?>" placeholder="e.g. Toyota Corolla"></div></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>MODEL YEAR:</b> </div><div style="float: right;"><input name="yearmake" type="text" size="30" value="<?php echo $_REQUEST['yearmake'];?>" placeholder="e.g. 2005"></div></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>CATEGORY:</b> </div><div style="float: right;"><select name="catname">
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
			<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>CURRENT MILEAGE:</b> </div><div style="float: right;"><input name="mileage" type="text" value="<?php echo $_REQUEST['mileage'];?>" size="15"></div></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>REGISTRATION NUMBER:</b> </div><div style="float: right;"><input name="regnumber" type="text" value="<?php echo $_REQUEST['regnumber'];?>" size="15"></div></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>TOWN:</b> </div><div style="float: right;"><select name="town">
			<?php
			
			$SesVar = SesVar();

			$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
			$online_res = mysqli_query($db,$online);
			$row_online = mysqli_fetch_array($online_res);
			$uid = $row_online["_idcry"];
		
			$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (ACTIVE = '1' OR ACTIVE = 'Yes');";
			$sess_res = mysqli_query($db,$session_query);
			@$num_sess = mysqli_num_rows($sess_res);
			$row_sess = mysqli_fetch_array($sess_res);
			$userCountry = $row_sess["Country"];
			
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
			<div style="float:left; width:93%;"><div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="PROCEED"></div></div>
		</div>
	</form>
	
	<?php
	}
	elseif($_REQUEST["submitBtn"]=='PROCEED' && $err==0)
	{
	?>
	<div style="float: left; min-width:280px; max-width: 350px; background-color:#222; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
		<form action="" method="POST" enctype="multipart/form-data">
		<input name="model" type="hidden" value="<?php echo $_REQUEST['model'];?>">
		<input name="catname" type="hidden" value="<?php echo $_REQUEST['catname'];?>">
		<input name="mileage" type="hidden" value="<?php echo $_REQUEST['mileage'];?>">
		<input name="regnumber" type="hidden" value="<?php echo $_REQUEST['regnumber'];?>">
		<input name="yearmake" type="hidden" value="<?php echo $_REQUEST['yearmake'];?>">
		<input name="town" type="hidden" value="<?php echo $_REQUEST['town'];?>">
		
		<div style="margin:5px; float: left; padding:5px;"><b>VERIFY THE DETAILS YOU ENTERED:</b></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>MODEL:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['model'];?></div></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>MODEL YEAR:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['yearmake'];?></div></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>CATEGORY:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo getVehicleCategory($_REQUEST['catname']);?></div></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>CURRENT MILEAGE:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['mileage'];?></div></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['regnumber'];?></div></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>TOWN:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo getTown($_REQUEST['town']);?></div></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="EDIT"></div>
		<div style="margin:5px; float: right; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="SUBMIT"></div>
		</form>
	</div>
	<?php
	}
	elseif($_REQUEST["submitBtn"]=='SUBMIT')
	{
		echo '<div style="float: left; min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
		
		$SesVar = SesVar();

		$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
		$online_res = mysqli_query($db,$online);
		$row_online = mysqli_fetch_array($online_res);
		$uid = $row_online["_idcry"];
		

		$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (ACTIVE = '1' OR ACTIVE = 'Yes');";
		$sess_res = mysqli_query($db,$session_query);
		@$num_sess = mysqli_num_rows($sess_res);
		$row_sess = mysqli_fetch_array($sess_res);
		$userID = $row_sess["userID"];
		$AccountType = $row_sess["AccountType"];
		$UserCode = $row_sess["UserCode"];
		$org = $row_sess["currentTerminal"];
		$Branch = $row_sess["SHIFT_ID"];
		$Email = $row_sess["Email"];
		$Mobile = $row_sess["Mobile"];
		$LoginName = $row_sess["USER_ID"];
		$FirstName = $row_sess["FIRST_NAME"];
		$LastName = $row_sess["LAST_NAME"];
		$NickName = $row_sess["SSN"];
		$_idxZx = $row_sess["USER_PASS"];
		$Address = $row_sess["Address"];
		$Postal = $row_sess["Postal"];
		$Fax = $row_sess["Fax"];
		$Telephone = $row_sess["PHONE_NO"];
		$Active = $row_sess["ACTIVE"];
		$RecordEnteredBy = $row_sess["RecordEnteredBy"];
		$Remarks = $row_sess["Remarks"];
		$level = $row_sess["N_USER_TYPE"];
		$userLevel = $row_sess["N_USER_TYPE"];
		$userCountry = $row_sess["Country"];
		
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

?>