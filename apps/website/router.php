<?php 

$appName = "website";

$types = array('','.html','.php','.jsp','.asp'); //maximum of 10 types

$current = $_REQUEST["ref"];

$rType = array("APP","website");

$return = 0;

//echo "<br><br>appAccessURL test: ".$_REQUEST["appAccessURL"]."<br>";

$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'index','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'vehicles','vehicles.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'howitworks','howitworks.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'environment','enviroment.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'careers','jobs.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'benefits','benefits.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'privacy','privacy.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'aboutus','about.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'terms','terms.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'contactus','contact.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'faqs','faqs.php','file',$types,"faqs");
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'checkout','checkout','function',$types,"fgf");
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'logout','logout','function',$types,"fgf");


if($return==0)
{
	$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,$current,'pages','function',$types,$_REQUEST["ref"],$_REQUEST["extn"]);
	
	if($return==0)
	{
		$GLOBALS["THEME"] = $GLOBALS["THEME"];
	}
	else
	{
		$GLOBALS["THEME"] = $GLOBALS["THEME"]+1;
	}
}
else
{
	$GLOBALS["THEME"] = $GLOBALS["THEME"];
}

?>