<?php
 if(chkSes()=="Inactive")
{

} 
else 
{

	if($bx_permissions=="Yes")
	{
	
		if($_REQUEST["function"]=="home")
		{
		echo "test1";
		}
		elseif($_REQUEST["function"]=="supply")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["projectsReceivedOn"] || !$_REQUEST["NameOfPersonReceiving"] || !$_REQUEST["NumberOfprojectsRecvd"] || !$_REQUEST["StartingprojectNumber"] || !$_REQUEST["EndingprojectNumber"])))
			{
		?>
			
			<form action="" method="POST">
			<input name="function" size="30" type="hidden" value="supply">
			<table align="center" width="500">
				<tr>
					<td>Starting project Number: </td><td><input name="StartingprojectNumber" size="30" type="text" value="<?php echo $_REQUEST["StartingprojectNumber"]; ?>"></td>
				</tr>
				<tr>
					<td>Ending project Number: </td><td><input name="EndingprojectNumber" size="30" type="text" value="<?php echo $_REQUEST["EndingprojectNumber"]; ?>"></td>
				</tr>
				<tr>
					<td>Name Of Person Receiving: </td><td><input name="NameOfPersonReceiving" size="30" type="text" value="<?php echo $_REQUEST["NameOfPersonReceiving"]; ?>"></td>
				</tr>
				<tr>
					<td>Number Of projects Received: </td><td><input name="NumberOfprojectsRecvd" size="30" type="text" value="<?php echo $_REQUEST["NumberOfprojectsRecvd"]; ?>"></td>
				</tr>
				<tr>
					<td>Target Country: </td><td><select name="TargetCountry"><option value="<?php echo $_REQUEST["TargetCountry"]; ?>"><?php echo $_REQUEST["TargetCountry"]; ?></option>
					
					</select></td>
				</tr>
				<tr>
					<td>projects Received On: </td><td><label id="cx_DateOfIssue"><input name="projectsReceivedOn" id="x_DateOfIssue" maxlength="10" size="30" value="<?php echo $_REQUEST["projectsReceivedOn"]; ?>">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue" // ID of the button
}
);
</script></label></td>
				</tr>
				<tr>
					<td>Remarks: </td><td><textarea name="Remarks" rows="4" cols="25"><?php echo $_REQUEST["Remarks"]; ?></textarea></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["projectsReceivedOn"] && $_REQUEST["NameOfPersonReceiving"] && $_REQUEST["NumberOfprojectsRecvd"] && $_REQUEST["StartingprojectNumber"] && $_REQUEST["EndingprojectNumber"]))
			{
			?>
			<form action="" method="POST">
			<input name="Remarks" type="hidden" value="<?php echo $_REQUEST["Remarks"]; ?>">
			<input name="NumberOfprojectsRecvd" type="hidden" value="<?php echo $_REQUEST["NumberOfprojectsRecvd"]; ?>">
			<input name="NameOfPersonReceiving" type="hidden" value="<?php echo $_REQUEST["NameOfPersonReceiving"]; ?>">
			<input name="EndingprojectNumber" type="hidden" value="<?php echo $_REQUEST["EndingprojectNumber"]; ?>">
			<input name="StartingprojectNumber" type="hidden" value="<?php echo $_REQUEST["StartingprojectNumber"]; ?>">
			<input name="projectsReceivedOn" type="hidden" value="<?php echo $_REQUEST["projectsReceivedOn"]; ?>">
			<input name="TargetCountry" type="hidden" value="<?php echo $_REQUEST["TargetCountry"]; ?>">
			<table align="center" width="500">
				<tr>
					<td>Starting project Number: </td><td><?php echo $_REQUEST["StartingprojectNumber"]; ?></td>
				</tr>
				<tr>
					<td>Ending project Number: </td><td><?php echo $_REQUEST["EndingprojectNumber"]; ?></td>
				</tr>
				<tr>
					<td>Name Of Person Receiving: </td><td><?php echo $_REQUEST["NameOfPersonReceiving"]; ?></td>
				</tr>
				<tr>
					<td>Number Of projects Received: </td><td><?php echo $_REQUEST["NumberOfprojectsRecvd"]; ?></td>
				</tr>
				<tr>
					<td>Target Country: </td><td><?php echo $_REQUEST["TargetCountry"]; ?></td>
				</tr>
				<tr>
					<td>projects Received On: </td><td><?php echo $_REQUEST["projectsReceivedOn"]; ?></td>
				</tr>
				<tr>
					<td>Remarks: </td><td><?php echo $_REQUEST["Remarks"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			include_once "queries/ins_a_sec_cnts_rcpts.php";
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