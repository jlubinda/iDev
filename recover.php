<section  id="topbox">
<?php

if($_REQUEST["RVCode"]=="")
{
	if(iDevSite()=="localhost")
	{
		$server_url = "http://citydriverentacar.payitapp.co";
		$server_url2 = "http://citydriverentacar.payitapp.co";
	}
	else
	{
		$server_url = "http://citydriverentacar.payitapp.co";
		$server_url2 = "http://citydriverentacar.payitapp.co";
	}

		//$server_url = "localhost";
 
 $selg = "SELECT * FROM _user_acnts WHERE Email = '".$_REQUEST["Email"]."';";
 $resg = mysqli_query($db,$selg);
 @$numg = mysqli_num_rows($resg);
 
 
 $selg2 = "SELECT * FROM _user_acnts WHERE Mobile = '".$_REQUEST["Phone"]."';";
 $resg2 = mysqli_query($db,$selg2);
 @$numg2 = mysqli_num_rows($resg2);
 
 
	$selx = "SELECT * FROM _organization WHERE name = '".$_REQUEST["OrgName"]."';";
	@$rex = mysqli_query($db,$selx);
	@$numx = mysqli_num_rows($rex);
 
 
    $email_to = $_REQUEST["Email"];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,7}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";
    $mobile_exp = "/^[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{3}$/i";
	
	
  if(!preg_match($email_exp,$email_to)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  
  if(strlen($error_message) > 0) {
   $err = 1;
  }
  else
  {
  $err = 2;
  }
  
  
  
  if(strlen($error_messagex) > 0) {
   $err2 = 1;
  }
  else
  {
  $err2 = 2;
  }
  
  
  //if($_REQUEST["submitBtn"]=="Proceed" && $err2=="1")
  //{
  //echo "<p align='center' style='color:#fff000; font-size:11px;'>".$error_messagex."</p>";
  //}
  
  if($_REQUEST["submitBtn"]=="Proceed" && $err=="1")
  {
  echo "<p align='center' style='color:#fff000; font-size:11px;'>".$error_message."</p>";
  }
	  
	if((($err=="1" || !$_REQUEST["Email"]) && $_REQUEST["submitBtn"]=="Proceed") || $_REQUEST["submitBtn"]=="")
	{

		$ddd = explode('@', $_REQUEST['Email']);
		$domainX = $ddd[1];
		$dsss = explode('.', $domainX);
		$domainX1 = $dsss[0];
		
		


		
	echo "<div style=' color:#fff; font-weight:bold; width: 98%; max-width:480px; padding:10px; margin-left:auto; margin-right:auto;' align='center'>";
	 echo "<form action='./?ref=recover' method='POST'>";
	 
		echo "<div style=' color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; max-width:480px; width: 98%; margin:0px; padding:0px; border-radius:0px;'>";
		echo "<div style='float: left; padding:7px; background-color:#000; width:100%;'>Welcome to citydriverentacar.com! Fill the form below to recover your account:</div></div>";

		echo "<div style=' width: 98%; max-width:480px; padding:1%; color:#333; font-size:11px; font-weight:normal; background-color: #eee;'>";
			echo "<table align='center' style=''>";
				echo "<tr>";
					echo "<td align='left'>";
						echo "<b>YOUR REGISTERED EMAIL: </b>";
					echo "</td>";
					echo "<td>";
						echo "<input name='Email' type='text' size='25' value='".$_REQUEST["Email"]."' style='margin:5px;' placeholder='eg johndoe@website.com'>";
					echo "</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td width='50%'>";
					echo "</td>";
					echo "<td align='right' width='50%'>";
						echo "<input name='submitBtn' class='button' type='submit' size='25' value='Proceed' style='margin:5px; background-color:#888; font-weight: bold;'>";
					echo "</td>";
				echo "</tr>";
			echo "</table>";
		echo "</div>";
	 echo "</form>
	 </div>";
	 }
	 elseif($_POST["submitBtn"]=="Proceed" && !($_POST["Email"]=="") && $err=="2")
	 {
	 //////////////////////MAILER////////////////////////////////////////////
	 
	 
	 
		if(isset($_POST["Email"]) && !($_REQUEST["Email"]=="")) 
		{
				// EDIT THE 2 LINES BELOW AS REQUIRED
				$email_to = $_REQUEST["Email"];
				$email_subject = "Vehicle Portal Account Recovery";
				$email_from = "no-reply@vehicleportal.payitapp.co";
				$first_name = getUserData($_REQUEST["Email"],"FirstName"); // required
				$last_name = getUserData($_REQUEST["Email"],"LastName"); // required
				 
				$email_message = "Form details below.\n\n";
				 
				function clean_string($string) {
				  $bad = array("content-type","bcc:","to:","cc:","href");
				  return str_replace($bad,"",$string);
				}
				 
				$email_message .= "Hello ".clean_string($first_name).". <br>";
				$email_message .= "Thank you for using our online account recovery service. Please click the link below to create a new password for your account. <br>\n";
				
				$ddd = explode("@",$email_to);
				$domainX = $ddd[1];
				$dsss = explode(".",$domainX);
				$domainX1 = $ddd[0];
				
				//echo $domainX1;
				
				$RVCode = resetAccount($_REQUEST["Email"]);
				
				$email_message .= "<a href='".$server_url2."/?ref=recover&RVCode=".$RVCode."'>Click here to create a new password.</a><br>\n";
				
				$email_message .= "Or input this code in to the input field provided: ".$RVCode."<br>\n";
				 
				 
			// create email headers

				$headers = "From: " . strip_tags($email_from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($email_from) . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				//echo $email_message."<br>";

				if($RVCode==0)
				{
					echo "ERROR. Please try again later.";
				}
				else
				{
					@mail($email_to, $email_subject, $email_message, $headers); 
					echo "PLEASE CHECK YOUR MAIL FOR YOUR RECOVER INSTRUCTIONS.";
				}
				
				 //////////////////////MAILER////////////////////////////////////////////

		 }
	 }
 }
 else
 {	
	$userID = getAccountFromRecoveryCode($_REQUEST["RVCode"]);

	if(recoveryCodeStatus($userID,$_REQUEST["RVCode"])>=1 && (checkOpenRecoveryStatus($userID)>=1) && !(checkOpenRecoveryStatus($userID)=="ACCOUNT NOT FOUND") && !(checkOpenRecoveryStatus($userID)=="ERROR"))
	{
	
		if(((!($_POST["newpassword2"]==$_POST["newpassword"]) || $_REQUEST["newpassword"]=="" || $_REQUEST["newpassword2"]=="") && $_REQUEST["submitBtn"]=="Proceed") || $_REQUEST["submitBtn"]=="")
		{
		echo "<div style=' color:#fff; font-weight:bold; width: 98%; max-width:480px; padding:0%; margin-left:auto; margin-right:auto;' align='center'>";
			 echo "<form action='./?ref=recover&RVCode=".$_REQUEST["RVCode"]."' method='POST'>";
			 
				echo "<div style='float: left; color:#fff; font-weight:normal; background-color:#1f1f1f; font-size:11px; width: 100%; margin:0px; padding:0px; border-radius:0px;'><div style='float: left; padding:7px;'>Welcome to VehiclePortal.com! Add a new password for your account:</div></div>";
				
				echo "<div style='float: left; width: 98%; max-width:480px; padding:1%; color:#333; font-size:11px; font-weight:normal; background-color: #eee;'><table align='center' style='float: left;'>";
					echo "<tr>";
						echo "<td align='left'>";
							echo "<b>NEW PASSWORD: </b>";
						echo "</td>";
						echo "<td>";
							echo "<input name='newpassword' type='password' size='25' style='margin:5px;'>";
						echo "</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td align='left'>";
							echo "<b>REPEAT NEW PASSWORD: </b>";
						echo "</td>";
						echo "<td>";
							echo "<input name='newpassword2' type='password' size='25' style='margin:5px;'>";
						echo "</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td width='50%'>";
						echo "</td>";
						echo "<td align='right' width='50%'>";
							echo "<input name='submitBtn' class='button' type='submit' size='25' value='Proceed' style='margin:5px; background-color:#888; font-weight: bold;'>";
						echo "</td>";
					echo "</tr>";
				echo "</table></div>";
			 echo "</form></div>";
		}
		elseif($_POST["submitBtn"]=="Proceed" && !($_POST["newpassword"]=="") && !($_POST["newpassword2"]=="") && $_POST["newpassword2"]==$_POST["newpassword"])
		{
			if(closeRecovery($userID,$_REQUEST["RVCode"],$_POST["newpassword"])>=1)
			{
				echo "SUCCESS! <a href='./?ref=login' class='button'>CLICKE HERE</a> TO LOG IN.";
			}
			else
			{
				echo "ERROR! <a href='./?ref=recover' class='button'>CLICKE HERE</a> TO START THE PROCESS AGAIN OR CONTACT SUPPORT via support@vehicleportal.co.zm.";
			}
		}
	}
	else
	{
		echo "ERROR! YOUR RECOVERY LINK IS INVALID. <a href='./?ref=recover' class='button'>CLICKE HERE</a> TO START THE PROCESS AGAIN OR CONTACT SUPPORT via support@vehicleportal.co.zm.";
	}
 }
?>

<br class="clear"/>
</section>