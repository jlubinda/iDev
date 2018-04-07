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
		
		if(trim(strtoupper($_SESSION["userData"]["priv"]["type"]))=="ADMINISTRATOR" && trim(strtoupper($_SESSION["userData"]["priv"]["category"]))=="ADMINISTRATOR" && trim(strtoupper($_SESSION["userData"]["priv"]["limit"]))=="UNLIMITED")
		{
			return "Yes";
		}
		else
		{
			if(strtolower($perm)=="view")
			{
				return $_SESSION["userData"]["priv"]["view"];
			}
			elseif(strtolower($perm)=="insert")
			{
				return $_SESSION["userData"]["priv"]["insert"];
			}
			elseif(strtolower($perm)=="check")
			{
				return $_SESSION["userData"]["priv"]["check"];
			}
			elseif(strtolower($perm)=="delete")
			{
				return $_SESSION["userData"]["priv"]["delete"];
			}
			elseif(strtolower($perm)=="edit")
			{
				return $_SESSION["userData"]["priv"]["edit"];
			}
			elseif(strtolower($perm)=="list")
			{
				return $_SESSION["userData"]["priv"]["list"]; 
			}
			elseif(strtolower($perm)=="admin")
			{
				return $_SESSION["userData"]["priv"]["admin"];
			}
			elseif(strtolower($perm)=="setup")
			{
				return $_SESSION["userData"]["priv"]["setup"];
			}
		}
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