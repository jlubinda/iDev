<?php 


function addFeesSchedule($min,$max,$float,$servicecharge,$order){
	

include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO meta (id,userid,data,numdata,meta_data) VALUES ('','','".$min."|".$max."|".$float."|".$servicecharge."','".$order."','".md5("UAGRO FEES SCHEDULE")."');";
	$res = mysql_query($ins);
	
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}


function getFeesSchedule(){
	
	$response = array();
	
	// include db connect class

include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("UAGRO FEES SCHEDULE")."' GROUP BY numdata) ORDER BY numdata ASC";
	$result = mysql_query($sel) or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$response["fees"] = array();
		
		while ($row = mysql_fetch_array($result)) 
		{
			// temp user array
			$ex = explode("|",$row["data"]);
			
			$categories = array();
			$categories["id"] = $row["id"];
			$categories["min"] = $ex[0];
			$categories["max"] = $ex[1];
			$categories["float"] = $ex[2];
			$categories["servicecharge"] = $ex[3];
			
		
			// push single product into final response array
			array_push($response["fees"], $categories);
		}
		// success
		$response["success"] = 1;
		
		return $response;
	}
	else 
	{
		// no products found
		$response["success"] = 0;
		$response["message"] = "No fees schedule items found";
		
		return $response;
	}
	
	mysql_close($db);
}


function getFeesScheduleList(){
	
	// include db connect class

include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("UAGRO FEES SCHEDULE")."' GROUP BY numdata) ORDER BY numdata ASC";
	$result = mysql_query($sel) or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		$num = mysql_num_rows($result);
		// looping through all results
		// products node
		
		while ($row = mysql_fetch_array($result))
		{
			// temp user array
			$ex = explode("|",$row["data"]);
			// push single product into final response array
			$array[] = array("num"=>$num,"id"=>$row["id"],"min"=>$ex[0],"max"=>$ex[1],"float"=>$ex[2],"servicecharge"=>$ex[3]);
		}
		// success
		
		return $array;
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}


function getServiceCharge($amount,$type=""){
		

include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$sel = "SELECT * FROM meta WHERE id IN (SELECT max(id) FROM meta WHERE meta_data = '".md5("UAGRO FEES SCHEDULE")."' GROUP BY numdata) ORDER BY numdata ASC";
	$result = mysql_query($sel) or die(mysql_error());
	
	if (mysql_num_rows($result) > 0) 
	{
		
		$minx = 0;
		$maxx = 0;
		$floatx = 0;
		$servicechargex = 0;
		$idx = 0;
		$max_y = 0;
		
		@$num = mysql_num_rows($result);
		
		for ($a; $a<$num; $a++)
		{
			$row = mysql_fetch_array($result);
			// temp user array
			$ex = explode("|",$row["data"]);
			$xy = $row["numdata"];
			
			$id = $row["id"];
			$min = $ex[0];
			$max = $ex[1];
			$float = $ex[2];
			$servicecharge = $ex[3];
			
			if(($num-1)==$a)
			{
				$max_y = $max;
			}
		
			if($amount>=$min && $amount<$max)
			{
				$minx = $min;
				$maxx = $max;
				$floatx = $float;
				$servicechargex = $servicecharge;
				$idx = $id;
				
			}
		}
		
		if($amount>$max_y)
		{
			$servicechargex = (5/100)*$amount;
			$floatx = (5/100)*$amount;
		}
		else
		{
			$servicechargex = $servicechargex;
			$floatx = $floatx;
		}
	
		if($type=="")
		{
			return $servicechargex;
		}
		elseif(strtoupper($type)=="SERVICE CHARGE")
		{
			return $servicechargex;
		}
		elseif(strtoupper($type)=="ABSOLUTE MAX")
		{
			return $max_y;
		}
		elseif(strtoupper($type)=="MIN")
		{
			return $minx;
		}
		elseif(strtoupper($type)=="MAX")
		{
			return $maxx;
		}
		elseif(strtoupper($type)=="FLOAT")
		{
			return $floatx;
		}
		elseif(strtoupper($type)=="ID")
		{
			return $idx;
		}
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}


function getUniversalMinDeliveryAmount($userIDv,$productID=""){
		
	$_REQUEST["cnct"] = "cnct_uagro.php";
	$result = getMeta("UNIVERSAL MINIMUM DELIVERY AMOUNT","=|(SELECT max(id) FROM meta WHERE meta_data = '".md5("UNIVERSAL MINIMUM DELIVERY AMOUNT")."' AND userid = '".$userIDv."')","=|'".$userIDv,"'","","","","",",max(numdata) AS misc1");

	return $result[0]['numdata'];
}



function getMinDeliveryAmount($userIDv,$productID=""){
		
	
	$_REQUEST["cnct"] = "cnct_uagro.php";
	$result = getMeta("PRODUCT MINIMUM DELIVERY AMOUNT","=|(SELECT max(id) FROM meta WHERE meta_data = '".md5("PRODUCT MINIMUM DELIVERY AMOUNT")."' AND userid = '".$userIDv."' AND data = '".$productID."')","=|'".$userIDv,"'","","","","",",max(numdata) AS misc1");

	return $result[0]['numdata'];
}


function checkUserHasShop($userID){
	return checkAccount("STORE",$userID);
}



function checkOrgHasShop($vCode){

	return checkOrgAccount("STORE",$vCode);
}



function totalValueOnSale($userID,$productID=""){
	
	$customer = userID($userID);
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE TOTAL","","=|'".$customer."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE TOTAL","","=|'".$customer."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}



function totalQuantityOnSale($userID,$productID=""){
	
	$customer = userID($userID);
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE","","=|'".$customer."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE","","=|'".$customer."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}


function totalValueSold($userID,$productID=""){
	
	$customer = userID($userID);
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED TOTAL","","=|'".$customer."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED TOTAL","","=|'".$customer."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}



function totalQuantitySold($userID,$productID=""){
	
	$customer = userID($userID);
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED","","=|'".$customer."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED","","=|'".$customer."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}


function currentQuantityOnSale($userID,$productID=""){
	$qty = totalQuantityOnSale($userID,$productID)-totalQuantitySold($userID,$productID);
	return $qty;
}


function totalOrgValueOnSale($vCode,$productID=""){
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE TOTAL","","=|'".$vCode."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE TOTAL","","=|'".$vCode."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}



function totalOrgQuantityOnSale($vCode,$productID=""){
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE","","=|'".$vCode."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT LISTED FOR SALE","","=|'".$vCode."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}



function totalOrgValueSold($vCode,$productID=""){
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED TOTAL","","=|'".$vCode."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED TOTAL","","=|'".$vCode."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}


function totalOrgQuantitySold($vCode,$productID=""){
	
	if($productID=="")
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED","","=|'".$vCode."'","","","","","",",SUM(numdata) AS misc1");
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$result = getMeta("PRODUCT PURCHASED","","=|'".$vCode."'","=|'".$productID."'","","","","",",SUM(numdata) AS misc1");
	}

	return $result[0]['misc1'];
}


