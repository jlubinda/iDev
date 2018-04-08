<?php 

function addPrivacyStatement($value,$type=""){
	
	include "cnct.php";
	
	$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($type)."','".addslashes($value)."','".md5("PRIVACY STATEMENT")."');";
	$res = mysqli_query($db,$ins);
	//echo $ins;
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function deletePrivacyStatement($type){
	
	include "cnct.php";
	
	$del = "DELETE FROM meta WHERE meta_data = '".md5("PRIVACY STATEMENT")."' AND (userid = '".md5($type)."' OR id = '".$type."');";
	$res = mysqli_query($db,$del);
	
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function viewPrivacyStatement($type){
	
	include "cnct.php";
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PRIVACY STATEMENT")."' AND (userid = '".md5($type)."' OR id = '".$type."'));";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$userid = $rw["userid"];
	$data = $rw["data"];
	
	return stripslashes($data);
}


function getPrivacy($type=""){
	
	include "cnct.php";
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PRIVACY STATEMENT")."');";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$userid = $rw["userid"];
	$data = $rw["data"];
	
	if($type=="" || $type=="VIEW")
	{
		return stripslashes($data);
	}
	elseif($type=="ID")
	{
		return $id;
	}
}
?>