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
				<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>CURRENCY NAME:</b> </div><div style="float: right;"><input name="name" type="text" size="30"></div></div>
				<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>CURRENCY CODE:</b> </div><div style="float: right;"><input name="currency" type="text" size="30"></div></div>
				<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>CURRENCY SYMBOL:</b> </div><div style="float: right;"><input name="symbol" type="text" size="30"></div></div>
				<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>COUNTRY:</b> </div><div style="float: right;"><input name="country" type="text" size="30"></div></div>
				<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>USD EQUIVALENT:</b> </div><div style="float: right;"><input name="exchangerate" type="text" size="30"></div></div>
				<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
		</div>
		<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(currency($_REQUEST["country"],"CURRENCY CODES","ADD",$_REQUEST["currency"],$_REQUEST["name"],$_REQUEST["symbol"],$_REQUEST["exchangerate"])==1)
			{
				echo "Currency for ".$_REQUEST["country"]." has been set.<br><br>";
			}
			else
			{
				echo "Error setting currency for ".$_REQUEST["country"].".<br><br>";
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
					if(currency($_REQUEST['id'],"CURRENCY CODES","DELETE")==1)
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>CURRENCY DELETED</b></div>
						<?php
					}
					else
					{
						?>
						<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ERROR! CURRENCY NOT DELETED</b></div>
						<?php
					}
				}
				else
				{
					?>
					<div style="margin:5px; width:500px;; padding:5px; background-color:#555;"><b>ARE YOU SURE YOU WANT TO DELETE THE CURRENCY '<?php echo currency($_REQUEST['id'],$_REQUEST['location'],$_REQUEST['ctype']);?>'? </b><BR><BR><a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $_REQUEST['id'];?>&ctype=<?php echo $_REQUEST['ctype']; ?>&location=<?php echo $_REQUEST['location']; ?>&function=delete&con=Yes"><div style="margin:5px;">YES</div></a> &nbsp;&nbsp;&nbsp;<a href="?ref=<?php echo $_REQUEST['ref']; ?>"><div style="margin:5px;">NO</div></a></div>
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
			$cats = currency("","CURRENCY CODES","LIST");
			
			for($a=0; $a<$cats[0]['num']; $a++)
			{
				?>
				<div style="margin:5px; width:95%; padding:5px; background-color:#555;">
					<div style="padding:7px; background-color:#222;">
					<b>CURRENCY NAME: </b><?php echo strtoupper($cats[$a]["name"]);?><br>
					<b>CURRENCY CODE: </b><?php echo $cats[$a]["code"];?><br>
					<b>CURRENCY SYMBOL: </b><?php echo $cats[$a]["symbol"];?> <br>
					<b>EXCHANGE RATE: </b><?php echo strtoupper($cats[$a]["exchangerate"]);?>
					<b>COUNTRY: </b><?php echo strtoupper($cats[$a]["country"]);?><br>
					</div>
					<a href="?ref=<?php echo $_REQUEST['ref']; ?>&id=<?php echo $cats[$a]['id'];?>&function=delete"><div style="margin:5px;">DELETE</div></a>
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