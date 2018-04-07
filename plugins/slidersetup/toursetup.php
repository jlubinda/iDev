<?php 

	$covervarname = "coverimage";
	$otherimage1 = "otherimage1";
	$otherimage2 = "otherimage2";
	$otherimage3 = "otherimage3";
	$otherimage4 = "otherimage4";
	$otherimage5 = "otherimage5";
	$otherimage6 = "otherimage6";
	
?>
		<div style="float: left; min-width:280px; max-width: 450px; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:100px;">
			<form action="" method="POST">
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>MAX DISPLAYED ACTIVITIES</b> <br>';?></b><?php echo '<input name="activities" type="text" size="40" value="'.tourSetUp("ACTIVITIES").'">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>MAX DISPLAYED EXTRAS</b> <br>';?></b><?php echo '<input name="extras" type="text" size="40" value="'.tourSetUp("EXTRAS").'">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>CURRENCY CODE</b> <br>';?></b><?php echo '<input name="currencyCode" type="text" size="40" value="'.tourSetUp("CURRENCYCODE").'">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>CURRENCY SYMBOL</b> <br>';?></b><?php echo '<input name="currencySymbol" type="text" size="40" value="'.tourSetUp("CURRENCYSYMBOL").'">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TOUR PACKAGE IMAGES</b> <br>';?></b><?php echo '<input name="packageImages" type="text" size="40" value="'.tourSetUp("PACKAGEIMAGES").'">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>INCLUDE TOUR CATEGORIES IN MAIN MENU</b> ';?></b><?php echo '<input name="categories_menu" type="checkbox" size="40" value="Yes">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>SHOW ITENARARY</b> ';?></b><?php echo '<input name="itenarary" type="checkbox" size="40" value="Yes">';?></div>
				<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
		</div>
		<?php
	
	
	if($_REQUEST["submitBtn"]=='Submit')
	{
	
		if(tourSetUp("ADD",$_REQUEST["activities"],$_REQUEST["extras"],$_REQUEST["currencyCode"],$_REQUEST["currencySymbol"],$_REQUEST["categories_menu"],$_REQUEST["itenarary"],$_REQUEST["packageImages"])=="1")
		{
			echo "Success!<br><br>";
		}
		else
		{
			echo "Error. <br><br>";
		}
		
	}
	
?>