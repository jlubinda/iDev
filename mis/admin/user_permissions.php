<?php

	 if(@ privacy('Secure|Priv')=='Granted'){
	
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e2" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="2")
		{
		if(!$_REQUEST["UserTypeCode"])
		{
		echo "<table align='center' width='400' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td><u><b>User Role</b></u></td><td width='130'><u><b></b></u></td></tr>";
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
		echo "<table align='center' width='1000' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Page ID</b></u></td><td><u><b>Page Name</b></u></td><td width='130'><u><b>View Permissions</b></u></td><td width='130'><u><b>Insert Permissions</b></u></td><td width='130'><u><b>Delete Permissions</b></u></td><td width='130'><u><b>Edit Permissions</b></u></td><td width='130'><u><b>List Permissions</b></u></td><td width='130'><u><b>Setup Permissions</b></u></td><td width='130'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM sys_permissions WHERE UserTypeID = '".$_REQUEST["UserTypeCode"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$unitID = $row["id"];
			$UserTypeID = $row["UserTypeID"];
			$PageIDc = $row["PageID"];
			$view_permissionsc = $row["view_permissions"];
			$insert_permissionsc = $row["insert_permissions"];
			$delete_permissionsc = $row["delete_permissions"];
			$edit_permissionsc = $row["edit_permissions"];
			$list_permissionsc = $row["list_permissions"];
			$setup_permissionsc = $row["setup_permissions"];
			
			$selt = "SELECT * FROM sys_pages WHERE PageID = '".$PageIDc."';";
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$PageIDc."</td><td align='center'>".$pageName."</td><td align='center'>".$view_permissionsc."</td><td align='center'>".$insert_permissionsc."</td><td align='center'>".$delete_permissionsc."</td><td align='center'>".$edit_permissionsc."</td><td align='center'>".$list_permissionsc."</td><td align='center'>".$setup_permissionsc."</td><td align='center'><a href='?ref=settings&segment=e2&function=delete&unit=2&pvCode=".$_REQUEST["pvCode"]."&unitID=".$unitID."&unitName=".$pageName."&unitCode=".$PageIDc."'>Revoke Permissions</a></td></tr>";
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
		$delete = "DELETE FROM sys_permissions WHERE id = '".$_REQUEST["unitID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Revoke User Permissions.";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add")
		{
			if(!$_REQUEST["proceedbtnv"]=="Proceed" && !$_REQUEST["UserTypeID"] && !$_REQUEST["proceedbtnx"])
			{
			?>
			
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>User Role: </td><td><select name="UserTypeID"><option value="<?php echo $_REQUEST["UserTypeID"]; ?>"><?php echo $_REQUEST["UserTypeID"]; ?></option>
					<?php
					$select_user_type = "SELECT * FROM refer_users_types;";
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
					<td> </td><td><input name="proceedbtnv" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif((($_REQUEST["proceedbtnv"]=="Proceed" && $_REQUEST["UserTypeID"])) || ($_REQUEST["editbtn"]=="Edit" && $_REQUEST["UserTypeID"]))
			{
		?>
			<form action="" method="POST"id="selectForm">
			<input name="UserTypeID" type="hidden" value="<?php echo $_REQUEST["UserTypeID"]; ?>">
			<table align="center" width="95%" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td><b></b></td><td><b></b></td><td><b>
</b></td><td><b></b></td>
				</tr>
				<tr>
					<td><b>Component</b></td><td><b>View Permissions</b><br>Select All/None <input type="checkbox" onclick="checkAll(document.getElementById('selectForm'), 'results1', this.checked);" /></td><td><b>Insert Permissions</b><br>Select All/None <input type="checkbox" onclick="checkAll(document.getElementById('selectForm'), 'results2', this.checked);" /></td><td><b>Delete Permissions</b><br>Select All/None <input type="checkbox" onclick="checkAll(document.getElementById('selectForm'), 'results3', this.checked);" /></td><td><b>Edit Permissions</b><br>Select All/None <input type="checkbox" onclick="checkAll(document.getElementById('selectForm'), 'results4', this.checked);" /></td><td><b>List Permissions</b><br>Select All/None <input type="checkbox" onclick="checkAll(document.getElementById('selectForm'), 'results5', this.checked);" /></td><td><b>Setup Permissions</b><br>Select All/None <input type="checkbox" onclick="checkAll(document.getElementById('selectForm'), 'results6', this.checked);" /></td>
				</tr>
					<?php
					$select_national_surety = "SELECT * FROM sys_pages ORDER BY PageID;";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					$bn = 0;
					for($y=0; $y<$num_national; $y++)
					{
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
			echo "<tr bgcolor='".$bgcolor."'>";
					?>
				
					<td>
					<?php
					$row_nat = mysqli_fetch_array($res_national);
					$PageIDb = $row_nat["PageID"];
					$com_name = $row_nat["name"];
					
					$max_per = "SELECT max(id) as maxID FROM sys_permissions WHERE PageID = '".$PageIDb."' AND UserTypeID = '".$_REQUEST["UserTypeID"]."'";
					$res_per = mysqli_query($db,$max_per);
					$rowPer = mysqli_fetch_array($res_per);
					$maxPerID = $rowPer["maxID"];
					
						$ns_name = "SELECT * FROM sys_permissions WHERE id = '".$maxPerID."';";
						$res_ns = mysqli_query($db,$ns_name);
						@$num_ns = mysqli_num_rows($res_ns);
						@$rw_ns = mysqli_fetch_array($res_ns);
						$view_prm = $rw_ns["view_permissions"];
						$insert_prm = $rw_ns["insert_permissions"];
						$delete_prm = $rw_ns["delete_permissions"];
						$edit_prm = $rw_ns["edit_permissions"];
						$list_prm = $rw_ns["list_permissions"];
						$setup_prm = $rw_ns["setup_permissions"];
					
						if($num_ns>="1")
						{
						echo "<input type='hidden' name='PageID".$y."' value='".$PageIDb."' id='pageID'>".$com_name;
						}
						else
						{
						echo "<input type='hidden' name='PageID".$y."' value='".$PageIDb."' id='pageID'>".$com_name." !!!";
						}
						
						echo "<input type='hidden' name='pageName".$y."' value='".$com_name."' id='pageID'>";
						?>
					</td><td><input type="checkbox" name="view_permissions<?php echo $y;?>" value="Yes" class="results1" <?php if($view_prm=="Yes"){ echo "checked";}?>></td><td><input type="checkbox" name="insert_permissions<?php echo $y;?>" value="Yes" class="results2" <?php if($insert_prm=="Yes"){ echo "checked";}?>></td><td><input type="checkbox" name="delete_permissions<?php echo $y;?>" value="Yes" class="results3" <?php if($delete_prm=="Yes"){ echo "checked";}?>></td></td><td><input type="checkbox" name="edit_permissions<?php echo $y;?>" value="Yes" class="results4" <?php if($edit_prm=="Yes"){ echo "checked";}?>></td><td><input type="checkbox" name="list_permissions<?php echo $y;?>" value="Yes" class="results5" <?php if($list_prm=="Yes"){ echo "checked";}?>></td><td><input type="checkbox" name="setup_permissions<?php echo $y;?>" value="Yes" class="results6" <?php if($setup_prm=="Yes"){ echo "checked";}?>></td>
				</tr>
				<?php
					}
					echo "<input name='numPG' type='hidden' value='".$num_national."'>";
					?>
				<tr>
					<td> </td><td> </td><td> </td><td><input name="proceedbtnx" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtnx"]=="Proceed" && ($_REQUEST["UserTypeID"]))
			{
			?>
			<form action="" method="POST">
			<input name="UserTypeID" type="hidden" value="<?php echo $_REQUEST["UserTypeID"]; ?>">
			
			<table align="center" width="95%" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>User Role: </td><td><?php echo $_REQUEST["UserTypeID"]; ?></td><td></td>
				</tr>
				<tr>
					<td><b>Component</b></td><td><b>View Permissions</b></td><td><b>Insert Permissions</b></td><td><b>Delete Permissions</b></td><td><b>Edit Permissions</b></td><td><b>List Permissions</b></td><td><b>Setup Permissions</b></td>
				</tr>
					<?php
					$num_nationalx = $_REQUEST["numPG"];
					$bn = 0;
					for($y=0; $y<$num_nationalx; $y++)
					{
					
			if($_REQUEST["delete_permissions".$y])
			{
			$vvv = $_REQUEST["delete_permissions".$y];
			}
			else
			{
			$vvv = "No";
			}
			
			
			
			if($_REQUEST["insert_permissions".$y])
			{
			$vvw = $_REQUEST["insert_permissions".$y];
			}
			else
			{
			$vvw = "No";
			}
			
			
			
			if($_REQUEST["view_permissions".$y])
			{
			$vvx = $_REQUEST["view_permissions".$y];
			}
			else
			{
			$vvx = "No";
			}
			
			
			
			if($_REQUEST["edit_permissions".$y])
			{
			$vvy = $_REQUEST["edit_permissions".$y];
			}
			else
			{
			$vvy = "No";
			}
			
			
			
			if($_REQUEST["list_permissions".$y])
			{
			$vvz = $_REQUEST["list_permissions".$y];
			}
			else
			{
			$vvz = "No";
			}
			
			
			
			if($_REQUEST["setup_permissions".$y])
			{
			$vva = $_REQUEST["setup_permissions".$y];
			}
			else
			{
			$vva = "No";
			}
			?>
			<input name="delete_permissions<?php echo $y; ?>" type="hidden" value="<?php echo $vvv; ?>">
			<input name="insert_permissions<?php echo $y; ?>" type="hidden" value="<?php echo $vvw; ?>">
			<input name="view_permissions<?php echo $y; ?>" type="hidden" value="<?php echo $vvx; ?>">
			<input name="edit_permissions<?php echo $y; ?>" type="hidden" value="<?php echo $vvy; ?>">
			<input name="list_permissions<?php echo $y; ?>" type="hidden" value="<?php echo $vva; ?>">
			<input name="setup_permissions<?php echo $y; ?>" type="hidden" value="<?php echo $vva; ?>">
			<input name="PageID<?php echo $y; ?>" type="hidden" value="<?php echo $_REQUEST["PageID".$y]; ?>">
	<?php
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
	
			echo "<tr bgcolor='".$bgcolor."'><td>";
					?>
					</td><td><?php echo $vvx;?></td><td><?php echo $vvw;?></td><td><?php echo $vvv;?></td><td><?php echo $vvy;?></td><td><?php echo $vvz;?></td><td><?php echo $vva;?></td>
				</tr>
				<?php
					}
					echo "<input name='numPG' type='hidden' value='".$num_nationalx."'>";
					?>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit")
			{
		$num_nationalx = $_REQUEST["numPG"];
					
		for($y=0; $y<$num_nationalx; $y++)
		{
		
		$deletef = "DELETE FROM sys_permissions WHERE (UserTypeID = '".$_REQUEST["UserTypeID"]."' AND PageID = '".$_REQUEST["PageID".$y]."');";
		$resf = mysqli_query($db,$deletef);
		
			$sql21 = "INSERT INTO sys_permissions (id,UserTypeID,PageID,view_permissions,insert_permissions,delete_permissions,edit_permissions,list_permissions,setup_permissions) VALUES ('','".$_REQUEST["UserTypeID"]."','".$_REQUEST["PageID".$y]."','".$_REQUEST["view_permissions".$y]."','".$_REQUEST["insert_permissions".$y]."','".$_REQUEST["delete_permissions".$y]."','".$_REQUEST["edit_permissions".$y]."','".$_REQUEST["list_permissions".$y]."','".$_REQUEST["setup_permissions".$y]."');";
			//echo $sql21;
			$res21 = mysqli_query($db,$sql21);
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record added successfully!</span></p>";
			
		$Operationx = "Set User Permissions.";
		include "mis/system_log.php";
					}
					else
					{
					echo "<p align='center'><span class='success'>Error inserting record into database. Please try again later.</span></p>";
					}
		}
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
	include "mis/access_denied.php";
	}

?>