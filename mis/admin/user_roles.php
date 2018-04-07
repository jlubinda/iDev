<?php
 if(!isset (SesVar()) || !SesVar())
{

} 
else 
{

	 if(@ privacy('Secure|Priv')=='Granted'){
	
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="1")
		{
		
		
		echo "<table align='center' width='700' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Code</b></u></td><td><u><b>Description</b></u></td><td width='180'><u><b>User Type Category</b></u></td><td width='180'><u><b>Limited To</b></u></td><td width='150'><u><b>Roaming Status</b></u></td><td width='190'><u><b></b></u></td><td width='80'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM refer_users_types;";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$UserTypeCode = $row["UserTypeCode"];
			$UserTypeName = $row["UserTypeName"];
			$UserTypeCategory = $row["UserTypeCategory"];
			$LimitedTo = $row["LimitedTo"];
			$xRoaming = $row["Roaming"];
			
			
			if($xRoaming=="Yes")
			{
			$xRoamingStatus = "Active";
			$xRoamingStatusLink = "<a href='?ref=settings&segment=e1&function=edit&unit=3&typeID=".$UserTypeCode."&typeName=".$UserTypeName."&typeCode=".$typeCode."&status=No'>Deactivate Roaming</a>";
			}
			else
			{
			$xRoamingStatus = "Inactive";
			$xRoamingStatusLink = "<a href='?ref=settings&segment=e1&function=edit&unit=3&typeID=".$UserTypeCode."&typeName=".$UserTypeName."&typeCode=".$typeCode."&status=Yes'>Activate Roaming</a>";
			}
			
	$bn = $bn+1;
	$hj = explode(".",($bn/2));
	$d1 = $hj[0];
	$d2 = $hj[1];
	
	if($d2=="" || $d2=="0")
	{
	$bgcolor = "99FFFF";
	}
	else
	{
	$bgcolor = "ddffff";
	}
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$UserTypeCode."</td><td align='center'>".$UserTypeName."</td><td align='center'>".$UserTypeCategory."</td><td align='center'>".$LimitedTo."</td><td>".$xRoamingStatus."</td><td>".$xRoamingStatusLink."</td><td align='center'><a href='?ref=settings&segment=e1&function=delete&unit=2&pvCode=".$_REQUEST["pvCode"]."&UserTypeCode=".$UserTypeCode."&UserTypeName=".$UserTypeName."&UserTypeCategory=".$UserTypeCategory."'>Delete</a></td></tr>";
			}
			echo "</table>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && !$_REQUEST['submitBtn'])
		{
		
		
			?>
			<form action="" method="POST">
			<input name="UserTypeCode" type="hidden" value="<?php echo $_REQUEST["UserTypeCode"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the user role '<?php echo $_REQUEST["UserTypeName"]; ?>' Code '<?php echo $_REQUEST["UserTypeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && $_REQUEST['submitBtn']=="Delete")
		{
		$delete = "DELETE FROM refer_users_types WHERE UserTypeCode = '".$_REQUEST["UserTypeCode"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Deleted User Role.";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="2")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["UserTypeCategory"] || !$_REQUEST["UserTypeName"] || !$_REQUEST["UserTypeCode"] || !$_REQUEST["LimitedTo"])))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>User Role: </td><td><input name="UserTypeName" size="25" type="text" value="<?php echo $_REQUEST["UserTypeName"]; ?>"></td>
				</tr>
				<tr>
					<td>Role Code: </td><td><input name="UserTypeCode" size="25" type="text" value="<?php echo $_REQUEST["UserTypeCode"]; ?>"></td>
				</tr>
				<tr>
					<td>Role Type: </td><td><select name="UserTypeCategory"><option value="<?php echo $_REQUEST["UserTypeCategory"]; ?>"><?php echo $_REQUEST["UserTypeCategory"]; ?></option><option value="Administrator">Administrator</option><option value="Data Entry Clerk">Data Entry Clerk</option><option value="Monitor">Monitor</option></td>
				</tr>
				<tr>
					<td>Limited To: </td><td><select name="LimitedTo"><option value="<?php echo $_REQUEST["LimitedTo"]; ?>"><?php echo $_REQUEST["LimitedTo"]; ?></option><option value="User`s Branch Only">User`s Branch Only</option><option value="User`s Organization">User`s Organization</option><option value="Country">User`s Country</option><option value="Unlimited">Unlimited</option></select></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["UserTypeCategory"] && $_REQUEST["UserTypeName"] && $_REQUEST["UserTypeCode"] && $_REQUEST["LimitedTo"]))
			{
			?>
			<form action="" method="POST">
			<input name="UserTypeCode" type="hidden" value="<?php echo $_REQUEST["UserTypeCode"]; ?>">
			<input name="UserTypeName" type="hidden" value="<?php echo $_REQUEST["UserTypeName"]; ?>">
			<input name="UserTypeCategory" type="hidden" value="<?php echo $_REQUEST["UserTypeCategory"]; ?>">
			<input name="LimitedTo" type="hidden" value="<?php echo $_REQUEST["LimitedTo"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>User Role: </td><td><?php echo $_REQUEST["UserTypeName"]; ?></td>
				</tr>
				<tr>
					<td>Role Code: </td><td><?php echo $_REQUEST["UserTypeCode"]; ?></td>
				</tr>
				<tr>
					<td>Role Type: </td><td><?php echo $_REQUEST["UserTypeCategory"]; ?></td>
				</tr>
				<tr>
					<td>Limited To: </td><td><?php echo $_REQUEST["LimitedTo"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit")
			{
					
				
			$sql21 = "INSERT INTO refer_users_types (UserTypeCode,UserTypeName,UserTypeCategory,LimitedTo,_used,_uid) VALUES ('".$_REQUEST["UserTypeCode"]."','".$_REQUEST["UserTypeName"]."','".$_REQUEST["UserTypeCategory"]."','".$_REQUEST["LimitedTo"]."','','');";
			$res21 = mysqli_query($db,$sql21);
			
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record added successfully!</span></p>";
			
		$Operationx = "Created User Role.";
		include "mis/system_log.php";
					}
					else
					{
					echo "<p align='center'><span class='success'>Error inserting record into database. Please try again later.</span></p>";
					}
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="3")
		{
		
	 if(@ privacy('Secure|Priv')=='Granted'){
		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="status" type="hidden" value="<?php echo $_REQUEST["status"]; ?>">
			<input name="typeName" type="hidden" value="<?php echo $_REQUEST["typeName"]; ?>">
			<table align="center" width="700" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm that you are setting the roaming feature for the user role '<?php echo $_REQUEST["typeName"]; ?>' as '<?php echo $_REQUEST["status"]; ?>' <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
		
		$delete = "UPDATE refer_users_types SET Roaming = '".$_REQUEST["status"]."' WHERE UserTypeCode = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Set roaming setting for ".$_REQUEST["typeName"]." as `".$_REQUEST["status"]."`";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}

		}
		else
		{
		
		}
	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		else
		{
		//echo "test3";
		}

	}
	else
	{
	include "mis/access_denied.php";
	}
}
?>