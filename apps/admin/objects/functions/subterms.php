<?php 

function addSubTerms($value,$type="TERMS"){
	
	include "cnct.php";
	
	$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($type)."','".$value."','".md5("SUB TERMS STATEMENT")."');";
	$res = mysqli_query($db,$ins);
	
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function listSubTerms($class=""){
	
	include "cnct.php";
	
	if($class=="")
	{
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("SUB TERMS STATEMENT")."';";
	}
	else
	{
		$sel = "SELECT * FROM meta WHERE meta_data = '".md5("SUB TERMS STATEMENT")."' AND userid = '".md5($class)."';";
	}
	
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	for($a=0; $a<$num; $a++)
	{
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		$array[] = array('num'=>$num,'id'=>$id,'image'=>$data);
	}
	
	return $array;
	
}


function deleteSubTerms($type){
	
	include "cnct.php";
	
	$del = "DELETE FROM meta WHERE meta_data = '".md5("SUB TERMS STATEMENT")."' AND (userid = '".md5($type)."' OR id = '".$type."') ;";
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


function getSubTerms($type=""){
	
	include "cnct.php";
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("SUB TERMS STATEMENT")."');";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$userid = $rw["userid"];
	$data = $rw["data"];
	
	if($type=="" || $type=="VIEW")
	{
		return $data;
	}
	elseif($type=="ID")
	{
		return $id;
	}
}


function acceptVehicleOwnerTerms($userID,$TermsVersion="CURRENT"){
	
	if($TermsVersion=="CURRENT")
	{
		$terms = getSubTerms("ID");
	}
	else
	{
		$terms = $TermsVersion;
	}
	
	include "cnct.php";
	
	$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".md5($userID)."','".$terms."','".md5("ACCEPT VEHICLE OWNER TERMS")."');";
	$res = mysqli_query($db,$ins);
	
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function checkAcceptVehicleOwnerTerms($userID,$TermsVersion="CURRENT"){
	
	if($TermsVersion=="CURRENT")
	{
		$terms = getSubTerms("ID");
	}
	else
	{
		$terms = $TermsVersion;
	}
	
	include "cnct.php";
	
	$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("ACCEPT VEHICLE OWNER TERMS")."' AND data = '".$terms."' AND userid = '".md5($userID)."');";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	if($num>=1)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
?>