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
	
if($_REQUEST["function"]=="delete" && $_REQUEST["type"]=="vehicle")
{
	?>
	<div class="row">
		<div class="col s12 l12">
			<?php 
			if($_REQUEST['con']=="Yes")
			{
				if(deleteVehicle($_REQUEST['id'])==1)
				{
					?>
					<b>VEHICLE DELETED</b>
					<?php
				}
				else
				{
					?>
					<b>ERROR! VEHICLE NOT DELETED</b>
					<?php
				}
			}
			else
			{
				?>
				<b>ARE YOU SURE YOU WANT TO DELETE THE VEHICLE, REGISTRATION NUMBER '<?php echo viewVehicle($_REQUEST['id'],"REG NUMBER");?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&type=vehicle&function=delete&con=Yes" class="btn primary">YES</a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>" class="btn primary">NO</a>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}

?>

<div class="row">
<br><br>
	<?php
	$orderBy = "id";
	$order = "ASC";
	$min = 0;
	$max = 20;
	
	@$towns = listTowns($userCountry);
		
	if($_REQUEST["type"]=="")
	{
		$cars = listAllVehicles($orderBy,$Emailx,$order,$min,$max);
		
		for($a=0; $a<$cars[0]['num']; $a++)
		{
			//$location = viewVehicle($cars[$a]["id"],"LOCATION");
			
				$catData = viewVehicleCategory($cars[$a]["typecode"]);
				
				if(isset($cars[$a]["coverimage"]))
				{
					$coverImg = $cars[$a]["coverimage"];
				}
				else
				{
					$coverImg = $catData["img"];
				}
				//echo "typecode: ".$cars[$a]["typecode"];
				//print_r($cars[$a]);
				//print_r($cars[$a]["thirdpartyDues"]["localrate"]);
				echo "<br><br>";
				
				if(trim($cars[$a]["mileage"]["current_mileage"])=="")
				{
					$current_mileage = 0;
				}
				else
				{
					$current_mileage = $cars[$a]["mileage"]["current_mileage"];
				}
				
				if(strtoupper($cars[$a]["fueltype"])=="PETROL")
				{
					$next_mileage = $current_mileage+5000;
				}
				elseif(strtoupper($cars[$a]["fueltype"])=="DIESEL")
				{
					$next_mileage = $current_mileage+8000;
				}
				else
				{
					$next_mileage = $current_mileage+5000;
				}
				
				$_SESSION["Vehicle:".$cars[$a]["vehicle_reg"]] = $cars[$a];
				
				if(strtoupper($cars[$a]["vpstatus"])=="ACTIVE")
				{
					$newVehicleStatus = "DEACTIVATED";
					$newVehicleStatus2 = "DEACTIVATE";
				}
				else
				{
					$newVehicleStatus = "ACTIVE";
					$newVehicleStatus2 = "ACTIVATE";
				}
			?>
			<div class="col s12 l12 grey lighten-2 hoverable z-depth-2" style="margin:5px; padding:10px;">
				<div class="col s12 m12 l3">
					<img src="<?php echo  $coverImg;?>" alt="<?php echo $cars[$a]['name'];?>" title="<?php echo $cars[$a]['name'];?>" width="99%" />
				</div>
				<div class="col s12 m6 l5 white" style="margin:5px; padding:5px; font-size:12px;">
					<div class="left col s12 m12 l12" style="font-size:12px;"><b><?php echo ucwords(strtolower($cars[$a]["vehiclemake"])).", ".$cars[$a]["vehicletype"];?> - <?php echo $cars[$a]["modelyear"];?> model</b></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Licence Plate: </b><?php echo $cars[$a]["vehicle_reg"];?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Insurance Valid To:</b> <?php echo date("d-m-Y",((int) $cars[$a]["insurance"]["valid_to"]));?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Insurance Remaining Days:</b> <?php echo number_format((((int) $cars[$a]["insurance"]["valid_to"])-(strtotime(date("Y-m-d H:i:s"))))/86400);?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Fitness Valid To:</b> <?php echo date("d-m-Y",((int) $cars[$a]["fitness"]["valid_to"]));?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Fitness Remaining Days:</b> <?php echo number_format((((int) $cars[$a]["fitness"]["valid_to"])-(strtotime(date("Y-m-d H:i:s"))))/86400);?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Road Tax Valid To:</b> <?php echo date("d-m-Y",((int) $cars[$a]["roadtax"]["valid_to"]));?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Road Tax Remaining Days:</b> <?php echo number_format((((int) $cars[$a]["roadtax"]["valid_to"])-(strtotime(date("Y-m-d H:i:s"))))/86400);?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Last Recorded Mileage:</b> <?php echo number_format($current_mileage);?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Mileage Remaining Till Service:</b> <?php if($current_mileage==0){echo "Pending Mileage Update";}else{echo number_format(((int) $next_mileage));};?></div>
					<div class="left col s12 m12 l12" style="font-size:12px;"><b>Base Location: </b><?php echo $cars[$a]["town"].", ".$cars[$a]["province"];?> - <?php echo $cars[$a]["country"];?></div>
					<div class="left col s12 m12 l12">
						<h3 style='font-size:13px;'>K<?php echo @number_format(((int) $cars[$a]["categoryPrices"]["localrate"]),2);?> / day (Local Rate) <span class="right">Fees due to you on local hire: K<?php echo @number_format(((int) $cars[$a]["thirdpartyDues"]["localrate"]),2);?> / day</span></h3>
						<h3 style='font-size:13px;'>K<?php echo @number_format(((int) $cars[$a]["categoryPrices"]["ootrate"]),2);?> / day (Out Of Town Rate) <span class="right">Fees due to you on out of town hire: K<?php echo @number_format(((int) $cars[$a]["thirdpartyDues"]["ootrate"]),2);?> / day</span></h3>
						<h3 style='font-size:13px;'>K<?php echo @number_format(((int) $cars[$a]["categoryPrices"]["oocrate"]),2);?> / day (Out Of Country Rate) <span class="right">Fees due to you on out of country hire: K<?php echo @number_format(((int) $cars[$a]["thirdpartyDues"]["oocrate"]),2);?> / day</span></h3>
					</div>
				</div>
				<div class="col s12 m5 l3 right">
					<a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=edit&type=price&action=adjust">ADJUST PRICE</a>
					<a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=edit&type=vehicle">EDIT DETAILS</a>
					<button class="modal-trigger btn primary right orange hoverable z-depth-5" style="margin:5px;"  data-target="modal_<?php echo $cars[$a]['id'];?>_images">IMAGES</button>
					<a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=view&type=hireHistory">HIRE HISTORY</a>
					<a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=view&type=serviceDetails">SERVICE DETAILS</a>
					<a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=view&type=mileage">UPDATE MILEAGE</a>
					<button class="modal-trigger btn primary right orange hoverable z-depth-5" style="margin:5px;"  data-target="modal_<?php echo $cars[$a]['id'];?>_breakdowns">BREAKDOWNS</button>
					<a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="#" onClick="updateVehicleStatus('<?php echo $cars[$a]["vehicle_reg"];?>','<?php echo $newVehicleStatus;?>');"><?php echo $newVehicleStatus2;?></a>
					<?php /*?><a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=delete&type=vehicle">DELETE</a><?php */?>
				</div>
				<!--IMAGES-->
				<div id="modal_<?php echo $cars[$a]['id'];?>_images" class="modal">
					<div class="modal-content">
					  <h4><?php echo $cars[$a]["vehicle_reg"];?> Images</h4>
					  <a class="btn primary left orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=add&type=images&action=upload">UPLOAD IMAGE</a>
					  <a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=view&type=images&action=view">VIEW IMAGES</a>
					</div>
					<div class="modal-footer">
					  &nbsp;
					</div>
				</div>
				<!--BREAKDOWNS-->
				<div id="modal_<?php echo $cars[$a]['id'];?>_breakdowns" class="modal">
					<div class="modal-content">
					  <h4><?php echo $cars[$a]["vehicle_reg"];?> Breakdown</h4>
					  <a class="btn primary left orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=add&type=breakdowns&action=upload">ADD BREAKDOWN</a>
					  <a class="btn primary right orange hoverable z-depth-5" style="margin:5px;" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['vehicle_reg'];?>&function=view&type=breakdowns&action=view">VIEW BREAKDOWNS</a>
					</div>
					<div class="modal-footer">
					  &nbsp;
					</div>
				</div>
			</div>
			<?php
		}
	}
	elseif($_REQUEST["type"]=="vehicle")
	{
		
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
			<div class="col s12 l12" style=" padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">
				<?php 
				if($err>=1)
				{
					?>
				
				<div style="margin:5px;  padding:5px;" class="row"><b>ERROR! SOME DETAILS ARE MISSING. PLEASE FILL ALL FIELDS.</b></div>	
					<?php
				}
				?>
				<div style="margin:5px;  padding:5px;" class="row"><div class="left"><b>MODEL:</b> </div><div class="right"><input name="model" type="text" size="30" value="<?php if($_REQUEST['model']==''){echo viewVehicle($_REQUEST["id"],"MAKE");}else{echo $_REQUEST['model'];}?>" placeholder="e.g. Toyota Corolla"></div></div>
				<div style="margin:5px;  padding:5px;" class="row"><div class="left"><b>MODEL YEAR:</b> </div><div class="right"><input name="yearmake" type="text" size="30" value="<?php if($_REQUEST['yearmake']==''){echo viewVehicle($_REQUEST["id"],"YEAR");}else{echo $_REQUEST['yearmake'];} ?>" placeholder="e.g. 2005"></div></div>
				<div style="margin:5px;  padding:5px;" class="row"><div class="left"><b>CATEGORY:</b> </div><div class="right input-field"><select name="catname">
				<?php
					$cats = listVehicleCategories();
					
					if($_REQUEST['model']==''){echo viewVehicle($_REQUEST["id"],"MAKE");}else{echo $_REQUEST['model'];}
					
					if(!($_REQUEST['catname']==""))
					{
						?>
						<option value='<?php echo $_REQUEST['catname'];?>'><?php echo getVehicleCategory($_REQUEST['catname']);?></option>
						<?php
					}
					else
					{
						?>
						<option value='<?php echo viewVehicle($_REQUEST["id"],"TYPE");?>'><?php echo getVehicleCategory(viewVehicle($_REQUEST["id"],"TYPE")) ;?></option>
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
				<div style="margin:5px;  padding:5px;" class="row"><div style=" padding:7px;"><b>REGISTRATION NUMBER:</b> </div><div class="right"><input name="regnumber" type="text" value="<?php if($_REQUEST['regnumber']==''){echo viewVehicle($_REQUEST["id"],"REG NUMBER");}else{echo $_REQUEST['regnumber'];}?>" size="15"></div></div>
				<div style="margin:5px;  padding:5px;" class="row"><div style=" padding:7px;"><b>TOWN:</b> </div><div class="right input-field"><select name="town">
				<?php
				
				$SesVar = SesVar();

				$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
				$online_res = mysql_query($online);
				$row_online = mysql_fetch_array($online_res);
				$uid = $row_online["_idcry"];
			
				$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (ACTIVE = '1' OR ACTIVE = 'Yes');";
				$sess_res = mysql_query($session_query);
				@$num_sess = mysql_num_rows($sess_res);
				$row_sess = mysql_fetch_array($sess_res);
				$userCountry = $row_sess["Country"];
				
					@$towns = listTowns($userCountry);
					
					if(!($_REQUEST['town']==""))
					{
						?>
						<option value='<?php echo $_REQUEST['town'];?>'><?php echo $_REQUEST['town'];?></option>
						<?php
					}
					else
					{
						?>
						<option value='<?php echo viewVehicle($_REQUEST["id"],"TOWN");?>'><?php echo viewVehicle($_REQUEST["id"],"TOWN");?></option>
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
				<div class="row"><div style="margin:5px;  padding:5px; " class="col s12 l12"><input type="submit" class="btn primary" name="submitBtn" value="PROCEED"></div></div>
			</div>
		</form>
		
		<?php
		}
		elseif($_REQUEST["submitBtn"]=='PROCEED' && $err==0)
		{
		?>
		<div class="" style="padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">
			<form action="" method="POST" enctype="multipart/form-data">
			<input name="model" type="hidden" value="<?php echo $_REQUEST['model'];?>">
			<input name="catname" type="hidden" value="<?php echo $_REQUEST['catname'];?>">
			<input name="mileage" type="hidden" value="<?php echo $_REQUEST['mileage'];?>">
			<input name="regnumber" type="hidden" value="<?php echo $_REQUEST['regnumber'];?>">
			<input name="yearmake" type="hidden" value="<?php echo $_REQUEST['yearmake'];?>">
			<input name="town" type="hidden" value="<?php echo $_REQUEST['town'];?>">
			
			<div style="margin:5px;  padding:5px;"><b>VERIFY THE DETAILS YOU ENTERED:</b></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>MODEL:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['model'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>MODEL YEAR:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['yearmake'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>CATEGORY:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo getVehicleCategory($_REQUEST['catname']);?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['regnumber'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>TOWN:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['town'];?></div></div>
			<div style="margin:5px;  padding:0px; width: 97%;">
				<div style="margin:5px;  padding:5px; "><input type="submit" class="btn primary" name="submitBtn" value="EDIT"></div>
				<div style="margin:5px; float: right; padding:5px; "><input type="submit" class="btn primary" name="submitBtn" value="SUBMIT"></div>
			</div>
			</form>
		</div>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=='SUBMIT')
		{
			echo '<div style=" min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">';
			
			if(editVehicle($_REQUEST['id'],$_REQUEST['catname'],$_REQUEST['model'],$_REQUEST['yearmake'],$_REQUEST['regnumber'],$_REQUEST['town'])=="1")
			{
				echo "Vehicle Details Updated.<br><br>";
			}
			else
			{
				echo "Error updating Vehicle Details.<br><br>";
			}
			echo '</div>';
		}
	}
	elseif($_REQUEST["type"]=="mileage")
	{

		?>
		<div style=" min-width:280px; max-width: 350px; background-color:#000; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">
			<div style="margin:5px;  padding:5px; background-color:#222 width: 93%;"><div style="margin:5px;  padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#000;"><?php echo viewVehicle($_REQUEST["id"],"REG NUMBER");?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>MILEAGE:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#000;"><?php echo viewVehicleMilage($_REQUEST["id"]);?></div></div>
		</div>
		<?php
		
		
		$err = 0;

		if($_REQUEST["submitBtn"]=='PROCEED')
		{
			if($_REQUEST["mileage"]=='')
			{
				$err = $err+1;
			}
		}
			
		if($_REQUEST["submitBtn"]=='' || ($err>=1) || ($_REQUEST["submitBtn"]=='EDIT'))
		{
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<div style=" min-width:280px; max-width: 600px;  padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">
				<?php 
				if($err>=1)
				{
					?>
					<div style="margin:5px;  padding:5px;"><b>ERROR! MILEAGE FIELD IS EMPTY. PLEASE FILL IT IN BEFORE YOU PROCEED.</b></div>	
					<?php
				}
				?>
				<div style="margin:5px;  padding:5px;" class="row"><div style=" padding:7px;"><b>MILEAGE:</b> </div><div class="right"><input name="mileage" type="text" value="<?php if($_REQUEST['mileage']==''){echo viewVehicleMilage($_REQUEST["id"]);}else{echo $_REQUEST['mileage'];}?>" size="15"></div></div>

				<div style=" width:93%;"><div style="margin:5px;  padding:5px; "><input type="submit" class="btn primary" name="submitBtn" value="PROCEED"></div></div>
			</div>
		</form>
		
		<?php
		}
		elseif($_REQUEST["submitBtn"]=='PROCEED' && $err==0)
		{
		?>
		<div style=" min-width:280px; max-width: 350px;  padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">
			<form action="" method="POST" enctype="multipart/form-data">
			<input name="mileage" type="hidden" value="<?php echo $_REQUEST['mileage'];?>">
			
			<div style="margin:5px;  padding:5px;"><b>VERIFY THE DETAILS YOU ENTERED:</b></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo viewVehicle($_REQUEST["id"],"REG NUMBER");?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px;"><b>MILEAGE:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['mileage'];?></div></div>
			<div style="margin:5px;  padding:0px; width: 97%;">
				<div style="margin:5px;  padding:5px; "><input type="submit" class="btn primary" name="submitBtn" value="EDIT"></div>
				<div style="margin:5px; float: right; padding:5px; "><input type="submit" class="btn primary" name="submitBtn" value="SUBMIT"></div>
			</div>
			</form>
		</div>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=='SUBMIT')
		{
			echo '<div style=" min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">';
			
			if(addVehicleMilage($_REQUEST['id'],$_REQUEST['mileage'])=="1")
			{
				echo "Vehicle Mileage Updated.<br><br>";
			}
			else
			{
				echo "Error updating Vehicle Mileage.<br><br>";
			}
			echo '</div>';
		}
	}
	elseif($_REQUEST["type"]=="serviceDetails")
	{

		?>
		<div class="col s12 l12 grey lighten-4 hoverable z-depth-5">
			<br><strong class="col s12 l12 center"><u>ADD SERVICE DETAILS FOR <?php echo strtoupper($_REQUEST['id']);?></u></strong><br><br>
		<?php
		
		
		$err = 0;

		if($_REQUEST["submitBtn"]=='PROCEED')
		{
			if($_REQUEST["mileage"]=='')
			{
				$err = $err+1;
			}
		}
			
		if($_REQUEST["submitBtn"]=='' || ($err>=1) || ($_REQUEST["submitBtn"]=='EDIT'))
		{
		?>
		<form action="" method="POST" enctype="multipart/form-data">
				<?php 
				if($err>=1)
				{
					?>
					<div class="col s12 l12 center" style="margin:5px;  padding:5px;"><b>ERROR! MILEAGE FIELD IS EMPTY. PLEASE FILL IT IN BEFORE YOU PROCEED.</b></div>	
					<?php
				}
				?>
				<div class="row"><div class="col s12 l12 input-field" style="font-size:12px;">
						<select name="" id="works_type">
							<option value="ENGINE SERVICE">ENGINE SERVICE</option>
							<option value="GENERAL SERVICE">GENERAL SERVICE</option>
							<option value="REPAIRS">REPAIRS</option>
							<option value="SUSPENSION SERVICE">SUSPENSION SERVICE</option>
						</select>
						<label for="works_type"><b>WORKS TYPE</b></label>
				</div></div>
				<div class="row"><div class="col s12 l12 input-field" style="font-size:12px;"><label for="details_of_works"><b>DETAILS OF WORKS</b></label> <textarea id="details_of_works" name="details_of_works" class="right materialize-textarea" style="width:300px;"><?php echo $_REQUEST['details_of_works'];?></textarea></div></div>
				<div class="row"><div class="col s12 l12 input-field" style="font-size:12px;"><label for="parts_removed"><b>PARTS REMOVED</b></label> <textarea id="parts_removed" name="parts_removed" class="right materialize-textarea" style="width:300px;"><?php echo $_REQUEST['parts_removed'];?></textarea></div></div>
				<div class="row"><div class="col s12 l12 input-field" style="font-size:12px;"><label for="parts_added"><b>PARTS ADDED</b></label> <textarea id="parts_added" name="parts_added" class="right materialize-textarea" style="width:300px;"><?php echo $_REQUEST['parts_added'];?></textarea></div></div>
				<div class="row"><div class="col s12 l12 input-field" style="font-size:12px;"><label for="mileage"><b>MILEAGE</b></label> <input id="mileage" name="mileage" class="right" type="text" value="<?php if($_REQUEST['mileage']==''){echo viewVehicleMilage($_REQUEST["id"]);}else{echo $_REQUEST['mileage'];}?>" style="width:300px;"></div></div>
				<div class="row"><div class="col s12 l12 input-field" style="font-size:12px;"><label for="mechanic"><b>MECHANIC</b></label> <input id="mechanic" name="mechanic" class="right" type="text" value="<?php if($_REQUEST['mechanic']==''){echo viewVehicleMilage($_REQUEST["id"]);}else{echo $_REQUEST['mileage'];}?>" style="width:300px;"></div></div>
				
				<div class="col s12 l12"><div style="margin:5px;  padding:5px; "><input type="submit" class="btn primary orange darken-2" name="submitBtn" value="PROCEED"></div></div>
			
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=='PROCEED' && $err==0)
		{
		?>
			<form action="" method="POST" enctype="multipart/form-data">
			<input name="works_type" type="hidden" value="<?php echo $_REQUEST['works_type'];?>">
			<input name="details_of_works" type="hidden" value="<?php echo $_REQUEST['details_of_works'];?>">
			<input name="parts_removed" type="hidden" value="<?php echo $_REQUEST['parts_removed'];?>">
			<input name="parts_added" type="hidden" value="<?php echo $_REQUEST['parts_added'];?>">
			<input name="mileage" type="hidden" value="<?php echo $_REQUEST['mileage'];?>">
			<input name="mechanic" type="hidden" value="<?php echo $_REQUEST['mechanic'];?>">
			
			<div style="margin:5px;  padding:5px;"><b>VERIFY THE DETAILS YOU ENTERED:</b></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['id'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>WORKS TYPE:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['works_type'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>DETAILS OF WORKS:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['details_of_works'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>PARTS REMOVED:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['parts_removed'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>PARTS ADDED:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['parts_added'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>MILEAGE:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['mileage'];?></div></div>
			<div style="margin:5px;  padding:5px;  width: 93%;"><div style="margin:5px;  padding:5px; font-size:12px;"><b>MECHANIC:</b> </div><div style="margin:5px; float: right; padding:5px; "><?php echo $_REQUEST['mechanic'];?></div></div>
			<div style="margin:5px;  padding:0px; width: 97%;">
				<div style="margin:5px;  padding:5px; "><input type="submit" class="btn primary orange darken-2" name="submitBtn" value="EDIT"></div>
				<div style="margin:5px; float: right; padding:5px; "><button id="submitBtn" class="btn primary organge darken-2" name="submitBtn" onClick="addMaintenanceDetails('<?php echo $_REQUEST['id'];?>','<?php echo $_REQUEST['works_type'];?>','<?php echo $_REQUEST['details_of_works'];?>','<?php echo $_REQUEST['parts_removed'];?>','<?php echo $_REQUEST['parts_added'];?>','<?php echo $_REQUEST['mileage'];?>','<?php echo $_REQUEST['mechanic'];?>')">SUBMIT</button></div>
			</div>
			</form>
			
		<?php
		}
		?>
		</div>
		<?php
	}
	elseif($_REQUEST["type"]=="hireHistory")
	{

		?>
		<div class="col s12 l12 grey lighten-2">
			<strong><u>HIRE HISTORY FOR <?php echo strtoupper($_REQUEST['id']);?></u></strong>
			<?php 
			$orderBy = "id";
			$order="ASC";
			$min=0;
			$max=50;
			
				$cats = listMostRecentVehicleHires($_REQUEST["id"],$orderBy,$order,$min,$max);
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
								<b>RefNo</b><br>
								<?php echo $cats[$a]["RefNo"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>pickup_time</b><br>
								<?php echo $cats[$a]["pickup_time"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>pickup_place</b><br>
								<?php echo $cats[$a]["pickup_place"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>pickUpTown</b><br>
								<?php echo $cats[$a]["pickUpTown"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>date_of_arrival</b><br>
								<?php echo $cats[$a]["date_of_arrival"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>end_date</b><br>
								<?php echo $cats[$a]["end_date"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>dropoff_time</b><br>
								<?php echo $cats[$a]["dropoff_time"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>dropoff_place</b><br>
								<?php echo $cats[$a]["dropoff_place"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>DropOffTown</b><br>
								<?php echo $cats[$a]["DropOffTown"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>DropOffCountry</b><br>
								<?php echo $cats[$a]["DropOffCountry"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>destination</b><br>
								<?php echo $cats[$a]["destination"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>Distance</b><br>
								<?php echo $cats[$a]["Distance"];?>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="col s11 l11 white hoverable z-depth-4" style="margin:5px;">
								<b>dateset</b><br>
								<?php echo $cats[$a]["dateset"];?>
								</div>
							</div>
						</div>
					</div>
					<hr />
					<?php
				}
			?>
		</div>
		<?php
	}
	elseif($_REQUEST["type"]=="price")
	{
		$vehicle = $_SESSION["Vehicle:".$_REQUEST["id"]];
		//print_r($vehicle);
		?>
		<div class="col s12 m6 l5">
			<img src="<?php echo $vehicle["coverimage"];?>" alt="<?php echo $vehicle["vehiclemake"];?>" title="<?php echo $vehicle["vehiclemake"];?>" class="col s12 m12 l12" />
		
			<div class="col s12 l12">
				<span style="padding:2px; font-size:12px;"><b><?php echo $vehicle["vehiclemake"];?>, <?php echo $vehicle["vehicletype"];?> - <?php echo $vehicle["modelyear"];?> model</b></span><br>
				<span style="padding:2px; font-size:12px;"><b><?php echo $vehicle["vehicle_reg"];?></b></span><br>
				<span style="padding:2px; font-size:12px;"><b><?php echo $vehicle["town"];?>,<?php echo $vehicle["province"];?> - <?php echo $vehicle["country"];?></b></span>
			</div>
		</div>
		<div class="col s12  m6 l5">
		<?php
		
		if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_within"]<($vehicle["thirdpartyDues"]["localrate"])))) 
		{
			$error1 = 1;
		}
		else
		{
			$error1 = 0;
		}
		
		if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_within"]>($vehicle["categoryPrices"]["localrate"]))))
		{
			$error2 = 1;
		}
		else
		{
			$error2 = 0;
		}
		
		if($_REQUEST["submitBtn"]=="PROCEED" && $_REQUEST["newfees_outside"]<($vehicle["thirdpartyDues"]["ootrate"]))
		{
			$error3 = 1;
		}
		else
		{
			$error3 = 0;
		}
		
		if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_outside"]>($vehicle["categoryPrices"]["ootrate"]))))
		{
			$error4 = 1;
		}
		else
		{
			$error4 = 0;
		}
		
		if($_REQUEST["submitBtn"]=="PROCEED" && $_REQUEST["newfees_ooc"]<($vehicle["thirdpartyDues"]["oocrate"]))
		{
			$error5 = 1;
		}
		else
		{
			$error5 = 0;
		}
		
		if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_ooc"]>($vehicle["categoryPrices"]["oocrate"]))))
		{
			$error6 = 1;
		}
		else
		{
			$error6 = 0;
		}
		
		$error = $error1+$error2+$error3+$error4+$error5+$error6;
		
		
		if($_REQUEST["submitBtn"]=="")
		{
			if($error>=1)
			{
					?>
					<div style="margin:5px; width:95%; padding:5px; ">
						ERROR!
					</div>
					<?php
				if($error1==1)
				{
					?>
					<div style="margin:5px; width:95%; padding:5px;  font-size:12px;">
						LOCAL RATE CANNOT BE LESS THAN K <?php echo number_format(($vehicle["thirdpartyDues"]["localrate"]),2);?>
					</div>
					<?php
				}
				
				if($error2==1)
				{
					?>
					<div style="margin:5px; width:95%; padding:5px;  font-size:12px;">
						LOCAL RATE CANNOT BE MORE THAN K <?php echo number_format(($vehicle["categoryPrices"]["localrate"]),2);?>
					</div>
					<?php
				}
				
				if($error3==1)
				{
					?>
					<div style="margin:5px; width:95%; padding:5px;  font-size:12px;">
						OUT OF TOWN RATE CANNOT BE LESS THAN K <?php echo number_format(($vehicle["thirdpartyDues"]["ootrate"]),2);?>
					</div>
					<?php
				}
				
				if($error4==1)
				{
					?>
					<div style="margin:5px; width:95%; padding:5px;  font-size:12px;">
						OUT OF TOWN RATE CANNOT BE MORE THAN K <?php echo number_format(($vehicle["categoryPrices"]["ootrate"]),2);?>
					</div>
					<?php
				}
				
				if($error5==1)
				{
					?>
					<div style="margin:5px; width:95%; padding:5px;  font-size:12px;">
						OUT OF TOWN RATE CANNOT BE LESS THAN K <?php echo number_format(($vehicle["thirdpartyDues"]["oocrate"]),2);?>
					</div>
					<?php
				}
				
				if($error6==1)
				{
					?>
					<div style="margin:5px; width:95%; padding:5px;  font-size:12px;">
						OUT OF TOWN RATE CANNOT BE MORE THAN K <?php echo number_format(($vehicle["categoryPrices"]["oocrate"]),2);?>
					</div>
					<?php
				}
			}
		?>
		<form action="" method="POST">
		<input name="location" value="<?php echo $_REQUEST["location"];?>" type="hidden">
			<div class="col s12 l12 grey lighten-2 right" style="margin:5px; padding:5px; font-size:12px;">
				<div class="col s12 l12 grey lighten-2" style="margin:5px; padding:5px; font-size:12px;">
					<div class="col s11 l11 hoverable z-depth-5 white" style="margin:5px; font-size:12px;"><strong>LOCAL RATE: </strong><input type="text" style="width:80px;" value="<?php echo $vehicle["categoryPrices"]["localrate"];?>" name="newfees_within"> <br>Max = <?php echo $vehicle["categoryPrices"]["localrate"];?>, Min = <?php echo $vehicle["thirdpartyDues"]["localrate"];?></div>
					<div class="col s11 l11 hoverable z-depth-5 white" style="margin:5px; font-size:12px;"><strong>OUT OF TOWN RATE: </strong><input type="text" style="width:80px;" value="<?php echo $vehicle["categoryPrices"]["ootrate"];?>" name="newfees_outside"> <br>Max = <?php echo $vehicle["categoryPrices"]["ootrate"];?>, Min = <?php echo $vehicle["thirdpartyDues"]["ootrate"];?></div>
					<div class="col s11 l11 hoverable z-depth-5 white" style="margin:5px; font-size:12px;"><strong>OUT OF COUNTRY RATE: </strong><input type="text" style="width:80px;" value="<?php echo $vehicle["categoryPrices"]["oocrate"];?>" name="newfees_ooc"> <br>Max = <?php echo $vehicle["categoryPrices"]["oocrate"];?>, Min = <?php echo $vehicle["thirdpartyDues"]["oocrate"];?></div>
				</div>
				<div class="col s12 l12" style="margin:5px; padding:5px;">
					<input type="submit" class="btn primary" value="PROCEED" name="submitBtn">
				</div>
			</div>
		</form>
		<?php
		}
		elseif($_REQUEST["submitBtn"]=="PROCEED" && $error==0)
		{
		?>
		<form action="#" method="POST">
			<input name="newfees_within" value="<?php echo $_REQUEST["newfees_within"];?>" type="hidden">
			<input name="newfees_outside" value="<?php echo $_REQUEST["newfees_outside"];?>" type="hidden">
			<input name="newfees_ooc" value="<?php echo $_REQUEST["newfees_ooc"];?>" type="hidden">
			<div class="col s11 l11 grey lighten-2" style="margin:5px; padding:5px; ">
				<div class="col s12 l12">
					<b>Please Review Your New Prices</b>
				</div>
				<div class="col s11 l11" style="margin:5px; padding:5px; font-size:12px;">
					<b>LOCAL RATE: <?php echo number_format($_REQUEST["newfees_within"],2);?></b><br>
					<b>OUT OF TOWN RATE: <?php echo number_format($_REQUEST["newfees_outside"],2);?></b><br>
					<b>OUT OF COUNTRY RATE: <?php echo number_format($_REQUEST["newfees_ooc"],2);?></b>
				</div>
				<div class="col s11 l11" style="margin:5px; padding:5px;">
					<a href="?ref=<?php echo $_REQUEST["ref"];?>&id=<?php echo $_REQUEST["id"];?>&function=<?php echo $_REQUEST["function"];?>&type=<?php echo $_REQUEST["type"];?>&action=<?php echo $_REQUEST["action"];?>" class="btn primary left">CANCEL</a>
					<button onClick="updateVehiclePrices('<?php echo $_REQUEST["id"];?>','<?php echo $_REQUEST["newfees_within"];?>','<?php echo $_REQUEST["newfees_outside"];?>','<?php echo $_REQUEST["newfees_ooc"];?>');" class="btn primary right" id="submitBtn" name="submitBtn">SUBMIT</button>
				</div>
			</div>
		</form>
		<?php
		}
		?>
		</div>
		<?php
	}
	elseif($_REQUEST["type"]=="images")
	{
		
		if($_REQUEST["action"]=="upload")
		{//
		$user = userData();
		
		$GLOBALS["croppieSettings"] = 1;
		$GLOBALS["boundaryWidth"] = 400;
		$GLOBALS["boundaryHeight"] = 350;
		$GLOBALS["croppieWidth"] = 300;
		$GLOBALS["croppieHeight"] = 300;
		$GLOBALS["croppieShape"] = "square";
		$GLOBALS["croppieImageName"] = "rand";
		$GLOBALS["croppieTargetFolder"] ="images";
		$GLOBALS["croppieImageUploader"] = "vehicleImageUploader.php";
		$GLOBALS["croppieCustomOptions"] = "";
		$GLOBALS["croppieCustomData"] = $_REQUEST["id"];
		$GLOBALS["croppieCustomData2"] = uniqueCode();
		
		?>
			<div class="row">
				<div class="col l12">
					<h5 class="page-header"> &nbsp;&nbsp;&nbsp;VEHICLE IMAGES</h5>
				</div>
			</div>
			<div class="row">
			  <!-- start course content -->
				<div class="col l12 m12 s12">
					<div class="croppie_buttons z-depth-4">
						<button id="btnx" class="file-btn hoverable z-depth-4">
							<span>Select Image <i class="material-icons">file_upload</i></span>
							<input type="file" id="upload" value="image" />
						</button>
					</div>
					<div class="col l12 m12 s12">
						<div class="actions col l12 m12 s12">
							<div class="crop col l12 m12 s12">
								<div id="upload-demo" class="col l12 m12 s12"></div>
								<div class="mybuttons">
									<button class="btn vanilla-rotate hoverable z-depth-4" data-deg="90"><i class="material-icons">rotate_left</i></button>
									<button class="btn vanilla-rotate hoverable z-depth-4" data-deg="-90"><i class="material-icons">rotate_right</i></button>
									<button id="btnxx " class="btn upload-result hoverable z-depth-4"><i class="material-icons">save</i></button>
								</div>
							</div>
							<div id="result"></div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		elseif($_REQUEST["action"]=="view")
		{
			$min=0;
			$max=50;
			$imgs = listVPVehicleImages($_REQUEST["id"],"id","DESC",$min,$max);
			
			for($d=0; $d<$imgs[0]['num']; $d++)
			{
				?>
				<div style="margin:5px;  padding:5px; background-color:#000;">
					<img src="images/<?php echo $imgs[$d]['img'];?>" width="300"><br>
					<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST["id"];?>&type=images&imgid=<?php echo $imgs[$d]['id'];?>&action=setcover">SET AS COVER</a> &nbsp;&nbsp;
					<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST["id"];?>&function=delete&type=images&imgid=<?php echo $imgs[$d]['id'];?>&action=delete">DELETE</a> 
				</div>
				<?php
			}
		}
		elseif($_REQUEST["action"]=="setcover")
		{
		?>
		<div style="margin:5px;  padding:5px; background-color:#000;">
			<?php
				if(setVehicleCoverImage($_REQUEST["id"],$_REQUEST["imgid"])==1)
				{
				?>
					<p>SUCCESS! YOU HAVE A NEW COVER IMAGE.</p>
				<?php
				}
				else
				{
				?>
					<p>ERROR! NEW COVER IMAGE HAS NOT BEEN SET.</p>
				<?php
				}
			?>
			<img src="images/<?php echo getVehicleCoverImage($_REQUEST["id"]);?>" width="300">
		</div>
		<?php
		}
		elseif($_REQUEST["action"]=="delete")
		{	
		?>
		<div style=" padding: 5px; width:93%;">
			<div style=" min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; ">
				<?php 
				if($_REQUEST['con']=="Yes")
				{
					if(deleteVehicleImage($_REQUEST['imgid'])==1)
					{
						?>
						<div style="margin:5px;  width:500px;; padding:5px; "><b>IMAGE DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px;  width:500px;; padding:5px; "><b>ERROR! IMAGE NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px;  width:500px;; padding:5px; "><b>ARE YOU SURE YOU WANT TO DELETE THIS IMAGE: <img src="images/<?php echo viewVehicleImage($_REQUEST["imgid"]);?>" width="300" /><?php echo viewVehicle($_REQUEST['id'],"REG NUMBER");?> </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST["id"];?>&function=delete&type=images&imgid=<?php echo $_REQUEST["imgid"];?>&action=delete&con=Yes"><div style="float: right; margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST["id"];?>&function=view&type=images&action=view"><div style="float: right; margin:5px;">NO</div></a></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
		}
	}
	?>
</div>
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