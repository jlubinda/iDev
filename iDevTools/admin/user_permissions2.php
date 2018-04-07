<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

	if($bx_permissions=="Yes")
	{
	
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e2" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="2")
		{
		if(!$_REQUEST["UserTypeCode"])
		{
		echo "<table align='center' width='400' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td><u><b>User Role</b></u></td><td width='130'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM _bx_refer_users_types;";
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td align='center'>".$UserTypeName."</td><td align='center'><a href='?ref=settings&segment=e2&function=list&unit=2&pvCode=".$_REQUEST["pvCode"]."&UserTypeCode=".$UserTypeCode."&UserTypeName=".$UserTypeName."&UserTypeCategory=".$UserTypeCategory."'>View Permissions</a></td></tr>";
			}
			echo "</table>";
		}
		
		
		if($_REQUEST["UserTypeCode"])
		{
		echo "<p align='center'><h2 align='center'><b><u>".$_REQUEST["UserTypeName"]."</u></b></h2></p><br>";
		echo "<table align='center' width='1000' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Page ID</b></u></td><td><u><b>Page Name</b></u></td><td width='130'><u><b>View Permissions</b></u></td><td width='130'><u><b>Insert Permissions</b></u></td><td width='130'><u><b>Delete Permissions</b></u></td><td width='130'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM _bx_sys_permissions WHERE UserTypeID = '".$_REQUEST["UserTypeCode"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$unitID = $row["id"];
			$UserTypeID = $row["UserTypeID"];
			$PageID = $row["PageID"];
			$bx_permissions = $row["bx_permissions"];
			$bx_permissions = $row["insert_permissions"];
			$bx_permissions = $row["delete_permissions"];
			
			$selt = "SELECT * FROM _bx_sys_pages WHERE PageID = '".$PageID."';";
			@$rest = mysqli_query($db,$selt);
			@$numt = mysqli_num_rows($rest);
			@$rowt = mysqli_fetch_array($rest);
			$pageTypeID = $rowt["id"];
			$PageIDt = $rowt["PageID"];
			$pageName = $rowt["name"];
			
			
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$PageID."</td><td align='center'>".$pageName."</td><td align='center'>".$bx_permissions."</td><td align='center'>".$bx_permissions."</td><td align='center'>".$bx_permissions."</td><td align='center'><a href='?ref=settings&segment=e2&function=delete&unit=2&pvCode=".$_REQUEST["pvCode"]."&unitID=".$unitID."&unitName=".$pageName."&unitCode=".$PageID."'>Revoke Permissions</a></td></tr>";
			}
			echo "</table>";
			}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e2" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && !$_REQUEST['submitBtn'] && $_REQUEST["unitID"])
		{
		
			?>
			<form action="" method="POST">
			<input name="unitID" type="hidden" value="<?php echo $_REQUEST["unitID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the revoking of the <?php echo $_REQUEST["UserTypeName"]; ?> permissions to '<?php echo $_REQUEST["unitName"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e2" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && $_REQUEST['submitBtn']=="Delete")
		{
		$delete = "DELETE FROM _bx_sys_permissions WHERE id = '".$_REQUEST["unitID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Revoked User Permissions.";
		include_once "iDevTools/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add")
		{
			if(!$_REQUEST["proceedbtn"]=="Proceed" && !$_REQUEST["UserTypeID"])
			{
			?>
			
			<form action="" method="POST">
			<input name="PageID" size="30" type="hidden" value="<?php echo $_REQUEST["regid"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>User Role: </td><td><select name="UserTypeID"><option value="<?php echo $_REQUEST["UserTypeID"]; ?>"><?php echo $_REQUEST["UserTypeID"]; ?></option>
					<?php
					$select_user_type = "SELECT * FROM _bx_refer_users_types;";
					$res_user_type = mysqli_query($db,$select_user_type);
					$num_user_type = mysqli_num_rows($res_user_type);
					for($z=0; $z<$num_user_type; $z++)
					{
					$row_typ = mysqli_fetch_array($res_user_type);
					$UserTypeCode = $row_typ["UserTypeCode"];
					$UserTypeName = $row_typ["UserTypeName"];
					
					echo "<option value='".$UserTypeCode."'>".$UserTypeName."</option>";
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif((($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["UserTypeID"]) && (!$_REQUEST["delete_permissions"] || !$_REQUEST["bx_permissions"] || !$_REQUEST["insert_permissions"] || !$_REQUEST["PageID"])) || ($_REQUEST["editbtn"]=="Edit" && $_REQUEST["UserTypeID"]))
			{
		?>
			<form action="" method="POST">
			<input name="UserTypeID" size="30" type="hidden" value="<?php echo $_REQUEST["UserTypeID"]; ?>">
			<input name="PageID" size="30" type="hidden" value="<?php echo $_REQUEST["PageID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Component ID: </td><td><?php echo $_REQUEST["PageID"]; ?></td>
				</tr>
				<tr>
					<td>View Permissions: </td><td><input type="checkbox" name="bx_permissions" value="Yes"></td>
				</tr>
				<tr>
					<td>Insert Permissions: </td><td><input type="checkbox" name="insert_permissions" value="Yes"></td>
				</tr>
				<tr>
					<td>Delete Permissions: </td><td><input type="checkbox" name="delete_permissions" value="Yes"></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["delete_permissions"] && $_REQUEST["bx_permissions"] && $_REQUEST["insert_permissions"] && $_REQUEST["UserTypeID"] && $_REQUEST["PageID"]))
			{
			if($_REQUEST["delete_permissions"])
			{
			$vvv = $_REQUEST["delete_permissions"];
			}
			else
			{
			$vvv = "No";
			}
			
			
			
			if($_REQUEST["insert_permissions"])
			{
			$vvw = $_REQUEST["insert_permissions"];
			}
			else
			{
			$vvw = "No";
			}
			
			
			
			if($_REQUEST["bx_permissions"])
			{
			$vvx = $_REQUEST["bx_permissions"];
			}
			else
			{
			$vvx = "No";
			}
			?>
			<form action="" method="POST">
			<input name="delete_permissions" type="hidden" value="<?php echo $vvv; ?>">
			<input name="insert_permissions" type="hidden" value="<?php echo $vvw; ?>">
			<input name="bx_permissions" type="hidden" value="<?php echo $vvx; ?>">
			<input name="PageID" type="hidden" value="<?php echo $_REQUEST["PageID"]; ?>">
			<input name="UserTypeID" type="hidden" value="<?php echo $_REQUEST["UserTypeID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>User Role: </td><td><?php echo $_REQUEST["UserTypeID"]; ?></td>
				</tr>
				<tr>
					<td>Component: </td><td><?php echo $_REQUEST["PageID"]; ?></td>
				</tr>
				<tr>
					<td>View Permissions: </td><td><?php echo $vvv; ?></td>
				</tr>
				<tr>
					<td>Insert Permissions: </td><td><?php echo $vvw; ?></td>
				</tr>
				<tr>
					<td>Delete Permissions: </td><td><?php echo $vvx; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			
		$deletef = "DELETE FROM _bx_sys_permissions WHERE (UserTypeID = '".$_REQUEST["UserTypeID"]."' AND PageID = '".$_REQUEST["PageID"]."');";
		$resf = mysqli_query($db,$deletef);

			
			$query_test = "select max(id) as max_ID from _bx_sys_permissions where PageID = '".$_REQUEST["PageID"]."';";
			$result_test = mysqli_query($db,$query_test);
			@$row_test = mysqli_fetch_array($result_test);
			@$max_ID = $row_test["max_ID"];
		
				
			$sql21 = "INSERT INTO _bx_sys_permissions (id,UserTypeID,PageID,bx_permissions,insert_permissions,delete_permissions) VALUES ('','".$_REQUEST["UserTypeID"]."','".$_REQUEST["PageID"]."','".$_REQUEST["bx_permissions"]."','".$_REQUEST["insert_permissions"]."','".$_REQUEST["delete_permissions"]."');";
			$res21 = mysqli_query($db,$sql21);
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record added successfully!</span></p>";
					}
					else
					{
					echo "<p align='center'><span class='success'>Error inserting record into database. Please try again later.</span></p>";
					}
			
		$Operationx = "Set User Permissions.";
		include_once "iDevTools/system_log.php";
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		else
		{
		//echo "test3";
		}

	}
	else
	{
	include_once "mis/access_denied.php";
	}
}
?>