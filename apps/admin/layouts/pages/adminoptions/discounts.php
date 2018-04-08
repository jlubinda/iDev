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
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>VEHICLE TYPE:</b> </div>
				<div style="float: right;">
					<select name="cattype">
					<?php
						$cats = listVehicleCategories();
						
						for($a=0; $a<$cats[0]['num']; $a++)
						{
							?>
							<option value='<?php echo $cats[$a]["id"];?>'><?php echo $cats[$a]["name"];?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
				<div style="padding:7px;"><b>DISCOUNT TYPE:</b> </div>
				<div style="float: right;">
					<select name="discountType">
						<option value='PERCENTAGE'>PERCENTAGE</option>
						<option value='AMOUNT'>AMOUNT</option>
					</select>
				</div>
			</div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>AMOUNT:</b> </div><div style="float: right;"><input name="amount" type="text" size="30" /></div></div> 
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
				<div style="padding:7px;"><b>APPLICABLE CURRENCY:</b> </div>
				<div style="float: right;">
					<select name="currency">
						<option value='ALL'>ALL</option>
						<option value='ZMW'>ZMW</option>
						<option value='USD'>USD</option>
					</select>
				</div>
			</div> 
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
				<div style="padding:7px;"><b>VALID FROM:</b> </div>
				<div style="float: right;">
					<input name="validFrom" type="text" id="item1_pickUpDateTime">
				</div>
			</div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
				<div style="padding:7px;"><b>VALID TO:</b> </div>
				<div style="float: right;">
					<input name="validTo" type="text" id="item1_DropOffDateTime">
				</div>
			</div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addDiscounts($_REQUEST["cattype"],$_REQUEST["discountType"],$_REQUEST["amount"],$_REQUEST["currency"],$_REQUEST["validFrom"],$_REQUEST["validTo"])>="1")
			{
				echo "SUCCESS! DISCOUNT HAS BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING DISCOUNT.<br><br>";
			}
			echo '</div>';
		}
		
		
		
		if($_REQUEST["vstatus"]=='ACTIVATE')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(activateDiscount($_REQUEST["id"])>="1")
			{
				echo "SUCCESS! DISCOUNT HAS BEEN ACTIVATED.<br><br>";
			}
			else
			{
				echo "ERROR ACTIVATING DISCOUNT.<br><br>";
			}
			echo '</div>';
		}
		
		
		
		if($_REQUEST["vstatus"]=='DEACTIVATE')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(deactivateDiscount($_REQUEST["id"])>="1")
			{
				echo "SUCCESS! DISCOUNT HAS BEEN DEACTIVATED.<br><br>";
			}
			else
			{
				echo "ERROR DEACTIVATING DISCOUNT.<br><br>";
			}
			echo '</div>';
		}
	?>
	</div>
	<div style="min-width: 320px;">
		<div style="min-width:280px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;">
			<?php
				$cats3 = listDiscounts();
				
				for($a3=0; $a3<$cats3[0]['num']; $a3++)
				{
					if($cats3[$a3]['status']=="ACTIVE")
					{
						$vstatus = "DEACTIVATE";
					}
					else
					{
						$vstatus = "ACTIVATE";
					}
					
					?>
					<div style="padding:7px; background-color:#222;"><strong>CATEGORY: <?php echo getVehicleCategory($cats3[$a3]["cattype"]);?></strong></div>
					<div style="padding:7px; background-color:#222;"><strong>DISCOUNT TYPE: <?php echo $cats3[$a3]["discount_type"];?></strong></div>
					<div style="padding:7px; background-color:#222;"><strong>AMOUNT: <?php echo $cats3[$a3]["amount"];?></strong></div>
					<div style="padding:7px; background-color:#222;"><strong>APPLICABLE CURRENCY: <?php echo $cats3[$a3]["currency"];?></strong></div>
					<div style="padding:7px; background-color:#222;"><strong>VALID FROM: <?php echo date("d-m-Y @ H:i",$cats3[$a3]["from"]);?>hrs</strong></div>
					<div style="padding:7px; background-color:#222;"><strong>VALID TO: <?php echo date("d-m-Y @ H:i",$cats3[$a3]["to"]);?>hrs</strong></div>
					<a href="./?ref=<?php echo $_REQUEST["ref"]?>&id=<?php echo $cats3[$a3]['id'];?>&vstatus=<?php echo $vstatus;?>"><div style="padding:7px; background-color:#ccc; color:#fff;"><strong><?php echo $vstatus;?></strong></div></a>
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