function currentOrgQuantityOnSale($vCode,$productID=""){
	$qty = totalOrgQuantityOnSale($vCode,$productID)-totalOrgQuantitySold($vCode,$productID);
	return $qty;
}


function addProductForSale($userIDv,$PID,$unitPrice,$quantity,$unit,$transporter,$image,$minDeliveryAmountx=""){
	
	if($minDeliveryAmountx=="")
	{
		$minDeliveryAmount = getUniversalMinDeliveryAmount($userIDv);
	}
	else
	{
		$minDeliveryAmount = $minDeliveryAmountx;
	}
	
    $customer = userID($userIDv);
	$customerFullNames = getNames($userIDv,"FULL");
	
	$minFloat = getServiceCharge(($unitPrice*$quantity),"FLOAT");

	$customerArray = userDetails($customer);
	$customerBalance = accountBalance($customer);
	
	$serviceChargeCommission = serviceChargeCommission(getServiceCharge(($unitPrice*$quantity),"SERVICE CHARGE"));
	
	if($customerBalance>=$serviceChargeCommission)
	{
		if(debit($customer,getServiceCharge(($unitPrice*$quantity),"SERVICE CHARGE"),"AGENT SERVICE CHARGE",$customer,"")==1)
		{
			$transact = 1;
		}
		else
		{
			$transact = 0;
		}
	}
	else
	{
		$transact = 2;
	}
	
	
	if($transact==1)
	{
		$r_user = uniqueCode();
		
		sendSMS($transporter,"You have been selected to transport goods for ".$customerFullNames.". Be on standby.");
		
		$productname = "";
		$totalPrice = 0;
				
		if(!($PID==""))
		{
			$totalPrice = $totalPrice+($quantity*$unitPrice);
			$productname .= $quantity." ".getUnit($unit,"NAME")." of ".getProduct($PID,"NAME").", ";
			$_REQUEST["cnct"] = "cnct_uagro.php";
			$meta1 = addMeta("PRODUCT LISTED FOR SALE",$customer,$PID,$quantity,$unitPrice,$r_user,"");
			$meta2 = addMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS",standadizesMobile($transporter),$PID,$minDeliveryAmount,$unit,$r_user,"");
			$meta3 = addMeta("AGENT LIST PRODUCT FOR SALE TRANSACTION",$customer,$PID."|".$unit."|".$quantity."|".$unitPrice."|".(getServiceCharge(($unitPrice*$quantity),"SERVICE CHARGE"))."|".(getServiceCharge(($unitPrice*$quantity),"FLOAT"))."|".($unitPrice*$quantity),($unitPrice*$quantity),$customer,$r_user,"");
			$meta4 = addMeta("PRODUCT LISTED FOR SALE - IMAGE",$PID,$image,"",$customer,$r_user,"");
			$meta5 = addMeta("PRODUCT LISTED FOR SALE TOTAL",$customer,$PID,($quantity*$unitPrice),$quantity,$r_user,"");
		}
	}
	
	$customerName = $customerArray["FirstName"];

	$response["success"] = $transact;
	  
    // check if row inserted or not       $_REQUEST[""] 
    if($transact==1) 
	{
	$customerBalance2 = accountBalance($customer);
	  // successfully inserted into database
	  $response["balance"] = $customerBalance2;
	  
	  $response["message"] =  "Congratulations ".getNames($customer,"FIRST")."! You have successfully listed ".$productname.", valued at ".$totalPrice.". Your account balance is now K".number_format($customerBalance2,2);		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==0)
	{
	  // successfully inserted into database
		  $response["message"] =  "Sorry ".getNames($customer,"FIRST").". Transaction was aborted. Please try again later.";		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==2)
	{
	  // successfully inserted into database
		  $response["message"] =  "Sorry ".getNames($customer,"FIRST").". You have insufficient balance. Please top up and try again.";		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==3)
	{
	  // successfully inserted into database
		  $response["message"] =  "Sorry ".getNames($customer,"FIRST").". Transaction was not authorized. Please try again later.";		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==4)
	{
	  // successfully inserted into database
		  $response["message"] =  "Congratulations ".getNames($customer,"FIRST").". Transaction successful.";		
	  // echoing JSON response
	  return ($response);
	}
}


