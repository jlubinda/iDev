<?php
 if(chkSes()=="Inactive")
{

} 
else 
{




echo "<div><table id='segment_nav_head'><td width='60' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=list&pvCode=".$_REQUEST["pvCode"]."'>LIST</a></span></td><td width='180' align='center'><span class='segment_nav'><a href='?ref=".$_REQUEST['ref']."&segment=".$_REQUEST['segment']."&function=create&unit=1&pvCode=".$_REQUEST["pvCode"]."'>CREATE USER ACCOUNT</a></span></td><td></td></table></div>";

	echo "<br><br><br>";
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="list")
		{
		
	if($bx_permissions=="Yes")
	{
		echo "<table align='center' width='1000' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='150'><u><b>User Type</b></u></td><td><u><b>User Name</b></u></td><td><u><b>Names</b></u></td><td width='150'><u><b>Postal</b></u></td><td width='150'><u><b>Physical</b></u></td><td><u><b>Tel</b></u></td><td><u><b>Fax</b></u></td><td><u><b>Email</b></u></td><td><u><b>Mobile</b></u></td><td><u><b>Country</b></u></td><td width='40'><u><b></b></u></td><td width='50'><u><b></b></u></td><td width='50'><u><b></b></u></td><td width='50'><u><b></b></u></td></tr>";	

	if(!$org_limiter3)
	{
	$limiter = $org_limiter3;
	}
	else
	{
	$limiter = "WHERE ".$org_limiter3;
	}
			
			$sel = "SELECT * FROM _user_acnts ".$limiter.";";
			//echo $sel;
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$userID = $row["userID"];
			$orgx = $row["org"];
			$Branchbx = $row["Branch"];
			$FirstName = $row["FirstName"];
			$LastName = $row["LastName"];
			$typeName = $FirstName." ".$LastName;
			$postal = $row["Postal"];
			$physical = $row["Address"];
			$tel = $row["Telephone"];
			$fax = $row["Fax"];
			$email = $row["Email"];
			$Mobile = $row["Mobile"];
			$country = $row["Country"];
			$Status = $row["Status"];
			$typeCodex = $row["level"];
			$LoginName = $row["LoginName"];
			
			
				$selectType = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$typeCodex."';";
				@$resType = mysqli_query($db,$selectType);
				$rowType = mysqli_fetch_array($resType);
				$typeCode = $rowType["UserTypeName"];
				
				
					$ns_name = "SELECT * FROM _organization WHERE id = '".$orgx."';";
					$res_ns = mysqli_query($db,$ns_name);
					$row_ns = mysqli_fetch_array($res_ns);
					$surety = $row_ns["name"];
					$suretyID = $row_ns["id"];
					$suretyBrn = $row_ns["has_branches"];
					
					if($suretyBrn=="Yes")
					{
						if($Branchbx>="1")
						{
						$wordin = "Change Branch";
						}
						else
						{
						$wordin = "Assign to Branch";
						}
						
						$assign_to_branch = "<a href='?ref=settings&segment=e3&function=add&unit=5&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>".$wordin."</a>";
					}
					else
					{
					$assign_to_branch = "";
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$typeCode."</td><td align='center' width='200'>".$LoginName."</td><td align='center' width='200'>".$typeName."</td><td width='150'>".$postal."</td><td width='150'>".$physical."</td><td>".$tel."</td><td>".$fax."</td><td>".$email."</td><td>".$Mobile."</td><td width='40'>".$country."</td><td align='center'><a href='?ref=settings&segment=e3&function=history&unit=4&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>History</a></td><td align='center'>".$assign_to_branch."</td><td align='center'><a href='?ref=settings&segment=e3&function=edit&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>Edit</a></td><td align='center'><a href='?ref=settings&segment=e3&function=delete&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$LoginName."'>Delete</a></td></tr>";
			}
			
			echo "</table>";

	}
	else
	{
	include_once "mis/access_denied.php";
	}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && !$_REQUEST['submitBtn'] && $_REQUEST["typeID"])
		{
		
		
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<table align="center" width="700" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Confirm the deleting of the user '<?php echo $_REQUEST["typeName"]; ?>' username '<?php echo $_REQUEST["typeCode"]; ?>' <input name="submitBtn" type="submit" value="Delete"></td>
				</tr>
			</table>
			</form>
			<?php
		
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="delete" && $_REQUEST['unit']=="1" && $_REQUEST['submitBtn']=="Delete")
		{
		
	if($bx_permissions=="Yes")
	{
		$delete = "DELETE FROM _user_acnts WHERE userID = '".$_REQUEST["typeID"]."';";
		$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Deleted User Account.";
		include_once "iDevTools/system_log.php";
			}
			else
			{
			echo "<p align='center'>Error! Try again later.</p>";
			}
	}
	else
	{
	include_once "mis/access_denied.php";
	}
		}
		elseif($_REQUEST["function"]=="create")
		{
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["org"] || !$_REQUEST["Email"] || !$_REQUEST["LoginName"] || !$_REQUEST["Password2"] || !$_REQUEST["Password"] || !$_REQUEST["Address"] || !$_REQUEST["Postal"] || !$_REQUEST["Country"] || !$_REQUEST["level"] || !$_REQUEST["Active"] || !$_REQUEST["Telephone"] || !$_REQUEST["Fax"])))
			{
	if($bx_permissions=="Yes")
	{
		?>
			
			<form action="" method="POST"><br><br><br>
		<table align="center" bgcolor='#fcfcfc' id='tables_css'>
		<tr>
			<td>
			<table align="center" bgcolor='#fcfcfc'>
				<tr>
					<td>First Name: </td><td><input name="FirstName" size="30" type="text" value="<?php echo $_REQUEST["FirstName"]; ?>"></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><input name="LastName" size="30" type="text" value="<?php echo $_REQUEST["LastName"]; ?>"></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><input name="LoginName" size="30" type="text" value="<?php echo $_REQUEST["LoginName"]; ?>"></td>
				</tr>
				<tr>
					<td>Password: </td><td><input name="Password" size="30" type="password" value="<?php echo $_REQUEST["Password"]; ?>"></td>
				</tr>
				<tr>
					<td>Repeat Password: </td><td><input name="Password2" size="30" type="password" value="<?php echo $_REQUEST["Password2"]; ?>"></td>
				</tr>
				<tr>
					<td>User Level: </td><td><select name="level"><option value="<?php echo $_REQUEST["level"]; ?>"><?php echo $_REQUEST["level"]; ?></option>
					<?php
	
	if($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited")
	{
	$limiter = "";
	}
	elseif($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country")
	{
	$limiter = " WHERE (LimitedTo = 'User`s Organization') OR (LimitedTo = 'User`s Branch Only')";
	}
	elseif($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization")
	{
	$limiter = " WHERE (LimitedTo = 'User`s Organization') OR (LimitedTo = 'User`s Branch Only')";
	}
	else
	{
	$limiter = " WHERE (LimitedTo = 'User`s Branch Only')";
	}
				
					$select_user_type = "SELECT * FROM _bx_refer_users_types".$limiter.";";
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
					<td>Organization: </td><td><select name="org"><option value="<?php echo $_REQUEST["org"]; ?>"><?php echo $_REQUEST["org"]; ?></option>
					<?php
					
					$whereX = explode(",",$pageMisc);
					$num_ele = count($whereX);
				

	
	if($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited")
	{
	$limiter = "";
	}
	elseif($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country")
	{
	$limiter = " WHERE (country = '".$userCountry."')";
	}
	elseif($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization")
	{
	$limiter = " WHERE (id = '".$org."')";
	}
	else
	{
	$limiter = " WHERE (id = '".$org."')";
	}
					
					$ns_name = "SELECT * FROM _organization".$limiter.";";
					$res_ns = mysqli_query($db,$ns_name);
					$num_ns = mysqli_num_rows($res_ns);
					for($y=0; $y<$num_ns; $y++)
					{
					$row_ns = mysqli_fetch_array($res_ns);
					$surety = $row_ns["name"];
					$suretyID = $row_ns["id"];
					
					echo "<option value='".$suretyID."'>".$surety."</option>";
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Country: </td><td><select name="Country"><option value="<?php echo $_REQUEST["Country"]; ?>"><?php echo $_REQUEST["Country"]; ?></option>
					<?php

	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country")
	{
	$limiter = " WHERE (Code = '".$userCountry."')";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "User`s Organization") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization"))
	{
	$limiter = " WHERE (Code = '".$userCountry."')";
	}
	else
	{
	$limiter = " WHERE (Code = '".$userCountry."')";
	}
				
					$select_national_surety = "SELECT * FROM refer_countries".$limiter.";";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$countryID = $row_nat["Code"];
					
					echo "<option value='".$countryID."'>".$countryID."</option>";
					}
					?>
					</select></td>
				</tr>
				</table>
			</td>
			<td>
			<table align="center" bgcolor='#fcfcfc'>
				<tr>
					<td>Address: </td><td><input name="Address" size="30" type="text" value="<?php echo $_REQUEST["Address"]; ?>"></td>
				</tr>
				<tr>
					<td>Postal: </td><td><input name="Postal" size="30" type="text" value="<?php echo $_REQUEST["Postal"]; ?>"></td>
				</tr>
				<tr>
					<td>Fax: </td><td><input name="Fax" size="30" type="text" value="<?php echo $_REQUEST["Fax"]; ?>"></td>
				</tr>
				<tr>
					<td>Telephone: </td><td><input name="Telephone" size="30" type="text" value="<?php echo $_REQUEST["Telephone"]; ?>"></td>
				</tr>
				<tr>
					<td>Mobile: </td><td><input name="Mobile" size="30" type="text" value="<?php echo $_REQUEST["Mobile"]; ?>"></td>
				</tr>
				<tr>
					<td>Email: </td><td><input name="Email" size="30" type="text" value="<?php echo $_REQUEST["Email"]; ?>"></td>
				</tr>
				<tr>
					<td>Activate User: </td><td><select name="Active"><option value="<?php echo $_REQUEST["Active"]; ?>"><?php echo $_REQUEST["Active"]; ?></option>
					<option value="0">No</option><option value="1">Yes</option>
					</select></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</td>
		</tr></table>
			</form>
		<?php
	}
	else
	{
	include_once "mis/access_denied.php";
	}
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["org"] && $_REQUEST["Email"] && $_REQUEST["LoginName"] && $_REQUEST["Password2"] && $_REQUEST["Password"] && $_REQUEST["Address"] && $_REQUEST["Postal"] && $_REQUEST["Country"] && $_REQUEST["level"] && $_REQUEST["Active"] && $_REQUEST["Telephone"] && $_REQUEST["Fax"]))
			{
			?>
			<form action="" method="POST">
			<input name="Country" type="hidden" value="<?php echo $_REQUEST["Country"]; ?>">
			<input name="level" type="hidden" value="<?php echo $_REQUEST["level"]; ?>">
			<input name="Active" type="hidden" value="<?php echo $_REQUEST["Active"]; ?>">
				<input name="Telephone" type="hidden" value="<?php echo $_REQUEST["Telephone"]; ?>">
				<input name="Mobile" type="hidden" value="<?php echo $_REQUEST["Mobile"]; ?>">
				<input name="FirstName" type="hidden" value="<?php echo $_REQUEST["FirstName"]; ?>">
				<input name="LastName" type="hidden" value="<?php echo $_REQUEST["LastName"]; ?>">
			<input name="Fax" type="hidden" value="<?php echo $_REQUEST["Fax"]; ?>">
			<input name="Postal" type="hidden" value="<?php echo $_REQUEST["Postal"]; ?>">
			<input name="Address" type="hidden" value="<?php echo $_REQUEST["Address"]; ?>">
			<input name="Password" type="hidden" value="<?php echo $_REQUEST["Password"]; ?>">
			<input name="Password2" type="hidden" value="<?php echo $_REQUEST["Password2"]; ?>">
			<input name="LoginName" type="hidden" value="<?php echo $_REQUEST["LoginName"]; ?>">
			<input name="Email" type="hidden" value="<?php echo $_REQUEST["Email"]; ?>">
			<input name="org" type="hidden" value="<?php echo $_REQUEST["org"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td width="120">First Name: </td><td><?php echo $_REQUEST["FirstName"]; ?></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><?php echo $_REQUEST["LastName"]; ?></td>
				</tr>
				<tr>
					<td>Organization: </td><td><?php echo $_REQUEST["org"]; ?></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><?php echo $_REQUEST["LoginName"]; ?></td>
				</tr>
				<tr>
					<td>Password: </td><td><?php echo $_REQUEST["Password"]; ?></td>
				</tr>
				<tr>
					<td>Repeat Password: </td><td><?php echo $_REQUEST["Password2"]; ?></td>
				</tr>
				<tr>
					<td>User Level: </td><td><?php echo $_REQUEST["level"]; ?></td>
				</tr>
				<tr>
					<td>Organization: </td><td><?php echo $_REQUEST["org"]; ?></td>
				</tr>
				<tr>
					<td>Country: </td><td><?php echo $_REQUEST["Country"]; ?></td>
				</tr>
				</table>
			</td>
			<td>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td width="120">Address: </td><td><?php echo $_REQUEST["Address"]; ?></td>
				</tr>
				<tr>
					<td>Postal: </td><td><?php echo $_REQUEST["Postal"]; ?></td>
				</tr>
				<tr>
					<td>Fax: </td><td><?php echo $_REQUEST["Fax"]; ?></td>
				</tr>
				<tr>
					<td>Telephone: </td><td><?php echo $_REQUEST["Telephone"]; ?></td>
				</tr>
				<tr>
					<td>Mobile: </td><td><?php echo $_REQUEST["Mobile"]; ?></td>
				</tr>
				<tr>
					<td>Email: </td><td><?php echo $_REQUEST["Email"]; ?></td>
				</tr>
				<tr>
					<td>Activate User: </td><td><?php echo $_REQUEST["Active"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table></td></tr></table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			
				$insd = "INSERT INTO _user_acnts (userID,UserCode,org,Email,FirstName,LastName,LoginName,Password,Address,Postal,Fax,Telephone,Mobile,Remarks,RecordEnteredBy,QuasAdmin,Active,level,Country) VALUES ('','".$_REQUEST["UserCode"]."','".$_REQUEST["org"]."','".$_REQUEST["Email"]."','".$_REQUEST["FirstName"]."','".$_REQUEST["LastName"]."','".$_REQUEST["LoginName"]."','".(md5($_REQUEST["Password"]))."','".$_REQUEST["Address"]."','".$_REQUEST["Postal"]."','".$_REQUEST["Fax"]."','".$_REQUEST["Telephone"]."','".$_REQUEST["Mobile"]."','','".$userID."','','".$_REQUEST["Active"]."','".$_REQUEST["level"]."','".$_REQUEST["Country"]."');";
				$resd = mysqli_query($db,$insd);
				
				if($resd)
				{
					echo "<p align='center'>Success!</p>";
			
		$Operationx = "Created User Account: ".$_REQUEST["LoginName"].".";
		include_once "iDevTools/system_log.php";
				}
				else
				{
					echo "<p align='center'>Error! Please try again later.</p>";
				}
			
			}
			else
			{
			echo "<p align='center'>System Error! Please contact your system administrator immediately.</p>";
			}
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="1" && $_REQUEST["segment"]=="e3")
		{
			
			if((!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["org"] || !$_REQUEST["Email"] || !$_REQUEST["Address"] || !$_REQUEST["Postal"] || !$_REQUEST["Country"] || !$_REQUEST["level"] || !$_REQUEST["Telephone"] || !$_REQUEST["Fax"])))
			{
			
			$sel = "SELECT * FROM _user_acnts WHERE userID = '".$_REQUEST["typeID"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$row = mysqli_fetch_array($res);
			$userID = $row["userID"];
			$orgx = $row["org"];
			$FirstName = $row["FirstName"];
			$LastName = $row["LastName"];
			$typeName = $FirstName." ".$LastName;
			$postal = $row["Postal"];
			$physical = $row["Address"];
			$tel = $row["Telephone"];
			$fax = $row["Fax"];
			$email = $row["Email"];
			$Mobile = $row["Mobile"];
			$country = $row["Country"];
			$Status = $row["Status"];
			$typeCodex = $row["level"];
			$LoginName = $row["LoginName"];
			
			$OrgCodex = $orgx;
			
				$selectOrg = "SELECT * FROM _organization WHERE id = '".$OrgCodex."';";
				@$resOrg = mysqli_query($db,$selectOrg);
				$rowOrg = mysqli_fetch_array($resOrg);
				$OrgCode = $rowOrg["name"];
			
			
				$selectType = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$typeCodex."';";
				@$resType = mysqli_query($db,$selectType);
				$rowType = mysqli_fetch_array($resType);
				$typeCode = $rowType["UserTypeName"];
				
		?>
			
			<form action="" method="POST"><br><br><br>
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td>
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>First Name: </td><td><input name="FirstName" size="30" type="text" value="<?php
			if($_REQUEST["FirstName"])
			{
			 echo $_REQUEST["FirstName"]; 
			}
			else
			{
			echo $FirstName;
			}
			?>"></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><input name="LastName" size="30" type="text" value="<?php
			if($_REQUEST["LastName"])
			{
			 echo $_REQUEST["LastName"]; 
			}
			else
			{
			echo $LastName;
			}
					?>"></td>
				</tr>
				<tr>
					<td>Password: </td><td><input name="Password" size="30" type="password"></td>
				</tr>
				<tr>
					<td>Repeat Password: </td><td><input name="Password2" size="30" type="password"></td>
				</tr>
				<tr>
					<td>User Level: </td><td><select name="level"><?php
			if($_REQUEST["level"])
			{
				$selectLevelc = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$_REQUEST["level"]."';";
				@$resLevelc = mysqli_query($db,$selectLevelc);
				$rowLevelc = mysqli_fetch_array($resLevelc);
				$LevelCodec = $rowLevelc["UserTypeName"];
				
			?>
			<option value="<?php echo $_REQUEST["level"]; ?>"><?php echo $LevelCodec;?></option>
			<?php
			}
			else
			{
				$selectLevelc = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$userLevel."';";
				@$resLevelc = mysqli_query($db,$selectLevelc);
				$rowLevelc = mysqli_fetch_array($resLevelc);
				$LevelCodec = $rowLevelc["UserTypeName"];
				
			?>
			<option value="<?php echo $LevelCodec; ?>"><?php echo $LevelCodec;?></option>
			<?php
			}
								
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country")
	{
	$limiter = " WHERE (LimitedTo = 'User`s Organization') OR (LimitedTo = 'User`s Branch Only') OR (Country')";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "User`s Organization") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization"))
	{
	$limiter = " WHERE (LimitedTo = 'User`s Organization') OR (LimitedTo = 'User`s Branch Only')";
	}
	else
	{
	$limiter = " WHERE (LimitedTo = 'User`s Branch Only')";
	}
				
					$select_user_type = "SELECT * FROM _bx_refer_users_types".$limiter.";";
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
					<td>Organization: </td><td><select name="org"><?php
			if($_REQUEST["org"])
			{ 
				$selectOrgc = "SELECT * FROM _organization WHERE id = '".$_REQUEST["org"]."';";
				@$resOrgc = mysqli_query($db,$selectOrgc);
				$rowOrgc = mysqli_fetch_array($resOrgc);
				$OrgCodec = $rowOrgc["name"];
			?>
			<option value="<?php echo $_REQUEST["org"]; ?>"><?php echo $OrgCodec;?></option>
			<?php
			}
			else
			{
			$selectOrgc = "SELECT * FROM _organization WHERE id = '".$org."';";
				@$resOrgc = mysqli_query($db,$selectOrgc);
				$rowOrgc = mysqli_fetch_array($resOrgc);
				$OrgCodec = $rowOrgc["name"];
			?>
			<option value="<?php echo $_REQUEST["org"]; ?>"><?php echo $OrgCodec;?></option>
			<?php
			}
					
					$whereX = explode(",",$pageMisc);
					$num_ele = count($whereX);
				
	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country")
	{
	$limiter = " WHERE (country = '".$userCountry."')";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "User`s Organization") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization"))
	{
	$limiter = " WHERE (id = '".$org."')";
	}
	else
	{
	$limiter = " WHERE (id = '".$org."')";
	}
					
					$ns_name = "SELECT * FROM _organization".$limiter.";";
					$res_ns = mysqli_query($db,$ns_name);
					$num_ns = mysqli_num_rows($res_ns);
					for($y=0; $y<$num_ns; $y++)
					{
					$row_ns = mysqli_fetch_array($res_ns);
					$surety = $row_ns["name"];
					$suretyID = $row_ns["id"];
					
					echo "<option value='".$suretyID."'>".$surety."</option>";
					}
					?>
					</select></td>
				</tr>
				<tr>
					<td>Country: </td><td><select name="Country"><?php 
			if($_REQUEST["Country"])
			{
			?>
			<option value="<?php echo $_REQUEST["Country"]; ?>"><?php echo $_REQUEST["Country"]; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $userCountry; ?>"><?php echo $userCountry; ?></option>
			<?php
			}
	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country")
	{
	$limiter = " WHERE (Code = '".$userCountry."')";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "User`s Organization") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization"))
	{
	$limiter = " WHERE (Code = '".$userCountry."')";
	}
	else
	{
	$limiter = " WHERE (Code = '".$userCountry."')";
	}
				
					$select_national_surety = "SELECT * FROM refer_countries".$limiter.";";
					$res_national = mysqli_query($db,$select_national_surety);
					$num_national = mysqli_num_rows($res_national);
					for($y=0; $y<$num_national; $y++)
					{
					$row_nat = mysqli_fetch_array($res_national);
					$countryID = $row_nat["Code"];
					
					echo "<option value='".$countryID."'>".$countryID."</option>";
					}
					?>
					</select></td>
				</tr>
				</table>
			</td>
			<td>
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Address: </td><td><input name="Address" size="30" type="text" value="<?php
			if($_REQUEST["Address"])
			{
			 echo $_REQUEST["Address"]; 
			}
			else
			{
			echo $Address;
			} 
					?>"></td>
				</tr>
				<tr>
					<td>Postal: </td><td><input name="Postal" size="30" type="text" value="<?php 
			if($_REQUEST["Postal"])
			{
			 echo $_REQUEST["Postal"]; 
			}
			else
			{
			echo $Postal;
			} 
					?>"></td>
				</tr>
				<tr>
					<td>Fax: </td><td><input name="Fax" size="30" type="text" value="<?php
			if($_REQUEST["Fax"])
			{
			 echo $_REQUEST["Fax"]; 
			}
			else
			{
			echo $Fax;
			} 
					?>"></td>
				</tr>
				<tr>
					<td>Telephone: </td><td><input name="Telephone" size="30" type="text" value="<?php
			if($_REQUEST["Telephone"])
			{
			 echo $_REQUEST["Telephone"]; 
			}
			else
			{
			echo $Telephone;
			} 
					?>"></td>
				</tr>
				<tr>
					<td>Mobile: </td><td><input name="Mobile" size="30" type="text" value="<?php  
			if($_REQUEST["Mobile"])
			{
			 echo $_REQUEST["Mobile"]; 
			}
			else
			{
			echo $Mobile;
			} 
					?>"></td>
				</tr>
				<tr>
					<td>Email: </td><td><input name="Email" size="30" type="text" value="<?php 
			if($_REQUEST["Email"])
			{
			 echo $_REQUEST["Email"]; 
			}
			else
			{
			echo $Email;
			} 
					?>"></td>
				</tr>
				<tr>
					<td> </td><td><input name="proceedbtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</td>
		</tr></table>
			</form>
		<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($_REQUEST["org"] || $_REQUEST["Email"] || ((($_REQUEST["Password2"] && $_REQUEST["Password"]) && ($_REQUEST["Password2"]==$_REQUEST["Password"])) || (!$_REQUEST["Password2"] && !$_REQUEST["Password"])) || $_REQUEST["Address"] || $_REQUEST["Postal"] || $_REQUEST["Country"] || $_REQUEST["level"] || $_REQUEST["Telephone"] || $_REQUEST["Fax"]))
			{
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="Country" type="hidden" value="<?php echo $_REQUEST["Country"]; ?>">
			<input name="level" type="hidden" value="<?php echo $_REQUEST["level"]; ?>">
			<input name="Active" type="hidden" value="<?php echo $_REQUEST["Active"]; ?>">
				<input name="Telephone" type="hidden" value="<?php echo $_REQUEST["Telephone"]; ?>">
				<input name="Mobile" type="hidden" value="<?php echo $_REQUEST["Mobile"]; ?>">
				<input name="FirstName" type="hidden" value="<?php echo $_REQUEST["FirstName"]; ?>">
				<input name="LastName" type="hidden" value="<?php echo $_REQUEST["LastName"]; ?>">
			<input name="Fax" type="hidden" value="<?php echo $_REQUEST["Fax"]; ?>">
			<input name="Postal" type="hidden" value="<?php echo $_REQUEST["Postal"]; ?>">
			<input name="Address" type="hidden" value="<?php echo $_REQUEST["Address"]; ?>">
			<input name="Password" type="hidden" value="<?php echo $_REQUEST["Password"]; ?>">
			<input name="Password2" type="hidden" value="<?php echo $_REQUEST["Password2"]; ?>">
			<input name="LoginName" type="hidden" value="<?php echo $_REQUEST["LoginName"]; ?>">
			<input name="Email" type="hidden" value="<?php echo $_REQUEST["Email"]; ?>">
			<input name="org" type="hidden" value="<?php echo $_REQUEST["org"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td width="120">First Name: </td><td><?php echo $_REQUEST["FirstName"]; ?></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><?php echo $_REQUEST["LastName"]; ?></td>
				</tr>
				<tr>
					<td>Organization: </td><td><?php echo $_REQUEST["org"]; ?></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><?php echo $_REQUEST["LoginName"]; ?></td>
				</tr>
				<tr>
					<td>User Level: </td><td><?php echo $_REQUEST["level"]; ?></td>
				</tr>
				<tr>
					<td>Organization: </td><td><?php echo $_REQUEST["org"]; ?></td>
				</tr>
				<tr>
					<td>Country: </td><td><?php echo $_REQUEST["Country"]; ?></td>
				</tr>
				</table>
			</td>
			<td>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td width="120">Address: </td><td><?php echo $_REQUEST["Address"]; ?></td>
				</tr>
				<tr>
					<td>Postal: </td><td><?php echo $_REQUEST["Postal"]; ?></td>
				</tr>
				<tr>
					<td>Fax: </td><td><?php echo $_REQUEST["Fax"]; ?></td>
				</tr>
				<tr>
					<td>Telephone: </td><td><?php echo $_REQUEST["Telephone"]; ?></td>
				</tr>
				<tr>
					<td>Mobile: </td><td><?php echo $_REQUEST["Mobile"]; ?></td>
				</tr>
				<tr>
					<td>Email: </td><td><?php echo $_REQUEST["Email"]; ?></td>
				</tr>
				<tr>
					<td>Activate User: </td><td><?php echo $_REQUEST["Active"]; ?></td>
				</tr>
				<tr>
					<td> </td><td></td>
				</tr>
			</table></td></tr>
			<tr>
				<td><input name="editbtn" type="submit" value="Edit"></td><td><input name="proceedbtn" type="submit" value="Submit"></td>
			</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			
				$insd = "UPDATE _user_acnts SET org = '".$_REQUEST["org"]."',Email = '".$_REQUEST["Email"]."',FirstName = '".$_REQUEST["FirstName"]."',LastName = '".$_REQUEST["LastName"]."',Password = '".(md5($_REQUEST["Password"]))."',Address = '".$_REQUEST["Address"]."',Postal = '".$_REQUEST["Postal"]."',Fax = '".$_REQUEST["Fax"]."',Telephone = '".$_REQUEST["Telephone"]."',Mobile = '".$_REQUEST["Mobile"]."',level = '".$_REQUEST["level"]."',Country = '".$_REQUEST["Country"]."' WHERE userID = '".$_REQUEST["typeID"]."';";
				$resd = mysqli_query($db,$insd);
				
				if($resd)
				{
					echo "<p align='center'>Success!</p>";
			
		$Operationx = "Edited User Account: ".$_REQUEST["FirstName"].".";
		include_once "iDevTools/system_log.php";
				}
				else
				{
					echo "<p align='center'>Error! Please try again later.</p>";
				}
			
			}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="history" && $_REQUEST['unit']=="4")
		{
			echo "<h2 align='center'><u>Activity History for ".$_REQUEST['typeName']."</u></h2>";
			echo "<table align='center' width='800' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td width='50'><u><b>Page ID</b></u></td><td><u><b>Description</b></u></td><td><u><b>Operation</b></u></td><td width='130'><u><b>Date & Time</b></u></td></tr>";
			
			$sel = "SELECT * FROM system_log WHERE userID = '".$_REQUEST['typeID']."' ORDER BY id DESC;";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			$bn = 0;
			for($i=0; $i<$num;$i++)
			{
			
			@$row = mysqli_fetch_array($res);
			$PageID = $row["PageID"];
			$userID = $row["userID"];
			$Operation = $row["Operation"];
			$dateset = $row["dateset"];
			
			$selv = "SELECT * FROM sys_pages WHERE PageID = '".$PageID."';";
			@$resv = mysqli_query($db,$selv);
			@$rowv = mysqli_fetch_array($resv);
			$PageName = $rowv["name"];
			
			
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td> &nbsp;&nbsp;".$PageID."</td><td align='center'>".$PageName."</td><td align='center'>".$Operation."</td><td align='center'>".$dateset."</td></tr>";
			}
			echo "</table>";
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="add" && $_REQUEST['unit']=="5")
		{
			if((!$_REQUEST['ProcedBtn'] && !$_REQUEST['editbtn']) || $_REQUEST['editbtn']=="Edit" || ($_REQUEST["ProcedBtn"]=="Proceed" && !$_REQUEST["Branch"]))
			{
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="typeName" type="hidden" value="<?php echo $_REQUEST["typeName"]; ?>">
			<table align="center" width="300" bgcolor="#fcfcfc" id="tables_css">
				<tr>
					<td>Branch:</td><td><select name='Branch'><option value='<?php echo $_REQUEST["Branch"]; ?>'><?php echo $_REQUEST["Branch"]; ?></option>
					<?php
					$select_brnch = "SELECT * FROM _org_branches WHERE org_id = '".$org."';";
					$resBrch = mysqli_query($db,$select_brnch);
					@$numBrnc = mysqli_num_rows($resBrch);
						for($b=0; $b<$numBrnc; $b++)
						{
						@$rwBrn = mysqli_fetch_array($resBrch);
						$brnchID = $rwBrn["id"];
						$brnchNam = $rwBrn["name"];
						echo "<option value='".$brnchID."'>".$brnchNam."</option>";
						}					
					?>
					</select></td>
				</tr>
				<tr>
					<td></td><td><input name="ProcedBtn" type="submit" value="Proceed"></td>
				</tr>
			</table>
			</form>
			<?php
			}
			elseif($_REQUEST["ProcedBtn"]=="Proceed" && $_REQUEST["Branch"])
			{
			?>
			<form action="" method="POST">
			<input name="Branch" type="hidden" value="<?php echo $_REQUEST["Branch"]; ?>">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="typeName" type="hidden" value="<?php echo $_REQUEST["typeName"]; ?>">
			<table align="center" width="500" bgcolor="#fcfcfc" id="tables_css">
				<tr>
					<td>User: </td><td><?php echo $_REQUEST["typeName"]; ?></td>
				</tr>
				<tr>
					<td>Assigned to Branch: </td><td><?php
					$select_brnch = "SELECT * FROM _org_branches WHERE id = '".$_REQUEST["Branch"]."';";
					$resBrch = mysqli_query($db,$select_brnch);
						@$rwBrn = mysqli_fetch_array($resBrch);
						$brnchID = $rwBrn["id"];
						$brnchNam = $rwBrn["name"];
						echo $brnchNam;
					?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"> </td><td><input name="ProcedBtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["ProcedBtn"]=="Submit")
			{
			
			$delete = "UPDATE _user_acnts SET Branch = '".$_REQUEST["Branch"]."' WHERE userID = '".$_REQUEST["typeID"]."';";
			//echo $delete;
			$res = mysqli_query($db,$delete);
		
			if($res)
			{
			echo "<p align='center'>Success!</p>";
			
		$Operationx = "Assigned User to Branch.";
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
		else
		{
		//echo "test3";
		}
}
?>