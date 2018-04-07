<?php
if(function_exists('chkSes'))
{
	
	if(chkSes()=="Active")
	{
	$SesVar = SesVar();

	include find_file("cnct.php");

	$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
	//echo $online."<br>";
	@$online_res = mysqli_query($db,$online);
	@$row_online = mysqli_fetch_array($online_res);
	$uid = $row_online["_idcry"];


	$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (Active = '1' OR Active = 'Yes');";
	@$sess_res = mysqli_query($db,$session_query);
	@$num_sess = mysqli_num_rows($sess_res);
	@$row_sess = mysqli_fetch_array($sess_res);
	$userID = $row_sess["userID"];
	$AccountType = $row_sess["AccountType"];
	$UserCode = $row_sess["UserCode"];
	$org = $row_sess["org"];
	$Branch = $row_sess["Branch"];
	$Email = $row_sess["Email"];
	$LoginName = $row_sess["LoginName"];
	$FirstName = $row_sess["FirstName"];
	$LastName = $row_sess["LastName"];
	$NickName = $row_sess["NickName"];
	$_idxZx = $row_sess["Password"];
	$Address = $row_sess["Address"];
	$Postal = $row_sess["Postal"];
	$Fax = $row_sess["Fax"];
	$Telephone = $row_sess["Telephone"];
	$Active = $row_sess["Active"];
	$RecordEnteredBy = $row_sess["RecordEnteredBy"];
	$Remarks = $row_sess["Remarks"];
	$level = $row_sess["level"];
	$userLevel = $row_sess["level"];
	$userCountry = $row_sess["Country"];

	if($num_sess>="1"){
	}

	$propictext = "Profile Pic";
	$proq = "SELECT * FROM meta WHERE id = (SELECT max(id) AS maxID FROM meta WHERE userid = '".$userID."' AND meta_data = '".md5($propictext)."');";
	@$respro = mysqli_query($db,$proq);
	@$prow = mysqli_fetch_array($respro);
	$ProfilePic = $prow["data"];	
		

	$orgSelz = "SELECT * FROM _organization WHERE id = '".$org."';";
	@$orgResz = mysqli_query($db,$orgSelz);
	@$rowOrgz = mysqli_fetch_array($orgResz);
	$orgIDz = $rowOrgz["id"];
	$orgvCodez = $rowOrgz["vCode"];
	$orgNamez = $rowOrgz["name"];
	$has_branchez = $rowOrgz["has_branches"];
	$orgTypez = $rowOrgz["type"];
	$orgPostalz = $rowOrgz["postal"];
	$orgPhysicalz = $rowOrgz["physical"];
	$orgTelz = $rowOrgz["tel"];
	$orgFaxz = $rowOrgz["fax"];
	$orgEmailz = $rowOrgz["email"];
	$orgWebsitez = $rowOrgz["website"];
	$orgCountryz = $rowOrgz["country"];
	$orgRecordedbyz = $rowOrgz["recordedby"];
	$orgStatusz = $rowOrgz["Status"];

		$perm_query3 = "SELECT * FROM refer_users_types WHERE UserTypeCode = '".$level."';";
		@$res_perm3 = mysqli_query($db,$perm_query3);
		@$rows_perm3 = mysqli_fetch_array($res_perm3);
		$UserTypeNamezz = $rows_perm3["UserTypeName"];
		$UserTypeCategoryzz = $rows_perm3["UserTypeCategory"];
		$LimitedTozz = $rows_perm3["LimitedTo"];
		$Roamingzz = $rows_perm3["Roaming"];
					   

		if($LimitedTozz == "Unlimited")
		{
		@$org_limiter = "";
		@$org_limiter2 = "";
		@$org_limiter3 = "";
		@$org_limiter4 = "";
		@$org_limiter5 = "";
		@$org_limiter6 = "";
		}
		elseif($LimitedTozz == "Country")
		{
		@$org_limiter = "AND (country = '".$orgCountryz."')";
		@$org_limiter2 = "(country = '".$orgCountryz."')";
		@$org_limiter3 = "(Country = '".$orgCountryz."')";
		@$org_limiter4 = "(country = '".$orgCountryz."')";
		@$org_limiter5 = "(UserTypeCode = '3') OR (UserTypeCode = '-3')";
		@$org_limiter6 = "(Code = '".$orgCountryz."')";
		}
		elseif($LimitedTozz == "User`s Organization")
		{
		@$org_limiter = " AND (org = '".$org."') AND (country = '".$orgCountryz."')";
		@$org_limiter2 = "(org = '".$org."') AND (country = '".$orgCountryz."')";
		@$org_limiter3 = "(org = '".$org."') AND (Country = '".$orgCountryz."')";
		@$org_limiter4 = "(id = '".$org."') AND (country = '".$orgCountryz."')";
		@$org_limiter5 = "(UserTypeCode = '3')";
		@$org_limiter6 = "(Code = '".$orgCountryz."')";
		}
		elseif($LimitedTozz == "User`s Branch Only")
		{
		@$org_limiter = " AND (org = '".$org."')";
		@$org_limiter2 = "(org = '".$org."')";
		@$org_limiter3 = "(org = '".$org."')";
		@$org_limiter4 = "(id = '".$org."')";
		@$org_limiter5 = "(UserTypeCode = '3')";
		@$org_limiter6 = "";
		}
		else
		{
		@$org_limiter = " AND (org = 'NIL') AND (country = 'NIL')";
		@$org_limiter2 = "(org = 'NIL') AND (country = 'NIL')";
		@$org_limiter3 = "(org = 'NIL') AND (Country = 'NIL')";
		@$org_limiter4 = "(org = 'NIL') AND (Country = 'NIL')";
		@$org_limiter5 = "(UserTypeCode = 'NIL')";
		@$org_limiter6 = "(Code = 'NIL')";
		}


		$perm_query = "SELECT * FROM sys_permissions WHERE id = (SELECT max(id) as maxID FROM sys_permissions WHERE PageID = '".$PageID."' AND UserTypeID = '".$level."');";
		@$res_perm = mysqli_query($db,$perm_query);
		@$rows_perm = mysqli_fetch_array($res_perm);
		$view_permissions = $rows_perm["view_permissions"];
		$insert_permissions = $rows_perm["insert_permissions"];
		$delete_permissions = $rows_perm["delete_permissions"];
		$edit_permissions = $rows_perm["edit_permissions"];
		$list_permissions = $rows_perm["list_permissions"];
		$setup_permissions = $rows_perm["setup_permissions"];
		

		if($orgStatusz=="Approved" && ($Active=="Yes" || $Active=="1"))
		{
		$selClass = "SELECT * FROM _org_types WHERE id =(SELECT max(id) as maxID FROM _org_types WHERE Code = '".$orgTypez."');";
		@$resClass = mysqli_query($db,$selClass);
		@$rowClass = mysqli_fetch_array($resClass);
		$classID = $rowClass["id"];
		$classCode = $rowClass["Code"];
		$className = $rowClass["Name"];
		$classDescription = $rowClass["Description"];
		$classMisc = $rowClass["Misc"];


		$orgSelz2 = "SELECT * FROM _organization WHERE id = '".$CountryNationalBureau."';";
		@$orgResz2 = mysqli_query($db,$orgSelz2);
		@$rowOrgz2 = mysqli_fetch_array($orgResz2);
		$orgvCodez = $rowOrgz2["vCode"];
		$CountryNationalBureau_Name = $rowOrgz2["name"];				 
		}
		mysqli_close($db);
	}
}

?>