function addOrgProductForSale($vCode,$PID,$unitPrice,$quantity,$unit,$transporter,$image,$minDeliveryAmountx=""){
	
	if($minDeliveryAmountx=="")
	{
		$minDeliveryAmount = getUniversalMinDeliveryAmount($userIDv);
	}
	else
	{
		$minDeliveryAmount = $minDeliveryAmountx;
	}
	
	$minFloat = getServiceCharge(($unitPrice*$quantity),"FLOAT");

	$customerArray = orgData($vCode);//
	$customerBalance = accountBalance($vCode);
	
	$serviceChargeCommission = serviceChargeCommission(getServiceCharge(($unitPrice*$quantity),"SERVICE CHARGE"));
	
	if($customerBalance>=$serviceChargeCommission)
	{
		if(debit($vCode,getServiceCharge(($unitPrice*$quantity),"SERVICE CHARGE"),"AGENT SERVICE CHARGE",$vCode,"")==1)
		{
			$transact = 1;
		}
		else
		{
			$transact = 0;
		}
	}
	else
	{
		$transact = 2;
	}
	
	
	if($transact==1)
	{
		$r_user = uniqueCode();
		
		sendSMS($transporter,"You have been selected to transport goods for ".$customerArray["name"].". Be on standby.");
		
		$productname = "";
		$totalPrice = 0;
				
		if(!($PID==""))
		{
			$totalPrice = $totalPrice+($quantity*$unitPrice);
			$productname .= $quantity." ".getUnit($unit,"NAME")." of ".getProduct($PID,"NAME").", ";
			
			$_REQUEST["cnct"] = "cnct_uagro.php";
			
			$meta1 = addMeta("PRODUCT LISTED FOR SALE",$vCode,$PID,$quantity,$unitPrice,$r_user,"");
			$meta2 = addMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS",standadizesMobile($transporter),$PID,$minDeliveryAmount,$unit,$r_user,"");
			$meta3 = addMeta("AGENT LIST PRODUCT FOR SALE TRANSACTION",$vCode,$PID."|".$unit."|".$quantity."|".$unitPrice."|".getServiceCharge(($unitPrice*$quantity),"SERVICE CHARGE")."|".(getServiceCharge(($unitPrice*$quantity),"FLOAT"))."|".($unitPrice*$quantity),($unitPrice*$quantity),$vCode,$r_user,"");
			$meta4 = addMeta("PRODUCT LISTED FOR SALE - IMAGE",$PID,$image,"",$vCode,$r_user,"");
			$meta5 = addMeta("PRODUCT LISTED FOR SALE TOTAL",$vCode,$PID,($quantity*$unitPrice),$quantity,$r_user,"");
					
		}
	}
	
	//$customerName = $customerArray["name"];

	$response["success"] = $transact;
	  
    // check if row inserted or not       $_REQUEST[""] 
    if($transact==1) 
	{
	$customerBalance2 = accountBalance($vCode);
	  // successfully inserted into database
	  $response["balance"] = $customerBalance2;
	  
	  $response["message"] =  "Congratulations ".$customerArray["name"]."! You have successfully listed ".$productname.", valued at ".$totalPrice.". Your account balance is now K".number_format($customerBalance2,2);		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==0)
	{
	  // successfully inserted into database
		  $response["message"] =  "Sorry ".$customerArray["name"].". Transaction was aborted. Please try again later.";		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==2)
	{
	  // successfully inserted into database
		  $response["message"] =  "Sorry ".$customerArray["name"].". You have insufficient balance. Please top up and try again.";		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==3)
	{
	  // successfully inserted into database
		  $response["message"] =  "Sorry ".$customerArray["name"].". Transaction was not authorized. Please try again later.";		
	  // echoing JSON response
	  return ($response);
	}
	elseif($transact==4)
	{
	  // successfully inserted into database
		  $response["message"] =  "Congratulations ".$customerArray["name"].". Transaction successful.";		
	  // echoing JSON response
	  return ($response);
	}
}


function getProductImage($PID,$userID=""){
	//addMeta("PRODUCT LISTED FOR SALE - IMAGE",$PID,$image,"",$customer,$r_user,"")
	//addMeta($meta_data,$userid="",$data="",$numdata=0,$syncstate="",$r_user="",$datedata="")
	//getMeta($meta_data,$id="",$userid="",$data="",$numdata="",$syncstate="",$r_user="",$datedata="",$misc="",$limiter="")
	
	if($userID=="")
	{
		return "";
	}
	else
	{
		$_REQUEST["cnct"] = "cnct_uagro.php";
		$array = getMeta("PRODUCT LISTED FOR SALE - IMAGE","=|(SELECT max(id) FROM meta WHERE userid = '".$PID."' AND syncstate = '".$userID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE - IMAGE")."')");
		
		
		return $array[0]["data"];
	}
}


function checkProductInUserStore($productID,$userID,$type){
	
	$_REQUEST["cnct"] = "cnct_uagro.php";
	
	if($type=="QUANTITY")
	{
		$qtyRes = getMeta("PRODUCT LISTED FOR SALE","","=|'".$userID."'","=|'".$productID."'","||sum|AS misc1");
		return $qtyRes[0]["misc1"];
	}
	elseif($type=="PRICE")
	{
		$priceRes = getMeta("PRODUCT LISTED FOR SALE","=|(SELECT max(id) FROM meta WHERE userid = '".$userID."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE")."')");
		return $priceRes[0]["syncstate"];
	}
	elseif($type=="UNIT")
	{
		$priceRes = getMeta("PRODUCT LISTED FOR SALE","=|(SELECT max(id) FROM meta WHERE userid = '".$userID."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE")."')");
		
		$result2 = getMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS","=|(SELECT max(id) FROM meta WHERE r_user = '".$priceRes[0]['r_user']."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE - EXTRA FIELDS")."')");
		return $result2[0]["syncstate"];
	}
}


function unitsList(){
	
	$response = array();
	
	// include db connect class

include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM units") or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$response["units"] = array();
		
		while ($row = mysql_fetch_array($result)) 
		{
			// temp user array
			$units = array();
			$units["unitID"] = $row["unitID"];
			$units["name"] = $row["name"];
			$units["measure"] = $row["measure"];
			$units["unitType"] = $row["unitType"];
			
		
			// push single product into final response array
			array_push($response["units"], $units);
		}
		// success
		$response["success"] = 1;
		
		return $response;
	}
	else 
	{
		// no products found
		$response["success"] = 0;
		$response["message"] = "No units found";
		
		return $response;
	}
	
	mysql_close($db);
}



function unitsBList(){
	
	$response = array();
	
	// include db connect class

include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM units") or die(mysql_error());
	@$num = mysql_num_rows($result);
	// check for empty result
	if ($num > 0) 
	{
		// looping through all results
		// products node
		
		while ($row = mysql_fetch_array($result)) 
		{
			// temp user array
			$units[] = array("num"=>$num,"unitID"=>$row["unitID"],"name"=>$row["name"],"measure"=>$row["measure"],"unitType"=>$row["unitType"]);
		
		}
		// success
		
		return $units;
	}
	else 
	{
		// no products found
		
		return 0;
	}
	
	mysql_close($db);
}


function addUnit($unitName,$unitSymbol,$unittype){
	
	include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO units (unitID,name,measure,unitType) VALUE ('','".$unitName."','".$unitSymbol."','".$unittype."');";
	$res = mysql_query($ins);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	mysql_close($db);
}


