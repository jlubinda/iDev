<?php

 if(@ privacy('Secure|Priv')=='Granted')
{
		
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="3")
		{
		echo "<form action='' method='POST'><table align='left' id='segment_nav_head3'><tr><td> &nbsp;&nbsp; <input name='search' type='text' size='25'> <input name='submitBtn' type='submit' value='Search'><br><br></td></tr></table></form>";

	 if(@ privacy('Secure|Priv')=='Granted')
	{

		echo "<table align='center' width='99%' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td><u><b>Name</b></u></td><td width='150'><u><b>Postal</b></u></td><td width='150'><u><b>Physical</b></u></td><td><u><b>Tel</b></u></td><td><u><b>Fax</b></u></td><td><u><b>Email</b></u></td><td><u><b>IT Admin</b></u></td><td><u><b>Branch Manager</b></u></td><td width='40'><u><b></b></u></td><td width='50'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM _org_branches WHERE org_id = '".$_REQUEST['typeID']."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeName = $row["name"];
			$postal = $row["postal"];
			$physical = $row["physical"];
			$tel = $row["tel"];
			$fax = $row["fax"];
			$email = $row["email"];
			$it_admin = $row["it_admin"];
			$branch_manager = $row["branch_manager"];
			
			
					$select_national_surety = "SELECT * FROM _user_acnts WHERE userID ='".$it_admin."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$row_nat = mysqli_fetch_array($res_national);
					$userID = $row_nat["userID"];
					$FirstName = $row_nat["FirstName"];
					$LastName = $row_nat["LastName"];
					$LoginName = $row_nat["LoginName"];
					$names_of_IT_ADMIN = $FirstName." ".$LastName;
			
					$select_national_surety2 = "SELECT * FROM _user_acnts WHERE userID ='".$branch_manager."';";
					$res_national2 = mysqli_query($db,$select_national_surety2);
					$row_nat2 = mysqli_fetch_array($res_national2);
					$FirstName2 = $row_nat2["FirstName"];
					$LastName2 = $row_nat2["LastName"];
					$LoginName2 = $row_nat2["LoginName"];
					$names_of_BRANCH_MANAGER = $FirstName2." ".$LastName2;
					
			
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$typeName."</td><td width='150'>".$postal."</td><td width='150'>".$physical."</td><td>".$tel."</td><td>".$fax."</td><td>".$email."</td><td>".$names_of_IT_ADMIN."</td><td width='40'>".$names_of_BRANCH_MANAGER."</td><td align='center'><a href='?ref=settings&segment=g1&function=edit&unit=10&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Edit</a></td><td align='center'><a href='?ref=settings&segment=g1&function=delete&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Delete</a></td></tr>";
			}
			
			echo "</table>";
	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="1")
		{
	 if(@ privacy('Secure|Priv')=='Granted')
	{
		echo "<table align='center' width='99%' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='70'><u><b>Status</b></u></td><td><u><b>Organization Details</b></u></td><td width='300'><u><b>Addresses</b></u></td><td><u><b>Contact Details</b></u></td><td><u><b>Country</b></u></td><td width='120'><u><b></b></u></td></tr>";
			
			
	
	if($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited")
	{
		if($_REQUEST['search'] && $_REQUEST['search'] != "")
		{
		$limiter = " WHERE name like '%".$_REQUEST['search']."%' OR postal like '%".$_REQUEST['search']."%' OR physical like '%".$_REQUEST['search']."%' OR tel like '%".$_REQUEST['search']."%' OR fax like '%".$_REQUEST['search']."%' OR email like '%".$_REQUEST['search']."%' OR website like '%".$_REQUEST['search']."%' OR country like '%".$_REQUEST['search']."%'";
		}
		else
		{
		$limiter = "";
		}
	}
	elseif($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country")
	{
		if($_REQUEST['search'] && $_REQUEST['search'] != "")
		{
		$limiter = "WHERE (country = '".$userCountry."') AND (name like '%".$_REQUEST['search']."%' OR postal like '%".$_REQUEST['search']."%' OR physical like '%".$_REQUEST['search']."%' OR tel like '%".$_REQUEST['search']."%' OR fax like '%".$_REQUEST['search']."%' OR email like '%".$_REQUEST['search']."%' OR website like '%".$_REQUEST['search']."%')";
		}
		else
		{
		$limiter = " WHERE (country = '".$userCountry."')";
		}
	}
	elseif($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization")
	{
	$limiter = " WHERE (id = '".$org."')";
	}
	else
	{
	$limiter = " WHERE (id = '".$org."')";
	}
			
			
			$sel = "SELECT * FROM _organization".$limiter.";";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeCodex = $row["type"];
			$typeName = $row["name"];
			$postal = $row["postal"];
			$physical = $row["physical"];
			$tel = $row["tel"];
			$fax = $row["fax"];
			$email = $row["email"];
			$has_branches = $row["has_branches"];
			$website = $row["website"];
			$country = $row["country"];
			$Status = $row["Status"];
			
			if($has_branches=="Yes")
			{
			$add_branch = "<a href='?ref=settings&segment=g1&function=add&unit=3&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Add Branch</a>";
			$view_branch = "<a href='?ref=settings&segment=g1&function=list&unit=3&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>View Branches</a>";
			}
			else
			{
			$add_branch = "";
			$view_branch = "";
			}
			
			if($Status=="Approved")
			{
			$xorgStatus = "Active";
			$xorgStatusLink = "<a href='?ref=settings&segment=g1&function=edit&unit=4&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."&status=Unapproved'>Deactivate</a>";
			}
			else
			{
			$xorgStatus = "Inactive";
			$xorgStatusLink = "<a href='?ref=settings&segment=g1&function=edit&unit=4&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."&status=Approved'>Activate</a>";
			}
			
			
				$selectType = "SELECT * FROM _org_types WHERE Code = '".$typeCodex."';";
				@$resType = mysqli_query($db,$selectType);
				$rowType = mysqli_fetch_array($resType);
				$typeCode = $rowType["Name"];
			
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
			
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#fcfcfc'>".($i+1).") </td><td align='center'><b>".$xorgStatus."</b><br><br>".$xorgStatusLink."</td><td align='left' width='300'><b>Name: </b> ".$typeName."<br><b>Type:</b> ".$typeCode."</td><td width='300'><b>Postal:</b> ".$postal."<br><b>Physical:</b> ".$physical."</td><td><b>Tel: </b>".$tel."<br><b>Fax: </b>".$fax."<br><b>Email: </b>".$email."<br><b>Website: </b>".$website."<br><br></td><td width='40'>".$country."</td><td align='center'><a href='?ref=settings&segment=g1&function=edit&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Edit</a><br><a href='?ref=settings&segment=g1&function=delete&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Delete</a><br><a href='?ref=settings&segment=e3&function=list&org_users=org&org_id=".$resourceTypeID."&orgname=".$typeName."'>View Users</a><br>".$view_branch."<br>".$add_branch."</td></tr>";
			}
			
			echo "</table>";
	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<table align="center" width="700" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the organization '<?php echo $_REQUEST["typeName"]; ?>' Type '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php

	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="edit" && $_REQUEST['unit']=="4" && $_REQUEST['status'] && $_REQUEST["typeID"] && $_REQUEST["typeName"])
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{
		if(!$_REQUEST["submitBtn"]=="Confirm")
		{
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="status" type="hidden" value="<?php echo $_REQUEST["status"]; ?>">
			<input name="typeName" type="hidden" value="<?php echo $_REQUEST["typeName"]; ?>">
			<table align="center" width="700" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm that you are rendering the organization '<?php echo $_REQUEST["typeName"]; ?>' <?php echo $_REQUEST["status"]; ?> <input name="submitBtn" type="submit" value="Confirm"></td>
				</tr>
			</table>
			</form>
			<?php
		}
		elseif($_REQUEST["submitBtn"]=="Confirm")
		{
		
		$delete = "UPDATE _organization SET Status = '".$_REQUEST["status"]."' WHERE id = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Rendered ".$_REQUEST["typeName"]." as `".$_REQUEST["status"]."`";
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
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && $_REQUEST['submitBtn']=="Delete")
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{

		$delete = "DELETE FROM _organization WHERE id = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Deleted Organization.";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="1")
		{
		
		
				$serch_LoginName = "SELECT * FROM _organization WHERE name = '".$_REQUEST["name"]."';";
				$res_LoginName = mysqli_query($db,$serch_LoginName);
				@$num_LoginName = mysqli_num_rows($res_LoginName);
				
    $_REQUEST["error_message"] = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $mobile_exp = "/^[+]{1}+[0-9]{10,14}$/i";
    $string_exp = "/^[A-Za-z .'-]+$/";
    $date_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $IssuedOn_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $numdays_exp = "/^[0-9]{1,3}$/i";
	
	/*
		<tr>
			<td>Country: </td><td><?php echo $_REQUEST["country"]; ?></td>			
		</tr>
		*/
		
  if($num_LoginName>="1") {
    $_REQUEST["error_message"] .= 'This Organization Name has already been registered.<br />';
  }
  if(!$_REQUEST["name"]) {
    $_REQUEST["error_message"] .= 'The "Organization Name" field is empty.<br />';
  }
  if(!$_REQUEST["type"]) {
    $_REQUEST["error_message"] .= 'The "Organization Type" field is empty.<br />';
  }
  if(!$_REQUEST["physical"]) {
    $_REQUEST["error_message"] .= 'The "Physical Address" field is empty.<br />';
  }
  if(!$_REQUEST["postal"]) {
    $_REQUEST["error_message"] .= 'The "Postal Address" field is empty.<br />';
  }
  if(!$_REQUEST["tel"]) {
    $_REQUEST["error_message"] .= 'The "Tel" field is empty.<br />';
  }
  if(!$_REQUEST["fax"]) {
    $_REQUEST["error_message"] .= 'The "Fax" field is empty.<br />';
  }
  if(!$_REQUEST["email"]) {
    $_REQUEST["error_message"] .= 'The "Email" field is empty.<br />';
  }
  if($_REQUEST["email"])
  {
  if(!preg_match($email_exp,$_REQUEST["email"])) {
    $_REQUEST["error_message"] .= 'The "Email" you entered does not appear to be valid.<br />';
  }
  }
  if(!$_REQUEST["has_branches"]) {
    $_REQUEST["error_message"] .= 'Has Branches" field is empty.<br />';
  }
  if(!$_REQUEST["country"]) {
    $_REQUEST["error_message"] .= 'The "Country" field is empty.<br />';
  }
  
  if(strlen($_REQUEST["error_message"]) > 0) {
   $err = 1;
  }
  else
  {
  $err = 2;
  }
  

	 if(@ privacy('Secure|Priv')=='Granted')
	{

			if(($err=="1") || (!$_REQUEST["proceedbtn"] || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["name"] || !$_REQUEST["type"] || !$_REQUEST["postal"] || !$_REQUEST["physical"] || !$_REQUEST["tel"] || !$_REQUEST["fax"] || !$_REQUEST["email"] || !$_REQUEST["country"])))
			{
			?>
			
<?php
  if($_REQUEST["proceedbtn"]=="Proceed" && $err=="1")
  {
  echo "<p align='center' class='errors'>Error! ".$_REQUEST["error_message"]."</p>";
  }
?>

<form action="" method="POST" id="form1">
	<table width="700" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Name: </td><td><input type="text" name="name" size="25" value="<?php echo $_REQUEST["name"]; ?>"></td>			
		</tr>
		<tr>
			<td>Organization Type: </td><td><select name="type"><option value="<?php echo $_REQUEST["type"]; ?>"><?php echo $_REQUEST["type"]; ?>
			<?php
					$select_org_type = "SELECT * FROM _org_types;";
					$res_org_type = mysqli_query($db,$select_org_type);
					@$num_org_type = mysqli_num_rows($res_org_type);
					for($yc=0; $yc<$num_org_type; $yc++)
					{
					@$row_nat = mysqli_fetch_array($res_org_type);
					$org_type_Code = $row_nat["Code"];
					$org_type_Name = $row_nat["Name"];
					echo "<option value='".$org_type_Code."'>".$org_type_Name."</option>";
					}
					?>
					</select></td>
		</tr>
		<tr>
			<td>Physical Address: </td><td><input type="text" name="physical" size="25" value="<?php echo $_REQUEST["physical"]; ?>"></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><input type="text" name="postal" size="25" value="<?php echo $_REQUEST["postal"]; ?>"></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><input type="text" name="tel" size="25" value="<?php echo $_REQUEST["tel"]; ?>"></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><input type="text" name="fax" size="25" value="<?php echo $_REQUEST["fax"]; ?>"></td>			
		</tr>
		<tr>
			<td>Email: </td><td><input type="text" name="email" size="25" value="<?php echo $_REQUEST["email"]; ?>"></td>			
		</tr>
		<tr>
			<td>Has Branches: </td><td><select name="has_branches"><option value="<?php echo $_REQUEST["has_branches"]; ?>"><?php echo $_REQUEST["has_branches"]; ?><option value="No">No</option><option value="Yes">Yes</option></select></td>			
		</tr>
		<tr>
			<td>Country: </td><td><select name="country"><option value="<?php echo $_REQUEST["country"]; ?>"><?php echo $_REQUEST["country"]; ?></option>
					<?php
					$select_national_surety = "SELECT * FROM refer_countries;";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$countryCode = $row_nat["Code"];
					echo "<option value='".$countryCode."'>".$countryCode."</option>";
					}
					?>
					</select></td>			
		</tr>
		<tr>
			<td></td><td><input name="proceedbtn" type="submit" Value="Proceed"></td>			
		</tr>
	</table>
	</form>
<br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($err=="2") && ($_REQUEST["name"] && $_REQUEST["type"] && $_REQUEST["postal"] && $_REQUEST["physical"] && $_REQUEST["tel"] && $_REQUEST["fax"] && $_REQUEST["email"] && $_REQUEST["country"]))
			{
			?>

			<form action="" method="POST">
<input type="hidden" name="name" value="<?php echo $_REQUEST["name"]; ?>">
<input type="hidden" name="type" value="<?php echo $_REQUEST["type"]; ?>">
<input type="hidden" name="postal" value="<?php echo $_REQUEST["postal"]; ?>">
<input type="hidden" name="physical" value="<?php echo $_REQUEST["physical"]; ?>">
<input type="hidden" name="tel" value="<?php echo $_REQUEST["tel"]; ?>">
<input type="hidden" name="fax" value="<?php echo $_REQUEST["fax"]; ?>">
<input type="hidden" name="email" value="<?php echo $_REQUEST["email"]; ?>">
<input type="hidden" name="country" value="<?php echo $_REQUEST["country"]; ?>">
<input type="hidden" name="CTG_Number" value="<?php echo $_REQUEST["CTG_Number"]; ?>">
<input type="hidden" name="has_branches" value="<?php echo $_REQUEST["has_branches"]; ?>">

	<table width="500" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Name: </td><td><?php echo $_REQUEST["name"]; ?></td>			
		</tr>
		<tr>
			<td>Organization Type: </td><td><?php echo $_REQUEST["type"]; ?></td>			
		</tr>
		<tr>
			<td>Physical Address: </td><td><?php echo $_REQUEST["physical"]; ?></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><?php echo $_REQUEST["postal"]; ?></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><?php echo $_REQUEST["tel"]; ?></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><?php echo $_REQUEST["fax"]; ?></td>		
		</tr>
		<tr>
			<td>Email: </td><td><?php echo $_REQUEST["email"]; ?></td>			
		</tr>
		<tr>
			<td>Has Branches: </td><td><?php echo $_REQUEST["has_branches"]; ?></td>			
		</tr>
		<tr>
			<td>Country: </td><td><?php echo $_REQUEST["country"]; ?></td>			
		</tr>
		<tr>
			<td><input name="editbtn" type="submit" Value="Edit"></td><td><input name="proceedbtn" type="submit" Value="Submit"></td>			
		</tr>
	</table></form><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="1")
			{
		
				
			$sql21 = "INSERT INTO _organization (id,name,type,postal,physical,tel,fax,email,has_branches,website,country,recordedby,Status) VALUES ('','".$_REQUEST["name"]."','".$_REQUEST["type"]."','".$_REQUEST["postal"]."','".$_REQUEST["physical"]."','".$_REQUEST["tel"]."','".$_REQUEST["fax"]."','".$_REQUEST["email"]."','".$_REQUEST["has_branches"]."','".$_REQUEST["website"]."','".$_REQUEST["country"]."','".$userID."','".$_REQUEST["Status"]."');";
			//echo $sql21;
			$res21 = mysqli_query($db,$sql21);
			
			
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record added successfully!</span></p>";
					}
					else
					{
					echo "<p align='center'><span class='success'>Error inserting record into database. Please try again later.</span></p>";
					}
			
		$Operationx = "Set Organization: ".$_REQUEST["name"].".";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="2")
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{

			if((!$_REQUEST["proceedbtn"] || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["Code"] || !$_REQUEST["Name"] || !$_REQUEST["Description"])))
			{
		?>
			<form action="" method="POST">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Organization Type Code: </td><td><input name="Code" size="30" type="text" value="<?php echo $_REQUEST["Code"]; ?>"></td>
				</tr>
				<tr>
					<td>Type Name: </td><td><input name="Name" size="30" type="text" value="<?php echo $_REQUEST["Name"]; ?>"></td>
				</tr>
				<tr>
					<td>Description: </td><td><input name="Description" size="30" type="text" value="<?php echo $_REQUEST["Description"]; ?>"></td>
				</tr>
				<tr>
					<td>Misc: </td><td><input name="Misc" size="30" type="text" value="<?php echo $_REQUEST["Misc"]; ?>"></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form><br>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["Code"] && $_REQUEST["Name"] && $_REQUEST["Description"]))
			{
			?>
			

			<form action="" method="POST">
<input type="hidden" name="Code" value="<?php echo $_REQUEST["Code"]; ?>">
<input type="hidden" name="Name" value="<?php echo $_REQUEST["Name"]; ?>">
<input type="hidden" name="Description" value="<?php echo $_REQUEST["Description"]; ?>">
<input type="hidden" name="Misc" value="<?php echo $_REQUEST["Misc"]; ?>">

	<table width="500" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Type Code: </td><td><?php echo $_REQUEST["Code"]; ?></td>			
		</tr>
		<tr>
			<td>Type Name: </td><td><?php echo $_REQUEST["Name"]; ?></td>			
		</tr>
		<tr>
			<td>Description: </td><td><?php echo $_REQUEST["Description"]; ?></td>			
		</tr>
		<tr>
			<td>Misc: </td><td><?php echo $_REQUEST["Misc"]; ?></td>			
		</tr>
		<tr>
			<td><input name="editbtn" type="submit" Value="Edit"></td><td><input name="proceedbtn" type="submit" Value="Submit"></td>			
		</tr>
	</table></form><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="2")
			{
			include "queries/ins_organization_type.php";
			
		$Operationx = "Set Organization Type: ".$_REQUEST["Name"].".";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST["function"]=="add" && $_REQUEST["unit"]=="3")
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{
	
			if((!$_REQUEST["proceedbtn"] || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["name"] || !$_REQUEST["it_admin"] || !$_REQUEST["postal"] || !$_REQUEST["physical"] || !$_REQUEST["tel"] || !$_REQUEST["fax"] || !$_REQUEST["email"] || !$_REQUEST["branch_manager"])))
			{
			?>
<form action="" method="POST" id="form1">
	<table width="700" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization: </td><td><?php
			if($_REQUEST["typeName"])
			{
			echo $_REQUEST["typeName"]; 
			}
			else
			{
			echo $orgNamez;
			}
			?></td>			
		</tr>
		<tr>
			<td>Branch Name: </td><td><input type="text" name="name" size="25" value="<?php echo $_REQUEST["name"]; ?>"></td>			
		</tr>
		<tr>
			<td>Physical Address: </td><td><input type="text" name="physical" size="25" value="<?php echo $_REQUEST["physical"]; ?>"></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><input type="text" name="postal" size="25" value="<?php echo $_REQUEST["postal"]; ?>"></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><input type="text" name="tel" size="25" value="<?php echo $_REQUEST["tel"]; ?>"></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><input type="text" name="fax" size="25" value="<?php echo $_REQUEST["fax"]; ?>"></td>			
		</tr>
		<tr>
			<td>Email: </td><td><input type="text" name="email" size="25" value="<?php echo $_REQUEST["email"]; ?>"></td>			
		</tr>
		<tr><?php
		
					if($_REQUEST["typeID"])
					{
					$orgIDxv = $_REQUEST["typeID"];
					}
					else
					{
					$orgIDxv = $orgIDz;
					?>
					<input type="hidden" name="typeID" value="<?php echo $orgIDxv; ?>">
					<?php
					}
					
		?>
			<td>IT Admin: </td><td><select name="it_admin"><option value="<?php echo $_REQUEST["it_admin"]; ?>"><?php echo $_REQUEST["it_admin"]; ?></option>
					<?php
					$select_national_surety1 = "SELECT * FROM _user_acnts WHERE org ='".$orgIDxv."';";
					$res_national1 = mysqli_query($db,$select_national_surety1);
					$num_national1 = mysqli_num_rows($res_national1);
					for($y1=0; $y1<$num_national1; $y1++)
					{
					$row_nat1 = mysqli_fetch_array($res_national1);
					$userID1 = $row_nat1["userID"];
					$FirstName1 = $row_nat1["FirstName"];
					$LastName1 = $row_nat1["LastName"];
					$LoginName1 = $row_nat1["LoginName"];
					$names_of1 = $FirstName1." ".$LastName1;
					echo "<option value='".$userID1."'>".$names_of1."</option>";
					}
					?>
					</select></td>			
		</tr>
		<tr>
			<td>Branch Manager: </td><td><select name="branch_manager"><option value="<?php echo $_REQUEST["branch_manager"]; ?>"><?php echo $_REQUEST["branch_manager"]; ?></option>
					<?php
					$select_national_surety = "SELECT * FROM _user_acnts WHERE org ='".$orgIDxv."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$userID = $row_nat["userID"];
					$FirstName = $row_nat["FirstName"];
					$LastName = $row_nat["LastName"];
					$LoginName = $row_nat["LoginName"];
					$names_of = $FirstName." ".$LastName;
					echo "<option value='".$userID."'>".$names_of."</option>";
					}
					?>
					</select></td>			
		</tr>
		<tr>
			<td></td><td><input name="proceedbtn" type="submit" Value="Proceed"></td>			
		</tr>
	</table>
	</form>
<br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["name"] && $_REQUEST["it_admin"] && $_REQUEST["postal"] && $_REQUEST["physical"] && $_REQUEST["tel"] && $_REQUEST["fax"] && $_REQUEST["email"] && $_REQUEST["branch_manager"]))
			{
			?>

			<form action="" method="POST">
<input type="hidden" name="typeID" value="<?php echo $_REQUEST["typeID"]; ?>">
<input type="hidden" name="name" value="<?php echo $_REQUEST["name"]; ?>">
<input type="hidden" name="postal" value="<?php echo $_REQUEST["postal"]; ?>">
<input type="hidden" name="physical" value="<?php echo $_REQUEST["physical"]; ?>">
<input type="hidden" name="tel" value="<?php echo $_REQUEST["tel"]; ?>">
<input type="hidden" name="fax" value="<?php echo $_REQUEST["fax"]; ?>">
<input type="hidden" name="email" value="<?php echo $_REQUEST["email"]; ?>">
<input type="hidden" name="it_admin" value="<?php echo $_REQUEST["it_admin"]; ?>">
<input type="hidden" name="branch_manager" value="<?php echo $_REQUEST["branch_manager"]; ?>">

	<table width="500" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Branch Name: </td><td><?php echo $_REQUEST["name"]; ?></td>			
		</tr>
		<tr>
			<td>Physical Address: </td><td><?php echo $_REQUEST["physical"]; ?></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><?php echo $_REQUEST["postal"]; ?></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><?php echo $_REQUEST["tel"]; ?></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><?php echo $_REQUEST["fax"]; ?></td>		
		</tr>
		<tr>
			<td>Email: </td><td><?php echo $_REQUEST["email"]; ?></td>			
		</tr>
		<tr>
			<td>IT Admin: </td><td><?php
			
					$select_national_surety = "SELECT * FROM _user_acnts WHERE userID ='".$_REQUEST["it_admin"]."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$row_nat = mysqli_fetch_array($res_national);
					$userID = $row_nat["userID"];
					$FirstName = $row_nat["FirstName"];
					$LastName = $row_nat["LastName"];
					$LoginName = $row_nat["LoginName"];
					$names_of = $FirstName." ".$LastName;
					echo $names_of;
					
			?></td>			
		</tr>
		<tr>
			<td>Branch Manager: </td><td><?php
			
					$select_national_surety2 = "SELECT * FROM _user_acnts WHERE userID ='".$_REQUEST["branch_manager"]."';";
					$res_national2 = mysqli_query($db,$select_national_surety2);
					$row_nat2 = mysqli_fetch_array($res_national2);
					$FirstName2 = $row_nat2["FirstName"];
					$LastName2 = $row_nat2["LastName"];
					$LoginName2 = $row_nat2["LoginName"];
					$names_of2 = $FirstName2." ".$LastName2;
					echo $names_of2;
					
			?></td>			
		</tr>
		<tr>
			<td><input name="editbtn" type="submit" Value="Edit"></td><td><input name="proceedbtn" type="submit" Value="Submit"></td>			
		</tr>
	</table></form><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="3")
			{
			
			$query_test = "select max(id) as max_ID from _org_branches where name = '".$_REQUEST["name"]."';";
			$result_test = mysqli_query($db,$query_test);
			@$row_test = mysqli_fetch_array($result_test);
			@$max_ID = $row_test["max_ID"];
		
				
			$sql21 = "INSERT INTO _org_branches (id,org_id,name,postal,physical,tel,fax,email,it_admin,branch_manager,recordedby) VALUES ('','".$_REQUEST["typeID"]."','".$_REQUEST["name"]."','".$_REQUEST["postal"]."','".$_REQUEST["physical"]."','".$_REQUEST["tel"]."','".$_REQUEST["fax"]."','".$_REQUEST["email"]."','".$_REQUEST["it_admin"]."','".$_REQUEST["branch_manager"]."','".$userID."');";
			//echo $sql21;
			$res21 = mysqli_query($db,$sql21);
			
			
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record added successfully!</span></p>";
			
		$Operationx = "Set organization branch ".$_REQUEST["name"].".";
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
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="list" && $_REQUEST['unit']=="2")
		{
			
	 if(@ privacy('Secure|Priv')=='Granted')
	{
		echo "<table align='center' width='900' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Code</b></u></td><td width='180'><u><b>Name</b></u></td><td><u><b>Description</b></u></td><td width='80'><u><b></b></u></td></tr>";
			$sel = "SELECT * FROM _org_types;";
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$typeCode."</td><td align='center'>".$typeName."</td><td align='left'> &nbsp;".$Description."</td><td align='center'><a href='?ref=settings&segment=g1&function=delete&unit=2&pvCode=".$_REQUEST["pvCode"]."&typeID=".$resourceTypeID."&typeName=".$typeName."&typeCode=".$typeCode."'>Delete</a></td></tr>";
			}
			echo "</table>";

	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<table align="center" width="500" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the organization type '<?php echo $_REQUEST["typeName"]; ?>' Code '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php

	}
	else
	{
	include "mis/access_denied.php";
	}
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="g1" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="2" && $_REQUEST['submitBtn']=="Delete")
		{
		
	 if(@ privacy('Secure|Priv')=='Granted')
	{
	
		$delete = "DELETE FROM _org_types WHERE id = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Deleted Organization Type.";
		include "mis/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}

	}
	else
	{
	include "mis/access_denied.php";
	}
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="1")
		{

	 if(@ privacy('Secure|Priv')=='Granted')
	{
	
			if((!$_REQUEST["proceedbtn"] || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["name"] || !$_REQUEST["type"] || !$_REQUEST["postal"] || !$_REQUEST["physical"] || !$_REQUEST["tel"] || !$_REQUEST["fax"] || !$_REQUEST["email"] || !$_REQUEST["country"])))
			{
			
			$sel = "SELECT * FROM _organization WHERE id = '".$_REQUEST["typeID"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$typeCodex = $row["type"];
			$typeName = $row["name"];
			$postal = $row["postal"];
			$physical = $row["physical"];
			$tel = $row["tel"];
			$fax = $row["fax"];
			$email = $row["email"];
			$has_branches = $row["has_branches"];
			$website = $row["website"];
			$country = $row["country"];
			$Status = $row["Status"];
			
			
				$selectType = "SELECT * FROM _org_types WHERE Code = '".$typeCodex."';";
				@$resType = mysqli_query($db,$selectType);
				$rowType = mysqli_fetch_array($resType);
				$typeCode = $rowType["Name"];
			?>
<form action="" method="POST" id="form1">
<input type="hidden" name="typeID" value="<?php echo $_REQUEST["typeID"]; ?>">
	<table width="700" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Name: </td><td><input type="text" name="name" size="25" value="<?php
			if($_REQUEST["name"])
			{
			 echo $_REQUEST["name"]; 
			}
			else
			{
			echo $typeName;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Organization Type: </td><td><select name="type"><?php
			if($_REQUEST["type"])
			{
			?>
			<option value="<?php echo $_REQUEST["type"]; ?>"><?php 
				$selectTypec = "SELECT * FROM _org_types WHERE Code = '".$_REQUEST["type"]."';";
				@$resTypec = mysqli_query($db,$selectTypec);
				$rowTypec = mysqli_fetch_array($resTypec);
				$typeCodec = $rowTypec["Name"];
				
				echo $typeCodec;
			?>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $typeCodex; ?>"><?php echo $typeCode; ?>
			<?php
			}
					$select_org_type = "SELECT * FROM _org_types;";
					$res_org_type = mysqli_query($db,$select_org_type);
					@$num_org_type = mysqli_num_rows($res_org_type);
					for($yc=0; $yc<$num_org_type; $yc++)
					{
					@$row_nat = mysqli_fetch_array($res_org_type);
					$org_type_Code = $row_nat["Code"];
					$org_type_Name = $row_nat["Name"];
					echo "<option value='".$org_type_Code."'>".$org_type_Name."</option>";
					}
					?>
					</select></td>
		</tr>
		<tr>
			<td>Physical Address: </td><td><input type="text" name="physical" size="25" value="<?php
			if($_REQUEST["physical"])
			{
			 echo $_REQUEST["physical"]; 
			}
			else
			{
			echo $physical;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><input type="text" name="postal" size="25" value="<?php
			if($_REQUEST["postal"])
			{
			 echo $_REQUEST["postal"]; 
			}
			else
			{
			echo $postal;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><input type="text" name="tel" size="25" value="<?php
			if($_REQUEST["tel"])
			{
			 echo $_REQUEST["tel"]; 
			}
			else
			{
			echo $tel;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><input type="text" name="fax" size="25" value="<?php
			if($_REQUEST["fax"])
			{
			 echo $_REQUEST["fax"]; 
			}
			else
			{
			echo $fax;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Email: </td><td><input type="text" name="email" size="25" value="<?php
			if($_REQUEST["email"])
			{
			 echo $_REQUEST["email"]; 
			}
			else
			{
			echo $email;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Has Branches: </td><td><select name="has_branches"><option value="<?php
			if($_REQUEST["has_branches"])
			{
			 echo $_REQUEST["has_branches"]; 
			}
			else
			{
			echo $has_branches;
			}
			?>"><?php 
			if($_REQUEST["has_branches"])
			{
			 echo $_REQUEST["has_branches"]; 
			}
			else
			{
			echo $has_branches;
			}
			?><option value="No">No</option><option value="Yes">Yes</option></select></td>			
		</tr>
		<tr>
			<td>Website: </td><td><input type="text" name="website" size="25" value="<?php
			if($_REQUEST["website"])
			{
			 echo $_REQUEST["website"]; 
			}
			else
			{
			echo $website;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Country: </td><td><select name="country"><?php
			if($_REQUEST["country"])
			{
			?>
			<option value="<?php echo $_REQUEST["country"]; ?>"><?php echo $_REQUEST["country"]; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
			<?php
			}
			?>
					<?php
					$select_national_surety = "SELECT * FROM refer_countries;";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$countryCode = $row_nat["Code"];
					echo "<option value='".$countryCode."'>".$countryCode."</option>";
					}
					?>
					</select></td>			
		</tr>
		<tr>
			<td></td><td><input name="proceedbtn" type="submit" Value="Proceed"></td>			
		</tr>
	</table>
	</form>
<br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["name"] && $_REQUEST["type"] && $_REQUEST["postal"] && $_REQUEST["physical"] && $_REQUEST["tel"] && $_REQUEST["fax"] && $_REQUEST["email"] && $_REQUEST["country"]))
			{
			?>

			<form action="" method="POST">
<input type="hidden" name="typeID" value="<?php echo $_REQUEST["typeID"]; ?>">
<input type="hidden" name="name" value="<?php echo $_REQUEST["name"]; ?>">
<input type="hidden" name="type" value="<?php echo $_REQUEST["type"]; ?>">
<input type="hidden" name="postal" value="<?php echo $_REQUEST["postal"]; ?>">
<input type="hidden" name="physical" value="<?php echo $_REQUEST["physical"]; ?>">
<input type="hidden" name="tel" value="<?php echo $_REQUEST["tel"]; ?>">
<input type="hidden" name="fax" value="<?php echo $_REQUEST["fax"]; ?>">
<input type="hidden" name="email" value="<?php echo $_REQUEST["email"]; ?>">
<input type="hidden" name="website" value="<?php echo $_REQUEST["website"]; ?>">
<input type="hidden" name="country" value="<?php echo $_REQUEST["country"]; ?>">
<input type="hidden" name="has_branches" value="<?php echo $_REQUEST["has_branches"]; ?>">

	<table width="500" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Name: </td><td><?php echo $_REQUEST["name"]; ?></td>			
		</tr>
		<tr>
			<td>Organization Type: </td><td><?php
				$selectTypec = "SELECT * FROM _org_types WHERE Code = '".$_REQUEST["type"]."';";
				@$resTypec = mysqli_query($db,$selectTypec);
				$rowTypec = mysqli_fetch_array($resTypec);
				$typeCodec = $rowTypec["Name"];
				echo $typeCodec;
			?></td>			
		</tr>
		<tr>
			<td>Physical Address: </td><td><?php echo $_REQUEST["physical"]; ?></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><?php echo $_REQUEST["postal"]; ?></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><?php echo $_REQUEST["tel"]; ?></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><?php echo $_REQUEST["fax"]; ?></td>		
		</tr>
		<tr>
			<td>Email: </td><td><?php echo $_REQUEST["email"]; ?></td>			
		</tr>
		<tr>
			<td>Has Branches: </td><td><?php echo $_REQUEST["has_branches"]; ?></td>			
		</tr>
		<tr>
			<td>Website: </td><td><?php echo $_REQUEST["website"]; ?></td>			
		</tr>
		<tr>
			<td>Country: </td><td><?php echo $_REQUEST["country"]; ?></td>			
		</tr>
		<tr>
			<td><input name="editbtn" type="submit" Value="Edit"></td><td><input name="proceedbtn" type="submit" Value="Submit"></td>			
		</tr>
	</table></form><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="1")
			{
			
			$sql21 = "UPDATE _organization SET name = '".$_REQUEST["name"]."',type = '".$_REQUEST["type"]."',postal = '".$_REQUEST["postal"]."',physical = '".$_REQUEST["physical"]."',tel = '".$_REQUEST["tel"]."',fax = '".$_REQUEST["fax"]."',email = '".$_REQUEST["email"]."',has_branches = '".$_REQUEST["has_branches"]."',website = '".$_REQUEST["website"]."',country = '".$_REQUEST["country"]."' WHERE id = '".$_REQUEST["typeID"]."';";
			//echo $sql21;
			$res21 = mysqli_query($db,$sql21);
			
			
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record updated successfully!</span></p>";
			
		$Operationx = "Set organization: ".$_REQUEST["name"].".";
		include "mis/system_log.php";
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
	include "mis/access_denied.php";
	}	
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="10")
		{
		
	 if(@ privacy('Secure|Priv')=='Granted')
	{
	
			if((!$_REQUEST["proceedbtn"] || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["name"] || !$_REQUEST["postal"] || !$_REQUEST["physical"] || !$_REQUEST["tel"] || !$_REQUEST["fax"] || !$_REQUEST["email"])))
			{
			
			$sel = "SELECT * FROM _org_branches WHERE id = '".$_REQUEST["typeID"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$row = mysqli_fetch_array($res);
			$resourceTypeID = $row["id"];
			$torg_id = $row["org_id"];
			$typeName = $row["name"];
			$postal = $row["postal"];
			$physical = $row["physical"];
			$tel = $row["tel"];
			$fax = $row["fax"];
			$email = $row["email"];
			$it_admin = $row["it_admin"];
			$branch_manager = $row["branch_manager"];
			
			
				$selectType = "SELECT * FROM _organization WHERE id = '".$torg_id."';";
				@$resType = mysqli_query($db,$selectType);
				$rowType = mysqli_fetch_array($resType);
				$tOrgNamex = $rowType["name"];
			
			
				$selectType2 = "SELECT * FROM _user_acnts WHERE userID = '".$it_admin."';";
				@$resType2 = mysqli_query($db,$selectType2);
				$rowType2 = mysqli_fetch_array($resType2);
				$tFirstName2 = $rowType2["FirstName"];
				$tLastname2 = $rowType2["LastName"];
				$tOrgNamex2 = $tFirstName2." ".$tLastname2;
			
			
				$selectType3 = "SELECT * FROM _user_acnts WHERE userID = '".$branch_manager."';";
				@$resType3 = mysqli_query($db,$selectType3);
				$rowType3 = mysqli_fetch_array($resType3);
				$tFirstName3 = $rowType3["FirstName"];
				$tLastname3 = $rowType3["LastName"];
				$tOrgNamex3 = $tFirstName3." ".$tLastname3;
			?>
<form action="" method="POST" id="form1">
<input type="hidden" name="typeID" value="<?php echo $_REQUEST["typeID"]; ?>">
	<table width="700" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Name: </td><td><?php echo $tOrgNamex;?></td>
		</tr>
		<tr>
			<td>Branch Name: </td><td><input type="text" name="name" size="25" value="<?php
			if($_REQUEST["name"])
			{
			 echo $_REQUEST["name"]; 
			}
			else
			{
			echo $typeName;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Physical Address: </td><td><input type="text" name="physical" size="25" value="<?php
			if($_REQUEST["physical"])
			{
			 echo $_REQUEST["physical"]; 
			}
			else
			{
			echo $physical;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><input type="text" name="postal" size="25" value="<?php
			if($_REQUEST["postal"])
			{
			 echo $_REQUEST["postal"]; 
			}
			else
			{
			echo $postal;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><input type="text" name="tel" size="25" value="<?php
			if($_REQUEST["tel"])
			{
			 echo $_REQUEST["tel"]; 
			}
			else
			{
			echo $tel;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><input type="text" name="fax" size="25" value="<?php
			if($_REQUEST["fax"])
			{
			 echo $_REQUEST["fax"]; 
			}
			else
			{
			echo $fax;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>Email: </td><td><input type="text" name="email" size="25" value="<?php
			if($_REQUEST["email"])
			{
			 echo $_REQUEST["email"]; 
			}
			else
			{
			echo $email;
			}
			?>"></td>			
		</tr>
		<tr>
			<td>IT Admin: </td><td>
					<select name="it_admin">
					<?php
			if($_REQUEST["it_admin"])
			{
			 ?>
			<option value="<?php echo $_REQUEST["it_admin"]; ?>"><?php
					$select_national_surety = "SELECT * FROM _user_acnts WHERE userID ='".$_REQUEST["it_admin"]."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$row_nat = mysqli_fetch_array($res_national);
					$userID = $row_nat["userID"];
					$FirstName = $row_nat["FirstName"];
					$LastName = $row_nat["LastName"];
					$LoginName = $row_nat["LoginName"];
					$names_of = $FirstName." ".$LastName;
					echo $names_of; ?></option>
			<?php			 
			}
			else
			{
			 ?>
			<option value="<?php echo $it_admin; ?>"><?php echo $tOrgNamex2; ?></option>
			<?php
			}?>
					
					<?php
					$select_national_surety1 = "SELECT * FROM _user_acnts WHERE org ='".$torg_id."';";
					$res_national1 = mysqli_query($db,$select_national_surety1);
					$num_national1 = mysqli_num_rows($res_national1);
					for($y1=0; $y1<$num_national1; $y1++)
					{
					$row_nat1 = mysqli_fetch_array($res_national1);
					$userID1 = $row_nat1["userID"];
					$FirstName1 = $row_nat1["FirstName"];
					$LastName1 = $row_nat1["LastName"];
					$LoginName1 = $row_nat1["LoginName"];
					$names_of1 = $FirstName1." ".$LastName1;
					echo "<option value='".$userID1."'>".$names_of1."</option>";
					}
					?>
					</select>
			</td>			
		</tr>
		<tr>
			<td>Branch Manager: </td><td><select name="branch_manager"><?php
			if($_REQUEST["branch_manager"])
			{
			 ?>
			<option value="<?php echo $_REQUEST["branch_manager"]; ?>"><?php 
			
			
			
					$select_national_surety2 = "SELECT * FROM _user_acnts WHERE userID ='".$_REQUEST["branch_manager"]."';";
					$res_national2 = mysqli_query($db,$select_national_surety2);
					$row_nat2 = mysqli_fetch_array($res_national2);
					$FirstName2 = $row_nat2["FirstName"];
					$LastName2 = $row_nat2["LastName"];
					$LoginName2 = $row_nat2["LoginName"];
					$names_of2 = $FirstName2." ".$LastName2;
					echo $names_of2; ?></option>
			<?php			 
			}
			else
			{
			 ?>
			<option value="<?php echo $branch_manager; ?>"><?php 
			
					$select_national_surety2 = "SELECT * FROM _user_acnts WHERE userID ='".$branch_manager."';";
					$res_national2 = mysqli_query($db,$select_national_surety2);
					$row_nat2 = mysqli_fetch_array($res_national2);
					$FirstName2 = $row_nat2["FirstName"];
					$LastName2 = $row_nat2["LastName"];
					$LoginName2 = $row_nat2["LoginName"];
					$names_of2 = $FirstName2." ".$LastName2;
					echo $names_of2; ?></option>
			<?php
			}?>
			<?php
					$select_national_surety = "SELECT * FROM _user_acnts WHERE org ='".$torg_id."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$userID = $row_nat["userID"];
					$FirstName = $row_nat["FirstName"];
					$LastName = $row_nat["LastName"];
					$LoginName = $row_nat["LoginName"];
					$names_of = $FirstName." ".$LastName;
					echo "<option value='".$userID."'>".$names_of."</option>";
					}
					?>
					</select></td>			
		</tr>
		<tr>
			<td></td><td><input name="proceedbtn" type="submit" Value="Proceed"></td>			
		</tr>
	</table>
	</form>
<br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["name"] && $_REQUEST["typeID"] && $_REQUEST["postal"] && $_REQUEST["physical"] && $_REQUEST["tel"] && $_REQUEST["fax"] && $_REQUEST["email"]))
			{
			?>

			<form action="" method="POST">
<input type="hidden" name="typeID" value="<?php echo $_REQUEST["typeID"]; ?>">
<input type="hidden" name="name" value="<?php echo $_REQUEST["name"]; ?>">
<input type="hidden" name="type" value="<?php echo $_REQUEST["type"]; ?>">
<input type="hidden" name="postal" value="<?php echo $_REQUEST["postal"]; ?>">
<input type="hidden" name="physical" value="<?php echo $_REQUEST["physical"]; ?>">
<input type="hidden" name="tel" value="<?php echo $_REQUEST["tel"]; ?>">
<input type="hidden" name="fax" value="<?php echo $_REQUEST["fax"]; ?>">
<input type="hidden" name="email" value="<?php echo $_REQUEST["email"]; ?>">
<input type="hidden" name="it_admin" value="<?php echo $_REQUEST["it_admin"]; ?>">
<input type="hidden" name="branch_manager" value="<?php echo $_REQUEST["branch_manager"]; ?>">

	<table width="500" align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>Organization Name: </td><td><?php echo $_REQUEST["name"]; ?></td>			
		</tr>
		<tr>
			<td>Physical Address: </td><td><?php echo $_REQUEST["physical"]; ?></td>			
		</tr>
		<tr>
			<td>Postal Address: </td><td><?php echo $_REQUEST["postal"]; ?></td>			
		</tr>
		<tr>
			<td>Tel: </td><td><?php echo $_REQUEST["tel"]; ?></td>			
		</tr>
		<tr>
			<td>Fax: </td><td><?php echo $_REQUEST["fax"]; ?></td>		
		</tr>
		<tr>
			<td>Email: </td><td><?php echo $_REQUEST["email"]; ?></td>			
		</tr>
		<tr>
			<td>IT Admin: </td><td><?php
			
					$select_national_surety = "SELECT * FROM _user_acnts WHERE userID ='".$_REQUEST["it_admin"]."';";
					$res_national = mysqli_query($db,$select_national_surety);
					$row_nat = mysqli_fetch_array($res_national);
					$userID = $row_nat["userID"];
					$FirstName = $row_nat["FirstName"];
					$LastName = $row_nat["LastName"];
					$LoginName = $row_nat["LoginName"];
					$names_of = $FirstName." ".$LastName;
					echo $names_of;
					
			?></td>			
		</tr>
		<tr>
			<td>Branch Manager: </td><td><?php
			
					$select_national_surety2 = "SELECT * FROM _user_acnts WHERE userID ='".$_REQUEST["branch_manager"]."';";
					$res_national2 = mysqli_query($db,$select_national_surety2);
					$row_nat2 = mysqli_fetch_array($res_national2);
					$FirstName2 = $row_nat2["FirstName"];
					$LastName2 = $row_nat2["LastName"];
					$LoginName2 = $row_nat2["LoginName"];
					$names_of2 = $FirstName2." ".$LastName2;
					echo $names_of2;
					
			?></td>			
		</tr>
		<tr>
			<td><input name="editbtn" type="submit" Value="Edit"></td><td><input name="proceedbtn" type="submit" Value="Submit"></td>			
		</tr>
	</table></form><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit" && $_REQUEST["unit"]=="10")
			{
			
			$sql21 = "UPDATE _org_branches SET name = '".$_REQUEST["name"]."',postal = '".$_REQUEST["postal"]."',physical = '".$_REQUEST["physical"]."',tel = '".$_REQUEST["tel"]."',fax = '".$_REQUEST["fax"]."',email = '".$_REQUEST["email"]."',it_admin = '".$_REQUEST["it_admin"]."',branch_manager = '".$_REQUEST["branch_manager"]."' WHERE id = '".$_REQUEST["typeID"]."';";
			//echo $sql21;
			$res21 = mysqli_query($db,$sql21);
			
			
					if($res21)
					{
					echo "<p align='center'><span class='success'>Record updated successfully!</span></p>";
			
		$Operationx = "Set organization: ".$_REQUEST["name"].".";
		include "mis/system_log.php";
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
	include "mis/access_denied.php";
	}
		}
		else
		{
		//echo "test3";
		}
}

?>