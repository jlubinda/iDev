<?php

if(function_exists('priv'))
{
	
}
else
{
	function priv($levelv="CURRENT",$PageIDv="CURRENT",$typeIn=""){
		
		if($levelv=="CURRENT")
		{
			$userData = userData();
			
			$level = $userData["level"];
			
			//echo " ||| level: ".$userData["userID"];
		}
		else
		{
			$level = $levelv;
		}
		
		if($PageIDv=="CURRENT")
		{
			$PageID = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
		}
		else
		{
			$PageID = $PageIDv;
		}

		if($typeIn=="" || $typeIn=="PERMISSIONS")
		{
			return $_SESSION["userData"]["priv"];
		}
		elseif($typeIn=="LIMIT")
		{
			return $_SESSION["userData"]["limit"];
		}
		
	}
}
?>