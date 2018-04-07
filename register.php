<span style="color:#000;">
<?php

if($_REQUEST["RVCode"]=="")
{
	if(iDevSite()=="localhost")
	{
		$server_url = "http://citydriverentacar.com";
		$server_url2 = "http://citydriverentacar.com";
	}
	else
	{
		$server_url = "http://citydriverentacar.com";
		$server_url2 = "http://citydriverentacar.com";
	}
		$LoginNames = getUserData($users,"LoginName");
		$Email = getUserData($users,"Email");
		$Mobile = getUserData($users,"Mobile");
 
 /*
	$selx = "SELECT * FROM _organization WHERE name = '".$_REQUEST["OrgName"]."';";
	@$rex = mysqli_query($db,$selx);
	@$numx = mysqli_num_rows($rex);
 */
 
    $email_to = $_REQUEST["Email"];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";
    $mobile_exp = "/^[0-9]{3}[0-9]{3}[0-9]{3}[0-9]{3}$/i";
	
	//checkLoginNameUsed($userID)
  //if($numx>="1") {
    //$error_messagex = 'This Organization Name <i>"'.$_REQUEST["OrganizationName"].'"</i>, has already been registered. Please try another name, unless you are registering yourself to this organization.<br />';
  //}
  if(checkAccountMobileUsed($_REQUEST["Phone"])==1) {
    $error_message .= 'The Mobile Number you entered has already been registered.<br />';
  } 
  if(checkAccountEmailUsed($_REQUEST["Email"])==1) {
    $error_message .= 'The Email Address you entered has already been registered.<br />';
  }
  if(!preg_match($email_exp,$email_to)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$_REQUEST["FirstName"])) {
    $error_message .= 'The Name(s) you entered do not appear to be valid.<br />';
  }
  //if(!preg_match($string_exp,$_REQUEST["LastName"])) {
    //$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  //}
