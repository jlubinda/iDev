<?php

if($_REQUEST["function"]=="delete" && !($_REQUEST["unitx"]==""))
{
	if(tourCategory("DELETE",$_REQUEST["unitx"])==1)
	{
		echo "Success!";
		pluginPages("DELETE",$_REQUEST["unitx"]);
	}
	else
	{
		echo "Error!";
	}
}

$mytours = tourCategory();
$num = count($mytours);

for($p=0; $p<$num; $p++)
{
	$userid = $mytours[$p]["userid"];
	?>
	<div style="float: left; width: 65%; min-width:300px; margin: 0.7%; border-radius: 5px; background-color: #cfcfcf; padding:8px;">
		<div align="left" style="float: left; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
			<?php 
			echo "<b>CATEGORY NAME: </b>".tourCategory("NAME",$userid);
			?>
		</div>
		<div align="left" style="float: left; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
			<?php 
			echo "<b>DESCRIPTION: </b>".tourCategory("DESCRIPTION",$userid);
			?>
		</div>
		<div align="left" style="float: left; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
			<?php 
			echo "<b>FOCUS AREA: </b>".tourCategory("FOCUS",$userid);
			?>
		</div>
		<div align="left" style="float: right; font-size: 12px; color: #000; min-width: 300px; width: 99%; font-weight:normal;">
			<?php 
			echo "<a href='?ref=admin/listtourcategories.php&unitx=".$userid."&function=delete'>Delete</a>";
			?>
		</div>
	</div>
	<?php
}

?>