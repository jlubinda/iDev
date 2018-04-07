<div style="float: left; min-width:280px; width:300px; background-color:#333; padding:5px; margin:5px; color:#fff; margin-bottom:100px;">
	<form action="" method="POST">
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>TITLE</b> <br>';?></b><?php echo '<input name="title" type="text" size="40">';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>DESCRIPTION</b> <br>';?></b><?php echo '<textarea name="description" rows="5" cols="30"></textarea>';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>FOCUS AREA</b> <br>';?></b><?php echo '<input name="focusarea" type="text" size="40">';?></div>
		<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
	</form>
</div>
<?php	
	
	if($_REQUEST["submitBtn"]=='Submit')
	{
		if(tourCategory("ADD",$_REQUEST["title"],$_REQUEST["description"],$_REQUEST["focusarea"])=="1")
		{
			echo "Success!<br><br>";
		}
		else
		{
			echo "Error. <br><br>";
		}
	}

?>