<?php 
$appName = "blog";

$types = array('','.html','.php','.jsp','.asp'); //maximum of 10 types

$current = $_REQUEST["ref"];

$rType = array("APP","blog");

$return = 0;


$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'index','index.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'addPost','add_post.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'deletePost','delete_post.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'editPost','edit_post.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'listCategories','category_list.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'addCategory','add_category.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'deleteCategory','delete_category.php','file',$types);
$return = $return + router($rType,$GLOBALS[$appName."appAccessURL"],$current,'category','category.php','file',$types);
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