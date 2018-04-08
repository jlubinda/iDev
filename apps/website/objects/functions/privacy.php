<?php 

if(function_exists("addPrivacyStatement"))
{
	
}
else
{
	function addPrivacyStatement($value,$type=""){
		
		include_once "cnct.php";
		
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
}

if(function_exists("deletePrivacyStatement"))
{
	
}
else
{
	function deletePrivacyStatement($type){
		
		include_once "cnct.php";
		
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
}

if(function_exists("viewPrivacyStatement"))
{
	
}
else
{
	function viewPrivacyStatement($type){
		
		include_once "cnct.php";
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PRIVACY STATEMENT")."' AND (userid = '".md5($type)."' OR id = '".$type."'));";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		return stripslashes($data);
	}
}

if(function_exists("getPrivacy"))
{
	
}
else
{
	function getPrivacy($type=""){
		
		include_once "cnct.php";
		
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
}
?>