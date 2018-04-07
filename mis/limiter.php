<?php
 if(chkSes()=="Active")
{
		
	if($Roamingzz=="Yes" && $LimitedTozz == "Unlimited")
	{
		if($_REQUEST["ID"] && $_REQUEST["CID"])
		{
		$limiter = " (org = '".$_REQUEST["ID"]."') AND (country = '".$_REQUEST["CID"]."')";
		}
		elseif(!$_REQUEST["ID"] && $_REQUEST["CID"])
		{
		$limiter = " (org = '".$org."') AND (country = '".$_REQUEST["CID"]."')";
		}
		else
		{
		$limiter = " (org = '".$org."') AND (country = '".$userCountry."')";
		}
	}
	elseif($Roamingzz=="Yes" && $LimitedTozz == "Country")
	{
		if($_REQUEST["ID"])
		{
		$limiter = " (org = '".$_REQUEST["ID"]."') AND (country = '".$userCountry."')";
		}
		else
		{
		$limiter = " (org = '".$org."') AND (country = '".$userCountry."')";
		}
	}
	else
	{
	$limiter = " (org = '".$org."') AND (country = '".$userCountry."')";
	}
	
}
?>