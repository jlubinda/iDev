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

			<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<form action="" method="POST" enctype="multipart/form-data">	
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>VEHICLE CATEGORY:</b> </div>
			  <div style="float: right;">
				<select name="cattype">
					<?php
					$cats = listVehicleCategories();
					
					for($a=0; $a<$cats[0]["num"]; $a++)
					{
					?>
					<option value='<?php echo $cats[$a]["id"];?>'><?php echo $cats[$a]["name"];?></option>
					<?php 
					}
					?>
				</select>
			  </div>
			</div>	
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>FUEL:</b> </div>
			  <div style="float: right;">
				<select name="fueltype">
				  <option value='PETROL'>PETROL</option>
				  <option value='DIESEL'>DIESEL</option>
				  <option value='HYBRID'>HYBRID</option>
				  <option value='ELECTRIC'>ELECTRIC</option>
				  <option value='OTHER'>OTHER</option>
				</select>
			  </div>
			</div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addVehicleCategoryFuelType($_REQUEST["cattype"],$_REQUEST["fueltype"])=="1")
			{
				echo "SUCCESS! FUEL TYPE TO VEHICLE TYPE BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING FUEL TYPE TO VEHICLE TYPE.<br><br>";
			}
			echo '</div>';
		}
		
		
	?>
	</div>
	<div style="width:60%; min-width: 320px;">
		<div style="min-width:280px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
			<?php
				$cats2 = listVehicleCategories();
				
				for($a2=0; $a2<$cats2[0]['num']; $a2++)
				{
					?>
					<div style="padding:7px; background-color:#222;"><strong><?php echo $cats2[$a2]["name"];?>: <?php echo getVehicleCategoryFuelType($cats2[$a2]["id"]);?></strong></div>
					<?php
				}
			?>
			</div>
		</div>
	</div>
		</div>
	</div>
	<?php
	}
router(array("FOOTER","website"),"","",'','','file','');
?>