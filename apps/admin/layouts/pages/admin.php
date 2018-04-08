<?php 

	$refx = explode("/",$_REQUEST["ref"]);
	$ref = $refx[1];
	
	if($ref=="createvehiclecategory.php" || $ref=="createvehiclecategory")
	{	
		include_once "layout/adminoptions/addcategory.php";
	}
	elseif($ref=="vehicleinspection.php" || $ref=="vehicleinspection")
	{	
		include_once "layout/adminoptions/vehicleinspection.php";
	}
	elseif($ref=="addtown.php" || $ref=="addtown")
	{	
		include_once "layout/adminoptions/addtown.php";
	}
	elseif($ref=="addcountry.php" || $ref=="addcountry")
	{	
		include_once "layout/adminoptions/addcountry.php";
	}
	elseif($ref=="addcontinent.php" || $ref=="addcontinent")
	{	
		include_once "layout/adminoptions/addcontinent.php";
	}
	elseif($ref=="addcommissions.php" || $ref=="addcommissions")
	{	
		include_once "layout/adminoptions/addcommissions.php";
	}
	elseif($ref=="addprices.php" || $ref=="addprices")
	{	
		include_once "layout/adminoptions/addprices.php";
	}
	elseif($ref=="news.php" || $ref=="news")
	{	
		include_once "layout/adminoptions/news.php";
	}
	elseif($ref=="jobs.php" || $ref=="jobs")
	{	
		include_once "layout/adminoptions/jobs.php";
	}
	elseif($ref=="privacy.php" || $ref=="privacy")
	{	
		include_once "layout/adminoptions/privacy.php";
	}
	elseif($ref=="terms.php" || $ref=="terms")
	{	
		include_once "layout/adminoptions/terms.php";
	}
	elseif($ref=="subterms.php" || $ref=="subterms")
	{	
		include_once "layout/adminoptions/subterms.php";
	}
	elseif($ref=="driverrate.php" || $ref=="driverrate")
	{	
		include_once "layout/adminoptions/driverrate.php";
	}
	elseif($ref=="mileage.php" || $ref=="mileage")
	{	
		include_once "layout/adminoptions/mileage.php";
	}
	elseif($ref=="onewayrenatalfee.php" || $ref=="onewayrenatalfee")
	{	
		include_once "layout/adminoptions/onewayrenatalfee.php";
	}
	elseif($ref=="busfares.php")
	{
		include_once "layout/adminoptions/busfares.php";
	}
	elseif($ref=="pumpprices.php")
	{
		include_once "layout/adminoptions/pumpprices.php";
	}
	

?>