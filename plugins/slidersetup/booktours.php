<?php 
		
	if($_REQUEST["submitBtn"]=='')
	{
	$items = '';
	$value = '';
	$input = '';
		
		if(flocashSettings("ENVIRONMENT")=="LIVE")
		{
			$checktest = '';
			$checklive = 'checked="true"';
		}
		else
		{
			$checktest = 'checked="true"';
			$checklive = '';
		}
		
	$settingsArray = zraSettings();
	$percentage = $settingsArray['percentage'];
	$fixedCharge = $settingsArray['fixedCharge'];
	$zraBaseURL = $settingsArray['zraBaseURL'];
	
		?>
		<div style="float: left; min-width:280px; max-width: 450px; background-color:#333; padding:5px; margin:5px; color:#fff;">
		<form action="" method="POST">
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>ZRA RETURN URL</b> <br>';?></b><?php echo '<input name="zraBaseURL" type="text" value="'.$zraBaseURL.'" size="40">';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Fixed Charge</b> <br>';?></b><?php echo '<input name="fixedCharge" type="text" value="'.$fixedCharge.'" size="40">';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Percentage</b> <br>';?></b><?php echo '<input name="percentage" type="text" value="'.$percentage.'" size="40">';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Tax Type</b> <br>';?></b><?php echo '<input name="taxType" type="text" placeholder="eg DOMESTIC TAX" size="40">';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
		</form>
		</div>
		<?php
	}
	elseif($_REQUEST["submitBtn"]=='Submit')
	{
		
		if(bookTour($_REQUEST["idx"],$_REQUEST["firstname"],$_REQUEST["lastname"],$_REQUEST["email"],$_REQUEST["phone"],$_REQUEST["startdate"],$_REQUEST["enddate"],$_REQUEST["extras"])=="1")
		{
			echo "Success! You booking has been made. Please check your email for details. Feel free to get in touch anytime. Thank you.<br><br>";
		}
		else
		{
			echo "Error. You booking was unsuccessful.<br><br>";
		}
		
	}
	
?>