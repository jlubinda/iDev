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
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>FROM TOWN:</b> </div><div style="float: right;"><select name="fromcity">
			<?php
				$cats = listTowns();
				
				for($a=0; $a<$cats[0]['num']; $a++)
				{
					?>
					<option value='<?php echo $cats[$a]["name"];?>-<?php echo $cats[$a]["country"];?>'><?php echo $cats[$a]["name"];?></option>
					<?php
				}
				?>
			</select></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>TO TOWN:</b> </div><div style="float: right;"><select name="tocity">
			<?php
				$cats2 = listTowns();
				
				for($a2=0; $a2<$cats2[0]['num']; $a2++)
				{
					?>
					<option value='<?php echo $cats2[$a2]["name"];?>-<?php echo $cats2[$a2]["country"];?>'><?php echo $cats2[$a2]["name"];?></option>
					<?php
				}
				?>
			</select></div></div>
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>BUS FARE:</b> </div><div style="float: right;"><input name="amount" type="text" size="30" /></div></div> 
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>FOOD:</b> </div><div style="float: right;"><input name="food" type="text" size="30" /></div></div> 
			<div style="margin:5px; padding:5px; background-color:#444; width:93%;"><div style="padding:7px;"><b>LODGING:</b> </div><div style="float: right;"><input name="lodging" type="text" size="30" /></div></div> 
			<div style="margin:5px; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			</div>
			<?php
		
		if($_REQUEST["submitBtn"]=='Submit')
		{
			echo '<div style="min-width:280px; max-width: 800px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">';
			
			if(addBusFare($_REQUEST["fromcity"],$_REQUEST["tocity"],$_REQUEST["amount"])>="1")
			{
				addLodgingBudget($_REQUEST["tocity"],$_REQUEST["fromcity"],$_REQUEST["lodging"]);
				addFoodBudget($_REQUEST["tocity"],$_REQUEST["fromcity"],$_REQUEST["food"]);
				
				echo "SUCCESS! BUS FARE HAS BEEN ADDED.<br><br>";
			}
			else
			{
				echo "ERROR ADDING BUS FARE.<br><br>";
			}
			echo '</div>';
		}
		
		
	?>
	</div>
		<div style="min-width:280px; background-color:#333; padding:5px; margin-left:5px; margin-left:5px; margin-left:5px; margin-bottom:50px; color:#fff;">
			<?php
				$cats3 = listBusFares();
				
				for($a3=0; $a3<$cats3[0]['num']; $a3++)
				{
					?>
					<div style="margin:5px;">
						<div style="padding:7px; background-color:#222;"><strong>FROM: <?php echo $cats3[$a3]["from"];?></strong></div>
						<div style="padding:7px; background-color:#222;"><strong>TO: <?php echo $cats3[$a3]["to"];?></strong></div>
						<div style="padding:7px; background-color:#222;"><strong>AMOUNT: $<?php echo number_format($cats3[$a3]["amount"],2);?></strong></div>
						<div style="padding:7px; background-color:#222;"><strong>LODGING: $<?php echo number_format($cats3[$a3]["lodging"],2);?></strong></div>
						<div style="padding:7px; background-color:#222;"><strong>FOOD: $<?php echo number_format($cats3[$a3]["food"],2);?></strong></div>
					</div>
					<?php
				}
				?>
		</div>
		</div>
	</div>
	<?php
	}
router(array("FOOTER","website"),"","",'','','file','');
?>