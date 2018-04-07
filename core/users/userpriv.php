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

		include find_file("cnct.php");

		$perm_query3 = "SELECT * FROM refer_users_types WHERE UserTypeCode = '".$level."';";
		//echo $perm_query3;
		$res_perm3 = mysqli_query($db,$perm_query3);
		$rows_perm3 = mysqli_fetch_array($res_perm3);
		$UserTypeNamezz = $rows_perm3["UserTypeName"];
		$UserTypeCategoryzz = $rows_perm3["UserTypeCategory"];
		$LimitedTozz = $rows_perm3["LimitedTo"];
		$Roamingzz = $rows_perm3["Roaming"];
					   

		if($LimitedTozz == "Unlimited")
		{
		@$org_limiter = "";
		@$org_limiter2 = "";
		@$org_limiter3 = "";
		@$org_limiter4 = "";
		@$org_limiter5 = "";
		@$org_limiter6 = "";
		}
		elseif($LimitedTozz == "Country")
		{
		@$org_limiter = "AND (country = '".$orgCountryz."')";
		@$org_limiter2 = "(country = '".$orgCountryz."')";
		@$org_limiter3 = "(Country = '".$orgCountryz."')";
		@$org_limiter4 = "(country = '".$orgCountryz."')";
		@$org_limiter5 = "(UserTypeCode = '3') OR (UserTypeCode = '-3')";
		@$org_limiter6 = "(Code = '".$orgCountryz."')";
		}
		elseif($LimitedTozz == "User`s Organization")
		{
		@$org_limiter = " AND (org = '".$org."') AND (country = '".$orgCountryz."')";
		@$org_limiter2 = "(org = '".$org."') AND (country = '".$orgCountryz."')";
		@$org_limiter3 = "(org = '".$org."') AND (Country = '".$orgCountryz."')";
		@$org_limiter4 = "(id = '".$org."') AND (country = '".$orgCountryz."')";
		@$org_limiter5 = "(UserTypeCode = '3')";
		@$org_limiter6 = "(Code = '".$orgCountryz."')";
		}
		elseif($LimitedTozz == "User`s Branch Only")
		{
		@$org_limiter = " AND (org = '".$org."')";
		@$org_limiter2 = "(org = '".$org."')";
		@$org_limiter3 = "(org = '".$org."')";
		@$org_limiter4 = "(id = '".$org."')";
		@$org_limiter5 = "(UserTypeCode = '3')";
		@$org_limiter6 = "";
		}
		else
		{
		@$org_limiter = " AND (org = 'NIL') AND (country = 'NIL')";
		@$org_limiter2 = "(org = 'NIL') AND (country = 'NIL')";
		@$org_limiter3 = "(org = 'NIL') AND (Country = 'NIL')";
		@$org_limiter4 = "(org = 'NIL') AND (Country = 'NIL')";
		@$org_limiter5 = "(UserTypeCode = 'NIL')";
		@$org_limiter6 = "(Code = 'NIL')";
		}

		include find_file("cnct.php");

		$perm_query = "SELECT * FROM sys_permissions WHERE id = (SELECT max(id) as maxID FROM sys_permissions WHERE PageID = '".$PageID."' AND UserTypeID = '".$level."');";
		$res_perm = mysqli_query($db,$perm_query);
		@$rows_perm = mysqli_fetch_array($res_perm);
		$view_permissions = $rows_perm["view_permissions"];
		$insert_permissions = $rows_perm["insert_permissions"];
		$delete_permissions = $rows_perm["delete_permissions"];
		$edit_permissions = $rows_perm["edit_permissions"];
		$list_permissions = $rows_perm["list_permissions"];
		$setup_permissions = $rows_perm["setup_permissions"];
		
		if($typeIn=="" || $typeIn=="PERMISSIONS")
		{
			$array = array('type'=>$UserTypeNamezz,'category'=>$UserTypeCategoryzz,'limit'=>$LimitedTozz,'view'=>$view_permissions,'insert'=>$insert_permissions,'delete'=>$delete_permissions,'edit'=>$edit_permissions,'list'=>$list_permissions,'setup'=>$setup_permissions);
			return $array;
		}
		elseif($typeIn=="LIMIT")
		{
			$array = array('type'=>$UserTypeNamezz,'category'=>$UserTypeCategoryzz,'limit'=>$LimitedTozz,'limiter1'=>$org_limiter,'limiter2'=>$org_limiter2,'limiter3'=>$org_limiter3,'limiter4'=>$org_limiter4,'limiter5'=>$org_limiter5,'limiter6'=>$org_limiter6);
			return $array;
		}
		
		/*
		$priv = priv($level,$PageID,"PERMISSIONS");
		$priv['view']
		$priv['insert']
		$priv['delete']
		$priv['edit']
		$priv['list']
		$priv['setup']
		
		$priv = priv($level,$PageID,"PERMISSIONS");
		$priv['limiter1']
		$priv['limiter2']
		$priv['limiter3']
		$priv['limiter4']
		$priv['limiter5']
		$priv['limiter6']
		*/
		
		mysqli_close($db);
	}
}
?>