// validate a phone number
  //if( !preg_match($mobile_exp, $_REQUEST["Phone"]) ) { 
   // $error_message .= 'Please enter a valid phone number';
  //}

  //if(strlen($_REQUEST["OrganizationName"]) < 2) {
    //$error_message .= 'The Organization Name you entered does not appear to be valid.<br />';
  //}
  
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
  
  
  if(($_POST["submitBtn"]=="Proceed" || $_POST["submitBtn"]=="Register") && $err2=="1")
  {
  echo "<p align='center' style='color:#000; font-size:13px;'>".$error_messagex."</p>";
  }
  
  if(($_POST["submitBtn"]=="Proceed" || $_POST["submitBtn"]=="Register") && $err=="1")
  {
  echo "<p align='center' style='color:#000; font-size:13px;'>".$error_message."</p>";
  }
	  
	if((($err=="1" || $_REQUEST["Password"]=="" || !$_REQUEST["Email"] || !$_REQUEST["FirstName"]) && ($_POST["submitBtn"]=="Proceed" || $_POST["submitBtn"]=="Register")) || $_REQUEST["submitBtn"]=="")
	{

		$ddd = explode('@', $_REQUEST['Email']);
		$domainX = $ddd[1];
		$dsss = explode('.', $domainX);
		$domainX1 = $dsss[0];
		
?>
</span>
<div class="container">
	
	<div class="row">
		<div class="col s12 m10 offset-m1 l9 offset-l1">
			
			

			
	 <div class="section"></div>
  <main>
    <center>
     
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

			
			
			 <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='text' name='FirstName' id='text' />
                <label for='text'>Enter Your Full Name</label>
              </div>
            </div>
			
			
			 <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='tel' name='Phone' id='tel' />
                <label for='tel'> Enter Phone Number</label>
              </div>
            </div>
			
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='Email' id='email' />
                <label for='email'>Enter your email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='Password' id='password' />
                <label for='password'>Create your password</label>
              </div>
              <label style='float: right;'>
								<a class='pink-text' href='?ref=login'><b>Already Have an Account?</b></a>
							</label>
            </div>
			<?php 
			$cats = listCountries();
			echo "<input name='Country' type='hidden' value='".$cats[0]["name"]."'>";
			?>
            <br />
            <center>
              <div class='row'>
			  <input class="waves-effect waves-light btn" name="submitBtn" type="submit" value="Proceed">
              </div>
            </center>
          </form>
        </div>
      </div>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>		
			
			
		</div>
	</div>
</div>
<?php
	 }
	 elseif((($_POST["submitBtn"]=="Proceed" || $_POST["submitBtn"]=="Register") && (!$_POST["Password"]=="" && $_POST["Email"] && $_POST["FirstName"])) || $_POST["submitBtn"]=="SUBMIT")
	 {
	 //////////////////////MAILER////////////////////////////////////////////
	 
	 
	 
		if(isset($_POST["Email"])) 
		{
	 
			$sess_idX = rand(0, 999999999);
			$ddd = date("Y-m-d H:i:s");
			$timexX = strtotime($ddd);
			$RVCode = md5($timexX." | ".$sess_idX." | ".$_REQUEST["Email"]." | ".$_REQUEST["Phone"]." | ".$_REQUEST["FirstName"]." | ".$_REQUEST["Password"]." | ".$_REQUEST["Country"]);
			
			//_user_acnts
			$names = explode (" ",$_REQUEST["FirstName"]);
			$FirstName = $names[0];
			$LastName = $names[1];
			$LoginName = "";
			$NickName = "";
			
			//$insd = "INSERT INTO _user_acnts (userID,UserCode,AccountType,org,Email,FirstName,LastName,LoginName,Password,Address,Postal,Fax,Telephone,Mobile,Remarks,RecordEnteredBy,QuasAdmin,Active,level,Country) VALUES ('','".$RVCode."','Subscriber','".$_REQUEST["OrganizationName"]."','".$_REQUEST["Email"]."','".$FirstName."','".$LastName."','".$_REQUEST["Email"]."','".(md5($_REQUEST["Password"]))."','".$_REQUEST["Address"]."','".$_REQUEST["Postal"]."','".$_REQUEST["Fax"]."','".$_REQUEST["Telephone"]."','+".$_REQUEST["MobileNumber"]."','Contact Person','".$userID."','','0','".$_REQUEST["level"]."','".$_REQUEST["Country"]."');";
			//$resd = mysqli_query($db,$insd);
			
			if($_REQUEST["submitBtn"]=="SUBMIT" && !($_REQUEST["code"]=="") && voucherUsed($_REQUEST["code"])==0)
			{
				if(checkCodeExist($_REQUEST["code"],$_REQUEST['Phone'],1)==1)
				{
					if(setAccountMobileVerified($_REQUEST['Phone'])==1)
					{
						$activate = activateUserAccount($_REQUEST['Phone']);
						
						if($activate==1)
						{
							echo "<p align='center'>Congratulations ".$_REQUEST["FirstName"]."! Your account is now activated. <a href='?ref=".iDevSite("DASHBOARD URL")."/addvehicle.php' class='button'>Click here to login start earning revenue on your vehicle.</a></p>";
						}
						else
						{
							registration($_POST['Phone']);
							echo "<p align='center'>Sorry ".$_REQUEST["FirstName"]."! Error Activating your account. Please provide the new code sent to your phone in the field below: <br><div><form action='./?ref=register' method='POST'><input name='Email' type='hidden' value='".$_REQUEST["Email"]."'><input name='Phone' type='hidden' value='".$_REQUEST["Phone"]."'><input name='FirstName' type='hidden' value='".$_REQUEST["FirstName"]."'><input name='LastName' type='hidden' value='".$_REQUEST["LastName"]."'><div='background-color:#ccc; padding:3px; boder-radius:4px;'><input name='code' type='text' placeholder='6 DIGIT CODE'><input name='submitBtn' type='submit' value='SUBMIT'></div></form></div></p>";
						}
					}
					else
					{
						registration($_POST['Phone']);
						echo "<p align='center'>Sorry ".$_REQUEST["FirstName"]."! Error verifying your phone number. Please provide the new code sent to your phone in the field below: <br><div><form action='./?ref=register' method='POST'><input name='Email' type='hidden' value='".$_REQUEST["Email"]."'><input name='Phone' type='hidden' value='".$_REQUEST["Phone"]."'><input name='FirstName' type='hidden' value='".$_REQUEST["FirstName"]."'><input name='LastName' type='hidden' value='".$_REQUEST["LastName"]."'><input name='code' type='text' placeholder='6 DIGIT CODE'><input name='submitBtn' type='submit' value='SUBMIT'></form></div></p>";
					}
				}
				elseif(checkCodeExist($_REQUEST["code"],$_REQUEST['Phone'],1)==0.5)
				{
					registration($_POST['Phone']);
					
					echo "<p align='center'>Sorry ".$_REQUEST["FirstName"]."! Your code is expired. Please provide the new code sent to your phone in the field below: <br><div><form action='./?ref=register' method='POST'><input name='Email' type='hidden' value='".$_REQUEST["Email"]."'><input name='Phone' type='hidden' value='".$_REQUEST["Phone"]."'><input name='FirstName' type='hidden' value='".$_REQUEST["FirstName"]."'><input name='LastName' type='hidden' value='".$_REQUEST["LastName"]."'><input name='code' type='text' placeholder='6 DIGIT CODE'><input name='submitBtn' type='submit' value='SUBMIT'></form></div></p>";
				}
				elseif(checkCodeExist($_REQUEST["code"],$_REQUEST['Phone'],1)==0)
				{
					echo "<p align='center'>Sorry. Your code is not correct. Please try again.</p>";
				}
			}
			else
			{
				
				createUserAccount($FirstName,$LastName,$LoginName,$NickName,$_POST['Phone'],$_REQUEST["Email"],$_REQUEST["Password"],$_REQUEST["Country"]);
				
				$resultXv2 = mysqli_query($db,"INSERT INTO ract (id,RVCode,Email,MobileNumber,Activation) VALUES('','".$RVCode."','".$_REQUEST["Email"]."','".standadizesMobile($_POST['Phone'])."','Pending');");
				
				if($resultXv2)
				{
				
				}
				
				registration($_POST['Phone']);
				echo "<p align='center'>Congratulations ".$_REQUEST["FirstName"]."! You have completed the first part of your registration. Provide your confirmation code from your phone number below: <br><div><form action='./?ref=register' method='POST'><input name='Email' type='hidden' value='".$_REQUEST["Email"]."'><input name='Phone' type='hidden' value='".$_REQUEST["Phone"]."'><input name='FirstName' type='hidden' value='".$_REQUEST["FirstName"]."'><input name='LastName' type='hidden' value='".$_REQUEST["LastName"]."'><input name='code' type='text' placeholder='6 DIGIT CODE'><input name='submitBtn' type='submit' value='SUBMIT'></form></div></p>";
			
				
				function died($error) {
					// your error code can go here
					echo "We are very sorry, but there were error(s) found with the form you submitted. ";
					echo "These errors appear below.<br /><br />";
					echo $error."<br /><br />";
					echo "Please go back and fix these errors.<br /><br />";
					die();
				}
				 
				// EDIT THE 2 LINES BELOW AS REQUIRED
				$email_to = $_REQUEST["Email"];
				$email_subject = "UAgro Account Activation";
				$email_from = "no-reply@uagro.co";
				$first_name = $_POST['FirstName']; // required
				$last_name = $_POST['LastName']; // required
				$telephone = $_POST['Phone']; // not required
				$OrganizationName = $_POST['OrganizationName']; // required
				 
				$email_message = "Form details below.\n\n";
				 
				function clean_string($string) {
				  $bad = array("content-type","bcc:","to:","cc:","href");
				  return str_replace($bad,"",$string);
				}
				 
				$email_message .= "Hello ".clean_string($first_name).". <br>";
				$email_message .= "Thank you for using our online registration service. Please click the link below to verify your email and continue with your registration process. <br>";
				
				$ddd = explode("@",$email_to);
				$domainX = $ddd[1];
				$dsss = explode(".",$domainX);
				$domainX1 = $ddd[0];
				
				//echo $domainX1;
				
				$email_message .= "<a href='".$server_url2."/?ref=register&RVCode=".$RVCode."'>Click here to verify your email address.</a><br>";
				
				$email_message .= "Telephone: +".clean_string($telephone)."<br>";
				 
				 
			// create email headers

				$headers = "From: " . strip_tags($email_from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($email_from) . "\r\n";
				//$headers .= "CC: susan@example.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


				@mail($email_to, $email_subject, $email_message, $headers); 
				 //////////////////////MAILER////////////////////////////////////////////

			}
		 }
	 }
	 else
	 {
		
	 }
 }
 else
 {
	 include find_file('cnct.php');
	 
	 if($_REQUEST["editbtn"]=="Back" || $_REQUEST["editbtn"]=="Edit" || (!$_REQUEST["submitBtn"]) || ($_REQUEST["submitBtn"]=="Proceed" && (!$_REQUEST["CatchmentArea"] || !$_REQUEST["CoverageLevel"] || !$_REQUEST["Province"] || !$_REQUEST["District"] || !$_REQUEST["OrgEmail"] || !$_REQUEST["PostalAddress"] || !$_REQUEST["PhysicalAddress"] || !$_REQUEST["OtherAffiliations"] || !$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Male"] || !$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Female"] || !$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Female"] || !$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Male"] || !$_REQUEST["PresenceOfABoardExecutiveCommittee"] || (!$_REQUEST["ThematicAreaOther"] && !$_REQUEST["ThematicArea"]) || (!$_REQUEST["OrgType"] && !$_REQUEST["OtherOrgType"]) || !$_REQUEST["MainProgramFocusArea"] || !$_REQUEST["OrgName"])))
	 {
		 $selectxv = "SELECT * FROM ract WHERE RVCode = '".$_REQUEST["RVCode"]."' AND Activation = 'Pending';";
		 $resxv = mysqli_query($db,$selectxv);
		 @$numxv = mysqli_num_rows($resxv);
		 @$rwv = mysqli_fetch_array($resxv);
		 $Email = $rwv["Email"];
		 $MobileNumber = $rwv["MobileNumber"];
		 
		 
		 $selectxv2 = "SELECT * FROM ract WHERE RVCode = '".$_REQUEST["RVCode"]."' AND Activation = 'Active';";
		 $resxv2 = mysqli_query($db,$selectxv2);
		 @$numxv2 = mysqli_num_rows($resxv2);
		 @$rwv2 = mysqli_fetch_array($resxv2);
		 $Email2 = $rwv2["Email"];
		 $MobileNumber2 = $rwv2["MobileNumber"];
		 
		 $selg = "SELECT * FROM _user_acnts WHERE Email = '".$Email."' OR Mobile = '".$MobileNumber."';";
		 $resg = mysqli_query($db,$selg);
		 @$numg = mysqli_num_rows($resg);
		 $rwj = mysqli_fetch_array($resg);
		 $userIDx = $rwj["userID"];
		 $FirstName = $rwj["FirstName"];
		 $LastName = $rwj["LastName"];
		 $UserCode = $rwj["UserCode"];
		 $org = $rwj["org"];
		 
		 
		 $selg2 = "SELECT * FROM _user_acnts WHERE Email = '".$Email2."' OR Mobile = '".$MobileNumber2."';";
		 $resg2 = mysqli_query($db,$selg2);
		 @$numg2 = mysqli_num_rows($resg2);
		 $rwj2 = mysqli_fetch_array($resg2);
		 $userID2 = $rwj2["userID"];
		 $FirstName2 = $rwj2["FirstName"];
		 $LastName2 = $rwj2["LastName"];
		 $UserCode2 = $rwj2["UserCode"];
		 $org2 = $rwj2["org"];
		 
		 if($numxv>="1")
		 {
		 $orgx =$org;
		 }
		 else
		 {
		 $orgx =$org2;
		 }
		 
		 
		if($numxv>="1")
		{
		 $Actv = "UPDATE ract SET Activation = 'Active' WHERE RVCode = '".$_REQUEST["RVCode"]."';";
		 $reActv = mysqli_query($db,$Actv);
		 
			if($reActv)
			{
				echo "<p align='center'>Congratulations ".$FirstName."! Your email address has successfully been verified!</p>";
			}
		}
		elseif($numxv2>="1")
		{
		echo "<p align='center'>Hello ".$FirstName2.". Welcome back. Your email address is already verified.</p>";
		}
	}
	elseif(($_REQUEST["submitBtn"]=="Proceed") && ($_REQUEST["CatchmentArea"] && $_REQUEST["CoverageLevel"] && $_REQUEST["Province"] && $_REQUEST["District"] && $_REQUEST["OrgEmail"] && $_REQUEST["PostalAddress"] && $_REQUEST["PhysicalAddress"] && $_REQUEST["OtherAffiliations"] && $_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Male"] && $_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Female"] && $_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Female"] && $_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Male"] && $_REQUEST["PresenceOfABoardExecutiveCommittee"] && ($_REQUEST["ThematicAreaOther"] || $_REQUEST["ThematicArea"]) && ($_REQUEST["OrgType"] || $_REQUEST["OtherOrgType"]) && $_REQUEST["MainProgramFocusArea"] && $_REQUEST["OrgName"]))
	{

	 $form = "<form action='' method='POST'>";
		$form .= "<input type='hidden' name='OrgName' value='".$_REQUEST["OrgName"]."'>";
		$form .= "<input type='hidden' name='MainProgramFocusArea' value='".$_REQUEST["MainProgramFocusArea"]."'>";
		if($_REQUEST["OrgType"])
		{
		$form .= "<input type='hidden' name='OrgType' value='".$_REQUEST["OrgType"]."'>";
		}
		else
		{
		$form .= "<input type='hidden' name='OrgType' value='".$_REQUEST["OtherOrgType"]."'>";
		}
		
		if($_REQUEST["ThematicArea"])
		{
		$form .= "<input type='hidden' name='ThematicArea' value='".$_REQUEST["ThematicArea"]."'>";
		}
		else
		{
		$form .= "<input type='hidden' name='ThematicArea' value='".$_REQUEST["ThematicAreaOther"]."'>";
		}
		
		$form .= "<input type='hidden' name='PresenceOfABoardExecutiveCommittee' value='".$_REQUEST["PresenceOfABoardExecutiveCommittee"]."'>";
		$form .= "<input type='hidden' name='NumOfBoardMembersOnTheBoardExecutiveCommittee_Male' value='".$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Male"]."'>";
		$form .= "<input type='hidden' name='NumOfBoardMembersOnTheBoardExecutiveCommittee_Female' value='".$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Female"]."'>";
		$form .= "<input type='hidden' name='NumOfOrdinaryMembersOfTheOrganization_Male' value='".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Male"]."'>";
		$form .= "<input type='hidden' name='NumOfOrdinaryMembersOfTheOrganization_Female' value='".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Female"]."'>";
		$form .= "<input type='hidden' name='OtherAffiliations' value='".$_REQUEST["OtherAffiliations"]."'>";
		$form .= "<input type='hidden' name='PhysicalAddress' value='".$_REQUEST["PhysicalAddress"]."'>";
		$form .= "<input type='hidden' name='PostalAddress' value='".$_REQUEST["PostalAddress"]."'>";
		$form .= "<input type='hidden' name='OrgEmail' value='".$_REQUEST["OrgEmail"]."'>";
		$form .= "<input type='hidden' name='District' value='".$_REQUEST["District"]."'>";
		$form .= "<input type='hidden' name='Province' value='".$_REQUEST["Province"]."'>";
		$form .= "<input type='hidden' name='CoverageLevel' value='".$_REQUEST["CoverageLevel"]."'>";
		$form .= "<input type='hidden' name='CatchmentArea' value='".$_REQUEST["CatchmentArea"]."'>";
	 $form .= "<table align='center'>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Organization Name:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["OrgName"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Main Program Focus Area:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["MainProgramFocusArea"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Organization Type:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
	 if($_REQUEST["OrgType"])
	 {
		$form .= $_REQUEST["OrgType"];
	 }
	 else
	 {
		$form .= $_REQUEST["OtherOrgType"];
	 }
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Thematic Area:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
	 if($_REQUEST["ThematicArea"])
	 {
		$form .= $_REQUEST["ThematicArea"];
	 }
	 else
	 {
		$form .= $_REQUEST["ThematicAreaOther"];
	 }
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Presence of a Board/Executive Committee:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["PresenceOfABoardExecutiveCommittee"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>No. of Board Members on the Board/Executive Committee (Male):</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Male"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>No. of Board Members on the Board/Executive Committee (Female):</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Female"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>No. of ordinary members of the organization:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= "Male: ".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Male"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female: ".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Female"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Other affiliations:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["OtherAffiliations"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Physical Address:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["PhysicalAddress"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Postal Address:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["PostalAddress"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Organization Email:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["OrgEmail"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>District:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["District"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Province:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["Province"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Coverage/Level:</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["CoverageLevel"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td>";
		$form .= "<b>Catchment Area (Actual Area of Operation):</b>";
	 $form .= "</td>";
	 $form .= "<td>";
		$form .= $_REQUEST["CatchmentArea"];
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "<tr>";
	 $form .= "<td align='left'>";
		$form .= "<input name='editbtn' value='Edit' size='25' type='submit'>";
	 $form .= "</td>";
	 $form .= "<td align='right'>";
		$form .= "<input name='submitBtn' value='Submit' size='25' type='submit'>";
	 $form .= "</td>";
	 $form .= "</tr>";
	 $form .= "</table>";
	 $form .= "</form>";
	 echo $form;
	}
	elseif($_REQUEST["submitBtn"]=="Submit")
	{

	 $form = "<form action='' method='POST'>";
		$form .= "<input type='hidden' name='OrgName' value='".$_REQUEST["OrgName"]."'>";
		$form .= "<input type='hidden' name='MainProgramFocusArea' value='".$_REQUEST["MainProgramFocusArea"]."'>";
		if($_REQUEST["OrgType"])
		{
		$form .= "<input type='hidden' name='OrgType' value='".$_REQUEST["OrgType"]."'>";
		}
		else
		{
		$form .= "<input type='hidden' name='OrgType' value='".$_REQUEST["OtherOrgType"]."'>";
		}
		
		if($_REQUEST["ThematicArea"])
		{
		$form .= "<input type='hidden' name='ThematicArea' value='".$_REQUEST["ThematicArea"]."'>";
		}
		else
		{
		$form .= "<input type='hidden' name='ThematicArea' value='".$_REQUEST["ThematicAreaOther"]."'>";
		}
		 
		$form .= "<input type='hidden' name='PresenceOfABoardExecutiveCommittee' value='".$_REQUEST["PresenceOfABoardExecutiveCommittee"]."'>";
		$form .= "<input type='hidden' name='NumOfBoardMembersOnTheBoardExecutiveCommittee_Male' value='".$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Male"]."'>";
		$form .= "<input type='hidden' name='NumOfBoardMembersOnTheBoardExecutiveCommittee_Female' value='".$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Female"]."'>";
		$form .= "<input type='hidden' name='NumOfOrdinaryMembersOfTheOrganization_Male' value='".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Male"]."'>";
		$form .= "<input type='hidden' name='NumOfOrdinaryMembersOfTheOrganization_Female' value='".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Female"]."'>";
		$form .= "<input type='hidden' name='OtherAffiliations' value='".$_REQUEST["OtherAffiliations"]."'>";
		$form .= "<input type='hidden' name='PhysicalAddress' value='".$_REQUEST["PhysicalAddress"]."'>";
		$form .= "<input type='hidden' name='PostalAddress' value='".$_REQUEST["PostalAddress"]."'>";
		$form .= "<input type='hidden' name='OrgEmail' value='".$_REQUEST["OrgEmail"]."'>";
		$form .= "<input type='hidden' name='District' value='".$_REQUEST["District"]."'>";
		$form .= "<input type='hidden' name='Province' value='".$_REQUEST["Province"]."'>";
		$form .= "<input type='hidden' name='CoverageLevel' value='".$_REQUEST["CoverageLevel"]."'>";
		$form .= "<input type='hidden' name='CatchmentArea' value='".$_REQUEST["CatchmentArea"]."'>";
		echo $form;
			
		$selx = "SELECT * FROM _organization WHERE name = '".$_REQUEST["OrgName"]."';";
		@$rex = mysqli_query($db,$selx);
		@$numx = mysqli_num_rows($rex);
		@$rwb = mysqli_fetch_array($rex);
		$vCodex = $rwb["vCode"];

		if($numx<="0")
		{
			$sess_idX2 = rand(0, 999999999);
			$timexX2 = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60);
			$vCode = md5($timexX2." ".$sess_idX2."".$_REQUEST["OrgEmail"]."".$_REQUEST["OrgName"]);
		 
			$insert = "INSERT INTO _organization (id,vCode,name,MainProgramFocusArea,type,ThematicArea,PresenceOfABoardExecutiveCommittee,NumOfBoardMembersOnTheBoardExecutiveCommittee_Male,NumOfBoardMembersOnTheBoardExecutiveCommittee_Female,NumOfOrdinaryMembersOfTheOrganization_Male,NumOfOrdinaryMembersOfTheOrganization_Female,OtherAffiliations,postal,physical,tel,fax,email,website,District,Province,country,CoverageLevel,CatchmentArea,recordedby,Status) VALUES ('','".$vCode."','".$_REQUEST["OrgName"]."','".$_REQUEST["MainProgramFocusArea"]."','".$_REQUEST["OrgType"]."','".$_REQUEST["ThematicArea"]."','".$_REQUEST["PresenceOfABoardExecutiveCommittee"]."','".$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Male"]."','".$_REQUEST["NumOfBoardMembersOnTheBoardExecutiveCommittee_Female"]."','".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Male"]."','".$_REQUEST["NumOfOrdinaryMembersOfTheOrganization_Female"]."','".$_REQUEST["OtherAffiliations"]."','".$_REQUEST["PostalAddress"]."','".$_REQUEST["PhysicalAddress"]."','".$_REQUEST["tel"]."','".$_REQUEST["fax"]."','".$_REQUEST["OrgEmail"]."','".$_REQUEST["website"]."','".$_REQUEST["District"]."','".$_REQUEST["Province"]."','".$_REQUEST["country"]."','".$_REQUEST["CoverageLevel"]."','".$_REQUEST["CatchmentArea"]."','".$_REQUEST["recordedby"]."','Pending');";
			$res = mysqli_query($db,$insert);
			if($res)
			{	
			$select_cont = "SELECT * FROM _user_acnts WHERE org = '".$_REQUEST["OrgName"]."' AND Remarks = 'Contact Person';";
			$res_cnt = mysqli_query($db,$select_cont);
			@$rwcnt = mysqli_fetch_array($res_cnt);
			$FirstName = $rwcnt["FirstName"];
			$LastName = $rwcnt["LastName"];
			$cntEmail = $rwcnt["Email"];
			$cntMobile = $rwcnt["Mobile"];
			$FullNames = $FirstName." ".$LastName;
			
			$resultXv3 = mysqli_query($db,"INSERT INTO personnel (id,vCode,Position,FullNames,DOB,Gender,NRC,ResidentialAddress,Email,Phone,ID_URL,org,userID) VALUES ('','".$vCode."','','".$FullNames."','','','','','".$cntEmail."','".$cntMobile."','','".$_REQUEST["OrgName"]."','".$userID."');");
						
			echo "<p align='center'>Success! <a href='members.php?vCode=".$vCode."'>Click here to register the members of your organization.</a></p>";
			}
			else
			{
			echo "<p align='center'>Error!</p>";
			}
		}
		else
		{
		echo "<p align='center'>This Organization Name <i>'".$_REQUEST["OrgName"]."'</i>, has already been regisrered. Please go back and try another name <input type='submit' name='editbtn' value='Back'>, or <a href='members.php?vCode=".$vCodex."'>click here to register members of this organization.</a></p>";
		}
	echo "</form>";
	}
	
	mysqli_close($db);
 }
?>