function productCategoryList($class=""){
	
	$response = array();
	
	// include db connect class
	
	// get all categories from categories table
	$row = listProductCategory($class);
	
	// check for empty result
	if ($row[0]['num'] > 0) 
	{
		// looping through all results
		// products node
		$response["categories"] = array();
		//$array[] = array('num'=>$num,'id'=>$rw["catID"],'name'=>$rw["catName"],'description'=>$rw["catDescription"],'type'=>$rw["catType"],'class'=>$rw["classification"],'image'=>$rw["catImage"]);

		// check for empty result
		for($a=0; $a<$row[0]['num']; $a++)
		{
			// temp user array
			$categories = array();
			$categories["catID"] = $row[$a]["id"];
			$categories["catName"] = $row[$a]["name"];
			$categories["catType"] = $row[$a]["type"];
			$categories["catImage"] = $row[$a]["image"];
			$categories["class"] = $row[$a]["class"];
			
		
			// push single product into final response array
			array_push($response["categories"], $categories);
		}
		// success
		$response["success"] = 1;
		
		return $response;
	}
	else 
	{
		// no products found
		$response["success"] = 0;
		$response["message"] = "No categories found";
		
		return $response;
	}
}



function inputCategoryList($class=""){
	
	$response = array();
	
	// get all categories from categories table
	$row = listProductCategory($class);
	
	// check for empty result
	if ($row[0]['num'] > 0) 
	{
		// looping through all results
		// products node
		$response["categories"] = array();
		
		// check for empty result
		for($a=0; $a<$row[0]['num']; $a++)
		{
			// temp user array
			$categories = array();
			$categories["catID"] = $row[$a]["id"];
			$categories["catName"] = $row[$a]["name"];
			$categories["catType"] = $row[$a]["type"];
			$categories["catImage"] = $row[$a]["image"];
			$categories["class"] = $row[$a]["class"];
		
			// push single product into final response array
			array_push($response["categories"], $categories);
		}
		// success
		$response["success"] = 1;
		
		return $response;
	}
	else 
	{
		// no products found
		$response["success"] = 0;
		$response["message"] = "No categories found";
		
		return $response;
	}
	
	mysql_close($db);
}
	

 

function productDList($catID="",$type="",$limiter=""){
	
	$response = array();
	
	
	if($type=="")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pID = '".$catID."'";
		}
	}
	elseif($type=="ID")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pID = '".$catID."'";
		}
	}
	elseif($type=="NAME")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pName like '%".$catID."%'";
		}
	}
	elseif($type=="CATEGORY")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pCategory = '".$catID."'";
		}
	}
	elseif($type=="DESCRIPTION")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE description like '%".$catID."%'";
		}
	}
	
	// include db connect class
	include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$query = "SELECT * FROM product ".$where." ".$limiter.";";
	//echo $query."<br>";
	$result = mysql_query($query) or die(mysql_error());
	
	// check for empty result
	$num = mysql_num_rows($result);
		
	if ($num > 0) 
	{
		// looping through all results
		// products node
		while ($row = mysql_fetch_array($result)) 
		{
			// temp user array
			$products[] = array('num'=>$num,'id'=>$row["pID"],'name'=>$row["pName"],'categorgy'=>$row["pCategory"],'image'=>$row["productPic"]);
		}
		return $products;
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}
	

 

function productCList($catID="",$type="",$limiter=""){
	
	$response = array();
	
	
	if($type=="")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pID = '".$catID."'";
		}
	}
	elseif($type=="ID")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pID = '".$catID."'";
		}
	}
	elseif($type=="NAME")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pName like '%".$catID."%'";
		}
	}
	elseif($type=="CATEGORY")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE pCategory = '".$catID."'";
		}
	}
	elseif($type=="DESCRIPTION")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = "WHERE description like '%".$catID."%'";
		}
	}
	
	// include db connect class
	include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM product ".$where." ".$limiter) or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$response["products"] = array();
		
		while ($row = mysql_fetch_array($result)) 
		{
			// temp user array
			$products = array();
			$products["prodID"] = $row["pID"];
			$products["prodName"] = $row["pName"];
			$products["prodCat"] = $row["pCategory"];
			
		
			// push single product into final response array
			array_push($response["products"], $products);
		}
		// success
		$response["success"] = 1;
		
		return $response;
	}
	else 
	{
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found";
		
		return $response;
	}
	
	mysql_close($db);
}


function inputCList($catID="",$type=""){
	
	$response = array();
	
	if($type=="")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = " pID = '".$catID."'";
		}
	}
	elseif($type=="ID")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = " pID = '".$catID."'";
		}
	}
	elseif($type=="NAME")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = " pName like '%".$catID."%'";
		}
	}
	elseif($type=="CATEGORY")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = " pCategory = '".$catID."'";
		}
	}
	elseif($type=="DESCRIPTION")
	{
		if($catID=="")
		{
			$where = "";
		}
		else
		{
			$where = " description like '%".$catID."%'";
		}
	}
	
	// include db connect class
	
	include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM inputs ".$where) or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$response["products"] = array();
		
		while ($row = mysql_fetch_array($result)) 
		{
			// temp user array
			$products = array();
			$products["prodID"] = $row["pID"];
			$products["prodName"] = $row["pName"];
			$products["prodCat"] = $row["pCategory"];
			
		
			// push single product into final response array
			array_push($response["products"], $products);
		}
		// success
		$response["success"] = 1;
		
		return $response;
	}
	else 
	{
		// no products found
		$response["success"] = 0;
		$response["message"] = "No input found";
		
		return $response;
	}
	
	mysql_close($db);
}


function getProduct($pid,$type=""){
	
	// include db connect class
	
	include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM product WHERE pID = '".$pid."'") or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$row = mysql_fetch_array($result);	
		
		if($type=="")
		{
			return $row["pName"];
		}
		elseif($type=="ID")
		{
			return $row["pID"];
		}
		elseif($type=="NAME")
		{
			return $row["pName"];
		}
		elseif($type=="CATEGORY")
		{
			return $row["pCategory"];
		}
		elseif($type=="PRODUCT PICTURE")
		{
			return $row["productPic"];
		}
		elseif($type=="DESCRIPTION")
		{
			return $row["description"];
		}
		elseif($type=="DATE ADDED")
		{
			return $row["createdAt"];
		}
		elseif($type=="PACKAGING")
		{
			return $row["packaging"];
		}
		elseif($type=="AGE")
		{
			return $row["pAge"];
		}
		elseif($type=="TYPE")
		{
			return $row["pType"];
		}
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}


