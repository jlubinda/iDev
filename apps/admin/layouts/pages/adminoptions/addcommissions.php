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
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>CATEGORY:</b> </div><div style="float: right;"><select name="catname">
			<?php
				$cats = listVehicleCategories();
				
				for($a=0; $a<$cats[0]['num']; $a++)
				{
					?>
					<option value='<?php echo $cats[$a]["id"];?>'><?php echo $cats[$a]["name"];?></option>
					<?php
				}
				?>
			</select></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>SELECT LOCATION:</b> </div><div style="float: right;">
				<select name="location" class="span12" id="city">
					
					<?php
					$catsl = listCountinents();
					
					for($al=0; $al<$catsl[0]['num']; $al++)
					{
						$counl = listCountries($catsl[$al]["name"]);
								
							for($bl=0; $bl<$counl[0]['num']; $bl++)
							{
								$towns = listTowns($counl[$bl]["name"]);
									
								for($c=0; $c<$towns[0]['num']; $c++)
								{
									?>
									<option value="<?php echo $towns[$c]['id'];?>"><?php echo $towns[$c]["name"];?></value>
									<?php
								}
							}
					}
					?>
				</select>
			</div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>COMMISSION WITHIN:</b> </div><div style="float: right;"><input name="catprice_within" type="text" size="30"></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>COMMISSION OUTSIDE:</b> </div><div style="float: right;"><input name="catprice_outside" type="text" size="30"></div></div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addCommision($_REQUEST["catname"],$_REQUEST["catprice_within"],$_REQUEST["catprice_outside"],$_REQUEST["location"])=="1")
			{
				echo "Vehicle Category Commissions have been set.<br><br>";
			}
			else
			{
				echo "Error setting Vehicle Commissions.<br><br>";
			}
			echo '</div>';
		}
		
		
	?>


	<?php 

	if($_REQUEST["function"]=="delete")
	{
		?>
		<div style="padding: 5px; width:93%;">
			<div style="min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
				<?php 
				if($_REQUEST['con']=="Yes")
				{
					if(deleteCommision($_REQUEST['id'],$_REQUEST['location'],$_REQUEST['ctype'])==1)
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>COMMISSION DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ERROR! COMMISSION NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE COMMISSION '<?php echo getCommision($_REQUEST['id'],$_REQUEST['location'],$_REQUEST['ctype']);?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&ctype=<?php echo $_REQUEST['ctype']; ?>&location=<?php echo $_REQUEST['location']; ?>&function=delete&con=Yes"><div style="margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="margin:5px;">NO</div></a></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	?>
	</div>
	<div style="width:60%; min-width: 320px;">
		<div style="min-width:280px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<?php 
			$cats = listCommissions();
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				?>
				<div style="margin:5px; width:300px;; padding:5px; background-color:#555;"><div style="padding:7px; background-color:#222;"> K<?php echo number_format($cats[$a]["name"],2);?> - <?php echo $cats[$a]["type"];?> <?php echo strtoupper(getTown($cats[$a]["location"]));?> PER DAY FOR A <?php echo strtoupper(getVehicleCategory($cats[$a]["category"]));?></div><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cats[$a]['id'];?>&ctype=<?php echo $cats[$a]['type'];?>&location=<?php echo $cats[$a]['location'];?>&function=delete"><div style="margin:5px;">DELETE</div></a></div>
				<?php
			}
			?>
		</div>
	</div>
		</div>
	</div>
	<?php
	}
router(array("FOOTER","website"),"","",'','','file','');
?>