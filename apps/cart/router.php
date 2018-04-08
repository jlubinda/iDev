<?php 
$appName = "cart";

$types = array('','.html','.php','.jsp','.asp'); //maximum of 10 types

$current = $_REQUEST["ref"];

$rType = array("APP-EXCLUSIVE","cart");

$return = 0;

$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'index','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'back','back.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'finish','finish.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'add','cart.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'viewcart','retrieveCartItems.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'book','booknow.php','file',$types);
/*
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'longtermshortterm','longtermshortterm.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'accessories','accessories.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'enviroment','enviroment.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'jobs','jobs.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'contactus','contact.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'faqsreplacement','faqsreplacement.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'faqs','support','function',$types,"faqs");
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,iDevSite("STORE URL"),'uagroStore','function',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,iDevSite("DASHBOARD URL"),'uagroDashboard','function',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'faqs','support','function',$types,"faqs");
//$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'news','blog.php','function',$types);
//$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'profile','dashboard.php','file',$types);
//$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,$current,'pages','function',$types,$_REQUEST["ref"],$_REQUEST["extn"]);
//echo "<br><br>router test: ".$router."<br>";
*/

if($return==0)
{
	$GLOBALS["THEME"] = $GLOBALS["THEME"]+1;
}
else
{
	$GLOBALS["THEME"] = $GLOBALS["THEME"];
}

?>