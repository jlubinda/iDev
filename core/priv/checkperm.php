<?php

if(function_exists('checkPerm'))
{
	
}
else
{
	function checkPerm($PageIDv="CURRENT",$levelv,$perm="View"){
		
		if($levelv=="CURRENT")
		{
			$userData = userData();
			
			$level = $userData["level"];
		}
		else
		{
			$level = $levelv;
		}
		
		if($PageIDv=="CURRENT")
		{
			$PageIDc = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
		}
		else
		{
			$PageIDc = $PageIDv;
		}
		
		include find_file("cnct.php");
		//include find_file("mis/priv.php");
		
		$sel = "SELECT id,UserTypeID,PageID,view_permissions,insert_permissions,delete_permissions,edit_permissions,list_permissions,setup_permissions,COUNT(id) AS resCount FROM sys_permissions WHERE id = (SELECT max(id) AS maxID FROM sys_permissions WHERE PageID ='".$PageIDc."' AND UserTypeID = '".$level."');";
		//echo $sel;
		@$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$row = mysqli_fetch_array($res);
		$unitID = $row["id"];
		$UserTypeID = $row["UserTypeID"];
		$PageIDc = $row["PageID"];
		$view_permissionsc = $row["view_permissions"];
		$insert_permissionsc = $row["insert_permissions"];
		$delete_permissionsc = $row["delete_permissions"];
		$edit_permissionsc = $row["edit_permissions"];
		$list_permissionsc = $row["list_permissions"];
		$setup_permissionsc = $row["setup_permissions"];
		$resCount = $row["resCount"];
		
		$priv = priv($level);
		
		if(trim(strtoupper($priv["type"]))=="ADMINISTRATOR" && trim(strtoupper($priv["category"]))=="ADMINISTRATOR" && trim(strtoupper($priv["limit"]))=="UNLIMITED")
		{
			return "Yes";
		}
		else
		{
			if(strtolower($perm)=="view")
			{
				return $view_permissionsc;
			}
			elseif(strtolower($perm)=="insert")
			{
				return $insert_permissionsc;
			}
			elseif(strtolower($perm)=="delete")
			{
				return $delete_permissionsc;
			}
			elseif(strtolower($perm)=="edit")
			{
				return $edit_permissionsc;
			}
			elseif(strtolower($perm)=="list")
			{
				return $list_permissionsc; 
			}
			elseif(strtolower($perm)=="setup")
			{
				return $setup_permissionsc;
			}
		}
		
		mysqli_close($db);
	}
}
 

if(function_exists('perm'))
{
	
}
else
{
	function perm($b,$c,$d,$e,$f,$g){
		$a = $_REQUEST["function"];
		
		if($a=="view" || $a=="")
		{
		return $b;
		}
		elseif($a=="add" || $a=="insert")
		{
		return $c;
		}
		elseif($a=="delete")
		{
		return $d;
		}
		elseif($a=="edit" || $a=="update")
		{
		return $e;
		}
		elseif($a=="list")
		{
		return $f;
		}
		elseif($a=="setup")
		{
		return $g;
		}
	}
}
 

if(function_exists('permissions'))
{
	
}
else
{
	function permissions($a){
		return $_REQUEST[$a];
	}
}
?>