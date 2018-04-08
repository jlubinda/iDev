<?php
router(array("HEADER","website"),"","",'','','file','');

	if(chkSes()=="Active")
	{
		$user = userData();
		if(@ privacy('Secure|Priv')=='Granted')
		{
		?>
		<div class="row">
			<div class="col s12 m12 l12">
			<br><p align="center">Welcome <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?>, <i>The Administrator</i>!</p>
			</div>
		</div>
		<?php
		}
		else
		{
		?>
		<div class="row">
			<div class="col s12 m12 l12">
			<br><p align="center">Sorry <?php echo $user["FirstName"];?> <?php echo $user["LastName"];?>. You are not an Administrator.</p>
			</div>
		</div>
		<?php
		}
	}
	else
	{
		include find_file("login.php");
	}
router(array("FOOTER","website"),"","",'','','file','');
?>