<?php 

$appName = "profile";

$types = array('','.html','.php','.jsp','.asp'); //maximum of 10 types

$current = $_REQUEST["ref"];

$rType = array("APP-EXCLUSIVE","profile");

$return = 0;

$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'','dashboard/profile/your_profile.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'index','dashboard/profile/your_profile.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'edit_profile','dashboard/profile/edit_profile.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'profile_picture','dashboard/profile/profile_picture.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'password_change','dashboard/profile/password_change.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'cover_image','dashboard/profile/cover_image.php','file',$types);

$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'yourcompanies','dashboard/yourcompanies/home.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'edit_company','dashboard/yourcompanies/edit.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'companiesinfocenter','dashboard/yourcompanies/infocenter.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'company_logo','dashboard/yourcompanies/logo.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'company_cover_image','dashboard/yourcompanies/cover.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'company_settings','dashboard/yourcompanies/settings.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'company_satus','dashboard/yourcompanies/status.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'add_company','dashboard/yourcompanies/join.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'join_company','dashboard/yourcompanies/addpersonnel.php','file',$types);

$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'test1','dashboard/yourSampleSection/index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'test2','dashboard/yourSampleSection/test2.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'test3','dashboard/yourSampleSection/test3.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'test4','dashboard/yourSampleSection/test4.php','file',$types);

if($return==0)
{
	$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,$current,'pages','function',$types,$_REQUEST["ref"],$_REQUEST["extn"]);
}
else
{
	$return = $return;
}

?>
