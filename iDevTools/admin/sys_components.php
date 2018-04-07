<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

	if($bx_permissions=="Yes")
	{
		
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="h1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="1")
		{
		
		echo "<table align='center' width='900' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='150'><u><b>Page ID</b></u></td><td><u><b>Name</b></u></td><td><u><b>Description</b></u></td><td width='40'><u><b></b></u></td><td width='50'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM _bx_sys_pages ORDER BY PageID;";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeCode = $row["PageID"];
			$typeName = $row["name"];
			$descriptionx = $row["description"];
			$misc = $row["misc"];
			
			
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$typeCode."</td><td align='center'>".$typeName."</td><td align='center'>".$descriptionx."</td><td align='center'><a href='?ref=settings&segment=h1&function=edit&unit=2&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."&description=".$descriptionx."&misc=".$misc."'>Edit</a></td><td align='center'><a href='?ref=settings&segment=h1&function=delete&unit=2&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Delete</a></td></tr>";
			}
			echo "</table>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="h1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{
		
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="typeCode" type="hidden" value="<?php echo $_REQUEST["typeCode"]; ?>">
			<table align="center" width="800" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the system component '<?php echo $_REQUEST["typeName"]; ?>' System ID '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="h1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && $_REQUEST['submitBtn']=="Delete")
		{
		$delete = "DELETE FROM _bx_sys_pages WHERE id = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			
		$Operationx = "Deleted System Component.";
		include_once "iDevTools/system_log.php";
		
		$delete2 = "DELETE FROM sys_permissions WHERE PageID = '".$_REQUEST["typeCode"]."';";
		$res2 = mysqli_query($db,$delete2);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Revoked System Permissions.";
		include_once "iDevTools/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["description"] || !$_REQUEST["PageID"] || !$_REQUEST["name"])))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Component ID: </td><td><input name="PageID" size="30" type="text" value="<?php
					if($_REQUEST["regid"])
					{
					echo $_REQUEST["regid"];
					}
					else
					{
					echo $_REQUEST["PageID"]; 
					}
					?>"></td>
				</tr>
				<tr>
					<td>Component Name: </td><td><input name="name" size="30" type="text" value="<?php echo $_REQUEST["name"]; ?>"></td>
				</tr>
				<tr>
					<td>Description: </td><td><input name="description" size="30" type="text" value="<?php echo $_REQUEST["description"]; ?>"></td>
				</tr>
				<tr>
					<td>Misc: </td><td><input name="misc" size="30" type="text" value="<?php echo $_REQUEST["misc"]; ?>"></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["description"] && $_REQUEST["PageID"] && $_REQUEST["name"]))
			{
			?>
			<form action="" method="POST">
			<input name="misc" type="hidden" value="<?php echo $_REQUEST["misc"]; ?>">
			<input name="description" type="hidden" value="<?php echo $_REQUEST["description"]; ?>">
			<input name="name" type="hidden" value="<?php echo $_REQUEST["name"]; ?>">
			<input name="PageID" type="hidden" value="<?php echo $_REQUEST["PageID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Component ID: </td><td><?php echo $_REQUEST["PageID"]; ?></td>
				</tr>
				<tr>
					<td>Component Name: </td><td><?php echo $_REQUEST["name"]; ?></td>
				</tr>
				<tr>
					<td>Description: </td><td><?php echo $_REQUEST["description"]; ?></td>
				</tr>
				<tr>
					<td>Misc: </td><td><?php echo $_REQUEST["misc"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			include_once "queries/ins__bx_sys_pages.php";
			
		$Operationx = "Registered System Component.";
		include_once "iDevTools/system_log.php";
		
			echo "<p align='center'><a href='?ref=settings&segment=e2&function=add&regid=".$_REQUEST["regid"]."'>Assign User Permissions</a></p>";
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="2")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["description"] || !$_REQUEST["PageID"] || !$_REQUEST["name"])))
			{
		?>
			
			<form action="" method="POST">
			<input name="function" size="30" type="hidden" value="edit">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Component ID: </td><td><input name="PageID" size="30" type="text" value="<?php
					
					echo $_REQUEST["typeCode"]; 
					
					?>"></td>
				</tr>
				<tr>
					<td>Component Name: </td><td><input name="name" size="30" type="text" value="<?php echo $_REQUEST["typeName"]; ?>"></td>
				</tr>
				<tr>
					<td>Description: </td><td><input name="description" size="30" type="text" value="<?php echo $_REQUEST["description"]; ?>"></td>
				</tr>
				<tr>
					<td>Misc: </td><td><input name="misc" size="30" type="text" value="<?php echo $_REQUEST["misc"]; ?>"></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["description"] && $_REQUEST["PageID"] && $_REQUEST["name"]))
			{
			?>
			<form action="" method="POST">
			<input name="misc" type="hidden" value="<?php echo $_REQUEST["misc"]; ?>">
			<input name="description" type="hidden" value="<?php echo $_REQUEST["description"]; ?>">
			<input name="name" type="hidden" value="<?php echo $_REQUEST["name"]; ?>">
			<input name="PageID" type="hidden" value="<?php echo $_REQUEST["PageID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Component ID: </td><td><?php echo $_REQUEST["PageID"]; ?></td>
				</tr>
				<tr>
					<td>Component Name: </td><td><?php echo $_REQUEST["name"]; ?></td>
				</tr>
				<tr>
					<td>Description: </td><td><?php echo $_REQUEST["description"]; ?></td>
				</tr>
				<tr>
					<td>Misc: </td><td><?php echo $_REQUEST["misc"]; ?></td>
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
			
				
			$sql21 = "UPDATE _bx_sys_pages SET name = '".$_REQUEST["name"]."',description = '".$_REQUEST["description"]."',misc = '".$_REQUEST["misc"]."' WHERE PageID = '".$_REQUEST["PageID"]."';";
			$res21 = mysqli_query($db,$sql21);
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record updated successfully!</span></p>";
			
		$Operationx = "Editted System Component.";
		include_once "iDevTools/system_log.php";
					}
					else
					{
					echo "<p align='center'><span class='success'>Error updating record. Please try again later.</span></p>";
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
	include_once "mis/access_denied.php";
	}
}
?>