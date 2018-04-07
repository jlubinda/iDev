<?php		
if(chkSes()=="Active")
{				
	if($Roamingzz=="Yes" && $LimitedTozz == "Unlimited")
	{
	$org_filter = "funx=".$_REQUEST["funx"]."&CID=".$_REQUEST["CID"]."&ID=".$_REQUEST["ID"]."&ORGNAME=".$_REQUEST["ORGNAME"]."&BID=".$_REQUEST["BID"]."&BRNCNAME=".$_REQUEST["BRNCNAME"];
	}
	elseif($Roamingzz=="Yes" && $LimitedTozz == "Country")
	{
	$_REQUEST["CID"] = $userCountry;
	$org_filter = "funx=".$_REQUEST["funx"]."&CID=".$userCountry."&ID=".$_REQUEST["ID"]."&ORGNAME=".$_REQUEST["ORGNAME"]."&BID=".$_REQUEST["BID"]."&BRNCNAME=".$_REQUEST["BRNCNAME"];
	}
	elseif($Roamingzz=="Yes" && $LimitedTozz == "User`s Organization")
	{
	$_REQUEST["CID"] = $userCountry;
	$_REQUEST["ID"] = $org;
	$_REQUEST["ORGNAME"] = $orgNamez;
	
	$org_filter = "funx=".$_REQUEST["funx"]."&CID=".$userCountry."&ID=".$org."&ORGNAME=".$orgNamez."&BID=".$_REQUEST["BID"]."&BRNCNAME=".$_REQUEST["BRNCNAME"];
	}
}
?>