function getInput($pid,$type=""){
	
	// include db connect class
	
	include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM inputs WHERE pID = '".$pid."'") or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$row = mysql_fetch_array($result);	
		
		if($type=="")
		{
			return $row["pName"];
		}
		elseif($type=="ID")
		{
			return $row["pID"];
		}
		elseif($type=="NAME")
		{
			return $row["pName"];
		}
		elseif($type=="CATEGORY")
		{
			return $row["pCategory"];
		}
		elseif($type=="PRODUCT PICTURE")
		{
			return $row["productPic"];
		}
		elseif($type=="DESCRIPTION")
		{
			return $row["description"];
		}
		elseif($type=="DATE ADDED")
		{
			return $row["createdAt"];
		}
		elseif($type=="PACKAGING")
		{
			return $row["packaging"];
		}
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}


function getUnit($unitID,$type=""){
	
	// include db connect class
	
	include find_file('cnct_uagro.php');
	
	// get all categories from categories table
	$result = mysql_query("SELECT * FROM units WHERE unitID = '".$unitID."'") or die(mysql_error());
	
	// check for empty result
	if (mysql_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$row = mysql_fetch_array($result);	
		
		if($type=="")
		{
			return $row["name"];
		}
		elseif($type=="ID")
		{
			return $row["unitID"];
		}
		elseif($type=="NAME")
		{
			return $row["name"];
		}
		elseif($type=="MEASURE")
		{
			return $row["measure"];
		}
		elseif($type=="UNIT TYPE")
		{
			return $row["unitType"];
		}
	}
	else 
	{
		return 0;
	}
	
	mysql_close($db);
}


function addProductCategory($class,$name,$description,$type){
	
	include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO productcategories (catID,catName,catDescription,catType,classification) VALUES ('','".strtoupper($name)."','".$description."','".$type."','".$class."');";
	$res = mysql_query($ins);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}

//productCategoryList
function listProductCategory($class="",$limiter=""){
	include find_file('cnct_uagro.php');
	
	if($class=="")
	{
		$where = "";
	}
	else
	{
		$where = " WHERE classification = '".$class."'";
	}
	
	$input = "SELECT * FROM productcategories WHERE catID IN (SELECT max(catID) FROM productcategories ".$where." ".$limiter." GROUP BY catName);";
	//echo $input."<br>";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	//echo $num."<br>";
	for($a=0; $a<$num; $a++)
	{
		@$rw = mysql_fetch_array($res);
		$array[] = array('num'=>$num,'id'=>$rw["catID"],'name'=>$rw["catName"],'description'=>$rw["catDescription"],'type'=>$rw["catType"],'class'=>$rw["classification"],'image'=>$rw["catImage"]);
	}
	
	mysql_close($db); 
	return $array;
}


function getProductCategory($id,$type=""){
	include find_file('cnct_uagro.php');
	
	$input = "SELECT * FROM productcategories WHERE catID = (SELECT max(catID) FROM productcategories WHERE catID = '".$id."' OR catName = '".$id."');";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	if($num<=0)
	{
		return 0;
	}
	else
	{
		@$rw = mysql_fetch_array($res);
		if($type=="" || strtoupper($type)=="NAME")
		{
			return $rw["catName"];
		}
		elseif(strtoupper($type)=="DESCRIPTION")
		{
			return $rw["catDescription"];
		}
		elseif(strtoupper($type)=="TYPE")
		{
			return $rw["catType"];
		}
		elseif(strtoupper($type)=="IMAGE")
		{
			return $rw["catImage"];
		}
		elseif(strtoupper($type)=="CLASS")
		{
			return $rw["classification"];
		}
	}
	mysql_close($db); 
}


function addProduct($name,$category,$description,$packaging,$pAge,$image){
	
	include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO product (pID,pName,pCategory,description,packaging,pType,pAge,productPic) VALUES ('','".strtoupper($name)."','".$category."','".$description."','".$packaging."','".getProductCategory($category,"TYPE")."','".$pAge."','".$image."');";
	$res = mysql_query($ins);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}


function deleteProductCategory($id){
	include find_file('cnct_uagro.php');
	
	$qry = "DELETE FROM productcategories WHERE id = '".$id."';";
	$res = mysql_query($qry);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db); 
}


function addClassification($name,$description,$type,$class=""){
	
	include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO classifications (classID,className,classDescription,classType,classification) VALUES ('','".strtoupper($name)."','".$description."','".$type."','".$class."');";
	$res = mysql_query($ins);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}


function listClassifications(){
	include find_file('cnct_uagro.php');
	
	$input = "SELECT * FROM classifications WHERE classID IN (SELECT max(classID) FROM classifications GROUP BY className);";
	//echo $input."<br>";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	for($a=0; $a<$num; $a++)
	{
		@$rw = mysql_fetch_array($res);
		$array[] = array('num'=>$num,'id'=>$rw["classID"],'name'=>$rw["className"],'description'=>$rw["classDescription"],'type'=>$rw["classType"],'class'=>$rw["classification"]);
	}
	//echo $num."<br>";
	mysql_close($db); 
	return $array;
}


function getClassification($id,$type=""){
	include find_file('cnct_uagro.php');  //classID,className,classDescription,classType,classification
	
	$input = "SELECT * FROM classifications WHERE classID = '".$id."';";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	if($num<=0)
	{
		return 0;
	}
	else
	{
		@$rw = mysql_fetch_array($res);
		if($type=="" || strtoupper($type)=="NAME")
		{
			return $rw["className"];
		}
		elseif(strtoupper($type)=="DESCRIPTION")
		{
			return $rw["classDescription"];
		}
		elseif(strtoupper($type)=="TYPE")
		{
			return $rw["classType"];
		}
		elseif(strtoupper($type)=="CLASS")
		{
			return $rw["classification"];
		}
	}
	mysql_close($db); 
}


function deleteClassification($id){
	include find_file('cnct_uagro.php');
	
	$qry = "DELETE FROM classifications WHERE id = '".$id."';";
	$res = mysql_query($qry);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db); 
}


