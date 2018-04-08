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
	<div style=" padding: 5px;">

			<div style=" min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#000;">
			<form action="" method="POST" enctype="multipart/form-data">
			<div style="margin:5px;  padding:5px; background-color:#444; width:93%;"><div style=" padding:7px;"><b>COUNTRY:</b> </div><div style="float: right;"><select name="country">
			<?php
				$cats = listCountries();
				
				for($a=0; $a<$cats[0]['num']; $a++)
				{
					?>
					<option value='<?php echo $cats[$a]["name"];?>'><?php echo $cats[$a]["name"];?></option>
					<?php
				}
				?>
			</select></div></div>
			<div style="margin:5px;  padding:5px; background-color:#444; width:93%;"><div style=" padding:7px;"><b>NAME OF TOWN:</b> </div><div style="float: right;"><input name="town" type="text" size="30"></div></div>
			<div style="margin:5px;  padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style=" min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#000;">';
			
			if(addTown($_REQUEST["town"],$_REQUEST["country"])=="1")
			{
				echo "SUCCESS! TOWN HAS BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING TOWN.<br><br>";
			}
			echo '</div>';
		}
		
		
	?>


	<?php 

	if($_REQUEST["function"]=="delete")
	{
		?>
		<div style=" padding: 5px; width:93%;">
			<div style=" min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#000;">
				<?php 
				if($_REQUEST['con']=="Yes")
				{
					if(deleteTown($_REQUEST['id'])==1)
					{
						?>
						<div style="margin:5px;  width:500px;; padding:5px; background-color:#555;"><b>TOWN DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px;  width:500px;; padding:5px; background-color:#555;"><b>ERROR! TOWN NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px;  width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE TOWN '<?php echo getTown($_REQUEST['id']);?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&function=delete&con=Yes"><div style="float: right; margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="float: right; margin:5px;">NO</div></a></div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
	elseif($_REQUEST["function"]=="edit")
	{
		if($_REQUEST["status"]=="ACTIVATE")
		{
			if(activateTown($_REQUEST["id"])==1)
			{
				?>
				<div style="margin:5px;  padding:5px; background-color:#555; color:#000; font-weight:bold;"><b>SUCCESS! <?php echo getTown($_REQUEST['id']);?> IS NOW <?php echo $_REQUEST["status"];?>D</b></div>
				<?php
			}
			else
			{
				?>
				<div style="margin:5px;  padding:5px; background-color:#555; color:#000; font-weight:bold;"><b>ERROR! TRY AGIN LATER</b></div>
				<?php
			}
		}
		elseif($_REQUEST["status"]=="DEACTIVATE")
		{
			if(deactivateTown($_REQUEST["id"])==1)
			{
				?>
				<div style="margin:5px;  padding:5px; background-color:#555; color:#000; font-weight:bold;"><b>SUCCESS! <?php echo getTown($_REQUEST['id']);?> IS NOW <?php echo $_REQUEST["status"];?>D</b></div>
				<?php
			}
			else
			{
				?>
				<div style="margin:5px;  padding:5px; background-color:#555; color:#000; font-weight:bold;"><b>ERROR! TRY AGIN LATER</b></div>
				<?php
			}
		}
	}

	?>
	</div>
	<div style=" width:60%; min-width: 320px;">
		<div style=" min-width:280px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#000;">
			<?php 
			$cats = listCountinents();
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				$coun = listCountries($cats[$a]["name"]);
				?>
				<div style="margin:5px;  width:93%; padding:5px; background-color:#555;"><strong><?php echo $cats[$a]["name"];?></strong>
					<?php
						
					for($b=0; $b<$coun[0]['num']; $b++)
					{
					$towns = listTowns($coun[$b]["name"],"ALL");
					?>
					<div style="margin:5px;  width:93%; padding:5px; background-color:#555;"><strong><?php echo $coun[$b]["name"];?></strong>
						<?php
							
						for($c=0; $c<$towns[0]['num']; $c++)
						{
							if(getTown($towns[$c]['id'],"STATUS")=="INACTIVE")
							{
								$state = "ACTIVATE"; 
							}
							else
							{
								$state = "DEACTIVATE";
							}
							?>
							<div style="margin:5px;  width:93%; padding:5px; background-color:#333;"><div style=" padding:7px; background-color:#CCC;"><strong><?php echo $towns[$c]["name"];?></strong></div>
								<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $towns[$c]['id'];?>&function=delete"><div style="float: right; margin:5px;">DELETE</div></a>
								<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $towns[$c]['id'];?>&function=edit&status=<?php echo $state;?>"><div style="float: right; margin:5px;"><?php echo $state;?></div></a>
							</div>
							<?php
						}
						?>
					</div>
					<?php
					}
					?>
				</div>
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