<?php 
function installiDev($type="",$class="",$item=""){
	
	if($type=="")
	{
	
	echo '<div style="float: left; width: 300px; background-color:#333; padding:5px; margin:5px; color:#fff;">';
	
		if($_REQUEST["submitBtn"]=='')
		{
		$items = '';
		$value = '';
		$input = '';
			/*
			if(iDevSite("ACCESS")=="https")
			{
				$checkhttp = '';
				$checkhttps = 'checked="true"';
			}
			else
			{
				$checkhttp = 'checked="true"';
				$checkhttps = '';
			}
			
			
			if(iDevSite("ROBOTS","INDEX")=="NOT-INDEX")
			{
				$checknoindex = 'checked="true"';
				$checkindex = '';
			}
			else
			{
				$checknoindex = '';
				$checkindex = 'checked="true"';
			}
			
			
			if(iDevSite("ROBOTS","INDEX")=="NOT-FOLLOW")
			{
				$checknofollow = 'checked="true"';
				$checkfollow = '';
			}
			else
			{
				$checknofollow = '';
				$checkfollow = 'checked="true"';
			}
			*/
			?>
			<form action="" method="POST" enctype="multipart/form-data">
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Database Host</b> <br>';?></b><?php echo '<input name="dbhost" type="text" value="localhost" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Database Name</b> <br>';?></b><?php echo '<input name="database" type="text" value="" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Database User</b> <br>';?></b><?php echo '<input name="dbuser" type="text" value="root" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><b><?php echo '<b>Database Password</b> <br>';?></b><?php echo '<input name="dbpass" type="text" value="" size="40">';?></div>
			<div style="margin:5px; float: left; padding:5px; background-color:#555;"><input type="submit" name="submitBtn" value="Submit"></div>
			</form>
			<?php
		
		}
		elseif($_REQUEST["submitBtn"]=='Submit')
		{
				
			$array = array($_REQUEST["database"],$_REQUEST["dbuser"],$_REQUEST["dbpass"],$_REQUEST["dbhost"]);
			
			if(installiDev("DB SETUP",$array)==1)
			{
				?>
			<script type="text/javascript">
			function submitform()
			{
				if(document.myform.onsubmit &&
				!document.myform.onsubmit())
				{
					return;
				}
			 document.myform.submit();
			}
			</script>
			<form name="myform" action="?ref=admin.php" method="post">
			<input type='hidden' name='adminuser' value="com.admin"/>
			<input type='hidden' name='firsttimelogin' value="TRUE"/>
			<input type='hidden' name='adminEmail' value="<?php echo $_REQUEST["database"];?>"/>
			</form>
			<iframe onload="javascript: submitform()" style="width:0px; height:0px;">
			</iframe>
			<?php
			}
			else
			{
				echo "Error! Database settings could not be set.<br><br>";
			}
			
		}
		echo "</div>";
	}
	elseif($type=="DB SETUP")
	{
		$fp2 = fopen("dbu.php", "w+");
		
		$outputstring = '<?php'."\n";
		$outputstring .= '$dbname = "'.$class[0].'";'."\n";
		$outputstring .= '$dbuser = "'.$class[1].'";'."\n";
		$outputstring .= '$dbpassword = "'.$class[2].'";'."\n";
		$outputstring .= '$dbhost = "'.$class[3].'";'."\n";
		$outputstring .= '?>';
		
		if(fwrite($fp2, $outputstring))
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		fclose($fp2);
	}
	elseif($type=="ADMIN")
	{
		
	}
}

installiDev();
?>