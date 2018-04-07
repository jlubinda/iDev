<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

	if($bx_permissions=="Yes")
	{
	//echo "<br><br><br>";
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1")
		{
		
		if(!$_REQUEST["submitBtn"]=="Confirm" || ($_REQUEST["submitBtn"]=="Confirm" && ($_REQUEST["Reason"]=="" || $_REQUEST["Reason"]=="," || $_REQUEST["Reason"]=="." || $_REQUEST["Reason"]=="'")))
		{
		$sta = "SELECT * FROM idev WHERE id = (SELECT max(id) AS maxID FROM idev WHERE UserGroup = '".$userLevel."');";
		@$resst = mysqli_query($db,$sta);
		@$nmst = mysqli_num_rows($resst);
		@$rwst = mysqli_fetch_array($resst);
		$Status = $rwst["Status"];
		$UserGroup = $rwst["UserGroup"];
		$Reason = $rwst["Reason"];
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="typeName" type="hidden" value="<?php echo $_REQUEST["typeName"]; ?>">
			<?php
			
		
		if($Status=="Enabled")
		{
		$newStatus = "Disabled";
		$newStatusAction = "<b>disabling</b>";
		}
		else
		{
		$newStatus = "Enabled";
		$newStatusAction = "<b>enabling</b>";
		}
			?>
			<input name="status" type="hidden" value="<?php echo $newStatus; ?>">
			<input name="UserGroup" type="hidden" value="<?php echo $UserGroup; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Status: </td><td>Enable<input name="status" type="radio" value="Enabled" checked> &nbsp;Disable<input name="status" type="radio" value="Disable"></td>
				</tr>
				<tr>
					<td>User Group: </td><td><select name="UserGroup"><?php
					$selv = "SELECT * FROM _bx_refer_users_types;";
					@$resv = mysqli_query($db,$selv);
					@$numvV = mysqli_num_rows($resv);
					for($j=0; $j<$numvV; $j++)
					{
					@$rwWf = mysqli_fetch_array($resv);
					$userGcode = $rwWf["UserTypeCode"];
					$userGname = $rwWf["UserTypeName"];
					echo "<option value='".$userGcode."'>".$userGname."</option>";
					}
					?></select></td>
				</tr>
				<tr>
					<td>Indicate the reason for doing so: </td><td><textarea name="Reason" rows='5' cols='30'></textarea></td>
				</tr>
				<tr>
					<td><input name="submitBtn" type="submit" value="Confirm"></td><td></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm" && !($_REQUEST["Reason"]=="" || $_REQUEST["Reason"]=="," || $_REQUEST["Reason"]=="." || $_REQUEST["Reason"]=="'"))
		{
		
		$delete = "INSERT INTO idev (id,Status,UserGroup,Reason,RecordedBy) VALUES ('','".$_REQUEST["status"]."','".$_REQUEST["UserGroup"]."','".$_REQUEST["Reason"]."','".$userID."');";
		$res = mysqli_query($db,$delete);
		
		
		//echo $delete;
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Rendered ".$_REQUEST["typeName"]." as `".$_REQUEST["status"]."`";
		include_once "iDevTools/system_log.php";
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

	}
	else
	{
	include_once "mis/access_denied.php";
	}
}
?>