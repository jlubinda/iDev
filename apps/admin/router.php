<?php 
$appName = "myadmin";

$types = array('','.html','.php','.jsp','.asp'); //maximum of 10 types

$current = $_REQUEST["ref"];

$rType = array("APP","admin");

$return = 0;

$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'index','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'createvehiclecategory','adminoptions/addcategory.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'vehicleinspection','adminoptions/vehicleinspection.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'addtown','adminoptions/addtown.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'addcountry','adminoptions/addcountry.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'addcontinent','adminoptions/addcontinent.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'currencies','adminoptions/currencies.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'addprices','adminoptions/addprices.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'news','adminoptions/news.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'jobs','adminoptions/jobs.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'privacy','adminoptions/privacy.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'terms','adminoptions/terms.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'subterms','adminoptions/subterms.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'driverrate','adminoptions/driverrate.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'mileage','adminoptions/mileage.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'onewayrenatalfee','adminoptions/onewayrenatalfee.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'busfares','adminoptions/busfares.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'pumpprices','adminoptions/pumpprices.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'provinces','adminoptions/province.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'consuptionrate','adminoptions/addCagetoryConsuptionRate.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'discounts','adminoptions/discounts.php','file',$types);

if($return==0)
{
	$GLOBALS["THEME"] = $GLOBALS["THEME"]+1;
}
else
{
	$GLOBALS["THEME"] = $GLOBALS["THEME"];
}

?>