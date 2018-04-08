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


		$items = '';
		$value = '';
		$input = '';

			?>
			<div style="min-width:280px; max-width: 100%; background-color:#fff; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#000;">
				<form action="" method="POST" enctype="multipart/form-data">
					<div style="margin:5px; padding:5px; background-color:#555;"><b>VEHICLE CATEGORY NAME:</b> <input name="catname" type="text" size="30"></div>
					<div style="margin:5px; padding:5px; background-color:#555;"><b>CODE:</b> <input name="code" type="text" size="30"></div>
					<div style="margin:5px; padding:5px; background-color:#555;"><b>EXAMPLE VEHICLE:</b> <input name="example" type="text" size="30"></div>
					<div style="margin:5px; padding:5px; background-color:#555;"><b>IMAGE:</b> <input name="img" type="text" size="30"></div>
					<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
				</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			
			if(addVehicleCategory($_REQUEST["catname"],$_REQUEST["code"],$_REQUEST["example"],$_REQUEST["img"])=="1")
			{
				echo "Vehicle Category created.<br><br>";
			}
			else
			{
				echo "Error creating Vehicle Category.<br><br>";
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
	<div style="width:100%; min-width: 320px;">
		<div style="min-width:280px; width:100%; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<?php 
			$cats = listVehicleCategories();
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				?>
				<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b><?php echo $cats[$a]["name"];?></b> (Code - <?php echo $cats[$a]["code"];?>) (Image URL - <?php echo $cats[$a]["img"];?>), Example - <?php echo $cats[$a]["example"];?><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cats[$a]['id'];?>&function=delete"><div style="margin:5px;">DELETE</div></a></div>
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

