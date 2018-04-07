<?php
if(@ privacy('Secure|Priv')=='Granted')
{
	//echo "<br><br><br>";
		
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="1")
		{
		
		echo "<table align='center' width='700' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Code</b></u></td><td><u><b>Description</b></u></td><td width='80'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM refer_countries;";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeCode = $row["Code"];
			$typeName = $row["Name"];
			$Description = $row["Description"];
			$dateset = $row["dateset"];
			
			
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$typeCode."</td><td align='center'>".$typeName."</td><td align='center'><a href='?ref=settings&segment=c1&function=delete&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Delete</a></td></tr>";
			}
			echo "</table>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{
		
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the country '<?php echo $_REQUEST["typeName"]; ?>' Code '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && $_REQUEST['submitBtn']=="Delete")
		{
		$delete = "DELETE FROM refer_countries WHERE id = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Deleted Country ".$_REQUEST["typeID"].".";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="1")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["Name"] || !$_REQUEST["Code"])))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Country Name: </td><td><input name="Name" size="30" type="text" value="<?php echo $_REQUEST["Name"]; ?>"></td>
				</tr>
				<tr>
					<td>Country Code: </td><td><input name="Code" size="30" type="text" value="<?php echo $_REQUEST["Code"]; ?>"></td>
				</tr>
				<tr>
					<td>Description: </td><td><input name="Description" size="30" type="text" value="<?php echo $_REQUEST["Description"]; ?>"></td>
				</tr>
				<tr>
					<td>Short Code: </td><td><input name="ShortCode" size="30" type="text" value="<?php echo $_REQUEST["ShortCode"]; ?>"></td>
				</tr>
				<tr>
					<td>Has Ratified The Yellow Card Scheme: </td><td><select name="HasRatifiedTheBondScheme"><option value="<?php echo $_REQUEST["HasRatifiedTheBondScheme"]; ?>"><?php echo $_REQUEST["HasRatifiedTheBondScheme"]; ?>
					<option value="0">No</option><option value="1">Yes</option>
					</select></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["Code"] && $_REQUEST["Name"]))
			{
			?>
			<form action="" method="POST">
			<input name="Code" type="hidden" value="<?php echo $_REQUEST["Code"]; ?>">
			<input name="Name" type="hidden" value="<?php echo $_REQUEST["Name"]; ?>">
				<input name="Description" type="hidden" value="<?php echo $_REQUEST["Description"]; ?>">
				<input name="ShortCode" type="hidden" value="<?php echo $_REQUEST["ShortCode"]; ?>">
			<input name="Corridor" type="hidden" value="<?php echo $_REQUEST["Corridor"]; ?>">
			<input name="HasRatifiedTheBondScheme" type="hidden" value="<?php echo $_REQUEST["HasRatifiedTheBondScheme"]; ?>">
			<input name="CustomsSystemInUse" type="hidden" value="<?php echo $_REQUEST["CustomsSystemInUse"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Country Code: </td><td><?php echo $_REQUEST["Code"]; ?></td>
				</tr>
				<tr>
					<td>Country Name: </td><td><?php echo $_REQUEST["Name"]; ?></td>
				</tr>
				<tr>
					<td>Description: </td><td><?php echo $_REQUEST["Description"]; ?></td>
				</tr>
				<tr>
					<td>Short Code: </td><td><?php echo $_REQUEST["ShortCode"]; ?></td>
				</tr>
				<tr>
					<td>Has Ratified The Yellow Card Scheme: </td><td><?php echo $_REQUEST["HasRatifiedTheBondScheme"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="1")
			{
		
			$query_test = "select * FROM refer_countries where Code = '".$_REQUEST["Code"]."';";
			$result_test = mysqli_query($db,$query_test);
			@$row_test = mysqli_fetch_array($result_test);
			@$countryCode = $row_test["Code"];
		
				
			$sql21 = "INSERT INTO refer_countries (Code,Name,Description,Corridor,HasRatifiedTheBondScheme,CustomsSystemInUse,NationalSurety,Currency,_used,_uid) VALUES ('".$_REQUEST["Code"]."','".$_REQUEST["Name"]."','".$_REQUEST["Description"]."','".$_REQUEST["Corridor"]."','".$_REQUEST["HasRatifiedTheBondScheme"]."','".$_REQUEST["CustomsSystemInUse"]."','','".$_REQUEST["Currency"]."','','');";
			$res21 = mysqli_query($db,$sql21);
			
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record added successfully!</span></p>";
			
		$Operationx = "Setup Country ".$_REQUEST["Code"].".";
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
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="2")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["SelectedCountry"] || !$_REQUEST["CurrencyCode"] || !$_REQUEST["CurrencyName"] || !$_REQUEST["CurrencySymbol"])))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="250" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Country: </td><td><select name="SelectedCountry"><option value="<?php echo $_REQUEST["SelectedCountry"]; ?>"><?php echo $_REQUEST["SelectedCountry"]; ?>
					<?php
					$select_country = "SELECT * FROM refer_countries;";
					$res_country = mysqli_query($db,$select_country);
					$num_country = mysqli_num_rows($res_country);
					for($y=0; $y<$num_country; $y++)
					{
					$row_country = mysqli_fetch_array($res_country);
					$country = $row_country["Code"];
					echo "<option value='".$country."'>".$country."</option>";
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Code: </td><td><input name="CurrencyCode" type="text" size="15" value="<?php echo $_REQUEST["CurrencyCode"]; ?>"></td>
				</tr>
				<tr>
					<td>Name: </td><td><input name="CurrencyName" type="text" size="15" value="<?php echo $_REQUEST["CurrencyName"]; ?>"></td>
				</tr>
				<tr>
					<td>Symbol: </td><td><input name="CurrencySymbol" type="text" size="15" value="<?php echo $_REQUEST["CurrencySymbol"]; ?>"></td>
				</tr>
				<tr>
					<td></td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && $_REQUEST["CurrencyCode"] && $_REQUEST["CurrencyName"] && $_REQUEST["CurrencySymbol"])
			{
		?>
			<form action="" method="POST">
			<input name="SelectedCountry" type="hidden" value="<?php echo $_REQUEST["SelectedCountry"]; ?>">
			<input name="CurrencyCode" type="hidden" value="<?php echo $_REQUEST["CurrencyCode"]; ?>">
			<input name="CurrencyName" type="hidden" value="<?php echo $_REQUEST["CurrencyName"]; ?>">
			<input name="CurrencySymbol" type="hidden" value="<?php echo $_REQUEST["CurrencySymbol"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Country: </td><td><?php echo $_REQUEST["SelectedCountry"]; ?></td>
				</tr>
				<tr>
					<td>Currency Name: </td><td><?php echo $_REQUEST["CurrencyName"]; ?></td>
				</tr>
				<tr>
					<td>Symbol: </td><td><?php echo $_REQUEST["CurrencySymbol"]; ?></td>
				</tr>
				<tr>
					<td>Code: </td><td><?php echo $_REQUEST["CurrencyCode"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["SelectedCountry"] && $_REQUEST["unit"]=="2")
			{
			include "queries/ins_currencies.php";
			
		$Operationx = "Set ".$_REQUEST["SelectedCountry"]." as ".$_REQUEST["CurrencyCode"].".";
		include "mis/system_log.php";
			}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="4")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed") || ($_REQUEST["proceedbtn"]=="Proceed" && !$_REQUEST["SelectedCountry"] && !$_REQUEST["SelectedOrganization"]))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="250" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Select Country: </td><td><select name="SelectedCountry"><option value="<?php echo $_REQUEST["SelectedCountry"]; ?>"><?php echo $_REQUEST["SelectedCountry"]; ?>
					<?php
					$select_country = "SELECT * FROM refer_countries;";
					$res_country = mysqli_query($db,$select_country);
					$num_country = mysqli_num_rows($res_country);
					for($y=0; $y<$num_country; $y++)
					{
					$row_country = mysqli_fetch_array($res_country);
					$country = $row_country["Code"];
					echo "<option value='".$country."'>".$country."</option>";
					}
					?>
					</option></td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && !$_REQUEST["SelectedOrganization"])
			{
		?>
			<form action="" method="POST">
			<input name="SelectedCountry" size="30" type="hidden" value="<?php echo $_REQUEST["SelectedCountry"]; ?>">
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Select Organization: </td><td><select name="SelectedOrganization"><option value="<?php echo $_REQUEST["SelectedOrganization"]; ?>"><?php echo $_REQUEST["SelectedOrganization"]; ?>
					<?php
					$select_national_surety = "SELECT * FROM _organization where country = '".$_REQUEST["SelectedCountry"]."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$surety = $row_nat["name"];
					$id = $row_nat["id"];
					echo "<option value='".$id."'>".$surety."</option>";
					}
					?>
					</option></td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && $_REQUEST["SelectedOrganization"])
			{

				$insert = "UPDATE refer_countries SET NationalSurety =  '".$_REQUEST["SelectedOrganization"]."' WHERE  Code =  '".$_REQUEST["SelectedCountry"]."';";
				$res = mysqli_query($db,$insert);
				if($res)
				{
				echo "<p align='center'>National Bureau for ".$_REQUEST["SelectedCountry"]." has successfully been set.</p>";
			
		$Operationx = "Set National Bureau for ".$_REQUEST["SelectedCountry"].".";
		include "mis/system_log.php";
				}
				else
				{
				echo "<p align='center'>Error setting the National Surety for ".$_REQUEST["SelectedCountry"]."</p>";
				}
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
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
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
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="3")
			{
			include "queries/ins_a_sec_cnts_rcpts.php";
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="5")
		{
		
			if($LimitedTozz == "Unlimited")
			{
			if((!$_REQUEST["proceedbtn"]=="Proceed") || ($_REQUEST["proceedbtn"]=="Proceed" && !$_REQUEST["SelectedCountry"] && !$_REQUEST["Amount"]))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="250" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Select Country: </td><td><select name="SelectedCountry"><option value="<?php echo $_REQUEST["SelectedCountry"]; ?>"><?php echo $_REQUEST["SelectedCountry"]; ?>
					<?php
					$select_country = "SELECT * FROM refer_countries;";
					$res_country = mysqli_query($db,$select_country);
					$num_country = mysqli_num_rows($res_country);
					for($y=0; $y<$num_country; $y++)
					{
					$row_country = mysqli_fetch_array($res_country);
					$country = $row_country["Code"];
					echo "<option value='".$country."'>".$country."</option>";
					}
					?>
					</option></td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			}
			else
			{
			$_REQUEST["SelectedCountry"] = $userCountry;
			$_REQUEST["proceedbtn"] = "Proceed";
			}
			//echo $_REQUEST["SelectedCountry"];
			
			if($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && !$_REQUEST["Amount"] && !$_REQUEST["DateSet"])
			{
		?>
			<form action="" method="POST">
			<input name="SelectedCountry" size="30" type="hidden" value="<?php echo $_REQUEST["SelectedCountry"]; ?>">
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>1 USD = </td><td><input name="Amount" type="text" size="15"> <?php
					
					if($LimitedTozz == "Unlimited")
					{
			$sel = "SELECT * FROM refer_currencies WHERE Country = '".$_REQUEST["SelectedCountry"]."';";
			@$res = mysqli_query($db,$sel);
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeCode = $row["Code"];
			$typeName = $row["CurrencyName"];
			$Description = $row["CurrencySymbol"];
			
			echo $typeCode;
					}
					else
					{
					echo $userCurrencyCode;
					}
					
					?></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="cx_DateOfIssue"><input type="text" name="DateSet" size="10" id="x_DateOfIssue" maxlength="10" value="<?php echo date("Y-m-d"); ?>">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue" // ID of the button
}
);
</script></td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && $_REQUEST["Amount"] && $_REQUEST["DateSet"])
			{

				$insert = "INSERT INTO _exchange_rates (id,Amount,DateSet,uid,Country) VALUES ('','".$_REQUEST["Amount"]."','".$_REQUEST["DateSet"]."','".$userID."','".$_REQUEST["SelectedCountry"]."');";
				$res = mysqli_query($db,$insert);
				if($res)
				{
				echo "<p align='center'>Current exchange rate for ".$_REQUEST["SelectedCountry"]." has successfully been set.</p>";
			
		$Operationx = "Set ".$_REQUEST["DateSet"]." exchange rate for ".$_REQUEST["SelectedCountry"].".";
		include "mis/system_log.php";
				}
				else
				{
				echo "<p align='center'>Error setting the exchange rate for ".$_REQUEST["SelectedCountry"]."</p>";
				}
			}
			else
			{
			//echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="6")
		{
		
			if($LimitedTozz == "Unlimited")
			{
			if((!$_REQUEST["proceedbtn"]=="Proceed") || ($_REQUEST["proceedbtn"]=="Proceed" && !$_REQUEST["SelectedCountry"] && !$_REQUEST["Amount"]))
			{
		?>
			
			<form action="" method="POST">
			<table align="center" width="250" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Select Country: </td><td><select name="SelectedCountry"><option value="<?php echo $_REQUEST["SelectedCountry"]; ?>"><?php echo $_REQUEST["SelectedCountry"]; ?>
					<?php
					$select_country = "SELECT * FROM refer_countries;";
					$res_country = mysqli_query($db,$select_country);
					$num_country = mysqli_num_rows($res_country);
					for($y=0; $y<$num_country; $y++)
					{
					$row_country = mysqli_fetch_array($res_country);
					$country = $row_country["Code"];
					echo "<option value='".$country."'>".$country."</option>";
					}
					?>
					</option></td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			}
			else
			{
			$_REQUEST["SelectedCountry"] = $userCountry;
			$_REQUEST["proceedbtn"] = "Proceed";
			}
			//echo $_REQUEST["SelectedCountry"];
			
			if($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && ((!$_REQUEST["Tax1"] || !$_REQUEST["Amount1"] || !$_REQUEST["ValidFrom1"] || !$_REQUEST["SecessionChargable1"]) && (!$_REQUEST["Tax2"] || !$_REQUEST["Amount2"] || !$_REQUEST["ValidFrom2"] || !$_REQUEST["SecessionChargable2"])))
			{
		?>
			<form action="" method="POST">
			<input name="SelectedCountry" size="30" type="hidden" value="<?php echo $_REQUEST["SelectedCountry"]; ?>">
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Fixed Tax Name: <input name="Tax1" type="text" size="25"> &nbsp;&nbsp;Amount: <input name="Amount1" type="text" size="15"> &nbsp;&nbsp;Valid From: <label id="cx_DateOfIssue"><input type="text" name="ValidFrom1" size="10" id="x_DateOfIssue" maxlength="10" value="<?php echo date("Y-m-d"); ?>">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue" // ID of the button
}
);
</script></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Is This Tax Premium Secession Chargable: <select name="SecessionChargable1" type="radio"><option value="Yes">Yes &nbsp;</option><option value="No">No</option></select></td></tr><tr><td>Percentage Tax Name: <input name="Tax2" type="text" size="25"> &nbsp;&nbsp;Value: <input name="Amount2" type="text" size="15"> &nbsp;&nbsp;Valid From: <label id="cx_DateOfIssue2"><input type="text" name="ValidFrom2" size="10" id="x_DateOfIssue2" maxlength="10" value="<?php echo date("Y-m-d"); ?>">
&nbsp;<img src="misc/ew_calendar.gif" id="cx_DateOfIssue2" alt="Pick a Date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup(
{
inputField : "x_DateOfIssue2", // ID of the input field
ifFormat : "%Y-%m-%d", // the date format
button : "cx_DateOfIssue2" // ID of the button
}
);
</script></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Is This Tax Premium Secession Chargable: <select name="SecessionChargable2" type="radio"><option value="Yes">Yes &nbsp;</option><option value="No">No</option></select></td></tr><tr><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br><br><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $_REQUEST["SelectedCountry"] && (($_REQUEST["Tax1"] && $_REQUEST["Amount1"] && $_REQUEST["ValidFrom1"] && $_REQUEST["SecessionChargable1"]) || ($_REQUEST["Tax2"] && $_REQUEST["Amount2"] && $_REQUEST["ValidFrom2"] && $_REQUEST["SecessionChargable2"])))
			{
				if($_REQUEST["Tax1"] && $_REQUEST["Amount1"] && $_REQUEST["ValidFrom1"] && $_REQUEST["SecessionChargable1"])
				{
				$insert = "INSERT INTO _taxes (id,Tax,TaxType,Amount,ValidFrom,SecessionChargable,uid,Country) VALUES ('','".$_REQUEST["Tax1"]."','Fixed Tax','".$_REQUEST["Amount1"]."','".$_REQUEST["ValidFrom1"]."','".$_REQUEST["SecessionChargable1"]."','".$userID."','".$_REQUEST["SelectedCountry"]."');";
				$res = mysqli_query($db,$insert);
				if($res)
				{
				echo "<p align='center'>Fixed tax value for ".$_REQUEST["SelectedCountry"]." has successfully been set.</p>";
			
		$Operationx = "Set ".$_REQUEST["ValidFrom1"]." fixed tax value for ".$_REQUEST["SelectedCountry"].".";
		include "mis/system_log.php";
				}
				else
				{
				echo "<p align='center'>Error setting the fixed tax value for ".$_REQUEST["SelectedCountry"]."</p>";
				}
				}
				
				
				if($_REQUEST["Tax2"] && $_REQUEST["Amount2"] && $_REQUEST["ValidFrom2"] && $_REQUEST["SecessionChargable2"])
				{
				$insert = "INSERT INTO _taxes (id,Tax,TaxType,Amount,ValidFrom,SecessionChargable,uid,Country) VALUES ('','".$_REQUEST["Tax2"]."','Percentage Tax','".$_REQUEST["Amount2"]."','".$_REQUEST["ValidFrom2"]."','".$_REQUEST["SecessionChargable2"]."','".$userID."','".$_REQUEST["SelectedCountry"]."');";
				$res = mysqli_query($db,$insert);
				if($res)
				{
				echo "<p align='center'>Percentage tax rate for ".$_REQUEST["SelectedCountry"]." has successfully been set.</p>";
			
		$Operationx = "Set ".$_REQUEST["ValidFrom2"]." percentage tax rate for ".$_REQUEST["SelectedCountry"].".";
		include "mis/system_log.php";
				}
				else
				{
				echo "<p align='center'>Error setting the percentage tax rate for ".$_REQUEST["SelectedCountry"]."</p>";
				}
				}
				
			}
			else
			{
			//echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="3")
		{
		
		echo "<table align='center' width='700' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Code</b></u></td><td><u><b>Description</b></u></td><td width='80'><u><b>Country</b></u></td><td width='80'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM refer_currencies;";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeCode = $row["Code"];
			$typeName = $row["CurrencyName"];
			$Description = $row["CurrencySymbol"];
			$CountryXX = $row["Country"];
			
			
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$typeCode."</td><td align='center'>".$typeName."</td><td width='80' align='center'>".$CountryXX."</td><td align='center'><a href='?ref=settings&segment=c1&function=delete&unit=3&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Delete</a></td></tr>";
			}
			echo "</table>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="3" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{
		
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the currency '<?php echo $_REQUEST["typeName"]; ?>' Code '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="c1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="3" && $_REQUEST['submitBtn']=="Delete")
		{
		$delete = "DELETE FROM refer_currencies WHERE id = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Deleted Currency.";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
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