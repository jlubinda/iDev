<?php
 if(chkSes()=="Active")
{
$online = "SELECT * FROM online WHERE _sessid = '".$SesVar."';";
$online_res = mysqli_query($db,$online);
$row_online = mysqli_fetch_array($online_res);
$uid = $row_online["_idcry"];


$session_query = "SELECT * FROM _user_acnts WHERE userID = '".$uid."' AND (Active = '1' OR Active = 'Yes');";
$sess_res = mysqli_query($db,$session_query);
$row_sess = mysqli_fetch_array($sess_res);
$userID = $row_sess["userID"];
$UserCode = $row_sess["UserCode"];
$org = $row_sess["org"];
$Branch = $row_sess["Branch"];
$Email = $row_sess["Email"];
$LoginName = $row_sess["LoginName"];
$FirstName = $row_sess["FirstName"];
$LastName = $row_sess["LastName"];
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

			
			$statxAct = "SELECT * FROM _user_acntsx WHERE id = (select max(id) as maxID from _user_acntsx where userID = '".$userID."');";
			@$restatxAct = mysqli_query($db,$statxAct);
			@$rwstatxAct = mysqli_fetch_array($restatxAct);
			$Active = $rwstatxAct["Active"];
			$userLevel = $rwstatxAct["level"];
			$level = $rwstatxAct["level"];
			$iDevTools_level = $rwstatxAct["level"];
	

$orgSelz = "SELECT * FROM _organization WHERE id = '".$org."';";
$orgResz = mysqli_query($db,$orgSelz);
$rowOrgz = mysqli_fetch_array($orgResz);
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
//$orgStatusz = $rowOrgz["Status"];

			
			$statx = "SELECT * FROM _bx_organization WHERE id = (select max(id) as maxID from _bx_organization where org_id = '".$org."');";
			@$restatx = mysqli_query($db,$statx);
			@$rwstatx = mysqli_fetch_array($restatx);
			$orgStatusz = $rwstatx["Status"];

			
		$stax = "SELECT * FROM idev WHERE id = (SELECT max(id) AS maxID FROM idev WHERE UserGroup = '".$userLevel."');";
		@$resstx = mysqli_query($db,$stax);
		@$nmstx = mysqli_num_rows($resstx);
		@$rwstx = mysqli_fetch_array($resstx);
		$Statusx = $rwstx["Status"];
		$Reasonx = $rwstx["Reason"];
		
if($orgStatusz=="Approved" && ($Active=="Yes" || $Active=="1") && $Statusx=="Enabled")
{

	$currency_query = "SELECT * FROM refer_currencies WHERE Country = '".$orgCountryz."';";
	$res_currency = mysqli_query($db,$currency_query);
	$rows_currency = mysqli_fetch_array($res_currency);
	$userCurrencyCode = $rows_currency["Code"];
	$userCurrencySymbol = $rows_currency["CurrencySymbol"];
	$userCurrencyName = $rows_currency["CurrencyName"];

$maxExch = "SELECT * FROM _exchange_rates WHERE id = (SELECT max(id) as maxID FROM _exchange_rates WHERE Country = '".$orgCountryz."');";
$resMaxExch = mysqli_query($db,$maxExch);
@$rwMaxExch = mysqli_fetch_array($resMaxExch);
$exchang_rate = $rwMaxExch["Amount"];
$exchang_DateSet = $rwMaxExch["DateSet"];


if($has_branchez=="Yes" && $Branch)
{
$brnch_sel = "SELECT * FROM _org_branches WHERE id = '".$Branch."';";
$resBrnch = mysqli_query($db,$brnch_sel);
$rwBrnch = mysqli_fetch_array($resBrnch);
$BrnchIDz = $rwBrnch["id"];
$BrnchNamez = $rwBrnch["name"];
$BrnchPostalz = $rwBrnch["postal"];
$BrnchPhysicalz = $rwBrnch["physical"];
$BrnchTelz = $rwBrnch["tel"];
$BrnchFaxz = $rwBrnch["fax"];
$BrnchEmailz = $rwBrnch["email"];
$BrnchIT_Adminz = $rwBrnch["it_admin"];
$BrnchBranch_Managerz = $rwBrnch["branch_manager"];
$BrnchRecordedbyz = $rwBrnch["recordedby"];
}


$selClass = "SELECT * FROM _org_types WHERE id = (SELECT max(id) as maxID FROM _org_types WHERE Code = '".$orgTypez."');";
$resClass = mysqli_query($db,$selClass);
$rowClass = mysqli_fetch_array($resClass);
$classID = $rowClass["id"];
$classCode = $rowClass["Code"];
$className = $rowClass["Name"];
$classDescription = $rowClass["Description"];
$classMisc = $rowClass["Misc"];



$country_query = "SELECT * FROM refer_countries WHERE Code = '".$orgCountryz."';";
$res_country = mysqli_query($db,$country_query);
$rows_country = mysqli_fetch_array($res_country);
$Code = $rows_country["Code"];
$CountryName = $rows_country["Name"];
$CountryDescription = $rows_country["Description"];
$CountryCorridor = $rows_country["Corridor"];
$CountryHasRatifiedTheBondScheme = $rows_country["HasRatifiedTheBondScheme"];
$CountryCustomsSystemInUse = $rows_country["CustomsSystemInUse"];
$CountryNationalBureau = $rows_country["NationalSurety"];

$orgSelz2 = "SELECT * FROM _organization WHERE id = '".$CountryNationalBureau."';";
$orgResz2 = mysqli_query($db,$orgSelz2);
$rowOrgz2 = mysqli_fetch_array($orgResz2);
$orgvCodez = $rowOrgz2["vCode"];
$CountryNationalBureau_Name = $rowOrgz2["name"];


$perm_query = "SELECT * FROM _bx_sys_permissions WHERE id = (SELECT max(id) as maxID FROM _bx_sys_permissions WHERE PageID = '".$PageID."' AND UserTypeID = '".$iDevTools_level."');";
$res_perm = mysqli_query($db,$perm_query);
$rows_perm = mysqli_fetch_array($res_perm);
$bx_permissions = $rows_perm["permissions"];


$perm_query3 = "SELECT * FROM _bx_refer_users_types WHERE UserTypeCode = '".$iDevTools_level."';";
$res_perm3 = mysqli_query($db,$perm_query3);
$rows_perm3 = mysqli_fetch_array($res_perm3);
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


$printer_data = "SELECT * FROM _printers WHERE status = 'Activate';";
@$res_printer_data = mysqli_query($db,$printer_data);
@$rw_printer_data = mysqli_fetch_array($res_printer_data);
$printer_name_data = $rw_printer_data["printer_name"];				
$printer_address_data = $rw_printer_data["printer_address"];				
$contact_person_name_data = $rw_printer_data["contact_person_name"];				
$contact_person_mobile_data = $rw_printer_data["contact_person_mobile"];				
$contact_person_email_data = $rw_printer_data["contact_person_email"];				 
}
}
?>