function addCategoryType($class,$name,$product=""){
	
	include find_file('cnct_uagro.php');
	
	$ins = "INSERT INTO categorytype (catID,catName,product,classification) VALUES ('','".strtoupper($name)."','".$product."','".$class."');";
	//echo $ins;
	$res = mysql_query($ins);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db);
}


function listCategoryTypes($class,$product=""){
	include find_file('cnct_uagro.php');
	
	if($product=="")
	{
		$whereProduct = "";
	}
	else
	{
		$whereProduct = "AND product = '".$product."'";
	}
	
	$input = "SELECT * FROM categorytype WHERE catID IN (SELECT max(catID) FROM categorytype WHERE classification = '".$class."' ".$whereProduct." GROUP BY catName);";
	//echo $input."<br>";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	for($a=0; $a<$num; $a++)
	{
		@$rw = mysql_fetch_array($res);
		$array[] = array('num'=>$num,'id'=>$rw["catID"],'name'=>$rw["catName"],'product'=>$rw["product"],'class'=>$rw["classification"]);
	}
	
	mysql_close($db); 
	return $array;
}


function getCategoryType($id,$type=""){
	include find_file('cnct_uagro.php');
	
	$input = "SELECT * FROM categorytype WHERE catID = '".$id."';";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	if($num<=0)
	{
		return 0;
	}
	else
	{
		@$rw = mysql_fetch_array($res);
		if($type=="" || strtoupper($type)=="NAME")
		{
			return $rw["catName"];
		}
		elseif(strtoupper($type)=="PRODUCT")
		{
			return $rw["product"];
		}
		elseif(strtoupper($type)=="CLASS")
		{
			return $rw["classification"];
		}
	}
	mysql_close($db); 
}


function deleteCategoryType($id){
	include find_file('cnct_uagro.php');
	
	$qry = "DELETE FROM categorytype WHERE id = '".$id."';";
	$res = mysql_query($qry);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
	
	mysql_close($db); 
}


function categoryProfilePicture($id){

	include find_file('cnct_uagro.php');
	
	$input = "SELECT * FROM productcategories WHERE catID = '".$id."' AND catImage != '';";
	@$res = mysql_query($input);
	@$num = mysql_num_rows($res);
	if($num<=0)
	{
		return "";
	}
	else
	{
		@$rw = mysql_fetch_array($res);
		return $rw["catImage"];
	}
	mysql_close($db); 
}


function getProductsOnSell($productID,$sort="PRICE ASC",$agentID="",$ret=""){

	$agent = userID($agentID);
	$agentArray = userDetails($agent);
	
	
	if(strtoupper($ret)=="SUPPLIER")
	{
		$retx = "AND ABS(userid) = 0 ";
	}
	elseif(strtoupper($ret)=="FARMER")
	{
		$retx = "AND ABS(userid) != 0 ";
	}
	elseif(strtoupper($ret)=="STOCKIST")
	{
		$retx = "AND ABS(userid) != 0 ";
	}
	else
	{
		$retx = "";
	}
	
	
	/*
	if($ret=="")
	{
		$retx = "";
	}
	else
	{
		if(checkOrgAccount("UNIQUE",$result[$a]['userid'])>=1)
		{
			$retx = "AND ABS(userid) = 0 ";
		}
		else
		{
			$retx = "AND ABS(userid) != 0 ";
		}
	}
	*/
	
	$_REQUEST["cnct"] = "cnct_uagro.php";
	
	$result = getMeta("NIL","IN|(SELECT MAX(id) FROM meta WHERE meta_data = '".md5("PRODUCT LISTED FOR SALE")."' ".$retx." AND data = '".$productID."' GROUP BY userid)","","","","","","",""," GROUP BY userid ORDER BY syncstate");

	// check for empty result
	if ($result[0]['num'] > 0)
	{
		$response = array();
	 
		for($a=0; $a<$result[0]['num']; $a++)
		{
		  //  $response = mysql_fetch_array($result);
			if(!($result[$a]['userid']==""))
			{
			//totalQuantityOnSale($userID,$productID="")
			//totalQuantitySold($userID,$productID="")
			//totalOrgQuantityOnSale($userID,$productID="")
			//totalOrgQuantitySold($userID,$productID="")
			
				if(checkOrgAccount("UNIQUE",$result[$a]['userid'])>=1)
				{
					$orgArray = orgData(orgID($result[$a]['userid']));
	
					$_REQUEST["cnct"] = "cnct_uagro.php";
					
					$priceRes = getMeta("PRODUCT LISTED FOR SALE","=|(SELECT max(id) FROM meta WHERE userid = '".$result[$a]['userid']."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE")."')");
					
					$qtyRes = getMeta("PRODUCT LISTED FOR SALE","","=|'".$result[$a]['userid']."'","=|'".$productID."'","||MAX| AS misc1");
					
					$result2 = getMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS","=|(SELECT max(id) FROM meta WHERE r_user = '".$result[$a]['r_user']."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE - EXTRA FIELDS")."')");
				
					$distanceArray = getDistance($orgArray["physical"]."+".$orgArray["town"]."+".$orgArray["country"],$agentArray["street"]."+".$agentArray["area"]."+".$agentArray["town"]."+".$agentArray["country"]);
					
					
					$qtyX = currentOrgQuantityOnSale($result[$a]['userid'],$productID);
					
					//echo "test: ".totalOrgQuantitySold($result[$a]['userid'],$productID)."<br>";
					
					if($qtyX>0)
					{
						$products[] = array('num'=>$result[0]['num'],'productID'=>$result[$a]['data'],'productname'=>getProduct($result[$a]['data'],"NAME"),'farmerID'=>$result[$a]['userid'],'fName'=>strtoupper($orgArray["shortname"]),'lName'=>strtoupper($orgArray["name"]),'houseNo'=>'','street'=>'','area'=>$orgArray["physical"],'town'=>$orgArray["town"],'price'=>$priceRes[0]['syncstate'],'quantity'=>$qtyX,'unit'=>getUnit($result2[0]['syncstate'],"NAME"),'unitID'=>$result2[0]['syncstate'],'minvalue'=>$result2[0]['numdata'],'vCode'=>$result[$a]['r_user'],'distance'=>$distanceArray["distance_value"]);
					}
				}
				else
				{
					$farmerArray = userDetails($result[$a]['userid']);
	
					$_REQUEST["cnct"] = "cnct_uagro.php";
					
					$priceRes = getMeta("PRODUCT LISTED FOR SALE","=|(SELECT max(id) FROM meta WHERE userid = '".$result[$a]['userid']."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE")."')");
					
					$qtyRes = getMeta("PRODUCT LISTED FOR SALE","","=|'".$result[$a]['userid']."'","=|'".$productID."'","||MAX|AS misc1");
					
					$result2 = getMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS","=|(SELECT max(id) FROM meta WHERE r_user = '".$result[$a]['r_user']."' AND data = '".$productID."' AND meta_data = '".md5("PRODUCT LISTED FOR SALE - EXTRA FIELDS")."')");
					
					$distanceArray = getDistance($farmerArray["street"]."+".$farmerArray["area"]."+".$farmerArray["town"]."+".$farmerArray["country"],$agentArray["street"]."+".$agentArray["area"]."+".$agentArray["town"]."+".$agentArray["country"]);
					
					$qtyX = currentQuantityOnSale($result[$a]['userid'],$productID);
					
					//echo "test: ".$qtyX."<br>";
					
					if($qtyX>0)
					{
						$products[] = array('num'=>$result[0]['num'],'productID'=>$result[$a]['data'],'productname'=>getProduct($result[$a]['data'],"NAME"),'farmerID'=>$result[$a]['userid'],'fName'=>$farmerArray["FirstName"],'lName'=>$farmerArray["LastName"],'houseNo'=>$farmerArray["houseNo"],'street'=>$farmerArray["street"],'area'=>$farmerArray["area"],'town'=>$farmerArray["town"],'price'=>$priceRes[0]['syncstate'],'quantity'=>$qtyX,'unit'=>getUnit($result2[0]['syncstate'],"NAME"),'unitID'=>$result2[0]['syncstate'],'minvalue'=>$result2[0]['numdata'],'vCode'=>$result[$a]['r_user'],'distance'=>$distanceArray["distance_value"]);
					}
				}

			}
		}
		
		if(count($products)>=2)
		{
			if(strtoupper($sort)=="DISTANCE ASC")
			{
				sksort($products,'distance',true);
			}
			elseif(strtoupper($sort)=="DISTANCE DESC")
			{
				sksort($products,'distance',false);
			}
			elseif(strtoupper($sort)=="PRICE ASC")
			{
				sksort($products,'price',true);
			}
			elseif(strtoupper($sort)=="PRICE DESC")
			{
				sksort($products,'price',false);
			}
			elseif(strtoupper($sort)=="QUANTITY ASC")
			{
				sksort($products,'quantity',true);
			}
			elseif(strtoupper($sort)=="QUANTITY DESC")
			{
				sksort($products,'quantity',false);
			}
			else
			{
				sksort($products,'price',true);
			}
		}
		
		//var_dump($products);	
		// echoing JSON response
		return $products;
	}
	else 
	{
		// echo no users JSON
		return 0;
	}
}



