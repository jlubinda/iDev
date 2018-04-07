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
    $custom = trim($_POST['custom']);
    $custom2 = trim($_POST['custom2']);
	$userID = $custom;
	
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
	
	$file = file_put_contents($folder.'/'.$d.'.png', $data);
	
	if(file_exists($folder.'/'.$d.'.png'))
	{
		$data = array("imageurl"=>"https://vehicleportal.co.zm/test/images/".$image,"token"=>$custom2);
		$request = APPLODES_POST_REQUEST("apps/annime/add/vehicleImages/".$custom,$data);
		
		if(@$request["statuscode"]=="0000")
		{
			echo "Success!";
		}
		else
		{
			echo "Oops! There was a problem. Error Code:".$request["statuscode"].".";
		}
	}
	else
	{
		echo "Sorry! The images was not uploaded.";
	}
}
?>