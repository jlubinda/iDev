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
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>COUNTRY:</b> </div><div style="float: right;"><select name="country">
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
			
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>NAME OF PROVINCE:</b> </div><div style="float: right;"><input name="province" type="text" size="30"></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>PRICE SETTING:</b> </div><div style="float: right;"><select name="price_setting">
				<option value='FLAT RATE'>FLAT RATE</option>
				<option value='VARRYING RATE'>VARRYING RATE</option>
			</select></div></div>
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addProvince($_REQUEST["province"],$_REQUEST["country"],$_REQUEST["price_setting"])=="1")
			{
				echo "SUCCESS! PROVINCE HAS BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING PROVINCE.<br><br>";
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
					if(deleteProvince($_REQUEST['id'])==1)
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>PROVINCE DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ERROR! PROVINCE NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE PROVINCE '<?php echo getProvince($_REQUEST['id']);?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&function=delete&con=Yes"><div style="margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="margin:5px;">NO</div></a></div>
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
			$cats = listCountinents();
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				$coun = listCountries($cats[$a]["name"]);
				?>
				<div style="margin:5px; width:93%; padding:5px; background-color:#555;"><strong><?php echo $cats[$a]["name"];?></strong>
					<?php
						
					for($b=0; $b<$coun[0]['num']; $b++)
					{
					$provinces = listProvinces($coun[$b]["name"],"ALL");
					?>
					<div style="margin:5px; width:93%; padding:5px; background-color:#555;"><strong><?php echo $coun[$b]["name"];?></strong>
						<?php
							
						for($c=0; $c<$provinces[0]['num']; $c++)
						{
							?>
							<div style="margin:5px; width:93%; padding:5px; background-color:#333;"><div style="padding:7px; background-color:#000;"><strong><?php echo $provinces[$c]["name"];?></strong>: <?php echo $provinces[$c]["price_setting"];?></div><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $provinces[$c]['id'];?>&function=delete"><div style="margin:5px;">DELETE</div></a></div>
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