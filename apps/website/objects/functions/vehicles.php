<?php 

if(function_exists('cleanupData'))
{
	
}
else
{
	function cleanupData($data){
		
		$data1 = str_replace(" ","",$data);
		$data2 = str_replace("_","",$data1);
		$data3 = str_replace("-","",$data2);
		$data4 = str_replace(",","",$data3);
		$data5 = str_replace(".","",$data4);
		$data6 = str_replace("+","",$data5);
		
		return $data6;
	}
}
 

if(function_exists('listAllVehicles'))
{
	
}
else
{
	function listAllVehicles($orderBy,$owner="",$order="ASC",$min=0,$max=50){
		
		$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max,"owner"=>$owner);
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		
		if(isset($_SESSION["AllVehicles"]))
		{
			$resArr = array_diff(explode("|",$_SESSION["AllVehiclesSearchDetails"]), explode("|",$search_details));
			
			if($owner=="")
			{
				$ownerx = "ALL";
			}
			else
			{
				$ownerx = $owner;
			}
			
			$numCheck = APPLODES_POST_REQUEST("apps/annime/check/vehicleCount/".$ownerx,array(1,2));
			
			if($numCheck["data"]==$_SESSION["AllVehiclesCount"])
			{
				$resCount = count($resArr);
				//$resCount = 1;
			}
			else
			{
				$resCount = 1;
			}
		}
		else
		{
			$resCount = 1;
		}
		
		
		if(isset($_SESSION["AllVehicles"]) && $_SESSION["AllVehiclesMin"]<=$min && $_SESSION["AllVehiclesMax"]>=$max && $_SESSION["AllVehiclesScope"]==$scope && $resCount<=0)
		{
			//$vehicles["data"] = $_SESSION["AllVehicles"];
			//$vehicles["statuscode"] = "0000";
			//echo "test categories: ";
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
			
			$_SESSION["AllVehicles"] = $vehicles["data"];
			$_SESSION["AllVehiclesMin"] = $min;
			$_SESSION["AllVehiclesMax"] = $max;
			$_SESSION["AllVehiclesCount"] = $vehicles["count"];
			$_SESSION["AllVehiclesScope"] = $scope;
			$_SESSION["AllVehiclesSearchDetails"] = $search_details;
		}
		
		//echo "test categories: ";
		//print_r($vehicles);
		
		if(@$vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('listVPVehicleImages'))
{
	
}
else
{
	function listVPVehicleImages($refCode,$orderBy="",$order="ASC",$min=0,$max=50){
		
		$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max,"order"=>$order);
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		
		if(isset($_SESSION["vehicleImages"]))
		{
			$resArr = array_diff(explode("|",$_SESSION["vehicleImagesSearchDetails"]), explode("|",$search_details));
			
			if($owner=="")
			{
				$ownerx = "ALL";
			}
			else
			{
				$ownerx = $owner;
			}
			
			$numCheck = APPLODES_POST_REQUEST("apps/annime/check/vehicleCount/".$refCode,array(1,2));
			
			if($numCheck["data"]==$_SESSION["vehicleImagesCount"])
			{
				//$resCount = count($resArr);
				$resCount = 1;
			}
			else
			{
				$resCount = 1;
			}
		}
		else
		{
			$resCount = 1;
		}
		
		
		if(isset($_SESSION["vehicleImages"]) && $_SESSION["vehicleImagesMin"]<=$min && $_SESSION["vehicleImagesMax"]>=$max && $_SESSION["vehicleImagesScope"]==$scope && $resCount<=0)
		{
			//$vehicles["data"] = $_SESSION["vehicleImages"];
			//$vehicles["statuscode"] = "0000";
			//echo "test categories: ";
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicleImages/".$refCode,$data);
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicleImages/".$refCode,$data);
			
			$_SESSION["vehicleImages"] = $vehicles["data"];
			$_SESSION["vehicleImagesMin"] = $min;
			$_SESSION["vehicleImagesMax"] = $max;
			$_SESSION["vehicleImagesCount"] = $vehicles["count"];
			$_SESSION["vehicleImagesScope"] = $scope;
			$_SESSION["vehicleImagesSearchDetails"] = $search_details;
		}
		
		//echo "test categories: ";
		//print_r($vehicles);
		
		if(@$vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('listThirdPartyDues'))
{
	
}
else
{
	function listThirdPartyDues($orderBy,$order="ASC",$min=0,$max=50,$country){
		
		$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max,"country"=>$country);
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		
		if(isset($_SESSION["ThirdPartyDues"]))
		{
			$numCheck = APPLODES_POST_REQUEST("apps/annime/check/ThirdPartyDuesCount/ALL",array(1,2));
			
			if($numCheck["data"]==$_SESSION["ThirdPartyDuesCount"])
			{
				$resCount = 0;
			}
			else
			{
				$resCount = 1;
			}
		}
		else
		{
			$resCount = 1;
		}
		
		
		if(isset($_SESSION["ThirdPartyDues"]) && $_SESSION["ThirdPartyDuesMin"]<=$min && $_SESSION["ThirdPartyDuesMax"]>=$max && $resCount<=0)
		{
			$vehicles["data"] = $_SESSION["ThirdPartyDues"];
			$vehicles["statuscode"] = "0000";
			//echo "test categories: ";
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/ThirdPartyDues/".$order,$data);
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/ThirdPartyDues/".$order,$data);
			
			$_SESSION["ThirdPartyDues"] = $vehicles["data"];
			$_SESSION["ThirdPartyDuesMin"] = $min;
			$_SESSION["ThirdPartyDuesMax"] = $max;
			$_SESSION["ThirdPartyDuesCount"] = $vehicles["count"];
		}
		
		//echo "test categories: ";
		//print_r($vehicles);
		
		if(@$vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('listMostRecentVehicleHires'))
{
	
}
else
{
	function listMostRecentVehicleHires($vehicle,$orderBy,$order="ASC",$min=0,$max=50){
		
		$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max);
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		
		if(isset($_SESSION["mostRecentVehicleHires"]))
		{
			$numCheck = APPLODES_POST_REQUEST("apps/annime/check/mostRecentVehicleHires/".$vehicle,array(1,2));
			
			if($numCheck["data"]==$_SESSION["mostRecentVehicleHiresCount"])
			{
				$resCount = 0;
			}
			else
			{
				$resCount = 1;
			}
		}
		else
		{
			$resCount = 1;
		}
		
		
		if(isset($_SESSION["mostRecentVehicleHires"]) && $_SESSION["mostRecentVehicleHiresMin"]<=$min && $_SESSION["mostRecentVehicleHiresMax"]>=$max && $resCount<=0)
		{
			$vehicles["data"] = $_SESSION["mostRecentVehicleHires"];
			$vehicles["statuscode"] = "0000";
			//echo "test categories: ";
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/mostRecentVehicleHires/".$vehicle,$data);
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/mostRecentVehicleHires/".$vehicle,$data);
			
			$_SESSION["mostRecentVehicleHires"] = $vehicles["data"];
			$_SESSION["mostRecentVehicleHiresMin"] = $min;
			$_SESSION["mostRecentVehicleHiresMax"] = $max;
			$_SESSION["mostRecentVehicleHiresCount"] = $vehicles["count"];
		}
		
		//echo "test categories: ";
		//print_r($vehicles);
		
		if(@$vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('listVPAvailableVehicles'))
{
	
}
else
{
	function listVPAvailableVehicles($search_details,$scope,$orderBy,$order="ASC",$min=0,$max=50){
		
		//$url = "https://api.applodes.com/v1/C68C4586644CF8BFF84FDDB0C219FF4C/json/test/deployment/apps/annime/list/availableVPVehicles/".$order;
		$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max,"scope"=>$scope,"search_details"=>$search_details);
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/availableVPVehicles/".$order,$data);
		
		//echo "test vehicles: ";
		//print_r($vehicles);
		//$vehicles = httpPostJSON($url,$json);
		//echo $url;
		////print_r($json);
		
		if(isset($_SESSION["availableVPVehicles"]))
		{
			$resArr = array_diff(explode("|",$_SESSION["availableVPVehiclesSearchDetails"]), explode("|",$search_details));
			$resCount = count($resArr);
		}
		else
		{
			$resCount = 0;
		}
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		//echo "test categories: ";
		//print_r($vehicles);
		
		if(isset($_SESSION["availableVPVehicles"]) && $_SESSION["availableVPVehiclesMin"]<=$min && $_SESSION["availableVPVehiclesMax"]>=$max && $_SESSION["availableVPVehiclesScope"]==$scope && $resCount<=0)
		{
			//$vehicles["data"] = $_SESSION["availableVPVehicles"];
			//$vehicles["statuscode"] = "0000";
			//echo "test categories: ";
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/vehicles/".$order,$data);
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/availableVPVehicles/".$order,$data);
			
			$_SESSION["availableVPVehicles"] = $vehicles["data"];
			$_SESSION["availableVPVehiclesMin"] = $min;
			$_SESSION["availableVPVehiclesMax"] = $max;
			$_SESSION["availableVPVehiclesCount"] = $vehicles["count"];
			$_SESSION["availableVPVehiclesScope"] = $scope;
			$_SESSION["availableVPVehiclesSearchDetails"] = $search_details;
		}
		
		//print_r($vehicles);
		
		if(@$vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}


if(function_exists('addDiscounts'))
{
	
}
else
{
	function addDiscounts($catType,$discountType,$amount,$currency,$from,$to){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,data,syncstate,r_user,val2,val3,meta_data) VALUES ('','".$catType."','".$amount."','".$discountType."','".$currency."','ACTIVE','".strtotime($from)."','".strtotime($to)."','".md5("PORTAL VEHICLE DISCOUNT")."');";
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
 

if(function_exists('deactivateDiscount'))
{
	
}
else
{
	function deactivateDiscount($id){
		
		include find_file("cnct.php");
		
		$ins = "UPDATE meta set r_user = 'INACTIVE' WHERE id = '".$id."' AND meta_data = '".md5("PORTAL VEHICLE DISCOUNT")."';";
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
}
 

if(function_exists('activateDiscount'))
{
	
}
else
{
	function activateDiscount($id){
		
		include find_file("cnct.php");
		
		$ins = "UPDATE meta set r_user = 'ACTIVE' WHERE id = '".$id."' AND meta_data = '".md5("PORTAL VEHICLE DISCOUNT")."';";
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
}
 

if(function_exists('getDiscounts'))
{
	
}
else
{
	function getDiscounts($catType,$price,$currency,$validitydate="",$activity="ACTIVE"){
		
		include find_file("cnct.php");
		
		if($validitydate=="")
		{
			$now = time();
		}
		else
		{
			$now = strtotime($validitydate);
		}
		
		//echo $now."<br>";
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid like '".$catType."' AND r_user = '".strtoupper($activity)."' AND val2 < '".$now."' AND val3 > '".$now."' AND meta_data = '".md5("PORTAL VEHICLE DISCOUNT")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		$discount_type = $rw["data"];
		$currencyx = $rw["syncstate"];
		$from = $rw["val2"];
		$to = $rw["val3"];
		$status = $rw["r_user"];
		
		//echo $sel."<br>";
		
		if($currencyx=="ALL" || $currency==$currencyx)
		{
			if($discount_type=="PERCENTAGE")
			{
				$amount_off = ($price*$data)/100;
			}
			elseif($discount_type=="AMOUNT")
			{
				$amount_off = $data;
			}
		}
		else
		{
			$amount_off = 0;
		}
		$newprice = $price-$amount_off; 
		
		return array('amount_off'=>$amount_off,'newprice'=>$newprice,'currency'=>$currency,'discount'=>$data,'discount_type'=>$discount_type,'from'=>$from,'to'=>$to,'status'=>$status);
	}
}
 

if(function_exists('listDiscounts'))
{
	
}
else
{
	function listDiscounts($validitydate="",$activity="ACTIVE"){
		
		include find_file("cnct.php");
		
		if($validitydate=="")
		{
			$now = time();
		}
		else
		{
			$now = strtotime($validitydate);
		}
		
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE r_user = '".strtoupper($activity)."' AND val2 < '".$now."' AND val3 > '".$now."' AND meta_data = '".md5("PORTAL VEHICLE DISCOUNT")."' GROUP BY userid);";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		//echo $sel;
		
		for($a=0; $a<$num; $a++)
		{
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$numdata = $rw["numdata"];
		$discount_type = $rw["data"];
		$currency = $rw["syncstate"];
		$from = $rw["val2"];
		$to = $rw["val3"];
		$status = $rw["r_user"];
		
		$array[] = array('id'=>$id,'num'=>$num,'cattype'=>$userid,'amount'=>$numdata,'currency'=>$currency,'discount_type'=>$discount_type,'from'=>$from,'to'=>$to,'status'=>$status);
		}
		
		return $array;
	}
}
 

if(function_exists('addVehicleCategory'))
{
	
}
else
{
	function addVehicleCategory($name,$code,$example,$img="",$CatID="DEFAULT"){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,data,syncstate,r_user,org,meta_data) VALUES ('','".md5(trim($CatID))."','".trim($name)."','".trim($code)."','".mysqli_real_escape_string($db,trim($img))."','".trim($example)."','".md5("PORTAL VEHICLE CATEGORIES")."');";
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
}
 

if(function_exists('getVehicleCategory'))
{
	
}
else
{
	function getVehicleCategory($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES")."' AND id = '".trim($CatID)."' OR syncstate = '".trim($CatID)."');";
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		return $data;
	}
}
 

if(function_exists('getVehicleCategoryCode'))
{
	
}
else
{
	function getVehicleCategoryCode($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES")."' AND id = '".$CatID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["syncstate"];
		
		return $data;
	}
}
 

if(function_exists('getVehicleCategoryID'))
{
	
}
else
{
	function getVehicleCategoryID($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES")."' AND syncstate = '".$CatID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["syncstate"];
		
		return $id;
	}
}
 

if(function_exists('getVehicleCategoryExample'))
{
	
}
else
{
	function getVehicleCategoryExample($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES")."' AND syncstate = '".$CatID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$org = $rw["org"];
		$data = $rw["syncstate"];
		
		return $org;
	}
}
 

if(function_exists('addVehicleCategoryFuelType'))
{
	
}
else
{
	function addVehicleCategoryFuelType($CatID,$type){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,data,r_user,meta_data) VALUES ('','".md5($CatID)."','".$type."','".$CatID."','".md5("PORTAL VEHICLE CATEGORIES FUEL TYPE")."');";
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
}
 

if(function_exists('getVehicleCategoryFuelType'))
{
	
}
else
{
	function getVehicleCategoryFuelType($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES FUEL TYPE")."' AND r_user = '".$CatID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["data"];
		
		return $data;
	}
}
 

if(function_exists('addVehicleCategoryConsumpionRate'))
{
	
}
else
{
	function addVehicleCategoryConsumpionRate($CatID,$rate){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,r_user,meta_data) VALUES ('','".md5($CatID)."','".$rate."','".$CatID."','".md5("PORTAL VEHICLE CATEGORIES CONSUMPTION RATE")."');";
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
}
 

if(function_exists('getVehicleCategoryConsumpionRate'))
{
	
}
else
{
	function getVehicleCategoryConsumpionRate($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES CONSUMPTION RATE")."' AND r_user = '".$CatID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		
		return $data;
	}
}
 

if(function_exists('getVehicleCategoryImage'))
{
	
}
else
{
	function getVehicleCategoryImage($CatID){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES")."' AND id = '".$CatID."' OR syncstate = '".$CatID."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["r_user"];
		
		return $data;
	}
}
 

if(function_exists('viewVehicleCategory'))
{
	
}
else
{
	function viewVehicleCategory($CatCode){
		
		//$url = "https://api.applodes.com/v1/C68C4586644CF8BFF84FDDB0C219FF4C/json/test/deployment/apps/annime/view/VehicleTypes/".$CatCode;
		//$json = array("order_by"=>$orderBy,"limit_min"=>$min,"limit_max"=>$max,"status"=>$status,"onlinebookingstatus"=>$onlinebookingstatus);
		//$vehicles = httpGetJSON($url);
		//echo $url;
		////print_r($json);
		//$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max,"scope"=>$scope,"search_details"=>$search_details);
		
		if(isset($_SESSION["VehicleType:".$CatCode]))
		{
			$vehicles["statuscode"] = "0000";
			$vehicles["data"] = $_SESSION["VehicleType:".$CatCode];
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/view/VehicleTypes/".$CatCode);
		}
		//echo "test category: ";
		//print_r($vehicles);
		
		if($vehicles["statuscode"]=="0000")
		{
			if(!(isset($_SESSION["VehicleType:".$CatCode])))
			{
				$_SESSION["VehicleType:".$CatCode] = $vehicles["data"];
			}
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('listVehicleCategories'))
{
	
}
else
{
	function listVehicleCategories($CatID="",$max_price="",$orderBy="id",$order="ASC",$status="ACTIVE",$onlinebookingstatus="ALL",$min=0,$max=50){
		
		//$url = "https://api.applodes.com/v1/C68C4586644CF8BFF84FDDB0C219FF4C/json/test/deployment/apps/annime/list/VehicleTypes/".$order;
		//$json = array("order_by"=>$orderBy,"limit_min"=>$min,"limit_max"=>$max,"status"=>$status,"onlinebookingstatus"=>$onlinebookingstatus);
		//$vehicles = httpPostJSON($url,$json);
		//echo $url;
		////print_r($json);
		$data = array("order_by"=>$orderBy,"page"=>$min,"record_limit_per_page"=>$max,"scope"=>$scope,"search_details"=>$search_details);
		
		if(isset($_SESSION["VehicleTypes"]))
		{
			$resArr = array_diff(explode("|",$_SESSION["VehicleTypesSearchDetails"]), explode("|",$search_details));
			$resCount = count($resArr);
		}
		else
		{
			$resCount = 0;
		}
		
		//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/VehicleTypes/".$order,$data);
		//echo "test categories: ";
		//print_r($vehicles);
		
		if(isset($_SESSION["VehicleTypes"]) && $_SESSION["VehicleTypesMin"]<=$min && $_SESSION["VehicleTypesMax"]>=$max && $_SESSION["VehicleTypesScope"]==$scope && $resCount<=0)
		{
			$vehicles["data"] = $_SESSION["VehicleTypes"];
			$vehicles["statuscode"] = "0000";
			//echo "test categories: ";
			/*
			unset($_SESSION["VehicleTypes"]);
			unset($_SESSION["VehicleTypesMin"]);
			unset($_SESSION["VehicleTypesMax"]);
			unset($_SESSION["VehicleTypesCount"]);
			unset($_SESSION["VehicleTypesScope"]);
			unset($_SESSION["VehicleTypesSearchDetails"]);*/
			//$vehicles = APPLODES_POST_REQUEST("apps/annime/list/VehicleTypes/".$order,$data);
		}
		else
		{
			$vehicles = APPLODES_POST_REQUEST("apps/annime/list/VehicleTypes/".$order,$data);
			
			$_SESSION["VehicleTypes"] = $vehicles["data"];
			$_SESSION["VehicleTypesMin"] = $min;
			$_SESSION["VehicleTypesMax"] = $max;
			$_SESSION["VehicleTypesCount"] = $vehicles["count"];
			$_SESSION["VehicleTypesScope"] = $scope;
			$_SESSION["VehicleTypesSearchDetails"] = $search_details;
		}
		//echo "test category: ";
		//print_r($vehicles);
		
		if($vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
		
		if($vehicles["statuscode"]=="0000")
		{
			return $vehicles["data"];
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('deleteVehicleCategory'))
{
	
}
else
{
	function deleteVehicleCategory($CatID){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE id = '".$CatID."';";
		//echo $del;
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
 

if(function_exists('deleteVehicleCategories'))
{
	
}
else
{
	function deleteVehicleCategories($CatClass){
		
		include find_file("cnct.php");
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE CATEGORIES")."';";
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
 

if(function_exists('addCategoryPriceLocal'))
{
	
}
else
{
	function addCategoryPriceLocal($CatID,$price_within,$location){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,r_user) VALUES ('','".md5($CatID)."|".md5($location)."','".$price_within."','".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."','".$CatID."');";
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
}
 

if(function_exists('addCategoryPriceOOT'))
{
	
}
else
{
	function addCategoryPriceOOT($CatID,$price_out,$location){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,r_user) VALUES ('','".md5($CatID)."|".md5($location)."','".$price_out."','".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."','".$CatID."');";
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
}
 

if(function_exists('addCategoryPriceOOC'))
{
	
}
else
{
	function addCategoryPriceOOC($CatID,$price_out,$location){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,meta_data,r_user) VALUES ('','".md5($CatID)."|".md5($location)."','".$price_out."','".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF COUNTRY")."','".$CatID."');";
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
}
 

if(function_exists('addCategoryPrice'))
{
	
}
else
{
	function addCategoryPrice($CatID,$price_within,$price_out,$price_out_of_country,$location){
		
		include find_file("cnct.php");
		
		if(addCategoryPriceLocal($CatID,$price_within,$location)==1 && addCategoryPriceOOT($CatID,$price_out,$location)==1 && addCategoryPriceOOC($CatID,$price_out_of_country,$location)==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('getCategoryPrice'))
{
	
}
else
{
	function getCategoryPrice($CatID,$location="",$type="LOCAL",$incurrency="",$priceType="DISCOUNTED"){
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
			
			$curren = currentCurrency();
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
			
			$curren = $incurrency;
		}
		
		include find_file("cnct.php");
		
		if(strtoupper($type)=="WITHIN" || strtoupper($type)=="LOCAL")
		{
			if($location=="")
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' AND userid like '".md5($CatID)."|%');";
			}
			else
			{
				$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."' AND userid = '".md5($CatID)."|".md5($location)."');";
			}
		}
		else
		{
			if(strtoupper($type)=="OUT OF COUNTRY" || strtoupper($type)=="OOC")
			{
				if($location=="")
				{
					$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF COUNTRY")."' AND userid like '".md5($CatID)."|%');";
				}
				else
				{
					$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF COUNTRY")."' AND userid = '".md5($CatID)."|".md5($location)."');";
				}
			}
			else
			{
				if(strtoupper($type)=="OUT OF TOWN" || strtoupper($type)=="OOT")
				{
					if($location=="")
					{
						$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid like '".md5($CatID)."|%');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid = '".md5($CatID)."|".md5($location)."');";
					}
				}
				else
				{
					if($location=="")
					{
						$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid like '".md5($CatID)."|%');";
					}
					else
					{
						$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE numdata > '0' AND meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' AND userid = '".md5($CatID)."|".md5($location)."');";
					}
				}
			}
		}
		
		//echo $CatID."|||";
		//echo $sel." ||| ".$location." ||| ".md5($location)."<br>";
		
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		
		////echo "num: ".$num."<br>";
		
		if($num<=0)
		{
			return 0;
		}
		else
		{
			if($priceType=="ORIGINAL")
			{
				
			}
			else
			{
				$discountArray = getDiscounts($CatID,$data,$curren);
				
				return ($discountArray["newprice"]*$exchangeRate);
			}
		}
	}
}
 

if(function_exists('deleteCategoryPrice'))
{
	
}
else
{
	function deleteCategoryPrice($CatID,$location="",$type="LOCAL"){
		
		include find_file("cnct.php");
		
		if($location=="")
		{
			$del = "DELETE FROM meta WHERE (meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF COUNTRY")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."') AND userid like '".md5($CatID)."|%';";
		}
		else
		{
			$del = "DELETE FROM meta WHERE (meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF TOWN")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE OUT OF COUNTRY")."' || meta_data = '".md5("PORTAL VEHICLE CATEGORY PRICE LOCAL")."') AND userid = '".md5($CatID)."|".md5($location)."';";
		}
		
		
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
 

if(function_exists('addPumpPrice'))
{
	
}
else
{
	function addPumpPrice($fuelType,$amount){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,data,meta_data) VALUES ('','".$fuelType."','".$amount."','','".md5("PORTAL VEHICLE FUEL PUMP PRICE")."');";
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
}
 

if(function_exists('getPumpPrice'))
{
	
}
else
{
	function getPumpPrice($fuelType,$incurrency=""){
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
		}
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE userid like '".$fuelType."%' AND meta_data = '".md5("PORTAL VEHICLE FUEL PUMP PRICE")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$data = $rw["numdata"];
		
		return ($data*$exchangeRate);
	}
}
 

if(function_exists('listPumpPrices'))
{
	
}
else
{
	function listPumpPrices($incurrency=""){
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
		}
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE FUEL PUMP PRICE")."' GROUP BY userid);";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		for($a=0; $a<$num; $a++)
		{
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$numdata = $rw["numdata"];
		$data = $rw["data"];
		$xx = explode("|",$data);
		
		$array[] = array('id'=>$id,'num'=>$num,'fueltype'=>$userid,'amount'=>($numdata*$exchangeRate));
		}
		
		return $array;
	}
}
 

if(function_exists('addBusFare'))
{
	
}
else
{
	function addBusFare($tocity,$fromcity,$amount){
		
		include find_file("cnct.php");
		
		$vCode = uniqueCode();
		
		$ins = "INSERT INTO meta (id,userid,numdata,data,meta_data,syncstate) VALUES ('','".uniqueCode()."','".$amount."','".$tocity."|".$fromcity."','".md5("PORTAL VEHICLE BUS FARE")."','".$vCode."');";
		$res = mysqli_query($db,$ins);
		
		if($res)
		{
			
			$selx = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE (syncstate = '".$vCode."') AND meta_data = '".md5("PORTAL VEHICLE BUS FARE")."');";
			$resx = mysqli_query($db,$selx);
			@$rwx = mysqli_fetch_array($resx);
			$id = $rwx["id"];
			
			return $id;
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('addLodgingBudget'))
{
	
}
else
{
	function addLodgingBudget($tocity,$fromcity,$amount){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,data,meta_data) VALUES ('','".md5($vid)."','".$amount."','".$tocity."|".$fromcity."','".md5("PORTAL VEHICLE LODGING BUDGET")."');";
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
}
 

if(function_exists('addFoodBudget'))
{
	
}
else
{
	function addFoodBudget($tocity,$fromcity,$amount){
		
		include find_file("cnct.php");
		
		$ins = "INSERT INTO meta (id,userid,numdata,data,meta_data) VALUES ('','".md5($vid)."','".$amount."','".$tocity."|".$fromcity."','".md5("PORTAL VEHICLE FOOD BUDGET")."');";
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
}
 

if(function_exists('getLodgingBudget'))
{
	
}
else
{
	function getLodgingBudget($tocity,$fromcity,$incurrency=""){
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
		}
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE (data = '".$fromcity."|".$tocity."' OR data = '".$tocity."|".$fromcity."') AND meta_data = '".md5("PORTAL VEHICLE LODGING BUDGET")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num>=1)
		{			
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["numdata"];
			return ($data*$exchangeRate);
		}
		else
		{
			return 0;
		}
	}
}
 

if(function_exists('getFoodBudget'))
{
	
}
else
{
	function getFoodBudget($tocity,$fromcity,$incurrency=""){
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
		}
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE (data = '".$fromcity."|".$tocity."' OR data = '".$tocity."|".$fromcity."') AND meta_data = '".md5("PORTAL VEHICLE FOOD BUDGET")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($num>=1)
		{			
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["numdata"];
			return ($data*$exchangeRate);
		}
		else
		{
			return 0;
		}
		
	}
}
 

if(function_exists('getBusFare'))
{
	
}
else
{
	function getBusFare($tocity,$fromcity,$incurrency=""){
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id = (SELECT max(id) FROM meta WHERE (data = '".$fromcity."|".$tocity."' OR data = '".$tocity."|".$fromcity."') AND meta_data = '".md5("PORTAL VEHICLE BUS FARE")."');";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
		}
		
		
		//echo $sel;
		
		if($num>=1)
		{			
			@$rw = mysqli_fetch_array($res);
			$id = $rw["id"];
			$userid = $rw["userid"];
			$data = $rw["numdata"];
			
			return (($data*$exchangeRate)+getLodgingBudget($tocity,$fromcity)+getFoodBudget($tocity,$fromcity));
		}
		else
		{
			return getLodgingBudget($tocity,$fromcity)+getFoodBudget($tocity,$fromcity);
		}
	}
}
 

if(function_exists('listBusFares'))
{
	
}
else
{
	function listBusFares($incurrency=""){
		
		if($incurrency=="")
		{
			if(currentCurrency()=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency(currentCurrency(),"CURRENCY CODES","RATE");
			}
		}
		else
		{
			if($incurrency=="USD")
			{
				$exchangeRate = 1;
			}
			else
			{
				$exchangeRate = currency($incurrency,"CURRENCY CODES","RATE");
			}
		}
		
		include find_file("cnct.php");
		
		$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("PORTAL VEHICLE BUS FARE")."' GROUP BY data);";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		for($a=0; $a<$num; $a++)
		{
		@$rw = mysqli_fetch_array($res);
		$id = $rw["id"];
		$userid = $rw["userid"];
		$numdata = $rw["numdata"];
		$data = $rw["data"];
		$xx = explode("|",$data);
		$meta_data = $rw["meta_data"];
		
		////echo "meta_data: ".$meta_data;
		$array[] = array('num'=>$num,'id'=>$id,'from'=>$xx[0],'to'=>$xx[1],'amount'=>($numdata*$exchangeRate),'lodging'=>getLodgingBudget($xx[1],$xx[0]),'food'=>getFoodBudget($xx[1],$xx[0]));
		}
		
		return $array;
	}
}
?>