<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('zlib.output_compression', 'On'); 
ini_set('zlib.output_compression_level', '1'); 

date_default_timezone_set("Africa/Lusaka");

include "config.php";
include "sess.php";
include "core.php";
include "apps.php";

idAccess("VARS");
idAccess("SESSION");
idAccess("FUNCTIONS");
//idAccess("REDIRECT");
//idAccess("ORG FILTER");
idAccess("PRIV");
//idAccess("UI");				

if(isset($_POST['imagebase64'])){
    $data = $_POST['imagebase64'];
    $name = $_POST['name'];
    $userIDx = trim($_POST['custom']);
	$userID = $userIDx;
	
	$folder = "images";

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);
	
	if(!(trim(strtolower($name))=="rand") && !(trim($name)==""))
	{
		$d=$name;
	}
	else
	{
		$d=md5(mt_rand(1,999998)."_".$userID."_".strtotime(date("Y-m-d H:i:s"))."_".$folder."_".mt_rand(999999,99999999));
	}
	
	$image = $d.'.png';
	
	if(addCoverImage($userID,$image)==1)
	{
		$file = file_put_contents($folder.'/'.$d.'.png', $data);
		echo "Success!";
	}
	else
	{
		echo "Error! Your cover photo could not be updated. Please try again later.";
	}
}
?>