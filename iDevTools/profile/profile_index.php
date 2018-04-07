<?php
 if(chkSes()=="Inactive")
{

} 
else 
{
	
	if($registerdX == "2")
	{

		//Those who should view suppliers to national bueraus

	
	$select_org = "SELECT * FROM _organization WHERE id = '".$org."';";
	$res_orgX = mysqli_query($db,$select_org);
	@ $num_orgX = mysqli_num_rows($res_orgX);

	
	if($num_orgX=="" || $num_orgX=="0")
	{
	$OrganizationName = $Organization_Name;
	}
	elseif($num_orgX>="1")
	{
	$orwX = mysqli_fetch_array($res_orgX);
	$OrganizationName = $orwX["name"];
	}
	else
	{
	$OrganizationName = $Organization_Name;
	}
	
	

	$UserLevelx = $UserTypeNamezz;
	
	
if(!$_REQUEST["task"])
{	
echo "<table align='center' bgcolor='#fcfcfc' id='tables_css'>
<tr>
<td><p class='sub_menu6' align='center'>You are logged in as:</p>
<table align='center' class='motion' width='500' bgcolor='#fcfcfc'>
<tr><td width='120'><strong>User Name</strong></td><td>$LoginName</td></tr>
<tr><td width='120'><strong>First Name</strong></td><td>$FirstName</td></tr>
<tr><td width='120'><strong>Last Name</strong></td><td>$LastName</td></tr>
<tr><td width='120'><strong>User Level</strong></td><td>$UserLevelx</td></tr>
<tr><td><strong>Organization</strong></td><td>$OrganizationName</td></tr>";

if($has_branchez=="Yes" && $Branch)
{
echo "<tr><td><strong>Branch</strong></td><td>$BrnchNamez</td></tr>";
}

echo "<tr><td><strong>Country</strong></td><td>$CountryName</td>
</tr>
<tr><td><strong>Email Address:</strong>&nbsp;</td><td>$Email </td></tr>
<tr><td><strong>Tel: </strong>&nbsp;</td><td>$Telephone&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
<tr><td><strong>Fax:</strong>&nbsp;</td><td>$Fax</td></tr>
<tr><td><strong>Postal Address:</strong>&nbsp;</td><td>$Postal</td></tr>
<tr><td><strong>Physical Address:</strong>&nbsp;</td><td>$Address</td></tr></table>
<br>
</td>
</tr>
<tr><td><p class='motion' align='center'><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&task=Update'>Click here to change your details</a></p></td></tr>
</table>";
}
if($_REQUEST["task"]=="Update")
{
echo "<br><form action='' method='post' class='motion'><table align='center' class='motion' width='700' bgcolor='#fcfcfc' id='tables_css'>
<tr><td></td><td><span class='sub_menu6'><b><u>Update your information here:</u></b></span></td><td></td><td><input name='task' type='hidden' value='Enter_Data'></td></tr>
<tr><td>First Name:</td><td><input type='text' name='firstname' value='$FirstName'></td><td>Last Name :</td><td><input type='text' name='lastname' size='20' value='$LastName'></td></tr>
<tr><td>Email:</td><td><input type='text' name='email' value='$Email'></td><td>Tel :</td><td><input type='text' name='phone' size='20' value='$Telephone'></td></tr>
<tr><td>Postal Address:</td><td><input type='text' name='postal' value='$Postal'></td><td>Fax</td><td><input type='text' value='$Fax' name='fax'></td></tr>
<tr><td>Physical Address:</td><td><input type='text' name='address' value='$Address'></td><td>Enter Current Password:</td><td><input type='password' name='password' size='20' value=''>(required)</td></tr>
<tr><td>Enter New Password:</td><td><input type='password' name='password1' size='20' value=''></td><td>Re-Enter New Password:</td><td><input type='password' name='password2' size='20' value=''></td></tr>
<tr><td></td><td><input type='Submit' name='submit' size='20' value='Submit'></td><td></td><td><p class='motion' align='center'><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>'>Click here to go back</a></p></td></tr></table>
";
}

if($_REQUEST["task"]=="Enter_Data")
{
$firstnamex = trim($_REQUEST["firstname"]);
$lastnamex = trim($_REQUEST["lastname"]);
$emailx = trim($_REQUEST["email"]);
$phonex = trim($_REQUEST["phone"]);
$addressx = trim($_REQUEST["address"]);
$passwordx = trim($_REQUEST["password"]);
$faxx = trim($_REQUEST["fax"]);
$postalx = trim($_REQUEST["postal"]);
$password1x = trim($_REQUEST["password1"]);
$password2x = trim($_REQUEST["password2"]);
$passwordxx = md5($passwordx);

if($passwordxx==$_idxZx)
{

	///////////////////////////////////////////////
	if(!($firstnamex==$FirstName) && $firstnamex)
	{
	$query3="UPDATE _user_acnts SET FirstName = '$firstnamex' WHERE userid ='$userID';";
	$result3=mysqli_query($db,$query3);
		if($result3)
		{
		echo "<p class='motion' align='center'><span class='motion'>First Name has successfully been updated.</span></p>";
			
		$Operationx = "Updated First Name.";
		include_once "iDevTools/system_log.php";
		}
	}
	
	if(!($lastnamex==$LastName) && $lastnamex)
	{
	$query4="UPDATE _user_acnts SET LastName = '$lastnamex' WHERE userid ='$userID';";
	$result4=mysqli_query($db,$query4);
		if($result4)
		{
		echo "<p class='motion' align='center'><span class='motion'>Last Name has successfully been updated.</span></p>";
			
		$Operationx = "Updated Last Name.";
		include_once "iDevTools/system_log.php";
		}
	}
	///////////////////////////////////////////////
	if(!($emailx==$Email) && $emailx)
	{
	$query3="UPDATE _user_acnts SET Email = '$emailx' WHERE userid ='$userID';";
	$result3=mysqli_query($db,$query3);
		if($result3)
		{
		echo "<p class='motion' align='center'><span class='motion'>Email has successfully been updated.</span></p>";
			
		$Operationx = "Updated Email Address.";
		include_once "iDevTools/system_log.php";
		}
	}
	
	if(!($phonex==$Telephone) && $phonex)
	{
	$query4="UPDATE _user_acnts SET Telephone = '$phonex' WHERE userid ='$userID';";
	$result4=mysqli_query($db,$query4);
		if($result4)
		{
		echo "<p class='motion' align='center'><span class='motion'>Telephone Number has successfully been updated.</span></p>";
			
		$Operationx = "Updated Telephone Number.";
		include_once "iDevTools/system_log.php";
		}
	}
	
	if(!($faxx==$Fax) && $faxx)
	{
	$query4="UPDATE _user_acnts SET Fax = '$fax' WHERE userid ='$userID';";
	$result4=mysqli_query($db,$query4);
		if($result4)
		{
		echo "<p class='motion' align='center'><span class='motion'>Fax Number has successfully been updated.</span></p>";
			
		$Operationx = "Updated Fax Number.";
		include_once "iDevTools/system_log.php";
		}
	}
	
	if(!($postalx==$Postal) && $postalx)
	{
	$query5="UPDATE _user_acnts SET Postal = '$postalx' WHERE userid ='$userID';";
	$result5=mysqli_query($db,$query5);
		if($result5)
		{
		echo "<p class='motion' align='center'><span class='motion'>Postal Address has successfully been updated.</span></p>";
			
		$Operationx = "Updated Postal Address.";
		include_once "iDevTools/system_log.php";
		}
	}
	
	if(!($addressx==$Address) && $addressx)
	{
	$query5="UPDATE _user_acnts SET Address = '$addressx' WHERE userid ='$userID';";
	$result5=mysqli_query($db,$query5);
		if($result5)
		{
		echo "<p class='motion' align='center'><span class='motion'>Physical Address has successfully been updated.</span></p>";
			
		$Operationx = "Updated Physical Address.";
		include_once "iDevTools/system_log.php";
		}
	}
	

  if(strlen ($_REQUEST["Password"])<6) {
    $_REQUEST["error_message"] .= 'You "Password" has less than 6 characters, please ensure you use more than 5 characters.<br />';
  }

if((($password1x==$password2x)&&$password1x&&$password2x) && strlen($password2x)<6)
{	
	if($password1x)
	{
	$password1xm = md5($password1x);
	$query7="UPDATE _user_acnts SET Password = '$password1xm' WHERE userid ='$userID';";
	$result7=mysqli_query($db,$query7);
		if($result7)
		{
		echo "<p class='motion' align='center'><span class='motion'>Password has successfully been updated.</span></p>";
			
		$Operationx = "Changed Password.";
		include_once "iDevTools/system_log.php";
		}
	}
}
else
{
if($password1x&&$password2x)
{
echo "<p class='motion' align='center'>Sorry. The new password does not match the re-entered one, or the password field is empty. Please try again with the correct one.</p>";
}
if(strlen($password2x)<6)
{
echo "<p class='motion' align='center'>Sorry. The new password has less than 6 characters. Please try again with more than 5 characters in your password.</p>";
}
}	
}
else
{
	if($_REQUEST["password"])
	{
	echo "<p class='motion' align='center'>Sorry. The current password you have entered does not match the actual one. Please try again with the correct one.</p>";
	}
	else
	{
	echo "<p class='motion' align='center'>Sorry. You have not entered your current password. You cannot edit any information here unless you enter your current password correctly. Please try again with the correct one.</p>";
	}
}

echo "<br><p class='motion' align='center'><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&task=Update'>Back</a></p>";
}

	}
	else
	{
	include_once "mis/access_denied.php";
	}
}

?>