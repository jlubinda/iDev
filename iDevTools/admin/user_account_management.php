<?php
 if(chkSes()=="Inactive")
{

} 
else 
{
		
		if($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="list")
		{
		
	if($bx_permissions=="Yes")
	{
		echo "<table align='center' width='99%' bgcolor='#fcfcfc' id='tables_css'><tr><td width='30'></td><td><u><b>User</b></u></td><td><u><b>Addresses</b></u></td><td><u><b>Contact Details</b></u></td><td><u><b>Country</b></u></td><td width='140'><u><b></b></u></td><td width='120'><u><b></b></u></td></tr>";	

			
	echo "<br><br>";
	if($_REQUEST['orgname'])
	{
	echo "<p align='center'><b><u>".$_REQUEST['orgname']."</u></b></p>";
	}
	
	if(!$org_limiter3)
	{
		if($_REQUEST['search'] && $_REQUEST['search'] != "")
		{
		$limiter = "WHERE Email like '%".$_REQUEST['search']."%' OR FirstName like '%".$_REQUEST['search']."%' OR LastName like '%".$_REQUEST['search']."%' OR LoginName like '%".$_REQUEST['search']."%' OR Address like '%".$_REQUEST['search']."%' OR Postal like '%".$_REQUEST['search']."%' OR Fax like '%".$_REQUEST['search']."%' OR Telephone like '%".$_REQUEST['search']."%' OR Mobile like '%".$_REQUEST['search']."%'";
		}
		elseif($_REQUEST['org_users']=="org")
		{
		$limiter = "WHERE org = '".$_REQUEST['org_id']."'";
		}
		else
		{
		$limiter = "";
		}
	}
	else
	{
		if($_REQUEST['search'] && $_REQUEST['search'] != "")
		{
		$limiter = "WHERE ".$org_limiter3." AND (Email like '%".$_REQUEST['search']."%' OR FirstName like '%".$_REQUEST['search']."%' OR LastName like '%".$_REQUEST['search']."%' OR LoginName like '%".$_REQUEST['search']."%' OR Address like '%".$_REQUEST['search']."%' OR Postal like '%".$_REQUEST['search']."%' OR Fax like '%".$_REQUEST['search']."%' OR Telephone like '%".$_REQUEST['search']."%' OR Mobile like '%".$_REQUEST['search']."%')";
		}
		elseif($_REQUEST['org_users']=="org")
		{
		$limiter = "WHERE ".$org_limiter3." AND org = '".$_REQUEST['org_id']."'";
		}
		else
		{
		$limiter = "WHERE ".$org_limiter3;
		}
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
			//$Active = $row["Active"];
			//echo "Active Status: ".$Active;
			
			$selAc = "SELECT * FROM _user_acntsx WHERE id = (SELECT max(id) as maxID FROM _user_acntsx WHERE userID = '".$userID."');";
			@$resAc = mysqli_query($db,$selAc);
			@$rwAc = mysqli_fetch_array($resAc);
			$Active = $rwAc["Active"];
					
					if($Active=="Yes" || $Active=="1")
					{
						
						$wordin1 = "Deactivate";
						$function1 = "No";
						
					}
					else
					{
						$wordin1 = "Activate";
						$function1 = "Yes";
					}	
						$active_link = "<a href='?ref=settings&segment=e3&function=edit&unit=8&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&Active=".$function1."&proceedbtn=Proceed&level=".$typeCodex."&FirstName=".$FirstName."&LastName=".$LastName."&LoginName=".$LoginName."'>".$wordin1."</a>";
					
					
			
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
						$remove_from_branch = "<br><a href='?ref=settings&segment=e3&function=add&unit=10&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>Remove From Branch</a>";
						}
						else
						{
						$wordin = "Assign to Branch";
						$remove_from_branch = "";
						}
						$assign_to_branch = "<br><a href='?ref=settings&segment=e3&function=add&unit=5&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>".$wordin."</a>";
					}
					else
					{
					$assign_to_branch = "";
					$remove_from_branch = "";
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
				
			echo "<tr bgcolor='#".$bgcolor."'><td align='center' bgcolor='#ffffff'>".($i+1).") </td><td align='left' width='300'><b>Login Name: </b>".$LoginName."<br><b>First & Last Names: </b>".$typeName."<br><b>user Level: </b>".$typeCode."</td><td width='300'><b>Organization: </b>".$surety."<br><b>Postal: </b>".$postal."<br><b>Physical: </b>".$physical."</td><td width='300'><b>Tel: </b>".$tel."<br><b>Fax: </b>".$fax."<br><b>Email: </b>".$email."<br><b>Mobile: </b>".$Mobile."<br><br></td><td width='40'>".$country."</td><td align='center'><a href='?ref=settings&segment=e3&function=history&unit=4&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>History</a>".$assign_to_branch."".$remove_from_branch."</td><td align='center'><a href='?ref=settings&segment=e3&function=edit&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>Edit</a><br><a href='?ref=settings&segment=e3&function=edit&unit=7&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$typeCode."'>Reset Password</a><br>".$active_link."<br><a href='?ref=settings&segment=e3&function=delete&unit=1&pvCode=".$_REQUEST["pvCode"]."&typeID=".$userID."&typeName=".$typeName."&typeCode=".$LoginName."'>Delete</a></td></tr>";
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
		
				$serch_LoginName = "SELECT * FROM _user_acnts WHERE LoginName = '".$_REQUEST["LoginName"]."';";
				$res_LoginName = mysqli_query($db,$serch_LoginName);
				@$num_LoginName = mysqli_num_rows($res_LoginName);
				
    $_REQUEST["error_message"] = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $mobile_exp = "/^[+]{1}+[0-9]{10,14}$/i";
    $string_exp = "/^[A-Za-z .'-]+$/";
    $date_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $IssuedOn_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $numdays_exp = "/^[0-9]{1,3}$/i";
	
  if($num_LoginName>="1") {
    $_REQUEST["error_message"] .= 'This Login Name has already been registered.<br />';
  }
  if(!$_REQUEST["LoginName"]) {
    $_REQUEST["error_message"] .= 'The "LoginName" field is empty.<br />';
  }
  if(!$_REQUEST["FirstName"]) {
    $_REQUEST["error_message"] .= 'The "FirstName" field is empty.<br />';
  }
  if(!$_REQUEST["LastName"]) {
    $_REQUEST["error_message"] .= 'The "LastName" field is empty.<br />';
  }
  if(!$_REQUEST["Password"]) {
    $_REQUEST["error_message"] .= 'The "Password" field is empty.<br />';
  }
  if(!$_REQUEST["Password2"]) {
    $_REQUEST["error_message"] .= 'The "Repeat Password" field is empty.<br />';
  }
  if(!($_REQUEST["Password"] == $_REQUEST["Password2"])) {
    $_REQUEST["error_message"] .= 'Your Passwords don`t match.<br />';
  }
  if(strlen ($_REQUEST["Password"])<6) {
    $_REQUEST["error_message"] .= 'You "Password" has less than 6 characters, please ensure you use more than 5 characters.<br />';
  }
  if(!$_REQUEST["level"]) {
    $_REQUEST["error_message"] .= 'The "User Level" field is empty.<br />';
  }
  if(!$_REQUEST["Address"]) {
    $_REQUEST["error_message"] .= 'The "Address" field is empty.<br />';
  }
  if(!$_REQUEST["org"]) {
    $_REQUEST["error_message"] .= 'The "Organization" field is empty.<br />';
  }
  if(!$_REQUEST["Country"]) {
    $_REQUEST["error_message"] .= 'The "Country" field is empty.<br />';
  }
  if(!$_REQUEST["Address"]) {
    $_REQUEST["error_message"] .= 'The "Address" field is empty.<br />';
  }
  if(!$_REQUEST["Postal"]) {
    $_REQUEST["error_message"] .= 'The "Postal" field is empty.<br />';
  }
  if(!$_REQUEST["Telephone"]) {
    $_REQUEST["error_message"] .= 'The "Telephone" field is empty.<br />';
  }
  if(!$_REQUEST["Mobile"]) {
    $_REQUEST["error_message"] .= 'The "Mobile" field is empty.<br />';
  }
  if($_REQUEST["Mobile"])
  {
  if(!preg_match($mobile_exp,$_REQUEST["Mobile"])) {
    $_REQUEST["error_message"] .= 'The "Mobile Number" you entered does not appear to be valid.<br />';
  }
  }
  if(!$_REQUEST["Email"]) {
    $_REQUEST["error_message"] .= 'The "Email" field is empty.<br />';
  }
  if($_REQUEST["Email"])
  {
  if(!preg_match($email_exp,$_REQUEST["Email"])) {
    $_REQUEST["error_message"] .= 'The "Email" you entered does not appear to be valid.<br />';
  }
  }
  if(!$_REQUEST["Active"]) {
    $_REQUEST["error_message"] .= 'The "Activate User" field is empty.<br />';
  }
  
  if(strlen($_REQUEST["error_message"]) > 0) {
   $err = 1;
  }
  else
  {
  $err = 2;
  }
  

			if(($err=="1") || (!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["org"] || !$_REQUEST["Email"] || !$_REQUEST["LoginName"] || !$_REQUEST["Password2"] || !$_REQUEST["Password"] || !$_REQUEST["Address"] || !$_REQUEST["Postal"] || !$_REQUEST["Country"] || !$_REQUEST["level"] || !$_REQUEST["Active"] || !$_REQUEST["Telephone"] || !$_REQUEST["Fax"])))
			{
	if($bx_permissions=="Yes")
	{
		?>
<?php
  if($_REQUEST["proceedbtn"]=="Proceed" && $err=="1")
  {
  echo "<p align='center' class='errors'>Error! ".$_REQUEST["error_message"]."</p>";
  }
?>
<script type="text/javascript">
					
var ids = new Array();
var postal = new Array();
var physical = new Array();
var tel = new Array();
var fax = new Array();
var country = new Array();


ids[0] = "";
postal[0] = "";
physical[0] = "";
tel[0] = "";
fax[0] = "";
country[0] = "";

<?php
	
	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiterb = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
	{
	$limiterb = " WHERE (country = '".$userCountry."')";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "User`s Organization") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "User`s Organization"))
	{
	$limiterb = " WHERE (id = '".$org."')";
	}
	else
	{
	$limiterb = " WHERE (id = '".$org."')";
	}
	
					$ns_name4 = "SELECT * FROM _organization".$limiterb." ORDER BY id;";
					$res_ns4 = mysqli_query($db,$ns_name4);
					$num_ns4 = mysqli_num_rows($res_ns4);
					for($y4=1; $y4<($num_ns4+1); $y4++)
					{
					$row_ns4 = mysqli_fetch_array($res_ns4);
					$surety4 = $row_ns4["name"];
					$suretyID4 = $row_ns4["id"];
					$_postal4 = $row_ns4["postal"];
					$_physical4 = $row_ns4["physical"];
					$_tel4 = $row_ns4["tel"];
					$_fax4 = $row_ns4["fax"];
					$_country4 = $row_ns4["country"];
					?>
ids[<?php echo $y4; ?>] = <?php echo $y4; ?>;
postal[<?php echo $y4; ?>] = "<?php echo $_postal4; ?>";
physical[<?php echo $y4; ?>] = "<?php echo $_physical4; ?>";
tel[<?php echo $y4; ?>] = "<?php echo $_tel4; ?>";
fax[<?php echo $y4; ?>] = "<?php echo $_fax4; ?>";
country[<?php echo $y4; ?>] = "<?php echo $_country4; ?>";
					<?php
					}
	?>



        function Choice() {
            //x = document.getElementById("users");
            y = document.getElementById("selectUsers");

              //x.value = y.options[y.selectedIndex].text;
              document.getElementById("ids").value = ids[y.selectedIndex];
              document.getElementById("postal").value = postal[y.selectedIndex];
              document.getElementById("physical").value = physical[y.selectedIndex];
              document.getElementById("tel").value = tel[y.selectedIndex];
              document.getElementById("fax").value = fax[y.selectedIndex];
              document.getElementById("country").value = country[y.selectedIndex];
         }


    </script>
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
					<td>User Level: </td><td><?php
					
					?><select name="level">
					<?php
	
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
								
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
	{
	$limiter = " WHERE (LimitedTo = 'User`s Organization') OR (LimitedTo = 'User`s Branch Only') OR (LimitedTo = 'Country')";
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
					<td>Organization: </td><td><select name="org" id="selectUsers" onChange='Choice();'>
					<?php
					
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
			?>
			<option value=""></option>
			<?php
			}
					
					//$whereX = explode(",",$pageMisc);
					//$num_ele = count($whereX);
				
	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
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
					
					$ns_namem = "SELECT * FROM _organization".$limiter." ORDER BY id;";
					$res_nsm = mysqli_query($db,$ns_namem);
					@$num_nsm = mysqli_num_rows($res_nsm);
					for($ym=1; $ym<($num_nsm+1); $ym++)
					{
					@$row_nsm = mysqli_fetch_array($res_nsm);
					$suretym = $row_nsm["name"];
					$suretyIDv = $row_nsm["id"];
					
					echo "<option value='".$suretyIDv."' id='".$ym."'>".$suretym."</option>";
					}
					?>
					</select>
					<input type="hidden" id="ids" name="id" ></td>
				</tr>
				<?php
				if($LimitedTozz == "Unlimited")
				{
				?>
				<tr>
					<td>Country: </td><td><select name="Country">
					<?php

			if($_REQUEST["Country"])
			{ 
			?>
			<option value="<?php echo $_REQUEST["Country"]; ?>"><?php echo $_REQUEST["Country"]; ?></option>
			<?php
			}
			
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
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
				<?php
				}
				else
				{
				?>
				<input name="Country" id="country" type="hidden" value="<?php echo $_REQUEST["Country"]; ?>">
				<?php
				}
				?>
				</table>
			</td>
			<td>
			<table align="center" bgcolor='#fcfcfc'>
				<tr>
					<td>Address: </td><td><input name="Address" id="physical" size="30" type="text" value="<?php echo $_REQUEST["Address"]; ?>"></td>
				</tr>
				<tr>
					<td>Postal: </td><td><input name="Postal" id="postal" size="30" type="text" value="<?php echo $_REQUEST["Postal"]; ?>"></td>
				</tr>
				<tr>
					<td>Fax: </td><td><input name="Fax" id="fax" size="30" type="text" value="<?php echo $_REQUEST["Fax"]; ?>"></td>
				</tr>
				<tr>
					<td>Telephone: </td><td><input name="Telephone" id="tel" size="30" type="text" value="<?php echo $_REQUEST["Telephone"]; ?>"></td>
				</tr>
				<tr>
					<td>Mobile: </td><td><input name="Mobile" size="30" type="text" value="<?php 
					 
					if($_REQUEST["Mobile"])
					{
					echo $_REQUEST["Mobile"];
					}
					else
					{
					echo "+2";
					}
					?>"></td>
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
			elseif($_REQUEST["proceedbtn"]=="Proceed" && ($err=="2") && ($_REQUEST["org"] && $_REQUEST["Email"] && $_REQUEST["LoginName"] && $_REQUEST["Password2"] && $_REQUEST["Password"] && $_REQUEST["Address"] && $_REQUEST["Postal"] && $_REQUEST["Country"] && $_REQUEST["level"] && $_REQUEST["Active"] && $_REQUEST["Telephone"] && $_REQUEST["Fax"]))
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
					<td>Login Name: </td><td><?php echo $_REQUEST["LoginName"]; ?></td>
				</tr>
				<tr>
					<td>User Level: </td><td><?php echo $_REQUEST["level"]; ?></td>
				</tr>
				<tr>
					<td>Organization: </td><td><?php 
					
	
	$select_org = "SELECT * FROM _organization WHERE id = '".$_REQUEST["org"]."';";
	$res_orgX = mysqli_query($db,$select_org);
	$orwX = mysqli_fetch_array($res_orgX);
	$IssuedByPICx = $orwX["name"];
	
					echo $IssuedByPICx; ?></td>
				</tr>
				<tr>
					<td>Country: </td><td><?php echo $_REQUEST["Country"]; ?></td>
				</tr>
				<tr>
					<td width="120">Address: </td><td><?php echo $_REQUEST["Address"]; ?></td>
				</tr>
				</table>
			</td>
			<td>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
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
			
    $_REQUEST["error_message"] = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $mobile_exp = "/^[+]{1}+[0-9]{10,14}$/i";
    $string_exp = "/^[A-Za-z .'-]+$/";
    $date_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $IssuedOn_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $numdays_exp = "/^[0-9]{1,3}$/i";
	
  if(!$_REQUEST["FirstName"]) {
    $_REQUEST["error_message"] .= 'The "FirstName" field is empty.<br />';
  }
  if(!$_REQUEST["LastName"]) {
    $_REQUEST["error_message"] .= 'The "LastName" field is empty.<br />';
  }
  if(!$_REQUEST["level"]) {
    $_REQUEST["error_message"] .= 'The "User Level" field is empty.<br />';
  }
  if(!$_REQUEST["Address"]) {
    $_REQUEST["error_message"] .= 'The "Address" field is empty.<br />';
  }
  if(!$_REQUEST["org"]) {
    $_REQUEST["error_message"] .= 'The "Organization" field is empty.<br />';
  }
  if(!$_REQUEST["Country"]) {
    $_REQUEST["error_message"] .= 'The "Country" field is empty.<br />';
  }
  if(!$_REQUEST["Address"]) {
    $_REQUEST["error_message"] .= 'The "Address" field is empty.<br />';
  }
  if(!$_REQUEST["Postal"]) {
    $_REQUEST["error_message"] .= 'The "Postal" field is empty.<br />';
  }
  if(!$_REQUEST["Telephone"]) {
    $_REQUEST["error_message"] .= 'The "Telephone" field is empty.<br />';
  }
  if(!$_REQUEST["Mobile"]) {
    $_REQUEST["error_message"] .= 'The "Mobile" field is empty.<br />';
  }
  if($_REQUEST["Mobile"])
  {
  if(!preg_match($mobile_exp,$_REQUEST["Mobile"])) {
    $_REQUEST["error_message"] .= 'The "Mobile Number" you entered does not appear to be valid.<br />';
  }
  }
  if(!$_REQUEST["Email"]) {
    $_REQUEST["error_message"] .= 'The "Email" field is empty.<br />';
  }
  if($_REQUEST["Email"])
  {
  if(!preg_match($email_exp,$_REQUEST["Email"])) {
    $_REQUEST["error_message"] .= 'The "Email" you entered does not appear to be valid.<br />';
  }
  }
  
  if(strlen($_REQUEST["error_message"]) > 0) {
   $err = 1;
  }
  else
  {
  $err = 2;
  }
 
	if(@$bx_permissions=="Yes")
	{
			if(($err=="1") || (!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["org"] || !$_REQUEST["Email"] || !$_REQUEST["Address"] || !$_REQUEST["Postal"] || !$_REQUEST["Country"] || !$_REQUEST["level"] || !$_REQUEST["Telephone"] || !$_REQUEST["Fax"])))
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
			$mobile = $row["Mobile"];
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
		
<?php
  if($_REQUEST["proceedbtn"]=="Proceed" && $err=="1")
  {
  echo "<p align='center' class='errors'>Error! ".$_REQUEST["error_message"]."</p>";
  }
?>
	
			<form action="" method="POST"><br>
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
				$selectLevelc = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$typeCodex."';";
				@$resLevelc = mysqli_query($db,$selectLevelc);
				$rowLevelc = mysqli_fetch_array($resLevelc);
				$LevelCodec = $rowLevelc["UserTypeName"];
				
			?>
			<option value="<?php echo $typeCodex; ?>"><?php echo $LevelCodec;?></option>
			<?php
			}
								
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
	{
	$limiter = " WHERE (LimitedTo = 'User`s Organization') OR (LimitedTo = 'User`s Branch Only') OR (LimitedTo = 'Country')";
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
			$selectOrgc = "SELECT * FROM _organization WHERE id = '".$orgx."';";
				@$resOrgc = mysqli_query($db,$selectOrgc);
				$rowOrgc = mysqli_fetch_array($resOrgc);
				$OrgCodec = $rowOrgc["name"];
			?>
			<option value="<?php echo $orgx; ?>"><?php echo $OrgCodec;?></option>
			<?php
			}
					
					$whereX = explode(",",$pageMisc);
					$num_ele = count($whereX);
				
	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
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
				<?php
				if($LimitedTozz == "Unlimited")
				{
				?>
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
			<option value="<?php echo $country; ?>"><?php echo $country; ?></option>
			<?php
			}
	
	if(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Unlimited") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Unlimited"))
	{
	$limiter = "";
	}
	elseif(($UserTypeCategoryzz=="Monitor" && $LimitedTozz == "Country") || ($UserTypeCategoryzz=="Administrator" && $LimitedTozz == "Country"))
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
					$countryIDx = $row_nat["Code"];
					
					echo "<option value='".$countryIDx."'>".$countryIDx."</option>";
					}
					?>
					</select></td>
				</tr>
				<?php
				}
				else
				{
				?>
				<input name="Country" size="30" type="hidden" value="<?php echo $country;?>">
				<?php
				}
				?>
				<tr>
					<td>Address: </td><td><input name="Address" size="30" type="text" value="<?php
			if($_REQUEST["Address"])
			{
			 echo $_REQUEST["Address"]; 
			}
			else
			{
			echo $physical;
			} 
					?>"></td>
				</tr>
				</table>
			</td>
			<td>
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>Postal: </td><td><input name="Postal" size="30" type="text" value="<?php 
			if($_REQUEST["Postal"])
			{
			 echo $_REQUEST["Postal"]; 
			}
			else
			{
			echo $postal;
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
			echo $fax;
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
			echo $tel;
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
			echo $mobile;
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
			echo $email;
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
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $err=="2" && ($_REQUEST["org"] || $_REQUEST["Email"] || $_REQUEST["Address"] || $_REQUEST["Postal"] || $_REQUEST["Country"] || $_REQUEST["level"] || $_REQUEST["Telephone"] || $_REQUEST["Fax"]))
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
			
				$insd = "UPDATE _user_acnts SET org = '".$_REQUEST["org"]."',Email = '".$_REQUEST["Email"]."',FirstName = '".$_REQUEST["FirstName"]."',LastName = '".$_REQUEST["LastName"]."',Address = '".$_REQUEST["Address"]."',Postal = '".$_REQUEST["Postal"]."',Fax = '".$_REQUEST["Fax"]."',Telephone = '".$_REQUEST["Telephone"]."',Mobile = '".$_REQUEST["Mobile"]."',level = '".$_REQUEST["level"]."',Country = '".$_REQUEST["Country"]."' WHERE userID = '".$_REQUEST["typeID"]."';";
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
			else
			{
			echo "<p align='center'>Sorry. You do not have permission to this component</p>";
			}
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="7" && $_REQUEST["segment"]=="e3")
		{
			
			
    $_REQUEST["error_message"] = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";
    $date_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $IssuedOn_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $numdays_exp = "/^[0-9]{1,3}$/i";
    $YC_exp = "/^[0-9]{1,8}$/i";
	
  if(!$_REQUEST["Password"]) {
    $_REQUEST["error_message"] .= 'The "Password" field is empty.<br />';
  }
  if(!$_REQUEST["Password2"]) {
    $_REQUEST["error_message"] .= 'The "Repeat Password" field is empty.<br />';
  }
  if(!($_REQUEST["Password"] == $_REQUEST["Password2"])) {
    $_REQUEST["error_message"] .= 'Your Passwords don`t match.<br />';
  }
  
  
  if(strlen($_REQUEST["error_message"]) > 0) {
   $err = 1;
  }
  else
  {
  $err = 2;
  }
  
	if(@$bx_permissions=="Yes")
	{
			if(($err=="1") || (!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["Password"] || !$_REQUEST["Password2"])))
			{
			
			$sel = "SELECT * FROM _user_acnts WHERE userID = '".$_REQUEST["typeID"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$row = mysqli_fetch_array($res);
			$userID = $row["userID"];
			$orgx = $row["org"];
			$FirstName = $row["FirstName"];
			$LastName = $row["LastName"];
			$LoginName = $row["LoginName"];
			$typeName = $FirstName." ".$LastName;
			$postal = $row["Postal"];
			$physical = $row["Address"];
			$Telephone = $row["Telephone"];
			$Fax = $row["Fax"];
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
						
<?php
  if($_REQUEST["proceedbtn"]=="Proceed" && $err=="1")
  {
  echo "<p align='center' class='errors'>Error! ".$_REQUEST["error_message"]."</p>";
  }
?>

			<form action="" method="POST"><br><br>
			<input name="FirstName" type="hidden" value="<?php echo $FirstName; ?>">
			<input name="LastName" type="hidden" value="<?php echo $LastName; ?>">
			<input name="LoginName" type="hidden" value="<?php echo $LoginName; ?>">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td>
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>First Name: </td><td><?php
			echo $FirstName;
			?></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><?php
			echo $LastName;
					?></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><?php
			echo $LoginName;
					?></td>
				</tr>
				<tr>
					<td>Password: </td><td><input name="Password" size="30" type="password"></td>
				</tr>
				<tr>
					<td>Repeat Password: </td><td><input name="Password2" size="30" type="password"></td>
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
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $err=="2" && ($_REQUEST["Password2"] && $_REQUEST["Password"]) && ($_REQUEST["Password2"]==$_REQUEST["Password"]))
			{
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="FirstName" type="hidden" value="<?php echo $_REQUEST["FirstName"]; ?>">
			<input name="LastName" type="hidden" value="<?php echo $_REQUEST["LastName"]; ?>">
			<input name="Password" type="hidden" value="<?php echo $_REQUEST["Password"]; ?>">
			<input name="Password2" type="hidden" value="<?php echo $_REQUEST["Password2"]; ?>">
			<input name="LoginName" type="hidden" value="<?php echo $_REQUEST["LoginName"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td><p align="center">Please confirm the resetting of Password for the user stated below:</p>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td width="120">First Name: </td><td><?php echo $_REQUEST["FirstName"]; ?></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><?php echo $_REQUEST["LastName"]; ?></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><?php echo $_REQUEST["LoginName"]; ?></td>
				</tr>
				<tr>
					<td><input name="editbtn" type="submit" value="Edit"></td><td><input name="proceedbtn" type="submit" value="Submit"></td>
				</tr>
			</table>
			</td>
		</tr>
		</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			
				$insd = "UPDATE _user_acnts SET Password = '".(md5($_REQUEST["Password"]))."' WHERE userID = '".$_REQUEST["typeID"]."';";
				$resd = mysqli_query($db,$insd);
				
				if($resd)
				{
					echo "<p align='center'>Success!</p>";
			
		$Operationx = "Reset User Password for: ".$_REQUEST["FirstName"]." ".$_REQUEST["LastName"].".";
		include_once "iDevTools/system_log.php";
				}
				else
				{
					echo "<p align='center'>Error! Please try again later.</p>";
				}
			
			}
			}
			else
			{
			echo "<p align='center'>Sorry. You do not have permission to this component</p>";
			}
		}
		elseif($_REQUEST["function"]=="edit" && $_REQUEST["unit"]=="8" && $_REQUEST["segment"]=="e3")
		{
			
			
    $_REQUEST["error_message"] = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";
    $date_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $IssuedOn_exp = "/^[0-9]{4}+\-[0-9]{2}+\-[0-9]{2}$/i";
    $numdays_exp = "/^[0-9]{1,3}$/i";
    $YC_exp = "/^[0-9]{1,8}$/i";
	
  if(!$_REQUEST["Active"]) {
    $_REQUEST["error_message"] .= 'The status to be assigned has not been defined.<br />';
  }
  
  
  if(strlen($_REQUEST["error_message"]) > 0) {
   $err = 1;
  }
  else
  {
  $err = 2;
  }
  
	if(@$bx_permissions=="Yes")
	{
			if(($err=="1") || (!$_REQUEST["proceedbtn"]=="Proceed" || $_REQUEST["editbtn"]=="Edit") || ($_REQUEST["proceedbtn"]=="Proceed" && (!$_REQUEST["Active"])))
			{
			
			$sel = "SELECT * FROM _user_acnts WHERE userID = '".$_REQUEST["typeID"]."';";
			@$res = mysqli_query($db,$sel);
			@$num = mysqli_num_rows($res);
			@$row = mysqli_fetch_array($res);
			$userID = $row["userID"];
			$orgx = $row["org"];
			$FirstName = $row["FirstName"];
			$LastName = $row["LastName"];
			$LoginName = $row["LoginName"];
			$typeName = $FirstName." ".$LastName;
			$postal = $row["Postal"];
			$physical = $row["Address"];
			$Telephone = $row["Telephone"];
			$Fax = $row["Fax"];
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
						
<?php
  if($_REQUEST["proceedbtn"]=="Proceed" && $err=="1")
  {
  echo "<p align='center' class='errors'>Error! ".$_REQUEST["error_message"]."</p>";
  }
?>

			<form action="" method="POST"><br><br>
			<input name="FirstName" type="hidden" value="<?php echo $FirstName; ?>">
			<input name="LastName" type="hidden" value="<?php echo $LastName; ?>">
			<input name="LoginName" type="hidden" value="<?php echo $LoginName; ?>">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="Active" type="hidden" value="<?php echo $_REQUEST["Active"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td>
			<table align="center" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td>First Name: </td><td><?php
			echo $FirstName;
			?></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><?php
			echo $LastName;
					?></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><?php
			echo $LoginName;
					?></td>
				</tr>
				<tr>
					<td>Active Status: </td><td><select name="Active"><option value="Yes">Activate</option><option value="No">Deactivate</option></select></td>
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
			elseif($_REQUEST["proceedbtn"]=="Proceed" && $err=="2" && ($_REQUEST["Active"]))
			{
			?>
			<form action="" method="POST">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="FirstName" type="hidden" value="<?php echo $_REQUEST["FirstName"]; ?>">
			<input name="LastName" type="hidden" value="<?php echo $_REQUEST["LastName"]; ?>">
			<input name="Password" type="hidden" value="<?php echo $_REQUEST["Password"]; ?>">
			<input name="Password2" type="hidden" value="<?php echo $_REQUEST["Password2"]; ?>">
			<input name="LoginName" type="hidden" value="<?php echo $_REQUEST["LoginName"]; ?>">
			<input name="Active" type="hidden" value="<?php echo $_REQUEST["Active"]; ?>">
		<table align="center" bgcolor='#fcfcfc'>
		<tr>
			<td><p align="center">Please confirm the changing of status for the user stated below:</p>
			<table align="center" width="350" bgcolor='#fcfcfc' id='tables_css'>
				<tr>
					<td width="120">First Name: </td><td><?php echo $_REQUEST["FirstName"]; ?></td>
				</tr>
				<tr>
					<td>Last Name: </td><td><?php echo $_REQUEST["LastName"]; ?></td>
				</tr>
				<tr>
					<td>Login Name: </td><td><?php echo $_REQUEST["LoginName"]; ?></td>
				</tr>
				<tr>
					<td>Active: </td><td><?php echo $_REQUEST["Active"]; ?></td>
				</tr><?php
				?>
				<tr>
					<td>Level: </td><td><select name='level'><?php
					$sele = "SELECT * FROM _bx_refer_users_types;";
					$rese = mysqli_query($db,$sele);
					@$num_re = mysqli_num_rows($rese);
				if($_REQUEST["level"])
				{
					$clev = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$_REQUEST["level"]."';";
					@$reslev = mysqli_query($db,$clev);
					@$rwlev = mysqli_fetch_array($reslev);
					$uTypeCodev = $rwlev["UserTypeCode"];
					$uTypeNamev = $rwlev["UserTypeName"];
					
					echo '<option value="'.$uTypeCodev.'">'.$uTypeNamev.'</option>';
				}
					for($r=0; $r<$num_re; $r++)
					{
					@$rw_re = mysqli_fetch_array($rese);
					$uTypeCode = $rw_re["UserTypeCode"];
					$uTypeName = $rw_re["UserTypeName"];
					
					echo '<option value="'.$uTypeCode.'">'.$uTypeName.'</option>';
					}?>
					</select></td>
				</tr>
			<tr>
				<td><input name="editbtn" type="submit" value="Edit"></td><td><input name="proceedbtn" type="submit" value="Submit"></td>
			</tr>
				</table>
			</td>
			</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["proceedbtn"]=="Submit")
			{
			$selC = "SELECT * FROM _user_acntsx WHERE userID = '".$_REQUEST["typeID"]."';";
			@$resC = mysqli_query($db,$selC);
			@$numC = mysqli_num_rows($resC);
			
				if($numC>0)
				{
				$insd = "UPDATE _user_acntsx SET Active = '".$_REQUEST["Active"]."', level = '".$_REQUEST["level"]."' WHERE userID = '".$_REQUEST["typeID"]."';";
				}
				else
				{
				$insd = "INSERT INTO _user_acntsx (id,userID,level,Active) VALUES ('','".$_REQUEST["typeID"]."','".$_REQUEST["level"]."','".$_REQUEST["Active"]."');";
				}
				
				$resd = mysqli_query($db,$insd);
				
				if($resd)
				{
					echo "<p align='center'>Success!</p>";
			
		$Operationx = "Set the Active Status of User Password for: ".$_REQUEST["FirstName"]." ".$_REQUEST["LastName"]." to ".$_REQUEST["Active"].".";
		include_once "iDevTools/system_log.php";
				}
				else
				{
					echo "<p align='center'>Error! Please try again later.</p>";
				}
			
			}
			}
			else
			{
			echo "<p align='center'>Sorry. You do not have permission to this component</p>";
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
		
		if($bx_permissions=="Yes")
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
		include_once "mis/access_denied.php";
		}
		}
		elseif($_REQUEST['ref']=="settings" && $_REQUEST['segment']=="e3" && $_REQUEST['function']=="add" && $_REQUEST['unit']=="10")
		{
		
		if($bx_permissions=="Yes")
		{
			if(!$_REQUEST["ProcedBtn"]=="Yes")
			{
			?>
			<form action="" method="POST">
			<input name="Branch" type="hidden" value="<?php echo $_REQUEST["Branch"]; ?>">
			<input name="typeID" type="hidden" value="<?php echo $_REQUEST["typeID"]; ?>">
			<input name="typeName" type="hidden" value="<?php echo $_REQUEST["typeName"]; ?>">
			<table align="center" width="500" bgcolor="#fcfcfc" id="tables_css">
				<tr>
					<td>Are you sure you want to remove <?php echo $_REQUEST["typeName"]; ?> from his/her current branch.</td><td><input name="ProcedBtn" type="submit" value="Yes"></td>
				</tr>
			</table>
			</form><br><br><br>
			<?php
			}
			elseif($_REQUEST["ProcedBtn"]=="Yes")
			{
			
			$delete = "UPDATE _user_acnts SET Branch = '' WHERE userID = '".$_REQUEST["typeID"]."';";
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
		include_once "mis/access_denied.php";
		}
		}
		else
		{
		//echo "test3";
		}
}
?>