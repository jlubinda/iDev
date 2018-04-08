<?php 
if(chkSes()=="Active")
{
	if($_REQUEST["function"]=="delete" && $_REQUEST["type"]=="vehicle")
	{
		?>
		<div style="float: left; padding: 5px; width:93%;">
			<div style="float: left; min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
				<?php 
				if($_REQUEST['con']=="Yes")
				{
					if(deleteVehicle($_REQUEST['id'])==1)
					{
						?>
						<div style="margin:5px; float: left; width:500px;; padding:5px; background-color:#555;"><b>VEHICLE DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; float: left; width:500px;; padding:5px; background-color:#555;"><b>ERROR! VEHICLE NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; float: left; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE VEHICLE, REGISTRATION NUMBER '<?php echo viewVehicle($_REQUEST['id'],"REG NUMBER");?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&type=vehicle&function=delete&con=Yes"><div style="float: right; margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="float: right; margin:5px;">NO</div></a></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	?>

	<div style="float: left; min-width:280px; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
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
		$userID = $row_sess["userID"];
		
		@$towns = listTowns($userCountry);
			
		if($_REQUEST["type"]=="")
		{
			$cars = listAllVehicles($orderBy,$owner,$order,$min,$max);
			
			for($a=0; $a<$cars[0]['num']; $a++)
			{
				$location = viewVehicle($cars[$a]["id"],"LOCATION");
				//$catImg = $catData
				?>
				<div style="margin:5px; float: left; width:98%; padding:5px;">
					<div style="margin:5px; float: left; width:160px; padding:5px;" class="cube">
						<img src="images/<?php echo  getVehicleCoverImage($cars[$a]['id']);?>" alt="<?php echo $cars[$a]['name'];?>" title="<?php echo $cars[$a]['name'];?>" width="99%" />
					</div>
					<div style="margin:5px; float: left; padding:3px; background-color:#555; border-radius:4px; color:#fff; max-width:600px;">
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px;"><b><?php echo getVehicleCategory($cars[$a]["type"]);?></b></div>
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px;"><b><?php echo $cars[$a]["make"];?></b></div>
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px;"><b><?php echo $cars[$a]["year"];?> model</b></div>
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px;"><b><?php echo $cars[$a]["reg"];?></b></div>
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px;"><b><?php echo getTown($cars[$a]["location"]);?> - <?php echo getTown($cars[$a]["location"],"COUNTRY");?></b></div>
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px;"><b>LAST RECORDED MILEAGE: <?php echo viewVehicleMilage($cars[$a]['id']);?></b></div>
						<div style="margin:3px; margin-right:8px; float: left; padding:2px; font-size:12px; width:90%; max-width:600px;">
							<h3 style='font-size:11px;'>K<?php echo number_format(getActualPrice($cars[$a]["id"],"WITHIN"),2);?> / day (Local Rate) <span style="font-size:11px; float:right;">FEES DUE TO YOU ON LOCAL HIRE: K<?php echo number_format(getFeesPayable($cars[$a]["id"],"WITHIN"),2);?> / day</span></h3>
							<h3 style='font-size:11px;'>K<?php echo number_format(getActualPrice($cars[$a]["id"],"OUT OF TOWN"),2);?> / day (Out Of Town Rate) <span style="font-size:11px; float:right;">FEES DUE TO YOU ON OUT OF TOWN HIRE: K<?php echo number_format(getFeesPayable($cars[$a]["id"],"OUT OF TOWN"),2);?> / day</span></h3>
						</div>
					</div>
					<div style="margin:5px; float: left; padding:1px;">
						<a class="button2" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&function=edit&type=price&action=adjust"><span style="font-size:11px;">ADJUST PRICE</span></a>
						<a class="button2" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&function=edit&type=vehicle"><span style="font-size:11px;">EDIT DETAILS</span></a>
						<a class="button2" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&function=add&type=mileage"><span style="font-size:11px;">UPDATE MILEAGE</span></a>
						<a class="button2" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&function=add&type=images&action=upload"><span style="font-size:11px;">ADD IMAGE</span></a>
						<a class="button2" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&function=view&type=images&action=view"><span style="font-size:11px;">VIEW IMAGES</span></a>
						<a class="button2" href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&function=delete&type=vehicle"><span style="font-size:11px;">DELETE</span></a>
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
				<div style="float: left; min-width:280px; max-width: 600px; background-color:#222; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
					<?php 
					if($err>=1)
					{
						?>
					
					<div style="margin:5px; float: left; padding:5px;"><b>ERROR! SOME DETAILS ARE MISSING. PLEASE FILL ALL FIELDS.</b></div>	
						<?php
					}
					?>
					<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>MODEL:</b> </div><div style="float: right;"><input name="model" type="text" size="30" value="<?php if($_REQUEST['model']==''){echo viewVehicle($_REQUEST["id"],"MAKE");}else{echo $_REQUEST['model'];}?>" placeholder="e.g. Toyota Corolla"></div></div>
					<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>MODEL YEAR:</b> </div><div style="float: right;"><input name="yearmake" type="text" size="30" value="<?php if($_REQUEST['yearmake']==''){echo viewVehicle($_REQUEST["id"],"YEAR");}else{echo $_REQUEST['yearmake'];} ?>" placeholder="e.g. 2005"></div></div>
					<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>CATEGORY:</b> </div><div style="float: right;"><select name="catname">
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
					<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>REGISTRATION NUMBER:</b> </div><div style="float: right;"><input name="regnumber" type="text" value="<?php if($_REQUEST['regnumber']==''){echo viewVehicle($_REQUEST["id"],"REG NUMBER");}else{echo $_REQUEST['regnumber'];}?>" size="15"></div></div>
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
				<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['regnumber'];?></div></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>TOWN:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['town'];?></div></div>
				<div style="margin:5px; float: left; padding:0px; width: 97%;">
					<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="EDIT"></div>
					<div style="margin:5px; float: right; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="SUBMIT"></div>
				</div>
				</form>
			</div>
			<?php
			}
			elseif($_REQUEST["submitBtn"]=='SUBMIT')
			{
				echo '<div style="float: left; min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
				
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
			<div style="float: left; min-width:280px; max-width: 350px; background-color:#000; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
				<div style="margin:5px; float: left; padding:5px; background-color:#222 width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#000;"><?php echo viewVehicle($_REQUEST["id"],"REG NUMBER");?></div></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#222; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>MILEAGE:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#000;"><?php echo viewVehicleMilage($_REQUEST["id"]);?></div></div>
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
				<div style="float: left; min-width:280px; max-width: 600px; background-color:#222; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
					<?php 
					if($err>=1)
					{
						?>
						<div style="margin:5px; float: left; padding:5px;"><b>ERROR! MILEAGE FIELD IS EMPTY. PLEASE FILL IT IN BEFORE YOU PROCEED.</b></div>	
						<?php
					}
					?>
					<div style="margin:5px; float: left; padding:5px; background-color:#444; width:93%;"><div style="float: left; padding:7px;"><b>MILEAGE:</b> </div><div style="float: right;"><input name="mileage" type="text" value="<?php if($_REQUEST['mileage']==''){echo viewVehicleMilage($_REQUEST["id"]);}else{echo $_REQUEST['mileage'];}?>" size="15"></div></div>

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
				<input name="mileage" type="hidden" value="<?php echo $_REQUEST['mileage'];?>">
				
				<div style="margin:5px; float: left; padding:5px;"><b>VERIFY THE DETAILS YOU ENTERED:</b></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>REGISTRATION NUMBER:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo viewVehicle($_REQUEST["id"],"REG NUMBER");?></div></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#444; width: 93%;"><div style="margin:5px; float: left; padding:5px;"><b>MILEAGE:</b> </div><div style="margin:5px; float: right; padding:5px; background-color:#222;"><?php echo $_REQUEST['mileage'];?></div></div>
				<div style="margin:5px; float: left; padding:0px; width: 97%;">
					<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="EDIT"></div>
					<div style="margin:5px; float: right; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="SUBMIT"></div>
				</div>
				</form>
			</div>
			<?php
			}
			elseif($_REQUEST["submitBtn"]=='SUBMIT')
			{
				echo '<div style="float: left; min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
				
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
		elseif($_REQUEST["type"]=="price")
		{
			?>
			<div style="margin:5px; float: left; width:160px; padding:5px;" class="cube">
				<img src="images/<?php echo  getVehicleCoverImage($_REQUEST["id"]);?>" alt="<?php echo viewVehicle($_REQUEST["id"],"MAKE");?>" title="<?php echo viewVehicle($_REQUEST["id"],"MAKE");?>" width="99%" />
			
				<div style="margin:5px; float: left; padding:3px; background-color:#fff; border-radius:4px; color:#000;">
					<span style="padding:2px; font-size:12px;"><b><?php echo getVehicleCategory(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"));?></b></span><br>
					<span style="padding:2px; font-size:12px;"><b><?php echo viewVehicle($_REQUEST["id"],"MAKE");?></b></span><br>
					<span style="padding:2px; font-size:12px;"><b><?php echo viewVehicle($_REQUEST["id"],"YEAR");?> model</b></span><br>
					<span style="padding:2px; font-size:12px;"><b><?php echo viewVehicle($_REQUEST["id"],"REG NUMBER");?></b></span><br>
					<span style="padding:2px; font-size:12px;"><b><?php echo getTown(viewVehicle($_REQUEST["id"],"LOCATION"));?> - <?php echo getTown(viewVehicle($_REQUEST["id"],"LOCATION"),"COUNTRY");?></b></span>
				</div>
			</div>
			<div style="margin:5px; float: left; padding:5px;" class="cube">
			<form action="" method="POST">
			<?php
			
			if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_within"]<(getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN"))))) 
			{
				$error1 = 1;
			}
			else
			{
				$error1 = 0;
			}
			
			if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_within"]>(getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN")))))
			{
				$error2 = 1;
			}
			else
			{
				$error2 = 0;
			}
			
			if($_REQUEST["submitBtn"]=="PROCEED" && $_REQUEST["newfees_outside"]<(getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE")))
			{
				$error3 = 1;
			}
			else
			{
				$error3 = 0;
			}
			
			if(($_REQUEST["submitBtn"]=="PROCEED" && ($_REQUEST["newfees_outside"]>(getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE")))))
			{
				$error4 = 1;
			}
			else
			{
				$error4 = 0;
			}
			
			$error = $error1+$error2+$error3+$error4;
			
			
			if($_REQUEST["submitBtn"]=="")
			{
				if($error>=1)
				{
						?>
						<div style="margin:5px; width:95%; padding:5px; background-color:#222;">
							ERROR!
						</div>
						<?php
					if($error1==1)
					{
						?>
						<div style="margin:5px; width:95%; padding:5px; background-color:#222; font-size:11px;">
							LOCAL RATE CANNOT BE LESS THAN K <?php echo number_format((getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN")),2);?>
						</div>
						<?php
					}
					
					if($error2==1)
					{
						?>
						<div style="margin:5px; width:95%; padding:5px; background-color:#222; font-size:11px;">
							LOCAL RATE CANNOT BE MORE THAN K <?php echo number_format((getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN")),2);?>
						</div>
						<?php
					}
					
					if($error3==1)
					{
						?>
						<div style="margin:5px; width:95%; padding:5px; background-color:#222; font-size:11px;">
							OUT OF TOWN RATE CANNOT BE LESS THAN K <?php echo number_format((getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE")),2);?>
						</div>
						<?php
					}
					
					if($error4==1)
					{
						?>
						<div style="margin:5px; width:95%; padding:5px; background-color:#222; font-size:11px;">
							OUT OF TOWN RATE CANNOT BE MORE THAN K <?php echo number_format((getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE")),2);?>
						</div>
						<?php
					}
				}
			?>
			<input name="location" value="<?php echo $_REQUEST["location"];?>" type="hidden">
				<div style="margin:5px; width:250px; padding:5px; font-size:12px;">
					<strong>LOCAL RATE: </strong><input type="text" style="width:80px;" value="<?php echo getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN");?>" name="newfees_within"> <br>(Maximum acceptable price is <?php echo getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN");?>, Minimum accepted price is <?php echo getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN");?>).
					<br><br><strong>OUT OF TOWN RATE: </strong><input type="text" style="width:80px;" value="<?php echo getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE");?>" name="newfees_outside"> <br>(Maximum acceptable price is <?php echo getCategoryPrice(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE");?>, Minimum accepted price is <?php echo getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE");?>).
				</div>
				<div style="margin:5px; width:150px; padding:5px;">
					<input type="submit" value="PROCEED" name="submitBtn" class="button">
				</div>
			<?php
			}
			elseif($_REQUEST["submitBtn"]=="PROCEED" && $error==0)
			{
			?>
			<input name="newfees_within" value="<?php echo $_REQUEST["newfees_within"];?>" type="hidden">
			<input name="newfees_outside" value="<?php echo $_REQUEST["newfees_outside"];?>" type="hidden">
			<div style="margin:5px; padding:5px; background-color:#555;">
				<div style="margin:5px; padding:5px;">
					<b>FEES WITHIN: <?php echo number_format($_REQUEST["newfees_within"],2);?></b><br>
					<b>FEES OUTSIDE: <?php echo number_format($_REQUEST["newfees_outside"],2);?></b>
				</div>
				<div style="margin:5px; padding:5px;">
					<input type="submit" value="SUBMIT" name="submitBtn" class="button">
				</div>
			</div>
			<?php
			}
			elseif($_REQUEST["submitBtn"]=="SUBMIT")
			{
				$fees_within = $_REQUEST["newfees_within"] - getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"WITHIN");
				$fees_outside = $_REQUEST["newfees_outside"] - getCommision(viewVehicle($_REQUEST["id"],"VEHICLE TYPE"),viewVehicle($_REQUEST["id"],"LOCATION"),"OUTSIDE");
				
				if(addFeesPayable($_REQUEST["id"],$fees_within,$fees_outside,viewVehicle($_REQUEST["id"],"LOCATION"))==1)
				{
					?>
					<div style="margin:5px; width:150px; padding:5px; background-color:#222;">
						SUCCESS!
					</div>
					<?php
				}
				else
				{
					?>
					<div style="margin:5px; width:150px; padding:5px; background-color:#222;">
						ERROR!
					</div>
					<?php
				}
			}
			?>
			</form>
			</div>
			<?php
		}
		elseif($_REQUEST["type"]=="images")
		{
			
			if($_REQUEST["action"]=="upload")
			{//
			$imgVar = "image";
			$target_folder = "images/";
			
				if($_REQUEST["submitBtn"]=="")
				{
				?>
				<form action="" method="POST" enctype="multipart/form-data">
					<div style="margin:5px; float: left; padding:5px; background-color:#555;">
						<div style="margin:5px; float: left; width:300px; padding:5px; background-color:#333;">
							<div style="margin:5px; float: left; width:93%; padding:5px; background-color:#222;"><div style="float: left; margin:1px; padding:9px;"><b>IMAGE:</b> </div><div style="float: left; margin:7px;"><input type="file" name=<?php echo $imgVar;?>  accept="image/jpeg,png" style="color:#000; background-color:#fff; border-color:#fff;"></div><input name="submitBtn" value="UPLOAD" type="submit" style="float:left; margin:5px;"></div>
						</div>
					</div>
				</form>
				<?php
				}
				elseif($_REQUEST["submitBtn"]=="UPLOAD")
				{
					$imagex = upload($imgVar,$target_folder,"","AUTO");
					rescaleImageByWidth("images/".$imagex,600);
					
					
					if(!($imagex==0))
					{
						$uploadx = addVehicleImage($_REQUEST["id"],$imagex);
						
						if(checkVehicleCoverImageExists($_REQUEST["id"])==0)
						{
							setVehicleCoverImage($_REQUEST["id"],$uploadx);
						}
					?>
						<div style="margin:5px; float: left; padding:5px; background-color:#555;">
							<div style="margin:5px; float: left; width:300px; padding:5px; background-color:#333;">
								SUCCESS!<br><img src="<?php echo $target_folder.$imagex;?>" width="99%">
							</div>
							<a class="button" href="?ref=<?php echo $_REQUEST['ref']; ?>">MORE OPTIONS</a>
						</div>
					<?php
					}
					else
					{
					?>
						<div style="margin:5px; float: left; padding:5px; background-color:#555;">
							<div style="margin:5px; float: left; width:300px; padding:5px; background-color:#333;">
								ERROR UPLOADING FILE. PLEASE TRY AGAIN LATER.
							</div>
						</div>
					<?php
					}
				}
			}
			elseif($_REQUEST["action"]=="view")
			{
				$imgs = listImages($_REQUEST["id"]);
				
				for($d=0; $d<$imgs[0]['num']; $d++)
				{
					?>
					<div style="margin:5px; float: left; padding:5px; background-color:#000;">
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
			<div style="margin:5px; float: left; padding:5px; background-color:#000;">
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
			<div style="float: left; padding: 5px; width:93%;">
				<div style="float: left; min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
					<?php 
					if($_REQUEST['con']=="Yes")
					{
						if(deleteVehicleImage($_REQUEST['imgid'])==1)
						{
							?>
							<div style="margin:5px; float: left; width:500px;; padding:5px; background-color:#555;"><b>IMAGE DELETED</b></div>
							<?php
						}
						else
						{
							?>
							<div style="margin:5px; float: left; width:500px;; padding:5px; background-color:#555;"><b>ERROR! IMAGE NOT DELETED</b></div>
							<?php
						}
					}
					else
					{
						?>
						<div style="margin:5px; float: left; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THIS IMAGE: <img src="images/<?php echo viewVehicleImage($_REQUEST["imgid"]);?>" width="300" /><?php echo viewVehicle($_REQUEST['id'],"REG NUMBER");?> </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST["id"];?>&function=delete&type=images&imgid=<?php echo $_REQUEST["imgid"];?>&action=delete&con=Yes"><div style="float: right; margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST["id"];?>&function=view&type=images&action=view"><div style="float: right; margin:5px;">NO</div></a></div>
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
	include find_file("login.php");
}
?>