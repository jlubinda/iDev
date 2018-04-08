<?php
router(array("HEADER","website"),"","",'','','file','');

	if(@ privacy('Secure|Priv')=='Granted')
	{
	?>
	<div class="row">
		<div class="col s12 m4 l5">
		<?php 
			mysidebar();
			include find_file("apps/admin/layouts/pages/adminnav.php");
		?>
		</div>
		<div class="col s12 m4 l5">
	<div style="padding: 5px;">
	<?php 

	if($_REQUEST["function"]=="edit")
	{
		?>
		<div style="padding: 5px; width:93%;">
			<a href="?ref=<?php echo $_REQUEST["ref"];?>">
				<div style="margin:5px; padding:5px;" class="button">
					INSPECT ANOTHER VEHICLE
				</div>
			</a>
			<div style="min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">

			<div style="margin:5px; width:202px; padding:5px;" class="cube">
				<img src="images/<?php echo  getVehicleCoverImage($_REQUEST["id"]);?>" alt="<?php echo viewVehicle($_REQUEST["id"],"MAKE");?>" title="<?php echo viewVehicle($_REQUEST["id"],"MAKE");?>" width="200" />
			</div>
			<div style="margin:5px; padding:3px; background-color:#555; border-radius:4px; color:#fff; width:270px;">
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo getVehicleCategory(viewVehicle($_REQUEST["id"],"TYPE"));?></b></div>
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo viewVehicle($_REQUEST["id"],"MAKE");?></b></div>
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo viewVehicle($_REQUEST["id"],"YEAR");?> model</b></div>
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo viewVehicle($_REQUEST["id"],"REG NUMBER");?></b></div>
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo getTown(viewVehicle($_REQUEST["id"],"LOCATION"));?> - <?php echo getTown(viewVehicle($_REQUEST["id"],"LOCATION"),"COUNTRY");?></b></div>
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b>FUEL CONSUMPTION RATE: <?php echo viewVehicle($_REQUEST["id"],"FUEL CONSUMPTION RATE");?>/litre</b> (distance/litre)</div>
				<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b>FUEL TYPE: <?php echo viewVehicle($_REQUEST["id"],"FUEL TYPE");?></b></div>
			</div>
				<?php 
				if($_REQUEST['submitBtn']=="SUBMIT")
				{
				
				
				echo "INPUTS: ".$_REQUEST['id']." ".$_REQUEST['catname']." ".$_REQUEST['model']." ".$_REQUEST['yearmake']." ".$_REQUEST['regnumber']." ".$_REQUEST['town']." ".$_REQUEST['conrate']." ".$_REQUEST['fueltype']."<br>";
				
					editVehicle($_REQUEST['id'],$_REQUEST['catname'],$_REQUEST['model'],$_REQUEST['yearmake'],$_REQUEST['regnumber'],$_REQUEST['town'],$_REQUEST['conrate'],$_REQUEST['fueltype']);
					
					if(vehicleInspection($_REQUEST['id'],$_REQUEST['con'],$_REQUEST['engine'],$_REQUEST['engine_comments'],$_REQUEST['drive_experience'],$_REQUEST['drive_experience_comments'],$_REQUEST['interior_appearance'],$_REQUEST['interior_appearance_comments'],$_REQUEST['exterior_appearance'],$_REQUEST['exterior_appearance_comments'],$_REQUEST['road_tax_license'],$_REQUEST['road_tax_license_comments'],$_REQUEST['road_fitness_license'],$_REQUEST['road_fitness_license_comments'],$_REQUEST['insurance_type'],$_REQUEST['insurance_type_comments'],$_REQUEST['condition_of_tyres'],$_REQUEST['condition_of_tyres_comments'],$_REQUEST['tools_jack'],$_REQUEST['tools_wheel_spanner'],$_REQUEST['tools_winder'],$_REQUEST['tools_lockernut'],$_REQUEST['tools_sparewheel'],$_REQUEST['tools_comments'])==1)
					{
						if($_REQUEST['con']=="ACTIVE")
						{
							$sttsmsg = "APPROVED";
						}
						elseif($_REQUEST['con']=="DISAPPROVED")
						{
							$sttsmsg = "DISAPPROVED";
						}
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>VEHICLE HAS BEEN <?php echo $sttsmsg;?>.</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ERROR! INSPECTION REPORT NOT SUBMITTED.</b></div>
						<?php
					}
				}
				else
				{
					?>
					<form action="" method="POST">
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;">
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>MODEL:</b> </div><div style="float: right;"><input name="model" type="text" size="30" value="<?php if($_REQUEST['model']==''){echo viewVehicle($_REQUEST["id"],"MAKE");}else{echo $_REQUEST['model'];}?>" placeholder="e.g. Toyota Corolla"></div></div>
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>MODEL YEAR:</b> </div><div style="float: right;"><input name="yearmake" type="text" size="30" value="<?php if($_REQUEST['yearmake']==''){echo viewVehicle($_REQUEST["id"],"YEAR");}else{echo $_REQUEST['yearmake'];} ?>" placeholder="e.g. 2005"></div></div>
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>CATEGORY:</b> </div><div style="float: right;"><select name="catname">
							<?php
								$cats = listVehicleCategories();
								
								for($a=0; $a<$cats[0]['num']; $a++)
								{
									if($_REQUEST['catname']=="")
									{
										if(viewVehicle($_REQUEST["id"],"TYPE")==$cats[$a]["id"])
										{
											?>
											<option value='<?php echo $cats[$a]["id"];?>' selected><?php echo $cats[$a]["name"];?></option>
											<?php
										}
										else
										{
											?>
											<option value='<?php echo $cats[$a]["id"];?>'><?php echo $cats[$a]["name"];?></option>
											<?php
										}
									}
									else
									{
										if($_REQUEST['catname']==$cats[$a]["id"])
										{
											?>
											<option value='<?php echo $cats[$a]["id"];?>' selected><?php echo $cats[$a]["name"];?></option>
											<?php
										}
										else
										{
											?>
											<option value='<?php echo $cats[$a]["id"];?>'><?php echo $cats[$a]["name"];?></option>
											<?php
										}
									}
								}
								?>
							</select></div></div>
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>REGISTRATION NUMBER:</b> </div><div style="float: right;"><input name="regnumber" type="text" value="<?php if($_REQUEST['regnumber']==''){echo viewVehicle($_REQUEST["id"],"REG NUMBER");}else{echo $_REQUEST['regnumber'];}?>" size="15"></div></div>
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>TOWN:</b> </div><div style="float: right;"><select name="town">
							<?php
							
								@$towns = listTowns(getTown(viewVehicle($_REQUEST["id"],"LOCATION"),"COUNTRY"));
								
								for($ac=0; $ac<$towns[0]['num']; $ac++)
								{
									if($_REQUEST['town']=="")
									{
										if(viewVehicle($_REQUEST["id"],"LOCATION")==$towns[$ac]["id"])
										{									
											?>
											<option value='<?php echo $towns[$ac]["id"];?>' selected><?php echo $towns[$ac]["name"];?></option>
											<?php

										}
										else
										{									
											?>
											<option value='<?php echo $towns[$ac]["id"];?>'><?php echo $towns[$ac]["name"];?></option>
											<?php

										}
									}
									else
									{
										if(viewVehicle($_REQUEST["id"],"LOCATION")==$_REQUEST['town'])
										{									
											?>
											<option value='<?php echo $towns[$ac]["id"];?>' selected><?php echo $towns[$ac]["name"];?></option>
											<?php

										}
										else
										{									
											?>
											<option value='<?php echo $towns[$ac]["id"];?>'><?php echo $towns[$ac]["name"];?></option>
											<?php

										}
									}
								}
								?>
							</select></div>
							</div>
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>FUEL CONSUMPTION RATE:</b> </div><div style="float: right;"><input name="conrate" type="text" value="<?php if($_REQUEST['conrate']==''){echo viewVehicle($_REQUEST["id"],"FUEL CONSUMPTION RATE");}else{echo $_REQUEST['conrate'];}?>" size="15"></div></div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>FUEL TYPE:</b> </div><div style="float: right;">
								<select name="fueltype">
								  <option value='PETROL'>PETROL</option>
								  <option value='DIESEL'>DIESEL</option>
								  <option value='HYBRID'>HYBRID</option>
								  <option value='ELECTRIC'>ELECTRIC</option>
								  <option value='OTHER'>OTHER</option>
								</select>
							</div></div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>ENGINE STATE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">GOOD: <input name="engine" type="radio" value="GOOD" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">BAD: <input name="engine" type="radio" value="BAD" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="engine_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>DRIVE EXPERIENCE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">GOOD: <input name="drive_experience" type="radio" value="GOOD" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">BAD: <input name="drive_experience" type="radio" value="BAD" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="drive_experience_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div> 
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>INTERIOR APPEARANCE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">GOOD: <input name="interior_appearance" type="radio" value="GOOD" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">BAD: <input name="interior_appearance" type="radio" value="BAD" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="interior_appearance_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>EXTERIOR APPEARANCE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">GOOD: <input name="exterior_appearance" type="radio" value="GOOD" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">BAD: <input name="exterior_appearance" type="radio" value="BAD" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="exterior_appearance_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>ROAD TAX LICENSE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">UP TO DATE: <input name="road_tax_license" type="radio" value="UP TO DATE" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">EXPIRED: <input name="road_tax_license" type="radio" value="EXPIRED" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="road_tax_license_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>ROAD FITNESS LICENSE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">UP TO DATE: <input name="road_fitness_license" type="radio" value="UP TO DATE" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">EXPIRED: <input name="road_fitness_license" type="radio" value="EXPIRED" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="road_fitness_license_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>INSURANCE TYPE</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">COMPREHENSIVE: <input name="insurance_type" type="radio" value="COMPREHENSIVE" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">THIRD PARTY: <input name="insurance_type" type="radio" value="THIRD PARTY" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">NIL: <input name="insurance_type" type="radio" value="NIL" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="insurance_type_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>CONDITION OF TYRES</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">GOOD: <input name="condition_of_tyres" type="radio" value="GOOD" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">AVERAGE: <input name="condition_of_tyres" type="radio" value="AVERAGE" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">BAD: <input name="condition_of_tyres" type="radio" value="BAD" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="condition_of_tyres_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
							<u><strong>TOOLS</strong></u><br>
								<div style="padding:7px; width:93%;">
									<label style="background-color:#000; padding:4px; margin:4px;">JACK: <input name="tools_jack" type="checkbox" value="PRESENT" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">WHEEL SPANNER: <input name="tools_wheel_spanner" type="checkbox" value="PRESENT" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">WINDER: <input name="tools_winder" type="checkbox" value="PRESENT" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">LOCKER NUT: <input name="tools_lockernut" type="checkbox" value="PRESENT" style="width: 12px; height: 12px;"></label>
									<label style="background-color:#000; padding:4px; margin:4px;">SPARE WHEEL: <input name="tools_sparewheel" type="checkbox" value="PRESENT" style="width: 12px; height: 12px;"></label>
								</div>
								<div style="padding:7px;"><b>COMMENTS:</b> </div><div style="float: right;"><input name="tools_comments" type="text" size="30" value="<?php echo $_REQUEST['modelcomments']; ?>"></div>
							</div>
							
							<div style="padding:7px; width:93%;">
								<label style="background-color:#000; padding:4px; margin:4px;">PASS: <input name="con" type="radio" value="ACTIVE" style="width: 12px; height: 12px;"></label>
								<label style="background-color:#000; padding:4px; margin:4px;">FAIL: <input name="con" type="radio" value="DISAPPROVED" style="width: 12px; height: 12px;"></label>
							</div>
							
							<div style="padding:7px; width:93%;">
								<label style="background-color:#000; padding:4px; margin:4px;" class="button"><input name="submitBtn" type="submit" value="SUBMIT"></label>
							</div>
						</div>
					</form>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	?>
	</div>

	<?php 
	if($_REQUEST["id"]=="")
	{
		?>
		<div style="margin:5px; width:70%; padding:5px; background-color:#555;">
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&searchType=ACTIVE"><div style="margin:5px; width:60px; padding:5px; color:#000; background-color:#fff;">ACTIVE</div></a>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&searchType=INACTIVE"><div style="margin:5px; width:80px; padding:5px; color:#000; background-color:#fff;">INACTIVE</div></a>
			<a href="?ref=<?php echo $_REQUEST['ref']; ?>&searchType=DISAPPROVED"><div style="margin:5px; width:120px; padding:5px; color:#000; background-color:#fff;">DISAPPROVED</div></a>
		</div>
		<?php
		if($_REQUEST['searchType']=="")
		{
			$searchType = "INACTIVE";
		}
		else
		{
			$searchType = $_REQUEST['searchType'];
		}
		
		$cars = listVehicles("","","",$searchType);
		

		for($a=0; $a<$cars[0]['num']; $a++)
		{
			?>
			<div style="margin:5px; width:300px;; padding:5px; background-color:#555;">
				<div style="margin:5px; width:100px; padding:5px;" class="cube">
					<img src="images/<?php echo  getVehicleCoverImage($cars[$a]['id']);?>" alt="<?php echo $cars[$a]['name'];?>" title="<?php echo $cars[$a]['name'];?>" width="99%" />
				</div>
				<div style="margin:5px; padding:3px; background-color:#555; border-radius:4px; color:#fff;">
					<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo getVehicleCategory($cars[$a]["type"]);?></b></div>
					<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo $cars[$a]["make"];?></b></div>
					<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo $cars[$a]["year"];?> model</b></div>
					<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo $cars[$a]["reg"];?></b></div>
					<div style="margin:3px; margin-right:8px; padding:2px; font-size:12px;"><b><?php echo getTown($cars[$a]["location"]);?> - <?php echo getTown($cars[$a]["location"],"COUNTRY");?></b></div>
				</div>
				
				<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cars[$a]['id'];?>&ctype=<?php echo $cars[$a]['type'];?>&location=<?php echo $cars[$a]['location'];?>&function=edit"><div style="margin:5px;" class="button2">INSPECT</div></a>
			</div>
			<?php
		}
	}
	?>
		</div>
	</div>
	<?php
	}
router(array("FOOTER","website"),"","",'','','file','');
?>