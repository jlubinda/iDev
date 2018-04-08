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
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>PRICE WITHIN:</b> </div><div style="float: right;"><input name="catprice_within" type="text" size="30"></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>PRICE OUT OF TOWN:</b> </div><div style="float: right;"><input name="catprice_outside" type="text" size="30"></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>PRICE OUT OF COUNTRY:</b> </div><div style="float: right;"><input name="catprice_out_of_country" type="text" size="30"></div></div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addCategoryPrice($_REQUEST["catname"],$_REQUEST["catprice_within"],$_REQUEST["catprice_outside"],$_REQUEST["catprice_out_of_country"],$_REQUEST["location"])=="1")
			{
				echo "Vehicle Category Price has been set.<br><br>";
			}
			else
			{
				echo "Error setting Vehicle Category Price.<br><br>";
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
					if(deleteVehicleCategory($_REQUEST['id'])==1)
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>CATEGORY DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ERROR! CATEGORY NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE CATEGORY '<?php echo getVehicleCategory($_REQUEST['id']);?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&function=delete&con=Yes"><div style="margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="margin:5px;">NO</div></a></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	?>
	</div>
	<div style="min-width: 320px;">
		<div style="min-width:300px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<?php 
			$cats = listVehicleCategories();
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				$loc = listTowns();
				
				for($b=0; $b<$loc[0]['num']; $b++)
				{
					?>
					<div style="margin:5px;min-width:280px; width:95%; padding:5px; background-color:#555;"><div style="padding:7px; background-color:#222;"><u><strong><?php echo $cats[$a]["name"];?>: </strong></u><br>K<?php echo number_format(getCategoryPrice($cats[$a]["id"],$loc[$b]["id"],"WITHIN","","ORIGINAL"),2);?> WITHIN <?php echo getTown($loc[$b]["id"]);?><br>K<?php echo number_format(getCategoryPrice($cats[$a]["id"],$loc[$b]["id"],"OUT OF TOWN","","ORIGINAL"),2);?> OUT OF TOWN<br> K<?php echo number_format(getCategoryPrice($cats[$a]["id"],$loc[$b]["id"],"OUT OF COUNTRY"),2);?> OUT OF COUNTRY</div><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cats[$a]['id'];?>&function=delete"><div style="margin:5px;">DELETE</div></a></div>
					<?php
				}

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