function payForGoods($customerID,$totalDue,$sellerArray,$agentX="",$branch="WEB"){
	//
	$customer = userID($customerID);
	$prodIDz = explode("|",$_REQUEST['prodID']);
	$prodQuantityz = explode("|",$_REQUEST['prodQuantity']);
	$prodAmountz = explode("|",$_REQUEST['prodAmount']);
	$prodVCodez = explode("|",$_REQUEST['prodVCode']);
	$prodFarmerIDz = explode("|",$_REQUEST['prodFarmerID']);
	$prodFarmerIDz2 = explode("|",$_REQUEST['prodFarmerID']);
	$prodUnitIDz = explode("|",$_REQUEST['prodUnitID']);
	$total = $totalDue;
	$fields = 6; 
	
	$count = (substr_count($_REQUEST['prodID'],"|")+1);
	
	//var_dump($sellerArray["supplier"]);
				
	//echo "count: ".count($sellerArray["supplier"])."<br><br>";
	
	if($agentX=="")
	{
		$buyer = $customer;
	}
	else
	{
		$agent = userID($agentX);
		$buyer = $agent;
	}
			

	$customerArray = userDetails($customer);
	$agentArray = userDetails($buyer);
	
	$customerMobile = $customerArray["Mobile"];
	$agentMobile = $agentArray["Mobile"];
	$requiredFloat = getServiceCharge(totalOrgValueOnSale($buyer),"FLOAT");
	$accountBalance = accountBalance($buyer);
	$transactionFees = transactionFees($totalDue);
	$serviceChargeCommission = serviceChargeCommission(getServiceCharge($totalDue,"SERVICE CHARGE"));
	
	if($accountBalance>=($requiredFloat+$transactionFees+$serviceChargeCommission))
	{

		$farmerIDs = array_values(array_unique($prodFarmerIDz));
		$prodIDs = array_values(array_unique($prodIDz));
		
		$farmerUnCount = count($sellerArray["supplier"]);
		$prodUnCount = count($prodIDs);
		
		
		$transactx = 0;
		$consolidatedList = "";
		$p_vCode = uniqueCode();
		$smsstatus = "";
		
		for($fx=0; $fx<$farmerUnCount; $fx++)
		{
			$f = $sellerArray["supplier"][$fx];
			
			//echo "FARMER: ".$f."<BR><br>";
	
			$amount_due_to_farmer = $sellerArray["amount"][$sellerArray["supplier"][$fx]];
			
			${"list|".$f} = "";
			
			//echo "num: ".count($sellerArray["products"][$sellerArray["supplier"][$fx]])."<br>";
					
			for($h=0; $h<count($sellerArray["products"][$sellerArray["supplier"][$fx]]); $h++)
			{
				$prods = $sellerArray["products"][$sellerArray["supplier"][$fx]];
				
				$p = $prods[$h]["productID"];
				$p_qty = $prods[$h]["qty"];
				$p_vCode = $prods[$h]["vCode"];
				$p_price = $prods[$h]["price"];
				$p_unitID = $prods[$h]["unitID"];
					
					
				if($p_qty>0)
				{
					$vCodey[$f] = $p_vCode;
					
					
					$_REQUEST["cnct"] = "cnct_uagro.php";
					
					$result2 = getMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS","=|(SELECT max(id) FROM meta WHERE r_user = '".$p_vCode."' AND data = '".$p."')");
					$unit = $result2[0]['syncstate'];
					$transporter = $result2[0]['userid'];
					
					$result2x = getMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS","=|(SELECT max(id) FROM meta WHERE r_user = '".$p_vCode."' AND data = '".$p."' AND userid != '' AND userid != 'NUL')");
					$producty[$f] = $result2x[0]['data'];
					$transportery[$f] = $result2x[0]['userid'];
					
					
					$_REQUEST["cnct"] = "cnct_uagro.php";
					
					//echo "Customer: ".$customer."<br>";
					
					$trans1 = addMeta("PRODUCT PURCHASED",$f,$p,$p_qty,$p_price,$p_vCode,"");
					$trans2 = addMeta("PRODUCT PURCHASED TOTAL",$f,$p,($p_price*$p_qty),$p_qty,$p_vCode,"");
					$trans3 = addMeta("PRODUCT PURCHASED - EXTRA FIELDS",$transporter,$p,$p_qty,$p_unitID,$p_vCode,"");
					$trans4 = addMeta("AGENT ADDED PRODUCT PURCHASE TRANSACTION",$buyer,$p."|".$p_unitID."|".$p_qty."|".$p_vCode."|".($p_qty*$p_price),($p_qty*$p_price),$customer,$p_vCode,"");
					$trans5 = addMeta("PRODUCT PURCHASED - PARTY DETAILS",$customer."|".$f,$p,$p_qty,$p_price,$p_vCode,"");
					
					if($trans1==1 && $trans2==1 && $trans3==1 && $trans4==1)
					{
						
						if($h==0)
						{
							${"list|".$f} .= $p_qty." ".getUnit($p_unitID,"NAME")." ".getProduct($p,"NAME")." at K".$p_price." per ".getUnit($p_unitID,"NAME")." ";
						}
						else
						{
							if($h==($prodUnCount-1))
							{
								${"list|".$f} .= ", ".$p_qty." ".getUnit($p_unitID,"NAME")." ".getProduct($p,"NAME")." at K".$p_price." per ".getUnit($p_unitID,"NAME").". ";
							}
							else
							{
								${"list|".$f} .= ", ".$p_qty." ".getUnit($p_unitID,"NAME")." ".getProduct($p,"NAME")." at K".$p_price." per ".getUnit($p_unitID,"NAME")." ";
							}
						}
						
					}
				}
			}
		
		
			${"list|".$f} .= " Total: K".$amount_due_to_farmer." ";
			
			if($buyer==$customer)
			{
				$tran = transact($buyer,$f,$amount_due_to_farmer,"TRADE","",$buyer,$branch);
			}
			else //
			{
				$tranx = transact($buyer,$customer,$amount_due_to_farmer,"AGENT TOPUP","",$buyer,$branch);
				$tran = transact($customer,$f,$amount_due_to_farmer,"TRADE",$buyer,"",$branch);
				//$debt = debit($buyer,$amount_due_to_farmer,"AGENT SERVICE CHARGE",$buyer,"");
			}
			
				//echo "tran: ".$tran."<br>farmer: ".$f."<br><br>";
			
			if($tran==1)
			{
	
				
					$_REQUEST["cnct"] = "cnct_uagro.php";
					
					$result3 = getMeta("PRODUCT LISTED FOR SALE - EXTRA FIELDS","=|(SELECT max(id) FROM meta WHERE r_user = '".$vCodey[$f]."' AND data = '".$producty[$f]."')");
					//$transporter = $result3[0]['userid'];
					$transporterThreshhold = $result3[0]['data'];
					$f_array = userDetails($f);
					
					//echo "transport 2: ".$transporter."<br>";
					
					//$customerMobile = $customerArray["Mobile"];
					$agentMobile = getMobile($buyer);
					$farmerMobile = getMobile($f);
					
					
					if($farmerMobile==$customerMobile)
					{
						$consolidatedList .= ${"list|".$f}." farmer ".($fx+1).": Get transport.";
					}
					else
					{
						if($farmerMobile==standadizesMobile($transportery[$f]))
						{
							$smsstatus .= sendSMS($farmerMobile,"You've received money. Goods bought: ".${"list|".$f}.": Get transport.")."``~``";
						}
						else
						{							
							if($amount_due_to_farmer>=$transporterThreshhold)
							{
								generateConfirmationCode(getMobile($buyer),$farmerMobile,standadizesMobile($transportery[$f]),"Provide this code to the farmer as you collect his/her goods for transportation: ",180);
								$consolidatedList .= ${"list|".$f}." farmer ".($fx+1).".";
							}
							else
							{
								$consolidatedList .= ${"list|".$f}." farmer ".($fx+1).": Get transport.";
							}
						
							$smsstatus .= sendSMS($farmerMobile,"You've received money. Goods bought: ".${"list|".$f})."``~``";
						}
					}

					$transactx = $transactx+1;
					
			}
			else
			{
				$transactx = $transactx;
			}
		}
		
		
		$consolidatedList .= " Total: ".$totalDue;
		
		if($customer==$buyer)
		{
			
		}
		else
		{
			$smsstatus .= sendSMS($customerMobile,"You've paid for the following: ".$consolidatedList."")."``~``";
		}
		
			
		if($transactx>=($fx))
		{
			$transact = 1;
		}
		else
		{
			$transact = 3;
		}
	}
	else
	{
		$transact = 2;
	}
	
	
    // check if row inserted or not
     $response["smsstatus"] = explode("``~``",$smsstatus);
		
    if($transact==1) 
	{
		
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Congratulation! You made a successful transaction.";
        $response["transaction_value"] = $totalDue;
 
        return $response;
    }
	elseif($transact==2)
	{
        // successfully inserted into database
        $response["success"] = 0;
        $response["message"] = "Insufficient funds.";
        $response["transaction_value"] = $totalDue;
 
        return $response;
	}
	elseif($transact==3)
	{
        // successfully inserted into database
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        $response["transaction_value"] = $totalDue;
 
        return $response;
	}
	else 
	{
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        $response["transaction_value"] = $totalDue;
 
        return $response;
    }
}
?>