<?php 

$types = array('','.html','.php','.jsp','.asp'); //maximum of 10 types

$current = $_REQUEST["ref"];

$rType = array("APP","wiki");

$return = 0;

//echo "<br><br>appAccessURL test: ".$GLOBALS["appAccessURL"]."<br>";

$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'','index.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'index','index.php','file',$types);/*
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'replacement','replacement.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'testimonial','testimonial.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'aboutus','about.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'help','help.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'list','agentcreateaccount.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'longtermshortterm','longtermshortterm.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'accessories','accessories.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'enviroment','enviroment.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'jobs','jobs.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'contactus','contact.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'faqsreplacement','faqsreplacement.php','file',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'faqs','support','function',$types,"faqs");
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,iDevSite("STORE URL"),'uagroStore','function',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,iDevSite("DASHBOARD URL"),'uagroDashboard','function',$types);
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'faqs','support','function',$types,"faqs");
$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'news','blog.php','function',$types);
//$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,'profile','dashboard.php','file',$types);
//$return = $return + router($rType,$GLOBALS["appAccessURL"],$current,$current,'pages','function',$types,$_REQUEST["ref"],$_REQUEST["extn"]);
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