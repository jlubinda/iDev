<?php
////SELECT THE COUNTRY///////////////////////////////////////////////////////////
if($Roamingzz=="Yes")
{
	echo "<div style='position: relative; width:100%; float: left; margin-bottom: 5px; background-color: #dfdfdf; padding-left: 8px; padding-right: 8px;'>";
	
	if($LimitedTozz == "Unlimited")
	{
		if(!$_REQUEST["CID"])
		{
		$country_queryQ = "SELECT * FROM refer_countries;";
		$res_countryQ = mysqli_query($db,$country_queryQ);
		@$coun_numQ = mysqli_num_rows($res_countryQ);
			
			for($a=0; $a<$coun_numQ; $a++)
			{
				$rows_countryQ = mysqli_fetch_array($res_countryQ);
				$CID = $rows_countryQ["Code"];
				$CcountryName = $rows_countryQ["Name"];
				$CountryDescription = $rows_countryQ["Description"];
				$CountryCorridor = $rows_countryQ["Corridor"];
				$CountryHasRatifiedTheBondScheme = $rows_countryQ["HasRatifiedTheBondScheme"];
				$CountryCustomsSystemInUse = $rows_countryQ["CustomsSystemInUse"];
				$CountryNationalBureauQ = $rows_countryQ["NationalSurety"];

				$orgSelz2Q = "SELECT * FROM _organization WHERE id = '".$CountryNationalBureauQ."';";
				$orgResz2Q = mysqli_query($db,$orgSelz2Q);
				$rowOrgz2Q = mysqli_fetch_array($orgResz2Q);
				$orgvCodezQ = $rowOrgz2Q["vCode"];
				$NB = $rowOrgz2Q["name"];

				if($_REQUEST["ref"]=="1" && ($_REQUEST["segment"]=="d1" || $_REQUEST["segment"]=="b1" || $_REQUEST["segment"]=="a1"))
				{
					echo "<div style='float: left; padding: 4px; margin-right: 10px; margin-bottom: 5px;'><a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&funx=".$_REQUEST["funx"]."&CID=".$CID."&ID=".$CountryNationalBureauQ."&ORGNAME=".$NB."'>".$CID."</a></div>";
				}
				else
				{
					echo "<div style='float: left; padding: 4px; margin-right: 10px; margin-bottom: 5px;'><a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&funx=".$_REQUEST["funx"]."&CID=".$CID."'>".$CID."</a></div>";
				}
			}
		}
	}
	else
	{
	$CID = $userCountry;
	$CcountryName = $CountryName;
	$NB = $CountryNationalBureau_Name;
	}
	////SELECT THE COUNTRY///////////////////////////////////////////////////////////
	
	
	if($LimitedTozz == "Country" || $LimitedTozz == "Unlimited")
	{
		if(!($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="d1" && $_REQUEST["function"]=="add"))
		{
		////SELECT THE ORGANIZATION///////////////////////////////////////////////////////////
			if(!$_REQUEST["ID"] && $_REQUEST["CID"])
			{
				echo "<br>";
				$select_ORG = "SELECT * FROM _organization WHERE country = '".$_REQUEST["CID"]."';";
				$rez = mysqli_query($db,$select_ORG);
				$numz = mysqli_num_rows($rez);
				for($a=0; $a<$numz; $a++)
				{
				$rw = mysqli_fetch_array($rez);
				$org_idX = $rw["id"];
				$org_nameZ = $rw["name"];
				$org_typeX = $rw["type"];
				$org_postalX = $rw["postal"];
				$org_physicalX = $rw["physical"];
				$org_telX = $rw["tel"];
				$org_faxX = $rw["fax"];
				$org_emailX = $rw["email"];
				$org_countryX = $rw["country"];
				$org_recordedbyX = $rw["recordedby"];
				$org_StatusX = $rw["Status"];
				echo "<div style='float: left; padding: 4px; margin-right: 10px; margin-bottom: 5px;'><a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&funx=".$_REQUEST["funx"]."&CID=".$_REQUEST["CID"]."&ID=".$org_idX."&ORGNAME=".$org_nameZ."'>".$org_nameZ."</a></div>";
				}
			}
		////SELECT THE ORGANIZATION///////////////////////////////////////////////////////////
		}
	}
	else
	{
	$ID = $org;
	$OrgName = $orgNamez;
	$NB = $CountryNationalBureau_Name;
	}
	
	$select_ORGc = "SELECT * FROM _organization WHERE id = '".$_REQUEST["ID"]."';";
	$rezc = mysqli_query($db,$select_ORGc);
	$numzc = mysqli_num_rows($rezc);
	$rwc = mysqli_fetch_array($rezc);
	$org_idX = $rwc["id"];
	$has_branch_X = $rwc["has_branches"];
	
	if(!($_REQUEST["ref"]=="1" && $_REQUEST["segment"]=="d1" && $_REQUEST["function"]=="add") && $has_branch_X=="Yes")
	{
	////SELECT THE BRANCH///////////////////////////////////////////////////////////
		if($_REQUEST["ID"] && $_REQUEST["CID"] && !$_REQUEST["BID"])
		{
			echo "<br>";
			$select_ORG = "SELECT * FROM _org_branches WHERE org_id = '".$_REQUEST["ID"]."';";
			$rez = mysqli_query($db,$select_ORG);
			@$numz = mysqli_num_rows($rez);
			for($a=0; $a<$numz; $a++)
			{
			$rw = mysqli_fetch_array($rez);
			$brnch_idX = $rw["id"];
			$brnch_nameZ = $rw["name"];
			$brnch_typeX = $rw["type"];
			$brnch_postalX = $rw["postal"];
			$brnch_physicalX = $rw["physical"];
			$brnch_telX = $rw["tel"];
			$brnch_faxX = $rw["fax"];
			$brnch_emailX = $rw["email"];
			$brnch_countryX = $rw["country"];
			$brnch_recordedbyX = $rw["recordedby"];
			$brnch_StatusX = $rw["Status"];
			echo "<div style='float: left; padding: 4px; margin-right: 10px; margin-bottom: 5px;'><a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."&funx=".$_REQUEST["funx"]."&CID=".$_REQUEST["CID"]."&ID=".$_REQUEST["ID"]."&ORGNAME=".$_REQUEST["ORGNAME"]."&BID=".$brnch_idX."&BRNCNAME=".$brnch_nameZ."'>".$brnch_nameZ."</a></div>";
			}
		}
	////SELECT THE BRANCH///////////////////////////////////////////////////////////
	}
	echo "<div style='float:right;'><a href='?ref=".$_REQUEST["ref"]."&segment=".$_REQUEST["segment"]."&function=".$_REQUEST["function"]."&unit=".$_REQUEST["unit"]."'>Rest Filter</a></div></div>";
}
?>