<?php
 if(!SesVar())
{

} 
else 
{
	
	if($registerdX == "2")
	{
	
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
echo "<table align='center' id='tables_css'>
<tr>
<td><p class='sub_menu6' align='center'>You are logged in as:</p>
<table align='center' class='motion' width='500' id='tables_css5'>
<tr><td width='120'><strong>Profile Picture</strong></td><td align='center'><img src='profilepics/".$ProfilePic."' width='100' id='profpic'></td></tr>
<tr><td width='120'><strong>User Name</strong></td><td>$LoginName</td></tr>
<tr><td width='120'><strong>First Name</strong></td><td>$FirstName</td></tr>
<tr><td width='120'><strong>Last Name</strong></td><td>$LastName</td></tr>
<tr><td width='120'><strong>Nickname</strong></td><td>$NickName</td></tr>
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
<tr><td><p class='motion' align='center'><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=d1&unit=1&task=Update'>Click here to change your details</a></p></td></tr>
</table>";
}
if($_REQUEST["task"]=="Update")
{
echo "<br><form action='' method='post' class='motion' enctype='multipart/form-data'><table align='center' class='motion' width='700' bgcolor='#fcfcfc' id='tables_css'>
<tr><td></td><td><span class='sub_menu6'><b><u>Update your information here:</u></b></span></td><td></td><td><input name='task' type='hidden' value='Enter_Data'></td></tr>
<tr><td>First Name:</td><td><input type='text' name='firstname' value='$FirstName'></td><td>Last Name :</td><td><input type='text' name='lastname' size='20' value='$LastName'></td></tr>
<tr><td>Nickname:</td><td><input type='text' name='NickName' value='$NickName'></td><td>Profile Picture :</td><td><input type='file' name='ProfilePic' size='20'></td></tr>
<tr><td>Email:</td><td><input type='text' name='email' value='$Email'></td><td>Tel :</td><td><input type='text' name='phone' size='20' value='$Telephone'></td></tr>
<tr><td>Postal Address:</td><td><input type='text' name='postal' value='$Postal'></td><td>Fax</td><td><input type='text' value='$Fax' name='fax'></td></tr>
<tr><td>Physical Address:</td><td><input type='text' name='address' value='$Address'></td><td>Enter Current Password:</td><td><input type='password' name='password' size='20' value=''>(required)</td></tr>
<tr><td>Enter New Password:</td><td><input type='password' name='password1' size='20' value=''></td><td>Re-Enter New Password:</td><td><input type='password' name='password2' size='20' value=''></td></tr>
<tr><td></td><td><input type='Submit' name='submit' size='20' value='Submit'></td><td></td><td><p class='motion' align='center'><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=d1&unit=1'>Click here to go back</a></p></td></tr></table>
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
 
$target = "profilepics/"; 
 
if($_FILES['ProfilePic']['name'])
{
@$yearx = date(Y);
@$dayx = date(z);
@$hourx = date(G);
@$hour2x = date(h);
@$minsx = date(i);
@$secx = date(s);

		$sess_idx = rand(0, 999999999999999999999999);
		$timexx = ($yearx*365*24*60*60)+($dayx*24*60*60)+($hourx*60*60)+($minsx*60)+$secx;
		$cccxA = md5($timexx." || ".$sess_idx." || ".$userID." || ".SesVar()." |D| ");
		$cccxB = md5($timexx." |A| ".$sess_idx." |B| ".$userID." |C| ".SesVar()." |D| ");

 $target = $target . basename( $_FILES['ProfilePic']['name']) ;
 
 if(move_uploaded_file($_FILES['ProfilePic']['tmp_name'], $target)) 
 {
 echo "The file ". basename( $_FILES['ProfilePic']['name']). " has been uploaded";
 $rename = "success"; 
 
 $qq = explode(".",$_FILES['ProfilePic']['name']);
 $filetype = $qq[1];
 
$name1 = "profilepics/".basename( $_FILES['ProfilePic']['name']);	
$name2 = "profilepics/".$cccxA.".".$filetype;

 if(rename($name1,$name2))
 {
 $propictext = "Profile Pic";
$insertXA = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$userID."','".$cccxA.".".$filetype."','".md5($propictext)."','');";
@$resINSXA = mysqli_query($db,$insertXA);
	
	if($resINSXA)
	{
	echo "<p align='center'>Success! Your profile picture has been updated.</p>";
	}
	else
	{
	echo "<p align='center'>Error! Your profile picture could not be updated. Please try again later.</p>";
	}
 }
 else
 {
 echo "<p align='center'>Error! Your profile picture could not be updated. Please try again later.</p>";
 }


 }
 else 
 {
 echo "Sorry, there was a problem uploading your file.";
 $rename = "";
 }
			
			/* if($rename)
			{
			echo "<p align='center'>Success!</p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			} */
}

	///////////////////////////////////////////////
	if(!($firstnamex==$FirstName) && $firstnamex)
	{
	$query3="UPDATE _user_acnts SET FirstName = '$firstnamex' WHERE userid ='$userID';";
	$result3=mysqli_query($db,$query3);
		if($result3)
		{
		echo "<p class='motion' align='center'><span class='motion'>First Name has successfully been updated.</span></p>";
			
		$Operationx = "Updated First Name.";
		include "mis/system_log.php";
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
		include "mis/system_log.php";
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
		include "mis/system_log.php";
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
		include "mis/system_log.php";
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
		include "mis/system_log.php";
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
		include "mis/system_log.php";
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
		include "mis/system_log.php";
		}
	}
  
  
if((($password1x==$password2x)&&$password1x&&$password2x) && strlen($password2x)>5)
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
		include "mis/system_log.php";
		}
	}
}
elseif(((!($password1x==$password2x))&&$password1x&&$password2x) && strlen($password2x)>5)
{
echo "<p class='motion' align='center'>Sorry. The new password does not match the re-entered one. Please try again with the correct one.</p>";
}
elseif(((($password1x==$password2x))&&$password1x&&$password2x) && strlen($password2x)<6)
{
echo "<p class='motion' align='center'>Sorry. Your password is less than 6 characters. Please try again using six or more characters in your password.</p>";
}
elseif(((($password1x==$password2x))&&!$password1x&&!$password2x) && strlen($password2x)>5)
{
echo "<p class='motion' align='center'>Sorry. You have not specified a new password. Please do so and try again.</p>";
}




	
}
else
{
	if($_REQUEST["password"])
	{
	echo "<p class='motion' align='center'>Sorry. The current password you have entered does not match the actual one. Please try again with the correct one.</p>";
	}
	elseif(!$_REQUEST["password"])
	{
	echo "<p class='motion' align='center'>Sorry. You have not entered your current password. You cannot edit any information here unless you enter your current password correctly. Please try again with the correct one.</p>";
	}
}

echo "<br><p class='motion' align='center'><a href='?ref=<?php echo iDevSite("DASHBOARD URL");?>&segment=d1&unit=1&task=Update'>Back</a></p>";
}

	}
	else
	{
	include "mis/access_denied.php";
	}
}

?>