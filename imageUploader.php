<?php

//error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
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
idAccess("ORG FILTER");
idAccess("PRIV");
//idAccess("UI");		

if(isset($_POST['imagebase64'])){
    $data = $_POST['imagebase64'];
    $name = $_POST['name'];
	
	if(trim($_POST['folder'])=="" || trim($_POST['folder'])=="default")
	{
		$folder = "images";
	}
	else
	{
		$folder = $_POST['folder'];
	}

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);

    $data = base64_decode($data);
	if(!(trim(strtolower($name))=="rand"))
	{
		$d=$name;
	}
	else
	{
		$d=md5(mt_rand(1,999998)."_".strtotime(date("Y-m-d H:i:s"))."_".mt_rand(999999,99999999));
	}
     echo json_encode(file_put_contents($folder.'/'.$d.'.png', $data));
}
?>